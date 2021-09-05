<?php
/**
 * Frontend scripts and styles
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function frontendScriptsAndStyles() {
	if (
		$GLOBALS['pagenow'] != 'wp-login.php'
		&& ! \is_admin()
	) {
		$assets = include theme_path() . '/build/frontend.asset.php';
		\wp_register_script(
			PREFIX . '_script-frontend',
			theme_url() . '/build/frontend.js',
			$assets['dependencies'],
			$assets['version'],
			true
		);
		\wp_enqueue_script( PREFIX . '_script-frontend' );

		\wp_register_style(
			PREFIX . '_style',
			theme_url() . '/build/frontend.css',
			[], //array(PREFIX . '_customizer_vars'),
			null,
			'all'
		);
		\wp_enqueue_style( PREFIX . '_style' );
	}
}
\add_action( 'wp_enqueue_scripts', ns( 'frontendScriptsAndStyles' ) );

// Basic post queries are limited to 12
function setQueryLimitToTwelve( $query ) {
	if ( \is_admin() || ! $query->is_main_query() ) {
		return;
	}
	$query->set( 'posts_per_page', 12 );

	return $query;
}
\add_action( 'pre_get_posts', ns( 'setQueryLimitToTwelve' ) );

// remove title on homepage
function removePageTitleOnHomepage( $title ) {
	if ( \is_home() || \is_front_page() ) {
		return false;
	}
}
\add_filter( 'pre_get_document_title', ns( 'removePageTitleOnHomepage' ), 999, 1 );

// Remove prefix from private/protected titles
function filterRemovePrivateProtectedPrepend( $format ) {
	if ( ! \is_admin() ) {
		return '%s';
	}

	return $format;
}
\add_filter( 'protected_title_format', ns( 'filterRemovePrivateProtectedPrepend' ) );
\add_filter( 'private_title_format', ns( 'filterRemovePrivateProtectedPrepend' ) );

// Remove prefix from archive titles
function filterRemoveArchivePrepend( $title ) {
	if ( \is_category() ) {
		$title = \single_cat_title( '', false );
	} elseif ( \is_tag() ) {
		$title = \single_tag_title( '', false );
	} elseif ( \is_author() ) {
		$title = '<span class="vcard">' . \get_the_author() . '</span>';
	} elseif ( \is_post_type_archive() ) {
		$title = \post_type_archive_title( '', false );
	} elseif ( \is_tax() ) {
		$title = \single_term_title( '', false );
	}

	return $title;
}
\add_filter( 'get_the_archive_title', ns( 'filterRemoveArchivePrepend' ) );

function endExcerptWithSentence( $excerpt ) {
	// Return manually created excerpts immediately
	if ( \has_excerpt() ) {
		return $excerpt;
	}
	$excerpt = \explode( '(#~)', \str_replace( ['…', '? ', '! ', '. '], ['($/s$/)', '?(#~)', '!(#~)', '. (#~)'], \preg_replace( '!\s+!', ' ', \trim( $excerpt ) ) ) );

	return ( ! \mb_strpos( \end( $excerpt ), '($/s$/)' ) ) ? \implode( ' ', $excerpt ) : \implode( ' ', \array_slice( $excerpt, 0, -1 ) );
}
\add_filter( 'get_the_excerpt', ns( 'endExcerptWithSentence' ) );

// Alter the excerpt ellipsis
function replaceExcerptMore( $more ) {
	return '…';
}
\add_filter( 'excerpt_more', ns( 'replaceExcerptMore' ) );

function letPagesOverrideArchives( &$query ) {
	if ( \is_admin() || ! $query->is_main_query() ) {
		return $query;
	}

	if ( $query->is_archive() ) {
		$currentQuery = \get_queried_object();

		if ( $currentQuery ) {
			$slug = false;

			if ( \property_exists( $currentQuery, 'slug' ) ) {
				$slug = $currentQuery->slug;
			} elseif ( \property_exists( $currentQuery, 'rewrite' ) ) {
				if ( \array_key_exists( 'slug', $currentQuery->rewrite ) ) {
					$slug = $currentQuery->rewrite['slug'];
				}
			}

			if ( $slug ) {
				global $wpdb;
				$check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(post_title) FROM {$wpdb->posts} WHERE post_name=%s AND post_type='page' LIMIT 1", $slug ) );

				if ( $check ) {
					$query->init();
					$query->set( 'post_type', 'page' );
					$query->set( 'name', $slug );
					$query->get_posts();

					return $query;
				}
			}
		}
	}

	return $query;
}
\add_action( 'pre_get_posts', ns( 'letPagesOverrideArchives' ) );

// Allow restricting search results
function searchOnlyPostTypes( $query ) {
	if ( \is_admin() ) {
		return $query;
	}

	if ( $query->is_main_query() && $query->is_search ) {
		if ( ! empty( $_GET['t'] ) ) {
			$request_type = \explode( ',', $_GET['t'] );

			if ( \count( $request_type ) ) {
				$types = [];
				// do not allow searches for certain types
				\array_walk( $request_type, function ( $type ) use ( &$types ) {
					switch ( \mb_strtolower( $type ) ) {
						case 'nav_menu_item':
						case 'attachment':
						case 'revision':
							return;
					}

					if ( \mb_strtolower( $type ) === 'any' ) {
						$types[] = 'page';
						$types[] = 'post';
					}
					$types[] = \trim( $type );
				} );
				$query->set( 'post_type', $types );
			}
		}
		$front_page = [\get_option( 'page_on_front', false )];

		if ( $front_page ) {
			$query->set( 'post__not_in', $front_page );
		}
		$query->set( 'post_status', 'publish' );
	}

	return $query;
}
\add_filter( 'pre_get_posts', ns( 'searchOnlyPostTypes' ) );
