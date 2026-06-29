<?php

defined('ABSPATH') || exit;

define('EROTIKAVA_THEME_VERSION', '1.0.0');
define('EROTIKAVA_THEME_DIR', get_template_directory());
define('EROTIKAVA_THEME_URI', get_template_directory_uri());
define('EROTIKAVA_REMOTE_SITE_URL', 'https://keikokamiya-spec.github.io/Erotikava/');

require_once EROTIKAVA_THEME_DIR . '/inc/helpers.php';
require_once EROTIKAVA_THEME_DIR . '/inc/store-data.php';
require_once EROTIKAVA_THEME_DIR . '/inc/event-post-type.php';
require_once EROTIKAVA_THEME_DIR . '/inc/acf-fields.php';
require_once EROTIKAVA_THEME_DIR . '/inc/initial-content.php';

add_action('after_setup_theme', function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support(
        'html5',
        ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']
    );

    register_nav_menus([
        'primary' => __('Primary Navigation', 'erotikava-theme'),
    ]);

    add_image_size('erotikava-hero', 1600, 900, true);
    add_image_size('erotikava-card', 900, 700, true);
    add_image_size('erotikava-portrait', 700, 1000, false);
});

add_action('wp_enqueue_scripts', function (): void {
    $font_url = 'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Noto+Serif+JP:wght@400;500;700;900&family=Shippori+Mincho:wght@500;600;700;800&family=Zen+Kaku+Gothic+Antique:wght@500;700&display=swap';
    $main_css = EROTIKAVA_THEME_DIR . '/assets/css/main.css';
    $main_js = EROTIKAVA_THEME_DIR . '/assets/js/main.js';

    wp_enqueue_style('erotikava-fonts', $font_url, [], null);
    wp_enqueue_style(
        'erotikava-main',
        erotikava_theme_asset_uri('css/main.css'),
        ['erotikava-fonts'],
        file_exists($main_css) ? (string) filemtime($main_css) : EROTIKAVA_THEME_VERSION
    );
    wp_add_inline_style(
        'erotikava-main',
        ':root{' .
        '--erotikava-body-bg:url("' . esc_url(erotikava_asset_url_for_relative_path('background.jpg')) . '");' .
        '--erotikava-intro-bg:url("' . esc_url(erotikava_asset_url_for_relative_path('img/setb/j.jpg')) . '");' .
        '--erotikava-feature-default-bg:url("' . esc_url(erotikava_asset_url_for_relative_path('img/setc/b.jpg')) . '");' .
        '}'
    );
    wp_enqueue_script(
        'erotikava-main',
        erotikava_theme_asset_uri('js/main.js'),
        [],
        file_exists($main_js) ? (string) filemtime($main_js) : EROTIKAVA_THEME_VERSION,
        true
    );
});

add_filter('acf/settings/save_json', function (string $path): string {
    return EROTIKAVA_THEME_DIR . '/acf-json';
});

add_filter('acf/settings/load_json', function (array $paths): array {
    $paths[] = EROTIKAVA_THEME_DIR . '/acf-json';
    return array_values(array_unique($paths));
});

add_action('admin_notices', function (): void {
    if (! current_user_can('activate_plugins') || function_exists('get_field')) {
        return;
    }

    printf(
        '<div class="notice notice-warning"><p>%s</p></div>',
        esc_html__('Erotikava Theme requires ACF PRO for editable page content and event management. The front-end still uses static fallback content until ACF is activated.', 'erotikava-theme')
    );
});

add_filter('pre_get_document_title', function (string $title): string {
    return erotikava_get_seo_title($title);
});

add_action('wp_head', function (): void {
    $description = erotikava_get_seo_description();

    if ($description === '') {
        return;
    }

    printf(
        "<meta name=\"description\" content=\"%s\">\n",
        esc_attr($description)
    );
}, 1);
