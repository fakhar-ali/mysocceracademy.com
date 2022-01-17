window.bt_bb_parse_data = function( obj ) {
	window.bt_bb_parse_data_str = '';
	if ( obj.children.length > 0 ) {
		bt_bb_parse_data_helper( obj );
		jQuery( '#post_content' ).val( window.bt_bb_parse_data_str );
	}
}

// COPY
window.bt_bb_copy = function( obj, id ) {
	if ( window.bt_bb_cb_items > 1 ) {
		for ( var i = 2; i <= window.bt_bb_cb_items; i++ ) {
			localStorage.removeItem( 'bt_bb_light_cb_' + i + window.bt_bb_light_post_type );
		}
	}		
	var obj = bt_bb_get_obj_by_id( obj, id );
	localStorage.setItem( 'bt_bb_light_cb_1' + window.bt_bb_light_post_type, JSON.stringify( obj ) );
	bt_bb_set_number_items( 1 );
}

// COPY PLUS
window.bt_bb_copy_plus = function( obj, id ) {
	var copy_obj = bt_bb_get_obj_by_id( obj, id );
	if ( window.bt_bb_cb_items == 0 ) {
		localStorage.setItem( 'bt_bb_light_cb_1' + window.bt_bb_light_post_type, JSON.stringify( copy_obj ) );
		bt_bb_set_number_items( 1 );
	} else {
		var cb_item = JSON.parse( localStorage.getItem( 'bt_bb_light_cb_1' + window.bt_bb_light_post_type ) );
		var allowed = false;
		
		if ( copy_obj.p_base !== undefined ) {
			allowed = bt_bb_allowed( cb_item.base, copy_obj.p_base );
		} else if ( window.bt_bb_map[ copy_obj.base ].root !== undefined && window.bt_bb_map[ cb_item.base ].root !== undefined ) {
			allowed = true;
		}
		
		if ( allowed ) {
			window.bt_bb_cb_items++;
			localStorage.setItem( 'bt_bb_light_cb_' + window.bt_bb_cb_items + window.bt_bb_light_post_type, JSON.stringify( copy_obj ) );
			bt_bb_set_number_items( window.bt_bb_cb_items );
		} else {
			alert( window.bt_bb_text.not_allowed );
		}
	}
}

// PASTE
window.bt_bb_paste = function( obj, id ) {
	if ( window.bt_bb_cb_items > 0 ) {
		var target_obj = bt_bb_get_obj_by_id( obj, id );
		var cb_item = JSON.parse( localStorage.getItem( 'bt_bb_light_cb_1' + window.bt_bb_light_post_type ) );
		if ( window.bt_bb_map[ target_obj.base ].root !== undefined && window.bt_bb_map[ cb_item.base ].root !== undefined ) { // root
			for ( var i = window.bt_bb_cb_items; i >= 1; i-- ) {
				cb_item = JSON.parse( localStorage.getItem( 'bt_bb_light_cb_' + i + window.bt_bb_light_post_type ) );
				cb_item = bt_bb_set_new_keys( cb_item );
				bt_bb_insert_after( obj, id, cb_item );
			}
		} else if ( bt_bb_allowed( cb_item.base, target_obj.p_base ) ) { // after
			for ( var i = window.bt_bb_cb_items; i >= 1; i-- ) {
				cb_item = JSON.parse( localStorage.getItem( 'bt_bb_light_cb_' + i + window.bt_bb_light_post_type ) );
				cb_item = bt_bb_set_new_keys( cb_item );
				bt_bb_insert_after( obj, id, cb_item );
			}
		} else if ( bt_bb_allowed( cb_item.base, target_obj.base ) ) { // inside
			for ( var i = 1; i <= window.bt_bb_cb_items; i++ ) {
				cb_item = JSON.parse( localStorage.getItem( 'bt_bb_light_cb_' + i + window.bt_bb_light_post_type ) );
				cb_item = bt_bb_set_new_keys( cb_item );
				bt_bb_insert_inside( obj, id, cb_item );
			}
		} else {
			alert( window.bt_bb_text.not_allowed );
		}
	}
}

