<?php

/**
 * Fetch global font settings from ACF options.
 */
function acf_global_fonts()
{
    global $theme_styles_primary_font, $theme_styles_secondary_font;

    // Primary Font
    $theme_styles_primary_font = 'Ubuntu';

    // Secondary Font
    $theme_styles_secondary_font = 'Montserrat';
}
add_action('template_redirect', 'acf_global_fonts');

/**
 * Enqueue Google Fonts with preconnect optimizations.
 */
function enqueue_google_fonts_with_preconnect()
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">';

    global $theme_styles_primary_font, $theme_styles_secondary_font;

    $primary_font = !empty($theme_styles_primary_font) ? str_replace(' ', '+', trim($theme_styles_primary_font)) : 'Ubuntu';
    $secondary_font = !empty($theme_styles_secondary_font) ? str_replace(' ', '+', trim($theme_styles_secondary_font)) : 'Montserrat';

    if (empty($secondary_font) || strtolower($secondary_font) === strtolower($primary_font)) {
        $secondary_font = null;
    }

    $google_fonts_url = 'https://fonts.googleapis.com/css2?family=' . $primary_font . ':ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap';

    if ($secondary_font) {
        $google_fonts_url .= '&family=' . $secondary_font . ':ital,wght@0,400;0,600;0,700;1,400;1,600;1,700';
    }

    wp_enqueue_style('theme-google-fonts', $google_fonts_url, [], null);
}

add_action('wp_head', 'enqueue_google_fonts_with_preconnect', 1);
add_action('admin_enqueue_scripts', 'enqueue_google_fonts_with_preconnect');

/**
 * Modify Google Fonts tag for better performance.
 */
function modify_google_fonts_tag($html, $handle, $href, $media)
{
    if ($handle === 'theme-google-fonts') {
        $html = str_replace(
            "rel='stylesheet'",
            "rel='stylesheet' media='print' onload='this.onload=null;this.removeAttribute(\"media\");' fetchpriority='high'",
            $html
        );
    }
    return $html;
}
add_filter('style_loader_tag', 'modify_google_fonts_tag', 10, 4);

/**
 * Enqueue theme assets (styles and scripts).
 */
function enqueue_theme_assets()
{
    $theme_uri  = get_template_directory_uri();
    $theme_path = get_template_directory();

    $assets = [
        'scripts' => [
            'theme-main-js' => '/dist/main.min.js',
        ],
        'styles' => [
            'theme-main-style' => '/dist/style.min.css',
        ]
    ];

    // Register Scripts
    foreach ($assets['scripts'] as $handle => $file) {
        $version = file_exists($theme_path . $file) ? filemtime($theme_path . $file) : false;
        wp_enqueue_script($handle, $theme_uri . $file, [], $version, true);
    }

    // Register Styles
    foreach ($assets['styles'] as $handle => $file) {
        $version = file_exists($theme_path . $file) ? filemtime($theme_path . $file) : false;
        wp_enqueue_style($handle, $theme_uri . $file, [], $version);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');

/**
 * Inject global theme variables into :root CSS.
 */

 function default_theme_schema() {
    $primary_brand_color   = '#F15726';
    $secondary_brand_color = '#263D78';
    $background_color ='#FFFFFF';

    $primary_surface_color = '#FFFFFF';
    $secondary_surface_color = '#FAFAFA';

    $primary_font = 'Ubuntu, sans-serif';
    $secondary_font = 'Montserrat, sans-serif';

    $base_text_color = '#000000';
    $support_text_color = '#2A2A2A';

    echo "<style>
        :root {
            --primary_brand: {$primary_brand_color};
            --secondary_brand: {$secondary_brand_color};
            --body_background: {$background_color};

            --primary_surface: {$primary_surface_color};
            --secondary_surface: {$secondary_surface_color};
            
            --primary-font: '{$primary_font}';
            --secondary-font: '{$secondary_font}';

            --base-text-color: {$base_text_color};
            --support-text-color: {$support_text_color};
        }
    </style>";
}
add_action('wp_head', 'default_theme_schema');
