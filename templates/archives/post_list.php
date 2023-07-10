<?php
/**
 * CMLS Base Theme
 * Archive / Post list.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

if ( isset( $args['the_posts'] ) ) {
	$the_posts = $args['the_posts'];
} else {
	global $wp_query;
	$the_posts = $wp_query;
}

if ( ! isset( $args['row-class'] ) ) {
	$args['row-class'] = null;
}
?>

<!-- templates/archives/post_list -->
<div class="row <?php echo $args['row-class']; ?>">
	<div class="row-container <?php echo $args['display_format']; ?>">

	<?php if ( \has_action( 'cmls_template-archive-before_posts' ) ): ?>
		<!-- action:cmls_template-archive-before_posts -->
		<?php \do_action( 'cmls_template-archive-before_posts' ); ?>
		<!-- /action:cmls_template-archive-before_posts -->
	<?php endif; ?>

	<?php while ( $the_posts->have_posts() ): $the_posts->the_post(); ?>

		<?php
			cmls_get_template_part( 'templates/pages/excerpt', make_post_class(), $args );
		?>

	<?php endwhile; ?>

	<?php if ( \has_action( 'cmls_template-archive-after_posts' ) ): ?>
		<!-- action:cmls_template-archive-after_posts -->
		<?php \do_action( 'cmls_template-archive-after_posts' ); ?>
		<!-- /action:cmls_template-archive-after_posts -->
	<?php endif; ?>

	</div>
</div>
<!-- /templates/archives/post_list -->