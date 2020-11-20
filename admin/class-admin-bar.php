<?php
/**
 *
 */

namespace kallookoo\wp_admin_bar_effect;

class Admin_Bar {

	use Singleton;

	private $options;

	private function __construct() {
		$this->options = get_user_option( 'wp_admin_bar_effect', get_current_user_id() );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10 );
	}

	public function admin_enqueue_scripts( $hook ) {
		wp_register_script( 'wp-admin-bar-effect-admin-bar', plugins_url( 'js/admin-bar.min.js', __FILE__ ), array( 'jquery', 'hoverIntent' ), WP_ADMIN_BAR_EFFECT_VERSION, true );
		wp_localize_script( 'wp-admin-bar-effect-admin-bar', 'wabe', array(
			'speed'       => $this->options['speed'],
			'sensitivity' => $this->options['sensitivity'],
			'interval'    => $this->options['interval'],
			'timeout'     => $this->options['timeout'],
		) );
		wp_enqueue_script( 'wp-admin-bar-effect-admin-bar' );

		wp_enqueue_style( 'wp-admin-bar-effect-admin-bar', plugins_url( 'css/admin-bar.min.css', __FILE__ ), array(), WP_ADMIN_BAR_EFFECT_VERSION );
	}
}
