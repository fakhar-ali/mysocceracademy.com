<?php

// NEW IMAGE SIZES

function zele_custom_image_sizes () {
	
	/* large */
	add_image_size( 'boldthemes_large_4x5', 1280, 1600, true );
	
	/* medium */
	add_image_size( 'boldthemes_medium_4x5', 780, 975, true );
	
	/* small */
	add_image_size( 'boldthemes_small_4x5', 480, 600, true );

}

add_action( 'after_setup_theme', 'zele_custom_image_sizes', 11);




// COLOR SCHEME

if ( is_file( dirname(__FILE__) . '/../../../../plugins/bold-page-builder/content_elements_misc/misc.php' ) ) {
	require_once( dirname(__FILE__) . '/../../../../plugins/bold-page-builder/content_elements_misc/misc.php' );
}
if ( function_exists('bt_bb_get_color_scheme_param_array') ) {
	$color_scheme_arr = bt_bb_get_color_scheme_param_array();
} else {
	$color_scheme_arr = array();
}


// ROW - NEGATIVE MARGIN, BACKGROUND IMAGE

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_row', array(
		array( 'param_name' => 'negative_top_margin', 'type' => 'dropdown', 'heading' => esc_html__( 'Top negative margin', 'zele' ), 'description' => esc_html__( 'This option will move Row to the top (disabled on screens <992px)', 'zele' ),
		'value' => array(
				esc_html__( 'No margin', 'zele' ) 	=> '',
				esc_html__( 'Extra small', 'zele' ) 	=> 'extrasmall',
				esc_html__( 'Small', 'zele' ) 		=> 'small',
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Medium', 'zele' ) 		=> 'medium',
				esc_html__( 'Large', 'zele' ) 		=> 'large',
				esc_html__( 'Extra large', 'zele' ) 	=> 'extralarge',
				esc_html__( 'Huge', 'zele' ) 		=> 'huge',
				esc_html__( '5px', 'zele' ) 			=> '5',
				esc_html__( '10px', 'zele' ) 		=> '10',
				esc_html__( '15px', 'zele' ) 		=> '15',
				esc_html__( '20px', 'zele' ) 		=> '20',
				esc_html__( '25px', 'zele' ) 		=> '25',
				esc_html__( '30px', 'zele' ) 		=> '30',
				esc_html__( '35px', 'zele' ) 		=> '35',
				esc_html__( '40px', 'zele' ) 		=> '40',
				esc_html__( '45px', 'zele' ) 		=> '45',
				esc_html__( '50px', 'zele' ) 		=> '50',
				esc_html__( '55px', 'zele' ) 		=> '55',
				esc_html__( '60px', 'zele' ) 		=> '60',
				esc_html__( '65px', 'zele' ) 		=> '65',
				esc_html__( '70px', 'zele' ) 		=> '70',
				esc_html__( '75px', 'zele' ) 		=> '75',
				esc_html__( '80px', 'zele' ) 		=> '80',
				esc_html__( '85px', 'zele' ) 		=> '85',
				esc_html__( '90px', 'zele' ) 		=> '90',
				esc_html__( '95px', 'zele' ) 		=> '95',
				esc_html__( '100px', 'zele' ) 		=> '100'
			)
		),
		array( 'param_name' => 'background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Background image', 'zele' ), 'group' => esc_html__( 'General', 'zele' ) ),
	));
}

function zele_bt_bb_row_class( $class, $atts ) {
	if ( isset( $atts['negative_top_margin'] ) && $atts['negative_top_margin'] != '' ) {
		$class[] = 'bt_bb_negative_top_margin' . '_' . $atts['negative_top_margin'];
	}
	if ( isset( $atts['background_image'] ) && $atts['background_image'] != '' ) {
		$class[] = 'bt_bb_row_with_bg_image';
	}
	return $class;
}

function zele_bt_bb_row_style_attr( $style_attr, $atts ) {
	if ( isset( $atts['background_image'] ) && $atts['background_image'] != '' ) {
		$background_image = wp_get_attachment_image_src( $atts['background_image'], 'full' );
		$background_image_url = $background_image[0];
		$background_image_style = 'background-image:url(\'' . $background_image_url . '\');';
		if ( $style_attr == '' ) {
			$style_attr = 'style="' . esc_attr( $background_image_style ) . '"';
		} else {
			$style_attr = $style_attr . '; ' . esc_attr( $background_image_style ) . '"';
		}
	}
	return $style_attr;
}

add_filter( 'bt_bb_row_class', 'zele_bt_bb_row_class', 10, 2 );
add_filter( 'bt_bb_row_style_attr', 'zele_bt_bb_row_style_attr', 10, 2 );



