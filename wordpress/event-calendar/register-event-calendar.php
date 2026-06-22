<?php

defined('ABSPATH') || exit;

add_action('init', function () {
    register_post_type('event_calendar', [
        'labels' => [
            'name' => 'イベントカレンダー',
            'singular_name' => 'イベント日程',
            'add_new' => '新規追加',
            'add_new_item' => 'イベント日程を追加',
            'edit_item' => 'イベント日程を編集',
            'new_item' => '新しいイベント日程',
            'view_item' => 'イベント日程を表示',
            'search_items' => 'イベント日程を検索',
            'not_found' => 'イベント日程が見つかりません',
            'not_found_in_trash' => 'ゴミ箱にイベント日程はありません',
            'menu_name' => 'イベント日程',
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => ['title'],
        'has_archive' => false,
        'rewrite' => false,
        'show_in_rest' => false,
    ]);
});

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_erotikava_event_calendar',
        'title' => 'イベントカレンダー設定',
        'fields' => [
            [
                'key' => 'field_erotikava_event_date',
                'label' => '開催日',
                'name' => 'event_date',
                'type' => 'date_picker',
                'display_format' => 'Y/m/d',
                'return_format' => 'Ymd',
                'first_day' => 1,
                'required' => 1,
            ],
            [
                'key' => 'field_erotikava_event_status',
                'label' => '表示状態',
                'name' => 'event_status',
                'type' => 'select',
                'choices' => [
                    'scheduled' => '画像あり',
                    'pending' => '出演情報調整中',
                ],
                'default_value' => 'scheduled',
                'required' => 1,
                'ui' => 1,
                'return_format' => 'value',
            ],
            [
                'key' => 'field_erotikava_event_image',
                'label' => 'イベント画像',
                'name' => 'event_image',
                'type' => 'image',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_erotikava_event_status',
                            'operator' => '==',
                            'value' => 'scheduled',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_erotikava_event_note',
                'label' => '保留表示テキスト',
                'name' => 'event_note',
                'type' => 'text',
                'default_value' => '出演情報調整中',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_erotikava_event_status',
                            'operator' => '==',
                            'value' => 'pending',
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event_calendar',
                ],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});
