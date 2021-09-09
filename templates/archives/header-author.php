<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>
<header class="row page_title">
	<div class="row-container">
		Posts by
		<h1><?php \the_author(); ?></h1>
	</div>
</header>