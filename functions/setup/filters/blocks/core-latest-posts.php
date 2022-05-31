<?php
/**
 * CMLS Base Theme
 * Filter the content of core/latest-posts block
 */

namespace CMLS_Base\BlockFilters\CoreLatestPosts;

use DOMDocument;
use DomXPath;
use Exception;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_filter( 'render_block', function ( $content, $block ) {
	if ( $block['blockName'] !== 'core/latest-posts' ) {
		return $content;
	}

	// Wrap post date and author in a .wp-block-latest-posts__post-meta div
	try {
		if ( \mb_strpos( $content, 'wp-block-latest-posts__post-date' ) && \mb_strpos( $content, 'wp-block-latest-posts__post-author' ) ) {
			$use_errors = \libxml_use_internal_errors( true );
			$dom        = new DOMDocument();
			@$dom->loadHTML( $content );
			$xpath = new DomXPath( $dom );

			$posts = $xpath->query( '//ul/li' );

			foreach ( $posts as $post ) {
				$date   = $xpath->query( './/*[contains(concat(" ", normalize-space(@class), " "), "wp-block-latest-posts__post-date")]', $post );
				$author = $xpath->query( './/*[contains(concat(" ", normalize-space(@class), " "), "wp-block-latest-posts__post-author")]', $post );

				if ( $date && $author ) {
					$date   = $date->item( 0 );
					$author = $author->item( 0 );

					$meta_container = $dom->createElement( 'div' );
					$meta_container->setAttribute( 'class', 'wp-block-latest-posts__post-meta' );
					$meta_container->appendChild( $date->cloneNode( true ) );
					$meta_container->appendChild( $author->cloneNode( true ) );

					$post->replaceChild( $meta_container, $author );
					$post->removeChild( $date );
				}
			}
			$content = $dom->saveHTML();
			\libxml_use_internal_errors( $use_errors );
		}
	} catch ( Exception $e ) {
	}

	return $content;
}, 10, 2 );
