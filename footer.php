<?php
/**
 * CMLS Base Theme
 * Footer.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$footer_logo_id = gav( themeMods::getFiles( true ), 'file-footer-logo', array( 'id' => null ) )['id'];
$footer_logo    = $footer_logo_id
	? \wp_get_attachment_image(
		$footer_logo_id,
		'thumbnail-uncropped',
		false,
		array(
			'alt' => \get_bloginfo( 'name' ),
		)
	)
	: null;
?>

<!-- footer -->
<footer class="row" role="contentinfo">

	<div class="row-container">

		<?php if ( $footer_logo ) : ?>
		<div class="logo">
			<a aria-label="Home" href="<?php echo \home_url(); ?>">
				<?php echo $footer_logo; ?>
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