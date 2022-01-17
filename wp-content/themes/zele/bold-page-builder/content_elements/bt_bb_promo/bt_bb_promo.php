<?php

class bt_bb_promo extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'old_price'				=> '',
			'old_price_currency'	=> '',
			'new_price'				=> '',
			'new_price_currency'	=> '',
			'url'					=> '',
			'target'				=> ''
		) ), $atts, $this->shortcode ) );
		
		$class = array(); //array( $this->shortcode );
		
		$class[] = 'bt_bb_promo';

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		$url_title = strip_tags( str_replace( array("\n", "\r"), ' ', $new_price ) );
		$link = bt_bb_get_permalink_by_slug( $url );
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );
		
		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}

	
		$output = '';

		$output .= '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . '>';

			// OLD PRICE
			if ( $old_price != '' ) $output .= '<span class="' . esc_attr( $this->shortcode . '_old_price_currency' ) . '">' . $old_price_currency . '</span><span class="' . esc_attr( $this->shortcode . '_old_price' ) . '">' . $old_price . '</span>';

			// NEW PRICE
			if ( $new_price != '' ) {
				if ( ( $url != '') ) {
					$output .= '<a href="' . esc_attr( $link ) . '" target="' . esc_attr( $target ) . '" title="' . esc_attr( $url_title )  . '"><span class="' . esc_attr( $this->shortcode . '_new_price_currency' ) . '">' . $new_price_currency . '</span><span class="' . esc_attr( $this->shortcode . '_new_price' ) . '">' . $new_price . '</span><a/>';
				} else {
					$output .= '<span class="' . esc_attr( $this->shortcode . '_new_price_currency' ) . '">' . $new_price_currency . '</span><span class="' . esc_attr( $this->shortcode . '_new_price' ) . '">' . $new_price . '</span>';
				}
			}


		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
			
		return $output;
	}

	function map_shortcode() {

		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Promo', 'zele' ), 'description' => esc_html__( 'Promo price with old price', 'zele' ),  
			'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'old_price', 'type' => 'textfield', 'heading' => esc_html__( 'Old price', 'zele' ) ),
				array( 'param_name' => 'old_price_currency', 'type' => 'textfield', 'heading' => esc_html__( 'Old price currency', 'zele' ) ),
				array( 'param_name' => 'new_price', 'type' => 'textfield', 'heading' => esc_html__( 'New price', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'new_price_currency', 'type' => 'textfield', 'heading' => esc_html__( 'New price currency', 'zele' ) ),
				


				array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'zele' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us), post slug (e.g. about-us), #lightbox to open current image in full size or search for existing content.', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'group' => esc_html__( 'URL', 'zele' ), 'heading' => esc_html__( 'Target', 'zele' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'zele' ) 				=> '_self',
						esc_html__( 'Blank (open in new tab)', 'zele' ) 				=> '_blank',
				) )
				
			)
		) );

	}
}