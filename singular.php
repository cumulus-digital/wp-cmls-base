<?php
/**
 * CMLS Base Theme
 * Single post template
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

\get_header();
?>

<main role="main" class="single">

    <div class="row">
        <div class="row-container">
            <?php while (\have_posts()): \the_post() ?>

                <?php \get_template_part('templates/pages/base'); ?>

            <?php endwhile ?>
        </div>
    </div>

</main>

<?php
\get_footer();