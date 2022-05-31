<?php
/**
 * Helper functions
 */

namespace CMLS_Base;

use WP_Query;
use WP_Term;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

if ( ! \defined( __NAMESPACE__ . '\CMLS_HELPERS_IMPORTED' ) ) {
	\define( __NAMESPACE__ . '\CMLS_HELPERS_IMPORTED', true );

	/**
	 * Namespace a given function or class name, given as a string.
	 *
	 * @param string $str
	 * @param string $ns
	 *
	 * @return string
	 */
	function ns( $str, $ns = __NAMESPACE__ ) {
		return $ns . '\\' . $str;
	}

	/**
	 * Return the URL of this theme's directory URL.
	 *
	 * @return string
	 */
	function theme_url() {
		return \untrailingslashit( \get_template_directory_uri() );
	}

	/**
	 * Return the URL of the active theme's directory URL. If a child theme
	 * is active, this will return that theme's URL.
	 *
	 * @return string
	 */
	function child_theme_url() {
		return \untrailingslashit( \get_stylesheet_directory_uri() );
	}

	/**
	 * Return the filesystem path of this theme's directory.
	 *
	 * @return string
	 */
	function theme_path() {
		return \untrailingslashit( \get_template_directory() );
	}

	/**
	 * Return the filesystem path of the active theme directory.
	 * If a child theme is active, this will return that theme's path.
	 *
	 * @return void
	 */
	function child_theme_path() {
		return \untrailingslashit( \get_stylesheet_directory() );
	}

	/**
	 * find and return an array value by key, with an optional default value
	 * if the key does not exist.
	 *
	 * @param array  $array
	 * @param string $key
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	function gav( $array, $key, $default = null ) {
		if (
			\is_array( $array )
			&& \array_key_exists( $key, $array )
		) {
			return $array[$key];
		}

		return $default;
	}

	/**
	 * Determine if a given array key value is filled
	 *
	 * @param array  $array
	 * @param string $key
	 *
	 * @return bool
	 */
	function hav( $array, $key ) {
		if (
			\is_array( $array )
			&& \array_key_exists( $key, $array )
			&& ! empty( gav( $array, $key ) )
		) {
			return true;
		}

		return false;
	}

	/**
	 * Return a basic post title without "protected" or "private" prepends,
	 * but still filtered by the_title filter.
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	function base_post_title( $post = 0 ) {
		$post = \get_post( $post );
		$id   = isset( $post->ID ) ? $post->ID : 0;

		$alt_title = \get_field( 'cmls-alt_title', $id, null );

		if ( $alt_title ) {
			return \apply_filters( 'the_title', $alt_title, $id );
		}

		$title = isset( $post->post_title ) ? $post->post_title : '';

		return \apply_filters( 'the_title', $title, $id );
	}

	/**
	 * Convert a given hex color value to an array of R, G, and B values
	 *
	 * @param string $hex
	 *
	 * @return array
	 */
	function getRGB( $hex ) {
		$r = 0;
		$g = 0;
		$b = 0;

		if ( \mb_strlen( $hex ) === 4 ) {
			list( $r, $g, $b ) = \sscanf( $hex, '#%1x%1x%1x' );
		} else {
			list( $r, $g, $b ) = \sscanf( $hex, '#%2x%2x%2x' );
		}

		return [$r, $g, $b];
	}

	/**
	 * Convert a given hex value to an "R, G, B" string
	 *
	 * @param string $hex
	 *
	 * @return string
	 */
	function rgbS( $hex ) {
		return \implode( ', ', getRGB( \esc_html( $hex ) ) );
	}

	/**
	 * Return the copyright field from the theme customizer
	 *
	 * @return string
	 */
	function getCopyright() {
		$copyright = themeCustomizer_sanitizeSimpleHTML( themeMods::getRaw( 'text-copyright' ) );
		$copyright = \str_replace( '$year', \date( 'Y' ), $copyright );

		return $copyright;
	}

	/**
	 * Determine if the current WP query is paginated
	 *
	 * @return bool
	 */
	function is_paginated() {
		global $wp_query;

		$posts_per_page         = $wp_query->get( 'posts_per_page' );
		$posts_per_archive_page = $wp_query->get( 'posts_per_archive_page' );

		// allow for infinite pages
		if ( $posts_per_page === -1 || ( \is_archive() && $posts_per_archive_page === -1 ) ) {
			return false;
		}

		return $wp_query->max_num_pages > 1;
	}

	/**
	 * Fetch a relative link to a file post's actual image file
	 *
	 * @param mixed $post
	 *
	 * @return string|null
	 */
	function getURLFromFilePost( $post ) {
		if ( $post ) {
			$filepost = \get_post( $post );

			if (
				$filepost
				&& \property_exists( $filepost, 'guid' )
			) {
				//var_dump($filepost);
				return \wp_make_link_relative( $filepost->guid );
			}
		}

		return null;
	}

	/**
	 * Fetch and generate bodyclasses for a given post id
	 * from custom field settings.
	 *
	 * @param int $id
	 *
	 * @return void
	 */
	function generateBodyClasses( $id = null ) {
		$page_custom_fields = \get_fields( $id );

		if ( gav( $page_custom_fields, 'cmls-header_options-begin_under_masthead' ) ) {
			BodyClasses::add( 'begin_under_masthead' );

			if ( gav( $page_custom_fields, 'cmls-header_options-transparent_masthead' ) ) {
				BodyClasses::add( 'transparent_masthead' );
			}
		}

		if ( gav( $page_custom_fields, 'cmls-footer_options-disable_bottom_padding' ) ) {
			BodyClasses::add( 'disable_bottom_padding' );
		}
	}

	// Figure out what type of archive this is
	function make_post_class() {
		$arch_type = '';
		$post_type = \get_post_type();
		$qo        = \get_queried_object();

		if ( \is_search() ) {
			return 'search';
		}

		if ( \is_post_type_archive() ) {
			$arch_type = 'post-type-archive';
			$post_type = \get_query_var( 'post_type' );
		} elseif ( \is_author() ) {
			$arch_type = 'author';
			$post_type = \get_the_author_meta( 'user_nicename' );
		} elseif ( \is_category() ) {
			$arch_type = 'category';
			$post_type = $qo->taxonomy . '-' . $qo->slug;
		} elseif ( \is_tag() ) {
			$arch_type = 'tag';
			$post_type = $qo->taxonomy . '-' . $qo->slug;
		} elseif ( \is_tax() ) {
			$arch_type = 'tax';
			$post_type = $qo->taxonomy . '-' . $qo->slug;
		}

		return \sanitize_html_class( $arch_type . '-' . $post_type );
	}

	/**
	 * Custom get_template_part to use custom locate_template
	 *
	 * @param string $slug
	 * @param string $name
	 * @param string $args
	 */
	function cmls_get_template_part( $slug, $name = null, $args = [] ) {

		// Try to fill $name if not filled
		if ( $name === null && \in_the_loop() ) {
			$name = \get_post_type();
		}

		\do_action( "get_template_part_{$slug}", $slug, $name, $args );
		$templates = [];
		$name      = (string) $name;

		if ( '' !== $name ) {
			$templates[] = "{$slug}-{$name}.php";
		}
		$templates[] = "{$slug}.php";
		\do_action( 'get_template_part', $slug, $name, $templates, $args );

		if ( ! cmls_locate_template( $templates, true, false, $args ) ) {
			return false;
		}
	}

	/**
	 * Custom replacement for locate_template which allows filtering template paths
	 *
	 * @param array|string $template_names
	 * @param bool         $load
	 * @param bool         $require_once
	 * @param array        $args
	 */
	function cmls_locate_template( $template_names, $load = false, $require_once = true, $args = [] ) {
		$paths = [
			STYLESHEETPATH,
			TEMPLATEPATH,
			ABSPATH . WPINC . '/theme-compat',
		];
		$paths = \apply_filters( 'cmls-locate_template_path', $paths );

		$located = '';

		foreach ( (array) $template_names as $template_name ) {
			if ( ! $template_name ) {
				continue;
			}

			foreach ( $paths as $path ) {
				if ( \file_exists( $path . '/' . $template_name ) ) {
					$located = $path . '/' . $template_name;

					break 2;
				}
			}
		}

		if ( $load && '' !== $located ) {
			\load_template( $located, $require_once, $args );
		}

		return $located;
	}

	/**
	 * Select tags used by posts in a specified category
	 *
	 * @param WP_Term $cat
	 * @param string  $tag_type
	 *
	 * @return array
	 */
	function get_category_tags( $cat, $tag_type = 'post_tag' ) {
		global $wpdb;

		if ( ! $cat ) {
			$cat = \get_queried_object();

			if ( ! $cat ) {
				return [];
			}
		}
		$posts = $wpdb->get_col( $wpdb->prepare( "
			SELECT ID FROM {$wpdb->posts}
			LEFT JOIN {$wpdb->term_relationships} as t
				ON ID = t.object_id
			WHERE post_status = 'publish' AND t.term_taxonomy_id = %d
		", $cat->term_id ) );

		if ( \count( $posts ) ) {
			$terms = \wp_get_object_terms( $posts, $tag_type );
			\array_walk( $terms, function ( $term ) {
				$term->link = \get_term_link( $term );
			} );

			return $terms;
		}

		return [];
	}

	/**
	 * Determine if the current query is for a hierarchical post type
	 *
	 * @return bool
	 */
	function check_query_post_type_hierarchical() {
		global $wp_query;

		if ( isset( $wp_query->query['post_type'] ) ) {
			return \is_post_type_hierarchical( $wp_query->query['post_type'] );
		}

		return false;
	}

	/**
	 * Get ACF fields for an object, if none exist, try its ancestors
	 *
	 * @param object $term
	 *
	 * @return array
	 */
	function get_parent_fields( $term ) {
		$fields = \get_fields( $term );

		if (
				! $fields
				&& \property_exists( $term, 'parent' )
				&& $term->parent !== 0
			) {
			$parents = \get_ancestors( $term->term_id, $term->taxonomy );

			foreach ( $parents as $parent ) {
				$pTerm   = \get_term( $parent );
				$pFields = \get_fields( $pTerm );

				if ( $pFields ) {
					return $pFields;
				}
			}
		}

		return $fields;
	}

	/**
	 * Get a tax's ACF options, optionally bubbling up tax hierarchy
	 *
	 * @param string         $selector ACF field identifier
	 * @param string|WP_Term $term     Term identifier
	 *
	 * @return string|array
	 */
	function get_tax_acf( $selector, $term ) {
		$fieldObj  = \get_field_object( $selector, $term, true, true );
		$useParent = \get_field( 'field_612877c8d84d3', $term );

		if ( $useParent ) {
			$parents   = \get_ancestors( $term->term_id, $term->taxonomy );
			$gotParent = false;

			foreach ( $parents as $parent ) {
				$pTerm     = \get_term( $parent );
				$useParent = \get_field( 'field_612877c8d84d3', $pTerm );

				if ( $useParent ) {
					continue;
				}

				$gotParent = true;
				$fieldObj  = \get_field_object( $selector, $pTerm, true, true );
			}

			if ( ! $gotParent ) {
				return [];
			}
		}

		return $fieldObj['value'];
	}

	/**
	 * Array filter to remove truly empty values
	 *
	 * @param array $array
	 *
	 * @return array
	 */
	function remove_empty( $array ) {
		return \array_filter( $array, function ( $val ) {
			return not_empty( $val );
		} );
	}

	/**
	 * Determine if a value is actually empty and not just falsy. Optionally can also
	 * check if a key is set on an array using the 2nd parameter before checking for empty.
	 *
	 * @param mixed  $val
	 * @param string $key            (optional)
	 * @param bool   $false_is_empty (optional) If true, a falsy value will be treated as empty
	 *
	 * @return bool
	 */
	function not_empty( $val, $key = null, $false_is_empty = false ) {
		if ( $key && ! isset( $val[$key] ) ) {
			return false;
		} elseif ( $key ) {
			$val = $val[$key];
		}

		if ( \is_string( $val ) ) {
			return (bool) \mb_strlen( \trim( $val ) );
		}

		if ( \is_numeric( $val ) || \is_bool( $val ) ) {
			if ( $false_is_empty ) {
				return (bool) $val;
			}

			return true;
		}

		return false;

		return \mb_strlen( \trim( $val ) ) || \is_numeric( $val ) || \is_bool( $val );
	}

	/**
	 * Resolve args and default post display
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function resolve_post_display_args( $args = [] ) {
		$default = [
			'display_format'          => \apply_filters( 'display-archive-display_format', null ),
			'show_description'        => \apply_filters( 'display-archive-show_description', true ),
			'show_sidebar'            => \apply_filters( 'display-archive-show_sidebar', true ),
			'show_image'              => \apply_filters( 'display-archive-show_image', null ),
			'show_title'              => \apply_filters( 'display-archive-show_title', null ),
			'show_date'               => \apply_filters( 'display-archive-show_date', null ),
			'show_author'             => \apply_filters( 'display-archive-show_author', null ),
			'show_category'           => \apply_filters( 'display-archive-shoow_category', null ),
			'show_source'             => \apply_filters( 'display-archive-show_source', null ),
			'show_excerpt'            => \apply_filters( 'display-archive-show_excerpt', null ),
			'thumbnail_size'          => 'large',
			'header-background_color' => null,
			'header-background_image' => null,
			'header-text_color'       => null,
		];

		return \apply_filters( 'display-archive-all', \array_merge( $default, (array) $args ) );
	}

	/**
	 * Retrieve display args for a taxonomy archive
	 *
	 * @param WP_Term $term
	 * @param array   $overrides Custom overrides
	 *
	 * @return array
	 */
	function get_tax_display_args( $term = null, $overrides = [] ) {
		$return = [];

		if ( \is_category() || \is_tag() || \is_tax() ) {
			$term   = $term ? $term : \get_queried_object();
			$fields = get_tax_acf( 'field_6128514db85a1', $term );

			if ( $fields ) {
				$return = \array_merge( [], remove_empty( $fields ) );

				// Handle any existing values using the depricated 'format' key
				if ( isset( $fields['format'] ) ) {
					$return['display_format'] = $fields['format'];
				}

				if ( isset( $fields['posts'] ) ) {
					$return = \array_merge( $return, remove_empty( $fields['posts'] ) );
				}

				if ( isset( $fields['header'] ) ) {
					$return = \array_merge( $return, remove_empty( $fields['header'] ) );
				}
			}
		}

		$return = \array_merge( $return, $overrides );

		return resolve_post_display_args( $return );
	}

	/**
	 * Determine if a given taxonomy query includes children
	 *
	 * @param WP_Query $query (optional) Query to check, or check global $wp_query
	 *
	 * @return bool
	 */
	function tax_query_includes_children( $query = null ) {
		if ( ! $query ) {
			global $wp_query;
			$query = $wp_query;
		}

		if (
			\property_exists( $query, 'query_vars' )
			&& \array_key_exists( 'tax_query', $query->query_vars )
		) {
			return \in_array( true, \array_column( $query->query_vars['tax_query'], 'include_children' ) );
		}

		if (
			\property_exists( $query, 'tax_query' )
			&& \property_exists( $query->tax_query, 'queries' )
		) {
			return \in_array( true, \array_column( $query->tax_query->queries, 'include_children' ) );
		}

		return false;
	}

	/**
	 * Determine if the screen has the global sidebar and it has widgets
	 *
	 * @param bool $force Force a return value
	 *
	 * @return bool
	 */
	function has_global_sidebar( $force = null ) {
		if ( ! \is_null( $force ) ) {
			return \is_active_sidebar( 'global' ) && $force;
		}

		return \is_active_sidebar( 'global' );
	}

	/**
	 * Determine if the theme supports block editor for widgets
	 *
	 * @return bool
	 */
	function has_widget_block_editor() {
		return (bool) \get_theme_support( 'widgets-block-editor' );
	}
}
