<?php

class bt_bb_progress_bar extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'text'        		=> '',
			'percentage'        => '',
			'color_scheme' 		=> '',
			'highlight_text'	=> '',
			'size'        		=> '',
			'shape'        		=> ''
		) ), $atts, $this->shortcode ) );	

		$class = array( $this->shortcode );

		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}
		
		if ( $size != '' ) {
			$class[] = $this->prefix . 'size' . '_' . $size;
		}

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$content = do_shortcode( $content );

		$output = '';

		$output .= '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>';

			// TEXT
			if ( ( $text != '' ) || ( $highlight_text != '') ) {
				$output .= '<div class="' . esc_attr( $this->shortcode ) . '_text_above">';
					if ( $text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_text"><span>' . $text . '</span></div>';
					if ( $highlight_text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_highlighted_text animate" style="left: ' . $percentage . '%;"><span>' . $percentage . '%</span></div>';
				$output .= '</div>';
			}

			// BAR
			$output .= '<div class="' . esc_attr( $this->shortcode ) . '_bg_cover">';
				$output .= '<div class="' . esc_attr( $this->shortcode ) . '_bg"><div class="bt_bb_progress_bar_inner animate" style="width:' . $percentage . '%"></div></div>';
			$output .= '</div>';

		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();			
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Progress Bar', 'zele' ), 'description' => esc_html__( 'Progress bar', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'percentage', 'type' => 'textfield', 'heading' => esc_html__( 'Percentage', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'text', 'type' => 'textfield', 'heading' => esc_html__( 'Text', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'zele' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Small', 'zele' ) 	=> 'small',
						esc_html__( 'Normal', 'zele' ) 	=> 'normal'
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'zele' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'highlight_text', 'type' => 'dropdown', 'heading' => esc_html__( 'Show percentage', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 			=> '',
						esc_html__( 'Yes', 'zele' ) 			=> 'visible'
					)
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'default' => 'rounded', 'heading' => esc_html__( 'Shape', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Square', 'zele' ) 		=> 'square',
						esc_html__( 'Rounded', 'zele' ) 		=> 'rounded',
					)
				)				
			)
		) );
	}
}