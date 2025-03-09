<?php 

if (! function_exists('Setup_theme')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @return void
     */
    function Setup_theme()
    {
        // Make this theme available for translation.
        load_theme_textdomain('theme-rushmore-v2', get_template_directory() . '/languages');

        // Theme supports
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('menus');
        add_theme_support('html5', array( 'gallery' ));

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Register Theme Menu Locations
        register_nav_menus(
            array(
            'main-menu' => __('Main Menu', 'theme-rushmore-v2'),
            ) 
        );
    }

}
add_action('after_setup_theme', 'Setup_theme');


add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<p>(\s*\[submit[^\]]+\])\s*<\/p>/', '$1', $content);
    return $content;
});
