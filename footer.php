<?php
/**
 * CMLS Base Theme
 * Footer
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>
<footer class="row" role="contentinfo">

	<div class="row-container">

		<div class="logo">
			<a aria-label="Home" href="<?php echo \home_url() ?>" title="Home">
				<?php if (gav(themeMods::getFiles(), 'file-footer-logo')) : ?>
					<img src="<?php echo gav(themeMods::getFiles(), 'file-footer-logo') ?>" alt="<?php echo \bloginfo('name') ?>">
				<?php endif ?>
			</a>
		</div>


		<div class="menu">
			<?php footer_menu(); ?>
		</div>

		<div class="copyright">
			&copy;
			<?php echo getCopyright(); ?>
		</div>

	</div>

</footer>

<?php \wp_footer(); ?>


<!-- this site was built too quickly by github.com/vena -->
</body>
</html>