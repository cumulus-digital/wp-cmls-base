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