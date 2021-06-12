<?php
/**
 * CMLS Base Theme
 * Post archive template
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

\get_header();
?>

<main role="main" class="archive">

	<?php cmls_get_template_part('templates/pages/archive-header'); ?>

	<?php \do_action('cmls_template-archive-before_content'); ?>

	<?php if (\have_posts()): ?>

		<div class="row">
			<div class="row-container cards">

			<?php \do_action('cmls_template-archive-before_posts'); ?>

			<?php while (\have_posts()): \the_post() ?>

				<?php cmls_get_template_part('templates/pages/excerpt', make_post_class()); ?>
				
			<?php endwhile ?>

			<?php \do_action('cmls_template-archive-after_posts'); ?>

			</div>
		</div>

		<?php if (is_paginated()): ?>
			<?php cmls_get_template_part('templates/pages/pagination'); ?>
		<?php endif ?>

	<?php else: ?>

		<article class="row">
			<div class="row-container">
				<p>Sorry, nothing here.</p>
			</div>
		</article>
	
	<?php endif ?>

	<?php \do_action('cmls_template-archive-after_content'); ?>

</main>

<?php
\get_footer();