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
	'users_can_register'           => false,
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
 * Remove users from core sitemap
 */
\add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	if ( $name === 'users' ) {
		return false;
	}

	return $provider;
}, 10, 2 );

/*
 * Disable User REST endpoints
 */
\add_filter( 'rest_endpoints', function ( $endpoints ) {
	$disable = [
		'/wp/v2/users',
		'/wp/v2/users/me',
		'/wp/v2/users/(?P<id>[\d]+)',
		'/acf/v3/users',
		'/acf/v3/users/(?P<id>[\\d]+)/?(?P<field>[\\w\\-\\_]+)?',
	];

	foreach ( $disable as $key => $endpoint ) {
		if ( isset( $endpoints[$endpoint] ) ) {
			unset( $endpoints[$endpoint] );
		}
	}

	return $endpoints;
} );
