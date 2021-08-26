<?php
/**
 * CMLS Base Theme
 * Post archive template
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Defaults
$term_display_format = 'cards';
$term_post_display   = [
	'title'          => true,
	'date'           => check_query_post_type_hierarchical() ? false : true,
	'excerpt'        => true,
	'featured_image' => true,
];

$term        = \get_queried_object();
$term_fields = get_parent_fields( $term );

if ( $term_fields ) {
	if ( isset( $term_fields['cmls-tax-archive_display'] ) ) {
		$term_display_format = $term_fields['cmls-tax-archive_display'];
	}

	if ( isset( $term_fields['cmls-tax-post_display'] ) ) {
		$term_post_display = \array_merge( $term_post_display, $term_fields['cmls-tax-post_display'] );
	}
}

\get_header();
?>

<main role="main" class="archive">

	<?php cmls_get_template_part( 'templates/pages/archive-header' ); ?>

	<?php \do_action( 'cmls_template-archive-before_content' ); ?>

	<?php if ( \have_posts() ): ?>

		<div class="row">
			<div class="row-container <?php echo $term_display_format; ?>">

			<?php \do_action( 'cmls_template-archive-before_posts' ); ?>

			<?php while ( \have_posts() ): \the_post(); ?>

				<?php
cmls_get_template_part(
	'templates/pages/excerpt',
	make_post_class(),
	[
		'show_title'   => $term_post_display['title'],
		'show_date'    => $term_post_display['date'],
		'show_excerpt' => $term_post_display['excerpt'],
		'show_image'   => $term_post_display['featured_image'],
	]
);
				?>

			<?php endwhile; ?>

			<?php \do_action( 'cmls_template-archive-after_posts' ); ?>

			</div>
		</div>

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