// INNER ROW - NEGATIVE MARGIN

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_row_inner', array(
		array( 'param_name' => 'negative_top_margin', 'type' => 'dropdown', 'heading' => esc_html__( 'Top negative margin', 'zele' ), 'description' => esc_html__( 'This option will move Row to the top (disabled on screens <992px)', 'zele' ),
			'value' => array(
				esc_html__( 'No margin', 'zele' ) 	=> '',
				esc_html__( 'Extra small', 'zele' ) 	=> 'extrasmall',
				esc_html__( 'Small', 'zele' ) 		=> 'small',
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Medium', 'zele' ) 		=> 'medium',
				esc_html__( 'Large', 'zele' ) 		=> 'large',
				esc_html__( 'Extra large', 'zele' ) 	=> 'extralarge',
				esc_html__( 'Huge', 'zele' ) 		=> 'huge',
				esc_html__( '5px', 'zele' ) 			=> '5',
				esc_html__( '10px', 'zele' ) 		=> '10',
				esc_html__( '15px', 'zele' ) 		=> '15',
				esc_html__( '20px', 'zele' ) 		=> '20',
				esc_html__( '25px', 'zele' ) 		=> '25',
				esc_html__( '30px', 'zele' ) 		=> '30',
				esc_html__( '35px', 'zele' ) 		=> '35',
				esc_html__( '40px', 'zele' ) 		=> '40',
				esc_html__( '45px', 'zele' ) 		=> '45',
				esc_html__( '50px', 'zele' ) 		=> '50',
				esc_html__( '55px', 'zele' ) 		=> '55',
				esc_html__( '60px', 'zele' ) 		=> '60',
				esc_html__( '65px', 'zele' ) 		=> '65',
				esc_html__( '70px', 'zele' ) 		=> '70',
				esc_html__( '75px', 'zele' ) 		=> '75',
				esc_html__( '80px', 'zele' ) 		=> '80',
				esc_html__( '85px', 'zele' ) 		=> '85',
				esc_html__( '90px', 'zele' ) 		=> '90',
				esc_html__( '95px', 'zele' ) 		=> '95',
				esc_html__( '100px', 'zele' ) 		=> '100'
			)
		),
	));
}

function zele_bt_bb_row_inner_class( $class, $atts ) {
	if ( isset( $atts['negative_top_margin'] ) && $atts['negative_top_margin'] != '' ) {
		$class[] = 'bt_bb_negative_top_margin' . '_' . $atts['negative_top_margin'];
	}
	return $class;
}



add_filter( 'bt_bb_row_inner_class', 'zele_bt_bb_row_inner_class', 10, 2 );




// COLUMN - PADDING, INNER COLOR SCHEME

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_column', 'padding' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_column', array(
		array( 'param_name' => 'padding', 'type' => 'dropdown', 'heading' => esc_html__( 'Inner padding', 'zele' ), 'preview' => true,
			'value' => array(
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Double', 'zele' ) 		=> 'double',
				esc_html__( 'Text Indent', 'zele' ) 	=> 'text_indent',
				esc_html__( '0px', 'zele' ) 			=> '0',
				esc_html__( '5px', 'zele' ) 			=> '5',
				esc_html__( '10px', 'zele' ) 		=> '10',
				esc_html__( '15px', 'zele' ) 		=> '15',
				esc_html__( '20px', 'zele' ) 		=> '20',
				esc_html__( '25px', 'zele' ) 		=> '25',
				esc_html__( '30px', 'zele' ) 		=> '30',
				esc_html__( '35px', 'zele' ) 		=> '35',
				esc_html__( '40px', 'zele' ) 		=> '40',
				esc_html__( '45px', 'zele' ) 		=> '45',
				esc_html__( '50px', 'zele' ) 		=> '50',
				esc_html__( '55px', 'zele' ) 		=> '55',
				esc_html__( '60px', 'zele' ) 		=> '60',
				esc_html__( '65px', 'zele' ) 		=> '65',
				esc_html__( '70px', 'zele' ) 		=> '70',
				esc_html__( '75px', 'zele' ) 		=> '75',
				esc_html__( '80px', 'zele' ) 		=> '80',
				esc_html__( '85px', 'zele' ) 		=> '85',
				esc_html__( '90px', 'zele' ) 		=> '90',
				esc_html__( '95px', 'zele' ) 		=> '95',
				esc_html__( '100px', 'zele' ) 		=> '100'
			)
		),
		array( 'param_name' => 'inner_color_scheme', 'type' => 'dropdown', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Inner color scheme', 'zele' ), 'value' => $color_scheme_arr ),

		
		array( 'param_name' => 'top_left', 'type' => 'checkbox', 'value' => array( esc_html__( 'Top Left Corner', 'zele' ) => 'top_border' ), 'heading' => esc_html__( 'Soft Rouned Shape', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),

		array( 'param_name' => 'top_right', 'type' => 'checkbox', 'value' => array( esc_html__( 'Top Right Corner', 'zele' ) => 'bottom_border' ), 'heading' => '', 'group' => esc_html__( 'Design', 'zele' ) ),

		array( 'param_name' => 'bottom_left', 'type' => 'checkbox', 'value' => array( esc_html__( 'Bottom Left Corner', 'zele' ) => 'left_border' ), 'heading' => '', 'group' => esc_html__( 'Design', 'zele' ) ),

		array( 'param_name' => 'bottom_right', 'type' => 'checkbox', 'value' => array( esc_html__( 'Bottom Right Corner', 'zele' ) => 'right_border' ), 'heading' => '', 'group' => esc_html__( 'Design', 'zele' ) ),
	));
}

