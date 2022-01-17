<?php

class bt_bb_separator extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'top_spacing'    => '',
			'bottom_spacing' => '',
			'border_style'   => '',
			'border_width'   => '',
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}
		
		if ( $border_style != '' ) {
			$class[] = $this->prefix . 'border_style' . '_' . $border_style;
		}

		if ( $border_width != '' ) {
			$el_style = $el_style . '; border-width: ' . $border_width;
			if ( $border_style == 'none' ) {
				$el_style = $el_style . '; border-color: transparent; border-style: solid;';
			}
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'top_spacing',
				'value' => $top_spacing
			)
		);
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'bottom_spacing',
				'value' => $bottom_spacing
			)
		);
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );
		
		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}
		
		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '"></div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;

	}

	function map_shortcode() {
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Separator', 'bold-builder' ), 'description' => esc_html__( 'Separator line', 'bold-builder' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array( 
				array( 'param_name' => 'top_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Top spacing', 'bold-builder' ), 'preview' => true, 'responsive_override' => true,
					'value' => array(
						esc_html__( 'No spacing', 'bold-builder' ) => 'none',
						esc_html__( 'Extra small', 'bold-builder' ) => 'extra_small',
						esc_html__( 'Small', 'bold-builder' ) => 'small',		
						esc_html__( 'Normal', 'bold-builder' ) => 'normal',
						esc_html__( 'Medium', 'bold-builder' ) => 'medium',
						esc_html__( 'Large', 'bold-builder' ) => 'large',
						esc_html__( 'Extra large', 'bold-builder' ) => 'extra_large',
						esc_html__( '5px', 'bold-builder' ) => '5',
						esc_html__( '10px', 'bold-builder' ) => '10',
						esc_html__( '15px', 'bold-builder' ) => '15',
						esc_html__( '20px', 'bold-builder' ) => '20',
						esc_html__( '25px', 'bold-builder' ) => '25',
						esc_html__( '30px', 'bold-builder' ) => '30',
						esc_html__( '35px', 'bold-builder' ) => '35',
						esc_html__( '40px', 'bold-builder' ) => '40',
						esc_html__( '45px', 'bold-builder' ) => '45',
						esc_html__( '50px', 'bold-builder' ) => '50',
						esc_html__( '55px', 'bold-builder' ) => '55',
						esc_html__( '60px', 'bold-builder' ) => '60',
						esc_html__( '65px', 'bold-builder' ) => '65',
						esc_html__( '70px', 'bold-builder' ) => '70',
						esc_html__( '75px', 'bold-builder' ) => '75',
						esc_html__( '80px', 'bold-builder' ) => '80',
						esc_html__( '85px', 'bold-builder' ) => '85',
						esc_html__( '90px', 'bold-builder' ) => '90',
						esc_html__( '95px', 'bold-builder' ) => '95',
						esc_html__( '100px', 'bold-builder' ) => '100'
					)
				),
				array( 'param_name' => 'bottom_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Bottom spacing', 'bold-builder' ), 'preview' => true, 'responsive_override' => true,
					'value' => array(
						esc_html__( 'No spacing', 'bold-builder' ) => 'none',
						esc_html__( 'Extra small', 'bold-builder' ) => 'extra_small',
						esc_html__( 'Small', 'bold-builder' ) => 'small',		
						esc_html__( 'Normal', 'bold-builder' ) => 'normal',
						esc_html__( 'Medium', 'bold-builder' ) => 'medium',
						esc_html__( 'Large', 'bold-builder' ) => 'large',
						esc_html__( 'Extra large', 'bold-builder' ) => 'extra_large',
						esc_html__( '5px', 'bold-builder' ) => '5',
						esc_html__( '10px', 'bold-builder' ) => '10',
						esc_html__( '15px', 'bold-builder' ) => '15',
						esc_html__( '20px', 'bold-builder' ) => '20',
						esc_html__( '25px', 'bold-builder' ) => '25',
						esc_html__( '30px', 'bold-builder' ) => '30',
						esc_html__( '35px', 'bold-builder' ) => '35',
						esc_html__( '40px', 'bold-builder' ) => '40',
						esc_html__( '45px', 'bold-builder' ) => '45',
						esc_html__( '50px', 'bold-builder' ) => '50',
						esc_html__( '55px', 'bold-builder' ) => '55',
						esc_html__( '60px', 'bold-builder' ) => '60',
						esc_html__( '65px', 'bold-builder' ) => '65',
						esc_html__( '70px', 'bold-builder' ) => '70',
						esc_html__( '75px', 'bold-builder' ) => '75',
						esc_html__( '80px', 'bold-builder' ) => '80',
						esc_html__( '85px', 'bold-builder' ) => '85',
						esc_html__( '90px', 'bold-builder' ) => '90',
						esc_html__( '95px', 'bold-builder' ) => '95',
						esc_html__( '100px', 'bold-builder' ) => '100'
					)
				),				
				array( 'param_name' => 'border_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Border style', 'bold-builder' ), 'preview' => true,
					'value' => array(
						esc_html__( 'None', 'bold-builder' ) => 'none',
						esc_html__( 'Solid', 'bold-builder' ) => 'solid',
						esc_html__( 'Dotted', 'bold-builder' ) => 'dotted',
						esc_html__( 'Dashed', 'bold-builder' ) => 'dashed'
					)
				),
				array( 'param_name' => 'border_width', 'type' => 'textfield', 'heading' => esc_html__( 'Border width', 'bold-builder' ), 'description' => esc_html__( 'E.g. 5px or 1em', 'bold-builder' ) )
			)
		) );
	}
}