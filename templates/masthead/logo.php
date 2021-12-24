<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Logo
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>
<!-- templates/masthead/logo -->
<h1 class="logo">
    <a aria-label="Home" href="<?php echo \home_url(); ?>">
        <?php if ( gav( themeMods::getFiles(), 'file-masthead-logo', false ) ): ?>
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo' ); ?>" alt="" class="logo-main">
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo-inside' ); ?>" alt="" class="logo-inside">
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo-overlay' ); ?>" alt="" class="logo-main-overlay">
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo-inside-overlay' ); ?>" alt="" class="logo-inside-overlay">
        <?php endif; ?>
        <span><?php echo \bloginfo( 'name' ); ?></span>
    </a>
</h1>
<!-- /templates/masthead/logo -->
