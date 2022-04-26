<?php
/**
 * Hacks for All In One SEO
 */

namespace CMLS_Base\Setup\PluginHacks;

use CMLS_Base\CMLS_Cache;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Collapse the AIOSEO editor metabox by default
\add_action( 'current_screen', function () {
	$screen = \get_current_screen();

	if ( \is_admin() && \property_exists( $screen, 'post_type' ) ) {
		\add_filter( "get_user_option_closedpostboxes_{$screen->post_type}", function ( $closed ) {
			$closed[] = 'aioseo-settings';

			return $closed;
		}, 10, 1 );
	}
} );

// Remove AIOSEO bug from admin bar
\add_action( 'admin_bar_menu', function ( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'aioseo-main' );
}, 9999 );

// Remove AIOSEO crap from admin menu
\add_action( 'admin_menu', function () {
	// Redirects under Tools
	\remove_submenu_page( 'tools.php', \admin_url( '/admin.php?page=aioseo-redirects' ) );
}, 9999 );

// Exclude specifically noindexed content from site search results
\add_filter( 'pre_get_posts', function ( $query ) {
	if ( \is_admin() ) {
		return $query;
	}

	if ( \function_exists( 'aioseo' ) && $query->is_main_query() && $query->is_search ) {
		$cache_key   = 'aioseo_posts_noindex';
		$cache_group = 'CMLS_Base::aioseoPostsNoindex';

		if ( $cached = CMLS_Cache::get( $cache_key, $cache_group ) ) {
			$noIndex = $cached;
		} else {
			global $wpdb;
			$noIndex = $wpdb->get_col( "
				SELECT post_id FROM {$wpdb->prefix}aioseo_posts WHERE robots_noindex = 1
			" );
			CMLS_Cache::set( $cache_key, $noIndex, $cache_group );
		}

		if ( $noIndex && \count( $noIndex ) ) {
			$post_not_in = $query->get( 'post__not_in' );
			$post_not_in = \array_merge( $post_not_in, $noIndex );
			$query->set( 'post__not_in', $post_not_in );
		}
	}

	return $query;
} );
// Clear the noindex cache on post save
\add_filter( 'post_save', function () {
	CMLS_Cache::delete( 'aioseo_posts_noindex', 'CMLS_Base::aioseoPostsNoindex' );
} );
