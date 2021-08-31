<?php
/**
 * Hacks for Kadence Blocks
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Force Kadence to use our theme's editor width
\add_filter( 'kadence_blocks_editor_width', '__return_false', 9999 );

// Disable Kadence Design Library
\add_filter( 'kadence_blocks_design_library_enabled', '__return_false', 9999 );
