<?php

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed' );

/**
 * CSSValidator.
 *
 * A high-performance validator for CSS values. It compiles human-readable
 * grammar definitions into optimized Regular Expressions.
 *
 * Performance: Compiled regexes are cached statically per request.
 * Ergonomics: Specific public methods allow for IDE autocomplete and discovery.
 */
final class CSSValidator {
	/** @var array Stores compiled regex strings to avoid re-compiling during a single request */
	private static array $regex_cache = array();

	/** @var bool Tracks if core regex primitives (Length, Color) are built */
	private static bool $is_initialized = false;

	/** @var string Regex for CSS lengths (px, rem, etc.) and math functions (calc, min, max) */
	private static string $length_primitive;

	/** @var string Regex for all valid CSS color formats (Hex, RGB, HSL, Named) */
	private static string $color_primitive;

	/* =========================================================
	 * LAYER 2: PUBLIC API (Explicit Helpers for IDE)
	 * ========================================================= */

	public static function validateColor( string $value ): bool {
		return self::validate( 'color', $value );
	}

	public static function validateMargin( string $value ): bool {
		return self::validate( 'margin', $value );
	}

	public static function validatePadding( string $value ): bool {
		return self::validate( 'padding', $value );
	}

	public static function validateBorder( string $value ): bool {
		return self::validate( 'border', $value );
	}

	public static function validateGap( string $value ): bool {
		return self::validate( 'gap', $value );
	}

	public static function validateLength( string $value ): bool {
		return self::validate( 'width', $value );
	}

	public static function validateImage( string $value ): bool {
		return self::validate( 'background-image', $value );
	}

	public static function validateBackgroundAttachment( string $value ): bool {
		return self::validate( 'background-attachment', $value );
	}

	public static function validateBackgroundPosition( string $value ): bool {
		return self::validate( 'background-position', $value );
	}

	public static function validateBackgroundRepeat( string $value ): bool {
		return self::validate( 'background-repeat', $value );
	}

	public static function validateBackgroundSize( string $value ): bool {
		return self::validate( 'background-size', $value );
	}

	public static function validateFlexAlignment( string $value ): bool {
		return self::validate( 'justify-content', $value );
	}

	/**
	 * Primary validation engine.
	 *
	 * @param string $property the CSS property name
	 * @param string $value    the CSS value string
	 */
	public static function validate( string $property, string $value ): bool {
		self::initializePrimitives();

		// Normalize whitespace
		$value = \mb_trim( \preg_replace( '/\s+/', ' ', $value ) );

		if ( $value === '' ) {
			return false;
		}

		// 1. CSS-wide keywords (valid for all properties)
		$globals = 'initial|inherit|unset|revert|revert-layer';
		if ( \preg_match( "/^(?:{$globals})$/i", $value ) ) {
			return true;
		}

		// 2. Fetch or Compile Regex
		if ( ! isset( self::$regex_cache[$property] ) ) {
			$registry = self::getPropertyRegistry();
			$grammar  = $registry[$property] ?? self::fallbackSyntax();

			// Define a recursive subpattern for balanced parentheses (blocking injection chars)
			$definition                   = '(?(DEFINE)(?<balanced>\((?:(?>[^();{}]+)|(?&balanced))*\)))';
			self::$regex_cache[$property] = '/^' . $definition . self::compile( $grammar ) . '$/i';
		}

		return (bool) \preg_match( self::$regex_cache[$property], $value );
	}

	/* =========================================================
	 * LAYER 1: PROPERTY REGISTRY
	 * Add or modify property rules here.
	 * ========================================================= */

