<?php
/*
 * Filters for acting on ACF post author fields
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function filterPostAuthorForAltAuthor( $display_name ) {
	global $post;

	if ( ! $post || ! $post->ID ) {
		return $display_name;
	}
	$alt_display_name = get_field( 'field_613a67efc94aa', $post->ID );

	if ( ! $alt_display_name || \mb_strlen( $alt_display_name ) < 1 ) {
		return $display_name;
	}

	return $alt_display_name;
}
\add_filter( 'the_author', ns( 'filterPostAuthorForAltAuthor' ), 10, 1 );

function filterPostAuthorLinkForAltAuthor( $link ) {
	global $post;

	if ( ! $post || ! $post->ID ) {
		return $link;
	}
	$alt_display_name = get_field( 'field_613a67efc94aa', $post->ID );

	if ( ! $alt_display_name || \mb_strlen( $alt_display_name ) < 1 ) {
		return $link;
	}

	return $alt_display_name;
}
\add_filter( 'the_author_posts_link', ns( 'filterPostAuthorLinkForAltAuthor' ), 10, 1 );
