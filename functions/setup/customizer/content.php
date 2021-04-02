<?php
/**
 * Customizer section Content
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

use \WPTRT\Customize\Control\ColorAlpha;

// Register customizable colors
function themeCustomizerContent($wpc) {
	$wpc->add_panel( 'cmls-content', array(
		'title' => 'Content',
		'priority' => 99
    ));
    
    $wpc->add_section( 'cmls-content-font', array(
        'title' => 'Font',
        'panel' => 'cmls-content',
		'priority' => 30
	));
        $wpc->add_setting( 'font-font_family', array(
            'default' => themeMods::getDefault('font-font_family'),
            'sanitize_callback' => ns('themeCustomizer_requireFallbackFont')
        ));
            $wpc->add_control( 'font-font_family', array(
                'type' => 'text',
                'section' => 'cmls-content-font',
                'label' => 'Base Font Family',
                'description' => 'CSS font-family property for the base theme font, for example: arial, sans-serif.<br><br><strong>Be sure to include a generic fallback!</strong><br>See <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/font-family" target="_blank" rel="noopener">MDN: font-family</a> for more information.'
            ));

        $wpc->add_setting( 'font-webfont_url', array(
            'default' => themeMods::getDefault('font-webfont_url'),
            'sanitize_callback' => 'esc_url_raw'
        ));
            $wpc->add_control( 'font-webfont_url', array(
                'type' => 'url',
                'section' => 'cmls-content-font',
                'label' => 'Base Webfont URL',
                'description' => 'If you wish to use a web font, enter the full URL as given by the provider. It\'s a good idea to always use HTTPS!'
            ));
        $wpc->add_setting( 'font-header_family', array(
            'default' => themeMods::getDefault('font-header_family'),
            'sanitize_callback' => ns('themeCustomizer_requireFallbackFont')
        ));
            $wpc->add_control( 'font-header_family', array(
                'type' => 'text',
                'section' => 'cmls-content-font',
                'label' => 'Header Font Family',
                'description' => 'Set an alternate font family for H2-6 tags in body content.'
            ));

        $wpc->add_setting( 'font-header_webfont_url', array(
            'default' => themeMods::getDefault('font-header_webfont_url'),
            'sanitize_callback' => 'esc_url_raw'
        ));
            $wpc->add_control( 'font-header_webfont_url', array(
                'type' => 'url',
                'section' => 'cmls-content-font',
                'label' => 'Header Webfont URL',
                'description' => 'See Base Webfont URL for instructions.'
            ));

    $wpc->add_section( 'cmls-content-colors', array(
        'title' => 'Colors',
        'panel' => 'cmls-content',
        'priority' => 31
    ));
        $wpc->add_setting( 'color-content-background', array(
            'default' => themeMods::getDefault('color-content-background'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-content-background',
                    array(
                        'label' => 'Content Area Background',
                        'section' => 'cmls-content-colors',
                        'settings' => 'color-content-background',
                    )
                )
            );
        $wpc->add_setting( 'color-content-foreground', array(
            'default' => themeMods::getDefault('color-content-foreground'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-content-foreground',
                    array(
                        'label' => 'Content Area Text',
                        'section' => 'cmls-content-colors',
                        'settings' => 'color-content-foreground',
                    )
                )
            );
        $wpc->add_setting( 'color-brand', array(
            'default' => themeMods::getDefault('color-brand'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-brand',
                    array(
                        'label' => 'Primary Brand',
                        'section' => 'cmls-content-colors',
                        'settings' => 'color-brand',
                    )
                )
            );
        $wpc->add_setting( 'color-highlight', array(
            'default' => themeMods::getDefault('color-highlight'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-highlight',
                    array(
                        'label' => 'Highlight',
                        'section' => 'cmls-content-colors',
                        'settings' => 'color-highlight',
                    )
                )
            );
        $wpc->add_setting( 'color-accent', array(
            'default' => themeMods::getDefault('color-accent'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-accent',
                    array(
                        'label' => 'Accent',
                        'section' => 'cmls-content-colors',
                        'settings' => 'color-accent',
                    )
                )
            );
}
\add_action('customize_register', ns('themeCustomizerContent'));
