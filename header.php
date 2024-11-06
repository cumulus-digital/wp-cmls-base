<?php
/**
 * CMLS Base Theme
 * Header.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

// Pre-compile body classes
if ( \is_singular() ) {
	generateBodyClasses();
}

cmls_get_template_part( 'templates/html-head' );

// Gather additional body classes
$css_classes = array();
$qo          = \get_queried_object();

if ( \is_object( $qo ) ) {
	if ( \property_exists( $qo, 'post_name' ) ) {
		$css_classes[] = 'slug-' . \sanitize_html_class( $qo->post_name );
	}
	// Excerpted from get_post_class, adds taxonomy classes to body class list
	if ( \is_singular() ) {
		$taxonomies = \get_taxonomies( array( 'public' => true ) );
		$taxonomies = \apply_filters( 'post_class_taxonomies', $taxonomies, $qo->ID, $css_classes, '' );
		foreach ( (array) $taxonomies as $taxonomy ) {
			if ( \is_object_in_taxonomy( $qo->post_type, $taxonomy ) ) {
				foreach ( (array) \get_the_terms( $qo->ID, $taxonomy ) as $term ) {
					if ( empty( $term->slug ) ) {
						continue;
					}

					$term_class = \sanitize_html_class( $term->slug, $term->term_id );
					if ( \is_numeric( $term_class ) || ! \trim( $term_class, '-' ) ) {
						$term_class = $term->term_id;
					}

					// 'post_tag' uses the 'tag' prefix for backward compatibility.
					if ( 'post_tag' === $taxonomy ) {
						$css_classes[] = 'tag-' . $term_class;
					} else {
						$css_classes[] = \sanitize_html_class( $taxonomy . '-' . $term_class, $taxonomy . '-' . $term->term_id );
					}
				}
			}
		}
	}
	$css_classes = \array_map( 'esc_attr', $css_classes );
}

?>
<body <?php \body_class( $css_classes ); ?>>

<?php
	if ( \function_exists( 'wp_body_open' ) ) {
		\wp_body_open();
	} else {
		\do_action( 'wp_body_open' );
	}
?>

<?php
	if ( \function_exists( 'gtm4wp_the_gtm_tag' ) ) {
		\gtm4wp_the_gtm_tag();
	}
?>

	<?php cmls_get_template_part( 'templates/masthead/base' ); ?>