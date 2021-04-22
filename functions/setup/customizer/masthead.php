<?php
/**
 * Customizer section MASTHEAD
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

use \WPTRT\Customize\Control\ColorAlpha;

// Register customizable colors
function themeCustomizerMasthead($wpc) {
	$wpc->add_panel( 'cmls-masthead', array(
		'title' => 'Masthead',
		'priority' => 100
	));

    $wpc->add_section( 'cmls-masthead-colors', array(
        'title' => 'Colors',
        'panel' => 'cmls-masthead',
        'priority' => 30
    ));
        $wpc->add_setting('color-masthead-background', array(
            'default' => themeMods::getDefault('color-masthead-background'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-masthead-background',
                    array(
                        'label' => 'Masthead Background',
                        'description' => 'Background of the masthead when the page is scrolled to the top.',
                        'section' => 'cmls-masthead-colors',
                        'settings' => 'color-masthead-background',
                    )
                )
            );
        $wpc->add_setting('color-masthead-foreground', array(
            'default' => themeMods::getDefault('color-masthead-foreground'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-masthead-foreground',
                    array(
                        'label' => 'Masthead Foreground',
                        'description' => 'Color of text and menu icon in the masthead.',
                        'section' => 'cmls-masthead-colors',
                        'settings' => 'color-masthead-foreground',
                    )
                )
            );
        $wpc->add_setting('color-masthead-background-overlay', array(
            'default' => themeMods::getDefault('color-masthead-background-overlay'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-masthead-background-overlay',
                    array(
                        'label' => 'Masthead Background (Scrolled)',
                        'description' => 'Background of the masthead when content is scrolled under the masthead.',
                        'section' => 'cmls-masthead-colors',
                        'settings' => 'color-masthead-background-overlay',
                    )
                )
            );
        $wpc->add_setting('color-masthead-foreground-overlay', array(
            'default' => themeMods::getDefault('color-masthead-foreground-overlay'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-masthead-foreground-overlay',
                    array(
                        'label' => 'Masthead Foreground (Scrolled)',
                        'description' => 'Color of text and menu icon in the masthead when content is scrolled under the masthead.',
                        'section' => 'cmls-masthead-colors',
                        'settings' => 'color-masthead-foreground-overlay',
                    )
                )
            );

    $wpc->add_section( 'cmls-masthead-background', array(
        'title' => 'Background Image',
        'description' => 
            'Optionally use an image for the masthead background. Note: The masthead background color
             WILL be visible behind a transparent background image. Background position begins at the
             top left and is sized to cover.',
        'panel' => 'cmls-masthead',
        'priority' => 31
    ));
        $wpc->add_setting( 'file-masthead-background', array(
            'default' => themeMods::getDefault('file-masthead-background'),
            'sanitize_callback' => ns('themeCustomizer_requireImage'),
            'sanitize_js_callback' => ns('themeCustomizer_requireImage')
        ));
            $wpc->add_control(
                new \WP_Customize_Media_Control(
                    $wpc,
                    'file-masthead-background',
                    array(
                        'label' => 'Masthead Background',
                        'section' => 'cmls-masthead-background',
                        'mime_type' => 'image',
                    )
                )
            );
        $wpc->add_setting( 'file-masthead-background-overlay', array(
            'default' => themeMods::getDefault('file-masthead-background-overlay'),
            'sanitize_callback' => ns('themeCustomizer_requireImage'),
            'sanitize_js_callback' => ns('themeCustomizer_requireImage')
        ));
            $wpc->add_control(
                new \WP_Customize_Media_Control(
                    $wpc,
                    'file-masthead-background-overlay',
                    array(
                        'label' => 'Masthead Background (Scrolled)',
                        'section' => 'cmls-masthead-background',
                        'mime_type' => 'image',
                        'description' => 'Optionally display a different background when the content is scrolled under the masthead. Defaults to Masthead Background.',
                    )
                )
            );
        
    $wpc->add_section( 'cmls-masthead-logo', array(
        'title' => 'Logo',
        'panel' => 'cmls-masthead',
        'priority' => 32
    ));
        $wpc->add_setting( 'file-masthead-logo', array(
				'default' => themeMods::getDefault('file-masthead-logo'),
				'sanitize_callback' => ns('themeCustomizer_requireImage'),
				'sanitize_js_callback' => ns('themeCustomizer_requireImage')
			));
				$wpc->add_control(
					new \WP_Customize_Media_Control(
						$wpc,
						'file-masthead-logo',
						array(
							'label' => 'Main masthead logo',
							'section' => 'cmls-masthead-logo',
							'mime_type' => 'image',
						)
					)
				);
        $wpc->add_setting( 'file-masthead-logo-overlay', array(
            'default' => themeMods::getDefault('file-masthead-logo-overlay'),
            'sanitize_callback' => ns('themeCustomizer_requireImage'),
            'sanitize_js_callback' => ns('themeCustomizer_requireImage')
        ));
            $wpc->add_control(
                new \WP_Customize_Media_Control(
                    $wpc,
                    'file-masthead-logo-overlay',
                    array(
                        'label' => 'Masthead Logo (Scrolled)',
                        'description' => 'Optionally display a different logo when the content is scrolled under the masthead. Defaults to Masthead Logo.',
                        'section' => 'cmls-masthead-logo',
                        'mime_type' => 'image',
                    )
                )
            );
        $wpc->add_setting( 'file-masthead-logo-inside', array(
            'default' => themeMods::getDefault('file-masthead-logo-inside'),
            'sanitize_callback' => ns('themeCustomizer_requireImage'),
            'sanitize_js_callback' => ns('themeCustomizer_requireImage')
        ));
            $wpc->add_control(
                new \WP_Customize_Media_Control(
                    $wpc,
                    'file-masthead-logo-inside',
                    array(
                        'label' => 'Masthead logo on inside pages',
                        'description' => 'Optionally display a different logo on inside pages. Defaults to Masthead Logo.',
                        'section' => 'cmls-masthead-logo',
                        'mime_type' => 'image',
                    )
                )
            );
        $wpc->add_setting( 'file-masthead-logo-inside-overlay', array(
            'default' => themeMods::getDefault('file-masthead-logo-inside-overlay'),
            'sanitize_callback' => ns('themeCustomizer_requireImage'),
            'sanitize_js_callback' => ns('themeCustomizer_requireImage')
        ));
            $wpc->add_control(
                new \WP_Customize_Media_Control(
                    $wpc,
                    'file-masthead-logo-inside-overlay',
                    array(
                        'label' => 'Masthead logo on inside pages (Scrolled)',
                        'description' => 'Optionally display a different logo on inside pages when the content is scrolled under the masthead. Defaults to Masthead Logo (Scrolled).',
                        'section' => 'cmls-masthead-logo',
                        'mime_type' => 'image',
                    )
                )
            );

    $wpc->add_section( 'cmls-masthead-text_before_menu', array(
        'title' => 'Hamburger Label',
        'description' => 
            'Optionally add a text label or link next to the "hamburger" menu expander.',
        'panel' => 'cmls-masthead',
        'priority' => 32
    ));
        $wpc->add_setting('text-masthead-before_menu', array(
            'default' => themeMods::getDefault('text-masthead-before_menu'),
            'sanitize_callback' => 'sanitize_text_field',
            'sanitize_js_callback' => 'sanitize_text_field'
        ));
            $wpc->add_control( 'text-masthead-before_menu', array(
                'type' => 'text',
                'section' => 'cmls-masthead-text_before_menu',
                'label' => 'Label Text',
                'description' => 'No automatic transformation is done to this text, so if you want it to be uppercase, enter it as uppercase.'
            ));
        $wpc->add_setting( 'text-masthead-before_menu-link', array(
            'default' => themeMods::getDefault('text-masthead-before_menu-link'),
            'sanitize_callback' => 'esc_url_raw'
        ));
            $wpc->add_control( 'text-masthead-before_menu-link', array(
                'type' => 'url',
                'section' => 'cmls-masthead-text_before_menu',
                'label' => 'Link URL',
                'description' => 'Optionally link the Hamburger Label.'
            ));
        $wpc->add_setting( 'text-masthead-before_menu-link_newtab', array(
            'default' => themeMods::getDefault('text-masthead-before_menu-link_newtab'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeCheckbox'),
            'sanitize_js_callback' => ns('themeCustomizer_sanitizeCheckbox')
        ));
            $wpc->add_control( 'text-masthead-before_menu-link_newtab', array(
                'type' => 'checkbox',
                'section' => 'cmls-masthead-text_before_menu',
                'label' => 'Open link in a new window/tab.'
            ));
        $wpc->add_setting( 'text-masthead-before_menu-link_rel', array(
            'default' => themeMods::getDefault('text-masthead-before_menu-link_rel'),
            'sanitize_callback' => 'sanitize_text_field'
        ));
            $wpc->add_control( 'text-masthead-before_menu-link_rel', array(
                'type' => 'text',
                'section' => 'cmls-masthead-text_before_menu',
                'label' => 'Link Relationship',
                'description' => 'Set the "rel" parameter for the Hamburger Label link. See <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Link_types" target="_blank" rel="noopener">Link Types</a> for details. When linking to another website, you should set this to "<em><strong>external noopener</strong></em>".'
            ));

}
\add_action('customize_register', ns('themeCustomizerMasthead'));
