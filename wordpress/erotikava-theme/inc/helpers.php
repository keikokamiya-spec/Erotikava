<?php

defined('ABSPATH') || exit;

if (! function_exists('erotikava_theme_asset_uri')) {
    function erotikava_theme_asset_uri(string $path = ''): string
    {
        $path = ltrim($path, '/');
        return EROTIKAVA_THEME_URI . '/assets/' . $path;
    }
}

if (! function_exists('erotikava_theme_asset_path')) {
    function erotikava_theme_asset_path(string $path = ''): string
    {
        $path = ltrim($path, '/');
        return EROTIKAVA_THEME_DIR . '/assets/' . $path;
    }
}

if (! function_exists('erotikava_remote_asset_url')) {
    function erotikava_remote_asset_url(string $relative_path): string
    {
        $relative_path = ltrim($relative_path, '/');

        if (str_starts_with($relative_path, 'img/')) {
            return trailingslashit(EROTIKAVA_REMOTE_SITE_URL) . $relative_path;
        }

        return trailingslashit(EROTIKAVA_REMOTE_SITE_URL) . 'images/' . $relative_path;
    }
}

if (! function_exists('erotikava_get_page_url')) {
    function erotikava_get_page_url(string $slug): string
    {
        if ($slug === 'home') {
            return home_url('/');
        }

        $page = get_page_by_path($slug);

        if ($page instanceof WP_Post) {
            return get_permalink($page);
        }

        return home_url('/' . trim($slug, '/') . '/');
    }
}

if (! function_exists('erotikava_get_nav_fallback_items')) {
    function erotikava_get_nav_fallback_items(): array
    {
        return [
            ['title' => 'トップ', 'url' => erotikava_get_page_url('home')],
            ['title' => 'イベント・日程', 'url' => erotikava_get_page_url('reservations')],
            ['title' => 'プロフィール', 'url' => erotikava_get_page_url('profile')],
            ['title' => 'メニュー・料金', 'url' => erotikava_get_page_url('menu')],
        ];
    }
}

if (! function_exists('erotikava_get_primary_navigation_items')) {
    function erotikava_get_primary_navigation_items(): array
    {
        $locations = get_nav_menu_locations();
        $location_id = $locations['primary'] ?? 0;

        if (! $location_id) {
            return erotikava_get_nav_fallback_items();
        }

        $items = wp_get_nav_menu_items($location_id);

        if (! is_array($items) || $items === []) {
            return erotikava_get_nav_fallback_items();
        }

        $links = [];

        foreach ($items as $item) {
            if (! $item instanceof WP_Post) {
                continue;
            }

            $links[] = [
                'title' => $item->title,
                'url' => $item->url,
            ];
        }

        return $links !== [] ? $links : erotikava_get_nav_fallback_items();
    }
}

if (! function_exists('erotikava_render_primary_navigation')) {
    function erotikava_render_primary_navigation(): void
    {
        foreach (erotikava_get_primary_navigation_items() as $item) {
            printf(
                '<a href="%1$s">%2$s</a>',
                esc_url((string) $item['url']),
                esc_html((string) $item['title'])
            );
        }
    }
}

if (! function_exists('erotikava_render_footer_navigation')) {
    function erotikava_render_footer_navigation(): void
    {
        foreach (erotikava_get_nav_fallback_items() as $item) {
            printf(
                '<a href="%1$s">%2$s</a>',
                esc_url((string) $item['url']),
                esc_html((string) $item['title'])
            );
        }
    }
}

if (! function_exists('erotikava_use_seed_defaults')) {
    function erotikava_use_seed_defaults(): bool
    {
        return ! function_exists('get_field') || ! (bool) get_option('erotikava_initial_content_imported');
    }
}

