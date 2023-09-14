<?php
/**
 * Force enqueued styles to preload.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_filter( 'style_loader_tag', function ( $tag, $handle, $href, $media ) {
	if (
		\is_admin()
		|| \mb_stristr( $href, 'nopreload' )
		|| ( $media !== 'screen' && $media !== 'all' )
		|| ! \apply_filters( 'preload_style_tag', true, $handle )
	) {
		return $tag;
	}

	$return = '
		<link
			rel="preload"
			as="style"
			href="' . \esc_url( $href ) . '"
			id="preload-' . \esc_attr( $handle ) . '"
			onload="this.onload=null; this.rel=\'stylesheet\';"
		>
	';

	if ( \mb_stristr( $href, 'dualpreload' ) ) {
		$return .= '
			<link
				rel="stylesheet"
				href="' . \esc_url( $href ) . '"
				id="' . \esc_attr( $handle ) . '"
			>
		';
	}

	return $return;
}, 10, 4 );
