<?php
/**
 * Global inits
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Attempt to force auto-updates
\add_filter( 'auto_update_plugin', '__return_true' );
\add_filter( 'auto_update_theme', '__return_true' );

// Set up global script included in both front and backend.
function registerGlobalScript() {
	$assets = include theme_path() . '/build/global.asset.php';
	\wp_register_script(
		PREFIX . '_script-global',
		theme_url() . '/build/global.js',
		$assets['dependencies'],
		$assets['version'],
		false
	);

	\wp_register_style(
		PREFIX . '_customizer_vars',
		theme_url() . '/build/default_variables.css',
		[],
		null,
		'all'
	);
}
function enqueueGlobalScript() {
	\wp_enqueue_script( PREFIX . '_script-global' );
	\wp_enqueue_style( PREFIX . '_customizer_vars' );
}

\add_action( 'wp_loaded', ns( 'registerGlobalScript' ) );
\add_action( 'wp_enqueue_scripts', ns( 'enqueueGlobalScript' ) );
\add_action( 'admin_enqueue_scripts', ns( 'enqueueGlobalScript' ) );
