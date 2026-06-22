<?php

defined('ABSPATH') || exit;

if (!function_exists('erotikava_render_event_calendar')) {
    /**
     * Render the monthly event calendar using CPT + ACF data.
     *
     * @param array<string, mixed> $args
     */
    function erotikava_render_event_calendar(array $args = []): void
    {
        $defaults = [
            'year' => (int) wp_date('Y'),
            'month' => (int) wp_date('n'),
            'show_search' => true,
            'eyebrow' => null,
            'title' => null,
        ];

        $args = wp_parse_args($args, $defaults);
        $year = max(2000, (int) $args['year']);
        $month = min(12, max(1, (int) $args['month']));
        $month_start = mktime(0, 0, 0, $month, 1, $year);

        $month_label = $args['eyebrow'] ?: wp_date('F Y', $month_start);
        $month_title = $args['title'] ?: sprintf('%d年%d月イベントカレンダー', $year, $month);
        $days_in_month = (int) wp_date('t', $month_start);
        $month_start_key = wp_date('Ymd', $month_start);
        $month_end_key = wp_date('Ymd', mktime(23, 59, 59, $month, $days_in_month, $year));
        $first_weekday_index = (int) wp_date('N', $month_start) - 1;

        $query = new WP_Query([
            'post_type' => 'event_calendar',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => 'event_date',
            'meta_query' => [
                [
                    'key' => 'event_date',
                    'value' => [$month_start_key, $month_end_key],
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC',
                ],
            ],
        ]);

        $events_by_day = [];

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $event_date = (string) get_field('event_date', $post_id);

            if (strlen($event_date) !== 8) {
                continue;
            }

            $day = (int) substr($event_date, 6, 2);

            $events_by_day[$day] = [
                'post_id' => $post_id,
                'date_key' => $event_date,
                'status' => (string) get_field('event_status', $post_id) ?: 'scheduled',
                'image_id' => (int) get_field('event_image', $post_id),
                'note' => (string) get_field('event_note', $post_id) ?: '出演情報調整中',
            ];
        }

        wp_reset_postdata();

        $weekday_labels = ['月', '火', '水', '木', '金', '土', '日'];
        ?>
        <p class="eyebrow center"><?php echo esc_html($month_label); ?></p>
        <h2 class="section-title"><?php echo esc_html($month_title); ?></h2>
        <?php if ($args['show_search']) : ?>
            <div class="event-search-panel">
                <label class="event-search-label" for="event-search-input">イベント検索</label>
                <input
                    id="event-search-input"
                    class="event-search-input"
                    type="search"
                    placeholder="例: 7/14, <?php echo esc_attr($year . '-' . str_pad((string) $month, 2, '0', STR_PAD_LEFT) . '-14'); ?>, Show, TBA"
                    data-event-search-input
                >
                <p class="event-search-status" data-event-search-status><?php echo esc_html($days_in_month); ?>件表示中</p>
            </div>
        <?php endif; ?>
        <div class="monthly-event-calendar">
            <div class="calendar-weekdays" aria-hidden="true">
                <?php foreach ($weekday_labels as $label) : ?>
                    <span><?php echo esc_html($label); ?></span>
                <?php endforeach; ?>
            </div>
            <div class="calendar-event-grid">
                <?php for ($i = 0; $i < $first_weekday_index; $i++) : ?>
                    <div class="calendar-event-spacer" aria-hidden="true"></div>
                <?php endfor; ?>

                <?php for ($day = 1; $day <= $days_in_month; $day++) : ?>
                    <?php
                    $event = $events_by_day[$day] ?? null;
                    $date_display = sprintf('%d/%d', $month, $day);
                    $date_key = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $status = $event['status'] ?? 'pending';
                    $note = $event['note'] ?? '出演情報調整中';
                    ?>
                    <?php if ($event && $status === 'scheduled' && !empty($event['image_id'])) : ?>
                        <article class="calendar-event-card" data-event-date="<?php echo esc_attr($date_key); ?>" data-event-status="scheduled">
                            <div class="calendar-event-head">
                                <span class="calendar-event-date"><?php echo esc_html($date_display); ?></span>
                                <span class="calendar-event-label">Show</span>
                            </div>
                            <figure>
                                <?php echo wp_get_attachment_image($event['image_id'], 'large', false, [
                                    'alt' => $date_display . 'のイベント',
                                ]); ?>
                            </figure>
                        </article>
                    <?php else : ?>
                        <article class="calendar-event-card is-pending" data-event-date="<?php echo esc_attr($date_key); ?>" data-event-status="pending">
                            <div class="calendar-event-head">
                                <span class="calendar-event-date"><?php echo esc_html($date_display); ?></span>
                                <span class="calendar-event-label">TBA</span>
                            </div>
                            <div class="calendar-pending-note"><?php echo esc_html($note); ?></div>
                        </article>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <?php
    }
}
