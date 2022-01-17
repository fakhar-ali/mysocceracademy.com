<?php

class bt_bb_organic_animation extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'image'      					=> '',
			'background_shape'  			=> '0',
			'foreground_shape'  			=> '0',
			'background_type'  				=> 'fill',
			'custom_background_color'  		=> '',
			'title'      					=> '',
			'html_tag'      				=> 'h2',
			'subtitle'      				=> '',
			'title_size'      				=> '',
			'title_color_scheme' 			=> '',
			'arrow'      					=> '',
			'arrow_color_scheme'      		=> '',
			'button_url'      				=> '',
			'target'       					=> ''
		) ), $atts, $this->shortcode ) );

		$title = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
		
		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$class[] = $this->shortcode . '_' . $background_type;

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		if ( $title_size != '' ) {
			$class[] = $this->prefix . 'title_size' . '_' . $title_size;
		}

		if ( $title_color_scheme != '' ) {
			$class[] = $this->prefix . 'title_color_scheme_' . bt_bb_get_color_scheme_id( $title_color_scheme );
		}

		if ( $arrow_color_scheme != '' ) {
			$class[] = $this->prefix . 'arrow_color_scheme_' . bt_bb_get_color_scheme_id( $arrow_color_scheme );
		}
		
		$unique_id = uniqid( 'bt_bb_organic_animation_' );

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		
		
		$class_attr = implode( ' ', $class );
		
		if ( $el_class != '' || $class_attr != '' ) {
			$class_attr = ' class = "' . esc_attr( $class_attr ) . ' ' . esc_attr( $el_class ) . '"';
		}
	
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		if ( $image != '' && is_numeric( $image ) ) {
			$post_image = get_post( $image );
			if ( $post_image == '' ) return;
			$size = " full";
			$image = wp_get_attachment_image_src( $image, $size );
			$image = $image[0];
		} else {
			$image = get_template_directory_uri() . 'bold-page-builder/content_elements/bt_bb_organic_animation/img/default.png';
		}
		
		$link = bt_bb_get_permalink_by_slug( $button_url );

		$title = nl2br( $title );
		
		$deco_style = '';
		$opacity = '1';
		
		if ( $custom_background_color != '' ) {
			if ( strpos( $custom_background_color, '#' ) !== false ) {
				$custom_background_color = bt_bb_column::hex2rgb( $custom_background_color );
				if ( substr( $background_type, 0, 4 ) === "fill" ) {
					$deco_style .= 'fill: ';	
				} else {
					$deco_style .= 'stroke: ';
				}
				$deco_style .= 'rgba(' . $custom_background_color[0] . ', ' . $custom_background_color[1] . ', ' . $custom_background_color[2] . ', ' . $opacity . ');';
				$deco_style = 'style = "' . esc_attr( $deco_style ) . '"';
			} else {
				if ( substr( $background_type, 0, 4 ) === "fill" ) {
					$deco_style .= 'fill: ';	
				} else {
					$deco_style .= 'stroke: ';
				}
				$deco_style .= $custom_background_color . ';';
				$deco_style = 'style = "' . esc_attr( $deco_style ) . '"';
			}
		}
		
		require ('bt_bb_organic_animation_data.php');

		$output = '';
		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . '>' . $output ;
			$output .= '

			<div class="item item--style-1"  
				data-morph-path="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-end'] ) . '" 
				data-animation-path-duration="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-duration'] ) . '" 
				data-animation-path-delay="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-delay'] ) . '" 
				data-animation-path-easing="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-easing'] ) . '" 
				data-path-elasticity="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-elasticity'] ) . '"
				data-path-scaleX="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-scaleX'] ) . '" 
				data-path-scaleY="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-scaleY'] ) . '" 
				data-path-translateX="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-translateX'] ) . '" 
				data-path-translateY="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-translateY'] ) . '" 
				data-path-rotate="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-rotate'] ) . '"
				
				data-animation-image-duration="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-duration'] ) . '"
				data-animation-image-delay="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-delay'] ) . '" 
				data-animation-image-easing="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-easing'] ) . '" 
				data-image-elasticity="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-elasticity'] ) . '" 
				data-image-scaleX="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-scaleX'] ) . '" 
				data-image-scaleY="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-scaleY'] ) . '" 
				data-image-translateX="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-translateX'] ) . '" 
				data-image-translateY="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-translateY'] ) . '" 
				data-image-rotate="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['image-rotate'] ) . '"
				
				data-animation-deco-duration="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-duration'] ) . '" 
				data-animation-deco-delay="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-delay'] ) . '" 
				data-animation-deco-easing="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-easing'] ) . '" 
				data-deco-elasticity="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-elasticity'] ) . '" 
				data-deco-scaleX="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-scaleX'] ) . '" 
				data-deco-scaleY="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-scaleY'] ) . '" 
				data-deco-translateX="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-translateX'] ) . '" 
				data-deco-translateY="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-translateY'] ) . '" 
				data-deco-rotate="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-rotate'] ) . '"
			>';
				if ( $link != '' ) {
					$output .= '<a href="' . esc_attr( $link ) . '" target="' . esc_attr( $target ) . '">';
						// SVG
						$output .= '<svg class="item__svg" viewBox="0 0 500 500">
							<clipPath id="' . esc_attr( $unique_id ) . '">
								<path class="item__clippath" d="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-start'] ) . '" />
							</clipPath>
							<g class="item__deco" ' . $deco_style . '>
								<!--use xlink:href="#deco1" /-->
								<path class="item__clippath" d="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-path'] ) . '" />
							</g>
							<g clip-path="url(#' . $unique_id . ')">
								<image class="item__img" xlink:href="' . esc_attr( $image ) . '" x="0" y="0" height="500px" width="500px" />
							</g>';
						$output .= '</svg>'; // SVG

						// META
						$output .= '<div class="item__meta">';
							
							$output .= '<div class="item__meta_inner">';
								if ( $title != '' ) $output .= '<'. $html_tag .' class="item__title">' . $title . '</' . $html_tag . '>';
								if ( $subtitle != '' ) $output .= '<div class="item__subtitle">' . $subtitle . '</div>';
								if ( $arrow != '' ) $output .= '<div class="item__arrow"><span></span></div>';	
							$output .= '</div>'; // META INNER
						
						$output .= '</div>'; // ITEM META
					$output .= '</a>'; // LINK
				} else {
					// SVG
					$output .= '<svg class="item__svg" viewBox="0 0 500 500">
						<clipPath id="' . esc_attr( $unique_id ) . '">
							<path class="item__clippath" d="' . esc_attr( $foreground_shapes_array[ intval( $foreground_shape ) ]['path-start'] ) . '" />
						</clipPath>
						<g class="item__deco" ' . $deco_style . '>
							<!--use xlink:href="#deco1" /-->
							<path class="item__clippath" d="' . esc_attr( $background_shapes_array[ intval( $background_shape ) ]['deco-path'] ) . '" />
						</g>
						<g clip-path="url(#' . $unique_id . ')">
							<image class="item__img" xlink:href="' . esc_attr( $image ) . '" x="0" y="0" height="500px" width="500px" />
						</g>';
					$output .= '</svg>';

					// META
					$output .= '<div class="item__meta">';
						$output .= '<div class="item__meta_inner">';
							if ( $title != '' ) $output .= '<'. $html_tag .' class="item__title">' . $title . '</' . $html_tag . '>';
							if ( $subtitle != '' ) $output .= '<div class="item__subtitle">' . $subtitle . '</div>';
							if ( $arrow != '' ) $output .= '<div class="item__arrow"><span></span></div>';
						$output .= '</div>'; // META INNER
					$output .= '</div>';
				}
			$output .= '</div>';

		$output .= '</div>';
		
		wp_enqueue_script( 
			'anime',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_organic_animation/anime.min.js',
			array( 'jquery' )
		);		
		
		wp_enqueue_script( 
			'bt-organic-animation-main',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_organic_animation/main.js',
			array( 'jquery', 'anime' )
		);

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Organic animation', 'zele' ), 'description' => esc_html__( 'Organic animation card with image and text', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode, 
			'params' => array(
				array( 'param_name' => 'title', 'type' => 'textarea', 'heading' => esc_html__( 'Title', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'subtitle', 'type' => 'textfield', 'heading' => esc_html__( 'Subtitle', 'zele' ) ),
				array( 'param_name' => 'title_size', 'default' => '', 'type' => 'dropdown', 'heading' => esc_html__( 'Title size', 'zele' ),
					'value' => array(
						esc_html__( 'Small', 'zele' ) 	=> '',
						esc_html__( 'Normal', 'zele' ) 	=> 'normal',
						esc_html__( 'Large', 'zele' ) 	=> 'large'
					)
				),
				
				array( 'param_name' => 'arrow', 'type' => 'dropdown', 'heading' => esc_html__( 'Show arrow', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 	=> '',
						esc_html__( 'Yes', 'zele' ) 	=> 'show'
					)
				),
				
				array( 'param_name' => 'button_url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'zele' ), 'preview' => true, 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us), post slug (e.g. about-us), #lightbox to open current image in full size or search for existing content.', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'group' => esc_html__( 'URL', 'zele' ), 'heading' => esc_html__( 'Target', 'zele' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'zele' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'zele' ) => '_blank'
					)
				),
				
				array( 'param_name' => 'image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Image', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'foreground_shape', 'default' => '', 'type' => 'dropdown', 'default' => '0', 'heading' => esc_html__( 'Foreground shape', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 
					'value' => array(
						esc_html__( 'Organic triangle (0)', 'zele' ) 		=> '0',
						esc_html__( 'Triangle rotation (1)', 'zele' ) 		=> '1',
						esc_html__( 'Triangle to circle (2)', 'zele' ) 		=> '2',
						esc_html__( 'Elastic cloud (3)', 'zele' ) 			=> '3',
						esc_html__( 'Fat cloud (4)', 'zele' ) 				=> '4',
						esc_html__( 'Smooth cloud (5)', 'zele' ) 			=> '5',
						esc_html__( 'Scaling bean (6)', 'zele' ) 			=> '6',
						esc_html__( 'Rotating bean (7)', 'zele' ) 			=> '7',
						esc_html__( 'Organic shape (8)', 'zele' ) 			=> '8',
						esc_html__( 'Star to fat star (9)', 'zele' ) 		=> '9',
						esc_html__( 'Organic star (10)', 'zele' ) 			=> '10',
						esc_html__( 'Rotating fat bean (11)', 'zele' ) 		=> '11'
					)
				),
				array( 'param_name' => 'background_shape', 'default' => '', 'type' => 'dropdown', 'default' => '0', 'heading' => esc_html__( 'Background shape', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 
					'value' => array(
						esc_html__( 'Smooth bean (0)', 'zele' ) 				=> '0',
						esc_html__( 'Elastic bean (1)', 'zele' ) 			=> '1',
						esc_html__( 'Circle to elipse (2)', 'zele' ) 		=> '2',
						esc_html__( 'Top cloud (3)', 'zele' ) 				=> '3',
						esc_html__( 'Fat bean (4)', 'zele' ) 				=> '4',
						esc_html__( 'Left cloud (5)', 'zele' ) 				=> '5',
						esc_html__( 'Scaling bean  (6)', 'zele' ) 			=> '6',
						esc_html__( 'Rotating bean (7)', 'zele' ) 			=> '7',
						esc_html__( 'Organic shape (8)', 'zele' ) 			=> '8',
						esc_html__( 'Fat star (9)', 'zele' ) 				=> '9',
						esc_html__( 'Organic star (10)', 'zele' ) 			=> '10',
						esc_html__( 'Small elastic bean (11)', 'zele' ) 		=> '11'
					)
				),
				array( 'param_name' => 'background_type', 'default' => 'fill_gray_transparent', 'type' => 'dropdown', 'default' => '0', 'heading' => esc_html__( 'Background type', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 
					'value' => array(
						esc_html__( 'Filled (alternate color)', 'zele' ) 	=> 'fill',
						esc_html__( 'Filled (accent color)', 'zele' ) 		=> 'fill_accent',
						esc_html__( 'Filled (light color)', 'zele' ) 		=> 'fill_light',
						esc_html__( 'Outline (alternate color)', 'zele' ) 	=> 'stroke',
						esc_html__( 'Outline (accent color)', 'zele' ) 		=> 'stroke_accent',
						esc_html__( 'Outline (dark color)', 'zele' ) 		=> 'stroke_dark'
					)
				),
				array( 'param_name' => 'custom_background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Custom background shape color', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'title_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Text color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
				array( 'param_name' => 'arrow_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Arrow color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'group' => esc_html__( 'Design', 'zele' ),  'default' => 'h2', 'heading' => esc_html__( 'HTML title tag', 'zele' ),
					'value' => array(
						esc_html__( 'h1', 'zele' ) 		=> 'h1',
						esc_html__( 'h2', 'zele' ) 		=> 'h2',
						esc_html__( 'h3', 'zele' ) 		=> 'h3',
						esc_html__( 'h4', 'zele' ) 		=> 'h4',
						esc_html__( 'h5', 'zele' ) 		=> 'h5',
						esc_html__( 'h6', 'zele' ) 		=> 'h6'
				) )
			)
		) );
	}
}