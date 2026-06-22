<?php
/*
Template Name: Event Calendar
*/

defined('ABSPATH') || exit;

get_header();
?>
<main>
    <section class="page-hero event-page-hero">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
        <?php else : ?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/event-hero.jpg'); ?>" alt="イベント・日程">
        <?php endif; ?>
        <div>
            <h1>イベント・日程</h1>
        </div>
    </section>

    <section class="section">
        <div class="section-inner">
            <p class="eyebrow center">Schedule</p>
            <h2 class="section-title">showスケジュール</h2>
            <?php
            $calendar_embed_url = get_field('google_calendar_embed_url');
            if ($calendar_embed_url) :
                ?>
                <iframe class="calendar-frame" src="<?php echo esc_url($calendar_embed_url); ?>" width="100%" height="600" frameborder="0" scrolling="yes" title="Erotikava showスケジュール"></iframe>
            <?php endif; ?>
            <div class="notice-lines">
                <p>日ごとの出演内容は下記の月間カレンダーをご確認ください。</p>
                <p>未掲載日のイベント画像は順次更新予定です。</p>
            </div>
        </div>
    </section>

    <section class="section gallery-section" id="event-calendar">
        <div class="section-inner">
            <?php erotikava_render_event_calendar(); ?>
        </div>
    </section>
</main>
<?php
get_footer();
