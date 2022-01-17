<?php

class bt_bb_schedule extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'supertitle'				=> '',
			'title'						=> '',
			'html_tag'      			=> 'h5',
			'dash'						=> '',
			'content'					=> '',
			'selected_days'				=> '',
			'style'						=> '',
			'color_scheme' 				=> '',
			'supertitle_color_scheme' 	=> '',
			'shape'						=> '',
			'font_weight'				=> '',
			'today_color_scheme' 		=> ''
		) ), $atts, $this->shortcode ) );		

		$title = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );

		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}

		if ( $today_color_scheme != '' ) {
			$class[] = $this->prefix . 'today_color_scheme_' . bt_bb_get_color_scheme_id( $today_color_scheme );
		}

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		if ( $font_weight != '' ) {
			$class[] = $this->prefix . 'schedule_font_weight' . '_' . $font_weight;
		}

		if ( $selected_days != '' ) {
			$selected_days_arr = preg_split( '/\s+/', $selected_days );
			if ( !empty( $selected_days_arr ) ) {
				if ( in_array( strtolower(date('D')), array_map('strtolower', $selected_days_arr) ) ){
					$class[] = 'btCurrrentDay';
				}
			}
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		$output_inner = '';

		$items_arr = preg_split( '/$\R?^/m', $content );
		

		if ( count( $items_arr ) > 0 ) {
			foreach ( $items_arr as $item ) { 
				$item = preg_replace('~[\r\n]+~', '', $item);
				if ( $item == '' ) break;
				$item_arr = explode( ';', $item );
				if ( count( $item_arr ) < 2 ) break;
				$bt_extra_row_class = '';
				$bt_extra_data = '';
				if ( isset( $item_arr[2] ) ) {
					$bt_extra_data = ' data-day="' . esc_attr( $item_arr[2] ) . '"';
					if ( strtolower ( date('D') ) ==  strtolower ( $item_arr[2] )) $bt_extra_row_class = ' btToday';	
				}

				$output_inner .= '<div class="' . esc_attr( $this->shortcode . '_inner_row' ) . $bt_extra_row_class . '"' . $bt_extra_data . '>';
					// DAY
					$output_inner .= '<div class="' . esc_attr( $this->shortcode . '_day' ) . '">';
						$output_inner .= '<span>' . $item_arr[0] . '</span>';
					$output_inner .= '</div>';
					
					// TIME
					$time_arr = explode( ',', $item_arr[1] );
					$output_inner .= '<div class="' . esc_attr( $this->shortcode . '_time' ) . '">';
						foreach ( $time_arr as $time ) {
							$output_inner .= '<span>' . $time . '</span>';
						}
					$output_inner .= '</div>';
					if ( isset ( $item_arr[3] ) && $item_arr[3] != '' ) $output_inner .= '<div class="' . esc_attr( $this->shortcode . '_comment' ) . '">' . $item_arr[3] . '</div>';

				$output_inner .= '</div>';

			} 
		}

		$output = '<div class="' . esc_attr( $this->shortcode . '_title_flex' ) . '">';
			if ( $title != '' ) $output .= do_shortcode('[bt_bb_headline headline="' . esc_attr( $title ) . '" superheadline="' . esc_attr( $supertitle ) . '" html_tag="'. esc_attr( $html_tag ) .'" dash="' . esc_attr( $dash ) . '" size="small" supertitle_color_scheme="' . esc_attr( $supertitle_color_scheme ) . '"]');
		$output .= '</div>';
		
		$output .= '<div class="' . esc_attr( $this->shortcode . '_content' ) . '">';
			$output .= $output_inner;
		$output .= '</div>';		

		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $output . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;
	}	

	function map_shortcode() {

		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Schedule', 'zele' ), 'description' => esc_html__( 'Schedule list', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'supertitle', 'type' => 'textfield', 'heading' => esc_html__( 'Supertitle', 'zele' ) ),
				array( 'param_name' => 'title', 'type' => 'textfield', 'preview' => true, 'heading' => esc_html__( 'Title', 'zele' ) ),
				array( 'param_name' => 'content', 'type' => 'textarea', 'heading' => esc_html__( 'Schedule', 'zele' ), 'description' => esc_html__( 'title;time1,time2,time3;day abbreviation (e.x. MON for monday);comment', 'zele' )
				),
				array( 'param_name' => 'selected_days', 'type' => 'checkbox_group', 'heading' => esc_html__( 'Selected days', 'zele' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Monday', 'zele' )		=> 'mon',
						esc_html__( 'Tuesday', 'zele' )		=> 'tue',
						esc_html__( 'Wednesday', 'zele' )	=> 'wed',
						esc_html__( 'Thursday', 'zele' )		=> 'thu',
						esc_html__( 'Friday', 'zele' )		=> 'fri',
						esc_html__( 'Saturday', 'zele' )		=> 'sat',
						esc_html__( 'Sunday', 'zele' )		=> 'sun',
					)
				),
				array( 'param_name' => 'style', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Style', 'zele' ),
					'value' => array(
						esc_html__( 'Style 01 (outline)', 'zele' ) 	=> '',
						esc_html__( 'Style 02 (filled)', 'zele' )	=> 'filled'
					) 
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Inherit', 'zele' ) 			=> '',
						esc_html__( 'Square', 'zele' ) 			=> 'square',
						esc_html__( 'Rounded', 'zele' ) 			=> 'rounded',
						esc_html__( 'Round', 'zele' ) 			=> 'round'
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr, 'preview' => true ),
				
				
				

				array( 'param_name' => 'today_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Current day color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
				
				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'default' => 'h5', 'heading' => esc_html__( 'HTML title tag', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'h1', 'zele' ) 		=> 'h1',
						esc_html__( 'h2', 'zele' ) 		=> 'h2',
						esc_html__( 'h3', 'zele' ) 		=> 'h3',
						esc_html__( 'h4', 'zele' ) 		=> 'h4',
						esc_html__( 'h5', 'zele' ) 		=> 'h5',
						esc_html__( 'h6', 'zele' ) 		=> 'h6'
				) ),
				array( 'param_name' => 'dash', 'type' => 'dropdown', 'heading' => esc_html__( 'Title dash', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'None', 'zele' ) 			=> 'none',
						esc_html__( 'Top', 'zele' ) 				=> 'top',
						esc_html__( 'Bottom', 'zele' ) 			=> 'bottom',
						esc_html__( 'Top and bottom', 'zele' ) 	=> 'top_bottom'
					)
				),
				array( 'param_name' => 'supertitle_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Supertitle color scheme (for top dash)', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
				array( 'param_name' => 'font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Text font weight', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Default', 'zele' ) 				=> '',
						esc_html__( 'Thin', 'zele' ) 				=> 'thin',
						esc_html__( 'Lighter', 'zele' ) 				=> 'lighter',
						esc_html__( 'Light', 'zele' ) 				=> 'light',
						esc_html__( 'Normal', 'zele' ) 				=> 'normal',
						esc_html__( 'Medium', 'zele' ) 				=> 'medium',
						esc_html__( 'Semi bold', 'zele' ) 			=> 'semi-bold',
						esc_html__( 'Bold', 'zele' ) 				=> 'bold',
						esc_html__( 'Bolder', 'zele' ) 				=> 'bolder',
						esc_html__( 'Black', 'zele' ) 				=> 'black'
					)
				)
			))
		);
	}
}