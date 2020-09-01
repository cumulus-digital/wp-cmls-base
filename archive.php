<?php
/**
 * CMLS Base Theme
 * Post archive template
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// Allow a page to take over
$currentQuery = \get_queried_object();
$slug = '';
if (property_exists($currentQuery, 'slug')) {
	$slug = $currentQuery->slug;
} else if (property_exists($currentQuery, 'rewrite')) {
	if (array_key_exists('slug', $currentQuery->rewrite)) {
		$slug = $currentQuery->rewrite['slug'];
	}
}
if ($slug) {
	$query = new \WP_Query(array(
		'post_type' => 'page',
		'name' => $slug
	));
	//\query_posts('pagename=' . $slug);
	if ($query->have_posts()) {
		$wp_query = $query;
		$posts = $query->get_posts();
		$post = array_shift($posts);
		\get_template_part('singular', 'page');
		return;
	}
	\wp_reset_query();
}

\get_header();
?>

<main role="main" class="archive">

	<?php \get_template_part('templates/pages/archive-header'); ?>

	<?php if (\have_posts()): ?>

		<div class="row">
			<div class="row-container cards">
			<?php while (\have_posts()): \the_post() ?>

				<?php \get_template_part('templates/pages/base'); ?>

			<?php endwhile ?>
			</div>
		</div>

		<?php if (is_paginated()): ?>
			<?php \get_template_part('templates/pages/pagination'); ?>
		<?php endif ?>

	<?php else: ?>

		<article class="row">
			<div class="row-container">
				<p>Sorry, nothing here.</p>
			</div>
		</article>
	
	<?php endif ?>

</main>

<?php
\get_footer();