<?php
/**
 * Set a secure nonce for registered script includes
 */

namespace CMLS_Base\Setup\Security;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

/**
 * Create a unique nonce (WP nonces are not unique by default, add rand()).
 */
$script_nonce = \base64_encode( \random_bytes( 16 ) );
\define( 'CMLS_SCRIPT_NONCE', $script_nonce );

/*
 * Add nonce to scripts loaded through the wp_enqueue_script() or wp_add_inline_script()
 */
\add_filter( 'script_loader_tag', function ( $tag ) {
	return \preg_replace(
		'/<script( )*/',
		'<script nonce="' . CMLS_SCRIPT_NONCE . '"$1',
		$tag
	);
} );
