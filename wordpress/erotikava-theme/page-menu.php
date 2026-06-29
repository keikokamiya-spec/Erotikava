<?php
/*
Template Name: Menu Page
*/

defined('ABSPATH') || exit;

$post_id = get_queried_object_id();
$hero = erotikava_get_page_hero_data('menu', $post_id);
$defaults = erotikava_get_page_defaults('menu');
$use_defaults = erotikava_use_seed_defaults();
$menu_system_eyebrow = (string) erotikava_get_field_value('menu_system_eyebrow', $use_defaults ? ($defaults['system_eyebrow'] ?? '') : '', $post_id);
$menu_system_title = (string) erotikava_get_field_value('menu_system_title', $use_defaults ? ($defaults['system_title'] ?? '') : '', $post_id);
$menu_system_tabs = erotikava_get_repeater_value('menu_system_tabs', $use_defaults ? ($defaults['system_tabs'] ?? []) : [], $post_id);
$menu_vip_image_alt = (string) erotikava_get_field_value('menu_vip_image_alt', $use_defaults ? ($defaults['vip_image_alt'] ?? '') : '', $post_id);
$menu_vip_eyebrow = (string) erotikava_get_field_value('menu_vip_eyebrow', $use_defaults ? ($defaults['vip_eyebrow'] ?? '') : '', $post_id);
$menu_vip_title = (string) erotikava_get_field_value('menu_vip_title', $use_defaults ? ($defaults['vip_title'] ?? '') : '', $post_id);
$menu_vip_main_text = (string) erotikava_get_field_value('menu_vip_main_text', $use_defaults ? ($defaults['vip_main_text'] ?? '') : '', $post_id);
$menu_vip_campaign_text = (string) erotikava_get_field_value('menu_vip_campaign_text', $use_defaults ? ($defaults['vip_campaign_text'] ?? '') : '', $post_id);
$menu_vip_image = (int) erotikava_get_field_value('menu_vip_image', 0, $post_id);
$menu_shisha_eyebrow = (string) erotikava_get_field_value('menu_shisha_eyebrow', $use_defaults ? ($defaults['shisha_eyebrow'] ?? '') : '', $post_id);
$menu_shisha_title = (string) erotikava_get_field_value('menu_shisha_title', $use_defaults ? ($defaults['shisha_title'] ?? '') : '', $post_id);
$menu_shisha_content = erotikava_get_repeater_value('menu_shisha_content', $use_defaults ? ($defaults['shisha_content'] ?? []) : [], $post_id);
$menu_shisha_image = (int) erotikava_get_field_value('menu_shisha_image', 0, $post_id);
$menu_shisha_image_alt = (string) erotikava_get_field_value('menu_shisha_image_alt', $use_defaults ? ($defaults['shisha_image_alt'] ?? '') : '', $post_id);
$menu_food_eyebrow = (string) erotikava_get_field_value('menu_food_eyebrow', $use_defaults ? ($defaults['food_eyebrow'] ?? '') : '', $post_id);
$menu_food_title = (string) erotikava_get_field_value('menu_food_title', $use_defaults ? ($defaults['food_title'] ?? '') : '', $post_id);
$menu_food_images = erotikava_get_repeater_value('menu_food_images', $use_defaults ? ($defaults['food_images'] ?? []) : [], $post_id);
$menu_drink_eyebrow = (string) erotikava_get_field_value('menu_drink_eyebrow', $use_defaults ? ($defaults['drink_eyebrow'] ?? '') : '', $post_id);
$menu_drink_title = (string) erotikava_get_field_value('menu_drink_title', $use_defaults ? ($defaults['drink_title'] ?? '') : '', $post_id);
$menu_drink_main_image = (int) erotikava_get_field_value('menu_drink_main_image', 0, $post_id);
$menu_drink_main_image_alt = (string) erotikava_get_field_value('menu_drink_main_image_alt', $use_defaults ? ($defaults['drink_main_image_alt'] ?? '') : '', $post_id);
$menu_drink_featured_title = (string) erotikava_get_field_value('menu_drink_featured_title', $use_defaults ? ($defaults['drink_featured_title'] ?? '') : '', $post_id);
$menu_drink_description = (string) erotikava_get_field_value('menu_drink_description', $use_defaults ? ($defaults['drink_description'] ?? '') : '', $post_id);
$menu_drink_price_text = (string) erotikava_get_field_value('menu_drink_price_text', $use_defaults ? ($defaults['drink_price_text'] ?? '') : '', $post_id);
$menu_drink_types_text = (string) erotikava_get_field_value('menu_drink_types_text', $use_defaults ? ($defaults['drink_types_text'] ?? '') : '', $post_id);
$menu_drink_note = (string) erotikava_get_field_value('menu_drink_note', $use_defaults ? ($defaults['drink_note'] ?? '') : '', $post_id);
$menu_drink_gallery = erotikava_get_repeater_value('menu_drink_gallery', $use_defaults ? ($defaults['drink_gallery'] ?? []) : [], $post_id);