function zele_bt_bb_column_class( $class, $atts ) {
	if ( isset( $atts['inner_color_scheme'] ) && $atts['inner_color_scheme'] != '' ) {
		$class[] = 'bt_bb_inner_color_scheme' . '_' . bt_bb_get_color_scheme_id( $atts['inner_color_scheme'] );
	}
	if ( isset( $atts['top_left'] ) && $atts['top_left'] != '' ) {
		$class[] = 'bt_bb_top_left_shape';
	}
	if ( isset( $atts['top_right'] ) && $atts['top_right'] != '' ) {
		$class[] = 'bt_bb_top_right_shape';
	}
	if ( isset( $atts['bottom_left'] ) && $atts['bottom_left'] != '' ) {
		$class[] = 'bt_bb_bottom_left_shape';
	}
	if ( isset( $atts['bottom_right'] ) && $atts['bottom_right'] != '' ) {
		$class[] = 'bt_bb_bottom_right_shape';
	}
	return $class;
}

add_filter( 'bt_bb_column_class', 'zele_bt_bb_column_class', 10, 2 );


// INNER COLUMN - PADDING, INNER COLOR SCHEME

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_column_inner', 'padding' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_column_inner', array(
		array( 'param_name' => 'padding', 'type' => 'dropdown', 'heading' => esc_html__( 'Inner padding', 'zele' ), 'preview' => true,
			'value' => array(
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Double', 'zele' ) 		=> 'double',
				esc_html__( 'Text Indent', 'zele' ) 	=> 'text_indent',
				esc_html__( '0px', 'zele' ) 			=> '0',
				esc_html__( '5px', 'zele' ) 			=> '5',
				esc_html__( '10px', 'zele' ) 		=> '10',
				esc_html__( '15px', 'zele' ) 		=> '15',
				esc_html__( '20px', 'zele' ) 		=> '20',
				esc_html__( '25px', 'zele' ) 		=> '25',
				esc_html__( '30px', 'zele' ) 		=> '30',
				esc_html__( '35px', 'zele' ) 		=> '35',
				esc_html__( '40px', 'zele' ) 		=> '40',
				esc_html__( '45px', 'zele' ) 		=> '45',
				esc_html__( '50px', 'zele' ) 		=> '50',
				esc_html__( '55px', 'zele' ) 		=> '55',
				esc_html__( '60px', 'zele' ) 		=> '60',
				esc_html__( '65px', 'zele' ) 		=> '65',
				esc_html__( '70px', 'zele' ) 		=> '70',
				esc_html__( '75px', 'zele' ) 		=> '75',
				esc_html__( '80px', 'zele' ) 		=> '80',
				esc_html__( '85px', 'zele' ) 		=> '85',
				esc_html__( '90px', 'zele' ) 		=> '90',
				esc_html__( '95px', 'zele' ) 		=> '95',
				esc_html__( '100px', 'zele' ) 		=> '100'
			)
		),
		array( 'param_name' => 'inner_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Inner color scheme', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'value' => $color_scheme_arr ),
	));
}

function zele_bt_bb_column_inner_class( $class, $atts ) {
	if ( isset( $atts['inner_color_scheme'] ) && $atts['inner_color_scheme'] != '' ) {
		$class[] = 'bt_bb_inner_color_scheme' . '_' . bt_bb_get_color_scheme_id( $atts['inner_color_scheme'] );
	}
	return $class;
}
add_filter( 'bt_bb_column_inner_class', 'zele_bt_bb_column_inner_class', 10, 2 );


// SEPARATOR - SPACING, COLOR

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_separator', 'top_spacing' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_separator', 'bottom_spacing' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_separator', array(
		array( 'param_name' => 'top_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Top spacing', 'zele' ), 'weight' => 0, 'preview' => true,
			'value' => array(
				esc_html__( 'No spacing', 'zele' ) 	=> '',
				esc_html__( 'Extra small', 'zele' ) 	=> 'extra_small',
				esc_html__( 'Small', 'zele' ) 		=> 'small',		
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Medium', 'zele' )	 	=> 'medium',
				esc_html__( 'Large', 'zele' ) 		=> 'large',
				esc_html__( 'Extra large', 'zele' ) 	=> 'extra_large',
				esc_html__( '5px', 'zele' ) 			=> '5',
				esc_html__( '10px', 'zele' ) 		=> '10',
				esc_html__( '15px', 'zele' ) 		=> '15',
				esc_html__( '20px', 'zele' ) 		=> '20',
				esc_html__( '25px', 'zele' ) 		=> '25',
				esc_html__( '30px', 'zele' ) 		=> '30',
				esc_html__( '35px', 'zele' ) 		=> '35',
				esc_html__( '40px', 'zele' ) 		=> '40',
				esc_html__( '45px', 'zele' ) 		=> '45',
				esc_html__( '50px', 'zele' ) 		=> '50',
				esc_html__( '60px', 'zele' )			=> '60',
				esc_html__( '70px', 'zele' ) 		=> '70',
				esc_html__( '80px', 'zele' ) 		=> '80',
				esc_html__( '90px', 'zele' ) 		=> '90',
				esc_html__( '100px', 'zele' ) 		=> '100'
			)
		),
		array( 'param_name' => 'bottom_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Bottom spacing', 'zele' ), 'weight' => 1, 'preview' => true,
			'value' => array(
				esc_html__( 'No spacing', 'zele' ) 		=> '',
				esc_html__( 'Extra small', 'zele' ) 		=> 'extra_small',
				esc_html__( 'Small', 'zele' ) 			=> 'small',		
				esc_html__( 'Normal', 'zele' ) 			=> 'normal',
				esc_html__( 'Medium', 'zele' ) 			=> 'medium',
				esc_html__( 'Large', 'zele' ) 			=> 'large',
				esc_html__( 'Extra large', 'zele' ) 		=> 'extra_large',
				esc_html__( '5px', 'zele' ) 				=> '5',
				esc_html__( '10px', 'zele' ) 			=> '10',
				esc_html__( '15px', 'zele' ) 			=> '15',
				esc_html__( '20px', 'zele' ) 			=> '20',
				esc_html__( '25px', 'zele' ) 			=> '25',
				esc_html__( '30px', 'zele' ) 			=> '30',
				esc_html__( '35px', 'zele' ) 			=> '35',
				esc_html__( '40px', 'zele' ) 			=> '40',
				esc_html__( '45px', 'zele' ) 			=> '45',
				esc_html__( '50px', 'zele' ) 			=> '50',
				esc_html__( '60px', 'zele' ) 			=> '60',
				esc_html__( '70px', 'zele' ) 			=> '70',
				esc_html__( '80px', 'zele' ) 			=> '80',
				esc_html__( '90px', 'zele' ) 			=> '90',
				esc_html__( '100px', 'zele' ) 			=> '100'
			)
		),
		array( 'param_name' => 'border_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Border color', 'zele' ), 'preview' => true,
			'value' => array(
				esc_html__( 'Inherit', 'zele' ) 			=> '',
				esc_html__( 'Dark color', 'zele' ) 		=> 'dark',
				esc_html__( 'Light color', 'zele' ) 		=> 'light',
				esc_html__( 'Dark gray color', 'zele' ) 		=> 'gray',
				esc_html__( 'Light gray color', 'zele' ) 		=> 'light_gray',
				esc_html__( 'Accent color', 'zele' ) 	=> 'accent',
				esc_html__( 'Alternate color', 'zele' ) 	=> 'alternate'
			)
		),
	));
}

