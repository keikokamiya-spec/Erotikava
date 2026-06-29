<?php

defined('ABSPATH') || exit;

if (! function_exists('erotikava_get_default_theme_content')) {
    function erotikava_get_default_theme_content(): array
    {
        return [
            'meta_descriptions' => [
                'front_page' => '千葉・栄町のショー&ダイニングバー Erotikava。ダンスショー、お食事、カクテル、VIP個室。',
                'reservations' => 'Erotikavaのイベント・ショースケジュール。毎週月〜土曜日 ダンス&エキゾチックショー開催中。',
                'profile' => 'Erotikavaのプロフィールページ。店内の雰囲気やショースタイル、店舗情報をご紹介します。',
                'menu' => 'Erotikavaの料金システム、VIP個室、シーシャ、フード、カクテル。',
            ],
            'home' => [
                'hero_slides' => [
                    [
                        'image' => 'hero1.jpg',
                        'mobile_image' => '',
                        'image_alt' => 'ダンス&エキゾチックショー',
                        'caption_lines' => [
                            ['text' => '毎週月〜土'],
                            ['text' => 'ダンス&'],
                            ['text' => 'エキゾチックショー'],
                            ['text' => '開催中'],
                        ],
                        'link' => [],
                    ],
                    [
                        'image' => 'hero2.jpg',
                        'mobile_image' => '',
                        'image_alt' => '千葉初のショースタイルBAR Erotikava',
                        'caption_lines' => [
                            ['text' => '千葉初の'],
                            ['text' => 'ショースタイルBAR'],
                            ['text' => 'Erotikava'],
                        ],
                        'link' => [],
                    ],
                    [
                        'image' => 'hero3.jpg',
                        'mobile_image' => '',
                        'image_alt' => '非日常の空間',
                        'caption_lines' => [
                            ['text' => '非日常の空間へ、'],
                            ['text' => 'ようこそ'],
                        ],
                        'link' => [],
                    ],
                ],
                'intro_title' => 'Erotikava',
                'intro_lead' => '千葉初のショースタイルBAR',
                'intro_hours_badge' => 'Open 19:00〜 / 月〜土・LAST',
                'intro_cta_text' => 'イベント・日程を見る',
                'features' => [
                    [
                        'card_type' => 'text_background',
                        'image' => 'img/setc/b.jpg',
                        'image_alt' => 'プロダンサーによる本格ショー',
                        'title' => 'プロダンサーによる本格ショー',
                        'description' => '妖艶で華やかなステージが、夜の時間を鮮やかに彩ります。',
                    ],
                    [
                        'card_type' => 'image_only',
                        'image' => 'img/setc/j.jpg',
                        'image_alt' => '19:00〜20:00ご来店で美味しいフードが付いてくる',
                        'title' => '',
                        'description' => '',
                    ],
                    [
                        'card_type' => 'text_background',
                        'image' => 'img/setb/j.jpg',
                        'image_alt' => '宴会・VIP個室あり',
                        'title' => '宴会・VIP個室あり',
                        'description' => '記念日、宴会、特別な集まりまで、幅広いシーンに対応します。',
                    ],
                ],
                'concept_eyebrow' => 'Concept',
                'concept_title' => 'コンセプト',
                'concept_text' => '当店は千葉初のショースタイルを確立したBARです。妖艶な雰囲気を醸し出す店内、吹き抜けの2階席、そして真っ赤なロングカウンター。今宵、あなたを不思議な空間へと誘います。',
                'concept_image' => 'concept.jpg',
                'concept_image_alt' => 'Erotikava 店内コンセプト',
                'gallery_eyebrow' => 'Gallery',
                'gallery_title' => '店内ギャラリー',
                'gallery_images' => [
                    ['image' => 'line_oa_chat_260618_201137.jpg', 'image_alt' => '店内ギャラリー カウンターから見たステージ'],
                    ['image' => 'line_oa_chat_260618_201153.jpg', 'image_alt' => '店内ギャラリー ステージ正面別カット'],
                    ['image' => 'line_oa_chat_260618_201206.jpg', 'image_alt' => '店内ギャラリー ステージ正面'],
                    ['image' => 'line_oa_chat_260618_201223.jpg', 'image_alt' => '店内ギャラリー ソファ席'],
                    ['image' => 'line_oa_chat_260618_201236.jpg', 'image_alt' => '店内ギャラリー 2階からの眺め'],
                    ['image' => 'line_oa_chat_260618_201253.jpg', 'image_alt' => '店内ギャラリー ポーカーテーブル'],
                    ['image' => 'line_oa_chat_260618_201305.jpg', 'image_alt' => '店内ギャラリー 2階からの眺め別カット'],
                    ['image' => 'line_oa_chat_260618_201324.jpg', 'image_alt' => '店内ギャラリー ロゴカウンター'],
                ],
                'news_eyebrow' => 'News',
                'news_title' => '今月のコラボ企画&ニュース',
                'news_items' => [
                    ['image' => 'news1.jpg', 'image_alt' => 'イベント・ニュース', 'link' => [], 'open_new_tab' => 0],
                    ['image' => 'news2.jpg', 'image_alt' => 'イベント・ニュース', 'link' => [], 'open_new_tab' => 0],
                    ['image' => 'news3.jpg', 'image_alt' => 'イベント・ニュース', 'link' => [], 'open_new_tab' => 0],
                    ['image' => 'line_oa_chat_260618_193427.jpg', 'image_alt' => 'イベント・ニュース', 'link' => [], 'open_new_tab' => 0],
                    ['image' => 'line_oa_chat_260618_193442.jpg', 'image_alt' => 'イベント・ニュース', 'link' => [], 'open_new_tab' => 0],
                ],
            ],
            'reservations' => [
                'hero_image' => 'line_oa_chat_260618_201324.jpg',
                'hero_alt' => 'イベント・日程',
                'hero_title' => 'イベント・日程',
                'events_calendar_month' => '2026-07-01',
                'events_calendar_eyebrow' => 'July 2026',
                'events_calendar_title' => '2026年7月<br class="mobile-break">イベントカレンダー',
                'events_search_label' => 'イベント検索',
                'events_search_placeholder' => '例: 7/14, 2026-07-14, Show, TBA',
                'events_default_label' => 'TBA',
                'events_default_pending_note' => '出演情報調整中',
                'events_offer_eyebrow' => 'Special Offer',
                'events_offer_title' => '前予約で特典アリ',
                'events_offer_description' => '事前予約のお客様に特別サービスをご用意しております。詳細はお電話にてお問い合わせください。',
                'events' => [
                    ['date' => '20260701', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192110.jpg', 'image_alt' => '7月1日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260702', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192110.jpg', 'image_alt' => '7月2日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260703', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192145.jpg', 'image_alt' => '7月3日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260704', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192204.jpg', 'image_alt' => '7月4日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260705', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260706', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192221.jpg', 'image_alt' => '7月6日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260707', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192259.jpg', 'image_alt' => '7月7日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260708', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192243.jpg', 'image_alt' => '7月8日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260709', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192316.jpg', 'image_alt' => '7月9日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260710', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192336.jpg', 'image_alt' => '7月10日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260711', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192418.jpg', 'image_alt' => '7月11日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260712', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260713', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_192359.jpg', 'image_alt' => '7月13日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260714', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193427.jpg', 'image_alt' => '7月14日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260715', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193442.jpg', 'image_alt' => '7月15日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260716', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260717', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193501.jpg', 'image_alt' => '7月17日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260718', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193524.jpg', 'image_alt' => '7月18日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260719', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193558.jpg', 'image_alt' => '7月19日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260720', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260721', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193541.jpg', 'image_alt' => '7月21日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260722', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260723', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193615.jpg', 'image_alt' => '7月23日のイベント', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260724', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260725', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260726', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260727', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260728', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260729', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260730', 'status' => 'pending', 'label' => 'TBA', 'image' => '', 'image_alt' => '', 'pending_note' => '出演情報調整中'],
                    ['date' => '20260731', 'status' => 'scheduled', 'label' => 'Show', 'image' => 'line_oa_chat_260618_193645.jpg', 'image_alt' => '7月31日のイベント', 'pending_note' => '出演情報調整中'],
                ],
            ],
            'profile' => [
                'hero_image' => 'concept.jpg',
                'hero_alt' => 'プロフィール',
                'hero_title' => 'プロフィール',
                'intro_eyebrow' => 'Store Profile',
                'intro_title' => 'Erotikavaについて',
                'intro_paragraphs' => [
                    ['text' => '千葉初のショースタイルBARとして、華やかなショーと妖艶な空間演出をお楽しみいただけます。'],
                    ['text' => '吹き抜けの2階席、真っ赤なロングカウンター、VIP個室まで、非日常の夜を過ごせる店内設計です。'],
                    ['text' => 'ショー、お食事、カクテルを一度に味わえる、大人のためのエンターテインメント空間です。'],
                ],
                'section_eyebrow' => 'Profile',
                'section_title' => 'プロフィール',
                'categories' => [
                    [
                        'category_eyebrow' => 'Dancer',
                        'category_title' => 'ダンサー',
                        'category_images' => [
                            ['image' => 'img/seta/a.jpg', 'image_alt' => 'ダンサー1'],
                            ['image' => 'img/seta/b.jpg', 'image_alt' => 'ダンサー2'],
                            ['image' => 'img/seta/c.jpg', 'image_alt' => 'ダンサー3'],
                            ['image' => 'img/seta/d.jpg', 'image_alt' => 'ダンサー4'],
                            ['image' => 'img/seta/e.jpg', 'image_alt' => 'ダンサー5'],
                            ['image' => 'img/seta/f.jpg', 'image_alt' => 'ダンサー6'],
                            ['image' => 'img/setb/a.jpg', 'image_alt' => 'ダンサー7'],
                            ['image' => 'img/setb/b.jpg', 'image_alt' => 'ダンサー8'],
                            ['image' => 'img/setb/c.jpg', 'image_alt' => 'ダンサー9'],
                            ['image' => 'img/setb/d.jpg', 'image_alt' => 'ダンサー10'],
                            ['image' => 'img/setb/e.jpg', 'image_alt' => 'ダンサー11'],
                            ['image' => 'img/setb/f.jpg', 'image_alt' => 'ダンサー12'],
                            ['image' => 'img/setb/g.jpg', 'image_alt' => 'ダンサー13'],
                            ['image' => 'img/setb/h.jpg', 'image_alt' => 'ダンサー14'],
                            ['image' => 'img/setb/i.jpg', 'image_alt' => 'ダンサー15'],
                            ['image' => 'img/setb/j.jpg', 'image_alt' => 'ダンサー16'],
                        ],
                    ],
                    [
                        'category_eyebrow' => 'Nawashi',
                        'category_title' => '縄師',
                        'category_images' => [
                            ['image' => 'img/setc/f.jpg', 'image_alt' => '縄師1'],
                            ['image' => 'img/setc/g.jpg', 'image_alt' => '縄師2'],
                        ],
                    ],
                    [
                        'category_eyebrow' => 'Queen',
                        'category_title' => '女王様',
                        'category_images' => [
                            ['image' => 'img/setb/c.jpg', 'image_alt' => '女王様1'],
                            ['image' => 'img/setb/d.jpg', 'image_alt' => '女王様2'],
                        ],
                    ],
                ],
            ],
            'menu' => [
                'hero_image' => 'menu-hero.jpg',
                'hero_alt' => 'メニュー・料金',
                'hero_title' => 'メニュー・料金',
                'system_eyebrow' => 'System',
                'system_title' => '選べる料金システム',
                'system_tabs' => [
                    [
                        'tab_label' => '飲み放題プラン',
                        'tab_images' => [
                            ['image' => '630_891 (4).jpg', 'image_alt' => '飲み放題プラン画像 1'],
                            ['image' => '630_891 (5).jpg', 'image_alt' => '飲み放題プラン画像 2'],
                        ],
                    ],
                    [
                        'tab_label' => 'ボトルキーププラン',
                        'tab_images' => [
                            ['image' => '630_891 (5).jpg', 'image_alt' => 'ボトルメニューとパーティーメニューの料金画像'],
                        ],
                    ],
                ],
                'vip_image' => 'vip.jpg',
                'vip_image_alt' => 'VIP個室',
                'vip_eyebrow' => 'VIP Room',
                'vip_title' => 'VIP個室',
                'vip_main_text' => '個室使用料 90分 ¥3,300',
                'vip_campaign_text' => '先着20組限定: ボトルセット代無料キャンペーン実施中',
                'shisha_eyebrow' => 'Shisha & Bottle',
                'shisha_title' => 'シーシャラウンジ & ボトルキープ',
                'shisha_content' => [
                    ['text' => 'シーシャ & ボトルキープ開始', 'style' => 'normal'],
                    ['text' => 'シーシャ ¥3,000〜 (20種フレーバーから3つ選択可)', 'style' => 'normal'],
                    ['text' => 'シーシャ利用時: ダーツ & ポーカーテーブル無料', 'style' => 'normal'],
                    ['text' => 'ショーは10:30まで', 'style' => 'normal'],
                    ['text' => '※飲み放題2時間制、都度の場合は別途料金になります。', 'style' => 'note'],
                    ['text' => '11:00〜ダイニングバーになります。', 'style' => 'normal'],
                ],
                'shisha_image' => 'スクリーンショット 2026-06-05 18.13.19.png',
                'shisha_image_alt' => 'シーシャラウンジ & ボトルキープ',
                'food_eyebrow' => 'Food',
                'food_title' => 'お食事メニュー',
                'food_images' => [
                    ['image' => 'img/setc/h.jpg', 'image_alt' => 'Erotikava Food menu 1'],
                    ['image' => 'img/setc/i.jpg', 'image_alt' => 'Erotikava Food menu 2'],
                ],
                'drink_eyebrow' => 'Drink',
                'drink_title' => 'カクテル・ドリンク',
                'drink_main_image' => 'cocktail-main.jpg',
                'drink_main_image_alt' => '季節の生フルーツカクテル',
                'drink_featured_title' => '季節の生フルーツカクテル',
                'drink_price_text' => '¥1,650',
                'drink_description' => "生のお酒と生のフルーツのみで作った\n特製カクテル",
                'drink_types_text' => "カクテル各種 ¥770〜\n生ビール / 定番カクテル\n/ 緑茶ハイ / ソフトドリンク\n/ ノンアルも◎",
                'drink_note' => "※メニュー以外のご要望も\nスタッフにお気軽に",
                'drink_gallery' => [
                    ['image' => '630_891 (1).jpg', 'image_alt' => 'グランドメニュー1'],
                    ['image' => '630_891 (2).jpg', 'image_alt' => 'グランドメニュー2'],
                    ['image' => '630_891 (3).jpg', 'image_alt' => 'グランドメニュー3'],
                    ['image' => '630_891 (4).jpg', 'image_alt' => 'グランドメニュー4'],
                    ['image' => 'line_oa_chat_260618_201352.jpg', 'image_alt' => 'グランドメニュー5'],
                ],
            ],
        ];
    }
}

