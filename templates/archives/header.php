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

if ( \is_home() ) {
	$blog_page_q = new \WP_Query( [
		//'post_type' => 'page',
		'p'           => \get_option( 'page_for_posts' ),
		'post_type'   => 'page',
		'post_status' => ['publish', 'private'],
	] );

	if ( $blog_page_q->have_posts ) {
		$page_as_header = $blog_page_q->the_post();
	}
} else {
	$page_as_header = \get_field( 'field_613693bd3df48', $this_term );
}
?>

<!-- templates/archives/header -->
<?php if ( $page_as_header ): ?>

	<?php cmls_get_template_part( 'tempaltes/archives/header-post', make_post_class(), \array_merge( $args, ['post' => $page_as_header] ) ); ?>

<?php else: ?>

	<?php cmls_get_template_part( 'templates/archives/header-normal', make_post_class(), $args ); ?>

<?php endif; ?>

<?php if ( \array_key_exists( 'term_children', $args ) && $args['term_children'] ): ?>

	<?php cmls_get_template_part( 'templates/archives/header-term_children', make_post_class(), $args ); ?>

<?php endif; ?>
<!-- /templates/archives/header -->