if (! function_exists('erotikava_get_field_value')) {
    function erotikava_get_field_value(string $field_name, mixed $default = '', int|string|null $post_id = null): mixed
    {
        if (erotikava_use_seed_defaults()) {
            return $default;
        }

        if (! function_exists('get_field')) {
            return $default;
        }

        $value = get_field($field_name, $post_id ?: false);

        if ($value === null || $value === false || $value === '') {
            return $default;
        }

        if (is_array($value) && $value === []) {
            return $default;
        }

        return $value;
    }
}

if (! function_exists('erotikava_get_repeater_value')) {
    function erotikava_get_repeater_value(string $field_name, array $default = [], int|string|null $post_id = null): array
    {
        $value = erotikava_get_field_value($field_name, $default, $post_id);
        return is_array($value) ? $value : $default;
    }
}

if (! function_exists('erotikava_get_link_value')) {
    function erotikava_get_link_value(string $field_name, array $default = [], int|string|null $post_id = null): array
    {
        $value = erotikava_get_field_value($field_name, $default, $post_id);
        return is_array($value) ? $value : $default;
    }
}

if (! function_exists('erotikava_get_content_limits')) {
    function erotikava_get_content_limits(): array
    {
        return [
            'home_hero_slides' => 5,
            'home_hero_caption_lines' => 5,
            'home_features' => 6,
            'home_gallery_images' => 12,
            'home_news_items' => 8,
            'profile_intro_paragraphs' => 6,
            'profile_categories' => 4,
            'profile_category_images' => 16,
            'menu_system_tabs' => 4,
            'menu_system_tab_images' => 4,
            'menu_shisha_content' => 8,
            'menu_food_images' => 6,
            'menu_drink_gallery' => 8,
        ];
    }
}

if (! function_exists('erotikava_has_content')) {
    function erotikava_has_content(mixed $value): bool
    {
        if (is_array($value)) {
            foreach ($value as $item) {
                if (erotikava_has_content($item)) {
                    return true;
                }
            }

            return false;
        }

        if (is_string($value)) {
            return trim($value) !== '';
        }

        if (is_int($value) || is_float($value)) {
            return $value > 0;
        }

        if (is_bool($value)) {
            return $value;
        }

        return $value !== null;
    }
}

if (! function_exists('erotikava_collect_fixed_items')) {
    function erotikava_collect_fixed_items(int $max_items, callable $resolver): array
    {
        $items = [];

        for ($index = 1; $index <= $max_items; $index++) {
            $item = $resolver($index);

            if (! is_array($item) || ! erotikava_has_content($item)) {
                continue;
            }

            $items[] = $item;
        }

        return $items;
    }
}

if (! function_exists('erotikava_get_image_alt')) {
    function erotikava_get_image_alt(int $image_id, string $fallback = ''): string
    {
        $alt = trim((string) get_post_meta($image_id, '_wp_attachment_image_alt', true));
        return $alt !== '' ? $alt : $fallback;
    }
}

if (! function_exists('erotikava_render_image')) {
    function erotikava_render_image(
        int $image_id,
        string $size = 'full',
        array $attributes = [],
        string $fallback_asset = '',
        string $fallback_alt = ''
    ): string {
        if ($image_id > 0) {
            if (! isset($attributes['alt']) || trim((string) $attributes['alt']) === '') {
                $attributes['alt'] = erotikava_get_image_alt($image_id, $fallback_alt);
            }

            return (string) wp_get_attachment_image($image_id, $size, false, $attributes);
        }

        if ($fallback_asset === '') {
            return '';
        }

        $attrs = array_merge(
            [
                'src' => erotikava_asset_url_for_relative_path($fallback_asset),
                'alt' => $fallback_alt,
            ],
            $attributes
        );

        $html = '<img';
        foreach ($attrs as $key => $value) {
            if ($value === null || $value === false || $value === '') {
                continue;
            }

            $html .= sprintf(' %1$s="%2$s"', esc_attr((string) $key), esc_attr((string) $value));
        }
        $html .= '>';

        return $html;
    }
}

