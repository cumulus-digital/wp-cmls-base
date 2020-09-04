<?php
/**
 * CMLS Base Theme
 * Post archive template
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// Figure out what type of archive this is
function make_post_class() {
	$arch_type = '';
	$post_type = '';
	$qo = \get_queried_object();
	if (\is_post_type_archive()) {
		$arch_type = 'post-type-archive';
		$post_type = \get_query_var('post_type');
	} else if (\is_author()) {
		$arch_type = 'author';
		$post_type = $qo->user_nicename;
	} else if (\is_category()) {
		$arch_type = 'category';
		$post_type = $qo->taxonomy . '-' . $qo->slug;
	} else if (\is_tag()) {
		$arch_type = 'tag';
		$post_type = $qo->taxonomy . '-' . $qo->slug;
	} else if (\is_tax()) {
		$arch_type = 'tax';
		$post_type = $qo->taxonomy . '-' . $qo->slug;
	}
	
	return \sanitize_html_class($arch_type . '-' . $post_type);
}

\get_header();
?>

<main role="main" class="archive">

	<?php \get_template_part('templates/pages/archive-header'); ?>

	<?php if (\have_posts()): ?>

		<div class="row">
			<div class="row-container cards">
			<?php while (\have_posts()): \the_post() ?>

				<?php \get_template_part('templates/pages/excerpt', make_post_class()); ?>
				
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