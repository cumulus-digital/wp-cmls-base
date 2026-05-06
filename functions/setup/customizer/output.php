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
			if ( ! $url ) {
				continue;
			}

			$newUrl = $url . ( \parse_url( $url, \PHP_URL_QUERY ) ? '&' : '?' ) . 'cmpreload';

			\wp_enqueue_style(
				'custom-webfont-url-' . $key,
				\esc_url( $newUrl ),
				array(),
				null,
			);
		}
	}
	\add_action( 'init', ns( 'enqueueCustomFonts' ) );
	\add_action( 'admin_init', ns( 'enqueueCustomFonts' ) );
}

// Generate customization CSS
function generateCustomCSS() {
	$files = themeMods::getFiles();

	// Validate file URLs and set CSS URLs
	foreach ( $files as $key => $val ) {
		$files[$key]             = "'" . \esc_url_raw( $val ) . "'";
		$files[$key . '-cssurl'] = "url('" . \esc_url_raw( $val ) . "')";
		if ( ! CSSValidator::validateImage( $files[$key . '-cssurl'] ) ) {
			unset( $files[$key . '-cssurl'] );
		}
	}

	$colors = themeMods::getColors();

	// Validate colors
	foreach ( $colors as $key => $val ) {
		if ( ! CSSValidator::validateColor( $val ) ) {
			unset( $colors[$key] );
		}
	}

	$fonts = array(
		'font-webfont_url'        => \filter_var( themeMods::get( 'font-webfont_url' ), \FILTER_VALIDATE_URL ) ? themeMods::get( 'font-webfont_url' ) : null,
		'font-font_family'        => themeMods::get( 'font-font_family' ),
		'font-header_webfont_url' => \filter_var( themeMods::get( 'font-header_webfont_url' ), \FILTER_VALIDATE_URL ) ? themeMods::get( 'font-header_webfont_url' ) : null,
		'font-header_family'      => themeMods::get( 'font-header_family' ),
	);
	$fonts = \array_filter( $fonts );

	$text = array(
		'text-copyright'                 => getCopyright(),
		'text-masthead-before_menu'      => themeMods::get( 'text-masthead-before_menu' ),
		'text-masthead-before_menu-link' => themeMods::get( 'text-masthead-before_menu-link' ),
	);

	// Sanitize text
	\array_walk_recursive( $text, function ( &$item, $key ) {
		$item = "'" . \addslashes( $item ) . "'";
	} );

	$settings = themeMods::getSettings();

	$vars = \array_merge(
		$files,
		$colors,
		$fonts,
		$text,
		$settings,
	);

	\array_walk_recursive( $vars, function ( &$item, $key ) {
		$item = \wp_strip_all_tags( $item );
		$item = \str_replace( ';', '\3A', $item );
	} );

	$css = ":root,::after,::before {\n";

	foreach ( $vars as $key => $val ) {
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
function enqueueOutputCustomCSSForEditor() {
	\add_editor_style( theme_url() . '/cmls-block-editor-customizer-styles' );
}
\add_action( 'after_setup_theme', ns( 'enqueueOutputCustomCSSForEditor' ), 12 );

// Override request to inject customizer vars
function overrideInternalStyleRequest( $response, $parsed_args, $url ) {
	if ( \mb_strstr( $url, '/cmls-block-editor-customizer-styles' ) && \is_user_logged_in() ) {
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
	if ( \mb_strstr( $_SERVER['REQUEST_URI'], '/cmls-block-editor-customizer-styles' ) && \is_user_logged_in() ) {
		echo generateCustomCSS();

		exit();
	}
}
\add_filter( 'parse_request', ns( 'overrideExternalStyleRequest' ), 10, 1 );

// Output customizations as CSS vars
function directOutputCustomCSS() {
	$cache_key = PREFIX . '-customizer_results';
	$css       = \get_transient( $cache_key );

	if ( $css === false ) {
		$css = generateCustomCSS();
		\set_transient( $cache_key, $css, HOUR_IN_SECONDS );
	}

	\wp_register_style( PREFIX . '-customizer_results', '', array( PREFIX . '_customizer_vars' ), false, 'screen' );
	\wp_enqueue_style( PREFIX . '-customizer_results', '', array( PREFIX . '_customizer_vars' ) );
	\wp_add_inline_style( PREFIX . '-customizer_results', $css );
}
\add_action( 'init', ns( 'directOutputCustomCSS' ), 100 );

// Clear transient when customizer is saved
function clearCustomCSSCache() {
	\delete_transient( PREFIX . '-customizer_results' );
}
\add_action( 'customize_save_after', ns( 'clearCustomCSSCache' ) );

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
