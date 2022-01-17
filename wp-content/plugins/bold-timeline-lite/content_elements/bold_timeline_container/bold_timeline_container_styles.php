<?php
global $bold_timeline_container_style;
$timeline_styles = bold_timeline_lite_styles( $bold_timeline_container_style );

$line_position				= isset($timeline_styles["line_position"]) ? $timeline_styles["line_position"] : 'left';
$line_style					= isset($timeline_styles["line_style"]) ? $timeline_styles["line_style"] : 'solid';
$line_thickness				= isset($timeline_styles["line_thickness"]) ? $timeline_styles["line_thickness"] : '';

$item_style					= isset($timeline_styles["item_style"]) ? $timeline_styles["item_style"] : 'outline';
$item_shape					= isset($timeline_styles["item_shape"]) ? $timeline_styles["item_shape"] : 'soft_rounded';
$item_frame_thickness		= isset($timeline_styles["item_frame_thickness"]) ? $timeline_styles["item_frame_thickness"] : 'normal';
$item_connection_type		= isset($timeline_styles["item_connection_type"]) ? $timeline_styles["item_connection_type"] : 'line';
$item_content_display		= isset($timeline_styles["item_content_display"]) ? $timeline_styles["item_content_display"] : 'show';
$item_marker_type			= isset($timeline_styles["item_marker_type"]) ? $timeline_styles["item_marker_type"] : 'dot';
$item_title_size			= isset($timeline_styles["item_title_size"]) ? $timeline_styles["item_title_size"] : 'normal';
$item_supertitle_style		= isset($timeline_styles["item_supertitle_style"]) ? $timeline_styles["item_supertitle_style"] : 'default';
$item_alignment				= isset($timeline_styles["item_alignment"]) ? $timeline_styles["item_alignment"] : 'default';
$item_font_subset			= isset($timeline_styles["item_font_subset"]) ? $timeline_styles["item_font_subset"] : '';
$item_media_position		= isset($timeline_styles["item_media_position"]) ? $timeline_styles["item_media_position"] : 'bottom';
$item_images_columns		= isset($timeline_styles["item_images_columns"]) ? $timeline_styles["item_images_columns"] : '2';
$item_animation				= isset($timeline_styles["item_animation"]) ? $timeline_styles["item_animation"] : 'no_animation';
$item_icon_position			= isset($timeline_styles["item_icon_position"]) ? $timeline_styles["item_icon_position"] : 'opposite';
$item_icon_shape			= isset($timeline_styles["item_icon_shape"]) ? $timeline_styles["item_icon_shape"] : 'soft_rounded';
$item_icon_style			= isset($timeline_styles["item_icon_style"]) ? $timeline_styles["item_icon_style"] : 'filled';

$group_frame_thickness		= isset($timeline_styles["group_frame_thickness"]) ? $timeline_styles["group_frame_thickness"] : 'normal';
$group_style				= isset($timeline_styles["group_style"]) ? $timeline_styles["group_style"] : 'outline';
$group_shape				= isset($timeline_styles["group_shape"]) ? $timeline_styles["group_shape"] : 'soft_rounded';
$group_title_size			= isset($timeline_styles["group_title_size"]) ? $timeline_styles["group_title_size"] : 'default';
$group_font_subset			= isset($timeline_styles["group_font_subset"]) ? $timeline_styles["group_font_subset"] : '';
$group_content_display		= isset($timeline_styles["group_content_display"]) ? $timeline_styles["group_content_display"] : 'show';

$button_style				= isset($timeline_styles["button_style"]) ? $timeline_styles["button_style"] : 'outline';
$button_shape				= isset($timeline_styles["button_shape"]) ? $timeline_styles["button_shape"] : 'soft_rounded';
$button_size				= isset($timeline_styles["button_size"]) ? $timeline_styles["button_size"] : 'normal';
$button_color				= isset($timeline_styles["button_color"]) ? $timeline_styles["button_color"] : '';

$slider_animation			= isset($timeline_styles["slider_animation"]) ? $timeline_styles["slider_animation"] : 'slide';
$slider_gap					= isset($timeline_styles["slider_gap"]) ? $timeline_styles["slider_gap"] : 'normal';
$slider_dots_style			= isset($timeline_styles["slider_dots_style"]) ? $timeline_styles["slider_dots_style"] : 'show';
$slider_arrows_style		= isset($timeline_styles["slider_arrows_style"]) ? $timeline_styles["slider_arrows_style"] : 'filled';
$slider_arrows_shape		= isset($timeline_styles["slider_arrows_shape"]) ? $timeline_styles["slider_arrows_shape"] : 'square';
$slider_arrows_size			= isset($timeline_styles["slider_arrows_size"]) ? $timeline_styles["slider_arrows_size"] : 'normal';
$slider_slides_to_show		= isset($timeline_styles["slider_slides_to_show"]) ? $timeline_styles["slider_slides_to_show"] : '2';
$slider_auto_play			= isset($timeline_styles["slider_auto_play"]) ? $timeline_styles["slider_auto_play"] : '0';