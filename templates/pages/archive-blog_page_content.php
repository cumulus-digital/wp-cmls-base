<?php
/**
 * CMLS Base Theme
 * Template part
 * Inserts to content of the blog page, used at the start of blog archives when
 * blog page is set in settings / reading
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<?php if ( \is_home() ): ?>
	<?php
		\wp_reset_postdata();

		$blog_page = new \WP_Query( [
			//'post_type' => 'page',
			'p'         => \get_option( 'page_for_posts' ),
			'post_type' => 'page',
		] );

		global $wp_query;
		$old_wp_query          = clone $wp_query;
		$wp_query->is_singular = true;
	?>

	<?php while ( $blog_page->have_posts() ): $blog_page->the_post(); ?>

		<div class="row archive-content-follows">
			<div class="row-container">
				<?php cmls_get_template_part( 'templates/pages/base' ); ?>
			</div>
		</div>

	<?php endwhile; ?>
	<?php
		\wp_reset_postdata();
		$wp_query->is_singular = $old_wp_query->is_singular;
	?>
<?php endif; ?>