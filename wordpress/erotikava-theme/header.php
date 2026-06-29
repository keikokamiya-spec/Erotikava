<?php

defined('ABSPATH') || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <header class="site-header" data-header>
    <a class="logo-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Erotikava トップ', 'erotikava-theme'); ?>">
      <span class="brand-logo">Erotikava</span>
    </a>
    <button class="menu-toggle" type="button" data-menu-toggle aria-label="<?php esc_attr_e('メニューを開く', 'erotikava-theme'); ?>" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
    <nav class="site-nav" data-nav>
      <?php erotikava_render_primary_navigation(); ?>
    </nav>
  </header>

