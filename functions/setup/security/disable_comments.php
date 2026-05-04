<?php
/**
 * Disable defaults
 */

namespace CMLS_Base\Setup\Security;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

/*
 * Disable pingbacks, pings, comments, and registration
 */
function __return_1() { return 1; }
function __return_closed() { return 'closed'; }
$disable_options = [
	'default_pingback_flag'        => '__return_zero',
	'default_ping_status'          => __NAMESPACE__ . '\\__return_closed',
	'default_comment_status'       => __NAMESPACE__ . '\\__return_closed',
	'close_comments_for_old_posts' => __NAMESPACE__ . '\\__return_1',
	'comments_notify'              => __NAMESPACE__ . '\\__return_1',
	'comment_moderation'           => __NAMESPACE__ . '\\__return_1',
	'comment_registration'         => __NAMESPACE__ . '\\__return_1',
];
foreach ( $disable_options as $key => $value ) {
	add_filter( "pre_option_{$key}", $value );
}


/*
 * Disable comments on attachments
 */
\add_filter( 'wp_insert_post_data', function ( $data ) {
	if ( $data['post_type'] === 'attachment' ) {
		$data['comment_status'] = 'closed';
		$data['ping_status']    = 'closed';
	}

	return $data;
} );

/*
 * Comments are never open.
 */
\add_filter( 'comments_open', '__return_false', 999, 2 );
\add_filter( 'pings_open', '__return_false', 999, 2 );

// Disable comment support for all post types
\add_action( 'init', function () {
	$post_types = \get_post_types();

	foreach ( $post_types as $post_type ) {
		if ( \post_type_supports( $post_type, 'comments' ) ) {
			\remove_post_type_support( $post_type, 'comments' );
			\remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
} );

/*
 * Remove comment references in admin
 */
\add_action( 'admin_init', function () {
	// Remove Comments from dashboard at a glance
	\remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

	// Remove admin nav items
	// Core WP doesn't check if this is an array first!
	global $menu;

	if ( \is_array( $menu ) ) {
		\remove_menu_page( 'edit-comments.php' );
	}

	// Disable comment support for all post types
	$post_types = \get_post_types();

	foreach ( $post_types as $post_type ) {
		// Remove metaboxes
		\remove_meta_box( 'commentsdiv', $post_type, 'normal' );
		\remove_meta_box( 'commentstatusdiv', $post_type, 'normal' );
		\remove_meta_box( 'trackbacksdiv', $post_type, 'normal' );
	}
} );
\add_action( 'admin_bar_menu', function ( $menu ) {
	$menu->remove_node( 'comments' );
} );
\add_action( 'wp_before_admin_bar_render', function () {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );
} );

// Remove comments links from admin bar
\add_action( 'init', function () {
	if ( \is_admin_bar_showing() ) {
		\remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
} );
