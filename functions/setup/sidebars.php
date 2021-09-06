<?php
/**
 * Global inits
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_action( 'widgets_init', function () {
	\register_sidebar( [
		'id'            => 'global',
		'name'          => 'Global Content Sidebar',
		'description'   => 'Default global sidebar shown on all single posts, pages, and archives.',
		'before_widget' => '<div class="widget-container">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	] );
} );
