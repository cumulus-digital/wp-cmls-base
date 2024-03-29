<?php
/**
 * CMLS Base Theme
 * Helper to manage CSS classes for the body tag
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

class BodyClasses {

public static $classes = [];

	public static function add( $class ) {
		self::$classes[] = $class;
	}

	public static function get() {
		return self::$classes;
	}

	public static function has( $class ) {
		return \in_array( $class, self::$classes );
	}

	public static function output( $classes ) {
		return \array_merge( self::get(), $classes );
	}
}
\add_filter( 'body_class', [ns( 'BodyClasses' ), 'output'] );
