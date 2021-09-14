<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Header
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$hide_header   = \get_field( 'cmls-header_options-hide_header', \get_the_ID(), false );
$display_args  = (array) \get_field( 'cmls-header_options-display', \get_the_ID() );
$has_header_bg = false;

if ( ! empty( $display_args['background_color'] ) || ! empty( $display_args['background_image'] ) ) {
	$has_header_bg = true;
}
?>

<!-- templates/pages/header -->
<?php
if (
	\is_singular()
	&& \mb_strlen( \get_the_title() )
	&& ! \is_front_page()
):
?>
	<?php if ( ! $hide_header ): ?>
		<style>
			#post-<?php \the_ID(); ?> {
			<?php foreach ( $display_args as $d_key => $d_arg ): ?>
				<?php if ( \mb_strstr( $d_key, 'image' ) ): ?>
					--page_title-<?php echo $d_key; ?>: url('<?php echo \esc_attr( $d_arg ); ?>');
				<?php elseif ( \mb_strstr( $d_key, 'margin' ) ): ?>
					--page_title-<?php echo $d_key; ?>: <?php echo \esc_attr( $d_arg ); ?>em;
				<?php else: ?>
					--page_title-<?php echo $d_key; ?>: <?php echo \esc_attr( $d_arg ); ?>;
				<?php endif; ?>
			<?php endforeach; ?>
			}
		</style>
		<header class="row page_title <?php echo $has_header_bg ? 'has-header-background full-width' : ''; ?>">
			<div class="row-container">
				<h1 class="<?php echo \esc_attr( \get_field( 'cmls-header_options-custom_classes' ) ); ?>">
					<?php \the_title(); ?>
				</h1>
			</div>
		</header>
	<?php endif; ?>
<?php endif; ?>

<?php
if (
	! \is_singular()
	&& \mb_strlen( \get_the_title() )
):
?>
	<header>
		<h2><?php echo \the_title(); ?></h2>
	</header>
<?php endif; ?>
<!-- /templates/pages/header -->
