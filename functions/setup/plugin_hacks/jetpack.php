<?php
/**
 * Remove Jetpack Crud.
 */

namespace CMLS_Base\Setup\PluginHacks;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

\add_filter( 'jetpack_sharing_counts', '__return_false', \PHP_INT_MAX );
\add_filter( 'jetpack_implode_frontend_css', '__return_false', \PHP_INT_MAX );

// Disable AI Assistant
\add_filter( 'jetpack_ai_enabled', '__return false', \PHP_INT_MAX );
\add_action( 'jetpack_register_gutenberg_extensions', function () {
	if ( \is_callable( '\Jetpack_Gutenberg::set_extension_unavailable' ) ) {
		\Jetpack_Gutenberg::set_extension_unavailable(
			'jetpack/ai-assistant',
			'no_ai_allowed'
		);
	}
}, \PHP_INT_MAX );

function remove_jetpack_css() {
	$jetpack_options = \get_option( 'jetpack_active_modules' );
	if ( $jetpack_options ) {
		if ( ! \in_array( 'videopress', $jetpack_options ) ) {
			\wp_deregister_style( 'jetpack-videopress-video-block-view' ); // VideoPress Video Block
		}
	}
	// \wp_deregister_style( 'AtD_style' ); // After the Deadline
	// \wp_deregister_style( 'jetpack_likes' ); // Likes
	// \wp_deregister_style( 'jetpack_related-posts' ); // Related Posts
	// \wp_deregister_style( 'jetpack-carousel' ); // Carousel
	// \wp_deregister_style( 'grunion.css' ); // Grunion contact form
	// \wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
	// \wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
	// \wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
	// \wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
	// \wp_deregister_style( 'noticons' ); // Notes
	// \wp_deregister_style( 'post-by-email' ); // Post by Email
	// \wp_deregister_style( 'publicize' ); // Publicize
	// \wp_deregister_style( 'sharedaddy' ); // Sharedaddy
	// \wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
	// \wp_deregister_style( 'stats_reports_css' ); // Stats
	// \wp_deregister_style( 'jetpack-widgets' ); // Widgets
	// \wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
	// \wp_deregister_style( 'presentations' ); // Presentation shortcode
	// \wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
	// \wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
	// \wp_deregister_style( 'widget-conditions' ); // Widget Visibility
	// \wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
	// \wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
	// \wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
	// \wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
\add_action( 'wp_print_styles', __NAMESPACE__ . '\\remove_jetpack_css' );
