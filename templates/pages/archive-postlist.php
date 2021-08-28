<?php
/**
 * CMLS Base Theme
 * Post archive template
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<div class="row">
	<div class="row-container <?php echo $args['display_format']; ?>">

	<?php \do_action( 'cmls_template-archive-before_posts' ); ?>

	<?php while ( \have_posts() ): \the_post(); ?>

		<?php
			cmls_get_template_part( 'templates/pages/excerpt', make_post_class(), $args );
		?>

	<?php endwhile; ?>

	<?php \do_action( 'cmls_template-archive-after_posts' ); ?>

	</div>
</div>