<?php
/**
 * CMLS Base Theme
 * Single post template
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\get_header();
?>

<main role="main" class="single">

    <div class="row">
        <div class="row-container">

            <?php \do_action( 'cmls_template-singular-before_post' ); ?>

            <?php while ( \have_posts() ): \the_post(); ?>

                <?php cmls_get_template_part( 'templates/pages/base' ); ?>

            <?php endwhile; ?>

            <?php \do_action( 'cmls_template-singular-after_post' ); ?>

        </div>
    </div>

</main>

<?php
\get_footer();
