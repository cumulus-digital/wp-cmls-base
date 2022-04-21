<?php
/**
 * CMLS Base Theme
 * Template
 * HTML Head
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

?><!doctype html>
<html <?php \language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php \bloginfo( 'charset' ); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php
		if ( \is_singular() && \has_excerpt() ) {
			echo \wp_kses( \get_the_excerpt(), [] );
		} elseif ( \get_bloginfo( 'description' ) ) {
			echo \wp_kses( \get_bloginfo( 'description' ), [] );
		} else {
			echo \wp_kses( \get_bloginfo( 'name' ), [] );
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
</head>
