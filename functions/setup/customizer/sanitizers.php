<?php
/**
 * Customizer sanitizer functions
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

// Allows only true or false
function themeCustomizer_sanitizeBoolean($value) {
	return (isset($value) && $value ? true : false);
}

function themeCustomizer_sanitizeBackgroundPosition($value) {
	switch ($value) {
		case 'top left':
		case 'top center':
		case 'top center':
		case 'center left':
		case 'center center':
		case 'center center':
		case 'right left':
		case 'right center':
		case 'right center':
			return $value;
	}
	return new \WP_Error('invalid_value', 'Received an invalid background position!');
}

function themeCustomizer_sanitizeBackgroundSize($value) {
	switch ($value) {
		case 'cover':
		case 'contain':
		case '100%':
		case 'auto':
			return $value;
	}
	return new \WP_Error('invalid_value', 'Received an unexpected background size value!');
}

function themeCustomizer_sanitizeBackgroundRepeat($value) {
	switch ($value) {
		case 'repeat':
		case 'no-repeat':
			return $value;
	}
	return new \WP_Error('invalid_value', 'Received an unexpected background repeat value!');
}

// Care of ColorAlpha
function themeCustomizer_sanitizeColorString($value) {
    $pattern = '/^(\#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/';
	\preg_match( $pattern, $value, $matches );
	// Return the 1st match found.
	if ( isset( $matches[0] ) ) {
		if ( is_string( $matches[0] ) ) {
			return \sanitize_text_field($matches[0]);
		}
		if ( is_array( $matches[0] ) && isset( $matches[0][0] ) ) {
			return \sanitize_text_field($matches[0][0]);
		}
	}
	// If no match was found, return an empty string.
	return '';
}

function themeCustomizer_transformColorAlphaArray($value) {
    if ( ! array_key_exists('css', $value)) {
        return new \WP_Error( 'invalid_value', 'Did not get a CSS string!');
    }
    $css = themeCustomizer_sanitizeColorString($value['css']);
    if ( ! $css) {
        return new \WP_Error( 'invalid_value', 'That is not a color!');
    }
	return \sanitize_text_field($css);
}

function themeCustomizer_requireFallbackFont($str) {
	$str = \sanitize_text_field($str);
	if (preg_match('/serif|monospace|cursive|fantasy|system\-ui|fangsong/i', $str)) {
		return $str;
	}
	return new \WP_Error( 'invalid_string', 'Font-family must include a generic fallback.');
}

function themeCustomizerSanitizeFile($id, $setting, $mimes, $message = 'Invalid file type') {
	if (empty($id)) {
		return $setting->default;
	}

	if (is_int($id)) {
		$filepost = \get_post($id);
		if (
			$filepost
			&& property_exists($filepost, 'guid')
		) {
			$file = $filepost->guid;
		}
	} else {
		$file = $id;
	}

	$filetype = \wp_check_filetype( $file );
	if (
		$filetype['ext']
		&& $filetype['type']
		&& in_array($filetype['type'], $mimes)
	) {
		return $id;
	}

	return new \WP_Error( 'invalid_filetype', $message);
}

function themeCustomizer_requireImage($file, $setting) {
	return themeCustomizerSanitizeFile(
		$file, $setting,
		array(
			'jpg|jpeg|jpe'   => 'image/jpeg',
			'jfif|pjpeg|pjp' => 'image/jpeg',
			'gif'            => 'image/gif',
			'png'            => 'image/png',
			'apng'           => 'image/apng',
			'svg'            => 'image/svg+xml',
			'webp'           => 'image/webp',
		),
		'Must be a valid image (JPG, GIF, PNG, SVG, or WebP).'
	);
}

function themeCustomizer_sanitizeCheckbox($input) {
	return (1 === absint($input) ? true : false);
}

function themeCustomizer_sanitizeSimpleHTML($input) {
	$allowed = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'small' => array(),
	);
	return \wp_kses($input, $allowed, array('http', 'https'));
}