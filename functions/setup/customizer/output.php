<?php
/**
 * Output customizations as CSS variables
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Generate customization CSS
function generateCustomCSS() {
	$files  = themeMods::getFiles();
	$colors = themeMods::getColors();
	$fonts  = [
		'font-webfont_url'        => themeMods::get( 'font-webfont_url' ),
		'font-font_family'        => themeMods::get( 'font-font_family' ),
		'font-header_webfont_url' => themeMods::get( 'font-header_webfont_url' ),
		'font-header_family'      => themeMods::get( 'font-header_family' ),
	];
	$text = [
		'text-copyright'                 => themeMods::get( 'text-copyright' ),
		'text-masthead-before_menu'      => themeMods::get( 'text-masthead-before_menu' ),
		'text-masthead-before_menu-link' => themeMods::get( 'text-masthead-before_menu-link' ),
	];
	$settings = themeMods::getSettings();

	// Generate CSS URL vars for files
	foreach ( $files as $key => $val ) {
		$val                     = \addslashes( $val );
		$files[$key]             = "'${val}'";
		$files[$key . '-cssurl'] = "url('${val}')";
	}

	// Sanitize text
	\array_walk_recursive( $text, function ( &$item, $key ) {
		$item = "'" . \addslashes( $item ) . "'";
	} );

	// Sanitize colors
	$colors = \preg_replace( '/[^\'",\.\(\)#0-9a-z]/', '', $colors );

	// Enqueue fonts
	foreach ( $fonts as $key => $val ) {
		if ( \mb_stripos( $key, '_url' ) !== false && ! empty( $val ) ) {
			enqueueCustomFontURL( $val, $key );
		}
	}

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
 * in overrideInternalStyleRequest() and overrideExternalStyleRequest()
 **/
function enqueueOutputCustomCSS() {
	\add_editor_style( theme_url() . '/cmls-block-editor-customizer-styles' );
}
\add_action( 'after_setup_theme', ns( 'enqueueOutputCustomCSS' ), 12 );

// Override request to inject customizer vars
function overrideInternalStyleRequest( $response, $parsed_args, $url ) {
	if ( \mb_strstr( $url, '/cmls-block-editor-customizer-styles' ) ) {
		$response = [
			'body'     => generateCustomCSS(),
			'headers'  => new \Requests_Utility_CaseInsensitiveDictionary(),
			'response' => [
				'code'    => 200,
				'message' => 'OK',
			],
			'cookies'  => [],
			'filename' => null,
		];
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
	?>
	<!-- CUSTOMIZER VARS -->
	<style id="cmls_base_customizer_vars-css">
		<?php echo generateCustomCSS(); ?>
	</style>
	<!-- END CUSTOMIZER VARS -->
	<?php
}
\add_action( 'wp_head', ns( 'directOutputCustomCSS' ), 100 );

/*
function addGoogleFontPreconnect() {
	$googlefont_url = 'fonts.googleapis.com';
	$webfont_url = themeMods::get( 'font-webfont_url' );
	$headerfont_url = themeMods::get( 'font-header_webfont_url' );
	if (
		substr_count($webfont_url, $googlefont_url) ||
		substr_count($headerfont_url, $googlefont_url)
	) {
		?>
			<link rel="dns-prefetch" href="//fonts.googleapis.com">
			<link rel="dns-prefeetch" href="//fonts.gstatic.com">
			<link rel="preconnect" href="//fonts.googleapis.com">
			<link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
		<?
	}
}
\add_action('wp_head', ns('addGoogleFontPreconnect'), 1);
*/

function enqueueCustomFontURL( $url, $key ) {
	\wp_enqueue_style(
		'custom-webfont-url-' . $key,
		\esc_url( $url ),
		[],
		null
	);
}

// Register customizations as editor options
function registerCustomEditorColors() {
	$customizer_colors = getCustomizerColors();
	\add_theme_support( 'editor-color-palette', [
		[
			'name'  => 'Brand',
			'slug'  => 'brand',
			'color' => \esc_html( themeMods::get( 'color-brand' ) ),
		],
		[
			'name'  => 'Highlight',
			'slug'  => 'highlight',
			'color' => \esc_html( themeMods::get( 'color-highlight' ) ),
		],
		[
			'name'  => 'Accent',
			'slug'  => 'accent',
			'color' => \esc_html( themeMods::get( 'color-accent' ) ),
		],
		[
			'name'  => 'White',
			'slug'  => 'white',
			'color' => '#ffffff',
		],
		[
			'name'  => 'Light Grey',
			'slug'  => 'lightgrey',
			'color' => '#d6d6d6',
		],
		[
			'name'  => 'Grey',
			'slug'  => 'grey',
			'color' => '#888888',
		],
		[
			'name'  => 'Dark Grey',
			'slug'  => 'darkgrey',
			'color' => '#333333',
		],
		[
			'name'  => 'Black',
			'slug'  => 'black',
			'color' => '#000000',
		],
	] );
}
\add_action( 'after_setup_theme', ns( 'registerCustomEditorColors' ) );
