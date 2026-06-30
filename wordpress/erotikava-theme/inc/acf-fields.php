<?php

defined('ABSPATH') || exit;

if (! function_exists('erotikava_acf_tab')) {
    function erotikava_acf_tab(string $key, string $label): array
    {
        return [
            'key' => $key,
            'label' => $label,
            'type' => 'tab',
            'placement' => 'top',
        ];
    }
}

if (! function_exists('erotikava_acf_text')) {
    function erotikava_acf_text(string $key, string $label, string $name, string $type = 'text', array $extra = []): array
    {
        return array_merge([
            'key' => $key,
            'label' => $label,
            'name' => $name,
            'type' => $type,
        ], $extra);
    }
}

if (! function_exists('erotikava_acf_image')) {
    function erotikava_acf_image(string $key, string $label, string $name, array $extra = []): array
    {
        return array_merge([
            'key' => $key,
            'label' => $label,
            'name' => $name,
            'type' => 'image',
            'return_format' => 'id',
            'preview_size' => 'medium',
            'library' => 'all',
        ], $extra);
    }
}

if (! function_exists('erotikava_acf_link')) {
    function erotikava_acf_link(string $key, string $label, string $name, array $extra = []): array
    {
        return array_merge([
            'key' => $key,
            'label' => $label,
            'name' => $name,
            'type' => 'link',
            'return_format' => 'array',
        ], $extra);
    }
}

if (! function_exists('erotikava_acf_true_false')) {
    function erotikava_acf_true_false(string $key, string $label, string $name, array $extra = []): array
    {
        return array_merge([
            'key' => $key,
            'label' => $label,
            'name' => $name,
            'type' => 'true_false',
            'ui' => 1,
        ], $extra);
    }
}

if (! function_exists('erotikava_acf_select')) {
    function erotikava_acf_select(string $key, string $label, string $name, array $choices, array $extra = []): array
    {
        return array_merge([
            'key' => $key,
            'label' => $label,
            'name' => $name,
            'type' => 'select',
            'choices' => $choices,
            'return_format' => 'value',
            'ui' => 1,
        ], $extra);
    }
}

if (! function_exists('erotikava_acf_message')) {
    function erotikava_acf_message(string $key, string $label, string $message = ''): array
    {
        return [
            'key' => $key,
            'label' => $label,
            'name' => '',
            'type' => 'message',
            'message' => $message !== '' ? $message : '<strong>' . esc_html($label) . '</strong>',
            'new_lines' => 'wpautop',
            'esc_html' => 0,
        ];
    }
}