if (! function_exists('erotikava_make_link_value')) {
    function erotikava_make_link_value(string $url, string $title, string $target = ''): array
    {
        return [
            'url' => $url,
            'title' => $title,
            'target' => $target,
        ];
    }
}

if (! function_exists('erotikava_import_media_asset')) {
    function erotikava_import_media_asset(string $relative_path, array &$messages): int
    {
        $relative_path = ltrim($relative_path, '/');
        $source_path = erotikava_asset_path_for_relative_path($relative_path);
        $file_contents = null;
        $source_basename = basename($relative_path);

        if (file_exists($source_path)) {
            $hash = md5_file($source_path);
            $file_contents = file_get_contents($source_path);
        } else {
            $remote_url = erotikava_remote_asset_url($relative_path);
            $response = wp_safe_remote_get($remote_url, ['timeout' => 30]);

            if (is_wp_error($response)) {
                $messages[] = '画像の取得に失敗しました: ' . $relative_path . ' / ' . $response->get_error_message();
                return 0;
            }

            $file_contents = wp_remote_retrieve_body($response);
            $hash = $file_contents ? md5($file_contents) : '';
        }

        if (! $hash || ! is_string($file_contents) || $file_contents === '') {
            $messages[] = '画像データの取得に失敗しました: ' . $relative_path;
            return 0;
        }

        $existing = get_posts([
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => 1,
            'fields' => 'ids',
            'meta_query' => [
                [
                    'key' => '_erotikava_source_hash',
                    'value' => $hash,
                    'compare' => '=',
                ],
                [
                    'key' => '_erotikava_source_relative_path',
                    'value' => $relative_path,
                    'compare' => '=',
                ],
            ],
        ]);

        if ($existing !== []) {
            return (int) $existing[0];
        }

        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $upload = wp_upload_bits($source_basename, null, $file_contents);
        if (! empty($upload['error'])) {
            $messages[] = '画像のアップロードに失敗しました: ' . $relative_path . ' / ' . $upload['error'];
            return 0;
        }

        $attachment = [
            'post_mime_type' => wp_check_filetype($upload['file'])['type'] ?? 'image/jpeg',
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($relative_path)),
            'post_content' => '',
            'post_status' => 'inherit',
        ];
        $attachment_id = wp_insert_attachment($attachment, $upload['file']);

        if (is_wp_error($attachment_id) || ! $attachment_id) {
            $messages[] = '添付ファイル登録に失敗しました: ' . $relative_path;
            return 0;
        }

        $metadata = wp_generate_attachment_metadata($attachment_id, $upload['file']);
        if (! is_wp_error($metadata) && is_array($metadata)) {
            wp_update_attachment_metadata($attachment_id, $metadata);
        }

        update_post_meta($attachment_id, '_erotikava_source_hash', $hash);
        update_post_meta($attachment_id, '_erotikava_source_relative_path', $relative_path);

        return (int) $attachment_id;
    }
}

