<?php
/**
 * CMLS Base Theme
 * Post archive template
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

if ( ! isset( $args['the_posts'] ) ) {
	global $wp_query;
	$args['the_posts'] = $wp_query;
}

if ( ! isset( $args['row-class'] ) ) {
	$args['row-class'] = null;
}
?>

<div class="row <?php echo $args['row-class']; ?>">
	<div class="row-container <?php echo $args['display_format']; ?>">

	<?php \do_action( 'cmls_template-archive-before_posts' ); ?>

	<?php while ( $args['the_posts']->have_posts() ): $args['the_posts']->the_post(); ?>

		<?php
			cmls_get_template_part( 'templates/pages/excerpt', make_post_class(), $args );
		?>

	<?php endwhile; ?>

	<?php \do_action( 'cmls_template-archive-after_posts' ); ?>

	</div>
</div>