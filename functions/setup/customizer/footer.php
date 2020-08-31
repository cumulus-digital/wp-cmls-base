<?php
/**
 * Customizer section FOOTER
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

use \WPTRT\Customize\Control\ColorAlpha;

// Register customizable colors
function themeCustomizerFooter($wpc) {
	$wpc->add_panel( 'cmls-footer', array(
		'title' => 'Footer',
		'priority' => 103
    ));
    
    $wpc->add_section( 'cmls-footer-colors', array(
        'title' => 'Colors',
        'panel' => 'cmls-footer',
        'priority' => 30
    ));
        $wpc->add_setting('color-footer-background', array(
            'default' => themeMods::getDefault('color-footer-background'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-footer-background',
                    array(
                        'label' => 'Footer Background',
                        'section' => 'cmls-footer-colors',
                        'settings' => 'color-footer-background',
                    )
                )
            );
        $wpc->add_setting('color-footer-foreground', array(
            'default' => themeMods::getDefault('color-footer-foreground'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-footer-foreground',
                    array(
                        'label' => 'Footer Text',
                        'section' => 'cmls-footer-colors',
                        'settings' => 'color-footer-foreground',
                    )
                )
            );
        
    $wpc->add_section( 'cmls-footer-images', array(
        'title' => 'Images',
        'panel' => 'cmls-footer',
        'priority' => 31
    ));            
        $wpc->add_setting( 'file-footer-logo', array(
            'default' => themeMods::getDefault('file-footer-logo'),
            'sanitize_callback' => ns('themeCustomizer_requireImage'),
            'sanitize_js_callback' => ns('themeCustomizer_requireImage')
        ));
            $wpc->add_control(
                new \WP_Customize_Media_Control(
                    $wpc,
                    'file-footer-logo',
                    array(
                        'label' => 'Footer logo',
                        'description' => 'Defaults to Masthead Logo.',
                        'section' => 'cmls-footer-images',
                        'mime_type' => 'image',
                    )
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
\add_action('customize_register', ns('themeCustomizerFooter'));
