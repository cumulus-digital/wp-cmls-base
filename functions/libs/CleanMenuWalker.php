<?php

/**
 * Custom menu walker to clean up menu displays.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

class CleanMenuWalker extends \Walker_Nav_Menu {
	/**
		 * Traverse elements to create list from elements.
		 *
		 * This override efficiently filters out items referencing non-published posts
		 * using a single lightweight ID-only query to minimize memory overhead.
		 *
		 * @param array $elements  list of elements
		 * @param int   $max_depth max depth to traverse
		 * @param mixed ...$args   Additional arguments.
		 *
		 * @return string resulting HTML
		 */
	public function walk( $elements, $max_depth, ...$args ) {
		$post_ids = array();
		foreach ( $elements as $item ) {
			if ( 'post_type' === $item->type ) {
				$post_ids[] = (int) $item->object_id;
			}
		}

		$published_ids = array();
		if ( ! empty( $post_ids ) ) {
			// Fetch ONLY the IDs of posts that are actually published.
			$published_ids = \get_posts( array(
				'post__in'               => $post_ids,
				'post_type'              => 'any',
				'post_status'            => 'publish',
				'posts_per_page'         => -1,
				'fields'                 => 'ids',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			) );

			// Ensure we have an array of integers for reliable comparison.
			$published_ids = \array_map( 'intval', $published_ids );
		}

		// Filter the elements list.
		$elements = \array_filter( $elements, function ( $item ) use ( $published_ids ) {
			if ( 'post_type' === $item->type ) {
				return \in_array( (int) $item->object_id, $published_ids, true );
			}

			return true;
		} );

		return parent::walk( $elements, $max_depth, ...$args );
	}

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = \str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'sub-menu' );

		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param string[] $classes array of the CSS classes that are applied to the menu `<ul>` element
		 * @param stdClass $args    an object of `wp_nav_menu()` arguments
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = \implode( ' ', \apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . \esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul{$class_names} role='menu'>{$n}";
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? \str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = \join(
			' ',
			\apply_filters(
				'nav_menu_css_class',
				\array_filter( $classes ),
				$item,
			),
		);
		$class_names = \esc_attr( $class_names );

		$filtered_title = \apply_filters( 'the_title', $item->title, $item->ID );

		$role = ! empty( $item->role ) ? \esc_html( $item->rol ) : 'menuitem';

		$output .= "{$indent}<li itemprop='name' id='menu-item-{$item->ID}' role='{$role}' class='{$class_names}'>";

		$attributes = array(
			'itemprop' => ! empty( $item->itemprop ) ? \esc_html( $item->itemprop ) : 'url',
			'tabindex' => ! empty( $item->tabindex ) ? \esc_html( $item->tabindex ) : '0',
		);

		if ( ! empty( $item->url ) ) {
			$attributes['href'] = $item->url;
		}

		if ( ! empty( $item->attr_title ) ) {
			$attributes['title'] = $item->attr_title;
		} else {
			$attributes['aria-label'] = $filtered_title;
		}

		if ( ! empty( $item->target ) ) {
			$attributes['target'] = $item->target;

			if ( $item->target === '_blank' && empty( $item->xfn ) ) {
				$item->xfn = 'noopener';
			}
		}

		if ( ! empty( $item->xfn ) ) {
			$attributes['rel'] = $item->xfn;
		}

		$attribute_string = \implode( ' ', \array_map( function ( $val, $key ) {
			$key = \esc_attr( $key );
			$val = \esc_attr( $val );

			return "{$key}='{$val}'";
		}, $attributes, \array_keys( $attributes ) ) );

		if ( \is_array( $args ) ) {
			if ( ! \array_key_exists( 'show_description', $args ) ) {
				$args['show_description'] = false;
			}
			$args = (object) $args;
		}

		$item_output = "{$args->before}<a {$attribute_string}>";
		$item_output .= "{$args->link_before}{$filtered_title}{$args->link_after}";

		if ( ! empty( $item->description ) && $args->show_description ) {
			$desc = \wp_kses( $item->description, array( 'em', 'i', 'strong', 'b', 'small', 'u' ) );
			$item_output .= "<small>{$desc}</small>";
		}

		$item_output .= "</a>{$args->after}";

		$output .= \apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
