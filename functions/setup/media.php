<?php
/**
 * Media inits and support
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// Allow media to have categories
function registerMediaTaxonomy() {
	\register_taxonomy_for_object_type( 'category', 'attachment' );
}
\add_action( 'init', ns('registerMediaTaxonomy') );

// Allow WP AJAX calls to get images by category
function getImagesByCategory() {
	$category = json_decode($_POST['category'], true);
	if ( ! filter_var($category, FILTER_VALIDATE_INT)) {
		header('HTTP/1.0 400 Bad error');
		echo '{ error: "Bad category." }';
	} else {

		$args = array(
			'category' => $category,
			'post_type' => 'attachment'
		);
		$media = \get_posts($args);
		if ( ! empty($_GET['callback'])) {
			echo $_GET['callback'] . '(' . json_encode($media) . ');';
		} else {
			echo json_encode($media);
		}

	}
}
\add_action('wp_ajax_get_images_by_category', ns('getImagesByCategory'));
\add_action('wp_ajax_nopriv_get_images_by_category', ns('getImagesByCategory'));

// Recognize SVG files
function addSvgToMimes( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
\add_filter( 'upload_mimes', ns('addSvgToMimes') );

// Exclude SVGs from Jetpack Photon, it cannot handle them
function photonExcludeSVG( $val, $src, $tag ) {
	if ( strpos(strtolower($src), '.svg') >= -1) {
		return true;
	}
	return $val;
}
\add_filter( 'jetpack_photon_skip_image', ns('photonExcludeSVG'), 10, 3 );
