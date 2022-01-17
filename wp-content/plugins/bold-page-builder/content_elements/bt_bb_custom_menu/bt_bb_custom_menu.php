<?php

class bt_bb_custom_menu extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'menu'  			=> '',
			'font_weight'   	=> '',
			'direction'  		=> 'vertical'
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		if ( $direction != '' ) {
			$class[] = $this->prefix . 'direction' . '_' . $direction;
		}
		
		if ( $font_weight != '' ) {
			$class[] = $this->prefix . 'font_weight' . '_' . $font_weight ;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$output = wp_nav_menu( 
			array( 
				'menu' => $menu, 
				'echo' => false
			) 
		);
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $output . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;

	}

	function map_shortcode() {
		$menus = wp_get_nav_menus();
		$nav_menu_arr = array();
		foreach( $menus as $menu ) {
			$nav_menu_arr[ $menu->name ] = $menu->slug;
		}
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Custom Menu', 'bold-builder' ), 'description' => esc_html__( 'Custom WordPress menu', 'bold-builder' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'menu', 'type' => 'dropdown', 'heading' => esc_html__( 'Menu name', 'bold-builder' ), 'preview' => true, 'value' => $nav_menu_arr ),
				array( 'param_name' => 'font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Font weight', 'bold-builder' ),
					'value' => array(
						esc_html__( 'Default', 'bold-builder' ) 	=> '',
						esc_html__( 'Normal', 'bold-builder' ) 		=> 'normal',
						esc_html__( 'Bold', 'bold-builder' ) 		=> 'bold',
						esc_html__( 'Bolder', 'bold-builder' ) 		=> 'bolder',
						esc_html__( 'Lighter', 'bold-builder' ) 	=> 'lighter',
						esc_html__( 'Light', 'bold-builder' ) 		=> 'light',
						esc_html__( 'Thin', 'bold-builder' ) 		=> 'thin',
						esc_html__( '100', 'bold-builder' ) 		=> '100',
						esc_html__( '200', 'bold-builder' ) 		=> '200',
						esc_html__( '300', 'bold-builder' ) 		=> '300',
						esc_html__( '400', 'bold-builder' ) 		=> '400',
						esc_html__( '500', 'bold-builder' ) 		=> '500',
						esc_html__( '600', 'bold-builder' ) 		=> '600',
						esc_html__( '700', 'bold-builder' ) 		=> '700',
						esc_html__( '800', 'bold-builder' ) 		=> '800',
						esc_html__( '900', 'bold-builder' ) 		=> '900'
					)
				),
				array( 'param_name' => 'direction', 'type' => 'dropdown', 'default' => 'vertical', 'heading' => esc_html__( 'Direction', 'bold-builder' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Vertical', 'bold-builder' )     	=> 'vertical',
						esc_html__( 'Horizontal', 'bold-builder' )  	=> 'horizontal'					
					)
				)
			)
		) );
	}
}