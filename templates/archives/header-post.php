<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header / Post content as header
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

global $post, $wp_query;

$old_post     = $post;
$old_singular = $wp_query->is_singular;

\setup_postdata( $args['post'] );
$post                  = $args['post'];
$wp_query->is_singular = true;
generateBodyClasses( $args['post']->ID );
?>

<!-- templates/archive/header-post -->
<div class="
	row
	<?php if ( ! \in_array( 'disable_bottom_padding', BodyClasses::get() ) ): ?>
		archive-content-follows
	<?php endif; ?>
">
	<div class="row-container">
		<?php cmls_get_template_part( 'templates/pages/base' ); ?>
	</div>
</div>
<!-- /templates/archive/header-post -->

<?php
	$post                  = $old_post;
	$wp_query->is_singular = $old_singular;
	\wp_reset_postdata();
?>