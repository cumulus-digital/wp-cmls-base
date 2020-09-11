<?php
/**
 * Clean up various cruddy stuff
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// remove version info from head and feeds
function remove_identity() {
	return '';
}
\add_filter('the_generator', ns('remove_identity'));

// Remove emoji crud
\remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
\remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove MS-live writer
\remove_action('wp_head', 'wlwmanifest_link');

// Remove Really Simple Discovery
\remove_action('wp_head', 'rsd_link');

// Remove Comments Feed
\remove_action( 'wp_head', 'feed_links_extra', 3 );

// Remove Yoast annoyances
if (defined('WPSEO_VERSION')) {
	// Remove Yoast ad
	// https://buddydev.com/remove-this-site-is-optimized-with-the-yoast-seo-plugin-vx-y-z/
	\add_action( 'template_redirect', function () {

		if ( ! class_exists( 'WPSEO_Frontend' ) ) {
			return;
		}

		$instance = \WPSEO_Frontend::get_instance();

		// make sure, future version of the plugin does not break our site.
		if ( ! method_exists( $instance, 'debug_mark') ) {
			return ;
		}

		// ok, let us remove the love letter.
		\remove_action( 'wpseo_head', array( $instance, 'debug_mark' ), 2 );
	}, 9999 );

	// Move Yoast post box to bottom
	\add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );
	
	// Remove Yoast comments
	\add_filter( 'wpseo_debug_markers', '__return_false' );

	// Remove Yoast admin notifications
	\add_action('admin_init', function() {
		if (class_exists('Yoast_Notification_Center')) {
			$yoast_nc = \Yoast_Notification_Center::get();
			\remove_action('admin_notices', array($yoast_nc, 'display_notifications'));
			\remove_action('all_admin_notices', array($yoast_nc, 'display_notifications'));
		}
	});
}

// Remove users from automatically generated sitemap in WP 5.5
\add_filter(
    'wp_sitemaps_add_provider',
    function($provider, $name = null) {
		if (is_a($provider, 'WP_Sitemaps_Users')) {
			return false;
		}
		return $provider;
	}
);