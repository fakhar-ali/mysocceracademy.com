'use strict';


(function( $ ) {
	
	function initHeadlines() {
		$( '.bt_bb_headline_content span u' ).each(function() {
			var tagWidth = $( this ).width();
			var tagHeight = $( this ).height();
			var tagClass = "";
			if ( tagWidth > 700 ) {
				tagClass = "large";
			} else if ( tagWidth > 200 ) {
				tagClass = "medium";
			} else  {
				tagClass = "small";
			}
			$( this ).removeClass( 'small medium large' ).addClass( tagClass );
		});
		$( '.bt_bb_headline_content span s' ).each(function() {
			var tagWidth = $( this ).width();
			var tagHeight = $( this ).height();
			var tagClass = "";
			if ( tagWidth > 700 ) {
				tagClass = "large";
			} else if ( tagWidth > 200 ) {
				tagClass = "medium";
			} else  {
				tagClass = "small";
			}if ( tagHeight > 100 ) {
				tagClass = "remove";
			} 
			$( this ).removeClass( 'small medium large remove' ).addClass( tagClass );
		});
	}
	
	// READY
	
	$( document ).ready(function() {
		initHeadlines();
	});
	
	// RESIZE
	
	$( window ).resize(function() {
		initHeadlines();
	});

	initHeadlines();
  
})( jQuery );

