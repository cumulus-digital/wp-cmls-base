<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Before-Menu Kink
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>
<?php if (themeMods::get('text-masthead-before_menu')): ?>
<div class="menu-beforetext">
    <?php if (themeMods::get('text-masthead-before_menu-link')): ?>
        <a href="<?php echo themeMods::get('text-masthead-before_menu-link') ?>" rel="<?php
            if (strpos(themeMods::get('text-masthead-before_menu-link'), 'http') !== FALSE) {
                echo 'noopener';
            }
        ?>">
    <?php endif ?>

    <?php echo themeMods::get('text-masthead-before_menu') ?>

    <?php if (themeMods::get('text-masthead-before_menu-link')): ?>
        </a>
    <?php endif ?>
</div>
<?php endif ?>