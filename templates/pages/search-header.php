<?php
/**
 * CMLS Base Theme
 * Template
 * In-content Search Form
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$args = \array_merge( [
	'include_header_tag' => true,
	'title_tag'          => 'h1',
], $args );

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

if ( \is_post_type_archive() ) {
	$post_type = \get_queried_object();
	$action    = \get_post_type_archive_link( $post_type->name );
}
?>

<!-- templates/pages/search -->

	<?php if ( $args['include_header_tag'] ): ?>
	<header class="row page_title">
	<?php endif; ?>

		<div class="row-container search-header">
			<<?php echo $args['title_tag']; ?>>
				<?php if ( $subhead ): ?>
					<span class="prepend">
						<?php echo \apply_filters( 'page_search_subhead', \esc_html( $subhead ) ); ?>
					</span>
				<?php endif; ?>
				<?php echo \apply_filters( 'page_search_heading', \esc_html( $context ) ); ?>
			</<?php echo $args['title_tag']; ?>>
			<div class="search-form">

				<form role="search" method="get" action="<?php echo \esc_attr( $action ); ?>" class="search">
					<input type="hidden" name="post_type" value="<?php echo \apply_filters( 'search_field_post_types-search_page', \apply_filters( 'search_field_post_types', 'all' ) ); ?>">
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

	<?php if ( $args['include_header_tag'] ): ?>
	</header>
	<?php endif; ?>

<!-- /templates/pages/search -->