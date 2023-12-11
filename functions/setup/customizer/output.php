<?php
/**
 * Output customizations as CSS variables.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function initCustomFonts() {
	$font_urls = array(
		'font-webfont_url'        => themeMods::get( 'font-webfont_url' ),
		'font-header_webfont_url' => themeMods::get( 'font-header_webfont_url' ),
	);
	$google_url = 'fonts.googleapis.com';
	$has_google = false;

	foreach ( $font_urls as $key => $url ) {
		if ( \mb_strpos( $url, $google_url ) ) {
			$has_google = true;
		}
		if ( \get_option( 'cmls-async_fonts', '1' ) !== '1' ) {
			\wp_enqueue_style(
				'custom-webfont-url-' . $key,
				\esc_url( $url ),
				array(),
				null,
			);
		}
	}

	if ( $has_google ) {
		\add_action( 'wp_head', function () {
			?>
			<link rel="dns-prefetch" href="//fonts.googleapis.com">
			<link rel="dns-prefetch" href="//fonts.gstatic.com">
			<link rel="preconnect" href="//fonts.googleapis.com">
			<link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
			<?php
		}, 1 );
	}
}
\add_action( 'init', ns( 'initCustomFonts' ) );

if ( \get_option( 'cmls-async_fonts', '1' ) === '1' ) {
	function enqueueCustomFonts() {
		$font_urls = array(
			'font-webfont_url'        => themeMods::get( 'font-webfont_url' ),
			'font-header_webfont_url' => themeMods::get( 'font-header_webfont_url' ),
		);

		foreach ( $font_urls as $key => $url ) {
			\wp_enqueue_style(
				'custom-webfont-url-' . $key,
				\esc_url( $url ),
				array(),
				null,
			);
		}
	}
	\add_action( 'wp_footer', ns( 'enqueueCustomFonts' ) );
	\add_action( 'admin_footer', ns( 'enqueueCustomFonts' ) );
}

// Generate customization CSS
function generateCustomCSS() {
	$files  = themeMods::getFiles();
	$colors = themeMods::getColors();
	$fonts  = array(
		'font-webfont_url'        => themeMods::get( 'font-webfont_url' ),
		'font-font_family'        => themeMods::get( 'font-font_family' ),
		'font-header_webfont_url' => themeMods::get( 'font-header_webfont_url' ),
		'font-header_family'      => themeMods::get( 'font-header_family' ),
	);
	$text = array(
		'text-copyright'                 => themeMods::get( 'text-copyright' ),
		'text-masthead-before_menu'      => themeMods::get( 'text-masthead-before_menu' ),
		'text-masthead-before_menu-link' => themeMods::get( 'text-masthead-before_menu-link' ),
	);
	$settings = themeMods::getSettings();

	// Generate CSS URL vars for files
	foreach ( $files as $key => $val ) {
		$val                     = \addslashes( $val );
		$files[$key]             = "'{$val}'";
		$files[$key . '-cssurl'] = "url('{$val}')";
	}

	// Sanitize text
	\array_walk_recursive( $text, function ( &$item, $key ) {
		$item = "'" . \addslashes( $item ) . "'";
	} );

	// Sanitize colors
	$colors = \preg_replace( '/[^\'",\.\(\)#0-9a-z]/', '', $colors );

	$vars = \array_merge(
		$files,
		$colors,
		$fonts,
		$text,
		$settings
	);

	$css = ":root,::after,::before {\n";

	foreach ( $vars as $key => $val ) {
		$val = \wp_strip_all_tags( $val );
		$val = \str_replace( ';', '\3A', $val );

		if ( ! empty( $val ) ) {
			$css .= '--' . PREFIX . '-' . $key . ':' . $val . ';' . "\n";
		}
	}
	$css .= '}';

	return $css;
}

/**
 * Inject customizer var styles into editor.
 * We're using a trick here because add_editor_style does not yet support
 * inline stylesheets. The request for the remove file will get intercepted
 * in overrideInternalStyleRequest() and overrideExternalStyleRequest().
 */
function enqueueOutputCustomCSS() {
	\add_editor_style( theme_url() . '/cmls-block-editor-customizer-styles' );
}
\add_action( 'after_setup_theme', ns( 'enqueueOutputCustomCSS' ), 12 );

// Override request to inject customizer vars
function overrideInternalStyleRequest( $response, $parsed_args, $url ) {
	if ( \mb_strstr( $url, '/cmls-block-editor-customizer-styles' ) ) {
		if ( \class_exists( '\WpOrg\Requests\Response\Headers' ) ) {
			$headers = new \WpOrg\Requests\Response\Headers();
		} else {
			$headers = new \Requests_Utility_CaseInsensitiveDictionary();
		}
		$response = array(
			'body'     => generateCustomCSS(),
			'headers'  => $headers,
			'response' => array(
				'code'    => 200,
				'message' => 'OK',
			),
			'cookies'  => array(),
			'filename' => null,
		);
	}

	return $response;
}
\add_filter( 'pre_http_request', ns( 'overrideInternalStyleRequest' ), 10, 3 );
function overrideExternalStyleRequest() {
	if ( \mb_strstr( $_SERVER['REQUEST_URI'], '/cmls-block-editor-customizer-styles' ) ) {
		echo generateCustomCSS();

		exit();
	}
}
\add_filter( 'parse_request', ns( 'overrideExternalStyleRequest' ), 10, 1 );

// Output customizations as CSS vars
function directOutputCustomCSS() {
	\wp_register_style( PREFIX . '-customizer_results', '', array( PREFIX . '_customizer_vars' ), false, 'screen' );
	\wp_enqueue_style( PREFIX . '-customizer_results', '', array( PREFIX . '_customizer_vars' ) );
	\wp_add_inline_style(
		PREFIX . '-customizer_results',
		generateCustomCSS()
	);
}
\add_action( 'init', ns( 'directOutputCustomCSS' ), 100 );

// Register customizations as editor options
function registerCustomEditorColors() {
	$customizer_colors = getCustomizerColors();
	\add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => 'Brand',
			'slug'  => 'brand',
			'color' => \esc_html( themeMods::get( 'color-brand' ) ),
		),
		array(
			'name'  => 'Highlight',
			'slug'  => 'highlight',
			'color' => \esc_html( themeMods::get( 'color-highlight' ) ),
		),
		array(
			'name'  => 'Accent',
			'slug'  => 'accent',
			'color' => \esc_html( themeMods::get( 'color-accent' ) ),
		),
		array(
			'name'  => 'White',
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => 'Light Grey',
			'slug'  => 'lightgrey',
			'color' => '#d6d6d6',
		),
		array(
			'name'  => 'Grey',
			'slug'  => 'grey',
			'color' => '#888888',
		),
		array(
			'name'  => 'Dark Grey',
			'slug'  => 'darkgrey',
			'color' => '#333333',
		),
		array(
			'name'  => 'Black',
			'slug'  => 'black',
			'color' => '#000000',
		),
	) );
}
\add_action( 'after_setup_theme', ns( 'registerCustomEditorColors' ) );