function zele_bt_bb_separator_class( $class, $atts ) {
	if ( isset( $atts['border_color'] ) && $atts['border_color'] != '' ) {
		$class[] = 'bt_bb_border_color' . '_' . $atts['border_color'];
	}
	return $class;
}
add_filter( 'bt_bb_separator_class', 'zele_bt_bb_separator_class', 10, 2 );



// HEADLINE - SIZE, SUPEHEADLINE & SUBHEADLINE FONT WEIGHT

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_headline', 'font_weight' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_headline', 'size' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_headline', array(
		array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'zele' ), 'responsive_override' => true, 'preview' => true, 'description' => esc_html__( 'Predefined heading sizes, independent of html tag', 'zele' ),
			'value' => array(
				esc_html__( 'Inherit', 'zele' ) 				=> 'inherit',
				esc_html__( 'Extra Small', 'zele' ) 			=> 'extrasmall',
				esc_html__( 'Small', 'zele' ) 				=> 'small',
				esc_html__( 'Medium', 'zele' ) 				=> 'medium',
				esc_html__( 'Normal', 'zele' ) 				=> 'normal',
				esc_html__( 'Large', 'zele' ) 				=> 'large',
				esc_html__( 'Extra Large', 'zele' ) 			=> 'extralarge',
				esc_html__( 'Huge', 'zele' ) 				=> 'huge',
				esc_html__( 'Extra Huge', 'zele' ) 			=> 'extrahuge',
				esc_html__( 'Extra Extra Huge', 'zele' ) 	=> 'extraextrahuge'
			)
		),
		array( 'param_name' => 'font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Font weight', 'zele' ), 'group' => esc_html__( 'Font', 'zele' ),
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
		),
		array( 'param_name' => 'supertitle_font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Supertitle font weight', 'zele' ), 'group' => esc_html__( 'Font', 'zele' ),
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
		),
		array( 'param_name' => 'supertitle_color_scheme', 'type' => 'dropdown', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Supertitle color scheme (for top dash)', 'zele' ), 'value' => $color_scheme_arr ),
		array( 'param_name' => 'subtitle_font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Subtitle font weight', 'zele' ), 'group' => esc_html__( 'Font', 'zele' ),
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
		),
		array( 'param_name' => 'stroke', 'type' => 'dropdown', 'preview' => true, 'heading' => esc_html__( 'Stroke Headline', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'No', 'zele' ) 					=> '',
				esc_html__( 'Yes', 'zele' ) 					=> 'stroke'
			)
		),
		array( 'param_name' => 'rotate', 'type' => 'dropdown', 'heading' => esc_html__( 'Rotate Headline', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'No', 'zele' ) 					=> '',
				esc_html__( 'Yes (-6deg)', 'zele' ) 			=> 'yes',
				esc_html__( 'Yes (-20deg)', 'zele' ) 		=> '20'
			)
		),
		array( 'param_name' => 'disable_rotate', 'type' => 'dropdown', 'heading' => esc_html__( 'Disable Rotate Headline on responsive', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'No', 'zele' ) 					=> '',
				esc_html__( 'Yes (<991px)', 'zele' ) 		=> 'yes'
			)
		),
		array( 'param_name' => 'negative_top_margin', 'type' => 'dropdown', 'heading' => esc_html__( 'Top negative margin', 'zele' ), 'description' => esc_html__( 'This option will move Headline to the top (disabled on screens <992px)', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'No margin', 'zele' ) 	=> '',
				esc_html__( 'Extra small', 'zele' ) 	=> 'extrasmall',
				esc_html__( 'Small', 'zele' ) 		=> 'small',
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Medium', 'zele' ) 		=> 'medium',
				esc_html__( 'Large', 'zele' ) 		=> 'large',
				esc_html__( 'Extra large', 'zele' ) 	=> 'extralarge',
				esc_html__( 'Huge', 'zele' ) 		=> 'huge',
				esc_html__( '5px', 'zele' ) 			=> '5',
				esc_html__( '10px', 'zele' ) 		=> '10',
				esc_html__( '15px', 'zele' ) 		=> '15',
				esc_html__( '20px', 'zele' ) 		=> '20',
				esc_html__( '25px', 'zele' ) 		=> '25',
				esc_html__( '30px', 'zele' ) 		=> '30',
				esc_html__( '35px', 'zele' ) 		=> '35',
				esc_html__( '40px', 'zele' ) 		=> '40',
				esc_html__( '45px', 'zele' ) 		=> '45',
				esc_html__( '50px', 'zele' ) 		=> '50',
				esc_html__( '55px', 'zele' ) 		=> '55',
				esc_html__( '60px', 'zele' ) 		=> '60',
				esc_html__( '65px', 'zele' ) 		=> '65',
				esc_html__( '70px', 'zele' ) 		=> '70',
				esc_html__( '75px', 'zele' ) 		=> '75',
				esc_html__( '80px', 'zele' ) 		=> '80',
				esc_html__( '85px', 'zele' ) 		=> '85',
				esc_html__( '90px', 'zele' ) 		=> '90',
				esc_html__( '95px', 'zele' ) 		=> '95',
				esc_html__( '100px', 'zele' ) 		=> '100'
			)
		),
	));
}

