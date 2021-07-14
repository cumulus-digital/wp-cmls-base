<?php
/**
 * CMLS Base Theme Gateway
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\get_header();
?>

<main role="main" class="<?php echo \is_singular() ? 'single' : 'archive'; ?>">

    <?php if ( ! \is_singular() ): ?>
        <?php cmls_get_template_part( 'templates/pages/archive-header' ); ?>
    <?php endif; ?>

    <?php if ( \have_posts() ): ?>

        <div class="row">
            <div class="row-container <?php echo \is_singular() ? '' : 'cards'; ?>">

                <?php while ( \have_posts() ): \the_post(); ?>

                    <?php cmls_get_template_part( 'templates/pages/base' ); ?>

                <?php endwhile; ?>

            </div>
        </div>

        <?php if ( is_paginated() ): ?>
            <?php cmls_get_template_part( 'templates/pages/pagination' ); ?>
        <?php endif; ?>

    <?php else: ?>

        <article class="row">
            <div class="row-container">
                <p>Sorry, nothing here.</p>
            </div>
        </article>

    <?php endif; ?>

</main>

<?php
\get_footer();
