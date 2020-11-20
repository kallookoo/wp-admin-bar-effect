<?php
/**
 *
 */

namespace kallookoo\wp_admin_bar_effect;

defined( 'ABSPATH' ) or exit;

trait Singleton {

	protected static $_instance;

	final public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	public function __clone() {}

	public function __wakeup() {}
}
