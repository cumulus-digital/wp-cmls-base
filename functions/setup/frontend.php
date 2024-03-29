<?php
/**
 * Frontend scripts and styles.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function frontendScriptsAndStyles() {
	if (
		(
			\array_key_exists( 'pagenow', $GLOBALS )
			&& 'wp-login.php' != $GLOBALS['pagenow']
		)
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
			array(), // array( PREFIX . '_customizer_vars' ),
			null,
		);
		\wp_enqueue_style( PREFIX . '_style' );
	}
}
\add_action( 'wp_enqueue_scripts', ns( 'frontendScriptsAndStyles' ), 1 );

// Basic post queries are limited to 16
function setQueryLimitToSixteen( $query ) {
	if ( \is_admin() || ! $query->is_main_query() ) {
		return;
	}
	$query->set( 'posts_per_page', 16 );

	return $query;
}
\add_action( 'pre_get_posts', ns( 'setQueryLimitToSixteen' ) );

// remove post title on homepage
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

/**
 * Ensure generated excerpts end at a sentence boundary.
 *
 * @param string $excerpt
 *
 * @return string
 */
function endExcerptWithSentence( $excerpt ) {
	// Return manually created excerpts immediately
	if ( \has_excerpt() ) {
		return $excerpt;
	}
	$excerpt = \explode(
		'(#~)',
		\str_replace(
			array( '…', '? ', '! ', '. ' ),
			array( '($/s$/)', '?(#~)', '!(#~)', '. (#~)' ),
			\preg_replace( '!\s+!', ' ', \trim( $excerpt ) )
		)
	);

	return
		( ! \mb_strpos( \end( $excerpt ), '($/s$/)' ) )
			? \implode( ' ', $excerpt )
			: \implode( ' ', \array_slice( $excerpt, 0, -1 ) );
}
\add_filter( 'get_the_excerpt', ns( 'endExcerptWithSentence' ) );

// Alter the excerpt ellipsis
function replaceExcerptMore( $more ) {
	return '…';
}
\add_filter( 'excerpt_more', ns( 'replaceExcerptMore' ) );

/**
 * A page with the same slug as a tax term can override its archive.
 *
 * @param mixed $query
 */
function letPagesOverrideArchives( &$query ) {
	if ( \is_admin() || ! $query->is_main_query() ) {
		return $query;
	}

	if ( $query->is_archive() ) {
		$currentQuery = isset( $query->queried_object ) ? $query->queried_object : \get_queried_object();

		if ( $currentQuery ) {
			$slug = false;

			if ( \property_exists( $currentQuery, 'slug' ) ) {
				$slug = $currentQuery->slug;
			} elseif ( \property_exists( $currentQuery, 'rewrite' ) ) {
				if ( \is_array( $currentQuery->rewrite ) && \array_key_exists( 'slug', $currentQuery->rewrite ) ) {
					$slug = $currentQuery->rewrite['slug'];
				}
			}

			if ( $slug ) {
				global $wpdb;
				$check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(post_title) FROM {$wpdb->posts} WHERE post_name=%s AND post_type='page' AND post_status='publish' LIMIT 1", $slug ) );

				if ( $check ) {
					\do_action( 'qm/debug', 'The requested tax archive has been overridden by a post with the same slug.' );

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
\add_action( 'pre_get_posts', ns( 'letPagesOverrideArchives' ), 1 );

/**
 * Provides filters and default exclusions for what may be discovered in
 * public search.
 *
 * @param mixed $query
 */
function searchOnlyPostTypes( $query ) {
	if ( \is_admin() || ! $query->is_main_query() ) {
		return $query;
	}

	if ( $query->is_search() ) {
		// Default excluded post types
		$exclude_types = array(
			'nav_menu_item',
			'attachment',
			'revision',
		);
		$exclude_types = \apply_filters( 'exclude_type_from_search', $exclude_types );

		// Default excluded taxonomies
		$exclude_taxonomies = array();
		$exclude_taxonomies = \apply_filters( 'exclude_taxonomy_from_search', $exclude_taxonomies );

		// If query is not for a particular post type, search all searchable
		// post types by default
		$post_types   = array();
		$public_types = (array) \get_post_types( array(
			'public'              => true,
			'exclude_from_search' => false,
		) );
		$post_types = $public_types;

		// If the request is for a single post type, limit it
		if ( \array_key_exists( 'post_type', $query->query ) ) {
			$post_types = \array_filter( (array) $query->query['post_type'], function ( $type ) use ( $public_types ) {
				return \in_array( $type, $public_types );
			} );
		}

		// Allow restricting search to a post type
		if ( ! empty( $_GET['t'] ) ) {
			$post_types   = array();
			$request_type = \explode( ',', $_GET['t'] );

			if ( \count( $request_type ) ) {
				// do not allow searches for certain types
				\array_walk(
					$request_type,
					function ( $type ) use ( &$post_types, $exclude_types, $public_types ) {
						if ( \in_array( \mb_strtolower( $type ), $exclude_types ) ) {
							return;
						}

						if ( 'any' === \mb_strtolower( $type ) ) {
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

		if ( \count( $post_types ) ) {
			$query->set( 'post_type', $post_types );
		}

		// Allow restricting search to taxonomies
		if ( \count( $post_types ) ) {
			$tax_query         = array();
			$public_taxonomies = \get_taxonomies( array(
				'public'             => true,
				'publicly_queryable' => true,
				'object_type'        => $post_types,
			), 'names' );

			foreach ( $public_taxonomies as $public_tax ) {
				if ( \array_key_exists( $public_tax, $_GET ) ) {
					$ids = \array_filter( $_GET[$public_tax], function ( $id ) {
						return \is_numeric( $id );
					} );
					$tax_query[] = array(
						'taxonomy' => $public_tax,
						'field'    => 'id',
						'terms'    => $ids,
					);
				}
			}

			if ( \count( $tax_query ) ) {
				$query->set( 'tax_query', $tax_query );
			}
		}

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
\add_filter( 'pre_get_posts', ns( 'searchOnlyPostTypes' ), 1, 1 );

// Remove protocol from favicon URL
\add_filter( 'get_site_icon_url', function ( $url ) {
	if ( $url ) {
		$parts = \array_merge( array(
			'host'     => null,
			'port'     => null,
			'path'     => null,
			'query'    => null,
			'fragment' => null,
		), \wp_parse_url( $url ) );

		$newurl = '//' . $parts['host'];

		if ( $parts['port'] ) {
			$newurl .= ':' . $parts['port'];
		}

		$newurl .= $parts['path'];

		if ( $parts['query'] ) {
			$newurl .= '?' . $parts['query'];
		}

		if ( $parts['fragment'] ) {
			$newurl .= '#' . $parts['fragment'];
		}

		return $newurl;
		// return \wp_make_link_relative( $url );
	}

	return $url;
} );
