<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Before-Menu Kink
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>
<?php if ( themeMods::get( 'text-masthead-before_menu' ) ): ?>
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
<?php endif; ?>