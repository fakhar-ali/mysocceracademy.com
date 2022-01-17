<?php

class bt_bb_price_list extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'image'      			=> '',
			'lazy_load'  			=> 'no',
			'image_size'   			=> '',

			'supertitle'    		=> '',
			'title'        			=> '',
			'currency'     			=> '',
			'price'        			=> '',

			'text'        			=> '',
			'items'        			=> '',

			'background_image'		=> '',
			'background_lazy_load'	=> 'no',
			'background_color'		=> '',
			'highlight'				=> '',
			'dash'					=> '',

			'stroke'				=> '',
			'html_tag'      		=> 'h3',
			'price_html_tag'      	=> 'h3',

			'currency_position'		=> '',
			'price_color'			=> '',
			'border'				=> '',
			'color_scheme'			=> '',
			'shape'					=> ''
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

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}

		if ( $price_color != '' ) {
			$class[] = $this->prefix . 'price_color' . '_' . $price_color;
		}

		if ( $border != '' ) {
			$class[] = $this->prefix . 'border' . '_' . $border;
		}

		if ( $background_color != '' ) {
			$el_style = $el_style . ';' . 'background-color:' . $background_color . ';';
		}

		if ( $currency_position != '' ) {
			$class[] = $this->prefix . 'currency_position' . '_' . $currency_position;
		}

		if ( $dash != '' ) {
			$class[] = $this->prefix . 'dash' . '_' . $dash;
		}

		if ( $highlight != '' ) {
			$class[] = $this->prefix . 'highlight' . '_' . $highlight;
		}

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		$size = '';
		if ( $background_image != '' && is_numeric( $background_image ) ) {
			$post_image = get_post( $background_image );
			if ( $post_image == '' ) return;
			$size = " boldthemes_large";
			$background_image = wp_get_attachment_image_src( $background_image, $size );
			$background_image = $background_image[0];
			
			$class[] = "btHasBgImage";
			$el_style .= 'background-image: url(' . $background_image . ')';
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

		$content = do_shortcode( $content );
		
		
		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . '>';

			// IMAGE
			if ( $image != '' ) {
				$output .=  '<div class="' . esc_attr( $this->shortcode . '_image') . '">' . do_shortcode( '[bt_bb_image image="' . esc_attr( $image ) . '" size="' . esc_attr( $image_size ) . '" lazy_load="' . esc_attr( $lazy_load ) . '"]' ) . '</div>';
			}

			// TITLE
			if ( $title != '' )	{
				$output .= '<div class="' . esc_attr( $this->shortcode . '_title' ) . '">';
					$output .= do_shortcode('[bt_bb_headline superheadline="' . esc_attr( $supertitle ) . '" headline="' . esc_attr( $title ) . '" html_tag="'. esc_attr( $html_tag ) .'" stroke="'. esc_attr( $stroke ) .'" size="medium" ]');
				$output .= '</div>';
			}

			// PRICE
			$output .= '<div class="' . esc_attr( $this->shortcode . '_price' ) . '">';
				if ( $currency != '' ) $output .= '<span class="' . esc_attr( $this->shortcode ) . '_currency">' . ( $currency ) . '</span>';
				if ( $price != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_amount') . '">' . do_shortcode('[bt_bb_headline headline="' . esc_attr( $price ) . '" html_tag="'. esc_attr( $price_html_tag ) .'" size="medium" ]') . '</div>';
			$output .= '</div>';


			// TEXT
			if ( $text != '') {
				$output .= '<div class="' . esc_attr( $this->shortcode . '_text' ) . '"><span>' . $text . '</span></div>';
			}


			// ITEMS
			if ( $items != '' ) {
				if ( base64_encode(base64_decode($items, true)) === $items){
					$items = base64_decode( $items );
				}

				$items_arr = preg_split( '/$\R?^/m', $items );

				$output .= '<ul class="' . esc_attr( $this->shortcode . '_list' ) . '">';
					foreach ( $items_arr as $item ) {
						$output .= '<li class="' . esc_attr( $this->shortcode . '_item' ) . '">' . $item . '</li>';
					}
				$output .= '</ul>';
			}

			// CONTENT
			if ( $content != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_content_inner' ) . '">' . ( $content ) . '</div>';

		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Price List', 'bt_plugin' ), 'description' => esc_html__( 'List of items with total price', 'bt_plugin' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode, 'container' => 'vertical', 'accept' => array( 'bt_bb_button' => true, 'bt_bb_icon' => true, 'bt_bb_separator' => true ),
			'params' => array(
				array( 'param_name' => 'image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Image', 'bt_plugin' ) 
				),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load this image', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'No', 'bt_plugin' ) 				=> 'no',
						esc_html__( 'Yes', 'bt_plugin' ) 				=> 'yes'
					)
				),
				array( 'param_name' => 'image_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Image Size', 'bt_plugin' ),
					'value' => bt_bb_get_image_sizes()
				),
				array( 'param_name' => 'supertitle', 'type' => 'textfield', 'heading' => esc_html__( 'Supertitle', 'bt_plugin' ) ),
				array( 'param_name' => 'title', 'type' => 'textarea', 'heading' => esc_html__( 'Title', 'bt_plugin' ), 'preview' => true ),
				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'default' => 'h3', 'heading' => esc_html__( 'Title HTML tag', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'h1', 'bt_plugin' ) 				=> 'h1',
						esc_html__( 'h2', 'bt_plugin' )	 			=> 'h2',
						esc_html__( 'h3', 'bt_plugin' ) 				=> 'h3',
						esc_html__( 'h4', 'bt_plugin' ) 				=> 'h4',
						esc_html__( 'h5', 'bt_plugin' ) 				=> 'h5',
						esc_html__( 'h6', 'bt_plugin' ) 				=> 'h6'
				) ),



				array( 'param_name' => 'currency', 'type' => 'textfield', 'heading' => esc_html__( 'Currency', 'bt_plugin' ) ),
				array( 'param_name' => 'price', 'type' => 'textfield', 'heading' => esc_html__( 'Price', 'bt_plugin' ) ),
				array( 'param_name' => 'price_html_tag', 'type' => 'dropdown', 'default' => 'h3', 'heading' => esc_html__( 'Price HTML tag', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'h1', 'bt_plugin' ) 				=> 'h1',
						esc_html__( 'h2', 'bt_plugin' )	 			=> 'h2',
						esc_html__( 'h3', 'bt_plugin' ) 				=> 'h3',
						esc_html__( 'h4', 'bt_plugin' ) 				=> 'h4',
						esc_html__( 'h5', 'bt_plugin' ) 				=> 'h5',
						esc_html__( 'h6', 'bt_plugin' ) 				=> 'h6'
				) ),

				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'bt_plugin' ) ),

				array( 'param_name' => 'items', 'type' => 'textarea_object', 'heading' => esc_html__( 'Items', 'bt_plugin' ), 'description' => esc_html__( 'Write Items separater per line', 'bt_plugin' ) ),

				array( 'param_name' => 'background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Background image', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ) ),
				array( 'param_name' => 'background_lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load background image', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'No', 'bt_plugin' ) 	=> 'no',
						esc_html__( 'Yes', 'bt_plugin' ) 	=> 'yes'
					)
				),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ), 'preview' => true ),
				array( 'param_name' => 'dash', 'type' => 'dropdown', 'default' => '', 'heading' => esc_html__( 'Show bottom dash', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'No', 'bt_plugin' ) 			=> '',
						esc_html__( 'Yes', 'bt_plugin' ) 			=> 'yes'
					)
				),
				array( 'param_name' => 'currency_position', 'type' => 'dropdown', 'default' => '', 'heading' => esc_html__( 'Currency position', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'Before amount', 'bt_plugin' ) 			=> '',
						esc_html__( 'After amount', 'bt_plugin' ) 			=> 'after'
					)
				),
				array( 'param_name' => 'stroke', 'type' => 'dropdown', 'preview' => true, 'heading' => esc_html__( 'Stroke Title', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'No', 'bt_plugin' ) 					=> '',
						esc_html__( 'Yes', 'bt_plugin' ) 					=> 'stroke'
					)
				),
				array( 'param_name' => 'highlight', 'type' => 'dropdown', 'default' => '', 'heading' => esc_html__( 'Highlight Price list', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'No', 'bt_plugin' ) 			=> '',
						esc_html__( 'Yes', 'bt_plugin' ) 			=> 'yes'
					)
				),
				array( 'param_name' => 'price_color', 'type' => 'dropdown', 'default' => '', 'heading' => esc_html__( 'Price color', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'Inherit', 'bt_plugin' ) 			=> '',
						esc_html__( 'Light color', 'bt_plugin' ) 		=> 'light',
						esc_html__( 'Dark color', 'bt_plugin' ) 		=> 'dark',
						esc_html__( 'Accent color', 'bt_plugin' ) 	=> 'accent',
						esc_html__( 'Alternate color', 'bt_plugin' ) 	=> 'alternate'
					)
				),
				array( 'param_name' => 'border', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'bt_plugin' ), 'heading' => esc_html__( 'Price list border', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'None', 'bt_plugin' ) 					=> '',
						esc_html__( 'Light border', 'bt_plugin' ) 			=> 'light',
						esc_html__( 'Very light border', 'bt_plugin' ) 		=> 'very_light',
						esc_html__( 'Dark border', 'bt_plugin' ) 				=> 'dark',
						esc_html__( 'Accent border', 'bt_plugin' ) 			=> 'accent',
						esc_html__( 'Alternate border', 'bt_plugin' ) 		=> 'alternate',
						esc_html__( 'Gray border', 'bt_plugin' ) 				=> 'gray'
					) 
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ), 'description' => esc_html__( 'Define color schemes in Bold Builder settings or define accent and alternate colors in theme customizer (if avaliable)', 'bt_plugin' ), 'value' => $color_scheme_arr, 'preview' => true ),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'bt_plugin' ), 'group' => esc_html__( 'Design', 'bt_plugin' ),
					'value' => array(
						esc_html__( 'Inherit', 'bt_plugin' ) 			=> '',
						esc_html__( 'Square', 'bt_plugin' ) 			=> 'square',
						esc_html__( 'Rounded', 'bt_plugin' ) 			=> 'rounded',
						esc_html__( 'Round', 'bt_plugin' ) 			=> 'round'
					)
				)
			)
		) );
	}
}