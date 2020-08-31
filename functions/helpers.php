<?php
/**
 * Helper functions
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

/**
 * Namespace a given function or class name, given as a string.
 *
 * @param string $str
 * @return string
 */
function ns($str) {
	return __NAMESPACE__ . '\\' . $str;
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
 * @param array $array
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function gav($array, $key, $default = null) {
	if (
		is_array($array)
		&& array_key_exists($key, $array)
	) {
		return $array[$key];
	}
	return $default;
}

/**
 * Determine if a given array key value is filled
 *
 * @param array $array
 * @param string $key
 * @return boolean
 */
function hav($array, $key) {
	if (
		is_array($array)
		&& array_key_exists($key, $array)
		&&  ! empty(gav($array, $key))
	) {
		return true;
	}
	return false;
}

/**
 * Return a basic post title without "protected" or "private" prepends,
 * but still filtered by the_title filter.
 *
 * @param integer $post_id
 * @return string
 */
function base_post_title($post = 0) {
	$post = \get_post($post);
	$id    = isset($post->ID) ? $post->ID : 0;

	$alt_title = \get_field('cmls-alt_title', $id);
	if ($alt_title) {
		return \apply_filters('the_title', $alt_title, $id);
	}

	$title = isset($post->post_title) ? $post->post_title : '';
	return \apply_filters('the_title', $title, $id);
}

/**
 * Convert a given hex color value to an array of R, G, and B values
 *
 * @param string $hex
 * @return array
 */
function getRGB($hex) {
	$r = 0; $g = 0; $b = 0;
	if (strlen($hex) === 4) {
		list($r, $g, $b) = sscanf($hex, "#%1x%1x%1x");
	} else {
		list($r, $g, $b) = sscanf($hex, "#%2x%2x%2x");
	}
	return array($r, $g, $b);
}

/**
 * Convert a given hex value to an "R, G, B" string
 *
 * @param string $hex
 * @return string
 */
function rgbS($hex) {
	return implode(', ', getRGB(\esc_html($hex)));
}

/**
 * Return the copyright field from the theme customizer
 *
 * @return string
 */
function getCopyright() {
	$copyright = \esc_html(themeMods::get('text-copyright'));
	$copyright = str_replace('$year', date('Y'), $copyright);
	return $copyright;
}

/**
 * Determine if the current WP query is paginated
 *
 * @return boolean
 */
function is_paginated() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}

/**
 * Fetch a relative link to a file post's actual image file
 *
 * @param mixed $post
 * @return string|null
 */
function getURLFromFilePost($post) {
	if ($post) {
		$filepost = \get_post($post);
		if (
			$filepost
			&& property_exists($filepost, 'guid')
		) {
			//var_dump($filepost);
			return \wp_make_link_relative($filepost->guid);
		}
	}
	return null;
}