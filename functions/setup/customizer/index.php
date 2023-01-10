<?php
/**
 * Customizer setup
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Register alpha control
if ( \is_admin() ) {
	\add_action( 'wp_default_scripts', ns( 'wp_default_custom_scripts' ) );
	function wp_default_custom_scripts( $scripts ) {
		//$scripts->add( 'wp-color-picker', "/wp-admin/js/color-picker$suffix.js", array( 'iris' ), false, 1 );
		\did_action( 'init' ) && $scripts->localize(
			'wp-color-picker',
			'wpColorPickerL10n',
			[
				'clear'            => \__( 'Clear' ),
				'clearAriaLabel'   => \__( 'Clear color' ),
				'defaultString'    => \__( 'Default' ),
				'defaultAriaLabel' => \__( 'Select default color' ),
				'pick'             => \__( 'Select Color' ),
				'defaultLabel'     => \__( 'Color value' ),
			]
		);
	}
}
\add_action( 'customize_register', function ( $wpc ) {
	/*
	if ( ! \class_exists( '\CMLS_Base\Vendors\WPTRT\Customize\Control\ColorAlpha' ) ) {
		require theme_path() . '/build/composer/vendor/wptrt/control-color-alpha/src/ColorAlpha.php';
	}
	*/
	$wpc->register_control_type( '\CMLS_Base\Vendors\WPTRT\Customize\Control\ColorAlpha' );
} );

class themeMods {

	private static $cache = [];

	/**
	 * Define available theme mod variables and their default values. Default values
	 * may reference another theme mod variable by using "selfref:key_name"
	 *
	 * @var array
	 */
	private static $vars = [
		'text-copyright'                              => 'Copyright $year',
		'text-masthead-before_menu'                   => 'EXPLORE',
		'text-masthead-before_menu-enabled'           => true,
		'text-masthead-before_menu-link'              => null,
		'text-masthead-before_menu-link_newtab'       => false,
		'text-masthead-before_menu-link_rel'          => null,
		'color-site-background'                       => null,

		'color-masthead-background'                   => '#00598e',
		'color-masthead-background-overlay'           => 'rgba(255, 255, 255, 1)',
		'color-masthead-foreground'                   => 'rgba(255, 255, 255, 1)',
		'color-masthead-foreground-overlay'           => 'rgba(0, 0, 0, 0.95)',
		'file-masthead-background'                    => null,
		'file-masthead-background-overlay'            => null,
		'file-masthead-logo'                          => null,
		'file-masthead-logo-overlay'                  => 'ref:file-masthead-logo',
		'file-masthead-logo-inside'                   => 'ref:file-masthead-logo',
		'file-masthead-logo-inside-overlay'           => 'ref:file-masthead-logo-overlay',
		'setting-masthead-transparent_on_homepage'    => false,

		'color-main_menu-background'                  => '#000000',
		'color-main_menu-foreground'                  => '#ffffff',
		'color-main_menu-foreground-hover_foreground' => '#ffffff',
		'color-main_menu-foreground-hover_background' => '#00598e',
		'file-main_menu-background'                   => null,
		'setting-main_menu-background-attachment'     => 'fixed',
		'setting-main_menu-background-position'       => 'top left',
		'setting-main_menu-background-size'           => 'cover',
		'setting-main_menu-background-repeat'         => 'no-repeat',
		'setting-main_menu-include_search'            => false,

		'color-content-background'                    => '#ffffff',
		'color-content-foreground'                    => '#000000',

		'color-footer-background'                     => '#000000',
		'color-footer-foreground'                     => '#ffffff',
		'file-footer-logo'                            => 'ref:file-masthead-logo',

		'color-site_background'                       => '#ffffff',
		'color-brand'                                 => '#00598e',
		'color-highlight'                             => '#3399cc',
		'color-accent'                                => '#a33cb3',
		'color-favicon-mstile'                        => '#00598e',
		'color-favicon-chrome'                        => '#00598e',

		'font-webfont_url'                            => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,300;1,500;1,600;1,700;1,800;1,900&display=swap',
		'font-font_family'                            => "'Montserrat', Helvetica, Arial, sans-serif",
		'font-header_webfont_url'                     => null,
		'font-header_family'                          => 'inherit',
	];

	// Do not allow access to an undefined theme mod
	private static function check( $key ) {
		if ( ! \array_key_exists( $key, self::$vars ) ) {
			echo '<pre>';
			\debug_print_backtrace();
			exit( 'Attempted to access an undefined theme mod variable: ' . \wp_strip_all_tags( $key ) );
		}
	}

