<?php
/**
 * Hacks for All In One SEO
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Collapse the AIOSEO editor metabox by default
\add_filter( 'get_user_option_closedpostboxes_page', function ( $closed, $option, $user ) {
	$closed[] = 'members-cp';

	return $closed;
}, 10, 3 );
