<?php

/**
 * Customizer sanitizer functions.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

require_once __DIR__ . '/validators.php';

/**
 * Cleanup value and return it.
 *
 * @param mixed $value
 */

// Allows only true or false
function themeCustomizer_sanitizeBoolean( $value ) {
	return isset( $value ) && $value ? true : false;
}

function themeCustomizer_sanitizeFile( $id, $setting, $mimes = array() ) {
	$errors = themeCustomizer_validateFile( new \WP_Error(), $id, $setting, $mimes, $message );
	if ( $errors->has_errors() ) {
		return;
	}

	return $id;
}

function themeCustomizer_sanitizeImage( $file, $setting ) {
	return themeCustomizer_sanitizeFile(
		$file,
		$setting,
		array(
			'jpg|jpeg|jpe'   => 'image/jpeg',
			'jfif|pjpeg|pjp' => 'image/jpeg',
			'gif'            => 'image/gif',
			'png'            => 'image/png',
			'apng'           => 'image/apng',
			'svg'            => 'image/svg+xml',
			'webp'           => 'image/webp',
		),
	);
}

function themeCustomizer_sanitizeSimpleHTML( $input, $setting ) {
	return sanitizeSimpleHTML( $input );
}

function themeCustomizer_sanitizeCheckbox( $value, $setting ) {
	return 1 === \absint( $value ) ? true : ( isset( $setting->default ) ? $setting->default : false );
}

function themeCustomizer_sanitizeBackgroundPosition( $value, $setting ) {
	$errors = themeCustomizer_validateBackgroundPosition( new \WP_Error(), $value );
	if ( $errors->has_errors() ) {
		if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return;
	}

	return \sanitize_text_field( $value );
}

function themeCustomizer_sanitizeBackgroundAttachment( $value, $setting ) {
	$errors = themeCustomizer_validateBackgroundAttachment( new \WP_Error(), $value );
	if ( $errors->has_errors() ) {
		if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return;
	}

	return \sanitize_text_field( $value );
}

function themeCustomizer_sanitizeBackgroundSize( $value, $setting ) {
	$errors = themeCustomizer_validateBackgroundSize( new \WP_Error(), $value );
	if ( $errors->has_errors() ) {
		if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return;
	}

	return \sanitize_text_field( $value );
}

function themeCustomizer_sanitizeBackgroundRepeat( $value, $setting ) {
	$errors = themeCustomizer_validateBackgroundRepeat( new \WP_Error(), $value );
	if ( $errors->has_errors() ) {
		if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return;
	}

	return \sanitize_text_field( $value );
}

function themeCustomizer_sanitizeColorString( $value, $setting ) {
	$errors = themeCustomizer_validateColorString( new \WP_Error(), $value );
	if ( $errors->has_errors() ) {
		if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return;
	}

	return \sanitize_text_field( $value );
}

function themeCustomizer_sanitizeColorAlphaArray( $value, $setting ) {
	$errors = themeCustomizer_validateColorAlphaArray( new \WP_Error(), $value );
	if ( $errors->has_errors() ) {
		if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return;
	}

	return themeCustomizer_sanitizeColorString( $value['css'], $setting );
}

function themeCustomizer_requireFallbackFont( $value, $setting ) {
	$errors = themeCustomizer_validateFallbackFont( new \WP_Error(), $value );
	if ( $errors->has_errors() ) {
		if ( isset( $setting->default ) ) {
			return $setting->default;
		}

		return;
	}

	return \sanitize_text_field( $value );
}
