<?php
/**
 *
 */

namespace kallookoo\wp_admin_bar_effect;

defined( 'ABSPATH' ) or exit;

class Settings {

	use Singleton;

	private $defaults = array(
		'enabled'        => 'on',
		'speed'          => '3000',
		'sensitivity'    => '4',
		'interval'       => '50',
		'timeout'        => '200',
		'menu_enabled'   => 'on',
		'menu_separator' => 'on',
		'menu_in_window' => 'on',
		'menu_icon'      => 'dashicons-wordpress',
	);

	private $options = array();

	private function __construct() {
		$user_id = get_current_user_id();

		if ( $options = get_option( 'wabe-options' ) ) {
			delete_option( 'wabe-options' );
			$this->update_deprecated_options( $options );
		} else {
			$version = get_user_option( 'wp_admin_bar_effect_version', $user_id );
			if ( ! $version ) {
				update_user_option( $user_id, 'wp_admin_bar_effect', $this->get_defaults( $user_id ), true );
				update_user_option( $user_id, 'wp_admin_bar_effect_version', WP_ADMIN_BAR_EFFECT_VERSION, true );
			} elseif ( version_compare( $version, WP_ADMIN_BAR_EFFECT_VERSION, '<' ) ) {
				$this->update_options( $user_id, get_user_option( 'wp_admin_bar_effect', $user_id ) );
			}
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10 );
		add_action( 'personal_options_update', array( $this, 'personal_options_update' ), 10 );
		add_action( 'profile_personal_options', array( $this, 'profile_personal_options' ), 10 );
	}

	public function admin_enqueue_scripts( $hook ) {
		if ( 'profile.php' !== $hook ) {
			return;
		}
		wp_enqueue_media();

		wp_register_script( 'wp-admin-bar-effect-settings', plugins_url( 'js/settings.min.js', __FILE__ ), array( 'jquery' ), WP_ADMIN_BAR_EFFECT_VERSION, true );
		wp_localize_script( 'wp-admin-bar-effect-settings', 'wabe_settings', array(
			'media_title' => __( 'Upload or Choose Your Icon File', 'wp-admin-bar-effect' ),
			'media_button' => __( 'Insert Icon', 'wp-admin-bar-effect' ),
		) );
		wp_enqueue_script( 'wp-admin-bar-effect-settings' );
	}

	public function personal_options_update( $user_id ) {
		if ( isset( $_POST['wp_admin_bar_effect'] ) ) {
			$options = $_POST['wp_admin_bar_effect'];
			foreach ( $this->defaults as $name => $value ) {
				if ( 'on' === $value && ! isset( $options[ $name ] ) ) {
					$options[ $name ] = 'off';
				}
			}
			update_user_option( $user_id, 'wp_admin_bar_effect', wp_parse_args( $options, $this->defaults ), true );
		}
	}

	public function profile_personal_options( $user ) {
		$options = get_user_option( 'wp_admin_bar_effect', $user->ID );

		require_once plugin_dir_path( __FILE__ ) . 'includes/fields.php';
	}

	private function update_options( $user_id, $options ) {
		$options = wp_parse_args( $options, $this->defaults );

		update_user_option( $user_id, 'wp_admin_bar_effect', $options, true );
		update_user_option( $user_id, 'wp_admin_bar_effect_version', WP_ADMIN_BAR_EFFECT_VERSION, true );
	}

	private function get_defaults( $user_id ) {
		if ( 1 === $user_id ) {
			return $this->defaults;
		}

		return get_user_option( 'wp_admin_bar_effect', 1 );
	}

	private function update_deprecated_options( $user_id, $options ) {
		$deprecated = array(
			'wabe_active_link' => '2', 'wabe_target_link' => '1','wabe_icon_link' => '',
			'wabe_speed'=> '3000', 'wabe_sensitivity'=> '4','wabe_interval' => '50', 'wabe_timeout' => '200'
		);

		if ( isset( $options['icolink'] ) ) { // Version < 2.4
			foreach ( $options as $option => $value ) {
				foreach ( $deprecated as $doption => $dvalue ) {
					if ( 'wabe_' == substr( $doption, 0, 5 ) ) {
						$deprecated[ $doption ] = $options[ $option ];
					} else {
						if ( ! isset( $options['actlink'] ) ) {
							$deprecated['wabe_active_link'] = '1';
						}
						$deprecated['wabe_icon_link'] = $options['icolink'];
					}
				}
			}
		} else {
			$deprecated = wp_parse_args( $deprecated, $options );
		}

		$options = $this->defaults;
		foreach ( $deprecated as $name => $value ) {
			switch ( $name ) {
				case 'wabe_active_link':
					if ( '1' == $value ) {
						$options['menu_enabled'] = 'off';
					} elseif ( '3' == $value ) {
						$options['menu_separator'] = 'off';
					}
					break;

				case 'wabe_target_link':
					$options['menu_in_window'] = ( '1' == $value ? 'on' : 'off' );
					break;

				case 'wabe_icon_link':
					$options['menu_icon'] = $value;
					break;

				case 'wabe_speed':
				case 'wabe_sensitivity':
				case 'wabe_interval':
				case 'wabe_timeout':
					$name = substr( $name, 5 );
					$options[ $name ] = $value;
					break;

				default:
					break;
			}
		}

		update_user_option( $user_id, 'wp_admin_bar_effect', $options, true );
		update_user_option( $user_id, 'wp_admin_bar_effect_version', WP_ADMIN_BAR_EFFECT_VERSION, true );
	}
}