function zele_bt_bb_headline_class( $class, $atts ) {
	if ( isset( $atts['supertitle_font_weight'] ) && $atts['supertitle_font_weight'] != '' ) {
		$class[] = 'bt_bb_supertitle_font_weight' . '_' . $atts['supertitle_font_weight'];
	}
	if ( isset( $atts['subtitle_font_weight'] ) && $atts['subtitle_font_weight'] != '' ) {
		$class[] = 'bt_bb_subtitle_font_weight' . '_' . $atts['subtitle_font_weight'];
	}
	if ( $atts['headline'] == '' ) {
		$class[] = 'btNoHeadline';
	}
	if ( isset( $atts['supertitle_color_scheme'] ) && $atts['supertitle_color_scheme'] != '' ) {
		$class[] = 'bt_bb_supertitle_color_scheme' . '_' . bt_bb_get_color_scheme_id( $atts['supertitle_color_scheme'] );
	}
	if ( isset( $atts['stroke'] ) && $atts['stroke'] != '' ) {
		$class[] = 'bt_bb_style' . '_' . $atts['stroke'];
	}
	if ( isset( $atts['rotate'] ) && $atts['rotate'] != '' ) {
		$class[] = 'bt_bb_rotate' . '_' . $atts['rotate'];
	}
	if ( isset( $atts['disable_rotate'] ) && $atts['disable_rotate'] != '' ) {
		$class[] = 'bt_bb_disable_rotate' . '_' . $atts['disable_rotate'];
	}
	if ( isset( $atts['negative_top_margin'] ) && $atts['negative_top_margin'] != '' ) {
		$class[] = 'bt_bb_negative_top_margin' . '_' . $atts['negative_top_margin'];
	}
	return $class;
}
add_filter( 'bt_bb_headline_class', 'zele_bt_bb_headline_class', 10, 2 );



// CUSTOM MENU - WEIGHT, FONT SIZE, STYLE

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_custom_menu', array(
		array( 'param_name' => 'weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Font weight', 'zele' ),
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
		),
		array( 'param_name' => 'font_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Font size', 'zele' ),
			'value' => array(
				esc_html__( 'Default', 'zele' ) 				=> '',
				esc_html__( '12px', 'zele' ) 				=> '12',
				esc_html__( '13px', 'zele' ) 				=> '13',
				esc_html__( '14px', 'zele' ) 				=> '14',
				esc_html__( '15px', 'zele' ) 				=> '15',
				esc_html__( '16px', 'zele' ) 				=> '16',
				esc_html__( '17px', 'zele' ) 				=> '17'
			)
		),
		array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'zele' ),
			'value' => array(
				esc_html__( 'Inherit', 'zele' ) 			=> '',
				esc_html__( 'Opacity 60%', 'zele' ) 		=> 'opacity'
			)
		),
	));
}

function zele_bt_bb_custom_menu_class( $class, $atts ) {
	if ( isset( $atts['weight'] ) && $atts['weight'] != '' ) {
		$class[] = 'bt_bb_font_weight' . '_' . $atts['weight'];
	}
	if ( isset( $atts['font_size'] ) && $atts['font_size'] != '' ) {
		$class[] = 'bt_bb_font_size' . '_' . $atts['font_size'];
	}
	if ( isset( $atts['style'] ) && $atts['style'] != '' ) {
		$class[] = 'bt_bb_style' . '_' . $atts['style'];
	}
	return $class;
}

add_filter( 'bt_bb_custom_menu_class', 'zele_bt_bb_custom_menu_class', 10, 2 );



