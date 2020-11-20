<div id="wp-admin-bar-effect-admin_bar" class="wp-admin-bar-effect-tab">

	<table class="form-table">
		<!-- Admin Bar -->
		<tr>
			<th><label for="wp-admin-bar-effect_enabled"><?php _e( 'Enabled', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_enabled" type="checkbox" name="wp_admin_bar_effect[enabled]" value="on"<?php checked( $options['enabled'], 'on' ); ?>>
				<p class="description"><?php _e( 'Enabled the slide effect.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="wp-admin-bar-effect_speed"><?php _e( 'Speed', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_speed" type="number" step="500" min="500" name="wp_admin_bar_effect[speed]" value="<?php echo $options['speed']; ?>" class="small-text code">
				<span class="description">ms</span>
				<p class="description"><?php _e( 'Change the speed of the effect is activated once hovering.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>
	</table>

</div>
