<?php
/**
 * Frontend scripts and styles
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

function frontendScriptsAndStyles() {

	if (
		$GLOBALS['pagenow'] != 'wp-login.php'
		&& ! \is_admin()
	) {

		$assets = include(
			theme_path() . '/build/frontend.asset.php'
		);
		\wp_register_script(
			PREFIX . '_script-frontend',
			theme_url() . '/build/frontend.js',
			$assets['dependencies'],
			$assets['version'],
			true
		);
		\wp_enqueue_script(PREFIX . '_script-frontend');

		\wp_register_style(
			PREFIX . '_style',
			theme_url() . '/build/frontend.css',
			array(), //array(PREFIX . '_customizer_vars'),
			null,
			'all'
		);
		\wp_enqueue_style(PREFIX . '_style');
	}

}
\add_action('wp_enqueue_scripts', ns('frontendScriptsAndStyles'));

function setQueryLimitToTwelve($query) {
	if (\is_admin() || ! $query->is_main_query()) {
		return;
	}
	$query->set('posts_per_page', 12);
	return $query;
}
\add_action('pre_get_posts', ns('setQueryLimitToTwelve'));

function removePageTitleOnHomepage($title) {
	if (\is_home() || \is_front_page()) {
		return false;
	}
}
\add_filter('pre_get_document_title', ns('removePageTitleOnHomepage'), 999, 1);

function filterRemovePrivateProtectedPrepend($format, $post) {
	if ( ! \is_admin()) {
		return '%s';
	}
	return $format;
}
\add_filter('protected_title_format', ns('filterRemovePrivateProtectedPrepend'));
\add_filter('private_title_format', ns('filterRemovePrivateProtectedPrepend'));

// Remove prefix from archive titles
function filterRemoveArchivePrepend($title) {
	if ( \is_category() ) {
		$title = \single_cat_title( '', false );
	} elseif ( \is_tag() ) {
		$title = \single_tag_title( '', false );
	} elseif ( \is_author() ) {
		$title = '<span class="vcard">' . \get_the_author() . '</span>';
	} elseif ( \is_post_type_archive() ) {
		$title = \post_type_archive_title( '', false );
	} elseif ( \is_tax() ) {
		$title = \single_term_title( '', false );
	}

	return $title;
}
\add_filter('get_the_archive_title', ns('filterRemoveArchivePrepend'));

function letPagesOverrideArchives(&$query) {
	if (\is_admin() || ! $query->is_main_query()) {
		return $query;
	}
	if ($query->is_archive()) {
		$currentQuery = \get_queried_object();
		$slug = '';
		if ($currentQuery && property_exists($currentQuery, 'slug')) {
			$slug = $currentQuery->slug;
		} else if (property_exists($currentQuery, 'rewrite')) {
			if (array_key_exists('slug', $currentQuery->rewrite)) {
				$slug = $currentQuery->rewrite['slug'];
			}
		}
		if ($slug) {
			$query->init();
			$query->set('post_type', 'page');
			$query->set('name', $slug);
			$query->get_posts();
			//echo '<pre>'; var_dump($query); die();
			return $query;
			$query = new \WP_Query(array(
				'post_type' => 'page',
				'name' => $slug
			));
		}
	}
}
\add_action('pre_get_posts', ns('letPagesOverrideArchives'));