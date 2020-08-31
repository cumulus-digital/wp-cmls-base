<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Featured Image
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>

<?php // By default, only show featured image here in cat/tag lists ?>
<?php if ( ! \is_singular() && \has_post_thumbnail()): ?>

    <figure class="featured-image">
    <?php
        \the_post_thumbnail('full', [ 'alt' => \esc_attr(\get_the_title()) ]);
    ?>
    </figure>

<?php endif ?>
