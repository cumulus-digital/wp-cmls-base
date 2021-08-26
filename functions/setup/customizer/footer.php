<?php
/**
 * Customizer section FOOTER
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

use CMLS_Base\Vendors\WPTRT\Customize\Control\ColorAlpha;
use WP_Customize_Media_Control;

// Register customizable colors
function themeCustomizerFooter( $wpc ) {
	$wpc->add_panel( 'cmls-footer', [
		'title'    => 'Footer',
		'priority' => 103,
	] );

	$wpc->add_section( 'cmls-footer-colors', [
		'title'    => 'Colors',
		'panel'    => 'cmls-footer',
		'priority' => 30,
	] );
	$wpc->add_setting( 'color-footer-background', [
		'default'           => themeMods::getDefault( 'color-footer-background' ),
		'sanitize_callback' => ns( 'themeCustomizer_sanitizeColorString' ),
	] );
	$wpc->add_control(
		new ColorAlpha(
			$wpc,
			'color-footer-background',
			[
				'label'    => 'Footer Background',
				'section'  => 'cmls-footer-colors',
				'settings' => 'color-footer-background',
			]
		)
	);
	$wpc->add_setting( 'color-footer-foreground', [
		'default'           => themeMods::getDefault( 'color-footer-foreground' ),
		'sanitize_callback' => ns( 'themeCustomizer_sanitizeColorString' ),
	] );
	$wpc->add_control(
		new ColorAlpha(
			$wpc,
			'color-footer-foreground',
			[
				'label'    => 'Footer Text',
				'section'  => 'cmls-footer-colors',
				'settings' => 'color-footer-foreground',
			]
		)
	);

	$wpc->add_section( 'cmls-footer-images', [
		'title'    => 'Images',
		'panel'    => 'cmls-footer',
		'priority' => 31,
	] );
	$wpc->add_setting( 'file-footer-logo', [
		'default'              => themeMods::getDefault( 'file-footer-logo' ),
		'sanitize_callback'    => ns( 'themeCustomizer_requireImage' ),
		'sanitize_js_callback' => ns( 'themeCustomizer_requireImage' ),
	] );
	$wpc->add_control(
		new WP_Customize_Media_Control(
			$wpc,
			'file-footer-logo',
			[
				'label'       => 'Footer logo',
				'description' => 'Defaults to Masthead Logo.',
				'section'     => 'cmls-footer-images',
				'mime_type'   => 'image',
			]
		)
	);

	/*
	$wpc->add_section( 'footer-text', array(
		'title' => 'Text & Copyright',
		'panel' => 'footer',
		'priority' => 32
	));
			$wpc->add_setting('text-copyright', array(
				'default' => themeMods::getDefault('text-copyright'),
				'sanitize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => 'sanitize_text_field'
			));
				$wpc->add_control( 'text-copyright', array(
					'type' => 'text',
					'section' => 'footer-text',
					'label' => 'Copyright Notice',
					'description' => 'Customize the footer copyright notice.<br>Available macros: $year'
				));
	*/
}
\add_action( 'customize_register', ns( 'themeCustomizerFooter' ) );
