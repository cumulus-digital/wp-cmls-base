<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Before-Menu Kink
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>
<?php if ( has_extra_header_menu() ): ?>

	<!-- templates/masthead/menu-beforetext HAS REAL MENU -->
	<div class="menu-beforetext real-menu">
		<?php extra_header_menu(); ?>
	</div>
	<!-- /templates/masthead/menu-beforetext -->

<?php elseif ( themeMods::get( 'text-masthead-before_menu-enabled' ) && themeMods::get( 'text-masthead-before_menu' ) ): ?>

	<!-- templates/masthead/menu-beforetext -->
	<div class="menu-beforetext">
		<?php if ( themeMods::get( 'text-masthead-before_menu-link' ) ): ?>
			<a
				href="<?php echo themeMods::get( 'text-masthead-before_menu-link' ); ?>"
				<?php echo (bool) themeMods::get( 'text-masthead-before_menu-link_newtab' ) ? 'target="_blank"' : ''; ?>
				rel="<?php echo themeMods::get( 'text-masthead-before_menu-link_rel' ); ?>"
			>
		<?php endif; ?>

		<?php echo themeMods::get( 'text-masthead-before_menu' ); ?>

		<?php if ( themeMods::get( 'text-masthead-before_menu-link' ) ): ?>
			</a>
		<?php endif; ?>
	</div>
	<!-- /templates/masthead/menu-beforetext -->

<?php endif; ?>