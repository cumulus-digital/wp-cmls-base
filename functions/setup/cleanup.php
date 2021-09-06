<?php
/**
 * Clean up various cruddy stuff
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// remove version info from head and feeds
\add_filter( 'the_generator', function () {
	return '';
} );

\add_action( 'init', function () {
	// Remove generator meta
	\remove_action( 'wp_head', 'wp_generator' );

	// Remove index rel link
	\remove_action( 'wp_head', 'index_rel_link' );

	// Remove emoji crud
	\remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	\remove_action( 'wp_print_styles', 'print_emoji_styles' );
	\remove_action( 'admin_print_styles', 'print_emoji_styles' );
	\remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	\remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	\remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove MS-live writer
	\remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove Really Simple Discovery
	\remove_action( 'wp_head', 'rsd_link' );

	// Remove Comments Feed
	\remove_action( 'wp_head', 'feed_links_extra', 3 );
} );

/*
 * Hide "uncategorized" taxonomies from sitemap
 */
\add_filter( 'wp_sitemaps_taxonomies_entry', function ( $entry, $term, $tax ) {
	if ( \array_key_exists( 'loc', $entry ) && \mb_strstr( $entry['loc'], '/uncategorized/' ) ) {
		return [];
	}

	return $entry;
}, 99, 3 );

/*
 * Remove Attachment page links in admin
 */
\add_filter( 'attachment_link', '__return_false' );

/*
 * Remove align wide and full for blocks in widget editor
 */
\add_filter( 'block_type_metadata', function ( $metadata ) {
	global $pagenow;

	if ( $pagenow !== 'widgets.php' ) {
		return $metadata;
	}

	if (
		\array_key_exists( 'supports', $metadata )
		&& \array_key_exists( 'align', $metadata['supports'] )
	) {
		if ( $metadata['supports']['align'] === true ) {
			$metadata['supports']['align'] = ['left', 'center', 'right'];
		} elseif ( \is_array( $metadata['supports']['align'] ) ) {
			\array_filter( $metadata['supports']['align'], function ( $val ) {
				if ( \in_array( $val, ['full', 'wide'] ) ) {
					return false;
				}

				return $val;
			} );
		}
	}

	return $metadata;
} );
