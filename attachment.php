<?php
/**
 * CMLS Base Theme
 * Redirect attachments to parent post or to the file itself
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

global $post;

if ( $post && $post->post_parent ) {
	\wp_redirect( \esc_url( \get_permalink( $post->post_parent ) ), 301 );
	exit;
} else {
	\wp_redirect( \wp_get_attachment_url(), 301 );
	exit;
}
