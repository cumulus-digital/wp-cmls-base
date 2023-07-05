<?php
/**
 * Extendify / EditorPlus.
 */

namespace CMLS_Base\Setup\PluginHacks;

use const CMLS_Base\PREFIX;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Disable extendify library
if ( \function_exists( 'extendifysdkCheckPluginInstalled' ) ) {
	\add_filter( 'extendifysdk_load_library', '__return_false' );
	\add_action( 'admin_head', function () {
		\wp_register_style( PREFIX . '-disable_extendify_library', '' );
		\wp_enqueue_style( PREFIX . '-disable_extendify_library', '' );
		\wp_add_inline_style(
			PREFIX . '-disable_extendify_library',
			'#extendify-templates-inserter-btn{display: none!important;}'
		);
	} );
}
