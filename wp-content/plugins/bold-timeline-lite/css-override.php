<?php
$boldthemes_crush_vars = Bold_Timeline::$crush_vars;
$boldthemes_crush_vars_def = Bold_Timeline::$crush_vars_def;
if ( isset( $boldthemes_crush_vars['defaultLineColor'] ) ) {
	$defaultLineColor = $boldthemes_crush_vars['defaultLineColor'];
} else {
	$defaultLineColor = "#eeeeee";
}
if ( isset( $boldthemes_crush_vars['defaultGroupColor'] ) ) {
	$defaultGroupColor = $boldthemes_crush_vars['defaultGroupColor'];
} else {
	$defaultGroupColor = "#181818";
}
if ( isset( $boldthemes_crush_vars['defaultFrameColor'] ) ) {
	$defaultFrameColor = $boldthemes_crush_vars['defaultFrameColor'];
} else {
	$defaultFrameColor = "#eeeeee";
}
if ( isset( $boldthemes_crush_vars['defaultItemBackgroundColor'] ) ) {
	$defaultItemBackgroundColor = $boldthemes_crush_vars['defaultItemBackgroundColor'];
} else {
	$defaultItemBackgroundColor = "#fff";
}
if ( isset( $boldthemes_crush_vars['defaultMarkerColor'] ) ) {
	$defaultMarkerColor = $boldthemes_crush_vars['defaultMarkerColor'];
} else {
	$defaultMarkerColor = "#008ed4";
}
if ( isset( $boldthemes_crush_vars['defaultConnectionColor'] ) ) {
	$defaultConnectionColor = $boldthemes_crush_vars['defaultConnectionColor'];
} else {
	$defaultConnectionColor = "#eeeeee";
}
if ( isset( $boldthemes_crush_vars['defaultIconColor'] ) ) {
	$defaultIconColor = $boldthemes_crush_vars['defaultIconColor'];
} else {
	$defaultIconColor = "#008ed4";
}
if ( isset( $boldthemes_crush_vars['defaultButtonColor'] ) ) {
	$defaultButtonColor = $boldthemes_crush_vars['defaultButtonColor'];
} else {
	$defaultButtonColor = "#008ed4";
}
if ( isset( $boldthemes_crush_vars['defaultStickerColor'] ) ) {
	$defaultStickerColor = $boldthemes_crush_vars['defaultStickerColor'];
} else {
	$defaultStickerColor = "#27b6fd";
}
if ( isset( $boldthemes_crush_vars['defaultSliderNavigationColor'] ) ) {
	$defaultSliderNavigationColor = $boldthemes_crush_vars['defaultSliderNavigationColor'];
} else {
	$defaultSliderNavigationColor = "#27b6fd";
}
$css_override = '';
if ( $defaultLineColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_has_line_style .bold_timeline_container_line{
    border-color: {$defaultLineColor};}" ); }
if ( $defaultGroupColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_group_style_outline .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header,
.bold_timeline_container .bold_timeline_group_override_style_outline.bold_timeline_group .bold_timeline_group_header{
    border-color: {$defaultGroupColor};}" ); }
if ( $defaultGroupColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_group_style_filled .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header,
.bold_timeline_container .bold_timeline_group_override_style_filled.bold_timeline_group .bold_timeline_group_header{
    background: {$defaultGroupColor};}" ); }
if ( $defaultGroupColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_group_style_shadow .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header,
.bold_timeline_container .bold_timeline_group_override_style_shadow.bold_timeline_group .bold_timeline_group_header{
    color: {$defaultGroupColor};}" ); }
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_group_show_button_style_outline .bold_timeline_group_override_show_button_style_inherit.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner,
.bold_timeline_container .bold_timeline_group_override_show_button_style_outline.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner{border: 2px solid {$defaultButtonColor};}" ); }
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_group_show_button_style_filled .bold_timeline_group_override_show_button_style_inherit.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner,
.bold_timeline_container .bold_timeline_group_override_show_button_style_filled.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner{background: {$defaultButtonColor};}" ); }
if ( $defaultItemBackgroundColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container .bold_timeline_item .bold_timeline_item_inner{background: {$defaultItemBackgroundColor};}" ); }
if ( $defaultFrameColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_style_outline .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner,
.bold_timeline_container .bold_timeline_item_override_style_outline.bold_timeline_item .bold_timeline_item_inner{
    border-color: {$defaultFrameColor};}" ); }
if ( $defaultFrameColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_style_outline_full .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner,
.bold_timeline_container .bold_timeline_item_override_style_outline_full.bold_timeline_item .bold_timeline_item_inner{
    border-color: {$defaultFrameColor};}" ); }
if ( $defaultFrameColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_style_outline_full .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header,
.bold_timeline_container .bold_timeline_item_override_style_outline_full.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header{
    border-bottom-color: {$defaultFrameColor};}" ); }
if ( $defaultFrameColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_style_outline_top .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner,
.bold_timeline_container .bold_timeline_item_override_style_outline_top.bold_timeline_item .bold_timeline_item_inner{
    border-top-color: {$defaultFrameColor};}" ); }
if ( $defaultFrameColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_style_filled_header .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header,
.bold_timeline_container .bold_timeline_item_override_style_filled_header.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header{background: {$defaultFrameColor};}" ); }
if ( $defaultFrameColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_style_filled_header_outline .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner,
.bold_timeline_container .bold_timeline_item_override_style_filled_header_outline.bold_timeline_item .bold_timeline_item_inner{
    border-color: {$defaultFrameColor};}" ); }
if ( $defaultFrameColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_style_filled_header_outline .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header,
.bold_timeline_container .bold_timeline_item_override_style_filled_header_outline.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header{background: {$defaultFrameColor};}" ); }
if ( $defaultStickerColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_supertitle_style_sticker .bold_timeline_item_override_supertitle_style_inherit.bold_timeline_item .bold_timeline_item_header .bold_timeline_item_header_supertitle .bold_timeline_item_header_supertitle_inner,
.bold_timeline_container .bold_timeline_item_override_supertitle_style_sticker.bold_timeline_item .bold_timeline_item_header .bold_timeline_item_header_supertitle .bold_timeline_item_header_supertitle_inner{background: {$defaultStickerColor};}" ); }
if ( $defaultMarkerColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_marker_type_dot .bold_timeline_item_override_marker_type_inherit.bold_timeline_item .bold_timeline_item_marker,
.bold_timeline_container .bold_timeline_item_override_marker_type_dot.bold_timeline_item .bold_timeline_item_marker{
    background: {$defaultMarkerColor};}" ); }
if ( $defaultMarkerColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_marker_type_circle .bold_timeline_item_override_marker_type_inherit.bold_timeline_item .bold_timeline_item_marker,
.bold_timeline_container .bold_timeline_item_override_marker_type_circle.bold_timeline_item .bold_timeline_item_marker{
    border-color: {$defaultMarkerColor};}" ); }
if ( $defaultMarkerColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_marker_type_circle_small .bold_timeline_item_override_marker_type_inherit.bold_timeline_item .bold_timeline_item_marker,
.bold_timeline_container .bold_timeline_item_override_marker_type_circle_small.bold_timeline_item .bold_timeline_item_marker{
    border-color: {$defaultMarkerColor};}" ); }
if ( $defaultConnectionColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection,
.bold_timeline_container .bold_timeline_item_override_connection_type_line.bold_timeline_item .bold_timeline_item_connection{
    background: {$defaultConnectionColor};}" ); }
if ( $defaultConnectionColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_line_position_left.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection,
.bold_timeline_container_line_position_left.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{
    border-right-color: {$defaultConnectionColor};}" ); }
if ( $defaultConnectionColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_line_position_right.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection,
.bold_timeline_container_line_position_right.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{
    border-left-color: {$defaultConnectionColor};}" ); }
if ( $defaultConnectionColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_line_position_top.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection,
.bold_timeline_container_line_position_top.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{
    border-right-color: {$defaultConnectionColor};}" ); }
if ( $defaultConnectionColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_line_position_bottom.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection,
.bold_timeline_container_line_position_bottom.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{
    border-right-color: {$defaultConnectionColor};}" ); }
if ( $defaultConnectionColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_line_position_center.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection,
.bold_timeline_container_line_position_center.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{border-right-color: {$defaultConnectionColor};
    border-left-color: {$defaultConnectionColor};}" ); }
if ( $defaultIconColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_item_icon_style_outline.bold_timeline_container.bold_timeline_container_item_frame_thickness_thin .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container.bold_timeline_container_item_frame_thickness_thin .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon,
.bold_timeline_container_item_icon_style_outline.bold_timeline_container .bold_timeline_item_override_frame_thickness_thin.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container .bold_timeline_item_override_frame_thickness_thin.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon{-webkit-box-shadow: 0 0 0 1px {$defaultIconColor};
    box-shadow: 0 0 0 1px {$defaultIconColor};}" ); }
if ( $defaultIconColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_item_icon_style_outline.bold_timeline_container_item_frame_thickness_normal .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container_item_frame_thickness_normal .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon,
.bold_timeline_container_item_icon_style_outline.bold_timeline_container .bold_timeline_item_override_frame_thickness_normal.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container .bold_timeline_item_override_frame_thickness_normal.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon{-webkit-box-shadow: 0 0 0 2px {$defaultIconColor};
    box-shadow: 0 0 0 2px {$defaultIconColor};}" ); }
if ( $defaultIconColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_item_icon_style_outline.bold_timeline_container.bold_timeline_container_item_frame_thickness_thick .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container.bold_timeline_container_item_frame_thickness_thick .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon,
.bold_timeline_container_item_icon_style_outline.bold_timeline_container .bold_timeline_item_override_frame_thickness_thick.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container .bold_timeline_item_override_frame_thickness_thick.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon{-webkit-box-shadow: 0 0 0 4px {$defaultIconColor};
    box-shadow: 0 0 0 4px {$defaultIconColor};}" ); }
if ( $defaultIconColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_icon_style_filled .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container .bold_timeline_item_override_icon_style_filled.bold_timeline_item .bold_timeline_item_icon{background: {$defaultIconColor};}" ); }
if ( $defaultIconColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_icon_style_outline .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container .bold_timeline_item_override_icon_style_outline.bold_timeline_item .bold_timeline_item_icon{
    -webkit-box-shadow: 0 0 0 2px {$defaultIconColor};
    box-shadow: 0 0 0 2px {$defaultIconColor};
    color: {$defaultIconColor};}" ); }
if ( $defaultIconColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_item_icon_style_shadow .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon,
.bold_timeline_container .bold_timeline_item_override_icon_style_shadow.bold_timeline_item .bold_timeline_item_icon{
    color: {$defaultIconColor};}" ); }
if ( $defaultSliderNavigationColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container .bold_timeline_slick_dots{
    color: {$defaultSliderNavigationColor};}" ); }
if ( $defaultSliderNavigationColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_slider_arrows_style_filled.bold_timeline_container button.bold_timeline_slick_arrow{
    background: {$defaultSliderNavigationColor};}" ); }
if ( $defaultSliderNavigationColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_slider_arrows_style_filled.bold_timeline_container button.bold_timeline_slick_arrow.slick-disabled:hover{
    background: {$defaultSliderNavigationColor};}" ); }
if ( $defaultSliderNavigationColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_slider_arrows_style_outline.bold_timeline_container button.bold_timeline_slick_arrow{
    border-color: {$defaultSliderNavigationColor};
    color: {$defaultSliderNavigationColor};}" ); }
if ( $defaultLineColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_slider_arrows_style_outline.bold_timeline_container button.bold_timeline_slick_arrow:hover{border-color: {$defaultLineColor};
    color: {$defaultLineColor};}" ); }
if ( $defaultSliderNavigationColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_slider_arrows_style_shadow.bold_timeline_container button.bold_timeline_slick_arrow{
    color: {$defaultSliderNavigationColor};}" ); }
if ( $defaultLineColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container_slider_arrows_style_shadow.bold_timeline_container button.bold_timeline_slick_arrow:hover{border-color: {$defaultLineColor};}" ); }
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_button_style_filled .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner,
.bold_timeline_container .bold_timeline_item_button_style_filled.bold_timeline_item_button .bold_timeline_item_button_inner{background: {$defaultButtonColor};}" ); }
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_button_style_outline .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner,
.bold_timeline_container .bold_timeline_item_button_style_outline.bold_timeline_item_button .bold_timeline_item_button_inner{
    border-color: {$defaultButtonColor};
    color: {$defaultButtonColor};}" ); }
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_button_style_shadow .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner,
.bold_timeline_container .bold_timeline_item_button_style_shadow.bold_timeline_item_button .bold_timeline_item_button_inner{
    color: {$defaultButtonColor};}" ); }
