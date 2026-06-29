<?php
/*
Template Name: Reservations Page
*/

defined('ABSPATH') || exit;

$post_id = get_queried_object_id();
$hero = erotikava_get_page_hero_data('reservations', $post_id);
$defaults = erotikava_get_page_defaults('reservations');
$use_defaults = erotikava_use_seed_defaults();
$offer_eyebrow = (string) erotikava_get_field_value('events_offer_eyebrow', $use_defaults ? ($defaults['events_offer_eyebrow'] ?? '') : '', $post_id);
$offer_title = (string) erotikava_get_field_value('events_offer_title', $use_defaults ? ($defaults['events_offer_title'] ?? '') : '', $post_id);
$offer_description = (string) erotikava_get_field_value('events_offer_description', $use_defaults ? ($defaults['events_offer_description'] ?? '') : '', $post_id);
$store = erotikava_get_store_data();

get_header();
?>
<main>
  <section class="page-hero event-page-hero">
    <?php
    if ($use_defaults) {
        echo erotikava_render_image(0, 'full', ['alt' => $hero['image_alt']], $hero['fallback_image'], $hero['image_alt']);
    } else {
        echo erotikava_render_image($hero['image_id'], 'erotikava-hero', ['alt' => $hero['image_alt']], '', $hero['image_alt']);
    }
    ?>
    <div>
      <h1><?php echo esc_html($hero['title']); ?></h1>
    </div>
  </section>

  <section class="section gallery-section" id="event-calendar">
    <div class="section-inner">
      <?php erotikava_render_event_calendar($post_id); ?>
    </div>
  </section>

  <?php if ($offer_eyebrow !== '' || $offer_title !== '' || $offer_description !== '') : ?>
    <section class="section reservation-benefit">
      <div class="section-inner narrow center">
        <?php if ($offer_eyebrow !== '') : ?>
          <p class="eyebrow"><?php echo esc_html($offer_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($offer_title !== '') : ?>
          <h2><?php echo esc_html($offer_title); ?></h2>
        <?php endif; ?>
        <?php if ($offer_description !== '') : ?>
          <p><?php echo esc_html($offer_description); ?></p>
        <?php endif; ?>
        <a class="primary-button wide" href="<?php echo esc_url($store['phone_href']); ?>"><?php echo esc_html($store['phone_display']); ?></a>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php
get_footer();

