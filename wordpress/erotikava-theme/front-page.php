<?php

defined('ABSPATH') || exit;

$post_id = get_queried_object_id();
$defaults = erotikava_get_page_defaults('home');
$use_defaults = erotikava_use_seed_defaults();
$limits = erotikava_get_content_limits();
$hero_slides = $use_defaults
    ? ($defaults['hero_slides'] ?? [])
    : erotikava_collect_fixed_items((int) ($limits['home_hero_slides'] ?? 0), function (int $index) use ($limits, $post_id): array {
        $caption_lines = erotikava_collect_fixed_items((int) ($limits['home_hero_caption_lines'] ?? 0), function (int $line_index) use ($index, $post_id): array {
            return [
                'text' => (string) erotikava_get_field_value("home_hero_slide_{$index}_caption_{$line_index}", '', $post_id),
            ];
        });

        return [
            'image' => (int) erotikava_get_field_value("home_hero_slide_{$index}_image", 0, $post_id),
            'mobile_image' => (int) erotikava_get_field_value("home_hero_slide_{$index}_mobile_image", 0, $post_id),
            'image_alt' => (string) erotikava_get_field_value("home_hero_slide_{$index}_image_alt", '', $post_id),
            'caption_lines' => $caption_lines,
            'link' => erotikava_get_link_value("home_hero_slide_{$index}_link", [], $post_id),
        ];
    });
$home_intro_title = (string) erotikava_get_field_value('home_intro_title', $use_defaults ? ($defaults['intro_title'] ?? '') : '', $post_id);
$home_intro_lead = (string) erotikava_get_field_value('home_intro_lead', $use_defaults ? ($defaults['intro_lead'] ?? '') : '', $post_id);
$home_intro_hours_badge = (string) erotikava_get_field_value('home_intro_hours_badge', $use_defaults ? ($defaults['intro_hours_badge'] ?? '') : '', $post_id);
$home_intro_cta_text = (string) erotikava_get_field_value('home_intro_cta_text', $use_defaults ? ($defaults['intro_cta_text'] ?? '') : '', $post_id);
$home_intro_cta_link = erotikava_get_link_value('home_intro_cta_link', $use_defaults ? erotikava_make_link_value(erotikava_get_page_url('reservations') . '#event-calendar', $home_intro_cta_text) : [], $post_id);
$home_features = $use_defaults
    ? ($defaults['features'] ?? [])
    : erotikava_collect_fixed_items((int) ($limits['home_features'] ?? 0), function (int $index) use ($post_id): array {
        return [
            'card_type' => (string) erotikava_get_field_value("home_feature_{$index}_card_type", '', $post_id),
            'image' => (int) erotikava_get_field_value("home_feature_{$index}_image", 0, $post_id),
            'image_alt' => (string) erotikava_get_field_value("home_feature_{$index}_image_alt", '', $post_id),
            'title' => (string) erotikava_get_field_value("home_feature_{$index}_title", '', $post_id),
            'description' => (string) erotikava_get_field_value("home_feature_{$index}_description", '', $post_id),
        ];
    });
$home_concept_eyebrow = (string) erotikava_get_field_value('home_concept_eyebrow', $use_defaults ? ($defaults['concept_eyebrow'] ?? '') : '', $post_id);
$home_concept_title = (string) erotikava_get_field_value('home_concept_title', $use_defaults ? ($defaults['concept_title'] ?? '') : '', $post_id);
$home_concept_text = (string) erotikava_get_field_value('home_concept_text', $use_defaults ? ($defaults['concept_text'] ?? '') : '', $post_id);
$home_concept_image = (int) erotikava_get_field_value('home_concept_image', 0, $post_id);
$home_concept_image_alt = (string) erotikava_get_field_value('home_concept_image_alt', $use_defaults ? ($defaults['concept_image_alt'] ?? '') : '', $post_id);
$home_gallery_eyebrow = (string) erotikava_get_field_value('home_gallery_eyebrow', $use_defaults ? ($defaults['gallery_eyebrow'] ?? '') : '', $post_id);
$home_gallery_title = (string) erotikava_get_field_value('home_gallery_title', $use_defaults ? ($defaults['gallery_title'] ?? '') : '', $post_id);
$home_gallery_images = $use_defaults
    ? ($defaults['gallery_images'] ?? [])
    : erotikava_collect_fixed_items((int) ($limits['home_gallery_images'] ?? 0), function (int $index) use ($post_id): array {
        return [
            'image' => (int) erotikava_get_field_value("home_gallery_image_{$index}", 0, $post_id),
            'image_alt' => (string) erotikava_get_field_value("home_gallery_image_{$index}_alt", '', $post_id),
        ];
    });
