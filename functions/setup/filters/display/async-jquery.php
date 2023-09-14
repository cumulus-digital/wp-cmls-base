<?php
/**
 * Force jQuery to load async.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {
	if ( $handle !== 'jquery' || \mb_stristr( $tag, 'async' ) ) {
		return $tag;
	}

	return \str_replace( ' src=', ' async src=', $tag );
}, 10, 3 );
