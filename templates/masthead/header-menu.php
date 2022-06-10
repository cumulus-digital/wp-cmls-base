<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Menu
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

if ( has_header_menu() ): ?>

<!-- templates/masthead/header-menu -->
<nav class="menu-container">
    <button class="hamburger hamburger--spin" type="button"
            aria-label="Display main menu" aria-controls="header_menu" aria-expanded="false">
        <span class="hamburger-box">
        <span class="hamburger-inner"></span>
        </span>
    </button>
    <div
        class="menu"
        id="header_menu"
        <?php if ( themeMods::get( 'setting-main_menu-include_search' ) ): ?>
            role="menu"
        <?php endif; ?>
    >
        <?php header_menu(); ?>
        <?php if ( themeMods::get( 'setting-main_menu-include_search' ) ): ?>
            <?php cmls_get_template_part( 'templates/masthead/search', null, [ 'role' => 'menuitem' ] ); ?>
        <?php endif; ?>
    </div>
</nav>
<!-- /templates/masthead/header-menu -->

<?php endif;
