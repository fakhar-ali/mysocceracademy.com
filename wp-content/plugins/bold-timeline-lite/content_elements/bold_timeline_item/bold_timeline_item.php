<?php

// [bold_timeline_item]

class Bold_Timeline_Item {
	static function init() {
		add_shortcode( 'bold_timeline_item', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'title'    						=> '',
			'subtitle' 						=> '',
			'supertitle' 					=> '',
			'icon' 							=> '',
			'audio' 						=> '',
			'video' 						=> '',
			'images' 						=> '',			
			'item_images_columns'			=> 'inherit',
			'item_title_size'				=> 'inherit',
			'item_supertitle_style'			=> 'inherit',
			'item_alignment'				=> 'inherit',
			'item_title_tag'				=> 'h2',
			'item_title_font'				=> 'inherit',
			'item_body_font'				=> 'inherit',
			'item_font_subset'				=> '',
			'item_media_position'    		=> 'inherit',
			'item_frame_thickness'			=> 'inherit',
			'item_style'    				=> 'inherit',
			'item_shape'    				=> 'inherit',
			'item_connection_type'    		=> 'inherit',
			'item_marker_type'    			=> 'inherit',
			'item_content_display'			=> 'inherit',
			'item_animation'				=> 'inherit',
			'item_frame_color'				=> '',
			'item_background_color'			=> '',
			'item_sticker_color'			=> '',			
			'item_icon_position'    		=> 'inherit',
			'item_icon_style'    			=> 'inherit',
			'item_icon_shape'    			=> 'inherit',
			'item_icon_color'				=> '',
			'item_marker_color'				=> '',
			'item_connection_color'			=> '',	
			'el_id'							=> '',
			'el_class'						=> '',
			'el_style'						=> '',
			'responsive'					=> ''
		), $atts, 'bold_timeline_item' ) );	

		$item_title_tag = 'h2';
		$item_title_font = '';
		$item_body_font = '';
		$item_media_position = '';
		$item_frame_color = '';
		$item_background_color = '';
		$item_sticker_color = '';
		$item_icon_color = '';
		$item_marker_color = '';
		$item_connection_color = '';
		
		require( dirname(__FILE__) . '/../../assets/php/timeline_styles_reset.php' );		
		require( dirname(__FILE__) . '/../../assets/php/timeline_styles.php' );		
		require( dirname(__FILE__) . '/../../content_elements/bold_timeline_container/bold_timeline_container_styles.php' );

		$item_images_columns = 'inherit';
		$item_title_size = 'inherit';
		$item_supertitle_style = 'inherit';
		$item_alignment = 'inherit';

		$item_title_font = 'inherit';
		$item_body_font = 'inherit';
		
		$item_media_position = 'inherit';
		$item_frame_thickness = 'inherit';
		$item_style = 'inherit';
		$item_shape = 'inherit';
		$item_connection_type = 'inherit';
		$item_marker_type = 'inherit';
		$item_content_display = 'inherit';
		$item_animation = 'inherit';
	
		$item_icon_position = 'inherit';
		$item_icon_style = 'inherit';
		$item_icon_shape = 'inherit';

		require( dirname(__FILE__) . '/../../assets/views/bold_timeline_item_view.php' );
		return $output;
	}
}

Bold_Timeline_Item::init();

// Map shortcode

function bold_timeline_map_item() {

	if ( function_exists('boldthemes_get_icon_fonts_bb_array') ) {
		$icon_arr = boldthemes_get_icon_fonts_bb_array();
	} else {
		require_once( dirname(__FILE__) . '/../../assets/php/fa_icons.php' );
		require_once( dirname(__FILE__) . '/../../assets/php/s7_icons.php' );
		require_once( dirname(__FILE__) . '/../../assets/php/FontAwesome5Brands.php' );
		$icon_arr = array( 'Font Awesome' => bold_timeline_fa_icons(), 'S7' => bold_timeline_s7_icons(), 'FontAwesome5Brands' => bold_timeline_FontAwesome5Brands_icons() );
	}
	
	require( dirname(__FILE__) . '/../../assets/php/fonts.php' );
	
	$bold_timeline_item_params = array(
		array( 'param_name' => 'supertitle', 'type' => 'textfield', 'heading' => esc_html__( 'Supertitle', 'bold-timeline' ) ),
		array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'bold-timeline' ), 'preview' => true ),
		array( 'param_name' => 'subtitle', 'type' => 'textfield', 'heading' => esc_html__( 'Subtitle', 'bold-timeline' ) ),
		array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'bold-timeline' ), 'value' => $icon_arr, 'preview' => true ),
		array( 'param_name' => 'images', 'type' => 'attach_images', 'heading' => esc_html__( 'Images', 'bold-timeline' ), 'group' => esc_html__( 'Media', 'bold-timeline' ) ),
		array( 'param_name' => 'el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom Id Attribute', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'responsive', 'type' => 'checkbox_group', 'heading' => esc_html__( 'Hide element on screens', 'bold-timeline' ), 'group' => esc_html__( 'Responsive', 'bold-timeline' ), 'preview' => true,
			'value' => array(
				esc_html__( '≤480px', 'bold-timeline' ) 		=> 'hidden_xs',
				esc_html__( '480-767px', 'bold-timeline' ) 		=> 'hidden_ms',
				esc_html__( '768-991px', 'bold-timeline' ) 		=> 'hidden_sm',
				esc_html__( '992-1200px', 'bold-timeline' )     => 'hidden_md',
				esc_html__( '≥1200px', 'bold-timeline' ) 		=> 'hidden_lg',
			)
		),
	);
	Bold_Timeline::$builder->map( 'bold_timeline_item', array( 'name' => esc_html__( 'Timeline Item', 'bold-timeline' ), 'description' => esc_html__( 'Timeline item', 'bold-timeline' ), 'container' => 'vertical', 'icon' => 'bt_bb_icon_bold_timeline_item', 'show_settings_on_create' => true, 'accept' => array( 'bold_timeline_item_text' => true ), 'params' => $bold_timeline_item_params ));	
	
}
add_action( 'wp_loaded', 'bold_timeline_map_item' );