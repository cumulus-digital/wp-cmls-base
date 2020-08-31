<?php
/**
 * Customizer section SITE IDENTITY
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

function themeCustomizerIdentity($wpc) {
	$wpc->add_setting('text-copyright', array(
		'default' => themeMods::getDefault('text-copyright'),
		'sanitize_callback' => 'sanitize_text_field',
		'sanitize_js_callback' => 'sanitize_text_field'
	));
		$wpc->add_control( 'text-copyright', array(
			'type' => 'text',
			'section' => 'title_tagline',
			'label' => 'Copyright Notice',
			'description' => 'Customize the copyright notice.<br>Available macros: $year'
		));

	// Additional favicon stuff
	$wpc->add_setting( 'color-favicon-mstile', array(
		'default' => themeMods::getDefault('color-favicon-mstile'),
		'sanitize_callback' => 'sanitize_hex_color',
		'sanitize_js_callback' => 'sanitize_hex_color'
	));
		$wpc->add_control(
			new \WP_Customize_Color_Control(
				$wpc,
				'color-favicon-mstile',
				array(
					'label' => 'Windows 10 Tile Color',
					'description' => 'Tile background color on Windows 10 if a visitor adds this site to their start menu.',
					'section' => 'title_tagline',
					'settings' => 'color-favicon-mstile'
				)
			)
		);
	$wpc->add_setting( 'color-favicon-chrome', array(
		'default' => themeMods::getDefault('color-favicon-chrome'),
		'sanitize_callback' => 'sanitize_hex_color',
		'sanitize_js_callback' => 'sanitize_hex_color'
	));
		$wpc->add_control(
			new \WP_Customize_Color_Control(
				$wpc,
				'color-favicon-chrome',
				array(
					'label' => 'Android Theme Color',
					'description' => 'Theme color for the toolbar in Chrome on Android devices.',
					'section' => 'title_tagline',
					'settings' => 'color-favicon-chrome'
				)
			)
		);
	
	$wpc->add_setting( 'color-site-background', array(
		'default' => themeMods::getDefault('color-site-background'),
		'sanitize_callback' => 'sanitize_hex_color'
	));
		$wpc->add_control(
			new \WP_Customize_Color_Control(
				$wpc,
				'color-site-background',
				array(
					'label' => 'Window Background Color',
					'description' => 'Normally not seen except for when the page is short or scrolling is elastic.',
					'section' => 'title_tagline',
					'settings' => 'color-site-background',
					'priority' => 2000
				)
			)
		);
}
\add_action('customize_register', ns('themeCustomizerIdentity'));