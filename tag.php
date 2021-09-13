<?php
/**
 * CMLS Base Theme
 * Post tag archives
 * Mainly just override display format so post tag archives are always lists
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_filter( 'display-archive-all', function ( $args ) {
	if ( ! \is_main_query() || ! \is_tag() ) {
		return $args;
	}
	$args['display_format'] = 'list';

	return $args;
} );
include 'archive.php';
