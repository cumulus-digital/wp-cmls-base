<?php
/**
 * CMLS Base Theme
 * Adds a natural_title orderby field
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_filter( 'posts_orderby', function ( $orderby, $query ) {
	global $wpdb;

	if ( \mb_strpos( $orderby, "{$wpdb->posts}.post_title" ) !== false ) {
		$matches = 'A|An|The';

		$orderby = \str_replace(
			"{$wpdb->posts}.post_title",
			"REGEXP_REPLACE( {$wpdb->posts}.post_title, '^({$matches})[[:space:]]+', '' )",
			$orderby
		);
	}

	return $orderby;
}, 10, 2 );