// BUTTON - WEIGHT, SIZE, STYLE

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_button', 'style' );
}

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_button', 'size' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_button', 'url' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_button', 'target' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_button', array(
		array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'zele' ), 'preview' => true, 'weight' => 1, 'group' => esc_html__( 'Design', 'zele' ), 'responsive_override' => true,
			'value' => array(
				esc_html__( 'Small', 'zele' ) 		=> 'small',
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Large', 'zele' ) 		=> 'large'
			)
		),
		array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'zele' ), 'preview' => true, 'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'Outline', 'zele' ) 							=> 'outline',
				esc_html__( 'Filled', 'zele' ) 							=> 'filled',
				esc_html__( 'Clean', 'zele' ) 							=> 'clean',
				esc_html__( 'Half Filled', 'zele' ) 						=> 'half_filled',
				esc_html__( 'Skew Filled', 'zele' ) 						=> 'skew_filled',
				esc_html__( 'Special Filled (outline icon)', 'zele' ) 	=> 'filled_outline',
				esc_html__( 'Special Filled (filled icon)', 'zele' ) 	=> 'special_filled',
				esc_html__( 'Special Outline (filled icon)', 'zele' ) 	=> 'special_outline',
				esc_html__( 'Special Skew Filled', 'zele' ) 				=> 'special_skew_filled'
			)
		),
		array( 'param_name' => 'weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Font weight', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'Default', 'zele' ) 		=> '',
				esc_html__( 'Thin', 'zele' ) 		=> 'thin',
				esc_html__( 'Lighter', 'zele' ) 		=> 'lighter',
				esc_html__( 'Light', 'zele' ) 		=> 'light',
				esc_html__( 'Normal', 'zele' ) 		=> 'normal',
				esc_html__( 'Medium', 'zele' ) 		=> 'medium',
				esc_html__( 'Semi bold', 'zele' ) 	=> 'semi-bold',
				esc_html__( 'Bold', 'zele' ) 		=> 'bold',
				esc_html__( 'Bolder', 'zele' ) 		=> 'bolder',
				esc_html__( 'Black', 'zele' ) 		=> 'black'
			)
		),
		array( 'param_name' => 'icon_color_scheme', 'type' => 'dropdown', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Icon color scheme', 'zele' ), 'value' => $color_scheme_arr ),
		array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'zele' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us) or post slug (e.g. about-us) or search for existing content.', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ), 'preview' => true ),
		array( 'param_name' => 'target', 'type' => 'dropdown', 'group' => esc_html__( 'URL', 'zele' ), 'heading' => esc_html__( 'Target', 'zele' ),
			'value' => array(
				esc_html__( 'Self (open in same tab)', 'zele' ) => '_self',
				esc_html__( 'Blank (open in new tab)', 'zele' ) => '_blank',
			)
		),
	));
}

function zele_bt_bb_button_class( $class, $atts ) {
	if ( isset( $atts['weight'] ) && $atts['weight'] != '' ) {
		$class[] = 'bt_bb_font_weight' . '_' . $atts['weight'];
	}
	if ( $atts['text'] == '' ) {
		$class[] = 'btNoText';
	}
	if ( $atts['icon'] != '' ) {
		$class[] = 'btWithIcon';
	}
	if ( $atts['icon'] == 'arrow_e900' ) {
		$class[] = 'btWithArrow';
	}
	if ( isset( $atts['icon_color_scheme'] ) && $atts['icon_color_scheme'] != '' ) {
		$class[] = 'bt_bb_icon_color_scheme' . '_' . bt_bb_get_color_scheme_id( $atts['icon_color_scheme'] );
	}
	return $class;
}
add_filter( 'bt_bb_button_class', 'zele_bt_bb_button_class', 10, 2 );



// ICON - STYLE, SHAPE

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_icon', 'style' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_icon', 'shape' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_icon', 'url' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_icon', 'url_title' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_icon', 'target' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_icon', 'size' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_icon', array(
		array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'zele' ), 'preview' => true, 'weight' => 2,  'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'Outline', 'zele' ) 			=> 'outline',
				esc_html__( 'Filled', 'zele' ) 			=> 'filled',
				esc_html__( 'Borderless', 'zele' ) 		=> 'borderless',
				esc_html__( 'Rugged', 'zele' ) 			=> 'rugged',
				esc_html__( 'Zig zag', 'zele' ) 			=> 'zig_zag',
				esc_html__( 'Liquid', 'zele' ) 			=> 'liquid'
			)
		),
		array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'zele' ), 'default' => '', 'group' => esc_html__( 'Design', 'zele' ),
			'value' => array(
				esc_html__( 'Inherit', 'zele' ) 			=> '',
				esc_html__( 'Circle', 'zele' ) 			=> 'circle',
				esc_html__( 'Square', 'zele' ) 			=> 'square',
				esc_html__( 'Rounded Square', 'zele' ) 	=> 'round'
			)
		),
		array( 'param_name' => 'size', 'type' => 'dropdown', 'default' => 'small', 'heading' => esc_html__( 'Size', 'zele' ), 'preview' => true, 'group' => esc_html__( 'Design', 'zele' ), 'responsive_override' => true,
				'value' => array(
					esc_html__( 'Extra extra small', 'zele' ) 	=> 'xxsmall',
					esc_html__( 'Extra small', 'zele' ) 			=> 'xsmall',
					esc_html__( 'Small', 'zele' ) 				=> 'small',
					esc_html__( 'Normal', 'zele' ) 				=> 'normal',
					esc_html__( 'Large', 'zele' ) 				=> 'large',
					esc_html__( 'Extra large', 'zele' ) 			=> 'xlarge'
				)
			),
		array( 'param_name' => 'text_color_scheme', 'type' => 'dropdown', 'group' => esc_html__( 'Design', 'zele' ), 'heading' => esc_html__( 'Text color scheme', 'zele' ), 'weight' => 7, 'value' => $color_scheme_arr ),
		
		array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'zele' ), 'group' => esc_html__( 'URL', 'zele' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us) or post slug (e.g. about-us) or search for existing content.', 'zele' ) ),
		array( 'param_name' => 'url_title', 'type' => 'textfield', 'group' => esc_html__( 'URL', 'zele' ), 'heading' => esc_html__( 'Mouse hover title', 'zele' ) ),
		array( 'param_name' => 'target', 'type' => 'dropdown', 'group' => esc_html__( 'URL', 'zele' ), 'heading' => esc_html__( 'Target', 'zele' ),
			'value' => array(
				esc_html__( 'Self (open in same tab)', 'zele' ) => '_self',
				esc_html__( 'Blank (open in new tab)', 'zele' ) => '_blank',
			)
		),
	));
}
function zele_bt_bb_icon_class( $class, $atts ) {
	if ( $atts['icon'] == 'arrow_e900' ) {
		$class[] = 'btWithArrow';
	}
	if ( isset( $atts['text_color_scheme'] ) && $atts['text_color_scheme'] != '' ) {
		$class[] = 'bt_bb_text_color_scheme' . '_' . bt_bb_get_color_scheme_id( $atts['text_color_scheme'] );
	}
	return $class;
}
add_filter( 'bt_bb_icon_class', 'zele_bt_bb_icon_class', 10, 2 );


