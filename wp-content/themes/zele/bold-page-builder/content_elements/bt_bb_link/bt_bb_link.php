<?php

class bt_bb_link extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'text'					=> '',
			'url'					=> '',
			'target'				=> '',
			'html_tag'      		=> 'h4',
			'color_scheme' 			=> '',
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
		
		if ( $target == '' ) {
			$target = '_self';
		}

		if ( $url == '' ) {
			$class[] = "btNoLink";
		}

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}
		
		$link = bt_bb_get_permalink_by_slug( $url );

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );
		
		
		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . '>';

			// TEXT - TITLE
			if ( $text != '' )	$output .= '<div class="bt_bb_link_content">' . do_shortcode('[bt_bb_headline headline="' . esc_attr( $text ) . '" html_tag="'. esc_attr( $html_tag ) .'" url="' . esc_attr( $link ) . '" target="' . esc_attr( $target ) . '" size="large" ]' ) . '</div>'; 

		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}
		

	function map_shortcode() {

		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Link', 'zele' ), 'description' => esc_html__( 'Text with link', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'text', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'zele' ), 'preview' => true ),
				


				array( 'param_name' => 'url', 'type' => 'link', 'group' => esc_html__( 'URL', 'zele' ), 'heading' => esc_html__( 'URL', 'zele' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us), post slug (e.g. about-us), #lightbox to open current image in full size or search for existing content.', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'target', 'group' => esc_html__( 'URL', 'zele' ), 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'zele' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'zele' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'zele' ) => '_blank',
				) ),
				


				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'default' => 'h4', 'heading' => esc_html__( 'HTML tag', 'zele' ),
					'value' => array(
						esc_html__( 'h1', 'zele' ) 		=> 'h1',
						esc_html__( 'h2', 'zele' ) 		=> 'h2',
						esc_html__( 'h3', 'zele' ) 		=> 'h3',
						esc_html__( 'h4', 'zele' ) 		=> 'h4',
						esc_html__( 'h5', 'zele' ) 		=> 'h5',
						esc_html__( 'h6', 'zele' ) 		=> 'h6'
				) ),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'zele' ), 'value' => $color_scheme_arr, 'preview' => true )
			)
		) );
	} 
}