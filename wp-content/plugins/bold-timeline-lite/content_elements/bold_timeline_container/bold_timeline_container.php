<?php

// [bold_timeline_container]

class Bold_Timeline_Container {
	static function init() {
		add_shortcode( 'bold_timeline_container', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'timeline_style'				=> 'classic',
			'line_color'					=> '',
			'item_connection_color'			=> '',
			'item_marker_color'				=> '',
			'item_sticker_color'			=> '',
			'item_title_font'				=> 'inherit',
			'item_body_font'				=> 'inherit',
			'item_frame_color'				=> '',
			'item_background_color'			=> '',
			'item_icon_color'				=> '',
			'group_frame_color'				=> '',
			'group_title_font'				=> 'inherit',			
			'el_id'							=> '',
			'el_class'						=> '',
			'el_css'						=> '',
			'el_style'						=> '',
            'responsive'					=> ''
		), $atts, 'bold_timeline_container' ) );

		global $bold_timeline_container_style;
		$bold_timeline_container_style = $timeline_style;
		
		require( dirname(__FILE__) . '/../../assets/php/timeline_styles_reset.php' );		
		require( dirname(__FILE__) . '/../../assets/php/timeline_styles.php' );		
		require( dirname(__FILE__) . '/../../content_elements/bold_timeline_container/bold_timeline_container_styles.php' );
		
		require( dirname(__FILE__) . '/../../assets/views/bold_timeline_container_view.php' );
		return $output;
	}
}

Bold_Timeline_Container::init();

// Map shortcode

function bold_timeline_map_container() {
	
	require( dirname(__FILE__) . '/../../assets/php/fonts.php' );
	
	
	$bold_timeline_container_params = array(
		array( 'param_name' => 'timeline_style', 'type' => 'dropdown', 'default' => 'classic', 'heading' => esc_html__( 'Timeline Style', 'bold-timeline' ), 'preview' => true,
			'value' => array(
				esc_html__( 'Classic Style', 'bold-timeline' ) 					=> 'classic',
				esc_html__( 'Retro Style', 'bold-timeline' ) 					=> 'retro',
				esc_html__( 'Clean Style', 'bold-timeline' ) 					=> 'clean',
				esc_html__( 'Travel Style', 'bold-timeline' ) 					=> 'travel',
				esc_html__( 'CV Style', 'bold-timeline' ) 						=> 'cv'
			)
		),
		array( 'param_name' => 'line_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Line color', 'bold-timeline' ), 'preview' => true ),
		array( 'param_name' => 'item_frame_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Frame color', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ), 'preview' => true ),
		array( 'param_name' => 'item_background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ) ),
		array( 'param_name' => 'item_connection_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Connector color', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ) ),
		array( 'param_name' => 'item_marker_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Marker color', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ) ),
		array( 'param_name' => 'item_icon_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Icon color', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ) ),
		array( 'param_name' => 'item_sticker_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Sticker color', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ) ),
		array( 'param_name' => 'item_title_font', 'type' => 'dropdown', 'heading' => esc_html__( 'Title font', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ),
			'value' => array( esc_html__( 'Inherit', 'bold-timeline' ) => 'inherit' ) + $font_arr
		),
		array( 'param_name' => 'item_body_font', 'type' => 'dropdown', 'heading' => esc_html__( 'Body font', 'bold-timeline' ), 'group' => esc_html__( 'Items', 'bold-timeline' ),
			'value' => array( esc_html__( 'Inherit', 'bold-timeline' ) => 'inherit' ) + $font_arr
		),
		array( 'param_name' => 'group_frame_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Group frame color', 'bold-timeline' ), 'group' => esc_html__( 'Groups', 'bold-timeline' ) ),
		array( 'param_name' => 'group_title_font', 'type' => 'dropdown', 'heading' => esc_html__( 'Title font', 'bold-timeline' ), 'group' => esc_html__( 'Groups', 'bold-timeline' ),
			'value' => array( esc_html__( 'Inherit', 'bold-timeline' ) => 'inherit' ) + $font_arr
		),
		array( 'param_name' => 'el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom Id Attribute', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'el_css', 'type' => 'textarea', 'heading' => esc_html__( 'Extra CSS', 'bold-timeline' ), 'description' => esc_html__( 'Use #this to select this element (e.g. #this { color: white; })', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'responsive', 'type' => 'checkbox_group', 'heading' => esc_html__( 'Hide element on screens', 'bold-timeline' ), 'group' => esc_html__( 'Responsive', 'bold-timeline' ), 'preview' => true,
			'value' => array(
				esc_html__( '≤480px', 'bold-timeline' ) 		=> 'hidden_xs',
				esc_html__( '480-767px', 'bold-timeline' ) 		=> 'hidden_ms',
				esc_html__( '768-991px', 'bold-timeline' ) 		=> 'hidden_sm',
				esc_html__( '992-1200px', 'bold-timeline' ) 	=> 'hidden_md',
				esc_html__( '≥1200px', 'bold-timeline' ) 		=> 'hidden_lg',
			)
		)
	);
	Bold_Timeline::$builder->map( 'bold_timeline_container', array( 'name' => esc_html__( 'Timeline', 'bold-timeline' ), 'description' => esc_html__( 'Timeline container', 'bold-timeline' ), 'container' => 'vertical', 'icon' => 'bt_bb_icon_bold_timeline_container', 'accept' => array( 'bold_timeline_group' => true ), 'show_settings_on_create' => true, 'root' => true, 'params' => $bold_timeline_container_params ));
	
}
add_action( 'wp_loaded', 'bold_timeline_map_container' );