// PASTE MAIN TOOLBAR
window.bt_bb_paste_main_toolbar = function() {
	var cb_item = JSON.parse( localStorage.getItem( 'bt_bb_light_cb_1' + window.bt_bb_light_post_type ) );
	if ( window.bt_bb_map[ cb_item.base ].root !== undefined ) { // root
		for ( var i = 1; i <= window.bt_bb_cb_items; i++ ) {
			cb_item = JSON.parse( localStorage.getItem( 'bt_bb_light_cb_' + i + window.bt_bb_light_post_type ) );
			cb_item = bt_bb_set_new_keys( cb_item );
			window.bt_bb_state_current.children.push( cb_item );
		}
		bt_bb_event( 'refresh' );
	} else {
		alert( window.bt_bb_text.not_allowed );
	}
}

// CB ITEMS
window.bt_bb_set_number_items = function( n ) {
	localStorage.setItem( 'bt_bb_light_cb_items' + window.bt_bb_light_post_type, n );
	jQuery( '.bt_bb_cb_items' ).html( n );
	window.bt_bb_cb_items = n;
}

jQuery( document ).ready(function() {
	var $ = jQuery;
	$( '#save' ).on( 'click', function( e ) {
		window.bt_bb_action = 'update_wp_editor';
		bt_bb_dispatch( '.bt_bb_item_list', 'bt_bb_event' );
		$( '#publishing-action .spinner' ).css( 'visibility', 'visible' )
	});
	$( 'i.bt_bb_save' ).on( 'click', function( e ) {
		$( '#save' ).click();
	});
	$( '.bt_bb_item_list' ).on( 'bt_bb_event',function(){
		$( '#save' ).prop( 'disabled', false );
		$( 'i.bt_bb_save' ).removeClass( 'bt_bb_disabled' );
	});
	window.bt_bb_cb_items = localStorage.getItem( 'bt_bb_light_cb_items' + window.bt_bb_light_post_type );
	if ( window.bt_bb_cb_items === null ) window.bt_bb_cb_items = 0;
	
	$( '#bt_bb_dialog .bt_bb_button_export' ).off( 'click' );
	$( '#bt_bb_dialog .bt_bb_button_import' ).off( 'click' );
	
	$( '#bt_bb_dialog' ).on( 'click', '.bt_bb_button_export', function( e ) {
		if ( window.bt_bb_cb_items > 0 ) {
			var export_json = '[';
			for ( var i = 1; i <= window.bt_bb_cb_items; i++ ) {
				export_json += '{"bt_bb_cb":"' + b64EncodeUnicode( encodeURIComponent( localStorage.getItem( 'bt_bb_light_cb_' + i + window.bt_bb_light_post_type ) ) ) + '"},';
			}
			export_json = export_json.substring( 0, export_json.length - 1 );
			export_json += ']';
			$( '.bt_bb_impex_input' ).val( b64EncodeUnicode( encodeURIComponent( export_json ) ) );
			$( '.bt_bb_impex_input' ).select();
		}
	});			

	$( '#bt_bb_dialog' ).on( 'click', '.bt_bb_button_import', function( e ) {
		if ( $( '.bt_bb_impex_input' ).val() ) {
			bt_bb_cb_import( $( '.bt_bb_impex_input' ).val() );
		}
	});
	
	// IMPORT
	window.bt_bb_cb_import = function( cb ) {
		var import_json = decodeURIComponent( b64DecodeUnicode( cb ) );
		var import_json_obj = JSON.parse( import_json );
		for ( var i = 1; i <= import_json_obj.length; i++ ) {
			localStorage.setItem( 'bt_bb_light_cb_' + i + window.bt_bb_light_post_type, decodeURIComponent( b64DecodeUnicode( import_json_obj[ i - 1 ].bt_bb_cb ) ) );
			bt_bb_set_number_items( import_json_obj.length );
		}
	}	
});