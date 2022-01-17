<?php 

// [bold_timeline_group]

class Bold_Timeline_Group {
	static function init() {
		add_shortcode( 'bold_timeline_group', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
				'title'    						=> '',
			'subtitle' 						=> '',		
			'group_style' 					=> 'inherit',
			'group_thickness' 				=> 'inherit',
			'group_shape' 					=> 'inherit',
			'group_title_tag'				=> 'h3',
			'group_title_size'				=> 'inherit',
			'group_title_font'				=> 'inherit',
			'group_font_subset'				=> '',
			'group_frame_color'				=> '',
			'group_content_display' 		=> 'inherit',
			'group_animation' 				=> 'inherit',			
			'group_show_button_style'		=> 'inherit',
			'group_show_button_shape'		=> 'inherit',
			'group_show_button_color'		=> '',		
			'el_id'							=> '',
			'el_class'						=> '',
			'el_style'						=> '',
            'responsive'                    => ''			
		), $atts, 'bold_timeline_group' ) );
		
		$subtitle = '';
		$group_thickness = '';
		$group_title_tag = 'h3';
		$group_title_font = '';
		$group_frame_color = '';
		$group_animation = '';
		$group_show_button_style = '';
		$group_show_button_shape = '';
		$group_show_button_color = '';
	
		require( dirname(__FILE__) . '/../../assets/php/timeline_styles_reset.php' );		
		require( dirname(__FILE__) . '/../../assets/php/timeline_styles.php' );		
		require( dirname(__FILE__) . '/../../content_elements/bold_timeline_container/bold_timeline_container_styles.php' );

		require( dirname(__FILE__) . '/../../assets/views/bold_timeline_group_view.php' );
		return $output;
	}
}

Bold_Timeline_Group::init();

// Map shortcode

function bold_timeline_map_group() {
	
	require( dirname(__FILE__) . '/../../assets/php/fonts.php' );
	
	$bold_timeline_group_params = array(
		array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'bold-timeline' ), 'preview' => true ),		
		array( 'param_name' => 'el_id', 'type' => 'textfield', 'heading' => esc_html__( 'Custom Id Attribute', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'el_class', 'type' => 'textfield', 'heading' => esc_html__( 'Extra Class Name(s)', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'el_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline Style', 'bold-timeline' ), 'group' => esc_html__( 'Custom', 'bold-timeline' ) ),
		array( 'param_name' => 'responsive', 'type' => 'checkbox_group', 'heading' => esc_html__( 'Hide element on screens', 'bold-timeline' ), 'group' => esc_html__( 'Responsive', 'bold-timeline' ),
			'value' => array(
				esc_html__( '≤480px', 'bold-timeline' ) 		=> 'hidden_xs',
				esc_html__( '480-767px', 'bold-timeline' ) 		=> 'hidden_ms',
				esc_html__( '768-991px', 'bold-timeline' ) 		=> 'hidden_sm',
				esc_html__( '992-1200px', 'bold-timeline' ) 	=> 'hidden_md',
				esc_html__( '≥1200px', 'bold-timeline' ) 		=> 'hidden_lg',
			)
		),
	);
	Bold_Timeline::$builder->map( 'bold_timeline_group', array( 'name' => esc_html__( 'Timeline Group', 'bold-timeline' ), 'description' => esc_html__( 'Timeline group', 'bold-timeline' ), 'container' => 'vertical', 'icon' => 'bt_bb_icon_bold_timeline_group', 
            'accept' => array( 'bold_timeline_item' => true ), 'show_settings_on_create' => true, 'params' => $bold_timeline_group_params ));	
	
}
add_action( 'wp_loaded', 'bold_timeline_map_group' );