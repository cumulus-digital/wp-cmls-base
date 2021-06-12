<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

global $customizer_files;
$customizer_files = getCustomizerFiles();
?>
<header class="row masthead">

	<div class="row-container">
		<?php cmls_get_template_part('templates/masthead/logo') ?>

		<span class="spacer"></span>

		<?php cmls_get_template_part('templates/masthead/menu-beforetext') ?>

        <?php cmls_get_template_part('templates/masthead/header-menu') ?>
	</div>

</header>