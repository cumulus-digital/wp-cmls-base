<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Base
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>


<?php if ( ! is_singular()): ?>
        <a href="<?php \the_permalink() ?>" title="<?php echo \esc_attr(\get_the_title()) ?>">
<?php endif ?>

    <article
        id="post-<?php \the_ID(); ?>"
        <?php \post_class( \is_singular() ? 'single' : 'archive' ); ?>
    >

        <?php \get_template_part('templates/pages/featured_image'); ?>

        <?php \get_template_part('templates/pages/header'); ?>

        <?php \get_template_part('templates/pages/body'); ?>

    </article>

<?php if ( ! is_singular()): ?>
    </a>
<?php endif ?>
