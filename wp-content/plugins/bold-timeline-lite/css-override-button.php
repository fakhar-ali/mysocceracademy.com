<?php
$boldthemes_crush_vars = Bold_Timeline::$crush_vars;
$boldthemes_crush_vars_def = Bold_Timeline::$crush_vars_def;
if ( isset( $boldthemes_crush_vars['defaultLineColor'] ) ) {
	$defaultLineColor = $boldthemes_crush_vars['defaultLineColor'];
} else {
	$defaultLineColor = "#ff0000";
}
if ( isset( $boldthemes_crush_vars['defaultItemBackgroundColor'] ) ) {
	$defaultItemBackgroundColor = $boldthemes_crush_vars['defaultItemBackgroundColor'];
} else {
	$defaultItemBackgroundColor = "#ffffff";
}
if ( isset( $boldthemes_crush_vars['defaultGroupColor'] ) ) {
	$defaultGroupColor = $boldthemes_crush_vars['defaultGroupColor'];
} else {
	$defaultGroupColor = "#00ff00";
}
if ( isset( $boldthemes_crush_vars['defaultFrameColor'] ) ) {
	$defaultFrameColor = $boldthemes_crush_vars['defaultFrameColor'];
} else {
	$defaultFrameColor = "#00ff00";
}
if ( isset( $boldthemes_crush_vars['defaultButtonColor'] ) ) {
	$defaultButtonColor = $boldthemes_crush_vars['defaultButtonColor'];
} else {
	$defaultButtonColor = "#0ffff0";
}
if ( isset( $boldthemes_crush_vars['defaultIconColor'] ) ) {
	$defaultIconColor = $boldthemes_crush_vars['defaultIconColor'];
} else {
	$defaultIconColor = "#ffff00";
}
if ( isset( $boldthemes_crush_vars['defaultMarkerColor'] ) ) {
	$defaultMarkerColor = $boldthemes_crush_vars['defaultMarkerColor'];
} else {
	$defaultMarkerColor = "#00ff00";
}
if ( isset( $boldthemes_crush_vars['defaultConnectionColor'] ) ) {
	$defaultConnectionColor = $boldthemes_crush_vars['defaultConnectionColor'];
} else {
	$defaultConnectionColor = "#00ff00";
}
if ( isset( $boldthemes_crush_vars['defaultStickerColor'] ) ) {
	$defaultStickerColor = $boldthemes_crush_vars['defaultStickerColor'];
} else {
	$defaultStickerColor = "#ff0000";
}
if ( isset( $boldthemes_crush_vars['defaultSliderNavigationColor'] ) ) {
	$defaultSliderNavigationColor = $boldthemes_crush_vars['defaultSliderNavigationColor'];
} else {
	$defaultSliderNavigationColor = "#fff00f";
}
$css_override = '';
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_button_style_filled .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner,
.bold_timeline_container .bold_timeline_item_button_style_filled.bold_timeline_item_button .bold_timeline_item_button_inner{background: {$defaultButtonColor};}" ); }
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_button_style_outline .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner,
.bold_timeline_container .bold_timeline_item_button_style_outline.bold_timeline_item_button .bold_timeline_item_button_inner{
    border-color: {$defaultButtonColor};
    color: {$defaultButtonColor};}" ); }
if ( $defaultButtonColor != '' ) { $css_override .= sanitize_text_field(".bold_timeline_container.bold_timeline_container_button_style_shadow .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner,
.bold_timeline_container .bold_timeline_item_button_style_shadow.bold_timeline_item_button .bold_timeline_item_button_inner{
    color: {$defaultButtonColor};}" ); }
