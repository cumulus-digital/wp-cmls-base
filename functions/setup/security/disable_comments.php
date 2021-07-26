<?php
/**
 * Disable defaults
 */

namespace CMLS_Base\Setup\Security;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

/**
 * Disable pingbacks, pings, comments, and registration
 */
$disable_options = [
	'default_pingback_flag'        => false,
	'default_ping_status'          => false,
	'default_comment_status'       => false,
	'close_comments_for_old_posts' => true,
	'comments_notify'              => true,
	'comment_moderation'           => true,
	'comment_registration'         => true,
];

foreach ( $disable_options as $key => $value ) {
	\update_option( $key, $value );
}

/*
 * Disable comments on attachments
 */
\add_filter( 'wp_insert_post_data', function ( $data ) {
	if ( $data['post_type'] === 'attachment' ) {
		$data['comment_status'] = 'closed';
		$data['ping_status'] = 'closed';
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
	// Remove admin nav items
	\remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	\remove_menu_page( 'edit-comments.php' );

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

// Remove comments links from admin bar
\add_action( 'init', function () {
	if ( \is_admin_bar_showing() ) {
		\remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
} );
