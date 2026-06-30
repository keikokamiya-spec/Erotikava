<?php
/*
Template Name: Profile Page
*/

defined('ABSPATH') || exit;

$post_id = get_queried_object_id();
$hero = erotikava_get_page_hero_data('profile', $post_id);
$defaults = erotikava_get_page_defaults('profile');
$use_defaults = erotikava_use_seed_defaults();
$limits = erotikava_get_content_limits();
$profile_intro_eyebrow = (string) erotikava_get_field_value('profile_intro_eyebrow', $use_defaults ? ($defaults['intro_eyebrow'] ?? '') : '', $post_id);
$profile_intro_title = (string) erotikava_get_field_value('profile_intro_title', $use_defaults ? ($defaults['intro_title'] ?? '') : '', $post_id);
$profile_intro_paragraphs = $use_defaults
    ? ($defaults['intro_paragraphs'] ?? [])
    : erotikava_collect_fixed_items((int) ($limits['profile_intro_paragraphs'] ?? 0), function (int $index) use ($post_id): array {
        return [
            'text' => (string) erotikava_get_field_value("profile_intro_paragraph_{$index}", '', $post_id),
        ];
    });
$profile_section_eyebrow = (string) erotikava_get_field_value('profile_section_eyebrow', $use_defaults ? ($defaults['section_eyebrow'] ?? '') : '', $post_id);
$profile_section_title = (string) erotikava_get_field_value('profile_section_title', $use_defaults ? ($defaults['section_title'] ?? '') : '', $post_id);
$profile_categories = $use_defaults
    ? ($defaults['categories'] ?? [])
    : erotikava_collect_fixed_items((int) ($limits['profile_categories'] ?? 0), function (int $index) use ($limits, $post_id): array {
        $images = erotikava_collect_fixed_items((int) ($limits['profile_category_images'] ?? 0), function (int $image_index) use ($index, $post_id): array {
            return [
                'image' => (int) erotikava_get_field_value("profile_category_{$index}_image_{$image_index}", 0, $post_id),
                'image_alt' => (string) erotikava_get_field_value("profile_category_{$index}_image_{$image_index}_alt", '', $post_id),
            ];
        });

        return [
            'category_eyebrow' => (string) erotikava_get_field_value("profile_category_{$index}_eyebrow", '', $post_id),
            'category_title' => (string) erotikava_get_field_value("profile_category_{$index}_title", '', $post_id),
            'category_images' => $images,
        ];
    });
$store = erotikava_get_store_data();

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

  <?php if ($profile_intro_paragraphs !== [] || $profile_intro_title !== '' || $profile_intro_eyebrow !== '') : ?>
    <section class="section">
      <div class="section-inner narrow center">
        <?php if ($profile_intro_eyebrow !== '') : ?>
          <p class="eyebrow center"><?php echo esc_html($profile_intro_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($profile_intro_title !== '') : ?>
          <h2 class="section-title"><?php echo esc_html($profile_intro_title); ?></h2>
        <?php endif; ?>
        <div class="notice-lines">
          <?php foreach ($profile_intro_paragraphs as $paragraph) : ?>
            <?php if (! empty($paragraph['text'])) : ?>
              <p><?php echo esc_html((string) $paragraph['text']); ?></p>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($profile_categories !== []) : ?>
    <section class="section gallery-section">
      <div class="section-inner">
        <?php if ($profile_section_eyebrow !== '') : ?>
          <p class="eyebrow center"><?php echo esc_html($profile_section_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($profile_section_title !== '') : ?>
          <h2 class="section-title"><?php echo esc_html($profile_section_title); ?></h2>
        <?php endif; ?>
        <?php foreach ($profile_categories as $category) : ?>
          <?php $images = is_array($category['category_images'] ?? null) ? $category['category_images'] : []; ?>
          <div class="profile-category">
            <?php if (! empty($category['category_eyebrow'])) : ?>
              <p class="eyebrow center"><?php echo esc_html((string) $category['category_eyebrow']); ?></p>
            <?php endif; ?>
            <?php if (! empty($category['category_title'])) : ?>
              <h3 class="profile-category-title"><?php echo esc_html((string) $category['category_title']); ?></h3>
            <?php endif; ?>
            <div class="photo-grid event-grid profile-grid">
              <?php foreach ($images as $image) : ?>
                <figure>
                  <?php
                  $image_alt = (string) ($image['image_alt'] ?? '');
                  if ($use_defaults) {
                      echo erotikava_render_image(0, 'full', ['alt' => $image_alt], (string) ($image['image'] ?? ''), $image_alt);
                  } else {
                      echo erotikava_render_image((int) ($image['image'] ?? 0), 'erotikava-card', ['alt' => $image_alt], '', $image_alt);
                  }
                  ?>
                </figure>
              <?php endforeach; ?>
            </div>
            <?php if ($images !== []) : ?>
              <div class="event-counter" data-profile-counter>1 / <?php echo esc_html(count($images)); ?></div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <section class="section">
    <div class="section-inner two-column">
      <div class="contact-panel">
        <p class="eyebrow">Store Data</p>
        <h2>店舗情報</h2>
        <dl class="info-list">
          <div><dt>店名</dt><dd><?php echo esc_html($store['name']); ?></dd></div>
          <div><dt>ジャンル</dt><dd><?php echo esc_html($store['genre_html']); ?></dd></div>
          <div><dt>所在地</dt><dd><?php echo esc_html($store['address']); ?></dd></div>
          <div><dt>TEL</dt><dd><a href="<?php echo esc_url($store['phone_href']); ?>"><?php echo esc_html($store['phone_display']); ?></a></dd></div>
          <div><dt>営業時間</dt><dd><?php echo wp_kses_post($store['hours_html']); ?></dd></div>
          <div><dt>アクセス</dt><dd><?php echo wp_kses_post($store['access_html']); ?></dd></div>
        </dl>
      </div>
      <?php echo erotikava_render_image(0, 'full', ['class' => 'section-image', 'alt' => $store['store_image_alt']], $store['store_image'], $store['store_image_alt']); ?>
    </div>
  </section>
</main>
<?php
get_footer();
