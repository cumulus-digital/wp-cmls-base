<?php
/**
 * CMLS Base Theme
 * Footer
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<!-- footer -->
<footer class="row" role="contentinfo">

	<div class="row-container">

		<?php if ( gav( themeMods::getFiles(), 'file-footer-logo' ) ) : ?>
		<div class="logo">
			<a aria-label="Home" href="<?php echo \home_url(); ?>">
				<img src="<?php echo gav( themeMods::getFiles(), 'file-footer-logo' ); ?>" alt="<?php echo \bloginfo( 'name' ); ?>">
			</a>
		</div>
		<?php endif; ?>

		<?php if ( has_footer_menu() ): ?>
		<div class="menu">
			<?php footer_menu(); ?>
		</div>
		<?php endif; ?>

		<?php if ( has_social_menu() ): ?>
		<div class="social social-link-icons">
			<?php social_menu(); ?>
		</div>
		<?php endif; ?>

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