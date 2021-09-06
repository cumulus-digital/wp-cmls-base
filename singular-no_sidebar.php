<?php
/**
 * CMLS Base Theme
 * Template Name: Disable Sidebar
 * Template Post Type: post, page
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$args = \array_merge( [
	'show_sidebar' => false,
], isset( $args ) ? $args : [] );

cmls_get_template_part( 'singular', null, $args );
