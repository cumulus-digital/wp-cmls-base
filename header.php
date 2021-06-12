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

cmls_get_template_part('templates/html-head');

$slug = null;
$qo = \get_queried_object();
if (is_object($qo) && property_exists($qo, 'post_name')) {
	$slug = 'slug-' . \esc_attr($qo->post_name);
}
?>
<body <?php \body_class($slug); ?>>
	<?php if ( function_exists('gtm4wp_the_gtm_tag') ) { \gtm4wp_the_gtm_tag(); } ?>

	<?php cmls_get_template_part('templates/masthead/base'); ?>