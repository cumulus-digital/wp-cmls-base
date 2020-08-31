<?php
/**
 * Menu initialization
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

function init_nav_support() {
	\register_nav_menus(array(
		'header-menu' => __('Header Menu'),
		'footer-menu' => __('Footer Menu')
	));
}
\add_action( 'after_setup_theme', ns('init_nav_support') );

function makeMenu($location, $options = array()) {
	$defaults = array(
		'theme_location'  => $location,
		'menu'            => '',
		'container'       => '',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul itemscope itemtype="http://www.schema.org/SiteNavigationElement">%3$s</ul>',
		'depth'           => 0,
		'walker'          => new CleanMenuWalker
	);
	$resolved = array_merge($defaults, $options);
	\wp_nav_menu($resolved);
}

function header_menu() {
	makeMenu('header-menu');
}

function footer_menu() {
	makeMenu('footer-menu');
}