	/**
	 * Maps CSS property names to their grammar definitions.
	 */
	private static function getPropertyRegistry(): array {
		// Reusable sub-rules
		$lengthOrPercent   = self::lengthOrPercentage();
		$lengthPercentAuto = self::oneOf( array( $lengthOrPercent, self::keyword( 'auto' ) ) );

		return array(
			// --- Colors ---
			'color'            => self::color(),
			'background-color' => self::color(),
			'border-color'     => self::color(),

			// --- Box Model (supports 1 to 4 values) ---
			'margin'  => self::repeatRange( $lengthPercentAuto, 1, 4 ),
			'padding' => self::repeatRange( $lengthOrPercent, 1, 4 ),
			'gap'     => self::repeatRange( $lengthOrPercent, 1, 2 ),

			// --- Sizing ---
			'width'      => $lengthPercentAuto,
			'height'     => $lengthPercentAuto,
			'max-width'  => $lengthPercentAuto,
			'max-height' => $lengthPercentAuto,

			// --- Borders ---
			// Handles any order: "1px solid red" or "red solid 1px"
			'border' => self::anyOrder( array(
				self::oneOf( array( self::length(), self::keywordList( 'thin|medium|thick' ) ) ),
				self::keywordList( 'none|hidden|dotted|dashed|solid|double|groove|ridge|inset|outset' ),
				self::color(),
			) ),
			'border-radius' => self::repeatRange( $lengthOrPercent, 1, 4 ),

			// --- Backgrounds ---
			'background-image'      => self::list( self::imageFunctions() ),
			'background-attachment' => self::list( self::keywordList( 'scroll|fixed|local' ) ),
			'background-position'   => self::list( self::repeatRange(
				self::oneOf( array( $lengthOrPercent, self::keywordList( 'left|center|right|top|bottom' ) ) ),
				1,
				2
			) ),
			'background-size' => self::list( self::oneOf( array(
				self::keywordList( 'cover|contain' ),
				self::repeatRange( self::oneOf( array( $lengthOrPercent, self::keyword( 'auto' ) ) ), 1, 2 ),
			) ) ),
			'background-repeat' => self::list( self::oneOf( array(
				self::keyword( 'repeat-x' ),
				self::keyword( 'repeat-y' ),
				self::repeatRange( self::keywordList( 'repeat|no-repeat|space|round' ), 1, 2 ),
			) ) ),

			// --- Flexbox & Alignment ---
			'flex-basis' => $lengthPercentAuto,
			'justify-content' => self::oneOf( array(
				self::keywordList( 'normal|stretch|space-between|space-around|space-evenly' ),
				self::keywordList( 'center|start|end|flex-start|flex-end|left|right' ),
				self::sequence( array(
					self::keywordList( 'safe|unsafe' ),
					self::keywordList( 'center|start|end|flex-start|flex-end|left|right' ),
				) ),
			) ),
			'align-items' => self::oneOf( array(
				self::keywordList( 'normal|stretch|baseline|first baseline|last baseline' ),
				self::keywordList( 'center|start|end|self-start|self-end|flex-start|flex-end' ),
				self::sequence( array(
					self::keywordList( 'safe|unsafe' ),
					self::keywordList( 'center|start|end|self-start|self-end|flex-start|flex-end' ),
				) ),
			) ),
		);
	}

	/* =========================================================
	 * LAYER 3: GRAMMAR DSL HELPERS
	 * ========================================================= */

	private static function oneOf( array $nodes ): array {
		return array( 'type' => 'oneOf', 'nodes' => $nodes );
	}

	private static function list( array $node ): array {
		return array( 'type' => 'list', 'node' => $node );
	}

	private static function keyword( string $word ): array {
		return array( 'type' => 'keyword', 'value' => $word );
	}

	private static function length(): array {
		return array( 'type' => 'length' );
	}

	private static function color(): array {
		return array( 'type' => 'color' );
	}

	private static function lengthOrPercentage(): array {
		return self::oneOf( array( array( 'type' => 'length' ), array( 'type' => 'percentage' ) ) );
	}

	private static function repeatRange( array $node, int $min, int $max ): array {
		return array( 'type' => 'range', 'node' => $node, 'min' => $min, 'max' => $max );
	}

	private static function anyOrder( array $nodes ): array {
		return array( 'type' => 'anyOrder', 'nodes' => $nodes );
	}

	private static function sequence( array $nodes ): array {
		return array( 'type' => 'sequence', 'nodes' => $nodes );
	}

	private static function cssFunction( string $name, array $arg ): array {
		return array( 'type' => 'function', 'name' => $name, 'arg' => $arg );
	}

	private static function regex( string $pattern ): array {
		return array( 'type' => 'regex', 'value' => $pattern );
	}

	private static function keywordList( string $list ): array {
		return self::oneOf( \array_map( array( self::class, 'keyword' ), \explode( '|', $list ) ) );
	}

