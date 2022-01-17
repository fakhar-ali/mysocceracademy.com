<?php
if ( ! function_exists( 'bold_timeline_lite_styles' ) ) {
	function bold_timeline_lite_styles( $timeline_style ) {

		$bold_timeline_lite_styles['classic'] = array(
			'line_position'					=> 'center_overlap',
			'line_style'					=> 'solid',
			'line_thickness'				=> 'normal',
			
			'item_style'					=> 'outline',
			'item_shape'					=> 'hard_rounded',
			'item_frame_thickness'			=> 'normal',
			
			'item_connection_type'			=> 'line',
			'item_content_display'			=> 'show',
			'item_marker_type'				=> 'dot',
			'item_title_size'				=> 'normal',
			'item_supertitle_style'			=> 'sticker',
			'item_alignment'				=> 'left',
			'item_font_subset'				=> 'latin,latin-ext',
			'item_media_position'			=> 'bottom',
			'item_images_columns'			=> '2',
			'item_animation'				=> 'fade_in',			
			'item_icon_position'			=> 'line',
			'item_icon_shape'				=> 'hard_rounded',
			'item_icon_style'				=> 'outline',
			
			'group_frame_thickness'			=> 'normal',
			'group_style'					=> 'filled',
			'group_shape'					=> 'hard_rounded',
			'group_title_size'				=> 'small',
			'group_font_subset'				=> 'latin,latin-ext',
			'group_content_display'			=> 'show',
			
			'button_style'					=> 'outline',
			'button_shape'					=> 'square',
			'button_size'					=> 'small',
			'button_color'					=> '',
			
			'slider_animation'				=> 'slide',
			'slider_gap'					=> 'normal',
			'slider_dots_style'				=> 'show',
			'slider_arrows_style'			=> 'none',
			'slider_arrows_shape'			=> 'square',
			'slider_arrows_size'			=> 'normal',
			'slider_navigation_color'		=> '',
			'slider_slides_to_show'			=> '2',
			'slider_auto_play'				=> '0'
		);

		$bold_timeline_lite_styles['retro'] = array(
			'line_position'					=> 'center_overlap',
			'line_style'					=> 'solid',
			'line_thickness'				=> 'normal',
			
			'item_style'					=> 'filled_header_outline',
			'item_shape'					=> 'hard_rounded',
			'item_frame_thickness'			=> 'normal',
			
			'item_connection_type'			=> 'line',
			'item_content_display'			=> 'hide',
			'item_marker_type'				=> 'dot',
			'item_title_size'				=> 'normal',
			'item_supertitle_style'			=> 'inherit',
			'item_alignment'				=> 'left',
			'item_font_subset'				=> 'latin,latin-ext',
			'item_media_position'			=> 'bottom',
			'item_images_columns'			=> '2',
			'item_animation'				=> 'fade_in move_up',			
			'item_icon_position'			=> 'line',
			'item_icon_shape'				=> 'hard_rounded',
			'item_icon_style'				=> 'outline',
			
			'group_frame_thickness'			=> 'normal',
			'group_style'					=> 'filled',
			'group_shape'					=> 'circle',
			'group_title_size'				=> 'large',
			'group_font_subset'				=> 'latin,latin-ext',
			'group_content_display'			=> 'show',
			
			'button_style'					=> 'outline',
			'button_shape'					=> 'square',
			'button_size'					=> 'small',
			'button_color'					=> '',
			
			'slider_animation'				=> 'slide',
			'slider_gap'					=> 'normal',
			'slider_dots_style'				=> 'show',
			'slider_arrows_style'			=> 'none',
			'slider_arrows_shape'			=> 'square',
			'slider_arrows_size'			=> 'normal',
			'slider_navigation_color'		=> '',
			'slider_slides_to_show'			=> '2',
			'slider_auto_play'				=> '0'
		);


		$bold_timeline_lite_styles['clean'] = array(
			'line_position'					=> 'center_overlap',
			'line_style'					=> 'solid',
			'line_thickness'				=> 'normal',
			
			'item_style'					=> 'outline_top',
			'item_shape'					=> 'square',
			'item_frame_thickness'			=> 'normal',
			
			'item_connection_type'			=> 'line',
			'item_content_display'			=> 'show',
			'item_marker_type'				=> 'dot',
			'item_title_size'				=> 'normal',
			'item_supertitle_style'			=> 'default',
			'item_alignment'				=> 'default',
			'item_font_subset'				=> 'latin,latin-ext',
			'item_media_position'			=> 'bottom',
			'item_images_columns'			=> '2',
			'item_animation'				=> 'fade_in',			
			'item_icon_position'			=> 'line',
			'item_icon_shape'				=> 'hard_rounded',
			'item_icon_style'				=> 'outline',
			
			'group_frame_thickness'			=> 'normal',
			'group_style'					=> 'filled',
			'group_shape'					=> 'circle',
			'group_title_size'				=> 'small',
			'group_font_subset'				=> 'latin,latin-ext',
			'group_content_display'			=> 'show',
			
			'button_style'					=> 'outline',
			'button_shape'					=> 'square',
			'button_size'					=> 'small',
			'button_color'					=> '',
			
			'slider_animation'				=> 'slide',
			'slider_gap'					=> 'normal',
			'slider_dots_style'				=> 'show',
			'slider_arrows_style'			=> 'none',
			'slider_arrows_shape'			=> 'square',
			'slider_arrows_size'			=> 'normal',
			'slider_navigation_color'		=> '',
			'slider_slides_to_show'			=> '2',
			'slider_auto_play'				=> '0'
		);


		$bold_timeline_lite_styles['travel'] = array(
			'line_position'					=> 'left',
			'line_style'					=> 'solid',
			'line_thickness'				=> 'thick',
			
			'item_style'					=> 'outline',
			'item_shape'					=> 'square',
			'item_frame_thickness'			=> 'thick',
			
			'item_connection_type'			=> 'triangle',
			'item_content_display'			=> 'show',
			'item_marker_type'				=> 'circle_small',
			'item_title_size'				=> 'normal',
			'item_supertitle_style'			=> 'default',
			'item_alignment'				=> 'default',
			'item_font_subset'				=> 'latin,latin-ext',
			'item_media_position'			=> 'bottom',
			'item_images_columns'			=> '1',
			'item_animation'				=> 'fade_in',			
			'item_icon_position'			=> 'line',
			'item_icon_shape'				=> 'hard_rounded',
			'item_icon_style'				=> 'filled',
			
			'group_frame_thickness'			=> 'normal',
			'group_style'					=> 'clear',
			'group_shape'					=> 'square',
			'group_title_size'				=> 'large',
			'group_font_subset'				=> 'latin,latin-ext',
			'group_content_display'			=> 'show',
			
			'button_style'					=> 'outline',
			'button_shape'					=> 'soft_rounded',
			'button_size'					=> 'normal',
			'button_color'					=> '',
			
			'slider_animation'				=> 'slide',
			'slider_gap'					=> 'normal',
			'slider_dots_style'				=> 'show',
			'slider_arrows_style'			=> 'none',
			'slider_arrows_shape'			=> 'square',
			'slider_arrows_size'			=> 'normal',
			'slider_navigation_color'		=> '',
			'slider_slides_to_show'			=> '2',
			'slider_auto_play'				=> '0'
		);

		$bold_timeline_lite_styles['cv'] = array(
			'line_position'					=> 'center_overlap',
			'line_style'					=> 'solid',
			'line_thickness'				=> 'normal',
			
			'item_style'					=> 'outline_top',
			'item_shape'					=> 'square',
			'item_frame_thickness'			=> 'normal',
			
			'item_connection_type'			=> 'line',
			'item_content_display'			=> 'show',
			'item_marker_type'				=> 'dot',
			'item_title_size'				=> 'normal',
			'item_supertitle_style'			=> 'default',
			'item_alignment'				=> 'default',
			'item_font_subset'				=> 'latin,latin-ext',
			'item_media_position'			=> 'bottom',
			'item_images_columns'			=> '2',
			'item_animation'				=> 'fade_in',			
			'item_icon_position'			=> 'line',
			'item_icon_shape'				=> 'hard_rounded',
			'item_icon_style'				=> 'shadow',
			
			'group_frame_thickness'			=> 'normal',
			'group_style'					=> 'filled',
			'group_shape'					=> 'circle',
			'group_title_size'				=> 'small',
			'group_font_subset'				=> 'latin,latin-ext',
			'group_content_display'			=> 'show',
			
			'button_style'					=> 'filled',
			'button_shape'					=> 'hard_rounded',
			'button_size'					=> 'small',
			'button_color'					=> '',
			
			'slider_animation'				=> 'slide',
			'slider_gap'					=> 'normal',
			'slider_dots_style'				=> 'show',
			'slider_arrows_style'			=> 'none',
			'slider_arrows_shape'			=> 'square',
			'slider_arrows_size'			=> 'normal',
			'slider_navigation_color'		=> '',
			'slider_slides_to_show'			=> '2',
			'slider_auto_play'				=> '0'
		);
		
		return ( $timeline_style != "" && isset($bold_timeline_lite_styles[$timeline_style]) ) ? $bold_timeline_lite_styles[$timeline_style] : array();
	}
}