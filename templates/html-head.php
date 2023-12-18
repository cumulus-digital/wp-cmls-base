<?php
/**
 * CMLS Base Theme
 * Template
 * HTML Head.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

?><!doctype html>
<html <?php \language_attributes(); ?> class="no-js">
<head>
	<?php if ( \has_action( 'cmls_template-head-begin' ) ): ?>
		<!-- action:cmls_template-head-begin -->
		<?php \do_action( 'cmls_template-head-begin' ); ?>
		<!-- /action:cmls_template-head-begin -->
	<?php endif; ?>

	<meta charset="<?php \bloginfo( 'charset' ); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php
		if ( \is_singular() && \has_excerpt() ) {
			echo \wp_kses( \get_the_excerpt(), array() );
		} elseif ( \get_bloginfo( 'description' ) ) {
			echo \wp_kses( \get_bloginfo( 'description' ), array() );
		} else {
			echo \wp_kses( \get_bloginfo( 'name' ), array() );
		}
?>">

	<?php \wp_site_icon(); ?>

	<?php if ( gav( getCustomizerColors(), 'color-favicon-mstile' ) ): ?>
		<meta name="msapplication-TileColor" content="<?php echo gav( getCustomizerColors(), 'color-favicon-mstile' ); ?>">
	<?php endif; ?>

	<?php if ( gav( getCustomizerColors(), 'color-favicon-chrome' ) ): ?>
		<meta name="theme-color" content="<?php echo gav( getCustomizerColors(), 'color-favicon-chrome' ); ?>">
	<?php endif; ?>

	<!--
	<link rel="manifest" href="/site.webmanifest">
	-->

	<?php cmls_get_template_part( 'templates/child-html-head' ); ?>
	<?php \wp_head(); ?>

	<?php if ( \has_action( 'cmls_template-head-end' ) ): ?>
		<!-- action:cmls_template-head-end -->
		<?php \do_action( 'cmls_template-head-end' ); ?>
		<!-- /action:cmls_template-head-end -->
	<?php endif; ?>
</head>
