<?php
/**
 * CMLS Base Theme
 * Template
 * Pages Pagination
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<!-- templates/pages/pagination -->
<aside class="pagination row">
    <?php
	\the_posts_pagination( [
		'class'              => 'pagination-links row-container',
		'type'               => 'list',
		'prev_text'          => 'Previous<span class="meta-nav screen-reader-text"> Page</span>',
		'next_text'          => 'Next<span class="meta-nav screen-reader-text"> Page</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">Page </span>',
	] );
	?>
</aside>
<!-- /templates/pages/pagination -->
