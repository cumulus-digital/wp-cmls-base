<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Body
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<!-- templates/pages/body -->
<div class="body">
    <?php if ( \is_singular() ): ?>
        <?php \the_content(); ?>
    <?php else: ?>
        <!-- EXCERPT -->
        <?php \the_excerpt(); ?>
    <?php endif; ?>
</div>
<!-- /templates/pages/body -->