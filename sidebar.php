<?php
/**
 * CMLS Base Theme
 * Global sidebar
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<!-- sidebar -->
<aside class="global-sidebar <?php echo has_widget_block_editor() ? 'uses-blocks' : 'uses-widgets'; ?> ">
	<?php \dynamic_sidebar( 'global' ); ?>
</aside>
<!-- /sidebar -->