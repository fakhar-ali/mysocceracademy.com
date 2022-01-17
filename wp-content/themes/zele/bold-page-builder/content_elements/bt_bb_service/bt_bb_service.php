<?php

class bt_bb_service extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'icon'         			=> '',
			'supertitle'   			=> '',
			'title'       	 		=> '',
			'text'         			=> '',
			'url'          			=> '',
			'align_content'			=> '',
			'target'       			=> '',
			'color_scheme' 			=> '',
			'title_color_scheme' 	=> '',
			'style'        			=> '',
			'size'         			=> '',
			'shape'        			=> '',
			'align'        			=> ''
		) ), $atts, $this->shortcode ) );

		$title = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );

		$class = array( $this->shortcode );
		$data_override_class = array();

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

		if ( $title_color_scheme != '' ) {
			$class[] = $this->prefix . 'title_color_scheme_' . bt_bb_get_color_scheme_id( $title_color_scheme );
		}		

		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}

		if ( $align_content != '' ) {
			$class[] = $this->prefix . 'align_content' . '_' . $align_content;
		}

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'size',
				'value' => $size
			)
		);

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		if ( $supertitle == '' ) {
			$class[] = 'btNoSupertitle';
		}

		if ( $text == '' ) {
			$class[] = 'btNoText';
		}

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'align',
				'value' => $align
			)
		);
		
		$link = bt_bb_get_url( $url );

		$icon_title = wp_strip_all_tags($title);
		
		$icon = bt_bb_icon::get_html( $icon, '', $link, $icon_title, $target );

		if ( $link != '' ) {
			if ( $title != '' ) $title = '<a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . $title . '</a>';
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$output = $icon;

		$output .= '<div class="' . esc_attr( $this->shortcode ) . '_content">';
			if ( $supertitle != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_supertitle">' . $supertitle . '</div>';
			if ( $title != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_title">' . nl2br( $title ) . '</div>';
			if ( $text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_text">' . nl2br( $text ) . '</div>';
		$output .= '</div>';

		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">' . $output . '</div>';
		
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

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Service', 'zele' ), 'description' => esc_html__( 'Icon with text', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'zele' ), 'value' => $icon_arr, 'preview' => true ),
				array( 'param_name' => 'supertitle', 'type' => 'textfield', 'heading' => esc_html__( 'Supertitle', 'zele' ) ),
				array( 'param_name' => 'title', 'type' => 'textarea', 'heading' => esc_html__( 'Title', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'zele' ) ),
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon position', 'zele' ), 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Inherit', 'zele' ) 		=> 'inherit',
						esc_html__( 'Left', 'zele' ) 		=> 'left',
						esc_html__( 'Center', 'zele' ) 		=> 'center',
						esc_html__( 'Right', 'zele' ) 		=> 'right'
					)
				),
				array( 'param_name' => 'align_content', 'type' => 'dropdown', 'heading' => esc_html__( 'Content position', 'zele' ),
					'value' => array(
						esc_html__( 'Top', 'zele' ) 			=> '',
						esc_html__( 'Middle', 'zele' ) 		=> 'middle',
						esc_html__( 'Bottom', 'zele' ) 		=> 'bottom'
					)
				),

				array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us) or post slug (e.g. about-us) or search for existing content.', 'zele' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'group' => esc_html__( 'URL', 'zele' ), 'heading' => esc_html__( 'Target', 'zele' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'zele' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'zele' ) => '_blank',
					)
				),


				
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon size', 'zele' ), 'responsive_override' => true, 'preview' => true, 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Extra small', 'zele' ) 	=> 'xsmall',
						esc_html__( 'Small', 'zele' ) 		=> 'small',
						esc_html__( 'Normal', 'zele' ) 		=> 'normal',
						esc_html__( 'Large', 'zele' ) 		=> 'large',
						esc_html__( 'Extra large', 'zele' ) 	=> 'xlarge'
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Service Color scheme', 'zele' ), 'description' => esc_html__( 'Define color schemes in Bold Builder settings or define accent and alternate colors in theme customizer (if avaliable)', 'zele' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'title_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Title & Text Color scheme', 'zele' ), 'description' => esc_html__( 'Define color schemes in Bold Builder settings or define accent and alternate colors in theme customizer (if avaliable)', 'zele' ), 'value' => $color_scheme_arr, 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon style', 'zele' ), 'preview' => true, 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Outline', 'zele' ) 		=> 'outline',
						esc_html__( 'Filled', 'zele' ) 		=> 'filled',
						esc_html__( 'Borderless', 'zele' ) 	=> 'borderless',
						esc_html__( 'Rugged', 'zele' ) 		=> 'rugged',
						esc_html__( 'Zig zag', 'zele' ) 		=> 'zig_zag',
						esc_html__( 'Liquid', 'zele' ) 		=> 'liquid'
					)
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon shape', 'zele' ), 'default' => '', 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
						esc_html__( 'Inherit', 'zele' ) 			=> '',
						esc_html__( 'Circle', 'zele' ) 			=> 'circle',
						esc_html__( 'Square', 'zele' ) 			=> 'square',
						esc_html__( 'Rounded Square', 'zele' ) 	=> 'round'
					)
				)
			)
		) );
	}
}