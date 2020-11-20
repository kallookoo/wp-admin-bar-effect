<div id="wp-admin-bar-effect-admin_menu" class="wp-admin-bar-effect-tab">

	<table class="form-table">
		<!-- Admin Menu -->
		<tr>
			<th><label for="wp-admin-bar-effect_menu_enabled"><?php _e( 'Enabled', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_menu_enabled" type="checkbox" name="wp_admin_bar_effect[menu_enabled]" value="on"<?php checked( $options['menu_enabled'], 'on' ); ?>>
				<p class="description"><?php _e( 'Decide if it shows a link in the admin menu to your site.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="wp-admin-bar-effect_menu_separator"><?php _e( 'Separator', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_menu_separator" type="checkbox" name="wp_admin_bar_effect[menu_separator]" value="on"<?php checked( $options['menu_separator'], 'on' ); ?>>
				<p class="description"><?php _e( 'Decide if append one separator after menu link.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="wp-admin-bar-effect_menu_in_window"><?php _e( 'Open in new tab or window', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_menu_in_window" type="checkbox" name="wp_admin_bar_effect[menu_in_window]" value="on"<?php checked( $options['menu_in_window'], 'on' ); ?>>
				<p class="description"><?php _e( 'Insert with javascript target tag for open in new tab or window.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="wp-admin-bar-effect_menu_icon"><?php _e( 'Icon', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_menu_icon" type="text" id="wp-admin-bar-effect-icon" class="wp-admin-bar-effect-toggle regular-text" name="wp_admin_bar_effect[menu_icon]" value="<?php echo $options['menu_icon']; ?>">
				<span class="hide-if-no-js"><?php submit_button( __( 'Upload or Choose icon', 'wp-admin-bar-effect' ), 'secondary button-small', 'submit-img', false ); ?></span>
				<p class="description">
					<?php _e( 'You can upload a image, enter a external url or use Dashicons.', 'wp-admin-bar-effect' ); ?>
					<br>
					<?php _e( 'The image can not be greater than 16x16 pixels.', 'wp-admin-bar-effect' ); ?>
				</p>
			</td>
		</tr>
	</table>

</div>