	/**
	 * Retrieve a defined theme mod var, optionally override predefined default. Strips all tags.
	 *
	 * @param string $key
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	public static function get( $key, $default = 893759834267529 ) {
		return \wp_strip_all_tags( self::getRaw( $key, $default ) );
	}

	/**
	 * Retrieve a theme mod var without stripping tags
	 *
	 * @param string $key
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	public static function getRaw( $key, $default = 893759834267529 ) {
		self::check( $key );

		// If a default is not overridden, use our predefined default
		if ( $default == 893759834267529 ) {
			$default = self::getDefault( $key );
		}

		$mod = self::selfRef( \get_theme_mod( $key, $default ) );

		// If a theme mod is not set, set the predefined default.
		if ( ! $mod && $mod !== $default && ! \mb_strpos( $default, 'ref:' ) ) {
			\set_theme_mod( $key, $default );
		}

		return $mod;
	}

	public static function getColors() {
		$keys   = self::getFilteredKeys( 'color' );
		$colors = [];

		foreach ( $keys as $key ) {
			$color = self::get( $key );

			if ( $color !== null ) {
				$colors[$key] = $color;
			}
		}

		return $colors;
	}

	/**
	 * Retrieve the predefined default for a given defined theme mod var
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public static function getDefault( $key ) {
		self::check( $key );
		$default = self::selfRef( self::$vars[$key] );

		return $default;
	}

	public static function getFiles() {
		$cache_key   = 'getFiles';
		$cache_group = 'CMLS_Base::themeMods';

		$cache = CMLS_Cache::get( $cache_key, $cache_group );

		if ( $cache !== false ) {
			return $cache;
		}

		$keys     = self::getFilteredKeys( 'file' );
		$files    = [];
		$post_ids = [];

		foreach ( $keys as $key ) {
			$file_post_id = self::get( $key );

			if ( $file_post_id ) {
				$post_ids[$key] = [
					'key' => $key,
					'id'  => $file_post_id,
				];
			}
		}

		if ( \count( $post_ids ) ) {
			$posts = \get_posts( [
				'post_type' => 'attachment',
				'post__in'  => \array_column( $post_ids, 'id' ),
			] );
			$posts_by_id = [];

			foreach ( $posts as $p ) {
				$posts_by_id[$p->ID] = $p;
			}

			foreach ( $post_ids as $pId ) {
				$files[$pId['key']] = \wp_make_link_relative(
					$posts_by_id[$pId['id']]->guid
				);
			}
		}

		if ( \count( $files ) ) {
			CMLS_Cache::set( $cache_key, $files, $cache_group );

			return $files;
		}

		return [];
	}

	public static function getFilteredKeys( $filter ) {
		$keys = \array_filter( \array_keys( self::$vars ), function ( $key ) use ( $filter ) {
			if ( \mb_strpos( $key, $filter . '-' ) === 0 ) {
				return $key;
			}
		} );

		return $keys;
	}

	public static function getSettings() {
		$keys     = self::getFilteredKeys( 'setting' );
		$settings = [];

		foreach ( $keys as $key ) {
			$settings[$key] = self::get( $key );
		}

		return $settings;
	}

	public static function getStripped( $key, $default = 893759834267529 ) {
		return \wp_strip_all_tags( self::get( $key, $default ) );
	}

	private static function selfRef( $val ) {
		if ( \mb_strpos( $val, 'ref:' ) !== false ) {
			$val = \str_replace( 'ref:', '', $val );
			$val = self::get( $val );
		}

		return $val;
	}
}

function getCustomizerFiles() {
	return themeMods::getFiles();
}

function getCustomizerColors() {
	return themeMods::getColors();
}

/*
NOTE: UNUSED FOR NOW
function themeCustomizerScripts() {
	$assets = include(
		theme_path() . '/build/customizer.asset.php'
	);

	\wp_enqueue_script(
		PREFIX . '_customizer',
		theme_url() . '/build/customizer.js',
		$assets['dependencies'],
		$assets['version'],
		true
	);
}
\add_action('customize_controls_enqueue_scripts', ns('themeCustomizerScripts'));
*/

/*
 * Flush the themeMods cache when customizer is saved
 */
\add_action( 'customize_save_after', function () {
	CMLS_Cache::flushGroup( 'CMLS_Base::themeMods' );
} );

require __DIR__ . '/sanitizers.php';
require __DIR__ . '/identity.php';
require __DIR__ . '/menu.php';
require __DIR__ . '/masthead.php';
require __DIR__ . '/content.php';
require __DIR__ . '/footer.php';
require __DIR__ . '/output.php';
