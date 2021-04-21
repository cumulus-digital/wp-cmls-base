<?php
/**
 * ACF setup continued
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// Disable ACF menu if we're not in a local dev environment
function acfDisableAdminInProd() {
    if (
        strstr(\get_site_url(), '.local') === false &&
        strstr(\get_site_url(), '.dev') === false &&
        strstr(\get_site_url(), 'localhost') === false
    ) {
        \acf_update_setting('show_admin', false);
    }
}
\add_action('acf/init', ns('acfDisableAdminInProd'));

// Handle ACF json defs with child themes
function acfSaveJson() {
    return theme_path() . '/acf-json';
}
\add_filter('acf/settings/save_json', ns('acfSaveJson'));
function acfLoadJson($paths) {
    if (\is_child_theme()) {
        $paths[] = theme_path() . '/acf-json';
        $paths[] = child_theme_path() . '/acf-json';
    }
    return $paths;
}
\add_filter('acf/settings/load_json', ns('acfLoadJson'));

include __DIR__ . '/post_title.php';
include __DIR__ . '/validation.php';