<?php
/**
 * Admin area scripts and styles.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Disable theme and plugin editor
\define( 'DISALLOW_FILE_EDIT', true );

// Disable the block directory
\add_action(
	'admin_init',
	function () {
		\remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
		\remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
	}
);

// Add Reusable Blocks to the admin
\add_action( 'admin_menu', function () {
	\add_menu_page( 'Reusable Blocks', 'Reusable Blocks', 'edit_pages', 'edit.php?post_type=wp_block', '', 'dashicons-block-default', 22 );
} );

// Block editor styles
function editorSetupStyles() {
	\add_editor_style( 'build/default_variables.css' );
	\add_editor_style( 'build/backend.css' );
}
\add_action( 'after_setup_theme', ns( 'editorSetupStyles' ), 11 );

function backendSetupScripts() {
	global $pagenow;

	if ( ! \is_admin() || 'widgets.php' === $pagenow ) {
		return;
	}
	$assets = include theme_path() . '/build/backend.asset.php';
	\wp_enqueue_script(
		PREFIX . '-backend-script',
		theme_url() . '/build/backend.js',
		$assets['dependencies'],
		$assets['version'],
		true
	);
}
\add_action( 'enqueue_block_editor_assets', ns( 'backendSetupScripts' ) );

// Brand the admin bar
\add_action( 'init', function () {
	if ( ! \is_user_logged_in() ) {
		return;
	}

	$logo = \preg_replace(
		'#https?://#i',
		'//',
		\get_site_icon_url()
	);
	if ( ! $logo ) {
		return;
	}

	$cache_key = PREFIX . '-branded_logo-inline_style';

	$inline_style = \get_transient( $cache_key );

	if ( ! $inline_style ) {
		$color_brand     = ThemeMods::get( 'color-brand' );
		$color_highlight = ThemeMods::get( 'color-highlight' );

		$inline_style = "
			#wpadminbar #wp-admin-bar-wp-logo a {
				background: transparent !important;
			}
			#wpadminbar #wp-admin-bar-wp-logo,
			#editor .edit-post-header .edit-post-fullscreen-mode-close.has-icon {
				" . (CSSValidator::validateColor( $color_brand ) ? "background-color: {$color_brand};" : '') . "
				" . ( ! empty($logo) ? "background-image: url(" . esc_url_raw($logo) . ") !important;" : '') . "
				background-position: center center !important;
				background-repeat: no-repeat !important;
				background-size: 70% !important;
			}
			#wpadminbar #wp-admin-bar-wp-logo:hover {
				" . (CSSValidator::validateColor( $color_highlight ) ? "background-color: {$color_highlight};" : '') . "
				" . ( ! empty($logo) ? "background-image: url(" . esc_url_raw($logo) . ") !important;" : '') . "
			}
			#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
				content: '' !important;
			}
			.edit-post-fullscreen-mode-close.has-icon::before {
				box-shadow: none;
			}
			#editor .edit-post-header .edit-post-fullscreen-mode-close.has-icon svg {
				display: none;
			}
		";
		\set_transient( $cache_key, $inline_style, \HOUR_IN_SECONDS );
	}

	\wp_register_style( PREFIX . '-branded_logo', '', array(), false, 'screen' );
	\wp_enqueue_style( PREFIX . '-branded_logo' );
	\wp_add_inline_style(
		PREFIX . '-branded_logo',
		$inline_style
	);
} );

// Brand the login page
\add_action( 'login_enqueue_scripts', function () {
	$cache_key = PREFIX . '-branded_login-inline_style';
	$inline_style = \get_transient($cache_key);

	if ( ! $inline_style ) {
		$logo = \preg_replace(
			'#https?://#i',
			'//',
			\get_site_icon_url()
		);

		$color_masthead_bg = ThemeMods::get( 'color-masthead-background' );
		$color_masthead_fg = ThemeMods::get( 'color-masthead-foreground' );
		$color_brand       = ThemeMods::get( 'color-brand' );
		$color_highlight   = ThemeMods::get( 'color-highlight' );

		$inline_style = "
			body {
				" . (CSSValidator::validateColor( $color_masthead_bg ) ? "background-color: {$color_masthead_bg} !important;" : '') . "
			}
			#login h1 a, .login h1 a {
				" . ( ! empty( $logo ) ? "background-image: url(" . \esc_url_raw($logo) . ") !important;" : '' ) . "
				background-size: contain;
				background-position: center center;
				background-repeat: no-repeat;
				width: 150px;
				height: 150px;
			}
			#loginform {
				border-radius: .5em;
			}
			#wp-submit {
				" . (CSSValidator::validateColor( $color_brand ) ? "background-color: {$color_brand} !important;" : '') . "
			}
			.login #backtoblog a, .login #nav a {
				" . (CSSValidator::validateColor( $color_masthead_fg ) ? "color: {$color_masthead_fg} !important;" : '') . "
			}
			.login #backtoblog a:hover, .login #nav a:hover {
				" . (CSSValidator::validateColor( $color_highlight ) ? "color: {$color_masthead_fg} !important;" : '') . "
			}
		";
		\set_transient( $cache_key, $inline_style, \HOUR_IN_SECONDS );
	}

	\wp_register_style( PREFIX . '-branded_login', '' );
	\wp_enqueue_style( PREFIX . '-branded_login' );

	\wp_add_inline_style(
		PREFIX . '-branded_login',
		$inline_style
	);
} );
\add_action( 'login_headerurl', function () {
	return \home_url();
} );

\add_action( 'customize_save_after', function() {
	\delete_transient(PREFIX . '-branded_logo-inline_style'); 
	\delete_transient(PREFIX . '-branded_login-inline_style');
} );
