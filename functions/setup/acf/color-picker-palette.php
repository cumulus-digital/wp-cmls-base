<?php
/**
 * ACF setup continued
 * Give ACF color pickers our customizer palette
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_action( 'admin_enqueue_scripts', function () {
	$colors = themeMods::getColors();

	// Convert theme colors to simple hex values
	$colors = \array_map( function ( $color ) {
		if ( \is_string( $color ) ) {
			// Hex
			if ( \mb_substr( $color, 0, 1 ) === '#' ) {
				return \mb_strtoupper( $color );
			}
			// Rgba
			if ( \mb_substr( $color, 0, 3 ) === 'rgb' ) {
				$rgba  = [];
				$regex = '#\((([^()]+|(?R))*)\)#';

				if ( \preg_match_all( $regex, $color, $matches ) ) {
					$rgba = \explode( ',', \implode( ' ', $matches[1] ) );
				} else {
					$rgba = \explode( ',', $color );
				}

				$rr = \dechex( $rgba['0'] );
				$gg = \dechex( $rgba['1'] );
				$bb = \dechex( $rgba['2'] );

				return \mb_strtoupper( "#$rr$gg$bb" );
			}
		}

		return $color;
	}, $colors );

	// Remove duplicates
	$colors = \array_filter( \array_unique( $colors, \SORT_STRING ) );

	$colorString = "'" . \implode( "','", $colors ) . "'";

	\do_action( 'qm/debug', ['adding colors2', $colorString] );

	\wp_register_script( PREFIX . '-acf_colors', '', [], false, true );
	\wp_enqueue_script( PREFIX . '-acf_colors' );
	\wp_add_inline_script(
		PREFIX . '-acf_colors',
		"
		if (window.acf) {
			// Add customizer colors to ACF color picker
			console.log('Adding customizer colors to ACF color picker');
			acf.add_filter('color_picker_args', function(args, field) {
				console.log('Added them!');
				args.palettes = [{$colorString}];
				return args;
			});
		}
		"
	);
} );
