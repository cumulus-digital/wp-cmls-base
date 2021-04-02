<?php
/**
 * Output customizations as CSS variables
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// Generate customization CSS
function generateCustomCSS() {
	$files = themeMods::getFiles();
	$colors = themeMods::getColors();
	$fonts = array(
		'font-webfont_url' => themeMods::get('font-webfont_url'),
		'font-font_family' => themeMods::get('font-font_family'),
		'font-header_webfont_url' => themeMods::get('font-header_webfont_url'),
		'font-header_family' => themeMods::get('font-header_family')
	);
	$text = array(
		'text-copyright' => themeMods::get('text-copyright'),
		'text-masthead-before_menu' => themeMods::get('text-masthead-before_menu'),
		'text-masthead-before_menu-link' => themeMods::get('text-masthead-before_menu-link')
	);
	$settings = themeMods::getSettings();

	foreach($files as $key=>$val) {
		$files[$key . '-cssurl'] = 'url(' . $val . ')';
	}

	$vars = array_merge(
		$files,
		$colors,
		$fonts,
		$text,
		$settings
	);

	$css = '';

	// Enqueue fonts
	foreach ($fonts as $key => $val) {
		if (stripos($key, '_url') !== false && ! empty($val)) {
			enqueueCustomFontURL($val, $key);
		}
	}

	$css .= ":root {\n";
	foreach($vars as $key=>$val) {
		$val = \wp_strip_all_tags($val);
		$val = str_replace(';', '\3A', $val);
		if ( ! empty($val)) {
			$css .= '--' . PREFIX . '-' . $key . ':' . $val . ';' . "\n";
		}
	}
	$css .= '}';
	
	return $css;
}

function enqueueOutputCustomCSS() {
	\wp_add_inline_style(PREFIX . '_customizer_vars', generateCustomCSS());
}
\add_action('enqueue_block_editor_assets', ns('enqueueOutputCustomCSS'));

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
\add_action('wp_head', ns('directOutputCustomCSS'), 100);

function enqueueCustomFontURL($url, $key) {
	\wp_enqueue_style(
		'custom-webfont-url-' . $key,
		\esc_url($url),
		array(),
		null
	);
}

// Register customizations as editor options
function registerCustomEditorColors() {
	$customizer_colors = getCustomizerColors();
	\add_theme_support( 'editor-color-palette', array(
		array(
			'name' => 'Brand',
			'slug' => 'brand',
			'color' => \esc_html(themeMods::get('color-brand'))
		),
		array(
			'name' => 'Highlight',
			'slug' => 'highlight',
			'color' => \esc_html(themeMods::get('color-highlight'))
		),
		array(
			'name' => 'Accent',
			'slug' => 'accent',
			'color' => \esc_html(themeMods::get('color-accent'))
		),
		array (
			'name' => 'Black',
			'slug' => 'black',
			'color' => '#000'
		),
		array (
			'name' => 'Dark Grey',
			'slug' => 'darkgrey',
			'color' => '#333'
		),
		array (
			'name' => 'Grey',
			'slug' => 'grey',
			'color' => '#888'
		),
		array (
			'name' => 'Light Grey',
			'slug' => 'lightgrey',
			'color' => '#d6d6d6'
		),
		array (
			'name' => 'White',
			'slug' => 'white',
			'color' => '#fff'
		),
	));
}
\add_action('after_setup_theme', ns('registerCustomEditorColors'));