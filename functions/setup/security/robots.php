<?php
/**
 * Modify the default robots.txt based on visibility settings
 */

namespace CMLS_Base\Setup\Security;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_filter( 'robots_txt', function ( $output, $public ) {
	$output = 'User-agent: *';

	if ( ! $public ) {
		$output .= "\nDisallow: /";
	} else {
		$output .= "\nDisallow: /wp-admin/";
		$output .= "\nDisallow: /wp-includes/";
		$output .= "\nDisallow: /wp-content/plugins/";
		$output .= "\nDisallow: /wp-content/mu-plugins/";
		$output .= "\nDisallow: /readme.html";
		$output .= "\nDisallow: /README.md";
		$output .= "\nAllow: /wp-admin/admin-ajax.php";
		$output .= "\nAllow: /wp-content/uploads/";
		$output .= "\n";
	}

	return $output;
}, 0, 2 );
