jQuery( document ).ready( function( $ ) {
	$( '.wp-admin-bar-effect-tab' ).hide();
	$( $( '.nav-tab-active' ).attr( 'href' ) ).show();

	$( '.nav-tab' ).on( 'click', function( e ) {
		e.preventDefault();
		$( '.nav-tab' ).removeClass( 'nav-tab-active' );
		$( '.wp-admin-bar-effect-tab' ).hide();
		$( $( this ).attr( 'href' ) ).show();
		$( this ).addClass( 'nav-tab-active' );
	} )

	$( document.body ).on( 'click', '#submit-img', function( e ) {
		e.preventDefault();
		if ( typeof wabe_media_frame != 'undefined' ) {
			wabe_media_frame.open();
			return;
		}

		wabe_media_frame = wp.media.frames.wabe_media_frame = wp.media( {
			className: 'media-frame wabe-media-frame',
			frame: 'select',
			multiple: false,
			title: wabe_settings.media_title,
			library: {
				type: 'image'
			},
			button: {
				text: wabe_settings.media_button
			}
		} );
		wabe_media_frame.on( 'select', function() {
			var media_attachment = wabe_media_frame.state().get( 'selection' ).first().toJSON();
			$( '#wp-admin-bar-effect_menu_icon' ).val( media_attachment.url );
		} );

		wabe_media_frame.open();
	});
});