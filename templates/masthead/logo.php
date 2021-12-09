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
    <a aria-label="Home" href="<?php echo \home_url(); ?>" title="Home">
        <?php if ( gav( themeMods::getFiles(), 'file-masthead-logo', false ) ): ?>
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo' ); ?>" alt="<?php echo \bloginfo( 'name' ); ?>" class="logo-main">
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo-inside' ); ?>" alt="<?php echo \bloginfo( 'name' ); ?>" class="logo-inside">
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo-overlay' ); ?>" alt="<?php echo \bloginfo( 'name' ); ?>" class="logo-main-overlay">
            <img src="<?php echo gav( themeMods::getFiles(), 'file-masthead-logo-inside-overlay' ); ?>" alt="<?php echo \bloginfo( 'name' ); ?>" class="logo-inside-overlay">
        <?php endif; ?>
    </a>
</h1>
<!-- /templates/masthead/logo -->
