<?php
/**
 * CMLS Base Theme Gateway
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

BodyClasses::add( 'index' );

if ( \is_archive() || \is_home() ) {
	cmls_get_template_part( 'archive', make_post_class() );
}

if ( \is_singular() ) {
	cmls_get_template_part( 'singular', make_post_class() );
}
