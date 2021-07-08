<?php
/**
 * Child themes can require this file to import
 * helpers and classes into their own namespace.
 */

// Helper functions
use function \CMLS_Base\{
	ns,
	theme_url,
	child_theme_url,
	theme_path,
	child_theme_path,
	gav,
	hav,
	base_post_title,
	getRGB,
	rgbS,
	getCopyright,
	is_paginated,
	getURLFromFilePost,
	generateBodyClasses,
	make_post_class,
	cmls_get_template_part,
	cmls_locate_template
};

use \CMLS_Base\BodyClasses;
use \CMLS_Base\CleanMenuWalker;
use \CMLS_Base\themeMods;
