<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Featured Image
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
$thumbnail_size = isset( $args['thumbnail_size'] ) ? $args['thumbnail_size'] : 'full';
?>

<?php // By default, only show featured image here in cat/tag lists?>
<?php if ( ! \is_singular() && \has_post_thumbnail() ): ?>

    <style>
        .post-<?php \the_ID(); ?> {
            --featured_image: url('<?php echo \esc_attr( \get_the_post_thumbnail_url( null, $thumbnail_size ) ); ?>');
        }
    </style>
    <figure class="featured-image">
    <?php
		\the_post_thumbnail( $thumbnail_size, [ 'alt' => \esc_attr( \get_the_title() ) ] );
	?>
    </figure>

<?php endif; ?>
