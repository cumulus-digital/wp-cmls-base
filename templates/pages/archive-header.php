<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header
 */

?>
<header class="row page_title">
    <div class="row-container">
        <h1>
            <?php if (\is_tag()): ?>
                <span class="prepend">Tag: </span>
                <?php echo \esc_html(\single_term_title()) ?>
            <?php elseif (\is_category() || \is_tax()): ?>
                <?php echo \esc_html(\single_term_title()) ?>
            <?php else: ?>
                <?php echo \post_type_archive_title() ?>
            <?php endif ?>
        </h1>
    </div>
</header>