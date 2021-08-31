<?php
/**
 * Hacks for All In One SEO
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Collapse the AIOSEO editor metabox by default
\add_action( 'current_screen', function () {
	$screen = \get_current_screen();

	if ( \is_admin() && \property_exists( $screen, 'post_type' ) ) {
		\add_filter( "get_user_option_closedpostboxes_{$screen->post_type}", function ( $closed ) {
			$closed[] = 'aioseo-settings';

			return $closed;
		}, 10, 1 );
	}
} );
