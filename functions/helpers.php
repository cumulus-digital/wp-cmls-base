<?php

/**
 * Helper functions.
 */

namespace CMLS_Base;

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
	 * Determine if a given array key value is filled.
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
	 * @param int   $post_id
	 * @param mixed $post
	 *
	 * @return string
	 */
	function base_post_title( $post = 0 ) {
		$post = \get_post( $post );
		$id   = isset( $post->ID ) ? $post->ID : 0;

		$alt_title = \get_field( 'cmls-alt_title', $id, false );

		if ( $alt_title ) {
			return \apply_filters( 'the_title', $alt_title, $id );
		}

		$title = isset( $post->post_title ) ? $post->post_title : '';

		return \apply_filters( 'the_title', $title, $id );
	}

	/**
	 * Convert a given hex color value to an array of R, G, and B values.
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

		return array( $r, $g, $b );
	}

	/**
	 * Convert a given hex value to an "R, G, B" string.
	 *
	 * @param string $hex
	 *
	 * @return string
	 */
	function rgbS( $hex ) {
		return \implode( ', ', getRGB( \esc_html( $hex ) ) );
	}

	/**
	 * Sanitize simple HTML.
	 *
	 * @param string $html
	 * @param mixed  $input
	 *
	 * @return string
	 */
	function sanitizeSimpleHTML( $input ) {
		$allowed = array(
			'a' => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
				'rel'    => array(),
			),
			'br' => array(
				'clear' => array(),
			),
			'em' => array(
				'class' => array(),
			),
			'strong' => array(),
			'small'  => array(),
		);

		return \wp_kses( $input, $allowed, array( 'http', 'https', 'sms', 'tel', 'mailto' ) );
	}

	/**
	 * Return the copyright field from the theme customizer.
	 *
	 * @return string
	 */
	function getCopyright() {
		$copyright = sanitizeSimpleHTML( themeMods::getRaw( 'text-copyright' ) );

		return \str_replace( '$year', \date( 'Y' ), $copyright );
	}

	/**
	 * Determine if the current WP query is paginated.
	 *
	 * @return bool
	 */
	function is_paginated() {
		global $wp_query;

		// allow for paging to be disabled
		if ( $wp_query->get( 'nopaging' ) ) {
			return false;
		}

		$posts_per_page         = $wp_query->get( 'posts_per_page' );
		$posts_per_archive_page = $wp_query->get( 'posts_per_archive_page' );

		// allow for infinite pages where nopaging is not properly set
		if ( $posts_per_page === -1 || ( \is_archive() && $posts_per_archive_page === -1 ) ) {
			return false;
		}

		// Otherwise use max_num_pages
		return $wp_query->max_num_pages > 1;
	}

	/**
	 * Fetch a relative link to a file post's actual image file.
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
				return \wp_make_link_relative( $filepost->guid );
			}
		}
	}

	/**
	 * Fetch and generate bodyclasses for a given post id
	 * from custom field settings.
	 *
	 * @param int $id
	 */
	function generateBodyClasses( $id = null ) {
		$page_custom_fields = \get_fields( $id, false );

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
	 * Custom get_template_part to use custom locate_template.
	 *
	 * @param string $slug
	 * @param string $name
	 * @param string $args
	 */
	function cmls_get_template_part( $slug, $name = null, $args = array() ) {
		// Try to fill $name with current post type if not already filled
		if ( $name === null && \in_the_loop() ) {
			$name = \get_post_type();
		}

		\do_action( "get_template_part_{$slug}", $slug, $name, $args );
		$templates = array();
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
	 * Custom replacement for locate_template which allows filtering template paths.
	 *
	 * @param array|string $template_names
	 * @param bool         $load
	 * @param bool         $require_once
	 * @param array        $args
	 */
	function cmls_locate_template( $template_names, $load = false, $require_once = true, $args = array() ) {
		$paths = array(
			STYLESHEETPATH,
			TEMPLATEPATH,
			ABSPATH . WPINC . '/theme-compat',
		);
		$paths = \apply_filters( 'cmls-locate_template_path', $paths );

		$located = '';

		foreach ( (array) $template_names as $template_name ) {
			if ( ! $template_name ) {
				continue;
			}

			foreach ( $paths as $path ) {
				if ( \is_file( $path . '/' . $template_name ) ) {
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
	 * Select tags used by posts in a specified category.
	 *
	 * @param \WP_Term $cat
	 * @param string   $tag_type
	 * @param bool     $include_children
	 *
	 * @return array
	 */
	function get_category_tags( $cat, $tag_type = 'post_tag', $include_children = false ) {
		global $wpdb;

		if ( ! $cat ) {
			$cat = \get_queried_object();
			if ( ! $cat ) {
				return array();
			}
		}

		// Resolve the target Category/Term IDs
		$source_term_ids = array();
		if ( $include_children ) {
			if ( ! $cat->term_id ) {
				$source_term_ids = $wpdb->get_col( $wpdb->prepare( "
					SELECT term_id FROM {$wpdb->term_taxonomy}
					WHERE taxonomy=%s AND parent=0
				", $cat->taxonomy ) );
			} else {
				$children        = \get_term_children( $cat->term_id, $cat->taxonomy );
				$source_term_ids = \array_merge( array( $cat->term_id ), $children );
			}
		} else {
			$source_term_ids = array( $cat->term_id );
		}

		if ( empty( $source_term_ids ) ) {
			return array();
		}

		// Find all terms of $tag_type that are related to published posts
		// which are ALSO in our source categories.
		$placeholders = \implode( ',', \array_fill( 0, \count( $source_term_ids ), '%d' ) );

		$query = $wpdb->prepare( "
			SELECT DISTINCT t.*, tt.*
			FROM {$wpdb->terms} AS t
			INNER JOIN {$wpdb->term_taxonomy} AS tt ON t.term_id = tt.term_id
			INNER JOIN {$wpdb->term_relationships} AS tr1 ON tt.term_taxonomy_id = tr1.term_taxonomy_id
			INNER JOIN {$wpdb->posts} AS p ON tr1.object_id = p.ID
			INNER JOIN {$wpdb->term_relationships} AS tr2 ON p.ID = tr2.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS tt2 ON tr2.term_taxonomy_id = tt2.term_taxonomy_id
			WHERE p.post_status = 'publish'
			AND tt.taxonomy = %s
			AND tt2.term_id IN ({$placeholders})
		", \array_merge( array( $tag_type ), $source_term_ids ) );

		$results = $wpdb->get_results( $query );

		if ( ! empty( $results ) ) {
			$terms = \array_map( function ( $row ) {
				$term       = new \WP_Term( $row );
				$term->link = \get_term_link( $term );

				return $term;
			}, $results );

			return $terms;
		}

		return array();
	}

	/**
	 * Determine if the current query is for a hierarchical post type.
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
	 * Get ACF fields for an object, if none exist, try its ancestors.
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
	 * Get a tax's ACF options. If a tax's "use parent" option is enabled,
	 * bubble up to the first parent that does not "use parent".
	 *
	 * @param string          $selector ACF field identifier
	 * @param string|\WP_Term $term     Term identifier
	 *
	 * @return array
	 */
	function get_tax_acf( $selector, $term ) {
		$term = \get_term( $term );

		if ( ! $term || \is_wp_error( $term ) ) {
			return array();
		}

		$cache_group = 'CMLS_Base::get_tax_acf';
		$cache_key   = $term->term_id;

		$cached = CMLS_Cache::get( $cache_key, $cache_group );
		if ( $cached !== false ) {
			return (array) $cached;
		}

		// Default to the current term's field object
		$fieldObj = \get_field_object( $selector, $term, true, true );

		// Check if "use parent" (field_612877c8d84d3) is enabled for the current term
		$useParent = \get_field( 'field_612877c8d84d3', $term );

		if ( $useParent ) {
			\do_action( 'qm/debug', 'Using parent taxonomy display settings' );

			// If it has no parent, we can't inherit, so return defaults
			if ( empty( $term->parent ) ) {
				\do_action( 'qm/debug', 'Term has no parent, using defaults' );
				$fieldObj = array( 'value' => array() );
			} else {
				$parents   = \get_ancestors( $term->term_id, $term->taxonomy );
				$gotParent = false;

				if ( $parents ) {
					global $wpdb;

					// We must query for the 'use_parent' field name (cmls-tax-use_parent),
					// not the settings group name, to check inheritance status of ancestors.
					$useParentField = \get_field_object( 'field_612877c8d84d3', $term );
					$useParentName  = $useParentField['name'] ?? 'cmls-tax-use_parent';

					$placeholders = \implode( ',', \array_fill( 0, \count( $parents ), '%d' ) );
					$query        = $wpdb->prepare(
						"SELECT term_id, meta_value FROM {$wpdb->termmeta} WHERE meta_key = %s AND term_id IN ({$placeholders})",
						\array_merge( array( $useParentName ), $parents ),
					);

					// Key results by term_id for easy lookup
					$parentMeta = $wpdb->get_results( $query, OBJECT_K );

					foreach ( $parents as $parent_id ) {
						// Check if this ancestor has "use parent" DISABLED (value '0').
						// If it is '0', this is the ancestor whose settings we should use.
						if (
							isset( $parentMeta[ $parent_id ] )
							&& $parentMeta[ $parent_id ]->meta_value == '0'
						) {
							// Fetch the actual settings from the parent
							$fieldObj  = \get_field_object( $selector, 'term_' . $parent_id, true, true );
							$gotParent = true;

							break;
						}
						// Note: If an ancestor isn't in $parentMeta or is '1', we continue bubbling up.
					}
				}

				if ( ! $gotParent ) {
					\do_action( 'qm/debug', 'No parent found with explicit settings, using empty defaults' );
					$fieldObj = array( 'value' => array() );
				}
			}
		}

		$value = $fieldObj['value'] ?? array();
		CMLS_Cache::set( $cache_key, $value, $cache_group );

		return (array) $value;
	}

	// Clear tax ACF cache group when terms are altered
	function clearTaxACFCache( $term_id, $term, $taxonomy ) {
		CMLS_Cache::flushGroup( 'CMLS_Base::get_tax_acf' );
	}
	$clearTaxACFCacheHooks = array(
		'created_term',
		'edited_terms',
		'delete_term',
	);
	foreach ( $clearTaxACFCacheHooks as $hook ) {
		\add_action( $hook, ns( 'clearTaxACFCache' ), 10, 3 );
	}

	/**
	 * Array filter to remove truly empty values.
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
		}
		if ( $key ) {
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
	 * Resolve args and default post display.
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function resolve_post_display_args( $args = array() ) {
		$default = array(
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
			'thumbnail_size'          => 'thumbnail-uncropped',
			'thumbnail_attributes'    => array(),
			'header-background_color' => null,
			'header-background_image' => null,
			'header-text_color'       => null,
		);

		$newargs = \array_merge( $default, (array) $args );

		// Work out sizes attribute
		if ( ! \array_key_exists( 'sizes', $newargs['thumbnail_attributes'] ) ) {
			switch ( $newargs['thumbnail_size'] ) {
				case 'thumbnail-uncropped':
					$newargs['thumbnail_attributes']['sizes'] = '400px';
			}
		}

		return \apply_filters( 'display-archive-all', $newargs );
	}

	/**
	 * Retrieve display args for a taxonomy archive.
	 *
	 * @param \WP_Term $term
	 * @param array    $overrides Custom overrides
	 *
	 * @return array
	 */
	function get_tax_display_args( $term = null, $overrides = array() ) {
		$return = array();

		if ( \is_category() || \is_tag() || \is_tax() ) {
			$term   = $term ? $term : \get_queried_object();
			$fields = get_tax_acf( 'field_6128514db85a1', $term );

			if ( $fields ) {
				$return = \array_merge( array(), remove_empty( $fields ) );

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
	 * Determine if a given taxonomy query includes children.
	 *
	 * @param \WP_Query $query (optional) Query to check, or check global $wp_query
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
	 * Determine if the screen has the global sidebar and it has widgets.
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
	 * Determine if the theme supports block editor for widgets.
	 *
	 * @return bool
	 */
	function has_widget_block_editor() {
		return (bool) \get_theme_support( 'widgets-block-editor' );
	}

	require __DIR__ . '/css-validator.php';
}
