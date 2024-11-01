<?php
/*
Plugin Name: Text Spinner
Plugin URI: https://wpgurus.net/text-spinner
Description: Allows you to use spintax in your posts, pages and theme files.
Version: 1.3.0
Author: WPGurus
Author URI: https://wpgurus.net/
License: GPL2
*/

/**
 * The main function of the plugin that can be used directly in PHP files.
 *
 * @param string $text The text containing spintax in it.
 * @param array $options An array of options
 *
 * @return string Spun text
 */
function wpts_spin( $text, $options = array() ) {
	$options = wp_parse_args( $options, array(
		'cache' => 0,
	) );
	$spinner = new WPTS_Text_Spinner( $options['cache'] );

	return $spinner->spin( $text );
}

/**
 * Shortcode callback function.
 *
 * @param array $atts An array of attributes passed to the shortcode
 * @param string $content The content embedded within the shortcode
 *
 * @return string Spun text
 */
function wpts_render_shortcode( $atts, $content = '' ) {
	return wpts_spin( $content, $atts );
}

add_shortcode( 'wpts_spin', 'wpts_render_shortcode' );

/**
 * Class WPTS_Text_Spinner
 */
class WPTS_Text_Spinner {
	const TRANSIENT_KEY_FORMAT = 'wpts_cached_%s';
	private $cache_expiry = 0;

	public function __construct( $cache_expiry = 0 ) {
		$this->cache_expiry = (int) $cache_expiry;
	}

	public function spin( $text ) {
		// Cleanup text
		$text = trim( strval( $text ) );

		$cache_expiry = $this->cache_expiry;
		$transient_key = $this->transient_key( $text );

		// If caching is enabled and there is a cached version, use it
		if ( $cache_expiry ) {
			$cached = get_transient( $transient_key );
			if ( ! empty( $cached ) ) {
				return $cached;
			}
		}

		// No cached version available, do spin
		$spun = $this->do_spin( $text );

		// If caching is enabled, save processed text for later
		if ( $cache_expiry ) {
			set_transient( $transient_key, $spun, $cache_expiry );
		}

		return $spun;
	}

	private function do_spin( $text ) {
		return preg_replace_callback(
			'/\{(((?>[^\{\}]+)|(?R))*)\}/x',
			array( $this, 'replace' ),
			$text
		);
	}

	private function replace( $text ) {
		$text = $this->do_spin( $text[1] );
		$parts = explode( '|', $text );
		return $parts[ array_rand( $parts ) ];
	}

	function transient_key( $text ) {
		$key = sprintf( 'spintax:%s|cache_expiry:%s', $text, $this->cache_expiry );

		return sprintf( self::TRANSIENT_KEY_FORMAT, md5( $key ) );
	}
}
