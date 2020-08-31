<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Pagination
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>

<aside class="pagination row">
    <?php
    \the_posts_pagination([
        'class' => 'pagination-links row-container',
        'type' => 'list',
        'prev_text' => 'Previous<span class="meta-nav screen-reader-text"> Page</span>',
        'next_text' => 'Next<span class="meta-nav screen-reader-text"> Page</span>',
        'before_page_number' => '<span class="meta-nav screen-reader-text">Page </span>',
    ]);
    ?>
</aside>