<?php
/**
 * Plugins Import Function
 */

require_once THEME_DIR . 'tools/class-tgm-plugin-activation.php';

/**
 * Register Required Plugins
 */
function Theme_Register_Required_plugins()
{
    $plugins = [
        [
            'name'               => 'Advanced Custom Fields PRO',
            'slug'               => 'acf',
            'source'             => get_template_directory() . '/inc/plugins/advanced-custom-fields-pro.zip',
            'required'           => true,
            'version'            => '',
            'force_activation'   => true,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ],
        [
            'name'               => 'Advanced Custom Fields: Font Awesome Field',
            'slug'               => 'advanced-custom-fields-font-awesome',
            'source'             => '',
            'required'           => true,
            'version'            => '',
            'force_activation'   => true,
            'force_deactivation' => false,
            'external_url'       => 'https://downloads.wordpress.org/plugin/advanced-custom-fields-font-awesome.4.1.2.zip',
            'is_callable'        => '',
        ],
        [
            'name'               => 'Advanced Custom Fields: Extended',
            'slug'               => 'acf-extended',
            'source'             => '',
            'required'           => true,
            'version'            => '',
            'force_activation'   => true,
            'force_deactivation' => false,
            'external_url'       => 'https://downloads.wordpress.org/plugin/acf-extended.0.9.1.zip',
            'is_callable'        => '',
        ]
    ];

    $config = [
        'id'           => 'white',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => 'Required plugins for current theme',
        'strings'      => [
            'page_title'                      => __('Install Required Plugins', 'white'),
            'menu_title'                      => __('Install Plugins', 'white'),
            'installing'                      => __('Installing Plugin: %s', 'white'),
            'updating'                        => __('Updating Plugin: %s', 'white'),
            'oops'                            => __('Something went wrong with the plugin API.', 'white'),
            'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'white'),
            'update_link'                     => _n_noop('Begin updating plugin', 'Begin updating plugins', 'white'),
            'activate_link'                   => _n_noop('Begin activating plugin', 'Begin activating plugins', 'white'),
            'return'                          => __('Return to Required Plugins Installer', 'white'),
            'plugin_activated'                => __('Plugin activated successfully.', 'white'),
            'activated_successfully'          => __('The following plugin was activated successfully:', 'white'),
            'complete'                        => __('All plugins installed and activated successfully. %1$s', 'white'),
            'dismiss'                         => __('Dismiss this notice', 'white'),
            'notice_cannot_install_activate'  => __('There are one or more required or recommended plugins to install, update or activate.', 'white'),
            'contact_admin'                   => __('Please contact the administrator of this site for help.', 'white'),
            'nag_type'                        => '',
        ],
    ];

    tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'Theme_Register_Required_plugins');
