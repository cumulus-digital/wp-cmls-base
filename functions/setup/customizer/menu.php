<?php
/**
 * Customizer section NAV LABEL
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

use WP_Customize_Control;
use WP_Customize_Media_Control;
use WPTRT\Customize\Control\ColorAlpha;

function themeCustomizerNav( $wpc ) {
	$wpc->add_setting( 'setting-main_menu-include_search', [
		'default'              => themeMods::getDefault( 'setting-main_menu-include_search' ),
		'sanitize_callback'    => ns( 'themeCustomizer_sanitizeCheckbox' ),
		'sanitize_js_callback' => ns( 'themeCustomizer_sanitizeCheckbox' ),
	] );
	$wpc->add_control( 'setting-main_menu-include_search', [
		'type'    => 'checkbox',
		'section' => 'cmls-main_menu-style',
		'label'   => 'Include Search Field',
	] );

	$wpc->add_section( 'cmls-main_menu-style', [
		'title'    => 'Header Menu Styles',
		'panel'    => 'nav_menus',
		'priority' => 30,
	] );
	$wpc->add_setting( 'color-main_menu-background', [
		'default'           => themeMods::getDefault( 'color-main_menu-background' ),
		'sanitize_callback' => ns( 'themeCustomizer_sanitizeColorString' ),
	] );
	$wpc->add_control(
		new ColorAlpha(
					$wpc,
					'color-main_menu-background',
					[
						'label'    => 'Background Color',
						'section'  => 'cmls-main_menu-style',
						'settings' => 'color-main_menu-background',
					]
				)
	);
	$wpc->add_setting( 'color-main_menu-foreground', [
		'default'           => themeMods::getDefault( 'color-main_menu-foreground' ),
		'sanitize_callback' => ns( 'themeCustomizer_sanitizeColorString' ),
	] );
	$wpc->add_control(
		new ColorAlpha(
					$wpc,
					'color-main_menu-foreground',
					[
						'label'    => 'Text Color',
						'section'  => 'cmls-main_menu-style',
						'settings' => 'color-main_menu-foreground',
					]
				)
	);
	$wpc->add_setting( 'color-main_menu-foreground-hover_foreground', [
		'default'           => themeMods::getDefault( 'color-main_menu-foreground-hover_foreground' ),
		'sanitize_callback' => ns( 'themeCustomizer_sanitizeColorString' ),
	] );
	$wpc->add_control(
		new ColorAlpha(
					$wpc,
					'color-main_menu-foreground-hover_foreground',
					[
						'label'    => 'Item Hover Text Color',
						'section'  => 'cmls-main_menu-style',
						'settings' => 'color-main_menu-foreground-hover_foreground',
					]
				)
	);
	$wpc->add_setting( 'color-main_menu-foreground-hover_background', [
		'default'           => themeMods::getDefault( 'color-main_menu-foreground-hover_background' ),
		'sanitize_callback' => ns( 'themeCustomizer_sanitizeColorString' ),
	] );
	$wpc->add_control(
		new ColorAlpha(
					$wpc,
					'color-main_menu-foreground-hover_background',
					[
						'label'    => 'Item Hover Background Color',
						'section'  => 'cmls-main_menu-style',
						'settings' => 'color-main_menu-foreground-hover_background',
					]
				)
	);

	$wpc->add_setting( 'file-main_menu-background', [
		'default'              => themeMods::getDefault( 'file-main_menu-background' ),
		'sanitize_callback'    => ns( 'themeCustomizer_requireImage' ),
		'sanitize_js_callback' => ns( 'themeCustomizer_requireImage' ),
	] );
	$wpc->add_control(
		new WP_Customize_Media_Control(
					$wpc,
					'file-main_menu-background',
					[
						'label'     => 'Background Image',
						'section'   => 'cmls-main_menu-style',
						'mime_type' => 'image',
					]
				)
	);

	$wpc->add_setting( 'setting-main_menu-background-position', [
		'default'              => themeMods::getDefault( 'setting-main_menu-background-position' ),
		'sanitize_callback'    => ns( 'themeCustomizer_sanitizeBackgroundPosition' ),
		'sanitize_js_callback' => ns( 'themeCustomizer_sanitizeBackgroundPosition' ),
	] );
	$wpc->add_control(
		new WP_Customize_Control(
					$wpc,
					'setting-main_menu-background-position',
					[
						'label'   => 'Background Image Position',
						'section' => 'cmls-main_menu-style',
						'type'    => 'select',
						'choices' => [
							'top left'      => 'Top Left',
							'top center'    => 'Top Center',
							'top right'     => 'Top Right',
							'center left'   => 'Center Left',
							'center center' => 'Center Center',
							'center right'  => 'Center Right',
							'bottom left'   => 'Bottom Left',
							'bottom center' => 'Bottom Center',
							'bottom right'  => 'Bottom Right',
						],
					]
				)
	);

	$wpc->add_setting( 'setting-main_menu-background-size', [
		'default'              => themeMods::getDefault( 'setting-main_menu-background-size' ),
		'sanitize_callback'    => ns( 'themeCustomizer_sanitizeBackgroundSize' ),
		'sanitize_js_callback' => ns( 'themeCustomizer_sanitizeBackgroundSize' ),
	] );
	$wpc->add_control(
		new WP_Customize_Control(
					$wpc,
					'setting-main_menu-background-size',
					[
						'label'   => 'Background Image Size',
						'section' => 'cmls-main_menu-style',
						'type'    => 'select',
						'choices' => [
							'cover'   => 'Cover',
							'contain' => 'Contain',
							'100%'    => '100%',
							'auto'    => 'None',
						],
					]
				)
	);
}
\add_action( 'customize_register', ns( 'themeCustomizerNav' ) );
