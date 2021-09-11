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
		if ( isset( $query->queried_object ) ) {
			$currentQuery = $query->queried_object;

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

// Restrict search results, support "t" query var
function searchOnlyPostTypes( $query ) {
	if ( \is_admin() ) {
		return $query;
	}

	if ( $query->is_main_query() && $query->is_search ) {
		// Excluded by default
		$exclude_types = [
			'nav_menu_item',
			'attachment',
			'revision',
		];
		$exclude_types = \apply_filters( 'exclude_type_from_search', $exclude_types );

		// Search all public, searchable types by default
		$public_types = (array) \get_post_types( [
			'public'              => true,
			'exclude_from_search' => false,
		] );
		$post_types = $public_types;

		if ( ! empty( $_GET['t'] ) ) {
			$post_types   = [];
			$request_type = \explode( ',', $_GET['t'] );

			if ( \count( $request_type ) ) {
				// do not allow searches for certain types
				\array_walk(
					$request_type,
					function ( $type ) use ( &$post_types, $exclude_types, $public_types ) {
						if ( \in_array( \mb_strtolower( $type ), $exclude_types ) ) {
							return;
						}

						if ( \mb_strtolower( $type ) === 'any' ) {
							$post_types = \array_merge( $post_types, $public_types );
						} else {
							$post_types[] = \trim( $type );
						}
					}
				);
			}
		}
		$post_types = \apply_filters( 'search_post_types', $post_types );
		// Remove excluded types from final array
		$post_types = \array_diff( $post_types, $exclude_types );
		$query->set( 'post_type', $post_types );

		// Don't show front page in results
		$front_page = \get_option( 'page_on_front', false );

		if ( $front_page ) {
			$post_not_in   = $query->get( 'post__not_in' );
			$post_not_in[] = $front_page;
			$query->set( 'post__not_in', $post_not_in );
		}

		// Only return published posts
		$query->set( 'post_status', 'publish' );
	}

	return $query;
}
\add_filter( 'pre_get_posts', ns( 'searchOnlyPostTypes' ) );

// Make the site icon URL relative
\add_filter( 'get_site_icon_url', function ( $url ) {
	if ( $url ) {
		return \preg_replace( '#https?://#i', '//', $url );
	}

	return $url;
} );
