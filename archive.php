<?php
/**
 * CMLS Base Theme
 * Post archive template
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Defaults
$display_args = get_tax_display_args( isset( $args ) ? $args : [] );
$args         = isset( $args ) ? \array_merge( (array) $args, $display_args ) : $display_args;

// This term
$this_term     = isset( $args ) && \array_key_exists( 'this_term', $args ) ? $args['this_term'] : \get_queried_object();
$term_children = null;

if (
	! isset( $args['term_children'] )
	&& (
		\is_a( $this_term, 'WP_Term' ) && \is_taxonomy_hierarchical( $this_term->taxonomy )
	)
) {
	// Necessary to go back to the DB because PublishPress Permissions may break the cache...
	$term_children_ids = \get_term_children( $this_term->term_id, $this_term->taxonomy );
	$term_children     = \get_terms( [
		'taxonomy'   => $this_term->taxonomy,
		'include'    => $term_children_ids,
		'parent'     => $this_term->term_id,
		'hide_empty' => true,
	] );
	$args['term_children'] = $term_children;
}

\get_header();
?>

<!-- archive -->
<main role="main" class="archive">

	<?php cmls_get_template_part( 'templates/archives/header', make_post_class(), $args ); ?>

	<div class="row archive-content">
		<div class="row-container <?php echo has_global_sidebar( $args['show_sidebar'] ) ? 'has-global-sidebar' : ''; ?>">

			<?php if ( has_global_sidebar( $args['show_sidebar'] ) ): ?>
				<?php \get_sidebar(); ?>
			<?php endif; ?>

			<div>

				<?php \do_action( 'cmls_template-archive-before_content' ); ?>

				<?php if ( \have_posts() ): ?>

					<?php
						cmls_get_template_part( 'templates/archives/post_list', make_post_class(), $args );
					?>

					<?php if ( is_paginated() ): ?>
						<?php cmls_get_template_part( 'templates/pages/pagination' ); ?>
					<?php endif; ?>

				<?php elseif ( ! $args['term_children'] ): ?>

					<p>Sorry, nothing here.</p>

				<?php endif; ?>

				<?php \do_action( 'cmls_template-archive-after_content' ); ?>

			</div>
		</div>
	</div>

</main>
<!-- /archive -->

<?php
\get_footer();