	private static function imageFunctions(): array {
		$safeContent = '[^;{}]+';

		return self::oneOf( array(
			self::keyword( 'none' ),
			self::cssFunction( 'url', self::regex( '(?:"[^"]*"|\'[^\']*\'|[\w\s\-\.\/\%\:\+#\?=&\(\)]+)' ) ),
			self::cssFunction( 'linear-gradient', self::regex( $safeContent ) ),
			self::cssFunction( 'radial-gradient', self::regex( $safeContent ) ),
			self::cssFunction( 'conic-gradient', self::regex( $safeContent ) ),
		) );
	}

	private static function fallbackSyntax(): array {
		// Blocks common injection characters like ; { } but allows typical CSS characters
		return self::regex( '(?![;{}])[\w\s\-\(\)\.\%#\/,]+' );
	}

	/* =========================================================
	 * LAYER 4: COMPILER
	 * ========================================================= */

	private static function compile( array $node ): string {
		return match ( $node['type'] ) {
			'list'       => '(?:' . self::compile( $node['node'] ) . ')(?:\s*,\s*(?:' . self::compile( $node['node'] ) . '))*',
			'oneOf'      => '(?:' . \implode( '|', \array_map( array( self::class, 'compile' ), $node['nodes'] ) ) . ')',
			'keyword'    => \preg_quote( $node['value'], '/' ),
			'length'     => self::$length_primitive,
			'percentage' => '-?\d*\.?\d+%',
			'color'      => self::$color_primitive,
			'range'      => '(?:' . self::compile( $node['node'] ) . ')(?:\s+' . self::compile( $node['node'] ) . '){' . ( $node['min'] - 1 ) . ',' . ( $node['max'] - 1 ) . '}',
			'function'   => \preg_quote( $node['name'], '/' ) . '\s*\(\s*' . self::compile( $node['arg'] ) . '\s*\)',
			'anyOrder'   => self::compileAnyOrder( $node['nodes'] ),
			'sequence'   => self::compileSequence( $node['nodes'] ),
			'regex'      => $node['value'],
			default      => ''
		};
	}

	private static function compileAnyOrder( array $nodes ): string {
		$patterns = \implode( '|', \array_map( array( self::class, 'compile' ), $nodes ) );

		return "(?:{$patterns})(?:\\s+(?:{$patterns})){0," . ( \count( $nodes ) - 1 ) . '}';
	}

	private static function compileSequence( array $nodes ): string {
		return \implode( '\\s+', \array_map( array( self::class, 'compile' ), $nodes ) );
	}

	/* =========================================================
	 * LAYER 5: INITIALIZATION & UTILITIES
	 * ========================================================= */

	private static function initializePrimitives(): void {
		if ( self::$is_initialized ) {
			return;
		}

		$number = '-?\d*\.?\d+';
		$units  = 'px|em|ex|ch|rem|vw|vh|vmin|vmax|cm|mm|in|pt|pc|deg|grad|rad|turn|s|ms';

		// Recursive regex for math functions and nested parentheses
		$math = '(?:calc|min|max|clamp)\s*(?&balanced)';
		self::$length_primitive = "(?:0|{$number}(?:{$units})|{$math})";

		// Color components
		$num_pct = "(?:{$number}%?|var\s*(?&balanced))";
		$pct     = "(?:{$number}%|var\s*(?&balanced))";
		$sep     = '(?:\s*,\s*|\s+)'; // Supports both comma and space separators (CSS Color 4)
		$alpha_p = "(?:\s*[\/,]\s*{$num_pct})";
		
		// Modern CSS Color 4: rgb/rgba and hsl/hsla are aliases supporting 3 or 4 args
		$rgb_body  = "{$num_pct}{$sep}{$num_pct}{$sep}{$num_pct}(?:{$alpha_p})?";
		$rgba = "(?:rgb|rgba)\s*\(\s*{$rgb_body}\s*\)";
		
		$hsl_body  = "{$num_pct}{$sep}{$pct}{$sep}{$pct}(?:{$alpha_p})?";
		$hsla = "(?:hsl|hsla)\s*\(\s*{$hsl_body}\s*\)";

		self::$color_primitive = "(?:#(?:[0-9a-f]{8}|[0-9a-f]{6}|[0-9a-f]{4}|[0-9a-f]{3})|{$rgba}|{$hsla}|[a-z]+|transparent|currentcolor)";

		self::$is_initialized = true;
	}
}
