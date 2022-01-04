<?php
/**
 * Custom menu walker to clean up menu displays
 */

namespace CMLS_Base;

use Walker_Nav_Menu;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

class CleanMenuWalker extends Walker_Nav_Menu {

	public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
		$indent = ( $depth ) ? \str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? [] : (array) $item->classes;

		$class_names = \join(
			' ',
			\apply_filters(
				'nav_menu_css_class',
				\array_filter( $classes ),
				$item
			)
		);
		$class_names = \esc_attr( $class_names );

		$filtered_title = \apply_filters( 'the_title', $item->title, $item->ID );

		$output .= "{$indent}<li itemprop='name' id='menu-item-{$item->ID}' class='{$class_names}'>";

		$attributes = [
			'itemprop' => ! empty( $item->itemprop ) ? \esc_html( $item->itemprop ) : 'url',
			'role'     => ! empty( $item->role ) ? \esc_html( $item->role ) : 'menuitem',
			'tabindex' => ! empty( $item->tabindex ) ? \esc_html( $item->tabindex ) : '0',
		];

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
			$desc = \wp_kses( $item->description, ['em', 'i', 'strong', 'b', 'small', 'u'] );
			$item_output .= "<small>{$desc}</small>";
		}

		$item_output .= "</a>{$args->after}";

		$output .= \apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
