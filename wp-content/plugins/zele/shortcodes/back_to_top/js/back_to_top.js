(function( $ ) {
	"use strict";
	
	$(document).ready(function($){
		var bt_back_to_top_button_offset = 500;
		var bt_back_to_top_button_speed = 300;
		var bt_back_to_top_button_duration = 500;

		$(window).scroll(function(){
			if ( $( '.bt_back_to_top_button' ).length ) {
				if ($(this).scrollTop() < bt_back_to_top_button_offset) {
					$('body').removeClass('btBackToTop');
				} else {
					$('body').addClass('btBackToTop');
				}
			}

			if ( $( '.bt_back_to_top_button_no_icon' ).length ) {
				if ( $(this).scrollTop() < bt_back_to_top_button_offset) {
					$('body').removeClass('btBackToTop');
				} else {
					$('body').addClass('btBackToTop');
				}
			}
		 });

		 if ( $( '.bt_back_to_top_button' ).length ) {
			$('.bt_back_to_top_button').on('click', function() {
				$('html, body').animate({scrollTop:0}, bt_back_to_top_button_speed);
					return false;
			});
		 }

		 if ( $( '.bt_back_to_top_button_no_icon' ).length ) {
			$('.bt_back_to_top_button_no_icon').on('click', function(){
				$('html, body').animate({scrollTop:0}, bt_back_to_top_button_speed);
				return false;
			});
		}
	});
	
})( jQuery );
