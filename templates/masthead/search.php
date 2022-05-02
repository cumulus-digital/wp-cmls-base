<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Menu Search Form
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$searchable_post_types = \apply_filters( 'search_field_post_types-masthead', \apply_filters( 'search_field_post_types', 'all' ) );
?>

<!-- templates/masthead/search -->
<div
	<?php if ( $args['role'] ): ?>
		role="<?php echo $args['role']; ?>"
	<?php endif; ?>
	class="compact-form"
>

	<form role="search" method="get" action="<?php echo \home_url( '/' ); ?>" class="search">
		<?php if ( $searchable_post_types && $searchable_post_types !== 'all' ): ?>
			<input type="hidden" name="post_type" value="<?php echo $searchable_post_types; ?>">
		<?php endif; ?>
		<label for="search-input" class="screen-reader-text">Search</label>
		<div class="compact-form--inside_wrapper">
			<input type="search" name="s" id="search-input" value="<?php \the_search_query(); ?>" aria-label="Search" spellcheck="false">
			<button type="submit" class="has-icon" aria-label="Search">
				<svg height="24" viewBox="0 0 24 24" width="24">
					<path d="m13.5 6c-3 0-5.5 2.5-5.5 5.5 0 1.1.3 2.1.9 3l-3.4 3 1 1.1 3.4-2.9c1 .9 2.2 1.4 3.6 1.4 3 0 5.5-2.5 5.5-5.5 0-3.1-2.5-5.6-5.5-5.6zm0 9.5c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"/>
				</svg>
			</button>
		</div>
	</form>

</div>
<!-- /templates/masthead/search -->