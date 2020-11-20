<div id="wp-admin-bar-effect-admin_bar-advanced" class="wp-admin-bar-effect-tab">

	<table class="form-table">
		<tr>
			<th><label for="wp-admin-bar-effect_sensitivity"><?php _e( 'Sensitivity', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_sensitivity" type="number" step="1" min="1" name="wp_admin_bar_effect[sensitivity]" value="<?php echo $options['sensitivity']; ?>" class="small-text code">
				<span class="description">px</span>
				<p class="description"><?php _e( 'If the mouse travels fewer than this number of pixels between polling intervals, then the "over" function will be called. With the minimum sensitivity threshold of 1, the mouse must not move between polling intervals. With higher sensitivity thresholds you are more likely to receive a false positive.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="wp-admin-bar-effect_interval"><?php _e( 'Interval', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_interval" type="number" step="1" min="1" name="wp_admin_bar_effect[interval]" value="<?php echo $options['interval']; ?>" class="small-text code">
				<span class="description">ms</span>
				<p class="description"><?php _e( 'The number of milliseconds hoverIntent waits between reading/comparing mouse coordinates. When the user\'s mouse first enters the element its coordinates are recorded. The soonest the "over" function can be called is after a single polling interval. Setting the polling interval higher will increase the delay before the first possible "over" call, but also increases the time to the next point of comparison.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="wp-admin-bar-effect_timeout"><?php _e( 'Timeout', 'wp-admin-bar-effect' ); ?></label></th>
			<td>
				<input id="wp-admin-bar-effect_timeout" type="number" step="1" min="1" name="wp_admin_bar_effect[timeout]" value="<?php echo $options['timeout']; ?>" class="small-text code">
				<span class="description">ms</span>
				<p class="description"><?php _e( 'A simple delay, in milliseconds, before the "out" function is called. If the user mouses back over the element before the timeout has expired the "out" function will not be called (nor will the "over" function be called). This is primarily to protect against sloppy/human mousing trajectories that temporarily (and unintentionally) take the user off of the target element... giving them time to return.', 'wp-admin-bar-effect' ); ?></p>
			</td>
		</tr>

	</table>

</div>
