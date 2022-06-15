<?php
/**
 * Hacks for WP-Optimize
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_action( 'init', function () {
	if ( ! \class_exists( 'WP_Optimize' ) ) {
		return;
	}

	/*
	* Enforce preloading for minified CSS
	*/
	if ( \is_multisite() ) {
		$config = \get_site_option( 'wpo_minify_config', [] );
	} else {
		$config = \get_option( 'wpo_minify_config', [] );
	}

	$newOptions = \wp_parse_args( [
		//'enabled_css_preload' => true,
		'loadcss' => true,
	], $config );

	if ( $newOptions != $config ) {
		if ( \is_multisite() ) {
			\update_site_option( 'wpo_minify_config', $newOptions );
		} else {
			\update_option( 'wpo_minify_config', $newOptions );
		}
	}
}, 1 );
