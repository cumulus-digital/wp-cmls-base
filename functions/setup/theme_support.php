<?php
/**
 * Init theme support
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function init_theme_support() {
	\add_theme_support( 'menus' );
	\add_theme_support( 'editor-styles' );
//		\add_editor_style('build/backend.css');
	\add_theme_support( 'html5' );
	\add_theme_support( 'align-wide' );
	\add_theme_support( 'title-tag' );
	\add_theme_support( 'wp-block-styles' );
	\add_theme_support( 'responsive-embeds' );
	\add_theme_support( 'post-thumbnails' );
	\add_theme_support( 'post-formats', [ 'aside', 'gallery', 'video' ] );

	\add_post_type_support( 'page', 'excerpt' );
}
\add_action( 'after_setup_theme', ns( 'init_theme_support' ), 10 );

global $content_width;
$content_width = 1200;