// ACCORDION 

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_accordion', 'style' );
}
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_accordion', 'shape' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_accordion', array(
		array( 'param_name' => 'title_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Title size', 'zele' ), 
			'value' => array(
				esc_html__( 'Small', 'zele' ) 			=> 'small',
				esc_html__( 'Normal', 'zele' ) 			=> '',
				esc_html__( 'Large', 'zele' ) 			=> 'large'
			)
		),
	));
}

function zele_bt_bb_accordion_class( $class, $atts ) {
	if ( isset( $atts['title_size'] ) && $atts['title_size'] != '' ) {
		$class[] = 'bt_bb_title_size' . '_' . $atts['title_size'];
	}
	return $class;
}
add_filter( 'bt_bb_accordion_class', 'zele_bt_bb_accordion_class', 10, 2 );



// GOOGLE MAP 

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_google_maps', array(
		array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Content color scheme', 'zele' ), 'value' => $color_scheme_arr ),
		array( 'param_name' => 'shape', 'default' => '', 'type' => 'dropdown', 'heading' => esc_html__( 'Map shape', 'zele' ),
			'value' => array(
				esc_html__( 'Square', 'zele' ) 			=> '',
				esc_html__( 'Circle', 'zele' ) 			=> 'circle',
				esc_html__( 'Rounded Square', 'zele' ) 	=> 'round'
			)
		),
	));
}

function zele_bt_bb_google_maps_class( $class, $atts ) {
	if ( isset( $atts['color_scheme'] ) && $atts['color_scheme'] != '' ) {
		$class[] = 'bt_bb_color_scheme' . '_' . bt_bb_get_color_scheme_id( $atts['color_scheme'] );
	}
	if ( isset( $atts['shape'] ) && $atts['shape'] != '' ) {
		$class[] = 'bt_bb_shape' . '_' . $atts['shape'];
	}
	return $class;
}
add_filter( 'bt_bb_google_maps_class', 'zele_bt_bb_google_maps_class', 10, 2 );


// SLIDER - NAVIGATION COLOR, MOVE NAVIGATION TO TOP

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_content_slider', 'show_dots' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_content_slider', array(
		array( 'param_name' => 'navigation_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Navigation line color', 'zele' ),
			'value' => array(
				esc_html__( 'Light & Accent color', 'zele' ) 			=> '',
				esc_html__( 'Dark & Accent color', 'zele' ) 				=> 'dark',
				esc_html__( 'Dark & Light color', 'zele' ) 				=> 'dark_light',
				esc_html__( 'Accent & Alternate color', 'zele' ) 		=> 'accent',
				esc_html__( 'Alternate & Accent color', 'zele' ) 		=> 'alternate'
			)
		),
		array( 'param_name' => 'show_dots', 'type' => 'dropdown', 'heading' => esc_html__( 'Navigation line position', 'zele' ),
			'value' => array(
				esc_html__( 'Bottom', 'zele' ) 		=> 'bottom',
				esc_html__( 'Below', 'zele' ) 		=> 'below',
				esc_html__( 'Hide', 'zele' ) 		=> 'hide',
				esc_html__( 'On right', 'zele' ) 	=> 'right'
			)
		),
		array( 'param_name' => 'arrows_position', 'type' => 'dropdown', 'heading' => esc_html__( 'Navigation arrow position', 'zele' ),
			'value' => array(
				esc_html__( 'On side', 'zele' ) 				=> '',
				esc_html__( 'Outside slider', 'zele' ) 		=> 'outside'
			)
		),
	));
}

function zele_bt_bb_content_slider_class( $class, $atts ) {
	if ( isset( $atts['navigation_color'] ) && $atts['navigation_color'] != '' ) {
		$class[] = 'bt_bb_navigation_color' . '_' . $atts['navigation_color'];
	}
	if ( isset( $atts['arrows_position'] ) && $atts['arrows_position'] != '' ) {
		$class[] = 'bt_bb_arrows_position' . '_' . $atts['arrows_position'];
	}
	return $class;
}

