<?php
/**
 * CMLS Base Theme
 * Header
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

if (
	\is_singular()
) {
	generateBodyClasses();
}

\get_template_part('templates/html-head');

?>
<body <?php \body_class(); ?>>
	<?php if ( function_exists('gtm4wp_the_gtm_tag') ) { \gtm4wp_the_gtm_tag(); } ?>

	<?php \get_template_part('templates/masthead/base'); ?>