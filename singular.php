<?php
/**
 * CMLS Base Theme
 * Single post template.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$args = \array_merge( array(
	'show_sidebar' => null,
), isset( $args ) ? $args : array() );

\get_header();
?>

<!-- singular -->
<main role="main" class="single">

	<div class="row">
		<div class="row-container <?php echo has_global_sidebar( $args['show_sidebar'] ) ? 'has-global-sidebar' : ''; ?>">

			<?php if ( has_global_sidebar( $args['show_sidebar'] ) ): ?>
				<?php \get_sidebar(); ?>
			<?php endif; ?>

			<div>

				<?php if ( \has_action( 'cmls_template-singular-before_post' ) ): ?>
					<!-- action:cmls_template-singular-before_post -->
					<?php \do_action( 'cmls_template-singular-before_post' ); ?>
					<!-- /action:cmls_template-singular-before_post -->
				<?php endif; ?>

				<?php while ( \have_posts() ): \the_post(); ?>

					<?php cmls_get_template_part( 'templates/pages/base' ); ?>

				<?php endwhile; ?>

				<?php if ( \has_action( 'cmls_template-singular-after_post' ) ): ?>
					<!-- action:cmls_template-singular-after_post -->
					<?php \do_action( 'cmls_template-singular-after_post' ); ?>
					<!-- /action:cmls_template-singular-after_post -->
				<?php endif; ?>

			</div>

		</div>
	</div>

</main>
<!-- /singular -->

<?php
\get_footer();
