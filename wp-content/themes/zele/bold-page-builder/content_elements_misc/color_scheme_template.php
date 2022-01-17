<?php

$custom_css = "


	/* Section
	-------------------- */
	
	.bt_bb_section.bt_bb_color_scheme_{$scheme_id} {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}


	/* Column
	-------------------- */
	
	.bt_bb_inner_color_scheme_{$scheme_id}.bt_bb_column .bt_bb_column_content {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}


	/* Inner Column
	-------------------- */
	
	.bt_bb_inner_color_scheme_{$scheme_id}.bt_bb_column_inner .bt_bb_column_inner_content {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}


	/* Headline
	-------------------- */
	
	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} {
		color: {$color_scheme[1]};
	}
	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} em {
		-webkit-text-stroke: 1px {$color_scheme[1]};
	}
	.bt_bb_headline.bt_bb_style_stroke.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_content {
		-webkit-text-stroke: 1px {$color_scheme[1]};
	}


	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline {
		color: {$color_scheme[2]};
	}
	.bt_bb_headline.bt_bb_dash_top_bottom.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline,
	.bt_bb_headline.bt_bb_dash_top.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline {
		color: {$color_scheme[1]};
	}
	.bt_bb_headline.bt_bb_dash_top_bottom.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:before,
	.bt_bb_headline.bt_bb_dash_top.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:before {
		background: {$color_scheme[2]};
	}
	.btSupertitleDash_skew.btSquareButtons .bt_bb_dash_top.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:after,
	.btSupertitleDash_skew.btSquareButtons .bt_bb_dash_top_bottom.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:after {
		background: {$color_scheme[2]};
	}


	.bt_bb_headline.bt_bb_dash_bottom.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_content:after,
	.bt_bb_headline.bt_bb_dash_top_bottom.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_content:after {
		border-color: {$color_scheme[2]};
	}
	.bt_bb_headline.bt_bb_dash_bottom.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline_superheadline {
		color: {$color_scheme[1]};
	}



	.bt_bb_headline.bt_bb_dash_top_bottom.bt_bb_supertitle_color_scheme_{$scheme_id} .bt_bb_headline_superheadline,
	.bt_bb_headline.bt_bb_dash_top.bt_bb_supertitle_color_scheme_{$scheme_id} .bt_bb_headline_superheadline {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_headline.bt_bb_dash_top_bottom.bt_bb_supertitle_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:before,
	.bt_bb_headline.bt_bb_dash_top.bt_bb_supertitle_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:before {
		background: {$color_scheme[2]} !important;
	}
	.btSupertitleDash_skew.btSquareButtons .bt_bb_dash_top.bt_bb_headline.bt_bb_supertitle_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:after,
	.btSupertitleDash_skew.btSquareButtons .bt_bb_dash_top_bottom.bt_bb_headline.bt_bb_supertitle_color_scheme_{$scheme_id} .bt_bb_headline_superheadline:after {
		background: {$color_scheme[2]} !important;
	}
	.bt_bb_headline.bt_bb_dash_top.bt_bb_superheadline.bt_bb_supertitle_color_scheme_{$scheme_id} .btArticleCategories a:not(:first-child):before {
		background: {$color_scheme[1]} !important;
	}
	


	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h1 u:before, .bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h1 u:after,
	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h2 u:before, .bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h2 u:after, 
	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h3 u:before, .bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h3 u:after,
	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h4 u:before,  .bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h4 u:after,
	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h5 u:before, .bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h5 u:after,
	.bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h6 u:before, .bt_bb_headline.bt_bb_color_scheme_{$scheme_id} h6 u:after {
		background-color: {$color_scheme[1]};
	}

	
	


	/* Icons
	-------------------- */
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon a.bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon .bt_bb_icon_holder span {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon:hover a.bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_outline:hover .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled:hover .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless:hover .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon a.bt_bb_icon_holder:hover {
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_outline a.bt_bb_icon_holder:before {
		background-color: transparent;
		box-shadow: 0 0 0 1px {$color_scheme[1]} inset;
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_outline a.bt_bb_icon_holder:hover:before {
		background-color: {$color_scheme[1]};
		box-shadow: 0 0 0 4em {$color_scheme[1]} inset;
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled a.bt_bb_icon_holder:before {
		box-shadow: 0 0 0 4em {$color_scheme[2]} inset;
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled:hover .bt_bb_icon_holder:before {
		box-shadow: 0 0 0 4em {$color_scheme[2]} inset;
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled a.bt_bb_icon_holder:hover:before {
		box-shadow: 0 0 0 0px {$color_scheme[2]} inset;
		background-color: {$color_scheme[1]};
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless a.bt_bb_icon_holder:hover:before {
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_rugged .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_rugged .bt_bb_icon_holder:after {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_rugged a.bt_bb_icon_holder:hover:before {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_rugged a.bt_bb_icon_holder:hover:after {
		color: {$color_scheme[1]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_zig_zag .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_zig_zag .bt_bb_icon_holder:after {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_zig_zag a.bt_bb_icon_holder:hover:before {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_zig_zag a.bt_bb_icon_holder:hover:after {
		color: {$color_scheme[1]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_liquid .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_liquid .bt_bb_icon_holder:after {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_liquid a.bt_bb_icon_holder:hover:before {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_liquid a.bt_bb_icon_holder:hover:after {
		color: {$color_scheme[1]};
	}

	.bt_bb_text_color_scheme_{$scheme_id}.bt_bb_icon .bt_bb_icon_holder span {
		color: {$color_scheme[1]};
	}
	.bt_bb_text_color_scheme_{$scheme_id}.bt_bb_icon a.bt_bb_icon_holder:hover span {
		color: {$color_scheme[2]};
	}
	

	/* Buttons
	-------------------- */


	.bt_bb_button.bt_bb_icon_color_scheme_{$scheme_id} a .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	.bt_bb_button.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a {
		box-shadow: 0 0 0 1px {$color_scheme[1]} inset;
		color: {$color_scheme[1]};
		background-color: transparent;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a:hover {
		box-shadow: 0 0 0 4em {$color_scheme[1]} inset;
		color: {$color_scheme[2]};
	}
	.bt_bb_button.bt_bb_style_outline.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_button.bt_bb_style_outline.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]} !important;
	}


	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a:hover {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a:before {
		background-color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a:after {
		background-color: {$color_scheme[1]};
	}
	.bt_bb_button.bt_bb_style_filled.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_button.bt_bb_style_filled.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]} !important;
	}

	.bt_bb_button.bt_bb_style_clean.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_button.bt_bb_style_clean.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]} !important;
	}


	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_half_filled a {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_half_filled a:hover {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_half_filled a:before {
		background-color: {$color_scheme[2]};
	}
	.bt_bb_button.bt_bb_style_half_filled.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_button.bt_bb_style_half_filled.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]} !important;
	}


	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_skew_filled a {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_skew_filled a:hover {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_skew_filled a:before {
		background-color: {$color_scheme[2]};
	}
	.bt_bb_button.bt_bb_style_skew_filled.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_button.bt_bb_style_skew_filled.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]} !important;
	}


	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_clean a,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless a {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_clean a:hover,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless:hover a {
		color: {$color_scheme[2]};
	}


	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_filled a {
		color: {$color_scheme[1]};
	}
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_filled a:before {
		background-color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_filled a:after {
		background-color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_filled .bt_bb_icon_holder {
		color: {$color_scheme[2]};
		background-color: {$color_scheme[1]};
	}
	
	.bt_bb_button.bt_bb_style_special_filled.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
		background-color: {$color_scheme[2]} !important;
	}
	


	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled_outline a {
		color: {$color_scheme[1]};
	}
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled_outline a:before {
		background-color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled_outline a:after {
		background-color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled_outline .bt_bb_icon_holder {
		color: {$color_scheme[2]};
		border-color: {$color_scheme[2]};
	}
	
	.bt_bb_button.bt_bb_style_filled_outline.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
		border-color: {$color_scheme[1]} !important;
		background-color: transparent !important;
	}
	.bt_bb_button.bt_bb_style_filled_outline.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]} !important;
		border-color: {$color_scheme[1]} !important;
		background-color: {$color_scheme[1]} !important;
	}


	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_skew_filled a {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_skew_filled a:hover {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_skew_filled a:before {
		background-color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_skew_filled a:after {
		background-color: {$color_scheme[1]};
	}
	.bt_bb_button.bt_bb_style_special_skew_filled.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_button.bt_bb_style_special_skew_filled.bt_bb_icon_color_scheme_{$scheme_id} a:hover .bt_bb_icon_holder {
		color: {$color_scheme[2]} !important;
	}
	

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_outline a {
		box-shadow: 0 0 0 1px {$color_scheme[1]} inset;
		color: {$color_scheme[1]};
		background-color: transparent;
	}
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_special_outline .bt_bb_icon_holder {
		color: {$color_scheme[2]};
		background-color: {$color_scheme[1]};
	}
	
	.bt_bb_button.bt_bb_style_special_outline.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]} !important;
		background-color: {$color_scheme[2]} !important;
	}


	.btSoftRoundedButtons .bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled:hover a,
	.btHardRoundedButtons .bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled:hover a,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_shape_round.bt_bb_style_filled:hover a,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_shape_rounded.bt_bb_style_filled:hover a {
		color: {$color_scheme[1]};
	}



	/* Services
	-------------------- */
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder	{
		box-shadow: 0 0 0 1px {$color_scheme[1]} inset;
		color: {$color_scheme[1]};
		background-color: transparent;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
		box-shadow: 0 0 0 1px {$color_scheme[1]} inset;
		color: {$color_scheme[1]};
		background-color: transparent;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline.bt_bb_service a.bt_bb_icon_holder:hover {
		box-shadow: 0 0 0 4em {$color_scheme[1]} inset;
		background-color: {$color_scheme[1]};
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder {
		box-shadow: 0 0 0 4em {$color_scheme[2]} inset;
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder	{
		box-shadow: 0 0 0 4em {$color_scheme[2]} inset;
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled.bt_bb_service a.bt_bb_icon_holder:hover	{
		box-shadow: 0 0 0 0em {$color_scheme[2]} inset;
		background-color: {$color_scheme[1]};
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_borderless.bt_bb_service a.bt_bb_icon_holder:hover {
		color: {$color_scheme[2]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_rugged.bt_bb_service .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_rugged.bt_bb_service .bt_bb_icon_holder:after {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_rugged.bt_bb_service a.bt_bb_icon_holder:hover:before {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_rugged.bt_bb_service a.bt_bb_icon_holder:hover:after {
		color: {$color_scheme[1]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_zig_zag.bt_bb_service .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_zig_zag.bt_bb_service .bt_bb_icon_holder:after {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_zig_zag.bt_bb_service a.bt_bb_icon_holder:hover:before {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_zig_zag.bt_bb_service a.bt_bb_icon_holder:hover:after {
		color: {$color_scheme[1]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_liquid.bt_bb_service .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_liquid.bt_bb_service .bt_bb_icon_holder:after {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_liquid.bt_bb_service a.bt_bb_icon_holder:hover:before {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_liquid.bt_bb_service a.bt_bb_icon_holder:hover:after {
		color: {$color_scheme[1]};
	}


	.bt_bb_title_color_scheme_{$scheme_id}.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title,
	.bt_bb_title_color_scheme_{$scheme_id}.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title a,
	.bt_bb_title_color_scheme_{$scheme_id}.bt_bb_service .bt_bb_service_content .bt_bb_service_content_text,
	.bt_bb_title_color_scheme_{$scheme_id}.bt_bb_service .bt_bb_service_content .bt_bb_service_content_supertitle {
		color: {$color_scheme[1]};
	}
	.bt_bb_title_color_scheme_{$scheme_id}.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title a:hover {
		color: {$color_scheme[2]};
	}



	/* Tabs
	-------------------- */
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline .bt_bb_tabs_header,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled .bt_bb_tabs_header {
		border-color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline .bt_bb_tabs_header li,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled .bt_bb_tabs_header li:hover,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled .bt_bb_tabs_header li.on {
		border-color: {$color_scheme[1]};
		color: {$color_scheme[1]};
		background-color: transparent;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline .bt_bb_tabs_header li:hover,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline .bt_bb_tabs_header li.on,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled .bt_bb_tabs_header li {
		background-color: {$color_scheme[1]};
		color: {$color_scheme[2]};
		border-color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_simple .bt_bb_tabs_header li {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_simple .bt_bb_tabs_header li.on {
		color: {$color_scheme[1]};
		border-color: {$color_scheme[1]};
	}



	/* Accordion
	-------------------- */
	
	.bt_bb_accordion.bt_bb_color_scheme_{$scheme_id} .bt_bb_accordion_item .bt_bb_accordion_item_title {
		color: {$color_scheme[1]};
	}
	.bt_bb_accordion.bt_bb_color_scheme_{$scheme_id} .bt_bb_accordion_item .bt_bb_accordion_item_title:hover {
		color: {$color_scheme[2]};
	}
	.bt_bb_accordion.bt_bb_color_scheme_{$scheme_id} .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
		color: {$color_scheme[1]};
		background: {$color_scheme[2]};
	}


	/* Price List
	-------------------- */
	
	.bt_bb_price_list.bt_bb_color_scheme_{$scheme_id} {
		color: {$color_scheme[1]};
		background: {$color_scheme[2]};
	}
	.bt_bb_price_list.bt_bb_color_scheme_{$scheme_id} .bt_bb_price_list_title .bt_bb_headline .bt_bb_headline_content em {
		-webkit-text-stroke: 1px {$color_scheme[1]} !important;
	}
	.bt_bb_price_list.bt_bb_color_scheme_{$scheme_id} .bt_bb_price_list_title .bt_bb_headline.bt_bb_style_stroke .bt_bb_headline_content {
		-webkit-text-stroke: 1px {$color_scheme[1]} !important;
	}



	/* Card
	-------------------- */
	
	.bt_bb_card_image.bt_bb_color_scheme_{$scheme_id} {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}
	.bt_bb_card_image.bt_bb_color_scheme_{$scheme_id} .bt_bb_card_image_text_box {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_card_image.bt_bb_color_scheme_{$scheme_id} .bt_bb_card_image_text_box .bt_bb_card_image_inner .bt_bb_headline .bt_bb_headline_content em {
		-webkit-text-stroke: 1px {$color_scheme[1]} !important;
	}
	.bt_bb_card_image.bt_bb_color_scheme_{$scheme_id} .bt_bb_card_image_text_box .bt_bb_card_image_inner .bt_bb_headline.bt_bb_style_stroke .bt_bb_headline_content {
		-webkit-text-stroke: 1px {$color_scheme[1]} !important;
	}

	.bt_bb_card_image.bt_bb_content_color_scheme_{$scheme_id} .bt_bb_card_image_text_box {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}
	.bt_bb_card_image.bt_bb_content_color_scheme_{$scheme_id} .bt_bb_card_image_text_box .bt_bb_card_image_inner .bt_bb_headline.bt_bb_style_stroke .bt_bb_headline_content {
		-webkit-text-stroke: 1px {$color_scheme[1]} !important;
	}
	.bt_bb_card_image.bt_bb_content_color_scheme_{$scheme_id} .bt_bb_card_image_text_box .bt_bb_card_image_inner .bt_bb_headline .bt_bb_headline_content em {
		-webkit-text-stroke: 1px {$color_scheme[1]} !important;
	}



	/* Link
	-------------------------------------------------------------------------------- */
	
	.bt_bb_link.bt_bb_color_scheme_{$scheme_id} .bt_bb_link_content .bt_bb_headline a {
		-webkit-text-fill-color: {$color_scheme[1]};
	}
	.bt_bb_link.bt_bb_color_scheme_{$scheme_id}:hover .bt_bb_link_content .bt_bb_headline a:before {
		-webkit-text-fill-color: {$color_scheme[2]};
	}
	.bt_bb_link.bt_bb_color_scheme_{$scheme_id}:hover .bt_bb_link_content .bt_bb_headline a:after {
		color: {$color_scheme[2]};
		-webkit-text-fill-color: {$color_scheme[2]};
	}



	/* Schedule
	-------------------------------------------------------------------------------- */
	.bt_bb_schedule.bt_bb_color_scheme_{$scheme_id} .bt_bb_schedule_title_flex:before,
	.bt_bb_schedule.bt_bb_color_scheme_{$scheme_id} .bt_bb_schedule_content .bt_bb_schedule_inner_row {
		border-color: {$color_scheme[1]};
	}

	.bt_bb_schedule.bt_bb_color_scheme_{$scheme_id} .bt_bb_schedule_content .bt_bb_schedule_inner_row.btToday {
		color: {$color_scheme[2]};
		background-color: {$color_scheme[1]};
		border-color: {$color_scheme[1]};
	}
	.bt_bb_schedule.bt_bb_today_color_scheme_{$scheme_id} .bt_bb_schedule_content .bt_bb_schedule_inner_row.btToday {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
		border-color: {$color_scheme[2]};
	}

	.bt_bb_schedule.bt_bb_color_scheme_{$scheme_id}.btCurrrentDay .bt_bb_schedule_title_flex {
		color: {$color_scheme[2]};
		background-color: {$color_scheme[1]};
	}
	.bt_bb_schedule.bt_bb_today_color_scheme_{$scheme_id}.btCurrrentDay .bt_bb_schedule_title_flex {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}

	.bt_bb_schedule.bt_bb_style_filled.bt_bb_color_scheme_{$scheme_id} .bt_bb_schedule_title_flex {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}
	.bt_bb_schedule.bt_bb_style_filled.bt_bb_color_scheme_{$scheme_id}.btCurrrentDay .bt_bb_schedule_title_flex {
		color: {$color_scheme[2]};
	}
	.bt_bb_schedule.bt_bb_style_filled.bt_bb_today_color_scheme_{$scheme_id}.btCurrrentDay .bt_bb_schedule_title_flex {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}
	.bt_bb_schedule.bt_bb_style_filled.bt_bb_color_scheme_{$scheme_id} .bt_bb_schedule_content {
		color: {$color_scheme[1]};
	}



	/* Google map
	-------------------------------------------------------------------------------- */
	.bt_bb_google_maps.bt_bb_color_scheme_{$scheme_id} .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}



	/* Progress bar
	-------------------------------------------------------------------------------- */
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_progress_bar .bt_bb_progress_bar_bg_cover .bt_bb_progress_bar_bg {
		background-color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_progress_bar .bt_bb_progress_bar_bg_cover .bt_bb_progress_bar_bg .bt_bb_progress_bar_inner {
		color: {$color_scheme[2]};
		background-color: {$color_scheme[1]};
	}



	/* Organic Animation
	-------------------------------------------------------------------------------- */

	.bt_bb_title_color_scheme_{$scheme_id}.bt_bb_organic_animation .item .item__meta .item__meta_inner .item__title {
		color: {$color_scheme[1]};
	}
	.bt_bb_title_color_scheme_{$scheme_id}.bt_bb_organic_animation .item .item__meta .item__meta_inner .item__subtitle {
		color: {$color_scheme[1]};
	}
	.bt_bb_arrow_color_scheme_{$scheme_id}.bt_bb_organic_animation .item .item__meta .item__meta_inner .item__arrow:before {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}
	
";