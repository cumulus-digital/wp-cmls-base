<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Header
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>

<?php
if (
	\is_singular()
	&& strlen(\get_the_title())
):
?>
	<?php if (\get_field('cmls-header_options-hide_header', \get_the_ID(), FALSE) === FALSE): ?>
		<header class="row alignfull page_title">
			<div class="row-container">
				<h1 class="<?php echo \esc_attr(\get_field('cmls-header_options-custom_classes')) ?>">
					<?php \the_title() ?>
				</h1>
			</div>
		</header>
	<?php endif ?>
<?php endif ?>

<?php
if (
	! is_singular()
	&& strlen(\get_the_title())
):
?>
	<header>
		<h2><?php echo \the_title() ?></h2>
	</header>
<?php endif ?>
