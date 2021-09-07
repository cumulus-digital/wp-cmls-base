<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Menu
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\get_header();
?>

<!-- search -->
<main role="main" class="search">

	<header class="row page_title">
		<div class="row-container">
			<h1>Search Results</h1>
			<?php cmls_get_template_part( 'templates/masthead/search' ); ?>
		</div>
	</header>

	<?php if ( \have_posts() ): ?>

		<div class="row">
			<div class="row-container list">
			<?php while ( \have_posts() ): \the_post(); ?>

				<?php
cmls_get_template_part(
	'templates/pages/excerpt',
	make_post_class(),
	[ 'display_format' => 'list' ]
);
				?>

			<?php endwhile; ?>
			</div>
		</div>

		<?php if ( is_paginated() ): ?>
			<?php cmls_get_template_part( 'templates/pages/pagination' ); ?>
		<?php endif; ?>

	<?php else: ?>

		<article class="row">
			<div class="row-container">
				<p>Sorry, nothing found.</p>
			</div>
		</article>

	<?php endif; ?>

</main>
<!-- /search -->

<?php
\get_footer();
