<?php

class bt_bb_floating_image extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'image'      					=> '',
			'horizontal_position'  			=> 'left',
			'vertical_position'  			=> 'top',
			'animation_style'  				=> 'ease_out',
			'animation_delay'  				=> 'default',
			'animation_duration'  			=> '',
			'animation_speed'  				=> '1.0',
			'animation_direction'  			=> '',
			'lazy_load'  					=> 'no'
		) ), $atts, $this->shortcode ) );
		
		wp_enqueue_script(
			'bt_bb_floating_image',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_floating_image/bt_bb_floating_image.js',
			array( 'jquery' ),
			'',
			true
		);

		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		if ( $horizontal_position != '' ) {
			$class[] = $this->shortcode . '_horizontal_position' . '_' . $horizontal_position;
		}

		if ( $vertical_position != '' ) {
			$class[] = $this->shortcode . '_vertical_position' . '_' . $vertical_position;
		}

		if ( $animation_delay != '' ) {
			$class[] = $this->shortcode . '_animation_delay' . '_' . $animation_delay;
		}

		if ( $animation_duration != '' ) {
			$class[] = $this->shortcode . '_animation_duration' . '_' . $animation_duration;
		}

		if ( $animation_style != '' ) {
			$class[] = $this->shortcode . '_animation_style' . '_' . $animation_style;
		}

		if ( $animation_direction != '' ) {
			$class[] = $this->shortcode . '_animation_direction' . '_' . $animation_direction;
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		
		$class_attr = implode( ' ', $class );
		
		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}
	
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}


		$output = '';

		if ( $image != '' ) {
			$output .=  '<div class="' . esc_attr( $this->shortcode . '_image') . '" data-speed="' . esc_attr( $animation_speed ) . '" data-direction="' . esc_attr( $animation_direction ) . '" >' . do_shortcode( '[bt_bb_image image="' . esc_attr( $image ) . '" size="full" lazy_load="' . esc_attr( $lazy_load ) . '"]' ) . '</div>';	
		}
		
		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . ' data-speed="' . esc_attr( $animation_speed ) . '" data-direction="' . esc_attr( $animation_direction ) . '" >' . ( $output ) . '</div>';

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Floating image', 'zele' ), 'description' => esc_html__( 'Absolute positioned floating image', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode, 'as_child' => array( 'only' => 'bt_bb_image, bt_bb_column, bt_bb_column_inner' ),
			'params' => array(
				array( 'param_name' => 'image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Image', 'zele' ) 
				),
				array( 'param_name' => 'vertical_position', 'preview' => true, 'default' => '', 'type' => 'dropdown', 'heading' => esc_html__( 'Vertical position', 'zele' ), 
					'value' => array(
						esc_html__( 'Default', 'zele' ) 					=> 'default',
						esc_html__( 'Top (absolute)', 'zele' ) 			=> 'top',
						esc_html__( 'Middle (absolute)', 'zele' ) 		=> 'middle',
						esc_html__( 'Bottom (absolute)', 'zele' ) 		=> 'bottom'
					)
				),
				array( 'param_name' => 'horizontal_position', 'preview' => true, 'default' => '', 'type' => 'dropdown', 'heading' => esc_html__( 'Horizontal position', 'zele' ), 
					'value' => array(
						esc_html__( 'Default', 'zele' ) 					=> 'default',
						esc_html__( 'Left (absolute)', 'zele' ) 			=> 'left',
						esc_html__( 'Center (absolute)', 'zele' ) 		=> 'center',
						esc_html__( 'Right (absolute)', 'zele' ) 		=> 'right'
					)
				),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'no', 'heading' => esc_html__( 'Lazy load this image', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 						=> 'no',
						esc_html__( 'Yes', 'zele' ) 						=> 'yes'
					)
				),
				array( 'param_name' => 'animation_direction', 'preview' => true, 'default' => '', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'zele' ), 'heading' => esc_html__( 'Animation direction', 'zele' ), 
					'value' => array(
						esc_html__( 'Top & bottom', 'zele' ) 			=> '',
						esc_html__( 'Left & right', 'zele' ) 			=> 'left_right',
						esc_html__( 'Rotate', 'zele' ) 					=> 'rotate'
					)
				),

				array( 'param_name' => 'animation_style', 'preview' => true, 'default' => 'ease_out', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'zele' ), 'heading' => esc_html__( 'Animation style (check https://easings.net/en)', 'zele' ), 
					'value' => array(
						esc_html__( 'Ease out (default)', 'zele' ) 		=> 'ease_out',
						esc_html__( 'Ease out sine', 'zele' ) 			=> 'ease_out_sine',
						esc_html__( 'Ease in', 'zele' ) 					=> 'ease_in',
						esc_html__( 'Ease in sine', 'zele' ) 			=> 'ease_in_sine',
						esc_html__( 'Ease in out', 'zele' ) 				=> 'ease_in_out',
						esc_html__( 'Ease in out sine', 'zele' ) 		=> 'ease_in_out_sine',
						esc_html__( 'Ease in out bounce', 'zele' ) 		=> 'ease_in_out_back'
					)
				),
				array( 'param_name' => 'animation_delay', 'default' => '', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'zele' ), 'heading' => esc_html__( 'Animation delay', 'zele' ), 
					'value' => array(
						esc_html__( 'Default', 'zele' ) 					=> 'default',
						esc_html__( '0ms', 'zele' ) 						=> '0',
						esc_html__( '100ms', 'zele' ) 					=> '100',
						esc_html__( '200ms', 'zele' ) 					=> '200',
						esc_html__( '300ms', 'zele' ) 					=> '300',
						esc_html__( '400ms', 'zele' ) 					=> '400',
						esc_html__( '500ms', 'zele' ) 					=> '500',
						esc_html__( '600ms', 'zele' ) 					=> '600',
						esc_html__( '700ms', 'zele' ) 					=> '700',
						esc_html__( '800ms', 'zele' ) 					=> '800',
						esc_html__( '900ms', 'zele' ) 					=> '900',
						esc_html__( '1000ms', 'zele' ) 					=> '1000'
					)
				),
				array( 'param_name' => 'animation_duration', 'preview' => true, 'default' => '', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'zele' ), 'heading' => esc_html__( 'Animation duration', 'zele' ), 
					'value' => array(
						esc_html__( 'Default', 'zele' ) 					=> 'default',
						esc_html__( '0ms', 'zele' ) 						=> '0',
						esc_html__( '100ms', 'zele' ) 					=> '100',
						esc_html__( '200ms', 'zele' ) 					=> '200',
						esc_html__( '300ms', 'zele' ) 					=> '300',
						esc_html__( '400ms', 'zele' ) 					=> '400',
						esc_html__( '500ms', 'zele' ) 					=> '500',
						esc_html__( '600ms', 'zele' ) 					=> '600',
						esc_html__( '700ms', 'zele' ) 					=> '700',
						esc_html__( '800ms', 'zele' ) 					=> '800',
						esc_html__( '900ms', 'zele' ) 					=> '900',
						esc_html__( '1000ms', 'zele' ) 					=> '1000',
						esc_html__( '1100ms', 'zele' ) 					=> '1100',
						esc_html__( '1200ms', 'zele' ) 					=> '1200',
						esc_html__( '1300ms', 'zele' ) 					=> '1300',
						esc_html__( '1400ms', 'zele' ) 					=> '1400',
						esc_html__( '1500ms', 'zele' ) 					=> '1500',
						esc_html__( '2000ms', 'zele' ) 					=> '2000',
						esc_html__( '2500ms', 'zele' ) 					=> '2500',
						esc_html__( '3000ms', 'zele' ) 					=> '3000',
						esc_html__( '3500ms', 'zele' ) 					=> '3500',
						esc_html__( '4000ms', 'zele' ) 					=> '4000',
						esc_html__( '5000ms', 'zele' ) 					=> '5000',
						esc_html__( '6000ms', 'zele' ) 					=> '6000'
					)
				),
				array( 'param_name' => 'animation_speed', 'preview' => true, 'default' => '1.0', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'zele' ), 'heading' => esc_html__( 'Animation s', 'zele' ), 
					'value' => array(
						esc_html__( '0.4 (very short)', 'zele' ) 		=> '0.4',
						esc_html__( '0.6', 'zele' ) 						=> '0.6',
						esc_html__( '0.8', 'zele' ) 						=> '0.8',
						esc_html__( '1.0', 'zele' ) 						=> '1.0',
						esc_html__( '1.2 (default)', 'zele' ) 			=> '1.2',
						esc_html__( '1.4', 'zele' ) 						=> '1.4',
						esc_html__( '1.6 (long)', 'zele' ) 				=> '1.6',
						esc_html__( '1.8', 'zele' ) 						=> '1.8',
						esc_html__( '2.0 (very long)', 'zele' ) 			=> '2.0',
						esc_html__( '2.5 (very very long)', 'zele' ) 	=> '2.5'
					)
				)
			)
		) );
	}
}