add_action('acf/init', function (): void {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    $limits = erotikava_get_content_limits();
    $page_template_locations = [
        [
            ['param' => 'page_template', 'operator' => '==', 'value' => 'page-reservations.php'],
        ],
        [
            ['param' => 'page_template', 'operator' => '==', 'value' => 'page-profile.php'],
        ],
        [
            ['param' => 'page_template', 'operator' => '==', 'value' => 'page-menu.php'],
        ],
    ];

    acf_add_local_field_group([
        'key' => 'group_erotikava_common_pages',
        'title' => 'Erotikava 共通ページ設定',
        'fields' => [
            erotikava_acf_tab('field_erotikava_common_tab_hero', 'ページヒーロー'),
            erotikava_acf_image('field_erotikava_common_page_hero_image', 'ヒーロー画像', 'page_hero_image'),
            erotikava_acf_text('field_erotikava_common_page_hero_image_alt', 'ヒーロー画像alt', 'page_hero_image_alt'),
            erotikava_acf_text('field_erotikava_common_page_hero_title', 'ヒーロータイトル', 'page_hero_title'),
            erotikava_acf_tab('field_erotikava_common_tab_seo', 'SEO'),
            erotikava_acf_text('field_erotikava_common_seo_title', 'SEOタイトル', 'seo_title'),
            erotikava_acf_text('field_erotikava_common_seo_description', 'SEOディスクリプション', 'seo_description', 'textarea', ['rows' => 3]),
        ],
        'location' => $page_template_locations,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    $front_page_fields = [
        erotikava_acf_tab('field_erotikava_home_tab_hero', 'メインビジュアル'),
    ];

    for ($slide_index = 1; $slide_index <= (int) ($limits['home_hero_slides'] ?? 0); $slide_index++) {
        $front_page_fields[] = erotikava_acf_message(
            "field_erotikava_home_hero_slide_{$slide_index}_heading",
            "スライド {$slide_index}"
        );
        $front_page_fields[] = erotikava_acf_image(
            "field_erotikava_home_hero_slide_{$slide_index}_image",
            '画像',
            "home_hero_slide_{$slide_index}_image"
        );
        $front_page_fields[] = erotikava_acf_image(
            "field_erotikava_home_hero_slide_{$slide_index}_mobile_image",
            'モバイル画像',
            "home_hero_slide_{$slide_index}_mobile_image"
        );
        $front_page_fields[] = erotikava_acf_text(
            "field_erotikava_home_hero_slide_{$slide_index}_image_alt",
            '画像alt',
            "home_hero_slide_{$slide_index}_image_alt"
        );

        for ($line_index = 1; $line_index <= (int) ($limits['home_hero_caption_lines'] ?? 0); $line_index++) {
            $front_page_fields[] = erotikava_acf_text(
                "field_erotikava_home_hero_slide_{$slide_index}_caption_{$line_index}",
                "キャプション {$line_index}",
                "home_hero_slide_{$slide_index}_caption_{$line_index}"
            );
        }

        $front_page_fields[] = erotikava_acf_link(
            "field_erotikava_home_hero_slide_{$slide_index}_link",
            'リンク',
            "home_hero_slide_{$slide_index}_link"
        );
    }

    $front_page_fields[] = erotikava_acf_tab('field_erotikava_home_tab_intro', 'イントロ');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_intro_title', 'タイトル', 'home_intro_title');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_intro_lead', 'リード', 'home_intro_lead');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_intro_hours_badge', '営業時間バッジ', 'home_intro_hours_badge');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_intro_cta_text', 'CTAテキスト', 'home_intro_cta_text');
    $front_page_fields[] = erotikava_acf_link('field_erotikava_home_intro_cta_link', 'CTAリンク', 'home_intro_cta_link');

    $front_page_fields[] = erotikava_acf_tab('field_erotikava_home_tab_features', '特徴カード');
    for ($feature_index = 1; $feature_index <= (int) ($limits['home_features'] ?? 0); $feature_index++) {
        $front_page_fields[] = erotikava_acf_message(
            "field_erotikava_home_feature_{$feature_index}_heading",
            "特徴カード {$feature_index}"
        );
        $front_page_fields[] = erotikava_acf_select(
            "field_erotikava_home_feature_{$feature_index}_card_type",
            'カード種別',
            "home_feature_{$feature_index}_card_type",
            [
                'text_background' => 'text_background',
                'image_only' => 'image_only',
            ]
        );
        $front_page_fields[] = erotikava_acf_image(
            "field_erotikava_home_feature_{$feature_index}_image",
            '画像',
            "home_feature_{$feature_index}_image"
        );
        $front_page_fields[] = erotikava_acf_text(
            "field_erotikava_home_feature_{$feature_index}_image_alt",
            '画像alt',
            "home_feature_{$feature_index}_image_alt"
        );
        $front_page_fields[] = erotikava_acf_text(
            "field_erotikava_home_feature_{$feature_index}_title",
            'タイトル',
            "home_feature_{$feature_index}_title"
        );
        $front_page_fields[] = erotikava_acf_text(
            "field_erotikava_home_feature_{$feature_index}_description",
            '説明',
            "home_feature_{$feature_index}_description",
            'textarea',
            ['rows' => 3]
        );
    }

    $front_page_fields[] = erotikava_acf_tab('field_erotikava_home_tab_concept', 'コンセプト');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_concept_eyebrow', 'アイブロウ', 'home_concept_eyebrow');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_concept_title', 'タイトル', 'home_concept_title');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_concept_text', '本文', 'home_concept_text', 'wysiwyg');
    $front_page_fields[] = erotikava_acf_image('field_erotikava_home_concept_image', '画像', 'home_concept_image');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_concept_image_alt', '画像alt', 'home_concept_image_alt');

    $front_page_fields[] = erotikava_acf_tab('field_erotikava_home_tab_gallery', '店内ギャラリー');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_gallery_eyebrow', 'アイブロウ', 'home_gallery_eyebrow');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_gallery_title', 'タイトル', 'home_gallery_title');
    for ($image_index = 1; $image_index <= (int) ($limits['home_gallery_images'] ?? 0); $image_index++) {
        $front_page_fields[] = erotikava_acf_image(
            "field_erotikava_home_gallery_image_{$image_index}",
            "画像 {$image_index}",
            "home_gallery_image_{$image_index}"
        );
        $front_page_fields[] = erotikava_acf_text(
            "field_erotikava_home_gallery_image_{$image_index}_alt",
            "画像 {$image_index} alt",
            "home_gallery_image_{$image_index}_alt"
        );
    }

    $front_page_fields[] = erotikava_acf_tab('field_erotikava_home_tab_news', 'ニュース');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_news_eyebrow', 'アイブロウ', 'home_news_eyebrow');
    $front_page_fields[] = erotikava_acf_text('field_erotikava_home_news_title', 'タイトル', 'home_news_title');
    for ($news_index = 1; $news_index <= (int) ($limits['home_news_items'] ?? 0); $news_index++) {
        $front_page_fields[] = erotikava_acf_message(
            "field_erotikava_home_news_item_{$news_index}_heading",
            "ニュース {$news_index}"
        );
        $front_page_fields[] = erotikava_acf_image(
            "field_erotikava_home_news_item_{$news_index}_image",
            '画像',
            "home_news_item_{$news_index}_image"
        );
        $front_page_fields[] = erotikava_acf_text(
            "field_erotikava_home_news_item_{$news_index}_image_alt",
            '画像alt',
            "home_news_item_{$news_index}_image_alt"
        );
        $front_page_fields[] = erotikava_acf_link(
            "field_erotikava_home_news_item_{$news_index}_link",
            'リンク',
            "home_news_item_{$news_index}_link"
        );
        $front_page_fields[] = erotikava_acf_true_false(
            "field_erotikava_home_news_item_{$news_index}_open_new_tab",
            '新しいタブで開く',
            "home_news_item_{$news_index}_open_new_tab"
        );
    }

    acf_add_local_field_group([
        'key' => 'group_erotikava_front_page',
        'title' => 'Erotikava トップページ',
        'fields' => $front_page_fields,
        'location' => [
            [
                ['param' => 'page_type', 'operator' => '==', 'value' => 'front_page'],
            ],
            [
                ['param' => 'page_template', 'operator' => '==', 'value' => 'page-home.php'],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_erotikava_reservations_page',
        'title' => 'Erotikava イベント・日程ページ',
        'fields' => [
            erotikava_acf_tab('field_erotikava_reservations_tab_calendar', 'イベントカレンダー'),
            erotikava_acf_text('field_erotikava_events_calendar_month', '表示月', 'events_calendar_month', 'date_picker', [
                'display_format' => 'Y/m/d',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
            ]),
            erotikava_acf_text('field_erotikava_events_calendar_eyebrow', 'アイブロウ', 'events_calendar_eyebrow'),
            erotikava_acf_text('field_erotikava_events_calendar_title', 'タイトル', 'events_calendar_title'),
            erotikava_acf_text('field_erotikava_events_search_label', '検索ラベル', 'events_search_label'),
            erotikava_acf_text('field_erotikava_events_search_placeholder', '検索プレースホルダー', 'events_search_placeholder'),
            erotikava_acf_text('field_erotikava_events_default_label', '未設定日のラベル', 'events_default_label'),
            erotikava_acf_text('field_erotikava_events_default_pending_note', '未設定日の注記', 'events_default_pending_note'),
            erotikava_acf_tab('field_erotikava_reservations_tab_offer', '予約特典'),
            erotikava_acf_text('field_erotikava_events_offer_eyebrow', 'アイブロウ', 'events_offer_eyebrow'),
            erotikava_acf_text('field_erotikava_events_offer_title', 'タイトル', 'events_offer_title'),
            erotikava_acf_text('field_erotikava_events_offer_description', '説明', 'events_offer_description', 'textarea', ['rows' => 3]),
        ],
        'location' => [
            [
                ['param' => 'page_template', 'operator' => '==', 'value' => 'page-reservations.php'],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    $profile_fields = [
        erotikava_acf_tab('field_erotikava_profile_tab_intro', 'Erotikavaについて'),
        erotikava_acf_text('field_erotikava_profile_intro_eyebrow', 'アイブロウ', 'profile_intro_eyebrow'),
        erotikava_acf_text('field_erotikava_profile_intro_title', 'タイトル', 'profile_intro_title'),
    ];

    for ($paragraph_index = 1; $paragraph_index <= (int) ($limits['profile_intro_paragraphs'] ?? 0); $paragraph_index++) {
        $profile_fields[] = erotikava_acf_text(
            "field_erotikava_profile_intro_paragraph_{$paragraph_index}",
            "本文段落 {$paragraph_index}",
            "profile_intro_paragraph_{$paragraph_index}",
            'textarea',
            ['rows' => 3]
        );
    }

    $profile_fields[] = erotikava_acf_tab('field_erotikava_profile_tab_categories', 'プロフィール一覧');
    $profile_fields[] = erotikava_acf_text('field_erotikava_profile_section_eyebrow', 'アイブロウ', 'profile_section_eyebrow');
    $profile_fields[] = erotikava_acf_text('field_erotikava_profile_section_title', 'タイトル', 'profile_section_title');

    for ($category_index = 1; $category_index <= (int) ($limits['profile_categories'] ?? 0); $category_index++) {
        $profile_fields[] = erotikava_acf_message(
            "field_erotikava_profile_category_{$category_index}_heading",
            "カテゴリー {$category_index}"
        );
        $profile_fields[] = erotikava_acf_text(
            "field_erotikava_profile_category_{$category_index}_eyebrow",
            '英字見出し',
            "profile_category_{$category_index}_eyebrow"
        );
        $profile_fields[] = erotikava_acf_text(
            "field_erotikava_profile_category_{$category_index}_title",
            'タイトル',
            "profile_category_{$category_index}_title"
        );

        for ($image_index = 1; $image_index <= (int) ($limits['profile_category_images'] ?? 0); $image_index++) {
            $profile_fields[] = erotikava_acf_image(
                "field_erotikava_profile_category_{$category_index}_image_{$image_index}",
                "画像 {$image_index}",
                "profile_category_{$category_index}_image_{$image_index}"
            );
            $profile_fields[] = erotikava_acf_text(
                "field_erotikava_profile_category_{$category_index}_image_{$image_index}_alt",
                "画像 {$image_index} alt",
                "profile_category_{$category_index}_image_{$image_index}_alt"
            );
        }
    }

    acf_add_local_field_group([
        'key' => 'group_erotikava_profile_page',
        'title' => 'Erotikava プロフィールページ',
        'fields' => $profile_fields,
        'location' => [
            [
                ['param' => 'page_template', 'operator' => '==', 'value' => 'page-profile.php'],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    $menu_fields = [
        erotikava_acf_tab('field_erotikava_menu_tab_system', '料金システム'),
        erotikava_acf_text('field_erotikava_menu_system_eyebrow', 'アイブロウ', 'menu_system_eyebrow'),
        erotikava_acf_text('field_erotikava_menu_system_title', 'タイトル', 'menu_system_title'),
    ];

    for ($tab_index = 1; $tab_index <= (int) ($limits['menu_system_tabs'] ?? 0); $tab_index++) {
        $menu_fields[] = erotikava_acf_message(
            "field_erotikava_menu_system_tab_{$tab_index}_heading",
            "料金タブ {$tab_index}"
        );
        $menu_fields[] = erotikava_acf_text(
            "field_erotikava_menu_system_tab_{$tab_index}_label",
            'タブラベル',
            "menu_system_tab_{$tab_index}_label"
        );

        for ($image_index = 1; $image_index <= (int) ($limits['menu_system_tab_images'] ?? 0); $image_index++) {
            $menu_fields[] = erotikava_acf_image(
                "field_erotikava_menu_system_tab_{$tab_index}_image_{$image_index}",
                "画像 {$image_index}",
                "menu_system_tab_{$tab_index}_image_{$image_index}"
            );
            $menu_fields[] = erotikava_acf_text(
                "field_erotikava_menu_system_tab_{$tab_index}_image_{$image_index}_alt",
                "画像 {$image_index} alt",
                "menu_system_tab_{$tab_index}_image_{$image_index}_alt"
            );
        }
    }

    $menu_fields[] = erotikava_acf_tab('field_erotikava_menu_tab_vip', 'VIP個室');
    $menu_fields[] = erotikava_acf_image('field_erotikava_menu_vip_image', '画像', 'menu_vip_image');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_vip_image_alt', '画像alt', 'menu_vip_image_alt');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_vip_eyebrow', 'アイブロウ', 'menu_vip_eyebrow');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_vip_title', 'タイトル', 'menu_vip_title');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_vip_main_text', 'メインテキスト', 'menu_vip_main_text');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_vip_campaign_text', 'キャンペーン文言', 'menu_vip_campaign_text');

    $menu_fields[] = erotikava_acf_tab('field_erotikava_menu_tab_shisha', 'シーシャ');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_shisha_eyebrow', 'アイブロウ', 'menu_shisha_eyebrow');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_shisha_title', 'タイトル', 'menu_shisha_title');
    for ($line_index = 1; $line_index <= (int) ($limits['menu_shisha_content'] ?? 0); $line_index++) {
        $menu_fields[] = erotikava_acf_message(
            "field_erotikava_menu_shisha_line_{$line_index}_heading",
            "本文行 {$line_index}"
        );
        $menu_fields[] = erotikava_acf_text(
            "field_erotikava_menu_shisha_line_{$line_index}_text",
            'テキスト',
            "menu_shisha_line_{$line_index}_text"
        );
        $menu_fields[] = erotikava_acf_select(
            "field_erotikava_menu_shisha_line_{$line_index}_style",
            'スタイル',
            "menu_shisha_line_{$line_index}_style",
            [
                'normal' => 'normal',
                'note' => 'note',
                'large' => 'large',
                'campaign' => 'campaign',
            ]
        );
    }
    $menu_fields[] = erotikava_acf_image('field_erotikava_menu_shisha_image', '画像', 'menu_shisha_image');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_shisha_image_alt', '画像alt', 'menu_shisha_image_alt');

    $menu_fields[] = erotikava_acf_tab('field_erotikava_menu_tab_food', 'お食事メニュー');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_food_eyebrow', 'アイブロウ', 'menu_food_eyebrow');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_food_title', 'タイトル', 'menu_food_title');
    for ($image_index = 1; $image_index <= (int) ($limits['menu_food_images'] ?? 0); $image_index++) {
        $menu_fields[] = erotikava_acf_image(
            "field_erotikava_menu_food_image_{$image_index}",
            "画像 {$image_index}",
            "menu_food_image_{$image_index}"
        );
        $menu_fields[] = erotikava_acf_text(
            "field_erotikava_menu_food_image_{$image_index}_alt",
            "画像 {$image_index} alt",
            "menu_food_image_{$image_index}_alt"
        );
    }

    $menu_fields[] = erotikava_acf_tab('field_erotikava_menu_tab_drink', 'カクテル・ドリンク');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_eyebrow', 'アイブロウ', 'menu_drink_eyebrow');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_title', 'タイトル', 'menu_drink_title');
    $menu_fields[] = erotikava_acf_image('field_erotikava_menu_drink_main_image', 'メイン画像', 'menu_drink_main_image');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_main_image_alt', 'メイン画像alt', 'menu_drink_main_image_alt');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_featured_title', '注目タイトル', 'menu_drink_featured_title');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_description', '説明', 'menu_drink_description', 'textarea', ['rows' => 3]);
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_price_text', '価格テキスト', 'menu_drink_price_text');
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_types_text', 'ドリンク種類テキスト', 'menu_drink_types_text', 'textarea', ['rows' => 4]);
    $menu_fields[] = erotikava_acf_text('field_erotikava_menu_drink_note', '注記', 'menu_drink_note', 'textarea', ['rows' => 3]);
    for ($image_index = 1; $image_index <= (int) ($limits['menu_drink_gallery'] ?? 0); $image_index++) {
        $menu_fields[] = erotikava_acf_image(
            "field_erotikava_menu_drink_gallery_image_{$image_index}",
            "ギャラリー画像 {$image_index}",
            "menu_drink_gallery_image_{$image_index}"
        );
        $menu_fields[] = erotikava_acf_text(
            "field_erotikava_menu_drink_gallery_image_{$image_index}_alt",
            "ギャラリー画像 {$image_index} alt",
            "menu_drink_gallery_image_{$image_index}_alt"
        );
    }

    acf_add_local_field_group([
        'key' => 'group_erotikava_menu_page',
        'title' => 'Erotikava メニュー・料金ページ',
        'fields' => $menu_fields,
        'location' => [
            [
                ['param' => 'page_template', 'operator' => '==', 'value' => 'page-menu.php'],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});
