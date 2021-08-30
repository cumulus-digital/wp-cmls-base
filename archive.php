<?php
/**
 * CMLS Base Theme
 * Post archive template
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Defaults
$display_args = get_tax_display_args();

// This term
$this_term     = \get_queried_object();
$term_children = null;

if ( \property_exists( $this_term, 'taxonomy' ) && \is_taxonomy_hierarchical( $this_term->taxonomy ) ) {
	$term_children = \get_terms( [ 'taxonomy' => $this_term->taxonomy, 'parent' => $this_term->term_id, 'hide_empty' => true ] );
}

\get_header();
?>

<main role="main" class="archive">

	<?php cmls_get_template_part( 'templates/pages/archive-header', null, \array_merge( $display_args, [ 'term_children' => $term_children ] ) ); ?>

	<?php \do_action( 'cmls_template-archive-before_content' ); ?>

	<?php if ( \have_posts() ): ?>

		<?php
			cmls_get_template_part( 'templates/pages/archive-postlist', make_post_class(), $display_args );
		?>

		<?php if ( is_paginated() ): ?>
			<?php cmls_get_template_part( 'templates/pages/pagination' ); ?>
		<?php endif; ?>

	<?php else: ?>

		<article class="row">
			<div class="row-container">
				<p>Sorry, nothing here.</p>
			</div>
		</article>

	<?php endif; ?>

	<?php \do_action( 'cmls_template-archive-after_content' ); ?>

</main>

<?php
\get_footer();
