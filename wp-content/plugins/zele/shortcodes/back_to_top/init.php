<?php

function bt_back_to_top_func( $atts ) {
	extract( shortcode_atts( array(
			'back_to_top'			=> false,
			'back_to_top_text'		=> 'Back To Top'
	), $atts, 'bt_back_to_top_func' ) );

	wp_enqueue_script(
		'bt-back-to-top-script',
		plugins_url( 'js/back_to_top.js', __FILE__ ),
		array( 'jquery' )
	);
	
	if ( $back_to_top_text != '' ) {
		$class = array( 'bt_back_to_top_button btWithText' );
	} else {
		$class = array( 'bt_back_to_top_button' );
	}
	
	$output = '';
	if ( $back_to_top ) {
		$output .= '<span class="bt_bb_back_to_top">';
			$output .= '<a href="#" class="' . implode( ' ', $class ) . '"><span class="bt_bb_back_to_top_text">' . $back_to_top_text . '</span></a>';
		$output .= '</span>';
	}
	
	$output = apply_filters( 'bt_bb_general_output', $output, $atts );
	$output = apply_filters( 'bt_bb_back_to_top_output', $output, $atts );
	
	return $output;
}

add_shortcode( 'bt_back_to_top', 'bt_back_to_top_func' );