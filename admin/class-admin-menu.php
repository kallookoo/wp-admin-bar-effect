<?php
/**
 *
 */

namespace kallookoo\wp_admin_bar_effect;

defined( 'ABSPATH' ) or exit;

class Admin_Menu {

	use Singleton;

	private $options;

	private function __construct() {
		$this->options = get_user_option( 'wp_admin_bar_effect', get_current_user_id() );

		if ( isset( $this->options['menu_enabled'] ) && 'on' === $this->options['menu_enabled'] ) {
			global $menu;

			$menu[] = array(
				get_bloginfo( 'name', 'display' ),
				'read',
				home_url(),
				'',
				'menu-top wp-admin-bar-effect-menu',
				'wp-admin-bar-effect',
				isset( $this->options['menu_icon'] ) ? $this->options['menu_icon'] : ''
			);

			if ( isset( $this->options['menu_separator'] ) && 'on' === $this->options['menu_separator'] ) {
				$menu[] = array( '', 'read', 'wp-admin-bar-effect-separator', '', 'wp-menu-separator' );
			}

			add_filter( 'custom_menu_order', '__return_true', 10 );
			add_filter( 'menu_order', array( $this, 'menu_order' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10 );
		}
	}

	public function menu_order( $menu_order ) {
		$menu = array( home_url(), 'wp-admin-bar-effect-separator' );

		foreach ( $menu as $key => $value ) {
			if ( ! isset( $menu_order[ $key ] ) ) {
				unset( $menu[ $key ] );
			}
		}

		foreach ( $menu_order as $key => $value ) {
			if ( in_array( $value, $menu ) ) {
				unset( $menu_order[ $key ] );
			}
		}

		$menu_order = array_merge( $menu, $menu_order );

		return $menu_order;
	}

	public function admin_enqueue_scripts( $hook ) {
		if ( isset( $this->options['menu_in_window'] ) && 'on' === $this->options['menu_in_window'] ) {
			wp_enqueue_script( 'wp-admin-bar-effect-menu', plugins_url( 'js/menu.min.js', __FILE__ ), array( 'jquery' ), WP_ADMIN_BAR_EFFECT_VERSION, true );
		}

		if ( isset( $this->options['menu_icon'] ) && 0 === strpos( $this->options['menu_icon'], 'http' ) ) {
			wp_enqueue_style( 'wp-admin-bar-effect-menu', plugins_url( 'css/menu.min.css', __FILE__ ), array(), WP_ADMIN_BAR_EFFECT_VERSION );
		}
	}
}
