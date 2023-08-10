<?php
/**
 * Hacks for PublishPress Permissions.
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

if ( \defined( 'PRESSPERMIT_VERSION' ) ) {
	\add_action( 'current_screen', function () {
		$screen = \get_current_screen();

		// Collapse the PPP editor metaboxes by default
		if ( \is_admin() && \property_exists( $screen, 'post_type' ) ) {
			\add_filter( "get_user_option_closedpostboxes_{$screen->post_type}", function ( $closed ) {
				$closed[] = 'pp_read_page_exceptions';
				$closed[] = 'pp_edit_page_exceptions';
				$closed[] = 'pp_associate_page_exceptions';
				$closed[] = 'pp_assign_page_exceptions';

				return $closed;
			}, 10, 1 );
		}
	} );
}
