<?php

class bt_bb_card_image extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'icon'      					=> '',
			'image'      					=> '',
			'lazy_load'  					=> 'no',
			'image_size'   					=> '',
			'height'   						=> '',

			'title'							=> '',
			'text'							=> '',
			'html_tag'      				=> 'h3',
			'stroke'      					=> '',
			'arrow'      					=> '',
			'arrow_color_scheme'      		=> '',

			'url'    						=> '',
			'target' 						=> '',
			'url_text'						=> '',

			'title_size'					=> '',
			'color_scheme' 					=> '',
			'icon_size'						=> 'large',
			'icon_style'					=> '',
			'icon_color_scheme' 			=> '',
			'background_color'   			=> '',
			'style'							=> '',
			'border'						=> '',
			'content_display'  				=> '',
			'hover_style'					=> '',
			'shape'							=> '',
			'content_color_scheme'      	=> '',
			
		) ), $atts, $this->shortcode ) );

		wp_enqueue_script(
			'bt_bb_card_image',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_card_image/bt_bb_card_image.js',
			array( 'jquery' ),
			'',
			true
		);

		$title = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
		
		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}


		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}

		if ( ( $style == '' ) && ( $image != '' ) ) {
			$class[] = "btBackgroundImage";
		}

		if ( $border != '' ) {
			$class[] = $this->prefix . 'border' . '_' . $border;
		}

		if ( $image == '' ) {
			$class[] = "btNoImage";
		}

		if ( $height != '' ) {
			$el_style = $el_style . 'min-height:' . $height . ';';
		}

		if ( $background_color != '' ) {
			$el_style = $el_style . 'background-color:' . $background_color . ';';
		}

		if ( $hover_style != '' ) {
			$class[] = $this->prefix . 'hover_style' . '_' . $hover_style;
		}

		if ( $content_display != '' ) {
			$class[] = $this->prefix . 'content_display' . '_' . $content_display;
		}

		if ( ( $icon_size != '' ) && ( $icon != '' ) ) {
			$class[] = $this->prefix . 'icon_size' . '_' . $icon_size;
		}

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}

		if ( $arrow_color_scheme != '' ) {
			$class[] = $this->prefix . 'arrow_color_scheme_' . bt_bb_get_color_scheme_id( $arrow_color_scheme );
		}

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		if ( $content_color_scheme != '' ) {
			$class[] = $this->prefix . 'content_color_scheme_' . bt_bb_get_color_scheme_id( $content_color_scheme );
		}


		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		$show_image_caption = '';
		if ( $show_image_caption == '' ) {
			$show_image_caption = $title;
		}

		$final_url_text = '';
		if ( $url_text == '' ) {
			$final_url_text = $title;
		} else if ( $url_text != '' ) {
			$final_url_text = $url_text;
		}


		$content = do_shortcode( $content );

		$link = bt_bb_get_permalink_by_slug( $url );


		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );

		

		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '" ' . $style_attr . '>';

			if ( $link != '' ) {
				$target_attr = ' target="_self" ';
				if ( $target != '' ) {
					$target_attr = ' ' . 'target="' . esc_attr( $target ) . '"';
				}
				$output .= '<a href="' . esc_url( $link ) . '" ' . $target_attr . ' class="btCardLink"></a>';
			}


				// ICON
				if ( $icon != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_icon' ) . '">' . do_shortcode( '[bt_bb_icon icon="' . esc_attr( $icon ) . '" size="' . esc_attr( $icon_size ) . '" style="' . esc_attr( $icon_style ) . '" shape=" " color_scheme="' . esc_attr( $icon_color_scheme ) . '" ]' ) . '</div>';
					
				// IMAGE
				if ( $image != '' ) $output .=  '<div class="' . esc_attr( $this->shortcode . '_background') . '">' . do_shortcode( '[bt_bb_image image="' . esc_attr( $image ) . '" size="' . esc_attr( $image_size ) . '" lazy_load="' . esc_attr( $lazy_load ) . '" caption="' . esc_attr( $final_url_text ) . '" hover_style="' . esc_attr( $hover_style ) . '"]' ) . '</div>';
					
				// TEXT BOX
				$output .= '<div class="' . esc_attr( $this->shortcode . '_text_box' ) . '">';

					$output .= '<div class="' . esc_attr( $this->shortcode . '_inner' ) . '">';
					
						// HEADLINE
						if ( $title != '' )	$output .= do_shortcode('[bt_bb_headline headline="' . esc_attr( $title ) . '" html_tag="'. esc_attr( $html_tag ) .'" stroke="'. esc_attr( $stroke ) .'" size="' . esc_attr( $title_size ) . '"]');

						// TEXT
						if ( $text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_text">' . nl2br( $text ) . '</div>';

						// ARROW
						if ( $arrow != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_arrow">' . do_shortcode('[bt_bb_button text="" icon="arrow_e900" icon_position="right" size="small" style="clean" color_scheme="' . esc_attr( $arrow_color_scheme ) . '"]' ) . '</div>';

					$output .= '</div>'; // END OF INNER

					// CONTENT
					if ( $content != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_content_inner' ) . '">' . ( $content ) . '</div>';
						
				$output .= '</div>'; // END OF TEXT BOX


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

		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Card Image', 'zele' ), 'description' => esc_html__( 'Card with image, icon and text', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode, 'container' => 'vertical', 'accept' => array( 'bt_bb_button' => true, 'bt_bb_headline' => true, 'bt_bb_icon' => true, 'bt_bb_text' => true, 'bt_bb_separator' => true ),
			'params' => array(
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'zele' ), 'value' => $icon_arr, 'preview' => true ),
				array( 'param_name' => 'image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Image', 'zele' ) 
				),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load this image', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 				=> 'no',
						esc_html__( 'Yes', 'zele' ) 				=> 'yes'
					)
				),
				array( 'param_name' => 'image_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Image size', 'zele' ),
					'value' => bt_bb_get_image_sizes()
				),
				array( 'param_name' => 'height', 'type' => 'textfield', 'description' => esc_html__( 'Enter height in em or px, e.g. 10em', 'zele' ), 'heading' => esc_html__( 'Min height (define when no image)', 'zele' ) ),

				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'zele' ) ),
				array( 'param_name' => 'arrow', 'type' => 'dropdown', 'heading' => esc_html__( 'Show arrow', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 	=> '',
						esc_html__( 'Yes', 'zele' ) 	=> 'show'
					)
				),
				

				array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'zele' ), 'preview' => true, 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us), post slug (e.g. about-us), #lightbox to open current image in full size or search for existing content.', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'zele' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'zele' ) => '_blank',
				) ),
				array( 'param_name' => 'url_text', 'type' => 'textfield', 'heading' => esc_html__( 'URL Hover text', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ), 'description' => esc_html__( 'Text (title) visible on hover', 'zele' ) ),

				
				
				
				array( 'param_name' => 'style', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Image position', 'zele' ),
					'value' => array(
						esc_html__( 'Image as background', 'zele' ) 			=> '',
						esc_html__( 'Image on top', 'zele' )					=> 'image_on_top'
					) 
				),
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
				array( 'param_name' => 'content_display', 'type' => 'dropdown', 'heading' => esc_html__( 'Show content', 'zele' ), 'description' => esc_html__( 'Add selected elements and show them over the card image', 'zele' ),  'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Always visible', 'zele' ) 		=> 'always',
						esc_html__( 'Show on hover', 'zele' ) 		=> 'show-on-hover'
					)
				),
				array( 'param_name' => 'title_size', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'default' => 'medium', 'heading' => esc_html__( 'Title size', 'zele' ),
					'value' => array(
						esc_html__( 'Extra small', 'zele' ) 		=> 'extrasmall',
						esc_html__( 'Small', 'zele' ) 			=> 'small',
						esc_html__( 'Medium', 'zele' )			=> 'medium',
						esc_html__( 'Normal', 'zele' )			=> 'normal',
						esc_html__( 'Large', 'zele' )			=> 'large'
					) 
				),
				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'default' => 'h3', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'HTML title tag', 'zele' ),
					'value' => array(
						esc_html__( 'h1', 'zele' ) 				=> 'h1',
						esc_html__( 'h2', 'zele' )	 			=> 'h2',
						esc_html__( 'h3', 'zele' ) 				=> 'h3',
						esc_html__( 'h4', 'zele' ) 				=> 'h4',
						esc_html__( 'h5', 'zele' ) 				=> 'h5',
						esc_html__( 'h6', 'zele' ) 				=> 'h6'
				) ),
				array( 'param_name' => 'stroke', 'type' => 'dropdown', 'heading' => esc_html__( 'Stroke title', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 					=> '',
						esc_html__( 'Yes', 'zele' ) 					=> 'stroke'
					)
				),
				
				array( 'param_name' => 'icon_size', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'default' => 'large', 'heading' => esc_html__( 'Icon size', 'zele' ),
					'value' => array(
						esc_html__( 'Extra small', 'zele' ) 		=> 'xsmall',
						esc_html__( 'Small', 'zele' ) 			=> 'small',
						esc_html__( 'Normal', 'zele' )			=> 'normal',
						esc_html__( 'Large', 'zele' )			=> 'large',
						esc_html__( 'Extra large', 'zele' )		=> 'xlarge'
					) 
				),
				array( 'param_name' => 'icon_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon style', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Outline', 'zele' ) 		=> 'outline',
						esc_html__( 'Filled', 'zele' ) 		=> 'filled',
						esc_html__( 'Borderless', 'zele' ) 	=> 'borderless',
						esc_html__( 'Rugged', 'zele' ) 		=> 'rugged',
						esc_html__( 'Zig zag', 'zele' ) 		=> 'zig_zag',
						esc_html__( 'Liquid', 'zele' ) 		=> 'liquid'
					)
				),
				array( 'param_name' => 'icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
				array( 'param_name' => 'border', 'type' => 'dropdown', 'default' => '', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Card border', 'zele' ),
					'value' => array(
						esc_html__( 'None', 'zele' ) 					=> '',
						esc_html__( 'Light border', 'zele' ) 			=> 'light',
						esc_html__( 'Very light border', 'zele' ) 		=> 'very_light',
						esc_html__( 'Dark border', 'zele' ) 				=> 'dark',
						esc_html__( 'Accent border', 'zele' ) 			=> 'accent',
						esc_html__( 'Alternate border', 'zele' ) 		=> 'alternate',
						esc_html__( 'Gray border', 'zele' ) 				=> 'gray'
					) 
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Card shape', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Inherit', 'zele' ) 			=> '',
						esc_html__( 'Square', 'zele' ) 			=> 'square',
						esc_html__( 'Rounded', 'zele' ) 			=> 'rounded',
						esc_html__( 'Round', 'zele' ) 			=> 'round'
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Card color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr, 'preview' => true ),
				array( 'param_name' => 'background_color', 'preview' => true, 'type' => 'colorpicker', 'heading' => esc_html__( 'Custom background card color', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'arrow_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Arrow color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
				array( 'param_name' => 'content_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Content color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
				)
			)
		);
	}
}