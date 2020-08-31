<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Menu
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>
<nav class="menu-container">
    <button class="hamburger hamburger--spin" type="button"
            aria-label="Open menu" aria-controls="header_menu" aria-expanded="false">
        <span class="hamburger-box">
        <span class="hamburger-inner"></span>
        </span>
    </button>
    <div class="menu" id="header_menu">
        <?php header_menu() ?>
    </div>
</nav>
