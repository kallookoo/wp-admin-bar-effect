<?php
/**
 * Plugin Name: WP Admin Bar Effect (wabe)
 * Description: Add effect slideDown to admin bar
 * Plugin URI: http://wordpress.org/extend/plugins/wp-admin-bar-effect/
 * Author: Sergio ( kallookoo )
 * Author URI: http://dsergio.com/
 * Version: 2.5.4
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wabelang
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or exit;

if ( is_admin() ) {
	require_once plugin_dir_path( __FILE__ ) . 'admin/class-wp-admin-bar-effect.php';

	add_action( 'plugins_loaded', 'WP_Admin_Bar_Effect::instance' );
	register_activation_hook( __FILE__, 'WP_Admin_Bar_Effect::activation' );
	register_deactivation_hook( __FILE__, 'WP_Admin_Bar_Effect::deactivation' );
}
