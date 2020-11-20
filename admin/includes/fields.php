<table class="form-table">
	<tr>
		<th><?php _e( 'WP Admin Bar Effect', 'wp-admin-bar-effect' ); ?></th>
		<td>
			<h2 class="nav-tab-wrapper">
				<a href="#wp-admin-bar-effect-admin_bar" class="nav-tab nav-tab-active"><?php _e( 'Admin Bar - Settings', 'wp-admin-bar-effect' ); ?></a>
				<a href="#wp-admin-bar-effect-admin_bar-advanced" class="nav-tab"><?php _e( 'Admin Bar - Advanced Settings', 'wp-admin-bar-effect' ); ?></a>
				<a href="#wp-admin-bar-effect-admin_menu" class="nav-tab"><?php _e( 'Admin Menu - Settings', 'wp-admin-bar-effect' ); ?></a>
			</h2>

			<?php require_once plugin_dir_path( __FILE__ ) . 'admin-bar-fields.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'admin-bar-advanced-fields.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'admin-menu-fields.php'; ?>
			<?php submit_button( null, 'primary', 'submit', true, array( 'id' => 'wp-admin-bar-effect-submit' ) ); ?>
		</td>
	</tr>
</table>
