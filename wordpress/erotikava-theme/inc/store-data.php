<?php

defined('ABSPATH') || exit;

if (! function_exists('erotikava_get_store_data')) {
    function erotikava_get_store_data(): array
    {
        return [
            'name' => 'Erotikava',
            'tagline' => '千葉初のショースタイルBAR',
            'address' => '〒260-0016 千葉県千葉市中央区栄町35-20 ルミナス千葉1F',
            'nearest_station' => '千葉都市モノレール栄町駅 徒歩1分<br>JR総武線千葉駅東口 徒歩5分',
            'phone_display' => '043-223-6680',
            'phone_href' => 'tel:043-223-6680',
            'hours_html' => '月〜土: 19:00〜LAST<br><span class="hours-note">※基本は日曜日が定休日ですが、<br>祝日などで休みや営業時間が変わる場合があります。<br>詳しくは<a class="inline-link" href="https://www.instagram.com/erotika_va" target="_blank" rel="noopener">Instagram</a>もしくは<a class="inline-link" href="https://x.com/masatoerotikava" target="_blank" rel="noopener">X</a>でご確認ください。</span>',
            'access_html' => '千葉都市モノレール 栄町駅 徒歩1分<br>JR総武線 千葉駅東口 徒歩5分',
            'payment_html' => 'カード可 (Mastercard / VISA / AMEX / JCB)',
            'content_html' => 'ショー / お食事 / カクテル',
            'genre_html' => 'ショー / お食事 / カクテル / VIP個室',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3243.6399456559257!2d140.1193521!3d35.611947199999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x602284b65bb17017%3A0x314aa3cfb6ba1f9a!2zRXJvdGlrYXZhIOOCqOODreODgeOCq-ODtOOCoQ!5e0!3m2!1sja!2sjp!4v1780653073290!5m2!1sja!2sjp',
            'store_image' => 'gallery1.jpg',
            'store_image_alt' => 'Erotikava 店内イメージ',
            'social_links' => [
                [
                    'label' => 'X',
                    'url' => 'https://x.com/masatoerotikava',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M18.9 2h3.3l-7.2 8.2L23.5 22h-6.7l-5.2-6.8L5.6 22H2.3l7.7-8.8L1.9 2h6.8l4.7 6.2L18.9 2zm-1.2 17.9h1.8L7.7 4H5.8l11.9 15.9z"/></svg>',
                ],
                [
                    'label' => 'Instagram',
                    'url' => 'https://www.instagram.com/erotika_va',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm5.2-2.8a1.1 1.1 0 1 1 0 2.2 1.1 1.1 0 0 1 0-2.2z"/></svg>',
                ],
                [
                    'label' => 'Facebook',
                    'url' => 'https://www.facebook.com/masato.kakehi.90',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M14 8h3V4h-3c-3.3 0-5 2-5 5v3H6v4h3v6h4v-6h3.2l.8-4h-4V9c0-.7.3-1 1-1z"/></svg>',
                ],
            ],
            'floating_links' => [
                [
                    'text' => '採用についてはこちら',
                    'url' => 'https://x.com/masatoerotikava',
                    'label' => '採用についてはこちら',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M18.9 2h3.3l-7.2 8.2L23.5 22h-6.7l-5.2-6.8L5.6 22H2.3l7.7-8.8L1.9 2h6.8l4.7 6.2L18.9 2zm-1.2 17.9h1.8L7.7 4H5.8l11.9 15.9z"/></svg>',
                ],
                [
                    'text' => '詳細はこちら',
                    'url' => 'https://www.instagram.com/erotika_va',
                    'label' => '詳細はこちら',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm5.2-2.8a1.1 1.1 0 1 1 0 2.2 1.1 1.1 0 0 1 0-2.2z"/></svg>',
                ],
            ],
            'copyright' => '© 2026 Erotikava',
        ];
    }
}

if (! function_exists('erotikava_render_social_links')) {
    function erotikava_render_social_links(string $class_name): void
    {
        $store = erotikava_get_store_data();
        echo '<div class="' . esc_attr($class_name) . '">';
        foreach ($store['social_links'] as $link) {
            printf(
                '<a href="%1$s" target="_blank" rel="noopener noreferrer" aria-label="%2$s">%3$s</a>',
                esc_url((string) $link['url']),
                esc_attr((string) $link['label']),
                wp_kses((string) $link['svg'], ['svg' => ['viewBox' => true], 'path' => ['d' => true]])
            );
        }
        echo '</div>';
    }
}

if (! function_exists('erotikava_render_footer_contact')) {
    function erotikava_render_footer_contact(): void
    {
        $store = erotikava_get_store_data();
        ?>
        <p><?php echo esc_html('店名: ' . $store['name']); ?></p>
        <p><?php echo esc_html('住所: ' . $store['address']); ?></p>
        <p><?php echo wp_kses_post('最寄駅:<br>' . $store['nearest_station']); ?></p>
        <p>TEL: <a href="<?php echo esc_url($store['phone_href']); ?>"><?php echo esc_html($store['phone_display']); ?></a></p>
        <p><?php echo wp_kses_post('営業時間:<br>' . $store['hours_html']); ?></p>
        <?php
    }
}

if (! function_exists('erotikava_render_floating_social_links')) {
    function erotikava_render_floating_social_links(): void
    {
        $store = erotikava_get_store_data();
        foreach ($store['floating_links'] as $link) {
            printf(
                '<a href="%1$s" target="_blank" rel="noopener noreferrer" aria-label="%2$s"><span>%3$s</span>%4$s</a>',
                esc_url((string) $link['url']),
                esc_attr((string) $link['label']),
                esc_html((string) $link['text']),
                wp_kses((string) $link['svg'], ['svg' => ['viewBox' => true], 'path' => ['d' => true]])
            );
        }
    }
}

