<?php
/**
 * ACF setup continued
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Disable ACF menu if we're not in a local dev environment
function acfDisableAdminInProd() {
	if (
		\mb_strstr( \get_site_url(), '.local' ) === false
		&& \mb_strstr( \get_site_url(), '.dev' ) === false
		&& \mb_strstr( \get_site_url(), 'localhost' ) === false
	) {
		\acf_update_setting( 'show_admin', false );
	}
}
\add_action( 'acf/init', ns( 'acfDisableAdminInProd' ) );

// Load and save only our acf-json
$MY_ACF_GROUPS = [
	'group_5f467bc4cb553', // "Display Options"
	'group_6126e1875bbac', // "Taxonomy Archive Options"
	'group_613a6799d633a', // "Alt. Display Author"
];
$ACF_JSON = new Vendors\vena\AcfJson\Loader( $MY_ACF_GROUPS, theme_path() );

include __DIR__ . '/permanent_metabox_order.php';
include __DIR__ . '/location-hierarchical_post.php';
include __DIR__ . '/location-hierarchical_taxonomy.php';
include __DIR__ . '/post_title.php';
include __DIR__ . '/post_author.php';
include __DIR__ . '/validation.php';
include __DIR__ . '/color-picker-palette.php';

foreach ( $MY_ACF_GROUPS as $acf_group ) {
	acfResetMetaboxesForCPT( 'post', $acf_group );
	acfResetMetaboxesForCPT( 'page', $acf_group );
}
