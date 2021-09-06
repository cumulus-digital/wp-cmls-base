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

if ( \is_object( $this_term ) && \property_exists( $this_term, 'taxonomy' ) && \is_taxonomy_hierarchical( $this_term->taxonomy ) ) {
	// Necessary to go back to the DB because PublishPress Permissions may break the cache...
	$term_children_ids = \get_term_children( $this_term->term_id, $this_term->taxonomy );
	$term_children     = \get_terms( [
		'taxonomy'   => $this_term->taxonomy,
		'include'    => $term_children_ids,
		'parent'     => $this_term->term_id,
		'hide_empty' => true,
	] );
}

\get_header();
?>

<main role="main" class="archive">

	<div class="row">
		<div class="row-container <?php echo has_global_sidebar() ? 'has-global-sidebar' : ''; ?>">

		<?php if ( has_global_sidebar() ): ?>
			<?php \get_sidebar(); ?>
		<?php endif; ?>

		<div>

	<?php cmls_get_template_part( 'templates/pages/archive-header', make_post_class(), \array_merge( $display_args, [ 'term_children' => $term_children ] ) ); ?>

	<?php \do_action( 'cmls_template-archive-before_content' ); ?>

	<?php cmls_get_template_part( 'templates/pages/archive-blog_page_content' ); ?>

	<?php if ( \have_posts() ): ?>

		<?php
			cmls_get_template_part( 'templates/pages/archive-postlist', make_post_class(), $display_args );
		?>

		<?php if ( is_paginated() ): ?>
			<?php cmls_get_template_part( 'templates/pages/pagination' ); ?>
		<?php endif; ?>

	<?php elseif ( ! $term_children ): ?>

		<article class="row">
			<div class="row-container">
				<p>Sorry, nothing here.</p>
			</div>
		</article>

	<?php endif; ?>

	<?php \do_action( 'cmls_template-archive-after_content' ); ?>

		</div>
		</div>
	</div>

</main>

<?php
\get_footer();
