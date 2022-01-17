<?php

class bt_bb_event extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'image'        			=> '',
			'lazy_load'  			=> 'no',
			'image_size'   			=> '',

			'event_day'        		=> '',
			'event_month'        	=> '',

			'details'        		=> '',
			'title'        			=> '',
			'html_tag'      		=> 'h4',
			
			'title_size'        	=> '',
			'hover_style'			=> '',
			'shape'					=> '',
			'date_colors'			=> '',

			'url'         		 	=> '',
			'target'       			=> ''
		) ), $atts, $this->shortcode ) );

		$title = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );

		$class = array( $this->shortcode );

		if ( $hover_style != '' ) {
			$class[] = $this->prefix . 'hover_style' . '_' . $hover_style;
		}

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		if ( $date_colors != '' ) {
			$class[] = $this->prefix . 'date_colors' . '_' . $date_colors;
		}

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

		$content = do_shortcode( $content );

		$link = bt_bb_get_permalink_by_slug( $url );


		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );
	

		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . '>';

			// IMAGE
			if ( $image != '' ) {	
				$output .=  '<div class="' . esc_attr( $this->shortcode . '_background') . '">' . do_shortcode( '[bt_bb_image image="' . esc_attr( $image ) . '" size="' . esc_attr( $image_size ) . '" lazy_load="' . esc_attr( $lazy_load ) . '" url="' . esc_attr( $link ) . '" target="' . esc_attr( $target ) . '" hover_style="' . esc_attr( $hover_style ) . '" caption="' . esc_attr( $title ) . '"]' ) . '</div>';
			}

			// DATE
			if ( ( $event_month != '' ) || ( $event_day != '' ) ) {
				$output .= '<div class="' . esc_attr( $this->shortcode . '_date' ) . '">';
					if ( $event_month != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_date_month' ) . '">' . $event_month . '</div>';
					if ( $event_day != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_date_day' ) . '">' . $event_day . '</div>';
				$output .= '</div>';
			}

			$output .= '<div class="' . esc_attr( $this->shortcode . '_inner' ) . '">';
				
				// TITLE
				if ( $title != '' )	$output .= '<div class="' . esc_attr( $this->shortcode . '_title' ) . '">' . do_shortcode('[bt_bb_headline headline="' . esc_attr( $title ) . '" superheadline="' . esc_attr( $details ) . '" html_tag="'. esc_attr( $html_tag ) .'" size="' . esc_attr( $title_size ) . '" url="' . esc_attr( $link ) . '" target="' . esc_attr( $target ) . '"]' ) . '</div>';
				
				// CONTENT
				if ( $content != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_content' ) . '">' . ( $content ) . '</div>';
			
			$output .= '</div>';

		
		$output .= '</div>';

		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Event', 'zele' ), 'description' => esc_html__( 'Event with description and image', 'zele' ), 'container' => 'vertical', 'accept' => array( 'bt_bb_button' => true, 'bt_bb_icon' => true, 'bt_bb_separator' => true, 'bt_bb_text' => true, 'bt_bb_headline' => true ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Image', 'zele' ) 
				),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load this image', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 		=> 'no',
						esc_html__( 'Yes', 'zele' ) 		=> 'yes'
					)
				),
				array( 'param_name' => 'image_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Image Size', 'zele' ),
					'value' => bt_bb_get_image_sizes()
				),

				array( 'param_name' => 'event_month', 'type' => 'textfield', 'heading' => esc_html__( 'Month', 'zele' ) ),
				array( 'param_name' => 'event_day', 'type' => 'textfield', 'heading' => esc_html__( 'Day', 'zele' ) ),
				
				array( 'param_name' => 'details', 'type' => 'textfield', 'heading' => esc_html__( 'Details', 'zele' ) ),
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'zele' ), 'preview' => true ),
				
				
				

				array( 'param_name' => 'title_size', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'default' => 'medium', 'heading' => esc_html__( 'Title size', 'zele' ),
					'value' => array(
						esc_html__( 'Extra small', 'zele' ) 		=> 'extrasmall',
						esc_html__( 'Small', 'zele' ) 			=> 'small',
						esc_html__( 'Medium', 'zele' )			=> 'medium',
						esc_html__( 'Normal', 'zele' )			=> 'normal',
						esc_html__( 'Large', 'zele' )			=> 'large'
					) 
				),
				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'default' => 'h4', 'group' => esc_html__( 'Design', 'zele' ),  'heading' => esc_html__( 'HTML tag', 'zele' ), 
					'value' => array(
						esc_html__( 'h1', 'zele' ) => 'h1',
						esc_html__( 'h2', 'zele' ) => 'h2',
						esc_html__( 'h3', 'zele' ) => 'h3',
						esc_html__( 'h4', 'zele' ) => 'h4',
						esc_html__( 'h5', 'zele' ) => 'h5',
						esc_html__( 'h6', 'zele' ) => 'h6'
				) ),
				array( 'param_name' => 'hover_style', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Image hover style', 'zele' ),
					'value' => array(
						esc_html__( 'Simple', 'zele' ) 					=> '',
						esc_html__( 'Zoom in', 'zele' ) 					=> 'zoom-in',
						esc_html__( 'To grayscale', 'zele' ) 			=> 'to-grayscale',
						esc_html__( 'From grayscale', 'zele' ) 			=> 'from-grayscale',
						esc_html__( 'Zoom in to grayscale', 'zele' ) 	=> 'zoom-in-to-grayscale',
						esc_html__( 'Zoom in from grayscale', 'zele' ) 	=> 'zoom-in-from-grayscale'
					) 
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Event shape', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Inherit', 'zele' ) 			=> '',
						esc_html__( 'Square', 'zele' ) 			=> 'square',
						esc_html__( 'Rounded', 'zele' ) 			=> 'rounded',
						esc_html__( 'Round', 'zele' ) 			=> 'round'
					)
				),
				array( 'param_name' => 'date_colors', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Date colors', 'zele' ),
					'value' => array(
						esc_html__( 'Light color', 'zele' ) 				=> '',
						esc_html__( 'Dark color', 'zele' ) 				=> 'dark'
					) 
				),
				
				array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'zele' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us), post slug (e.g. about-us), #lightbox to open current image in full size or search for existing content.', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ) ),
				array( 'param_name' => 'target', 'group' => esc_html__( 'URL', 'zele' ), 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'zele' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'zele' ) 		=> '_self',
						esc_html__( 'Blank (open in new tab)', 'zele' ) 		=> '_blank',
					)
				)
			)
		) );
	}
}