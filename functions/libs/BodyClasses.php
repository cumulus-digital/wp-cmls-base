<?php
/**
 * CMLS Base Theme
 * Helper to manage CSS classes for the body tag
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

class BodyClasses {
	static $classes = array();
	static function add($class) {
		self::$classes[] = $class;
	}
	static function get() {
		return self::$classes;
	}
	static function has($class) {
		return in_array($class, self::$classes);
	}
	static function output($classes) {
		return array_merge(self::get(), $classes);
	}
}
\add_filter('body_class', array(ns('BodyClasses'), 'output'));