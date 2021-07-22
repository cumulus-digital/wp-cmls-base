<?php
/**
 * Various security-minded changes inspired by or lifted from
 * github.com/CityOfNewYork/nyco-wp-boilerplate
 */

namespace CMLS_Base\Setup\Security;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

/*
 * Change the default wordpress nonce lifetime to 1 hour
 */
\add_filter( 'nonce_life', function () {
	return HOUR_IN_SECONDS;
} );

require __DIR__ . '/script_nonce.php';
require __DIR__ . '/disable_defaults.php';
require __DIR__ . '/headers.php';
require __DIR__ . '/robots.php';
