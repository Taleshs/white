<?php 
function urp_setup_uploads_redirect() {
    // Add settings page to the admin menu
    add_action('admin_menu', function () {
        add_options_page(
            'Uploads Redirect Settings', 
            'Uploads Redirect',          
            'manage_options',            
            'uploads_redirect',          
            function () {
                ?>
                <div class="wrap">
                    <h1>Upload redirection settings</h1>
                    <form method="post" action="options.php">
                        <?php
                        settings_fields('urp_options_group');
                        do_settings_sections('uploads_redirect');
                        ?>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">Production URL</th>
                                <td>
                                    <input type="text" name="urp_redirect_url" value="<?php echo esc_attr(get_option('urp_redirect_url')); ?>" class="regular-text" />
                                </td>
                            </tr>
                        </table>
                        <?php submit_button(); ?>
                    </form>
                </div>
                <?php
            }
        );
    });

    // Register setting for storing the redirect URL
    add_action('admin_init', function () {
        register_setting('urp_options_group', 'urp_redirect_url');
    });

    // Handle redirection of missing uploads
    add_action('template_redirect', function () {
        $request_uri = $_SERVER['REQUEST_URI'];
        $redirect_url = get_option('urp_redirect_url');

        if (!empty($redirect_url) && preg_match('/^\/wp-content\/uploads\/.*/', $request_uri)) {
            $file_path = ABSPATH . $request_uri;

            if (!file_exists($file_path)) {
                wp_redirect(rtrim($redirect_url, '/') . $request_uri, 302);
                exit;
            }
        }
    });
}

// Call the function to set up everything
urp_setup_uploads_redirect();
