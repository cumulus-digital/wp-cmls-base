<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$this_term         = \get_queried_object();
$args['this_term'] = $this_term;

// Handler pre-archive page content
$page_as_header = null;
$header_page_id = null;

if ( \is_home() ) {
	$header_page_id = \get_option( 'page_for_posts' );
} else {
	$header_page_id = \get_field( 'field_613693bd3df48', $this_term );
}

if ( $header_page_id && \is_int( $header_page_id ) ) {
	$header_page = new \WP_Query( [
		'p'         => $header_page_id,
		'post_type' => 'page',
	] );

	if ( $header_page->have_posts() ) {
		$page_as_header = $header_page->post;
	}
}
?>

<!-- templates/archives/header -->
<?php if ( $page_as_header ): ?>

	<?php cmls_get_template_part( 'templates/archives/header-post', make_post_class(), \array_merge( $args, ['post' => $page_as_header] ) ); ?>

<?php else: ?>

	<?php cmls_get_template_part( 'templates/archives/header-normal', make_post_class(), $args ); ?>

<?php endif; ?>

<?php if ( \array_key_exists( 'term_children', $args ) && $args['term_children'] ): ?>

	<?php cmls_get_template_part( 'templates/archives/header-term_children', make_post_class(), $args ); ?>

<?php endif; ?>
<!-- /templates/archives/header -->