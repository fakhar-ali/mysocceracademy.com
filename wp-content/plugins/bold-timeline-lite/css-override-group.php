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
