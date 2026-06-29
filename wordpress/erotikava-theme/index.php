<?php

defined('ABSPATH') || exit;

get_header();
?>
<main>
  <section class="section">
    <div class="section-inner narrow center">
      <p class="eyebrow center">Erotikava</p>
      <h1><?php echo esc_html(get_the_title(get_queried_object_id()) ?: get_bloginfo('name')); ?></h1>
      <?php if (have_posts()) : ?>
        <div class="notice-lines">
          <?php
          while (have_posts()) :
              the_post();
              the_content();
          endwhile;
          ?>
        </div>
      <?php else : ?>
        <p><?php esc_html_e('表示できるコンテンツがありません。', 'erotikava-theme'); ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();