add_filter( 'bt_bb_content_slider_class', 'zele_bt_bb_content_slider_class', 10, 2 );



// IMAGE SLIDER - NAVIGATION COLOR

if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_slider', 'show_dots' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_slider', array(
		array( 'param_name' => 'show_dots', 'type' => 'dropdown', 'heading' => esc_html__( 'Navigation line position', 'zele' ),
			'value' => array(
				esc_html__( 'Bottom', 'zele' ) 		=> 'bottom',
				esc_html__( 'Below', 'zele' ) 		=> 'below',
				esc_html__( 'Hide', 'zele' ) 		=> 'hide'
			)
		),
		array( 'param_name' => 'navigation_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Navigation line color', 'zele' ),
			'value' => array(
				esc_html__( 'Light', 'zele' ) 			=> '',
				esc_html__( 'Dark', 'zele' ) 			=> 'dark',
				esc_html__( 'Accent', 'zele' ) 			=> 'accent',
				esc_html__( 'Alternate', 'zele' ) 		=> 'alternate'
			)
		),
	));
}

function zele_bt_bb_slider_class( $class, $atts ) {
	if ( isset( $atts['navigation_color'] ) && $atts['navigation_color'] != '' ) {
		$class[] = 'bt_bb_navigation_color' . '_' . $atts['navigation_color'];
	}
	return $class;
}

add_filter( 'bt_bb_slider_class', 'zele_bt_bb_slider_class', 10, 2 );




// CONTACT FORM 7

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_contact_form_7', array(
		array( 'param_name' => 'submit_button_style', 'type' => 'dropdown', 'preview' => true, 'heading' => esc_html__( 'Submit button style', 'zele' ), 
			'value' => array(
				esc_html__( 'Outline (default)', 'zele' ) 					=> '',
				esc_html__( 'Filled', 'zele' ) 								=> 'filled',
				esc_html__( 'Clean', 'zele' ) 								=> 'clean',
				esc_html__( 'Half Filled', 'zele' ) 							=> 'half_filled',
				esc_html__( 'Skew Filled', 'zele' ) 							=> 'skew_filled',
				esc_html__( 'Special Filled', 'zele' ) 						=> 'special_filled'
			)
		),
		array( 'param_name' => 'submit_button_colors', 'type' => 'dropdown', 'preview' => true, 'heading' => esc_html__( 'Submit button colors', 'zele' ), 
			'value' => array(
				esc_html__( 'Light color font, Accent background color (default)', 'zele' ) 	=> '',
				esc_html__( 'Dark color font, Accent background color', 'zele' ) 			=> 'dark_accent',
				esc_html__( 'Dark color font, Alternate background color', 'zele' ) 			=> 'dark_alternate',
				esc_html__( 'Light color font, Alternate background color', 'zele' ) 		=> 'light_alternate',
				esc_html__( 'Dark color font, Light background color', 'zele' ) 				=> 'dark_light',
				esc_html__( 'Light color font, Dark background color', 'zele' ) 				=> 'light_dark',
				esc_html__( 'Accent color font, Light background color (default)', 'zele' ) 	=> 'accent_light'
			)
		),
		array( 'param_name' => 'input_fields_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Input fields style', 'zele' ), 
			'value' => array(
				esc_html__( 'Gray Color Outline (default)', 'zele' ) 			=> '',
				esc_html__( 'Light Color Outline', 'zele' ) 						=> 'light_outline',
				esc_html__( 'Gray Color Border Bottom', 'zele' ) 				=> 'gray_border_bottom',
				esc_html__( 'Light Color Border Bottom', 'zele' ) 				=> 'light_border_bottom',
				esc_html__( 'Gray Color Filled', 'zele' ) 						=> 'gray_filled',
				esc_html__( 'Light Color Filled', 'zele' ) 						=> 'light_filled'
			)
		),
		array( 'param_name' => 'input_fields_colors', 'type' => 'dropdown', 'heading' => esc_html__( 'Input fields colors', 'zele' ), 
			'value' => array(
				esc_html__( 'Dark color (default)', 'zele' ) 		=> '',
				esc_html__( 'Light color', 'zele' ) 					=> 'light'
			)
		),
	));
}

function zele_bt_bb_contact_form_7_class( $class, $atts ) {
	if ( isset( $atts['submit_button_style'] ) && $atts['submit_button_style'] != '' ) {
		$class[] = 'bt_bb_submit_button_style' . '_' . $atts['submit_button_style'];
	}
	if ( isset( $atts['submit_button_colors'] ) && $atts['submit_button_colors'] != '' ) {
		$class[] = 'bt_bb_submit_button_colors' . '_' . $atts['submit_button_colors'];
	}
	if ( isset( $atts['input_fields_style'] ) && $atts['input_fields_style'] != '' ) {
		$class[] = 'bt_bb_input_fields_style' . '_' . $atts['input_fields_style'];
	}
	if ( isset( $atts['input_fields_colors'] ) && $atts['input_fields_colors'] != '' ) {
		$class[] = 'bt_bb_input_fields_colors' . '_' . $atts['input_fields_colors'];
	}
	return $class;
}

add_filter( 'bt_bb_contact_form_7_class', 'zele_bt_bb_contact_form_7_class', 10, 2 );

