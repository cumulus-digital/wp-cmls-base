<?php

/**
 * Customizer validation logic.
 *
 * These functions can be used in two ways:
 * 1. As a WP validate_callback: themeCustomizer_validateColor( $validity, $value )
 * 2. As a simple logic check: themeCustomizer_validateColor( $value )
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

/**
 * Validator for background-position.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateBackgroundPosition( $validity, $value = null ) {
	if ( ! empty( $value ) && ! CSSValidator::validateBackgroundPosition( (string) $value ) ) {
		$validity->add( 'invalid_value', 'Invalid background-position value' );
	}

	return $validity;
}

/**
 * Validator for background-attachment.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateBackgroundAttachment( $validity, $value = null ) {
	if ( ! empty( $value ) && ! CSSValidator::validateBackgroundAttachment( (string) $value ) ) {
		$validity->add( 'invalid_value', 'Invalid background-attachment value' );
	}

	return $validity;
}

/**
 * Validator for background-size.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateBackgroundSize( $validity, $value = null ) {
	if ( ! empty( $value ) && ! CSSValidator::validateBackgroundSize( (string) $value ) ) {
		$validity->add( 'invalid_value', 'Invalid background-size value' );
	}

	return $validity;
}

/**
 * Validator for background-repeat.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateBackgroundRepeat( $validity, $value = null ) {
	if ( ! empty( $value ) && ! CSSValidator::validateBackgroundRepeat( (string) $value ) ) {
		$validity->add( 'invalid_value', 'Invalid background-repeat value' );
	}

	return $validity;
}

/**
 * Validator for CSS colors.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateColorString( $validity, $value = null ) {
	if ( ! empty( $value ) && ! CSSValidator::validateColor( (string) $value ) ) {
		$validity->add( 'invalid_value', 'Invalid color value' );
	}

	return $validity;
}

/**
 * Validator for color-alpha arrays.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateColorAlphaArray( $validity, $value = null ) {
	if ( ! empty( $value ) && ! \array_key_exists( 'css', (array) $value ) ) {
		$validity->add( 'invalid_value', 'Invalid color value' );

		return $validity;
	}

	return themeCustomizer_validateColorString( $validity, $value['css'] );
}

/**
 * Validator for files.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 * @param mixed      $mimes
 * @param mixed      $message
 */
function themeCustomizer_validateFile( $validity, $value = null, $mimes = array(), $message = 'Invalid file type' ) {
	if ( empty( $value ) || ! $mimes ) {
		return $validity;
	}

	$file = $value;

	if ( \is_numeric( $file ) ) {
		$filepost = \get_post( $value );
		if ( $filepost && \property_exists( $filepost, 'guid' ) ) {
			$file = $filepost->guid;
		} else {
			$validity->add( 'invalid_value', $message );

			return $validity;
		}
	}

	return $validity;
	$filetype = \wp_check_filetype( $file );

	if (
		! $filetype['ext']
		|| ! $filetype['type']
		|| ! \in_array( $filetype['type'], $mimes )
	) {
		$validity->add( 'invalid_value', $message );
	}

	return $validity;
}

/**
 * Validator for images.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateImage( $validity, $value = null ) {
	$mimes = array(
		'jpg|jpeg|jpe'   => 'image/jpeg',
		'jfif|pjpeg|pjp' => 'image/jpeg',
		'gif'            => 'image/gif',
		'png'            => 'image/png',
		'apng'           => 'image/apng',
		'svg'            => 'image/svg+xml',
		'webp'           => 'image/webp',
	);

	return themeCustomizer_validateFile( $validity, $value, $mimes, 'Must be a valid image (JPG, GIF, PNG, SVG, or WebP).' );
}

/**
 * Validator for generic fonts.
 *
 * @param mixed      $validity
 * @param mixed|null $value
 */
function themeCustomizer_validateFallbackFont( $validity, $value = null ) {
	$str = \sanitize_text_field( (string) $value );
	if ( ! \preg_match( '/serif|monospace|cursive|fantasy|system\-ui|fangsong/i', $str ) ) {
		$validity->add( 'invalid_string', 'Font-family must include a generic fallback.' );
	}

	return $validity;
}
