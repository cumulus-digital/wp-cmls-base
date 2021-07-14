<?php
/**
 * Customizer section SITE IDENTITY
 */

namespace CMLS_Base;

use WP_Customize_Color_Control;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function themeCustomizerIdentity( $wpc ) {
	$wpc->add_setting( 'text-copyright', [
		'default'              => themeMods::getDefault( 'text-copyright' ),
		'sanitize_callback'    => ns( 'themeCustomizer_sanitizeSimpleHTML' ),
		'sanitize_js_callback' => ns( 'themeCustomizer_sanitizeSimpleHTML' ),
	] );
	$wpc->add_control( 'text-copyright', [
		'type'        => 'text',
		'section'     => 'title_tagline',
		'label'       => 'Copyright Notice',
		'description' => 'Customize the copyright notice.<br>Available macros: $year<br>Allowed HTML tags:<br>A BR EM STRONG SMALL',
	] );

	// Additional favicon stuff
	$wpc->add_setting( 'color-favicon-mstile', [
		'default'              => themeMods::getDefault( 'color-favicon-mstile' ),
		'sanitize_callback'    => 'sanitize_hex_color',
		'sanitize_js_callback' => 'sanitize_hex_color',
	] );
	$wpc->add_control(
		new WP_Customize_Color_Control(
				$wpc,
				'color-favicon-mstile',
				[
					'label'       => 'Windows 10 Tile Color',
					'description' => 'Tile background color on Windows 10 if a visitor adds this site to their start menu.',
					'section'     => 'title_tagline',
					'settings'    => 'color-favicon-mstile',
				]
			)
	);
	$wpc->add_setting( 'color-favicon-chrome', [
		'default'              => themeMods::getDefault( 'color-favicon-chrome' ),
		'sanitize_callback'    => 'sanitize_hex_color',
		'sanitize_js_callback' => 'sanitize_hex_color',
	] );
	$wpc->add_control(
		new WP_Customize_Color_Control(
				$wpc,
				'color-favicon-chrome',
				[
					'label'       => 'Android Theme Color',
					'description' => 'Theme color for the toolbar in Chrome on Android devices.',
					'section'     => 'title_tagline',
					'settings'    => 'color-favicon-chrome',
				]
			)
	);

	$wpc->add_setting( 'color-site-background', [
		'default'           => themeMods::getDefault( 'color-site-background' ),
		'sanitize_callback' => 'sanitize_hex_color',
	] );
	$wpc->add_control(
		new WP_Customize_Color_Control(
				$wpc,
				'color-site-background',
				[
					'label'       => 'Window Background Color',
					'description' => 'Normally not seen except for when the page is short or scrolling is elastic.',
					'section'     => 'title_tagline',
					'settings'    => 'color-site-background',
					'priority'    => 2000,
				]
			)
	);
}
\add_action( 'customize_register', ns( 'themeCustomizerIdentity' ) );
