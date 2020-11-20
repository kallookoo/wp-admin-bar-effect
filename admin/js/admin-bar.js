;( function( $ ) {
	$.fn.wp_admin_bar_effect = function( options ) {
		var defaults = {
			speed: 3000,
			sensitivity: 4,
			interval: 50,
			timeout: 200
		},
		options = $.extend( {}, defaults, options ),
		wpwrap = $( '#wpwrap' ),
		wpadminbar = $( '#wpadminbar', wpwrap ),
		quicklinks = $( '.quicklinks', wpadminbar ),
		wabe = {
			open: function() {
				quicklinks.css( { 'visibility': 'visible', 'opacity': 1 } );
				wpadminbar.stop().animate( { 'height': '32px' }, options.speed );
				wpwrap.stop().animate( { 'margin-top': '0', 'padding-bottom': '0' }, options.speed );
			},
			close: function(){
				quicklinks.css( { 'visibility': 'hidden', 'opacity': 0 } );
				wpadminbar.stop().animate( { 'height': '4px' }, options.speed );
				wpwrap.stop().animate( { 'margin-top': '-32px', 'padding-bottom': '32px' }, options.speed );
			},
			toggle: function(){
				return ( 'hidden' == quicklinks.css( 'visibility' ) ) ? wabe.open() : wabe.close();
			},
			on: function(){
				wpadminbar.hoverIntent( {
					sensitivity: options.sensitivity,
					interval: options.interval,
					timeout: options.timeout,
					over: wabe.toggle,
					out: wabe.toggle
				});

				if ( 'visible' == quicklinks.css( 'visibility' ) ) {
					wabe.close();
				}
			},
			off: function() {
				quicklinks.css( { 'visibility': 'visible', 'opacity': 1 } );
				wpadminbar.css( 'height','46px' ).unbind();
				wpwrap.css( { 'margin-top': '0', 'padding-bottom': '0' } );
			},
			init: function(){
				return ( 'absolute' == $('#adminmenuwrap').css('position') ) ? wabe.off() : wabe.on();
			}
		};

		return this.each(function(){
			wabe.init();
			$( window ).bind( 'resize', wabe.init );
		});
	};

} )( jQuery );

jQuery( document ).ready( function( $ ) {
	$( 'html, body' ).wp_admin_bar_effect( {
		speed: wabe.speed,
		sensitivity: wabe.sensitivity,
		interval: wabe.interval,
		timeout: wabe.timeout
	} );
} );
