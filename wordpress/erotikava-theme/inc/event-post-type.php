<?php

defined('ABSPATH') || exit;

if (! function_exists('erotikava_get_event_post_type')) {
    function erotikava_get_event_post_type(): string
    {
        if (post_type_exists('event_calendar')) {
            return 'event_calendar';
        }

        return 'erotikava_event';
    }
}

add_action('init', function (): void {
    if (post_type_exists('event_calendar') || post_type_exists('erotikava_event')) {
        return;
    }

    register_post_type('erotikava_event', [
        'labels' => [
            'name' => 'イベント',
            'singular_name' => 'イベント',
            'add_new' => '新規追加',
            'add_new_item' => 'イベントを追加',
            'edit_item' => 'イベントを編集',
            'new_item' => '新しいイベント',
            'view_item' => 'イベントを表示',
            'search_items' => 'イベントを検索',
            'not_found' => 'イベントが見つかりません',
            'not_found_in_trash' => 'ゴミ箱にイベントはありません',
            'menu_name' => 'イベント',
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => ['title'],
        'has_archive' => false,
        'rewrite' => false,
        'show_in_rest' => false,
    ]);
});

add_action('acf/init', function (): void {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    $post_type = erotikava_get_event_post_type();
    $uses_existing_event_calendar = $post_type === 'event_calendar';

    $fields = [];

    if (! $uses_existing_event_calendar) {
        $fields[] = [
            'key' => 'field_erotikava_event_date',
            'label' => '開催日',
            'name' => 'event_date',
            'type' => 'date_picker',
            'display_format' => 'Y/m/d',
            'return_format' => 'Ymd',
            'first_day' => 1,
            'required' => 1,
        ];
        $fields[] = [
            'key' => 'field_erotikava_event_status',
            'label' => '表示状態',
            'name' => 'event_status',
            'type' => 'select',
            'choices' => [
                'scheduled' => 'scheduled',
                'pending' => 'pending',
            ],
            'default_value' => 'scheduled',
            'required' => 1,
            'ui' => 1,
            'return_format' => 'value',
        ];
        $fields[] = [
            'key' => 'field_erotikava_event_image',
            'label' => 'イベント画像',
            'name' => 'event_image',
            'type' => 'image',
            'return_format' => 'id',
            'preview_size' => 'medium',
            'library' => 'all',
            'conditional_logic' => [
                [
                    [
                        'field' => 'field_erotikava_event_status',
                        'operator' => '==',
                        'value' => 'scheduled',
                    ],
                ],
            ],
        ];
        $fields[] = [
            'key' => 'field_erotikava_event_pending_note',
            'label' => '保留表示テキスト',
            'name' => 'event_pending_note',
            'type' => 'text',
            'default_value' => '出演情報調整中',
            'conditional_logic' => [
                [
                    [
                        'field' => 'field_erotikava_event_status',
                        'operator' => '==',
                        'value' => 'pending',
                    ],
                ],
            ],
        ];
    }

    $fields[] = [
        'key' => 'field_erotikava_event_label',
        'label' => '表示ラベル',
        'name' => 'event_label',
        'type' => 'text',
        'default_value' => 'Show',
        'instructions' => '例: Show, TBA',
    ];
    $fields[] = [
        'key' => 'field_erotikava_event_image_alt',
        'label' => '画像alt',
        'name' => 'event_image_alt',
        'type' => 'text',
    ];
    $fields[] = [
        'key' => 'field_erotikava_event_admin_memo',
        'label' => '管理用メモ',
        'name' => 'event_admin_memo',
        'type' => 'textarea',
        'rows' => 4,
    ];

    acf_add_local_field_group([
        'key' => 'group_erotikava_theme_events',
        'title' => 'Erotikava イベント設定',
        'fields' => $fields,
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => $post_type,
                ],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});

add_filter('acf/validate_value/name=event_date', function (mixed $valid, mixed $value, array $field, mixed $input_name): mixed {
    if ($valid !== true || ! function_exists('get_field')) {
        return $valid;
    }

    $event_date = is_string($value) ? preg_replace('/\D+/', '', $value) : '';
    if ($event_date === '' || strlen($event_date) !== 8) {
        return $valid;
    }

    $current_post_id = 0;

    if (isset($_POST['_acf_post_id']) && is_string($_POST['_acf_post_id']) && str_starts_with($_POST['_acf_post_id'], 'post_')) {
        $current_post_id = (int) substr($_POST['_acf_post_id'], 5);
    }

    $query = new WP_Query([
        'post_type' => erotikava_get_event_post_type(),
        'post_status' => ['publish', 'draft', 'pending', 'future', 'private'],
        'posts_per_page' => 1,
        'post__not_in' => $current_post_id > 0 ? [$current_post_id] : [],
        'fields' => 'ids',
        'meta_query' => [
            [
                'key' => 'event_date',
                'value' => $event_date,
                'compare' => '=',
            ],
        ],
    ]);

    if ($query->have_posts()) {
        return '同じ日付のイベントがすでに登録されています。';
    }

    return $valid;
}, 10, 4);

if (! function_exists('erotikava_get_month_events')) {
    function erotikava_get_month_events(string $month_key): array
    {
        $defaults = erotikava_get_page_defaults('reservations');
        $events_by_day = [];

        if (erotikava_use_seed_defaults()) {
            foreach (($defaults['events'] ?? []) as $event) {
                $event_date = (string) ($event['date'] ?? '');
                if (! str_starts_with($event_date, substr($month_key, 0, 6))) {
                    continue;
                }

                $day = (int) substr($event_date, 6, 2);
                $events_by_day[$day] = $event;
            }

            return $events_by_day;
        }

        $year = (int) substr($month_key, 0, 4);
        $month = (int) substr($month_key, 4, 2);
        $month_start = $month_key . '01';
        $month_end = wp_date('Ymd', mktime(23, 59, 59, $month, (int) wp_date('t', mktime(0, 0, 0, $month, 1, $year)), $year));

        $query = new WP_Query([
            'post_type' => erotikava_get_event_post_type(),
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => 'event_date',
            'meta_query' => [
                [
                    'key' => 'event_date',
                    'value' => [$month_start, $month_end],
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC',
                ],
            ],
        ]);

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $event_date = (string) get_field('event_date', $post_id);
            if (strlen($event_date) !== 8) {
                continue;
            }

            $day = (int) substr($event_date, 6, 2);
            if (isset($events_by_day[$day])) {
                continue;
            }

            $events_by_day[$day] = [
                'date' => $event_date,
                'status' => (string) get_field('event_status', $post_id) ?: 'scheduled',
                'label' => (string) get_field('event_label', $post_id),
                'image_id' => (int) get_field('event_image', $post_id),
                'image_alt' => (string) get_field('event_image_alt', $post_id),
                'pending_note' => (string) (get_field('event_note', $post_id) ?: get_field('event_pending_note', $post_id)),
            ];
        }

        wp_reset_postdata();

        return $events_by_day;
    }
}

if (! function_exists('erotikava_render_event_calendar')) {
    function erotikava_render_event_calendar(int $post_id): void
    {
        $defaults = erotikava_get_page_defaults('reservations');
        $month_value = (string) erotikava_get_field_value('events_calendar_month', $defaults['events_calendar_month'] ?? '2026-07-01', $post_id);
        $timestamp = strtotime($month_value) ?: strtotime('2026-07-01');
        $year = (int) wp_date('Y', $timestamp);
        $month = (int) wp_date('n', $timestamp);
        $month_key = wp_date('Ym', $timestamp);
        $days_in_month = (int) wp_date('t', $timestamp);
        $first_weekday_index = (int) wp_date('N', $timestamp) - 1;
        $eyebrow = trim((string) erotikava_get_field_value('events_calendar_eyebrow', $defaults['events_calendar_eyebrow'] ?? '', $post_id));
        $title = trim((string) erotikava_get_field_value('events_calendar_title', $defaults['events_calendar_title'] ?? '', $post_id));
        $search_label = (string) erotikava_get_field_value('events_search_label', $defaults['events_search_label'] ?? 'イベント検索', $post_id);
        $placeholder = trim((string) erotikava_get_field_value('events_search_placeholder', $defaults['events_search_placeholder'] ?? '', $post_id));
        $default_label = (string) erotikava_get_field_value('events_default_label', $defaults['events_default_label'] ?? 'TBA', $post_id);
        $default_pending_note = (string) erotikava_get_field_value('events_default_pending_note', $defaults['events_default_pending_note'] ?? '出演情報調整中', $post_id);
        $eyebrow = $eyebrow !== '' ? $eyebrow : wp_date('F Y', $timestamp);
        $title = $title !== '' ? $title : sprintf('%d年%d月イベントカレンダー', $year, $month);
        $placeholder = $placeholder !== '' ? $placeholder : sprintf('例: %d/%d, %04d-%02d-%02d, Show, %s', $month, 14, $year, $month, 14, $default_label);
        $events_by_day = erotikava_get_month_events($month_key);
        $weekday_labels = ['月', '火', '水', '木', '金', '土', '日'];
        $title_markup = str_contains($title, '<br')
            ? wp_kses($title, ['br' => ['class' => true]])
            : nl2br(esc_html($title));
        ?>
        <p class="eyebrow center"><?php echo esc_html($eyebrow); ?></p>
        <h2 class="section-title"><?php echo $title_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
        <div class="event-search-panel">
          <label class="event-search-label" for="event-search-input"><?php echo esc_html($search_label); ?></label>
          <input id="event-search-input" class="event-search-input" type="search" placeholder="<?php echo esc_attr($placeholder); ?>" data-event-search-input>
          <p class="event-search-status" data-event-search-status><?php echo esc_html($days_in_month . '件表示中'); ?></p>
        </div>
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
              $status = (string) ($event['status'] ?? 'pending');
              $label = (string) ($event['label'] ?? '');
              $pending_note = (string) ($event['pending_note'] ?? $default_pending_note);
              ?>
              <?php if ($status === 'scheduled' && $event) : ?>
                <article class="calendar-event-card" data-event-date="<?php echo esc_attr($date_key); ?>" data-event-status="scheduled">
                  <div class="calendar-event-head">
                    <span class="calendar-event-date"><?php echo esc_html($date_display); ?></span>
                    <span class="calendar-event-label"><?php echo esc_html($label !== '' ? $label : 'Show'); ?></span>
                  </div>
                  <figure>
                    <?php
                    if (erotikava_use_seed_defaults()) {
                        echo erotikava_render_image(
                            0,
                            'large',
                            ['alt' => (string) ($event['image_alt'] ?? ($date_display . 'のイベント'))],
                            (string) ($event['image'] ?? ''),
                            (string) ($event['image_alt'] ?? ($date_display . 'のイベント'))
                        );
                    } else {
                        echo erotikava_render_image(
                            (int) ($event['image_id'] ?? 0),
                            'large',
                            ['alt' => (string) ($event['image_alt'] ?? ($date_display . 'のイベント'))],
                            '',
                            (string) ($event['image_alt'] ?? ($date_display . 'のイベント'))
                        );
                    }
                    ?>
                  </figure>
                </article>
              <?php else : ?>
                <article class="calendar-event-card is-pending" data-event-date="<?php echo esc_attr($date_key); ?>" data-event-status="pending">
                  <div class="calendar-event-head">
                    <span class="calendar-event-date"><?php echo esc_html($date_display); ?></span>
                    <span class="calendar-event-label"><?php echo esc_html($label !== '' ? $label : $default_label); ?></span>
                  </div>
                  <div class="calendar-pending-note"><?php echo esc_html($pending_note); ?></div>
                </article>
              <?php endif; ?>
            <?php endfor; ?>
          </div>
        </div>
        <?php
    }
}
