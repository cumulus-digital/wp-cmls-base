<?php
/**
 * ACF setup continued
 * Give ACF color pickers our customizer palette
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_action( 'acf/input/admin_footer', function () {
	$colors = themeMods::getColors();

	$colors = \array_map( function ( $color ) {
		// Convert hex colors to rgba
		if (
			\is_string( $color )
			&& \mb_substr( $color, 0, 1 ) === '#'
			&& (
				\mb_strlen( $color ) === 4 || \mb_strlen( $color ) === 7
			)
		) {
			return 'rgba(' . rgbS( $color ) . ', 1)';
		}

		return $color;
	}, $colors );

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
