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