get_header();
?>
<main>
  <section class="page-hero">
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

  <?php if ($menu_system_tabs !== []) : ?>
    <section class="section">
      <div class="section-inner">
        <?php if ($menu_system_eyebrow !== '') : ?>
          <p class="eyebrow center"><?php echo esc_html($menu_system_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($menu_system_title !== '') : ?>
          <h2 class="section-title"><?php echo esc_html($menu_system_title); ?></h2>
        <?php endif; ?>
        <div class="tabs" data-tabs>
          <?php if (count($menu_system_tabs) > 1) : ?>
            <div class="tab-buttons" role="tablist" aria-label="料金システム">
              <?php foreach ($menu_system_tabs as $index => $tab) : ?>
                <?php $tab_key = 'tab-' . ($index + 1) . '-' . sanitize_title((string) ($tab['tab_label'] ?? 'tab')); ?>
                <button<?php echo $index === 0 ? ' class="is-active"' : ''; ?> type="button" role="tab" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>" data-tab-button="<?php echo esc_attr($tab_key); ?>"><?php echo esc_html((string) ($tab['tab_label'] ?? '')); ?></button>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php foreach ($menu_system_tabs as $index => $tab) : ?>
            <?php
            $tab_key = 'tab-' . ($index + 1) . '-' . sanitize_title((string) ($tab['tab_label'] ?? 'tab'));
            $images = is_array($tab['tab_images'] ?? null) ? $tab['tab_images'] : [];
            ?>
            <div class="tab-panel<?php echo $index === 0 ? ' is-active' : ''; ?>" data-tab-panel="<?php echo esc_attr($tab_key); ?>">
              <div class="plan-image-grid">
                <?php foreach ($images as $image) : ?>
                  <figure class="plan-image-card<?php echo count($images) === 1 ? ' single-plan-image-card' : ''; ?>">
                    <?php
                    $image_alt = (string) ($image['image_alt'] ?? '');
                    if ($use_defaults) {
                        echo erotikava_render_image(0, 'full', ['alt' => $image_alt, 'loading' => 'lazy', 'decoding' => 'async'], (string) ($image['image'] ?? ''), $image_alt);
                    } else {
                        echo erotikava_render_image((int) ($image['image'] ?? 0), 'full', ['alt' => $image_alt, 'loading' => 'lazy', 'decoding' => 'async'], '', $image_alt);
                    }
                    ?>
                  </figure>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($menu_vip_title !== '' || $menu_vip_main_text !== '') : ?>
    <section class="section">
      <div class="section-inner two-column">
        <?php
        if ($use_defaults) {
            echo erotikava_render_image(0, 'full', ['class' => 'section-image', 'alt' => $menu_vip_image_alt], (string) ($defaults['vip_image'] ?? ''), $menu_vip_image_alt);
        } else {
            echo erotikava_render_image($menu_vip_image, 'erotikava-card', ['class' => 'section-image', 'alt' => $menu_vip_image_alt], '', $menu_vip_image_alt);
        }
        ?>
        <div>
          <?php if ($menu_vip_eyebrow !== '') : ?>
            <p class="eyebrow"><?php echo esc_html($menu_vip_eyebrow); ?></p>
          <?php endif; ?>
          <?php if ($menu_vip_title !== '') : ?>
            <h2><?php echo esc_html($menu_vip_title); ?></h2>
          <?php endif; ?>
          <?php if ($menu_vip_main_text !== '') : ?>
            <p class="large-text"><?php echo esc_html($menu_vip_main_text); ?></p>
          <?php endif; ?>
          <?php if ($menu_vip_campaign_text !== '') : ?>
            <p class="campaign"><?php echo esc_html($menu_vip_campaign_text); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($menu_shisha_content !== [] || $menu_shisha_title !== '') : ?>
    <section class="section shisha-section">
      <div class="section-inner two-column reverse-mobile">
        <div>
          <?php if ($menu_shisha_eyebrow !== '') : ?>
            <p class="eyebrow"><?php echo esc_html($menu_shisha_eyebrow); ?></p>
          <?php endif; ?>
          <?php if ($menu_shisha_title !== '') : ?>
            <h2><?php echo esc_html($menu_shisha_title); ?></h2>
          <?php endif; ?>
          <?php foreach ($menu_shisha_content as $row) : ?>
            <?php if (! empty($row['text'])) : ?>
              <p<?php echo ! empty($row['style']) && $row['style'] !== 'normal' ? ' class="' . esc_attr((string) $row['style']) . '"' : ''; ?>><?php echo esc_html((string) $row['text']); ?></p>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <?php
        if ($use_defaults) {
            echo erotikava_render_image(0, 'full', ['class' => 'section-image section-image-contain', 'alt' => $menu_shisha_image_alt], (string) ($defaults['shisha_image'] ?? ''), $menu_shisha_image_alt);
        } else {
            echo erotikava_render_image($menu_shisha_image, 'erotikava-card', ['class' => 'section-image section-image-contain', 'alt' => $menu_shisha_image_alt], '', $menu_shisha_image_alt);
        }
        ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($menu_food_images !== []) : ?>
    <section class="section">
      <div class="section-inner">
        <?php if ($menu_food_eyebrow !== '') : ?>
          <p class="eyebrow center"><?php echo esc_html($menu_food_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($menu_food_title !== '') : ?>
          <h2 class="section-title"><?php echo esc_html($menu_food_title); ?></h2>
        <?php endif; ?>
        <div class="food-menu-board-grid">
          <?php foreach ($menu_food_images as $image) : ?>
            <figure>
              <?php
              $image_alt = (string) ($image['image_alt'] ?? '');
              if ($use_defaults) {
                  echo erotikava_render_image(0, 'full', ['alt' => $image_alt], (string) ($image['image'] ?? ''), $image_alt);
              } else {
                  echo erotikava_render_image((int) ($image['image'] ?? 0), 'full', ['alt' => $image_alt], '', $image_alt);
              }
              ?>
            </figure>
          <?php endforeach; ?>
        </div>
        <div class="food-menu-counter" data-food-menu-counter>1 / <?php echo esc_html(count($menu_food_images)); ?></div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($menu_drink_featured_title !== '' || $menu_drink_gallery !== []) : ?>
    <section class="section drink-section">
      <div class="section-inner">
        <?php if ($menu_drink_eyebrow !== '') : ?>
          <p class="eyebrow center"><?php echo esc_html($menu_drink_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($menu_drink_title !== '') : ?>
          <h2 class="section-title"><?php echo esc_html($menu_drink_title); ?></h2>
        <?php endif; ?>
        <div class="two-column">
          <?php
          if ($use_defaults) {
              echo erotikava_render_image(0, 'full', ['class' => 'section-image section-image-cocktail', 'alt' => $menu_drink_main_image_alt], (string) ($defaults['drink_main_image'] ?? ''), $menu_drink_main_image_alt);
          } else {
              echo erotikava_render_image($menu_drink_main_image, 'erotikava-card', ['class' => 'section-image section-image-cocktail', 'alt' => $menu_drink_main_image_alt], '', $menu_drink_main_image_alt);
          }
          ?>
          <div>
            <?php if ($menu_drink_featured_title !== '' || $menu_drink_price_text !== '') : ?>
              <p class="large-text">
                <?php echo esc_html($menu_drink_featured_title); ?>
                <?php if ($menu_drink_featured_title !== '' && $menu_drink_price_text !== '') : ?>
                  <span class="mobile-break"><br></span>
                <?php endif; ?>
                <?php echo esc_html($menu_drink_price_text); ?>
              </p>
            <?php endif; ?>
            <?php if ($menu_drink_description !== '') : ?>
              <p><?php echo wp_kses_post(erotikava_multiline_text($menu_drink_description)); ?></p>
            <?php endif; ?>
            <?php if ($menu_drink_types_text !== '') : ?>
              <p><?php echo wp_kses_post(erotikava_multiline_text($menu_drink_types_text)); ?></p>
            <?php endif; ?>
            <?php if ($menu_drink_note !== '') : ?>
              <p><?php echo wp_kses_post(erotikava_multiline_text($menu_drink_note)); ?></p>
            <?php endif; ?>
          </div>
        </div>
        <div class="photo-grid menu-image-grid">
          <?php foreach ($menu_drink_gallery as $image) : ?>
            <figure>
              <?php
              $image_alt = (string) ($image['image_alt'] ?? '');
              if ($use_defaults) {
                  echo erotikava_render_image(0, 'full', ['alt' => $image_alt], (string) ($image['image'] ?? ''), $image_alt);
              } else {
                  echo erotikava_render_image((int) ($image['image'] ?? 0), 'full', ['alt' => $image_alt], '', $image_alt);
              }
              ?>
            </figure>
          <?php endforeach; ?>
        </div>
        <div class="drink-menu-counter" data-drink-menu-counter>1 / <?php echo esc_html(count($menu_drink_gallery)); ?></div>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php
get_footer();
