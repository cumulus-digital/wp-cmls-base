<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

if (
	not_empty( $args, 'header-background_color', true )
	|| not_empty( $args, 'header-background_image', true )
	|| not_empty( $args, 'header-text_color', true )
):
	?>
		<style>
			main.archive {
				--archive_header-background_color: <?php echo $args['header-background_color']; ?>;
				--archive_header-background_image: <?php echo $args['header-background_image']; ?>;
				--archive_header-text_color: <?php echo $args['header-text_color']; ?>;
			}
		</style>
	<?php
endif;
?>
<header class="row page_title <?php
	if (
		not_empty( $args, 'header-background_color', true )
		|| not_empty( $args, 'header-background_image', true )
	) {
		echo 'has_background';
	}
?>">
	<div class="row-container">
		<div class="category_parents">
		<?php if ( \is_category() || \is_tax() ): $this_tax = \get_taxonomy( \get_queried_object()->taxonomy ); ?>
			<?php
				$this_term = \get_queried_object();
				$this_tax  = \get_taxonomy( $this_term->taxonomy );
			?>
			<?php if ( $this_tax->hierarchical ): ?>
				<?php
			echo \untrailingslashit( \get_term_parents_list(
				$this_term->term_id,
				$this_term->taxonomy,
				[ 'inclusive' => false ]
			) );
				?>
			<?php endif; ?>
		<?php endif; ?>
		</div>
		<h1>
			<?php if ( \is_tag() ): ?>
				<span class="prepend">Tag: </span>
				<?php echo \esc_html( \single_term_title() ); ?>
			<?php elseif ( \is_category() || \is_tax() ): ?>
				<?php echo \esc_html( \single_term_title() ); ?>
			<?php else: ?>
				<?php echo \post_type_archive_title(); ?>
			<?php endif; ?>
		</h1>
	</div>
</header>