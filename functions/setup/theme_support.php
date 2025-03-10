<?php

/**
 * Init theme support.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function init_theme_support() {
	\add_theme_support( 'custom-logo' );
	\add_theme_support( 'menus' );
	\add_theme_support( 'editor-styles' );
	// \add_editor_style('build/backend.css');
	\add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	\add_theme_support( 'align-wide' );
	\add_theme_support( 'custom-spacing' );
	\add_theme_support( 'custom-units' );

	\add_theme_support( 'title-tag' );
	\add_theme_support( 'wp-block-styles' );
	\add_theme_support( 'responsive-embeds' );
	\add_theme_support( 'post-thumbnails' );
	// \add_theme_support( 'post-formats', [ ] );
	\remove_theme_support( 'post-formats' );

	// /\remove_theme_support( 'core-block-patterns' );
	\remove_theme_support( 'block-templates' );
	// \remove_theme_support( 'widgets-block-editor' );

	\add_post_type_support( 'page', 'excerpt' );

	/*
	\add_theme_support( 'editor-font-sizes', [
		[
			'name' => 'Small',
			'size' => '0.7em',
			'slug' => 'small',
		],
		[
			'name' => 'Medium',
			'size' => '0.85em',
			'slug' => 'medium',
		],
		[
			'name' => 'Normal',
			'size' => '1em',
			'slug' => 'normal',
		],
		[
			'name' => 'Bigger',
			'size' => '1.25em',
			'slug' => 'bigger',
		],
		[
			'name' => 'Large',
			'size' => '1.5em',
			'slug' => 'large',
		],
		[
			'name' => 'Huge',
			'size' => '2em',
			'slug' => 'huge',
		],
	] );
	 */

	// Disable custom font sizes for all but admin
	if ( ! \current_user_can( 'administrator' ) ) {
		\add_theme_support( 'disable-custom-font-sizes' );
	}
}
\add_action( 'after_setup_theme', ns( 'init_theme_support' ), 10 );

/*
global $content_width;
$content_width = 1200;
 */

// Separate stylesheets for blocks
\add_filter( 'should_load_separate_core_block_assets', '__return_true' );
