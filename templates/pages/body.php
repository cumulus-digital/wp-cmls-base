<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Body
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<div class="body">
    <?php if ( \is_singular() ): ?>
        <?php \the_content(); ?>
    <?php else: ?>
        <?php \the_excerpt(); ?>
    <?php endif; ?>
</div>