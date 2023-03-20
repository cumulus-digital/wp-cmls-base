<?php
/**
 * Set HTTP headers including CSP and frame options.
 */

namespace CMLS_Base\Setup\Security;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_action( 'wp_headers', function () {
	// Don't send these headers in the admin
	if ( \is_user_logged_in() || \is_admin() ) {
		return;
	}

	/*
	 * Remove X-Powered-By which may expose PHP version
	 */
	\header_remove( 'X-Powered-By' );

	/*
	 * ATTEMPT to remove Server header which may expose webserver version.
	 * This cannot normally be removed via PHP.
	 */
	\header_remove( 'Server' );

	/*
	 * X-DNS-Prefetch-Control - Proactively perform domain name resolution on both
	 * links that the user may choose to follow as well as URLs for items
	 * referenced by the document
	 */
	\header( 'X-DNS-Prefetch-Control: on' );

	/*
	 * X-Frame-Options: SAMEORIGIN - Prevent web pages from being loaded inside iFrame
	 */
	\header( 'X-Frame-Options: SAMEORIGIN' );

	/*
	 * X-Content-Type-Options: nosniff - Prevent MIME Type sniffing
	 */
	\header( 'X-Content-Type-Options: nosniff' );

	/*
	 * Set script nonce in CSP
	 */
	$csp = [
		"manifest-src 'self'",
		"font-src 'self' data: fonts.googleapis.com fonts.gstatic.com",
		"img-src 'self' data:",
	];

	if ( \defined( 'CMLS_ADD_SCRIPT_NONCE' ) ) {
		$csp[] = "script-src 'nonce-" . CMLS_SCRIPT_NONCE . "'";
	}
	//\header( 'Content-Security-Policy: ' . \implode( '; ', \array_filter( $csp ) ) );

	// Modicrom of support for old IE
	\header( 'X-UA-Compatible: IE=edge,chrome=1' );
} );

/*
 * Last-modified header should reflect content
 */
\add_action( 'send_headers', function () {
	/*
	$current_headers = [];

	foreach ( \headers_list() as $h ) {
		\preg_match( '#^.+?(?=:)#', $h, $key );

		if ( empty( $key ) ) {
			continue;
		}
		$key                                     = \reset( $key );
		$value                                   = \ltrim( $h, $key . ':' );
		$current_headers[\mb_strtolower( $key )] = $value;
	}
	*/
	if ( ! \is_admin() && \is_singular() ) {
		$last_modified = \get_post_modified_time( 'D, d M Y H:i:s', true );

		if ( $last_modified ) {
			\header( 'Last-Modified: ' . $last_modified . ' GMT' );
		}
	}
} );
