<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<!-- templates/archive/header-normal -->
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

		<?php \do_action( 'cmls_template-archive-inside_header-start' ); ?>

		<?php if ( \is_a( $args['this_term'], 'WP_Term' ) && \is_taxonomy_hierarchical( $args['this_term']->taxonomy ) ): ?>

			<?php if ( \property_exists( $args['this_term'], 'parent' ) && $args['this_term']->parent ): ?>

				<div class="category_parents">

					<span class="parent-back">&lsaquo;</span>
					<?php
	echo \get_term_parents_list(
		$args['this_term']->term_id,
		$args['this_term']->taxonomy,
		[
			'inclusive' => false,
			'separator' => '<i></i>',
		]
	);
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
			$subtitle = \get_field( 'field_6136452e5eecb', $args['this_term'] );
		?>

		<?php if ( $subtitle ): ?>
			<h2><?php echo $subtitle; ?></h2>
		<?php endif; ?>

		<?php if ( $args['show_description'] && \mb_strlen( \term_description() ) ): ?>
			<div class="term-description">
				<?php echo \term_description(); ?>
			</div>
		<?php endif; ?>

		<?php \do_action( 'cmls_template-archive-inside_header-end' ); ?>

	</div>

</header>
<!-- /templates/archive/header-normal -->