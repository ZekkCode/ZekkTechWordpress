<?php
/**
 * ZekkTech Theme functions
 */

if (!defined('ZEKKTECH_VERSION')) {
    define('ZEKKTECH_VERSION', '1.0.0');
}

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
    ]);

    // Site identity & hero
    add_theme_support('custom-logo', [
        'height'      => 32,
        'width'       => 32,
        'flex-width'  => false,
        'flex-height' => false,
        'unlink-homepage-logo' => false,
    ]);

    add_theme_support('custom-header', [
        'width'         => 1920,
        'height'        => 480,
        'flex-height'   => true,
        'flex-width'    => true,
        'uploads'       => true,
        'header-text'   => false,
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'zekktech'),
    ]);
});

/**
 * Paksa atribut width/height logo jadi 32px di semua tempat (termasuk Customizer preview)
 * @param string $html
 * @return string
 */
add_filter('get_custom_logo', function($html){
    if (is_string($html) && strlen($html)) {
        $html = preg_replace('/\bwidth="\d+"/i', 'width="32"', $html);
        $html = preg_replace('/\bheight="\d+"/i', 'height="32"', $html);
    }
    return $html;
});

add_action('wp_enqueue_scripts', function () {
    // Tailwind via CDN (injects styles in head)
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', [], null, false);

    // Fonts (conditional based on Customizer)
    $font = get_theme_mod('zekktech_font', 'inter');
    if ($font === 'poppins') {
        wp_enqueue_style('zekktech-fonts', 'https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800', [], null);
    } elseif ($font === 'system') {
        // no external font, use system stack
    } else { // inter default
        wp_enqueue_style('zekktech-fonts', 'https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800', [], null);
    }

    // Theme stylesheet
    wp_enqueue_style('zekktech-style', get_stylesheet_uri(), [], ZEKKTECH_VERSION);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});

// Helper: Trimmed excerpt length
add_filter('excerpt_length', function ($length) {
    return 30; // ~30 words
}, 999);

// Helper: GitHub URL (can be customized via filter)
function zekktech_get_github_url() {
    $from_mod = get_theme_mod('zekktech_github_url');
    $val = $from_mod ? $from_mod : 'https://github.com/zekktech';
    return apply_filters('zekktech_github_url', $val);
}

// Helper: Get Tentang page URL if exists
function zekktech_get_tentang_url() {
    $page = get_page_by_path('tentang');
    if ($page) return get_permalink($page);
    return home_url('/tentang');
}

// Customizer settings: font, accent color, search placeholder, GitHub URL
add_action('customize_register', function($wp_customize){
    // Section Appearance
    $wp_customize->add_section('zekktech_appearance', [
        'title' => __('Pengaturan Tampilan', 'zekktech'),
        'priority' => 30,
    ]);

    // Font select
    $wp_customize->add_setting('zekktech_font', [
        'default' => 'inter',
        'sanitize_callback' => function($v){
            $allowed = ['inter','poppins','system'];
            return in_array($v, $allowed, true) ? $v : 'inter';
        }
    ]);
    $wp_customize->add_control('zekktech_font', [
        'type' => 'select',
        'section' => 'zekktech_appearance',
        'label' => __('Font Utama', 'zekktech'),
        'choices' => [
            'inter' => 'Inter',
            'poppins' => 'Poppins',
            'system' => 'System UI',
        ]
    ]);

    // Accent color
    $wp_customize->add_setting('zekktech_accent_color', [
        'default' => '#3182ce',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'zekktech_accent_color', [
        'label' => __('Warna Aksen', 'zekktech'),
        'section' => 'zekktech_appearance',
    ]));

    // Search placeholder
    $wp_customize->add_setting('zekktech_search_placeholder', [
        'default' => __('Search...', 'zekktech'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('zekktech_search_placeholder', [
        'type' => 'text',
        'section' => 'zekktech_appearance',
        'label' => __('Placeholder Pencarian', 'zekktech'),
    ]);

    // GitHub URL
    $wp_customize->add_setting('zekktech_github_url', [
        'default' => 'https://github.com/zekktech',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('zekktech_github_url', [
        'type' => 'url',
        'section' => 'zekktech_appearance',
        'label' => __('URL GitHub', 'zekktech'),
    ]);

    // Logo size (px)
    $wp_customize->add_setting('zekktech_logo_width', [
        'default' => 32,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('zekktech_logo_width', [
        'type' => 'number',
        'section' => 'zekktech_appearance',
        'label' => __('Lebar Logo (px)', 'zekktech'),
        'input_attrs' => [
            'min' => 16,
            'max' => 128,
            'step' => 1,
        ],
    ]);
    $wp_customize->add_setting('zekktech_logo_height', [
        'default' => 32,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('zekktech_logo_height', [
        'type' => 'number',
        'section' => 'zekktech_appearance',
        'label' => __('Tinggi Logo (px)', 'zekktech'),
        'input_attrs' => [
            'min' => 16,
            'max' => 128,
            'step' => 1,
        ],
    ]);
});

// Output inline CSS variables based on Customizer selections
add_action('wp_head', function(){
    $accent = get_theme_mod('zekktech_accent_color', '#3182ce');
    $fontSel = get_theme_mod('zekktech_font', 'inter');
    $logoW = (int) get_theme_mod('zekktech_logo_width', 32);
    $logoH = (int) get_theme_mod('zekktech_logo_height', 32);
    if ($fontSel === 'poppins') {
        $fontStack = "'Poppins', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, 'Apple Color Emoji', 'Segoe UI Emoji'";
    } elseif ($fontSel === 'system') {
        $fontStack = "system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, 'Apple Color Emoji', 'Segoe UI Emoji'";
    } else {
        $fontStack = "Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, 'Apple Color Emoji', 'Segoe UI Emoji'";
    }
    echo '<style id="zekktech-inline-vars">';
    echo ':root{--accent-color: '.esc_attr($accent).'; --font-family: '.$fontStack.'; --logo-w: '.max(16,$logoW).'px; --logo-h: '.max(16,$logoH).'px;}';
    echo '.dark{--accent-color: '.esc_attr($accent).';} .warm{--accent-color: '.esc_attr($accent).';}';
    echo '</style>';
});

// Default body class to 'light' for first paint when no preference is stored
add_filter('body_class', function(array $classes){
    if (!in_array('light', $classes, true) && !in_array('dark', $classes, true) && !in_array('warm', $classes, true)) {
        $classes[] = 'light';
    }
    return $classes;
});
