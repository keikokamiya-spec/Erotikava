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

add_action('acf/init', function (): void {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

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

    acf_add_local_field_group([
        'key' => 'group_erotikava_front_page',
        'title' => 'Erotikava トップページ',
        'fields' => [
            erotikava_acf_tab('field_erotikava_home_tab_hero', 'メインビジュアル'),
            [
                'key' => 'field_erotikava_home_hero_slides',
                'label' => 'ヒーロースライド',
                'name' => 'home_hero_slides',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'スライドを追加',
                'sub_fields' => [
                    erotikava_acf_image('field_erotikava_home_hero_slide_image', '画像', 'image'),
                    erotikava_acf_image('field_erotikava_home_hero_slide_mobile_image', 'モバイル画像', 'mobile_image'),
                    erotikava_acf_text('field_erotikava_home_hero_slide_alt', '画像alt', 'image_alt'),
                    [
                        'key' => 'field_erotikava_home_hero_slide_caption_lines',
                        'label' => 'キャプション行',
                        'name' => 'caption_lines',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'button_label' => '行を追加',
                        'sub_fields' => [
                            erotikava_acf_text('field_erotikava_home_hero_slide_caption_text', 'テキスト', 'text'),
                        ],
                    ],
                    [
                        'key' => 'field_erotikava_home_hero_slide_link',
                        'label' => 'リンク',
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                    ],
                ],
            ],
            erotikava_acf_tab('field_erotikava_home_tab_intro', 'イントロ'),
            erotikava_acf_text('field_erotikava_home_intro_title', 'タイトル', 'home_intro_title'),
            erotikava_acf_text('field_erotikava_home_intro_lead', 'リード', 'home_intro_lead'),
            erotikava_acf_text('field_erotikava_home_intro_hours_badge', '営業時間バッジ', 'home_intro_hours_badge'),
            erotikava_acf_text('field_erotikava_home_intro_cta_text', 'CTAテキスト', 'home_intro_cta_text'),
            [
                'key' => 'field_erotikava_home_intro_cta_link',
                'label' => 'CTAリンク',
                'name' => 'home_intro_cta_link',
                'type' => 'link',
                'return_format' => 'array',
            ],
            erotikava_acf_tab('field_erotikava_home_tab_features', '特徴カード'),
            [
                'key' => 'field_erotikava_home_features',
                'label' => '特徴カード',
                'name' => 'home_features',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'カードを追加',
                'sub_fields' => [
                    [
                        'key' => 'field_erotikava_home_feature_card_type',
                        'label' => 'カード種別',
                        'name' => 'card_type',
                        'type' => 'select',
                        'choices' => [
                            'text_background' => 'text_background',
                            'image_only' => 'image_only',
                        ],
                        'default_value' => 'text_background',
                        'return_format' => 'value',
                        'ui' => 1,
                    ],
                    erotikava_acf_image('field_erotikava_home_feature_image', '画像', 'image'),
                    erotikava_acf_text('field_erotikava_home_feature_image_alt', '画像alt', 'image_alt'),
                    erotikava_acf_text('field_erotikava_home_feature_title', 'タイトル', 'title'),
                    erotikava_acf_text('field_erotikava_home_feature_description', '説明', 'description', 'textarea', ['rows' => 3]),
                ],
            ],
            erotikava_acf_tab('field_erotikava_home_tab_concept', 'コンセプト'),
            erotikava_acf_text('field_erotikava_home_concept_eyebrow', 'アイブロウ', 'home_concept_eyebrow'),
            erotikava_acf_text('field_erotikava_home_concept_title', 'タイトル', 'home_concept_title'),
            erotikava_acf_text('field_erotikava_home_concept_text', '本文', 'home_concept_text', 'wysiwyg'),
            erotikava_acf_image('field_erotikava_home_concept_image', '画像', 'home_concept_image'),
            erotikava_acf_text('field_erotikava_home_concept_image_alt', '画像alt', 'home_concept_image_alt'),
            erotikava_acf_tab('field_erotikava_home_tab_gallery', '店内ギャラリー'),
            erotikava_acf_text('field_erotikava_home_gallery_eyebrow', 'アイブロウ', 'home_gallery_eyebrow'),
            erotikava_acf_text('field_erotikava_home_gallery_title', 'タイトル', 'home_gallery_title'),
            [
                'key' => 'field_erotikava_home_gallery_images',
                'label' => 'ギャラリー画像',
                'name' => 'home_gallery_images',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => '画像を追加',
                'sub_fields' => [
                    erotikava_acf_image('field_erotikava_home_gallery_image', '画像', 'image'),
                    erotikava_acf_text('field_erotikava_home_gallery_image_alt', '画像alt', 'image_alt'),
                ],
            ],
            erotikava_acf_tab('field_erotikava_home_tab_news', 'ニュース'),
            erotikava_acf_text('field_erotikava_home_news_eyebrow', 'アイブロウ', 'home_news_eyebrow'),
            erotikava_acf_text('field_erotikava_home_news_title', 'タイトル', 'home_news_title'),
            [
                'key' => 'field_erotikava_home_news_items',
                'label' => 'ニュース画像',
                'name' => 'home_news_items',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'ニュースを追加',
                'sub_fields' => [
                    erotikava_acf_image('field_erotikava_home_news_item_image', '画像', 'image'),
                    erotikava_acf_text('field_erotikava_home_news_item_image_alt', '画像alt', 'image_alt'),
                    [
                        'key' => 'field_erotikava_home_news_item_link',
                        'label' => 'リンク',
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                    ],
                    [
                        'key' => 'field_erotikava_home_news_item_open_new_tab',
                        'label' => '新しいタブで開く',
                        'name' => 'open_new_tab',
                        'type' => 'true_false',
                        'ui' => 1,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                ['param' => 'page_type', 'operator' => '==', 'value' => 'front_page'],
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

    acf_add_local_field_group([
        'key' => 'group_erotikava_profile_page',
        'title' => 'Erotikava プロフィールページ',
        'fields' => [
            erotikava_acf_tab('field_erotikava_profile_tab_intro', 'Erotikavaについて'),
            erotikava_acf_text('field_erotikava_profile_intro_eyebrow', 'アイブロウ', 'profile_intro_eyebrow'),
            erotikava_acf_text('field_erotikava_profile_intro_title', 'タイトル', 'profile_intro_title'),
            [
                'key' => 'field_erotikava_profile_intro_paragraphs',
                'label' => '本文段落',
                'name' => 'profile_intro_paragraphs',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => '段落を追加',
                'sub_fields' => [
                    erotikava_acf_text('field_erotikava_profile_intro_paragraph_text', 'テキスト', 'text', 'textarea', ['rows' => 3]),
                ],
            ],
            erotikava_acf_tab('field_erotikava_profile_tab_categories', 'プロフィール一覧'),
            erotikava_acf_text('field_erotikava_profile_section_eyebrow', 'アイブロウ', 'profile_section_eyebrow'),
            erotikava_acf_text('field_erotikava_profile_section_title', 'タイトル', 'profile_section_title'),
            [
                'key' => 'field_erotikava_profile_categories',
                'label' => 'カテゴリー',
                'name' => 'profile_categories',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'カテゴリーを追加',
                'sub_fields' => [
                    erotikava_acf_text('field_erotikava_profile_category_eyebrow', '英字見出し', 'category_eyebrow'),
                    erotikava_acf_text('field_erotikava_profile_category_title', 'タイトル', 'category_title'),
                    [
                        'key' => 'field_erotikava_profile_category_images',
                        'label' => '画像一覧',
                        'name' => 'category_images',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'button_label' => '画像を追加',
                        'sub_fields' => [
                            erotikava_acf_image('field_erotikava_profile_category_image', '画像', 'image'),
                            erotikava_acf_text('field_erotikava_profile_category_image_alt', '画像alt', 'image_alt'),
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                ['param' => 'page_template', 'operator' => '==', 'value' => 'page-profile.php'],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_erotikava_menu_page',
        'title' => 'Erotikava メニュー・料金ページ',
        'fields' => [
            erotikava_acf_tab('field_erotikava_menu_tab_system', '料金システム'),
            erotikava_acf_text('field_erotikava_menu_system_eyebrow', 'アイブロウ', 'menu_system_eyebrow'),
            erotikava_acf_text('field_erotikava_menu_system_title', 'タイトル', 'menu_system_title'),
            [
                'key' => 'field_erotikava_menu_system_tabs',
                'label' => '料金タブ',
                'name' => 'menu_system_tabs',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'タブを追加',
                'sub_fields' => [
                    erotikava_acf_text('field_erotikava_menu_system_tab_label', 'タブラベル', 'tab_label'),
                    [
                        'key' => 'field_erotikava_menu_system_tab_images',
                        'label' => 'タブ画像',
                        'name' => 'tab_images',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'button_label' => '画像を追加',
                        'sub_fields' => [
                            erotikava_acf_image('field_erotikava_menu_system_tab_image', '画像', 'image'),
                            erotikava_acf_text('field_erotikava_menu_system_tab_image_alt', '画像alt', 'image_alt'),
                        ],
                    ],
                ],
            ],
            erotikava_acf_tab('field_erotikava_menu_tab_vip', 'VIP個室'),
            erotikava_acf_image('field_erotikava_menu_vip_image', '画像', 'menu_vip_image'),
            erotikava_acf_text('field_erotikava_menu_vip_image_alt', '画像alt', 'menu_vip_image_alt'),
            erotikava_acf_text('field_erotikava_menu_vip_eyebrow', 'アイブロウ', 'menu_vip_eyebrow'),
            erotikava_acf_text('field_erotikava_menu_vip_title', 'タイトル', 'menu_vip_title'),
            erotikava_acf_text('field_erotikava_menu_vip_main_text', 'メインテキスト', 'menu_vip_main_text'),
            erotikava_acf_text('field_erotikava_menu_vip_campaign_text', 'キャンペーン文言', 'menu_vip_campaign_text'),
            erotikava_acf_tab('field_erotikava_menu_tab_shisha', 'シーシャ'),
            erotikava_acf_text('field_erotikava_menu_shisha_eyebrow', 'アイブロウ', 'menu_shisha_eyebrow'),
            erotikava_acf_text('field_erotikava_menu_shisha_title', 'タイトル', 'menu_shisha_title'),
            [
                'key' => 'field_erotikava_menu_shisha_content',
                'label' => '本文行',
                'name' => 'menu_shisha_content',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => '行を追加',
                'sub_fields' => [
                    erotikava_acf_text('field_erotikava_menu_shisha_content_text', 'テキスト', 'text'),
                    [
                        'key' => 'field_erotikava_menu_shisha_content_style',
                        'label' => 'スタイル',
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => [
                            'normal' => 'normal',
                            'note' => 'note',
                            'large' => 'large',
                            'campaign' => 'campaign',
                        ],
                        'default_value' => 'normal',
                        'return_format' => 'value',
                        'ui' => 1,
                    ],
                ],
            ],
            erotikava_acf_image('field_erotikava_menu_shisha_image', '画像', 'menu_shisha_image'),
            erotikava_acf_text('field_erotikava_menu_shisha_image_alt', '画像alt', 'menu_shisha_image_alt'),
            erotikava_acf_tab('field_erotikava_menu_tab_food', 'お食事メニュー'),
            erotikava_acf_text('field_erotikava_menu_food_eyebrow', 'アイブロウ', 'menu_food_eyebrow'),
            erotikava_acf_text('field_erotikava_menu_food_title', 'タイトル', 'menu_food_title'),
            [
                'key' => 'field_erotikava_menu_food_images',
                'label' => 'フード画像',
                'name' => 'menu_food_images',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => '画像を追加',
                'sub_fields' => [
                    erotikava_acf_image('field_erotikava_menu_food_image', '画像', 'image'),
                    erotikava_acf_text('field_erotikava_menu_food_image_alt', '画像alt', 'image_alt'),
                ],
            ],
            erotikava_acf_tab('field_erotikava_menu_tab_drink', 'カクテル・ドリンク'),
            erotikava_acf_text('field_erotikava_menu_drink_eyebrow', 'アイブロウ', 'menu_drink_eyebrow'),
            erotikava_acf_text('field_erotikava_menu_drink_title', 'タイトル', 'menu_drink_title'),
            erotikava_acf_image('field_erotikava_menu_drink_main_image', 'メイン画像', 'menu_drink_main_image'),
            erotikava_acf_text('field_erotikava_menu_drink_main_image_alt', 'メイン画像alt', 'menu_drink_main_image_alt'),
            erotikava_acf_text('field_erotikava_menu_drink_featured_title', '注目タイトル', 'menu_drink_featured_title'),
            erotikava_acf_text('field_erotikava_menu_drink_description', '説明', 'menu_drink_description', 'textarea', ['rows' => 3]),
            erotikava_acf_text('field_erotikava_menu_drink_price_text', '価格テキスト', 'menu_drink_price_text'),
            erotikava_acf_text('field_erotikava_menu_drink_types_text', 'ドリンク種類テキスト', 'menu_drink_types_text', 'textarea', ['rows' => 4]),
            erotikava_acf_text('field_erotikava_menu_drink_note', '注記', 'menu_drink_note', 'textarea', ['rows' => 3]),
            [
                'key' => 'field_erotikava_menu_drink_gallery',
                'label' => 'ドリンクギャラリー',
                'name' => 'menu_drink_gallery',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => '画像を追加',
                'sub_fields' => [
                    erotikava_acf_image('field_erotikava_menu_drink_gallery_image', '画像', 'image'),
                    erotikava_acf_text('field_erotikava_menu_drink_gallery_image_alt', '画像alt', 'image_alt'),
                ],
            ],
        ],
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

