<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Menu.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Defaults
// $display_args = get_tax_display_args( isset( $args ) ? $args : [] );

$display_args = array(
	'display_format'          => 'list',
	'show_description'        => true,
	'show_sidebar'            => true,
	'show_image'              => true,
	'show_title'              => true,
	'show_date'               => false,
	'show_author'             => false,
	'show_category'           => false,
	'show_source'             => false,
	'show_excerpt'            => true,
	'thumbnail_size'          => 'thumbnail-uncropped',
	'header-background_color' => false,
	'header-background_image' => false,
	'header-text_color'       => false,
);
$args = isset( $args ) ? \array_merge( (array) $args, $display_args ) : $display_args;

\get_header();
?>

<!-- search -->
<main role="main" class="search archive">

	<?php cmls_get_template_part( 'templates/pages/search-header' ); ?>

	<?php if ( \have_posts() ): ?>

		<div class="row archive-content">

			<div class="row-container <?php echo has_global_sidebar( $args['show_sidebar'] ) ? 'has-global-sidebar' : ''; ?>">

				<?php if ( has_global_sidebar( $args['show_sidebar'] ) ): ?>
					<?php \get_sidebar(); ?>
				<?php endif; ?>

				<div>

					<?php if ( \has_action( 'cmls_template-search-before_content' ) ): ?>
						<!-- action:cmls_template-search-before_content -->
						<?php \do_action( 'cmls_template-search-before_content' ); ?>
						<!-- /action:cmls_template-search-before_content -->
					<?php endif; ?>

					<?php
						cmls_get_template_part( 'templates/archives/post_list', make_post_class(), $args );
		?>

					<?php if ( is_paginated() ): ?>
						<?php cmls_get_template_part( 'templates/pages/pagination' ); ?>
					<?php endif; ?>

					<?php if( \has_action( 'cmls_template-search-after_content' ) ): ?>
						<!-- action:cmls_template-search-after_content -->
						<?php \do_action( 'cmls_template-search-after_content' ); ?>
						<!-- /action:cmls_template-search-after_content -->
					<?php endif; ?>

				</div>
			</div>

		</div>

	<?php else: ?>

		<article class="row">
			<div class="row-container <?php echo has_global_sidebar( $args['show_sidebar'] ) ? 'has-global-sidebar' : ''; ?>">

				<?php if ( has_global_sidebar( $args['show_sidebar'] ) ): ?>
					<?php \get_sidebar(); ?>
				<?php endif; ?>

				<div>
					<div class="body">
						<p>Sorry, nothing found.</p>
					</div>
				</div>

			</div>
		</article>

	<?php endif; ?>

</main>
<!-- /search -->

<?php
\get_footer();
