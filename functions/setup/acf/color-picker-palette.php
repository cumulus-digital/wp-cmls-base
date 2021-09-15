<?php
/**
 * ACF setup continued
 * Give ACF color pickers our customizer palette
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_action( 'acf/input/admin_footer', function () {
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
				$rgba = [];
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

	$colorString = "'" . \implode( "','", $colors ) . "'"; ?>
	<script>
		acf.add_filter('color_picker_args', function( args, field ){

			// Add customizer colors to ACF color picker
			args.palettes = [<?php echo $colorString; ?>];
			return args;

		});
	</script>
	<?php
} );
