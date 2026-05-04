<?php
/**
 * Wrapper for WP object cache
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

class CMLS_Cache {

	private static $instance = null;

	// Default cache object expiratioon
	private $expires = 1800;

	// Group used to store version numbers for other groups
	private const VERSION_GROUP = 'cmls_cache_versions';

	public function __construct() {
	}

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new CMLS_Cache();
		}

		return self::$instance;
	}

	/**
	 * Resolves a key to a versioned key if the current cache backend
	 * does not support native group flushing.
	 *
	 * @param string $key
	 * @param string $group
	 * @return string
	 */
	private static function getVersionedKey( $key, $group ) {
		// If the backend supports native group flushing, we don't need to version the keys
		if ( \function_exists( '\wp_cache_supports' ) && \wp_cache_supports( 'flush_group' ) ) {
			return $key;
		}

		$version = \wp_cache_get( $group, self::VERSION_GROUP );

		if ( $version === false ) {
			$version = \time();
			\wp_cache_set( $group, $version, self::VERSION_GROUP );
		}

		return $key . ':' . $version;
	}

	public static function get( $key, $group ) {
		return \wp_cache_get( self::getVersionedKey( $key, $group ), $group );
	}

	/**
	 * @param string $key
	 * @param mixed  $value
	 * @param string $group
	 * @param mixed  $expires False or a time in seconds
	 */
	public static function set( $key, $value, $group, $expires = false ) {
		$cache = self::getInstance();

		if ( $expires === false ) {
			$expires = $cache->expires;
		}

		return \wp_cache_set( self::getVersionedKey( $key, $group ), $value, $group, $expires );
	}

	public static function delete( $key, $group ) {
		return \wp_cache_delete( self::getVersionedKey( $key, $group ), $group );
	}

	/**
	 * Flushes a cache group. Uses native WP group flushing if supported,
	 * otherwise increments the group version to invalidate all keys.
	 *
	 * @param string $group
	 */
	public static function flushGroup( $group ) {
		if ( \function_exists( '\wp_cache_flush_group' ) && \function_exists( '\wp_cache_supports' ) && \wp_cache_supports( 'flush_group' ) ) {
			return \wp_cache_flush_group( $group );
		}

		// Fallback: Increment version to effectively flush the group
		return \wp_cache_set( $group, \time(), self::VERSION_GROUP );
	}
}
