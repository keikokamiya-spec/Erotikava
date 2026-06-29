<?php

defined('ABSPATH') || exit;
$store = erotikava_get_store_data();
?>
  <footer class="site-footer">
    <div class="footer-inner">
      <div>
        <a class="footer-brand-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Erotikava トップ', 'erotikava-theme'); ?>"><span class="brand-logo footer-brand-logo">Erotikava</span></a>
        <p><?php echo esc_html($store['tagline']); ?></p>
        <?php erotikava_render_social_links('social-row'); ?>
      </div>
      <div>
        <h2><?php esc_html_e('サイトリンク', 'erotikava-theme'); ?></h2>
        <?php erotikava_render_footer_navigation(); ?>
      </div>
      <div>
        <h2><?php esc_html_e('お問い合わせ情報', 'erotikava-theme'); ?></h2>
        <?php erotikava_render_footer_contact(); ?>
      </div>
    </div>
    <p class="copyright"><?php echo esc_html($store['copyright']); ?></p>
  </footer>

  <div class="floating-social" aria-label="<?php esc_attr_e('SNSリンク', 'erotikava-theme'); ?>">
    <?php erotikava_render_floating_social_links(); ?>
  </div>
  <?php wp_footer(); ?>
</body>
</html>

