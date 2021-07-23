<?php
/**
 * Clean up various cruddy stuff
 */

namespace CMLS_Base;

use WPSEO_Frontend;
use Yoast_Notification_Center;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// remove version info from head and feeds
\add_filter( 'the_generator', function () {
	return '';
} );

\add_action( 'init', function () {
	// Remove generator meta
	\remove_action( 'wp_head', 'wp_generator' );

	// Remove index rel link
	\remove_action( 'wp_head', 'index_rel_link' );

	// Remove emoji crud
	\remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	\remove_action( 'wp_print_styles', 'print_emoji_styles' );
	\remove_action( 'admin_print_styles', 'print_emoji_styles' );
	\remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	\remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	\remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove MS-live writer
	\remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove Really Simple Discovery
	\remove_action( 'wp_head', 'rsd_link' );

	// Remove Comments Feed
	\remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Remove Yoast annoyances
	if ( \defined( 'WPSEO_VERSION' ) ) {
		// Remove Yoast ad
		// https://buddydev.com/remove-this-site-is-optimized-with-the-yoast-seo-plugin-vx-y-z/
		\add_action( 'template_redirect', function () {
			if ( ! \class_exists( 'WPSEO_Frontend' ) ) {
				return;
			}

			$instance = WPSEO_Frontend::get_instance();

			// make sure, future version of the plugin does not break our site.
			if ( ! \method_exists( $instance, 'debug_mark' ) ) {
				return;
			}

			// ok, let us remove the love letter.
			\remove_action( 'wpseo_head', [ $instance, 'debug_mark' ], 2 );
		}, 9999 );

		// Move Yoast post box to bottom
		\add_filter( 'wpseo_metabox_prio', function () {
			return 'low';
		} );

		// Remove Yoast comments
		\add_filter( 'wpseo_debug_markers', '__return_false' );

		// Remove Yoast admin notifications
		\add_action( 'admin_init', function () {
			if ( \class_exists( 'Yoast_Notification_Center' ) ) {
				$yoast_nc = Yoast_Notification_Center::get();
				\remove_action( 'admin_notices', [$yoast_nc, 'display_notifications'] );
				\remove_action( 'all_admin_notices', [$yoast_nc, 'display_notifications'] );
			}
		} );
	}
} );

/*
 * Hide "uncategorized" taxonomies from sitemap
 */
\add_filter( 'wp_sitemaps_taxonomies_entry', function ( $entry, $term, $tax ) {
	if ( \array_key_exists( 'loc', $entry ) && \mb_strstr( $entry['loc'], '/uncategorized/' ) ) {
		return [];
	}

	return $entry;
}, 99, 3 );

/*
 * Remove Attachment page links in admin
 */
\add_filter( 'attachment_link', '__return_false' );
