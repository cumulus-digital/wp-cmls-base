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
		'thumbnail_size'       => 'full',
		'force_featured_image' => \apply_filters( 'force_featured_image', false ),
	],
	$args
);
?>

<?php // By default, only show featured image here in cat/tag lists?>
<?php if ( ( ! \is_singular() || $args['force_featured_image'] ) && \has_post_thumbnail() ): ?>

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
			\the_post_thumbnail( $args['thumbnail_size'], [ 'alt' => \esc_attr( \get_the_title() ) ] );
		?>

	</figure>

	<?php if ( $args['display_format'] !== 'cards' ): ?>
		</a>
	<?php endif; ?>

<?php endif; ?>
