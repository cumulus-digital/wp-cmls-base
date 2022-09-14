<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Featured Image
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
$args = \array_merge(
	[
		'display_format'       => 'cards',
		'thumbnail_size'       => 'thumbnail-uncropped',
		'force_featured_image' => \apply_filters( 'force_featured_image', false ),
		'disable_lazyload'     => \apply_filters( 'featurediamge_disable_lazyload', false ),
	],
	$args
);
?>

<?php // By default, only show featured image here in cat/tag lists?>
<?php if ( ( ! \is_singular() || $args['force_featured_image'] ) && \has_post_thumbnail() ): ?>

	<!-- templates/pages/featured_image -->
	<?php if ( $args['display_format'] !== 'cards' ): ?>
		<a href="<?php \the_permalink(); ?>" title="<?php echo \esc_attr( \get_the_title() ); ?>" class="featured-image">
	<?php endif; ?>

	<style>
		.post-<?php \the_ID(); ?> {
			--featured_image: url('<?php echo \esc_attr( \get_the_post_thumbnail_url( null, $args['thumbnail_size'] ) ); ?>');
		}
	</style>
	<figure class="featured-image">

		<?php
			\the_post_thumbnail( $args['thumbnail_size'], [ 'alt' => \esc_attr( \get_the_title() ), 'loading' => $args['disable_lazyload'] ? 'eager' : 'lazy' ] );
	?>

	</figure>

	<?php if ( $args['display_format'] !== 'cards' ): ?>
		</a>
	<?php endif; ?>
	<!-- /templates/pages/featured_image -->

<?php endif; ?>
