<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$this_term = \get_queried_object();

?>

<?php if ( ! \is_home() ): ?>

	<?php if (
		not_empty( $args, 'header-background_color', true )
		|| not_empty( $args, 'header-background_image', true )
		|| not_empty( $args, 'header-text_color', true )
	): ?>
		<style>
			main.archive {
				--archive_header-background_color: <?php echo $args['header-background_color']; ?>;
				--archive_header-background_image: <?php echo $args['header-background_image']; ?>;
				--archive_header-text_color: <?php echo $args['header-text_color']; ?>;
			}
		</style>
	<?php endif; ?>

	<header
		class="row page_title
		<?php
			if (
				not_empty( $args, 'header-background_color', true )
				|| not_empty( $args, 'header-background_image', true )
			) {
				echo 'has_background';
			}
		?>"
	>

		<div class="row-container">

			<?php if ( \is_taxonomy_hierarchical( $this_term->taxonomy ) ): ?>

				<?php if ( \property_exists( $this_term, 'parent' ) && $this_term->parent ): ?>

					<div class="category_parents">

						<?php
		echo \untrailingslashit( \get_term_parents_list(
			$this_term->term_id,
			$this_term->taxonomy,
			[ 'inclusive' => false ]
		) );
						?>

					</div>
				<?php endif; ?>

			<?php endif; ?>

			<h1>

				<?php if ( \is_tag() ): ?>

					<span class="prepend">Tag: </span>
					<?php echo \esc_html( \single_term_title() ); ?>

				<?php elseif ( \is_category() || \is_tax() ): ?>

					<?php echo \esc_html( \single_term_title() ); ?>

				<?php elseif ( \is_home() ): ?>

					<?php echo \get_the_title( \get_option( 'page_for_posts', true ) ); ?>

				<?php else: ?>

					<?php echo \post_type_archive_title(); ?>

				<?php endif; ?>

			</h1>

			<?php
				$subtitle = \get_field( 'field_6136452e5eecb', $this_term );
			?>

			<?php if ( $subtitle ): ?>
				<h2><?php echo $subtitle; ?></h2>
			<?php endif; ?>

		</div>

	</header>

	<?php if ( $args['term_children'] ): ?>

		<div class="row">
			<div class="row-container tax-children-nav">
				<nav>
					<ul>
					<?php foreach ( $args['term_children'] as $child_term ): ?>
						<li class="tax-<?php echo $child_term->slug; ?>">
							<a href="<?php echo \get_term_link( $child_term ); ?>">
								<?php echo $child_term->name; ?>
							</a>
						</li>
					<?php endforeach; ?>
					</ul>
				</nav>
			</div>
		</div>

	<?php endif; ?>

<?php endif; ?>