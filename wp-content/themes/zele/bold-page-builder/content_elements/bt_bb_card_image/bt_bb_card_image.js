(function( $ ) {
	"use strict";

	/*$('.bt_bb_card_image.bt_bb_content_display_show-on-hover').hover(function() {
		$(this).find('.bt_bb_card_image_content_inner').animate({
			height: "toggle",
			opacity: "toggle"
		}, 300);
	});*/

	//$(".bt_bb_card_image_content_inner").height();


	$('.bt_bb_card_image.bt_bb_content_display_show-on-hover').on("mouseover", function() {
		// $( this ).find( '.bt_bb_card_image_content_inner' ).animate( { height: $( '.bt_bb_card_image_content_inner' ).get(0).scrollHeight }, 10 );
		$( this ).find( '.bt_bb_card_image_content_inner' ).height( $( this ).find( '.bt_bb_card_image_content_inner' ).get(0).scrollHeight );
	});

	$('.bt_bb_card_image.bt_bb_content_display_show-on-hover').on('mouseout', function() {
		$( this ).find( '.bt_bb_card_image_content_inner' ).height( 0 );
	});


})( jQuery );