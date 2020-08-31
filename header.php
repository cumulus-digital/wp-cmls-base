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
	$page_custom_fields = \get_fields(\get_the_ID());
	if (gav($page_custom_fields, 'cmls-header_options-begin_under_masthead')) {
		BodyClasses::add('begin_under_masthead');

		if (gav($page_custom_fields, 'cmls-header_options-transparent_masthead')) {
			BodyClasses::add('transparent_masthead');
		}	
	}
	if (gav($page_custom_fields, 'cmls-footer_options-disable_bottom_padding')) {
		BodyClasses::add('disable_bottom_padding');
	}
}

\get_template_part('templates/html-head');

?>
<body <?php \body_class(); ?>>
	<?php if ( function_exists('gtm4wp_the_gtm_tag') ) { \gtm4wp_the_gtm_tag(); } ?>

	<?php \get_template_part('templates/masthead/base'); ?>