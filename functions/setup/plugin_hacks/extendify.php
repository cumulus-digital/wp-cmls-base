<?php
/**
 * Extendify / EditorPlus
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Disable extendify library
if ( \function_exists( 'extendifysdkCheckPluginInstalled' ) ) {
	\add_filter( 'extendifysdk_load_library', '__return_false' );
	\add_action( 'admin_head', function () {
		echo '<style>#extendify-templates-inserter-btn{display: none!important;}</style>';
	} );
}
