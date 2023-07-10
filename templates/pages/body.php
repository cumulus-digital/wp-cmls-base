<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Body.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<!-- templates/pages/body -->
<div class="body">
    <?php if ( \has_action( 'cmls_template-post-before_body' ) ): ?>
        <!-- action:cmls_template-post-before_body -->
        <?php \do_action( 'cmls_template-post-before_body' ); ?>
        <!-- /action:cmls_template-post-before_body -->
    <?php endif; ?>

    <?php if ( \is_singular() ): ?>
        <?php \the_content(); ?>
    <?php else: ?>
        <!-- EXCERPT -->
        <?php \the_excerpt(); ?>
    <?php endif; ?>

    <?php if ( \has_action( 'cmls_template-post-after_body' ) ): ?>
        <!-- action:cmls_template-post-after_body -->
        <?php \do_action( 'cmls_template-post-after_body' ); ?>
        <!-- /action:cmls_template-post-after_body -->
    <?php endif; ?>
</div>
<!-- /templates/pages/body -->