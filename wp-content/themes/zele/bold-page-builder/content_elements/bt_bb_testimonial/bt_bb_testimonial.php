<?php

class bt_bb_testimonial extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'rating'				=> '',
			'text'					=> '',
			'image'					=> '',
			'signature'				=> '',
			'name'					=> '',
			'details'				=> '',
			'stars_color'			=> '',
			'name_color'			=> '',
			'font_weight'			=> ''


		) ), $atts, $this->shortcode ) );

		$text = html_entity_decode( $text, ENT_QUOTES, 'UTF-8' );

		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		if ( $stars_color != '' ) {
			$class[] = $this->prefix . 'stars_color' . '_' . $stars_color;
		}

		if ( $name_color != '' ) {
			$class[] = $this->prefix . 'name_color' . '_' . $name_color;
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


		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . '>';

			// IMAGE
			if ( $image != '' ) $output .=  '<div class="' . esc_attr( $this->shortcode . '_image') . '">' . do_shortcode( '[bt_bb_image image="' . esc_attr( $image ) . '" size="boldthemes_small_square" caption="' . esc_attr( $name ) . '"]' ) . '</div>';
		

			$output .= '<div class="' . esc_attr( $this->shortcode . '_content' ) . '">';

				// RATING STARS
				if ( $rating != '' ) {
					$output .= '<div class="' . esc_attr( $this->shortcode . '_ratings' ) . '">';
						for ($i = 1; $i <= intval( $rating ); $i++) {
							$output .= '<div class="' . esc_attr( $this->shortcode . '_icon' ) . '"><span></span></div>';
						}
					$output .= '</div>';
				}

				// TEXT
				if ( $text != '' ) {
					$output .= '<div class="' . esc_attr( $this->shortcode . '_text') . '"> ' . do_shortcode('[bt_bb_headline headline="' . esc_attr( $text ) . '" html_tag="h4" size="medium" font_weight="' . esc_attr( $font_weight ) . '"]' ) . '</div>';
				}

				// SIGNATURE
				if ( $signature != '' ) {
					$output .=  '<div class="' . esc_attr( $this->shortcode . '_signature') . '">' . do_shortcode( '[bt_bb_image image="' . esc_attr( $signature ) . '" size="boldthemes_small_square" caption="' . esc_attr( $name ) . '"]' ) . '</div>';
				}

				// NAME
				if ( $name != '' ) {
					$output .= '<div class="' . esc_attr( $this->shortcode . '_name') . '">' . do_shortcode('[bt_bb_headline headline="" superheadline="' . esc_attr( $name ) . '" html_tag="h6" size="normal"]') . '</div>';
				}

				// DETAILS
				if ( $details != '') {
					$output .= '<div class="' . esc_attr( $this->shortcode . '_details' ) . '"><span>' . $details . '</span></div>';
				}

			$output .= '</div>';

		$output .= '</div>';

		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
			
		return $output;

	}


	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Testimonial', 'zele' ), 'description' => esc_html__( 'Testimonial with ratings, text and signature', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'rating', 'type' => 'dropdown', 'heading' => esc_html__( 'Rating', 'zele' ),
					'value' => array(
						esc_html__( 'None', 'zele' ) 				=> '',
						esc_html__( '1 star', 'zele' ) 				=> '1',
						esc_html__( '2 stars', 'zele' ) 				=> '2',
						esc_html__( '3 stars', 'zele' ) 				=> '3',
						esc_html__( '4 stars', 'zele' ) 				=> '4',
						esc_html__( '5 stars', 'zele' ) 				=> '5'
					)
				),
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'zele' ) ),
				array( 'param_name' => 'image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Image', 'zele' ) 
				),

				array( 'param_name' => 'signature', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Signature', 'zele' ) 
				),
				array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => esc_html__( 'Name', 'zele' ) ),
				array( 'param_name' => 'details', 'type' => 'textfield', 'heading' => esc_html__( 'Details', 'zele' ) ),


				array( 'param_name' => 'stars_color', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Stars rating color', 'zele' ),
					'value' => array(
						esc_html__( 'Accent color', 'zele' ) 			=> '',
						esc_html__( 'Alternate color', 'zele' ) 			=> 'alternate',
						esc_html__( 'Light color', 'zele' ) 				=> 'light',
						esc_html__( 'Dark color', 'zele' ) 				=> 'dark',
						esc_html__( 'Dark gray color', 'zele' ) 				=> 'dark_gray'
					) 
				),
				array( 'param_name' => 'name_color', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Name color', 'zele' ),
					'value' => array(
						esc_html__( 'Accent color', 'zele' ) 			=> '',
						esc_html__( 'Alternate color', 'zele' ) 			=> 'alternate',
						esc_html__( 'Light color', 'zele' ) 				=> 'light',
						esc_html__( 'Dark color', 'zele' ) 				=> 'dark'
					) 
				),
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