if (! function_exists('erotikava_seed_field_if_empty')) {
    function erotikava_seed_field_if_empty(int $post_id, string $field_name, mixed $value, array &$messages): void
    {
        if (! function_exists('update_field')) {
            return;
        }

        $current_value = get_field($field_name, $post_id);
        $has_value = false;

        if (is_array($current_value)) {
            $has_value = $current_value !== [];
        } else {
            $has_value = $current_value !== null && $current_value !== false && $current_value !== '';
        }

        if ($has_value) {
            $messages[] = sprintf('%d の %s は既存値があるため保持しました。', $post_id, $field_name);
            return;
        }

        update_field($field_name, $value, $post_id);
    }
}

if (! function_exists('erotikava_find_or_create_page')) {
    function erotikava_find_or_create_page(string $slug, string $title, string $template = ''): int
    {
        $page = get_page_by_path($slug);
        if ($page instanceof WP_Post) {
            $page_id = (int) $page->ID;
        } else {
            $page_id = wp_insert_post([
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_title' => $title,
                'post_name' => $slug,
            ]);
        }

        if ($page_id > 0 && $template !== '') {
            update_post_meta($page_id, '_wp_page_template', $template);
        }

        return max(0, (int) $page_id);
    }
}

if (! function_exists('erotikava_register_initial_content_page')) {
    function erotikava_register_initial_content_page(): void
    {
        add_management_page(
            'Erotikava初期データ',
            'Erotikava初期データ',
            'manage_options',
            'erotikava-initial-content',
            'erotikava_render_initial_content_page'
        );
    }
}
add_action('admin_menu', 'erotikava_register_initial_content_page');

