<?php
/**
 * CMLS Base Theme
 * Template
 * Excerpts
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$title_tag = 'h2';

// Defaults
$display_args = resolve_post_display_args( $args );
//echo '<pre>'; \var_dump( $display_args ); echo '</pre>';
?>

<article
	id="post-<?php \the_ID(); ?>"
	<?php \post_class( 'archive excerpt' ); ?>
>

	<?php if ( $display_args['display_format'] === 'cards' ): ?>
	<a href="<?php \the_permalink(); ?>" title="<?php echo \esc_attr( \get_the_title() ); ?>">
	<?php endif; ?>

		<?php if ( $display_args['show_image'] ): ?>
			<?php
cmls_get_template_part(
	'templates/pages/featured_image',
	make_post_class(),
	\array_merge(
		$display_args,
		[ 'thumbnail_size' => $display_args['thumbnail_size'] ]
	)
);
			?>
		<?php endif; ?>

		<?php if ( $display_args['show_title'] || $display_args['show_date'] || $display_args['show_author'] || $display_args['show_excerpt'] ): ?>
		<div class="body-container">

			<header>

				<?php if ( $display_args['show_title'] ): ?>
					<<?php echo $title_tag; ?> class="post_title">
						<?php if ( $display_args['display_format'] === 'list' ): ?>
						<a href="<?php \the_permalink(); ?>" title="<?php echo \esc_attr( \get_the_title() ); ?>">
						<?php endif; ?>
							<?php \the_title(); ?>
						<?php if ( $display_args['display_format'] === 'list' ): ?>
						</a>
						<?php endif; ?>
					</<?php echo $title_tag; ?>>
				<?php endif; ?>

				<?php if ( $display_args['show_date'] || $display_args['show_author'] || $display_args['show_source'] ): ?>
				<div class="meta">

					<?php if ( $display_args['show_date'] ): ?>
						<time datetime="<?php echo \get_the_date( 'Y-m-d', \get_the_ID() ); ?>">
							<?php echo \get_the_date( 'F j, Y', \get_the_ID() ); ?>
						</time>
					<?php endif; ?>

					<?php if ( $display_args['show_author'] ): ?>
						<span class="author">
							By
							<?php if ( $display_args['display_format'] === 'list' ): ?>
								<?php \the_author_posts_link(); ?>
							<?php else: ?>
								<?php \the_author(); ?>
							<?php endif; ?>
						</span>
					<?php endif; ?>

					<?php if ( $display_args['show_source'] && \get_post_meta( \get_the_ID(), '_wpn_prs_meta_prsource', true ) ): ?>
						<div class="source">
							<?php echo \esc_html( \get_post_meta( \get_the_ID(), '_wpn_prs_meta_prsource', true ) ); ?>
						</div>
					<?php endif; ?>

				</div>
				<?php endif; ?>

				<?php if ( \has_category() && $display_args['show_category'] ): ?>
					<div class="post_category">
						In
						<?php if ( $display_args['display_format'] === 'list' ): ?>
							<?php \the_category( ' <span class="sep">/</span> ', 'multiple' ); ?>
						<?php else: ?>
							<?php echo \implode( ' <span class="sep">/</span> ', \array_column( \get_the_category(), 'name' ) ); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</header>

			<?php if ( $display_args['show_excerpt'] && \mb_strlen( \wp_trim_excerpt( \get_the_excerpt() ) ) ): ?>
			<div class="body">
				<?php echo \wp_trim_excerpt( \get_the_excerpt() ); ?>
			</div>
			<?php endif; ?>

		</div>
		<?php endif; ?>

	<?php if ( $display_args['display_format'] === 'cards' ): ?>
	</a>
	<?php endif; ?>

</article>
