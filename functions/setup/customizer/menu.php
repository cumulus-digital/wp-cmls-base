<?php
/**
 * Customizer section NAV LABEL
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

use \WPTRT\Customize\Control\ColorAlpha;

function themeCustomizerNav($wpc) {

    $wpc->add_section( 'cmls-main_menu-style', array(
        'title' => 'Header Menu Styles',
        'panel' => 'nav_menus',
        'priority' => 30
    ));
        $wpc->add_setting('color-main_menu-background', array(
            'default' => themeMods::getDefault('color-main_menu-background'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-main_menu-background',
                    array(
                        'label' => 'Background Color',
                        'section' => 'cmls-main_menu-style',
                        'settings' => 'color-main_menu-background',
                    )
                )
            );
        $wpc->add_setting('color-main_menu-foreground', array(
            'default' => themeMods::getDefault('color-main_menu-foreground'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-main_menu-foreground',
                    array(
                        'label' => 'Text Color',
                        'section' => 'cmls-main_menu-style',
                        'settings' => 'color-main_menu-foreground',
                    )
                )
            );
        $wpc->add_setting('color-main_menu-foreground-hover_foreground', array(
            'default' => themeMods::getDefault('color-main_menu-foreground-hover_foreground'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-main_menu-foreground-hover_foreground',
                    array(
                        'label' => 'Item Hover Text Color',
                        'section' => 'cmls-main_menu-style',
                        'settings' => 'color-main_menu-foreground-hover_foreground',
                    )
                )
            );
        $wpc->add_setting('color-main_menu-foreground-hover_background', array(
            'default' => themeMods::getDefault('color-main_menu-foreground-hover_background'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeColorString'),
        ));
            $wpc->add_control(
                new ColorAlpha(
                    $wpc,
                    'color-main_menu-foreground-hover_background',
                    array(
                        'label' => 'Item Hover Background Color',
                        'section' => 'cmls-main_menu-style',
                        'settings' => 'color-main_menu-foreground-hover_background',
                    )
                )
            );

        $wpc->add_setting( 'file-main_menu-background', array(
            'default' => themeMods::getDefault('file-main_menu-background'),
            'sanitize_callback' => ns('themeCustomizer_requireImage'),
            'sanitize_js_callback' => ns('themeCustomizer_requireImage')
        ));
            $wpc->add_control(
                new \WP_Customize_Media_Control(
                    $wpc,
                    'file-main_menu-background',
                    array(
                        'label' => 'Background Image',
                        'section' => 'cmls-main_menu-style',
                        'mime_type' => 'image',
                    )
                )
            );

        $wpc->add_setting( 'setting-main_menu-background-position', array(
            'default' => themeMods::getDefault('setting-main_menu-background-position'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeBackgroundPosition'),
            'sanitize_js_callback' => ns('themeCustomizer_sanitizeBackgroundPosition')
        ));
            $wpc->add_control(
                new \WP_Customize_Control(
                    $wpc,
                    'setting-main_menu-background-position',
                    array(
                        'label' => 'Background Image Position',
                        'section' => 'cmls-main_menu-style',
                        'type' => 'select',
                        'choices' => array(
                            'top left' => 'Top Left',
                            'top center' => 'Top Center',
                            'top right' => 'Top Right',
                            'center left' => 'Center Left',
                            'center center' => 'Center Center',
                            'center right' => 'Center Right',
                            'bottom left' => 'Bottom Left',
                            'bottom center' => 'Bottom Center',
                            'bottom right' => 'Bottom Right',
                        )
                    )
                )
            );

        $wpc->add_setting( 'setting-main_menu-background-size', array(
            'default' => themeMods::getDefault('setting-main_menu-background-size'),
            'sanitize_callback' => ns('themeCustomizer_sanitizeBackgroundSize'),
            'sanitize_js_callback' => ns('themeCustomizer_sanitizeBackgroundSize')
        ));
            $wpc->add_control(
                new \WP_Customize_Control(
                    $wpc,
                    'setting-main_menu-background-size',
                    array(
                        'label' => 'Background Image Size',
                        'section' => 'cmls-main_menu-style',
                        'type' => 'select',
                        'choices' => array(
                            'cover' => 'Cover',
                            'contain' => 'Contain',
                            '100%' => '100%',
                            'auto' => 'None',
                        )
                    )
                )
            );

}
\add_action('customize_register', ns('themeCustomizerNav'));