if (! function_exists('erotikava_asset_url_for_relative_path')) {
    function erotikava_asset_url_for_relative_path(string $relative_path): string
    {
        $relative_path = ltrim($relative_path, '/');
        $local_path = erotikava_theme_asset_path('images/' . $relative_path);

        if (file_exists($local_path)) {
            return erotikava_theme_asset_uri('images/' . $relative_path);
        }

        return erotikava_remote_asset_url($relative_path);
    }
}

if (! function_exists('erotikava_asset_path_for_relative_path')) {
    function erotikava_asset_path_for_relative_path(string $relative_path): string
    {
        return erotikava_theme_asset_path('images/' . ltrim($relative_path, '/'));
    }
}

if (! function_exists('erotikava_multiline_text')) {
    function erotikava_multiline_text(string $text): string
    {
        return nl2br(esc_html($text));
    }
}

if (! function_exists('erotikava_get_page_defaults')) {
    function erotikava_get_page_defaults(string $key): array
    {
        $all = function_exists('erotikava_get_default_theme_content') ? erotikava_get_default_theme_content() : [];
        return isset($all[$key]) && is_array($all[$key]) ? $all[$key] : [];
    }
}

if (! function_exists('erotikava_get_page_hero_data')) {
    function erotikava_get_page_hero_data(string $page_key, int $post_id): array
    {
        $defaults = erotikava_get_page_defaults($page_key);
        $fallback_title = (string) ($defaults['hero_title'] ?? get_the_title($post_id));
        $title = (string) erotikava_get_field_value('page_hero_title', $fallback_title, $post_id);
        if (! erotikava_use_seed_defaults() && trim($title) === '') {
            $title = get_the_title($post_id);
        }
        $image_alt = (string) erotikava_get_field_value('page_hero_image_alt', $defaults['hero_alt'] ?? $title, $post_id);

        return [
            'image_id' => (int) erotikava_get_field_value('page_hero_image', 0, $post_id),
            'image_alt' => $image_alt,
            'title' => $title,
            'fallback_image' => (string) ($defaults['hero_image'] ?? ''),
        ];
    }
}

if (! function_exists('erotikava_get_seo_title')) {
    function erotikava_get_seo_title(string $default_title): string
    {
        if (! is_singular()) {
            return $default_title;
        }

        $post_id = get_queried_object_id();

        if (! $post_id) {
            return $default_title;
        }

        $seo_title = '';

        if (! erotikava_use_seed_defaults() && function_exists('get_field')) {
            $seo_title = trim((string) get_field('seo_title', $post_id));
        }

        return $seo_title !== '' ? $seo_title : $default_title;
    }
}

if (! function_exists('erotikava_get_seo_description')) {
    function erotikava_get_seo_description(): string
    {
        $defaults = function_exists('erotikava_get_default_theme_content') ? erotikava_get_default_theme_content() : [];

        if (is_front_page()) {
            return (string) ($defaults['meta_descriptions']['front_page'] ?? '');
        }

        if (! is_page()) {
            return get_bloginfo('description');
        }

        $post_id = get_queried_object_id();
        $slug = get_post_field('post_name', $post_id);
        $default = (string) ($defaults['meta_descriptions'][$slug] ?? get_bloginfo('description'));

        if (! erotikava_use_seed_defaults() && function_exists('get_field')) {
            $seo_description = trim((string) get_field('seo_description', $post_id));
            if ($seo_description !== '') {
                return $seo_description;
            }
        }

        return $default;
    }
}

if (! function_exists('erotikava_background_style')) {
    function erotikava_background_style(string $image_url): string
    {
        if ($image_url === '') {
            return '';
        }

        return '--erotikava-bg-image:url(\'' . esc_url_raw($image_url) . '\');';
    }
}

if (! function_exists('erotikava_get_link_attrs')) {
    function erotikava_get_link_attrs(array $link, bool $new_tab = false): string
    {
        $attrs = sprintf(' href="%s"', esc_url((string) ($link['url'] ?? '')));

        if ($new_tab) {
            $attrs .= ' target="_blank" rel="noopener noreferrer"';
        }

        return $attrs;
    }
}
