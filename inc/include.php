<?php
define('THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);

//Tools
require_once THEME_DIR . 'tools/acf-sync.php';
require_once THEME_DIR . 'tools/plugins-import.php';
require_once THEME_DIR . 'tools/classic-editor.php';

if (defined('WP_ENV') && WP_ENV === 'development') {
    require_once THEME_DIR . 'tools/uploads-redirect.php';
}

// Include all PHP files from the "theme" folder
foreach (glob(THEME_DIR . 'theme/*.php') as $file) {
    require_once $file;
}
