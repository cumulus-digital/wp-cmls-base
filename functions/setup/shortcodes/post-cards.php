<?php
/*
 * CMLS Base Theme
 * Shortcodes
 */

namespace CMLS_Base\Shortcodes;

use WP_Query;
use const CMLS_Base\PREFIX;
use CMLS_Base\CMLS_Cache;
use CMLS_Base\CSSValidator;
use function CMLS_Base\cmls_get_template_part;
use function CMLS_Base\make_post_class;
use function CMLS_Base\ns;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

function shortcode_post_cards( $attr ) {
	if ( ! \array_key_exists( 'post-type', $attr ) ) {
		$attr['post-type'] = 'post';
	}

	// make sure the requested post type exists
	if ( $attr['post-type'] !== 'post' ) {
		$post_types = \get_post_types( [ 'public' => true] );

		if ( ! \array_key_exists( $attr['post-type'], $post_types ) ) {
			return 'Post type does not exist.';
		}
	}

	// Get any taxonomies we could query
	$taxes     = [];
	$not_taxes = [];

	if ( \count( $attr ) > 1 ) {
		$taxes     = \get_object_taxonomies( $attr['post-type'] );
		$not_taxes = [];

		if ( \count( $taxes ) ) {
			foreach ( $taxes as $tax ) {
				$not_taxes["not-{$tax}"] = null;
			}
			$taxes = \array_fill_keys( $taxes, null );
		}
	}

	$attr = \shortcode_atts( \array_merge( [
		'post-type'         => 'post',
		'card-width'        => '100px',
		'card-width-mobile' => '25%',
		'card-gap'          => '.2em',
		'justify'           => 'center',
		'posts-per-page'    => 40,
	], $taxes, $not_taxes ), $attr, 'post-cards' );

	$q = [
		'post_type'      => $attr['post-type'],
		'post_status'    => 'publish',
		'orderby'        => 'post_title',
		'order'          => 'asc',
		'posts_per_page' => $attr['posts-per-page'],
		'tax_query'      => [],
	];

	foreach ( \array_keys( $taxes ) as $tax ) {
		if ( $attr[$tax] ) {
			$q['tax_query']['relation'] = 'AND';
			$terms                      = \preg_split( '/[\|\&,\s]/', $attr[$tax] );
			$q['tax_query'][]           = [
				'taxonomy'         => $tax,
				'field'            => 'slug',
				'terms'            => $terms,
				'include_children' => true,
				'operator'         => 'IN',
			];
		}
	}

	foreach ( \array_keys( $not_taxes ) as $tax ) {
		if ( $attr[$tax] ) {
			$terms            = \preg_split( '/[\|\&,\s]/', $attr[$tax] );
			$q['tax_query'][] = [
				'taxonomy'         => $tax,
				'field'            => 'slug',
				'terms'            => $terms,
				'include_children' => false,
				'operator'         => 'NOT IN',
			];
		}
	}

	$cache_group = 'CMLS_Base::shortcode_post_cards';
	$cache_key   = PREFIX . '-post_cards-' . \md5( \json_encode( $q ) );
	$posts = CMLS_Cache::get( $cache_key, $cache_group );
	
	if ($posts === false) {
		$posts = (new WP_Query( $q ))->get_posts();
		CMLS_Cache::set( $cache_key, $posts, $cache_group, 300 );
	}

	if ( \count( $posts ) ) {
		\ob_start();
		$q_id = \wp_unique_id( 'post-cards-' );

		global $post;
		$originalPost = $post; ?>

		<div id="<?php echo \esc_attr( $q_id ); ?>" class="inline-archive cards">
			<style>
				#<?php echo \esc_attr( $q_id ); ?> {
					<?php if ( CSSValidator::validateLength( $attr['card-width'] ) ): ?>
						--card-width: <?php echo $attr['card-width']; ?>;
					<?php endif; ?>
					<?php if ( CSSValidator::validateGap( $attr['card-gap'] ) ): ?>
						--card-gap: <?php echo $attr['card-gap']; ?>;
					<?php endif; ?>
					<?php if ( CSSValidator::validateFlexAlignment( $attr['justify'] ) ): ?>
						justify-content: <?php echo $attr['justify']; ?>;
					<?php endif; ?>
				}
				@media (max-width: 640px) {
					#<?php echo $q_id; ?> {
						<?php if ( CSSValidator::validateLength( $attr['card-width-mobile'] ) ): ?>
							--card-width: <?php echo $attr['card-width-mobile']; ?>;
						<?php endif; ?>
					}
				}
			</style>
			<?php foreach ( $posts as $cardPost ): ?>
				<?php
				global $post;
				\setup_postdata( $cardPost );
				$post = $cardPost; ?>
						<?php
						cmls_get_template_part(
					'templates/pages/excerpt',
					make_post_class(),
					[
						'display_format'       => 'cards',
						'show_image'           => true,
						'force_featured_image' => true,
						'thumbnail_size'       => 'thumbnail-uncropped',
						'show_title'           => false,
						'show_date'            => false,
						'show_author'          => false,
						'show_excerpt'         => false,
					]
				); 
				?>
			<?php endforeach; ?>
		</div>
		<?php

		\wp_reset_postdata();
		$post = $originalPost;

		return \ob_get_clean();
	}

	return null;
}
\add_shortcode( 'post-cards', __NAMESPACE__ . '\\shortcode_post_cards' );

$hooks = array(
	'save_post',
	'deleted_post',
	'trashed_post',
	'untrashed_post',
	'transition_post_status',
	'created_term',
	'edited_term',
	'delete_term',
);

function flush_post_cards_cache() {
	if ( \defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	CMLS_Cache::flushGroup( 'CMLS_Base::shortcode_post_cards' );
}

foreach( $hooks as $hook ) {
	\add_action( $hook, ns( 'flush_post_cards_cache', __NAMESPACE__ ), 10, 3 );
}