<?php
/**
 * CMLS Base Theme Gateway
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

if ( \is_archive() || \is_home() ) {
	cmls_get_template_part( 'archive' );
}

if ( \is_singular() ) {
	cmls_get_template_part( 'singular' );
}
