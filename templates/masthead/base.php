<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

global $customizer_files;
$customizer_files = getCustomizerFiles();
?>
<!-- templates/masthead/base -->
<header class="row masthead">

	<div class="row-container">
		<?php cmls_get_template_part( 'templates/masthead/logo' ); ?>

		<?php cmls_get_template_part( 'templates/masthead/menu-beforetext' ); ?>

        <?php cmls_get_template_part( 'templates/masthead/header-menu' ); ?>
	</div>

</header>
<!-- /templates/masthead/base -->
