<?php
/**
 * Plugin Name: WP Admin Bar Effect
 * Description: Add slide effect to admin bar for show & hide with mouse hover
 * Plugin URI: http://wordpress.org/extend/plugins/wp-admin-bar-effect/
 * Author: Sergio ( kallookoo )
 * Author URI: http://dsergio.com/
 * Version: 3.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-admin-bar-effect
 * Domain Path: /languages
 */

namespace kallookoo\wp_admin_bar_effect;

defined( 'ABSPATH' ) or exit;

final class Plugin {

	public static function on_init() {
		define( 'WP_ADMIN_BAR_EFFECT_VERSION', '3.0' );

		add_filter( 'plugin_action_links', array( __CLASS__, 'plugin_action_links' ), 10, 2 );
		add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 4 );

		load_plugin_textdomain( 'wp-admin-bar-effect', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		require_once plugin_dir_path( __FILE__ ) . 'admin/trait-singleton.php';
		require_once plugin_dir_path( __FILE__ ) . 'admin/class-settings.php';

		Settings::instance();

		$options = get_user_option( 'wp_admin_bar_effect', get_current_user_id() );

		if ( isset( $options['enabled'] ) && 'on' === $options['enabled'] && ! wp_is_mobile() ) {
			require_once plugin_dir_path( __FILE__ ) . 'admin/class-admin-bar.php';

			add_action( 'admin_bar_init', __NAMESPACE__ . '\\Admin_Bar::instance', 10 );
		}

		if ( isset( $options['menu_enabled'] ) && 'on' === $options['menu_enabled'] ) {
			require_once plugin_dir_path( __FILE__ ) . 'admin/class-admin-menu.php';

			add_action( 'admin_menu', __NAMESPACE__ . '\\Admin_Menu::instance', 10 );
		}
	}

	public static function plugin_action_links( $links, $file ) {
		if ( $file === plugin_basename( __FILE__ ) ) {
			array_unshift( $links, sprintf( '<a href="%s">%s</a>', admin_url( 'profile.php' ), __( 'Options', 'wp-admin-bar-effect' ) ) );
		}

		return $links;
	}

	public static function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
		if ( $plugin_file === plugin_basename( __FILE__ ) ) {
			$plugin_meta[] = sprintf(
				'<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TBMSLPPLGHXZW">%s</a>',
				__( 'Make a donation', 'wp-admin-bar-effect' )
			);
		}

		return $plugin_meta;
	}

	public static function on_deactivation() {
		global $wpdb;

		$user_ids = $wpdb->get_col( "SELECT DISTINCT user_id FROM $wpdb->usermeta WHERE meta_key = 'wp_admin_bar_effect'" );

		foreach ( $user_ids as $user_id ) {
			delete_user_option( $user_id, 'wp_admin_bar_effect', true );
			delete_user_option( $user_id, 'wp_admin_bar_effect_version', true );
		}
	}
}

if ( is_admin() ) {
	add_action( 'init', __NAMESPACE__ . '\\Plugin::on_init', 10 );
}
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\Plugin::on_deactivation' );
