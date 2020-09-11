<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Menu Search Form
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');
?>
<div class="search">
	<form action="/" method="get">
		<input type="hidden" name="t" value="all">
		<input type="text" name="s" id="search" value="<?php \the_search_query() ?>">
		<input type="submit" value="Search">
	</form>
</div>