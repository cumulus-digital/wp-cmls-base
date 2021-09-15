<?php
/**
 * JC Submenu
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Use our own walker
\add_filter( 'jcs/enable_public_walker', function ( $default ) {
	return false;
} );
