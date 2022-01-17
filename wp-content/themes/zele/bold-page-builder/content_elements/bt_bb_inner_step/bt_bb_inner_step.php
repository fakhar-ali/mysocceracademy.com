<?php

class bt_bb_inner_step extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'icon'      					=> '',
			'title' 						=> '',
			'text' 							=> '',
			'html_tag'      				=> 'h4',
			'icons_style' 					=> ''
		) ), $atts, $this->shortcode ) );
		
		$title = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
		
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

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );


		$output = '';

		$output .= '<div' . $id_attr . ' class="' . implode( ' ', $class ) . ' bt_bb_animation_fade_in animate"' . $style_attr . '>';

			// INNER
			$output .= '<div class="' . esc_attr( $this->shortcode ) . '_inner">';

				// ICON
				if ( $icon != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_icon' ) . '">' . do_shortcode( '[bt_bb_icon icon="' . esc_attr( $icon ) . '" size="xlarge" style="' . esc_attr( $icons_style ) . '" color_scheme="light-accent-skin" ]' ) . '</div>';

				// CONTENT
				$output .= '<div class="' . esc_attr( $this->shortcode ) . '_content">';
					
					// TITLE
					if ( $title != '' )	$output .= '<div class="' . esc_attr( $this->shortcode . '_title' ) . '">' . do_shortcode('[bt_bb_headline headline="' . esc_attr( $title ) . '" html_tag="'. esc_attr( $html_tag ) .'" size="large" ]' ) . '</div>';

					// TEXT
					if ( $text != '' )	$output .= '<div class="' . esc_attr( $this->shortcode . '_text' ) . '">' . do_shortcode('[bt_bb_headline headline="' . esc_attr( $text ) . '" html_tag="h5" size="small"]' ) . '</div>';
				
				$output .= '</div>';
			$output .= '</div>';

		$output .= '</div>';

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;

	}

	function map_shortcode() {

		if ( function_exists('boldthemes_get_icon_fonts_bb_array') ) {
			$icon_arr = boldthemes_get_icon_fonts_bb_array();
		} else {
			require_once( dirname(__FILE__) . '/../../content_elements_misc/fa_icons.php' );
			require_once( dirname(__FILE__) . '/../../content_elements_misc/s7_icons.php' );
			$icon_arr = array( 'Font Awesome' => bt_bb_fa_icons(), 'S7' => bt_bb_s7_icons() );
		}

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Inner step', 'zele' ), 'description' => esc_html__( 'Inner step element', 'zele' ), 'as_child' => array( 'only' => 'bt_bb_steps' ), 'accept' => array( 'bt_bb_section' => false, 'bt_bb_row' => false, 'bt_bb_column' => false, 'bt_bb_column_inner' => false, 'bt_bb_tabs' => false, 'bt_bb_tab_item' => false, 'bt_bb_accordion' => false, 'bt_bb_accordion_item' => false, 'bt_bb_cost_calculator_item' => false, 'bt_cc_group' => false, 'bt_cc_multiply' => false, 'bt_cc_item' => false, 'bt_bb_content_slider_item' => false, 'bt_bb_google_maps_location' => false, '_content' => false ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'zele' ), 'value' => $icon_arr, 'preview' => true ),
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'default' => 'h4', 'heading' => esc_html__( 'HTML title tag', 'zele' ),
					'value' => array(
						esc_html__( 'h1', 'zele' ) 		=> 'h1',
						esc_html__( 'h2', 'zele' ) 		=> 'h2',
						esc_html__( 'h3', 'zele' ) 		=> 'h3',
						esc_html__( 'h4', 'zele' ) 		=> 'h4',
						esc_html__( 'h5', 'zele' ) 		=> 'h5',
						esc_html__( 'h6', 'zele' ) 		=> 'h6'
				) ),
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'zele' ) ),
				array( 'param_name' => 'icons_style', 'preview' => true, 'type' => 'dropdown', 'heading' => esc_html__( 'Icon style', 'zele' ),
					'value' => array(
						esc_html__( 'Outline', 'zele' ) 		=> 'outline',
						esc_html__( 'Filled', 'zele' ) 		=> 'filled',
						esc_html__( 'Borderless', 'zele' ) 	=> 'borderless',
						esc_html__( 'Rugged', 'zele' ) 		=> 'rugged',
						esc_html__( 'Zig zag', 'zele' ) 		=> 'zig_zag',
						esc_html__( 'Liquid', 'zele' ) 		=> 'liquid'
					)
				),
			)
		) );
	}
}