$home_news_eyebrow = (string) erotikava_get_field_value('home_news_eyebrow', $use_defaults ? ($defaults['news_eyebrow'] ?? '') : '', $post_id);
$home_news_title = (string) erotikava_get_field_value('home_news_title', $use_defaults ? ($defaults['news_title'] ?? '') : '', $post_id);
$home_news_items = $use_defaults
    ? ($defaults['news_items'] ?? [])
    : erotikava_collect_fixed_items((int) ($limits['home_news_items'] ?? 0), function (int $index) use ($post_id): array {
        return [
            'image' => (int) erotikava_get_field_value("home_news_item_{$index}_image", 0, $post_id),
            'image_alt' => (string) erotikava_get_field_value("home_news_item_{$index}_image_alt", '', $post_id),
            'link' => erotikava_get_link_value("home_news_item_{$index}_link", [], $post_id),
            'open_new_tab' => (bool) erotikava_get_field_value("home_news_item_{$index}_open_new_tab", false, $post_id),
        ];
    });
$store = erotikava_get_store_data();

get_header();
?>
<main>
  <?php if ($hero_slides !== []) : ?>
    <section class="hero-slider" aria-label="Erotikava メインビジュアル" data-hero-slider>
      <?php foreach ($hero_slides as $index => $slide) : ?>
        <?php
        $slide_link = is_array($slide['link'] ?? null) ? $slide['link'] : [];
        $slide_has_link = ! empty($slide_link['url']);
        $slide_alt = (string) ($slide['image_alt'] ?? '');
        $mobile_image = $slide['mobile_image'] ?? '';
        ?>
        <div class="hero-slide<?php echo $index === 0 ? ' is-active' : ''; ?>">
          <?php if ($slide_has_link) : ?>
            <a class="hero-slide-link" <?php echo erotikava_get_link_attrs($slide_link, ($slide_link['target'] ?? '') === '_blank'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
          <?php endif; ?>
          <picture>
            <?php if ($use_defaults && is_string($mobile_image) && $mobile_image !== '') : ?>
              <source media="(max-width: 767px)" srcset="<?php echo esc_url(erotikava_asset_url_for_relative_path($mobile_image)); ?>">
            <?php elseif (! $use_defaults && (int) $mobile_image > 0) : ?>
              <source media="(max-width: 767px)" srcset="<?php echo esc_url((string) wp_get_attachment_image_url((int) $mobile_image, 'large')); ?>">
            <?php endif; ?>
            <?php
            if ($use_defaults) {
                echo erotikava_render_image(0, 'full', ['alt' => $slide_alt], (string) ($slide['image'] ?? ''), $slide_alt);
            } else {
                echo erotikava_render_image((int) ($slide['image'] ?? 0), 'erotikava-hero', ['alt' => $slide_alt], '', $slide_alt);
            }
            ?>
          </picture>
          <div class="hero-caption">
            <?php foreach (($slide['caption_lines'] ?? []) as $line) : ?>
              <span class="hero-caption-line"><?php echo esc_html((string) ($line['text'] ?? '')); ?></span>
            <?php endforeach; ?>
          </div>
          <?php if ($slide_has_link) : ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <button class="hero-arrow hero-prev" type="button" data-hero-prev aria-label="前のスライド">‹</button>
      <button class="hero-arrow hero-next" type="button" data-hero-next aria-label="次のスライド">›</button>
      <div class="hero-dots" data-hero-dots aria-label="スライド選択"></div>
    </section>
  <?php endif; ?>

  <?php if ($home_intro_title !== '' || $home_intro_lead !== '' || $home_intro_cta_text !== '') : ?>
    <section class="section intro-section">
      <div class="section-inner narrow center">
        <?php if ($home_intro_title !== '') : ?>
          <h1><?php echo esc_html($home_intro_title); ?></h1>
        <?php endif; ?>
        <?php if ($home_intro_lead !== '') : ?>
          <p class="lead"><?php echo esc_html($home_intro_lead); ?></p>
        <?php endif; ?>
        <?php if ($home_intro_hours_badge !== '') : ?>
          <input class="hours-badge hours-badge-input" type="text" value="<?php echo esc_attr($home_intro_hours_badge); ?>" aria-label="営業時間">
        <?php endif; ?>
        <?php if ($home_intro_cta_text !== '') : ?>
          <?php if (is_array($home_intro_cta_link) && ! empty($home_intro_cta_link['url'])) : ?>
            <a class="primary-button" <?php echo erotikava_get_link_attrs($home_intro_cta_link); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html($home_intro_cta_text); ?></a>
          <?php else : ?>
            <span class="primary-button"><?php echo esc_html($home_intro_cta_text); ?></span>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($home_features !== []) : ?>
    <section class="section feature-section">
      <div class="section-inner">
        <div class="feature-grid">
          <?php foreach ($home_features as $feature) : ?>
            <?php
            $card_type = (string) ($feature['card_type'] ?? 'text_background');
            $title = (string) ($feature['title'] ?? '');
            $description = (string) ($feature['description'] ?? '');
            $image_alt = (string) ($feature['image_alt'] ?? '');
            $card_classes = 'feature-card';
            if ($card_type === 'image_only') {
                $card_classes .= ' feature-card-media-only';
            } else {
                $card_classes .= ' feature-card-has-bg';
            }
            $background_url = '';
            if ($card_type !== 'image_only') {
                if ($use_defaults) {
                    $background_url = erotikava_asset_url_for_relative_path((string) ($feature['image'] ?? ''));
                } else {
                    $image_id = (int) ($feature['image'] ?? 0);
                    $background_url = $image_id > 0 ? wp_get_attachment_image_url($image_id, 'large') : '';
                }
            }
            ?>
            <article class="<?php echo esc_attr($card_classes); ?>"<?php echo $background_url !== '' ? ' style="' . esc_attr(erotikava_background_style($background_url)) . '"' : ''; ?>>
              <?php if ($card_type === 'image_only') : ?>
                <?php
                if ($use_defaults) {
                    echo erotikava_render_image(0, 'full', ['class' => 'feature-card-image', 'alt' => $image_alt], (string) ($feature['image'] ?? ''), $image_alt);
                } else {
                    echo erotikava_render_image((int) ($feature['image'] ?? 0), 'erotikava-card', ['class' => 'feature-card-image', 'alt' => $image_alt], '', $image_alt);
                }
                ?>
              <?php else : ?>
                <?php if ($title !== '') : ?>
                  <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($description !== '') : ?>
                  <p><?php echo esc_html($description); ?></p>
                <?php endif; ?>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($home_concept_eyebrow !== '' || $home_concept_title !== '' || $home_concept_text !== '') : ?>
    <section class="section concept-section">
      <div class="section-inner two-column">
        <div>
          <?php if ($home_concept_eyebrow !== '') : ?>
            <p class="eyebrow"><?php echo esc_html($home_concept_eyebrow); ?></p>
          <?php endif; ?>
          <?php if ($home_concept_title !== '') : ?>
            <h2><?php echo esc_html($home_concept_title); ?></h2>
          <?php endif; ?>
          <?php if ($home_concept_text !== '') : ?>
            <div><?php echo $use_defaults ? wpautop(esc_html($home_concept_text)) : wp_kses_post(wpautop($home_concept_text)); ?></div>
          <?php endif; ?>
        </div>
        <?php
        if ($use_defaults) {
            echo erotikava_render_image(0, 'full', ['class' => 'section-image', 'alt' => $home_concept_image_alt], (string) ($defaults['concept_image'] ?? ''), $home_concept_image_alt);
        } else {
            echo erotikava_render_image($home_concept_image, 'erotikava-card', ['class' => 'section-image', 'alt' => $home_concept_image_alt], '', $home_concept_image_alt);
        }
        ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($home_gallery_images !== []) : ?>
    <section class="section gallery-section">
      <div class="section-inner">
        <?php if ($home_gallery_eyebrow !== '') : ?>
          <p class="eyebrow center"><?php echo esc_html($home_gallery_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($home_gallery_title !== '') : ?>
          <h2 class="section-title"><?php echo esc_html($home_gallery_title); ?></h2>
        <?php endif; ?>
        <div class="photo-grid gallery-grid store-gallery-grid">
          <?php foreach ($home_gallery_images as $image) : ?>
            <figure>
              <?php
              $image_alt = (string) ($image['image_alt'] ?? '');
              if ($use_defaults) {
                  echo erotikava_render_image(0, 'full', ['alt' => $image_alt], (string) ($image['image'] ?? ''), $image_alt);
              } else {
                  echo erotikava_render_image((int) ($image['image'] ?? 0), 'erotikava-portrait', ['alt' => $image_alt], '', $image_alt);
              }
              ?>
            </figure>
          <?php endforeach; ?>
        </div>
        <div class="gallery-counter" data-gallery-counter>1 / <?php echo esc_html(count($home_gallery_images)); ?></div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($home_news_items !== []) : ?>
    <section class="section news-section">
      <div class="section-inner">
        <div class="section-heading-row">
          <div>
            <?php if ($home_news_eyebrow !== '') : ?>
              <p class="eyebrow"><?php echo esc_html($home_news_eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($home_news_title !== '') : ?>
              <h2><?php echo esc_html($home_news_title); ?></h2>
            <?php endif; ?>
          </div>
        </div>
        <div class="news-slider" data-card-slider>
          <?php foreach ($home_news_items as $item) : ?>
            <?php
            $image_alt = (string) ($item['image_alt'] ?? '');
            $link = is_array($item['link'] ?? null) ? $item['link'] : [];
            $new_tab = ! empty($item['open_new_tab']);
            ?>
            <article class="news-card">
              <?php if (! empty($link['url'])) : ?>
                <a class="news-card-link" <?php echo erotikava_get_link_attrs($link, $new_tab); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
              <?php endif; ?>
              <?php
              if ($use_defaults) {
                  echo erotikava_render_image(0, 'full', ['alt' => $image_alt], (string) ($item['image'] ?? ''), $image_alt);
              } else {
                  echo erotikava_render_image((int) ($item['image'] ?? 0), 'erotikava-card', ['alt' => $image_alt], '', $image_alt);
              }
              ?>
              <?php if (! empty($link['url'])) : ?>
                </a>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>
        <div class="news-controls-row">
          <button type="button" class="news-control-button" data-scroll-prev aria-label="前へ">‹</button>
          <div class="news-counter" data-news-counter>1 / <?php echo esc_html(count($home_news_items)); ?></div>
          <button type="button" class="news-control-button" data-scroll-next aria-label="次へ">›</button>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="section access-section" id="contact">
    <div class="section-inner two-column">
      <div class="contact-panel">
        <p class="eyebrow">Access</p>
        <h2>アクセス・お問い合わせ</h2>
        <dl class="info-list">
          <div><dt>店名</dt><dd><?php echo esc_html($store['name']); ?></dd></div>
          <div><dt>内容</dt><dd><?php echo esc_html($store['content_html']); ?></dd></div>
          <div><dt>住所</dt><dd><?php echo esc_html($store['address']); ?></dd></div>
          <div><dt>TEL</dt><dd><a href="<?php echo esc_url($store['phone_href']); ?>"><?php echo esc_html($store['phone_display']); ?></a></dd></div>
          <div><dt>営業時間</dt><dd><?php echo wp_kses_post($store['hours_html']); ?></dd></div>
          <div><dt>アクセス</dt><dd><?php echo wp_kses_post($store['access_html']); ?></dd></div>
          <div><dt>お支払い</dt><dd><?php echo esc_html($store['payment_html']); ?></dd></div>
        </dl>
      </div>
      <iframe class="map-frame" src="<?php echo esc_url($store['map_embed_url']); ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Erotikava Google Maps"></iframe>
    </div>
  </section>
</main>
<?php
get_footer();
