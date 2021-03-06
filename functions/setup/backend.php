<?php
/**
 * Admin area scripts and styles
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// Disable theme and plugin editor
define( 'DISALLOW_FILE_EDIT', true );

// Disable the block directory
\add_action(
	'admin_init',
	function() {
		\remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
		\remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
	}
);

function editorSetupStyles() {
	\add_editor_style('build/backend.css');
}
\add_action( 'after_setup_theme', ns('editorSetupStyles'), 11);

function backendSetupScripts() {
	$assets = include(
		theme_path() . '/build/backend.asset.php'
	);
	\wp_enqueue_script(
		PREFIX . '-backend-script',
		theme_url() . '/build/backend.js',
		$assets['dependencies'],
		$assets['version'],
		true
	);
}
\add_action( 'enqueue_block_editor_assets', ns('backendSetupScripts') );
