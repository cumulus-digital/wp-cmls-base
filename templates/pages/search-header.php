<?php
/**
 * CMLS Base Theme
 * Template
 * In-coontent Search Form
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$action  = \home_url( '/' );
$subhead = false;
$context = 'Search Results';

if ( \is_category() ) {
	$cat = \get_queried_object();

	if ( $cat ) {
		$action  = \get_category_link( $cat );
		$context = $cat->name;
		$subhead = 'Searching Category';
	}
}
?>

<!-- templates/pages/search -->
	<header class="row page_title">
		<div class="row-container">
			<h1>
				<?php if ( $subhead ): ?>
					<span class="prepend">
						<?php echo \apply_filters( 'page_search_subhead', \esc_html( $subhead ) ); ?>
					</span>
				<?php endif; ?>
				<?php echo \apply_filters( 'page_search_heading', \esc_html( $context ) ); ?>
			</h1>
			<div class="search-form">

				<form role="search" method="get" action="<?php echo \esc_attr( $action ); ?>" class="search">
					<input type="hidden" name="t" value="<?php echo \apply_filters( 'search_field_post_types-search_page', \apply_filters( 'search_field_post_types', 'all' ) ); ?>">
					<label for="search" class="screen-reader-text">Search</label>
					<div class="search-inside_wrapper">
						<input type="search" name="s" id="search" value="<?php \the_search_query(); ?>" aria-label="Search">
						<button type="submit" class="has-icon" aria-label="Search">
							<svg id="search-icon" class="search-icon" viewBox="0 0 24 24" width="24" height="24">
								<path d="M13.5 6C10.5 6 8 8.5 8 11.5c0 1.1.3 2.1.9 3l-3.4 3 1 1.1 3.4-2.9c1 .9 2.2 1.4 3.6 1.4 3 0 5.5-2.5 5.5-5.5C19 8.5 16.5 6 13.5 6zm0 9.5c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"></path>
							</svg>
						</button>
					</div>
				</form>

			</div>
		</div>
	</header>

<!-- /templates/pages/search -->