if (! function_exists('erotikava_import_initial_content')) {
    function erotikava_import_initial_content(): array
    {
        $messages = [];
        $defaults = erotikava_get_default_theme_content();

        if (! function_exists('update_field')) {
            return ['ACF PROが有効ではないため、初期データを投入できません。'];
        }

        $front_page_id = erotikava_find_or_create_page('home', 'トップ');
        $reservations_page_id = erotikava_find_or_create_page('reservations', 'イベント・日程', 'page-reservations.php');
        $profile_page_id = erotikava_find_or_create_page('profile', 'プロフィール', 'page-profile.php');
        $menu_page_id = erotikava_find_or_create_page('menu', 'メニュー・料金', 'page-menu.php');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id);

        $messages[] = '固定ページの作成とフロントページ設定を確認しました。';

        $home = $defaults['home'];
        $hero_slides = [];
        foreach ($home['hero_slides'] as $slide) {
            $hero_slides[] = [
                'image' => erotikava_import_media_asset($slide['image'], $messages),
                'mobile_image' => $slide['mobile_image'] !== '' ? erotikava_import_media_asset($slide['mobile_image'], $messages) : 0,
                'image_alt' => $slide['image_alt'],
                'caption_lines' => $slide['caption_lines'],
                'link' => [],
            ];
        }
        erotikava_seed_field_if_empty($front_page_id, 'home_hero_slides', $hero_slides, $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_intro_title', $home['intro_title'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_intro_lead', $home['intro_lead'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_intro_hours_badge', $home['intro_hours_badge'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_intro_cta_text', $home['intro_cta_text'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_intro_cta_link', erotikava_make_link_value(erotikava_get_page_url('reservations') . '#event-calendar', $home['intro_cta_text']), $messages);

        $features = [];
        foreach ($home['features'] as $feature) {
            $features[] = [
                'card_type' => $feature['card_type'],
                'image' => erotikava_import_media_asset($feature['image'], $messages),
                'image_alt' => $feature['image_alt'],
                'title' => $feature['title'],
                'description' => $feature['description'],
            ];
        }
        erotikava_seed_field_if_empty($front_page_id, 'home_features', $features, $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_concept_eyebrow', $home['concept_eyebrow'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_concept_title', $home['concept_title'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_concept_text', $home['concept_text'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_concept_image', erotikava_import_media_asset($home['concept_image'], $messages), $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_concept_image_alt', $home['concept_image_alt'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_gallery_eyebrow', $home['gallery_eyebrow'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_gallery_title', $home['gallery_title'], $messages);

        $gallery_images = [];
        foreach ($home['gallery_images'] as $image) {
            $gallery_images[] = [
                'image' => erotikava_import_media_asset($image['image'], $messages),
                'image_alt' => $image['image_alt'],
            ];
        }
        erotikava_seed_field_if_empty($front_page_id, 'home_gallery_images', $gallery_images, $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_news_eyebrow', $home['news_eyebrow'], $messages);
        erotikava_seed_field_if_empty($front_page_id, 'home_news_title', $home['news_title'], $messages);

        $news_items = [];
        foreach ($home['news_items'] as $news_item) {
            $news_items[] = [
                'image' => erotikava_import_media_asset($news_item['image'], $messages),
                'image_alt' => $news_item['image_alt'],
                'link' => [],
                'open_new_tab' => 0,
            ];
        }
        erotikava_seed_field_if_empty($front_page_id, 'home_news_items', $news_items, $messages);

        foreach (['reservations' => $reservations_page_id, 'profile' => $profile_page_id, 'menu' => $menu_page_id] as $page_key => $page_id) {
            $page_defaults = $defaults[$page_key];
            erotikava_seed_field_if_empty($page_id, 'page_hero_image', erotikava_import_media_asset($page_defaults['hero_image'], $messages), $messages);
            erotikava_seed_field_if_empty($page_id, 'page_hero_image_alt', $page_defaults['hero_alt'], $messages);
            erotikava_seed_field_if_empty($page_id, 'page_hero_title', $page_defaults['hero_title'], $messages);
        }

        $reservations = $defaults['reservations'];
        foreach ([
            'events_calendar_month',
            'events_calendar_eyebrow',
            'events_calendar_title',
            'events_search_label',
            'events_search_placeholder',
            'events_default_label',
            'events_default_pending_note',
            'events_offer_eyebrow',
            'events_offer_title',
            'events_offer_description',
        ] as $field_name) {
            erotikava_seed_field_if_empty($reservations_page_id, $field_name, $reservations[$field_name], $messages);
        }

        $profile = $defaults['profile'];
        erotikava_seed_field_if_empty($profile_page_id, 'profile_intro_eyebrow', $profile['intro_eyebrow'], $messages);
        erotikava_seed_field_if_empty($profile_page_id, 'profile_intro_title', $profile['intro_title'], $messages);
        erotikava_seed_field_if_empty($profile_page_id, 'profile_intro_paragraphs', $profile['intro_paragraphs'], $messages);
        erotikava_seed_field_if_empty($profile_page_id, 'profile_section_eyebrow', $profile['section_eyebrow'], $messages);
        erotikava_seed_field_if_empty($profile_page_id, 'profile_section_title', $profile['section_title'], $messages);

        $profile_categories = [];
        foreach ($profile['categories'] as $category) {
            $images = [];
            foreach ($category['category_images'] as $image) {
                $images[] = [
                    'image' => erotikava_import_media_asset($image['image'], $messages),
                    'image_alt' => $image['image_alt'],
                ];
            }

            $profile_categories[] = [
                'category_eyebrow' => $category['category_eyebrow'],
                'category_title' => $category['category_title'],
                'category_images' => $images,
            ];
        }
        erotikava_seed_field_if_empty($profile_page_id, 'profile_categories', $profile_categories, $messages);

        $menu = $defaults['menu'];
        erotikava_seed_field_if_empty($menu_page_id, 'menu_system_eyebrow', $menu['system_eyebrow'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_system_title', $menu['system_title'], $messages);
        $system_tabs = [];
        foreach ($menu['system_tabs'] as $tab) {
            $tab_images = [];
            foreach ($tab['tab_images'] as $image) {
                $tab_images[] = [
                    'image' => erotikava_import_media_asset($image['image'], $messages),
                    'image_alt' => $image['image_alt'],
                ];
            }
            $system_tabs[] = [
                'tab_label' => $tab['tab_label'],
                'tab_images' => $tab_images,
            ];
        }
        erotikava_seed_field_if_empty($menu_page_id, 'menu_system_tabs', $system_tabs, $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_vip_image', erotikava_import_media_asset($menu['vip_image'], $messages), $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_vip_image_alt', $menu['vip_image_alt'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_vip_eyebrow', $menu['vip_eyebrow'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_vip_title', $menu['vip_title'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_vip_main_text', $menu['vip_main_text'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_vip_campaign_text', $menu['vip_campaign_text'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_shisha_eyebrow', $menu['shisha_eyebrow'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_shisha_title', $menu['shisha_title'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_shisha_content', $menu['shisha_content'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_shisha_image', erotikava_import_media_asset($menu['shisha_image'], $messages), $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_shisha_image_alt', $menu['shisha_image_alt'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_food_eyebrow', $menu['food_eyebrow'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_food_title', $menu['food_title'], $messages);
        $food_images = [];
        foreach ($menu['food_images'] as $image) {
            $food_images[] = [
                'image' => erotikava_import_media_asset($image['image'], $messages),
                'image_alt' => $image['image_alt'],
            ];
        }
        erotikava_seed_field_if_empty($menu_page_id, 'menu_food_images', $food_images, $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_eyebrow', $menu['drink_eyebrow'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_title', $menu['drink_title'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_main_image', erotikava_import_media_asset($menu['drink_main_image'], $messages), $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_main_image_alt', $menu['drink_main_image_alt'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_featured_title', $menu['drink_featured_title'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_price_text', $menu['drink_price_text'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_description', $menu['drink_description'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_types_text', $menu['drink_types_text'], $messages);
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_note', $menu['drink_note'], $messages);
        $drink_gallery = [];
        foreach ($menu['drink_gallery'] as $image) {
            $drink_gallery[] = [
                'image' => erotikava_import_media_asset($image['image'], $messages),
                'image_alt' => $image['image_alt'],
            ];
        }
        erotikava_seed_field_if_empty($menu_page_id, 'menu_drink_gallery', $drink_gallery, $messages);

        $post_type = erotikava_get_event_post_type();
        $pending_field = $post_type === 'event_calendar' ? 'event_note' : 'event_pending_note';
        foreach ($reservations['events'] as $event) {
            $seed_key = 'erotikava-event-' . $event['date'];
            $existing = get_posts([
                'post_type' => $post_type,
                'post_status' => ['publish', 'draft', 'pending', 'future', 'private'],
                'posts_per_page' => 1,
                'fields' => 'ids',
                'meta_key' => '_erotikava_seed_key',
                'meta_value' => $seed_key,
            ]);

            if ($existing !== []) {
                $event_post_id = (int) $existing[0];
            } else {
                $event_date = DateTimeImmutable::createFromFormat('Ymd', (string) $event['date']) ?: null;
                $event_post_id = wp_insert_post([
                    'post_type' => $post_type,
                    'post_status' => 'publish',
                    'post_title' => ($event_date ? $event_date->format('Y年n月j日') : (string) $event['date']) . ' Event',
                ]);
                if ($event_post_id > 0) {
                    update_post_meta($event_post_id, '_erotikava_seed_key', $seed_key);
                }
            }

            if ($event_post_id <= 0) {
                $messages[] = 'イベントの作成に失敗しました: ' . $event['date'];
                continue;
            }

            erotikava_seed_field_if_empty($event_post_id, 'event_date', $event['date'], $messages);
            erotikava_seed_field_if_empty($event_post_id, 'event_status', $event['status'], $messages);
            erotikava_seed_field_if_empty($event_post_id, 'event_label', $event['label'], $messages);
            erotikava_seed_field_if_empty($event_post_id, 'event_image_alt', $event['image_alt'], $messages);
            erotikava_seed_field_if_empty($event_post_id, $pending_field, $event['pending_note'], $messages);
            if ($event['image'] !== '') {
                erotikava_seed_field_if_empty($event_post_id, 'event_image', erotikava_import_media_asset($event['image'], $messages), $messages);
            }
        }

        update_option('erotikava_initial_content_imported', 1);
        update_option('erotikava_initial_content_imported_at', time());
        update_option('erotikava_initial_content_last_log', $messages, false);

        return $messages;
    }
}

if (! function_exists('erotikava_render_initial_content_page')) {
    function erotikava_render_initial_content_page(): void
    {
        if (! current_user_can('manage_options')) {
            wp_die('権限がありません。');
        }

        $messages = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['erotikava_seed_action'])) {
            check_admin_referer('erotikava_seed_initial_content');
            $messages = erotikava_import_initial_content();
        } else {
            $stored_messages = get_option('erotikava_initial_content_last_log', []);
            $messages = is_array($stored_messages) ? $stored_messages : [];
        }

        $imported_at = (int) get_option('erotikava_initial_content_imported_at');
        ?>
        <div class="wrap">
          <h1>Erotikava初期データ</h1>
          <p>テーマ用の固定ページ、イベント、画像メディア、ACF初期値を投入します。既存データがある項目は可能な限り保持します。</p>

          <?php if ($imported_at > 0) : ?>
            <div class="notice notice-success inline"><p><?php echo esc_html('前回の実行: ' . wp_date('Y-m-d H:i:s', $imported_at)); ?></p></div>
          <?php endif; ?>

          <?php if ($messages !== []) : ?>
            <div class="notice notice-info inline">
              <p>実行ログ</p>
              <ul>
                <?php foreach ($messages as $message) : ?>
                  <li><?php echo esc_html($message); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="post">
            <?php wp_nonce_field('erotikava_seed_initial_content'); ?>
            <input type="hidden" name="erotikava_seed_action" value="1">
            <?php submit_button('初期データを投入する'); ?>
          </form>
        </div>
        <?php
    }
}
