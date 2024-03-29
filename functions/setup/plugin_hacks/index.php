<?php
/**
 * Hacks for specific plugins.
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

require __DIR__ . '/wp-optimize.php';
require __DIR__ . '/yoast.php';
require __DIR__ . '/aioseo.php';
require __DIR__ . '/kadence.php';
require __DIR__ . '/extendify.php';
require __DIR__ . '/publishpress-permissions.php';
require __DIR__ . '/jc-submenu.php';
require __DIR__ . '/git_updater.php';
require __DIR__ . '/jetpack.php';
require __DIR__ . '/updraftplus.php';
