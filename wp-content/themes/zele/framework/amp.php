<?php
/*
*
*	Custom Styles in AMP
*
*/


add_action( 'amp_post_template_css', 'boldthemes_amp_additional_css_styles', 11 );

if ( ! function_exists( 'boldthemes_amp_additional_css_styles' )) {
	function boldthemes_amp_additional_css_styles( $amp_template ) {
		
		// Get Customize CSS 

		$body_font	=  urldecode(boldthemes_get_option('body_font'));
		if (  $body_font == 'no_change' ){
			$body_font	= BoldThemes_Customize_Default::$data['body_font'];
		}

		$heading_font =  urldecode(boldthemes_get_option('heading_font'));
		if (  $heading_font == 'no_change' ){
			$heading_font	=  BoldThemes_Customize_Default::$data['heading_font'];
		}

		$accent_color	 =  boldthemes_get_option('accent_color');
		if ( '' === $accent_color ){
			$accent_color = BoldThemes_Customize_Default::$data['accent_color'];
		}

		$alternate_color =  boldthemes_get_option('alternate_color');
		if ( '' === $alternate_color ){
			$alternate_color = BoldThemes_Customize_Default::$data['alternate_color'];
		}

		$accent_color_amp		 = boldthemes_sanitize_hex_text_color( 'text_color' );	
		$alternate_color_amp	 = boldthemes_sanitize_hex_text_color( 'text_color' );	

		$theme_color             = boldthemes_sanitize_hex_text_color( 'theme_color' );
		$text_color              = boldthemes_sanitize_hex_text_color( 'text_color' );
		$muted_text_color        = boldthemes_sanitize_hex_text_color( 'muted_text_color' );
		$border_color            = boldthemes_sanitize_hex_text_color( 'border_color' );
		$link_color              = boldthemes_sanitize_hex_text_color( 'link_color' );
		$header_background_color = boldthemes_sanitize_hex_text_color( 'header_background_color' );
		$header_color            = boldthemes_sanitize_hex_text_color( 'header_color' );

		?>
		
		html {
			background: white;
		}
		body {
			color: #181818;
			font: 16px/26px <?php echo esc_html( $body_font ); ?>;
		}
		header.amp-wp-header {
			border-top: none;
			box-shadow: 0 0 20px 0 rgba(0,0,0,.15);
			background: none; 
		}
		.amp-wp-title {
			font-family: <?php echo esc_html( $heading_font ); ?>;
			line-height: 1em;
			font-size: 2em;
			margin: 0 0 .5em;
			padding: 0 0 .5em;
			border-bottom: 1px solid rgba(0,0,0,.1);
		}
		.amp-wp-header .amp-wp-site-icon {
			position: relative;
			right: auto;
			border: none;
			border-radius: 0%;
			margin-right: 5px;
		}
		.amp-wp-header .amp-site-title {
			color: black; 
			font-size: 18px;
			line-height: 32px;
			font-weight: bold;
		}
		.amp-wp-article-featured-image {
			margin-bottom: 30px;
		}
		.amp-wp-article-content {
			margin: 0 30px 30px;
			border-bottom: 1px solid rgba(0,0,0,.1);
		}
		.amp-wp-meta {
			font-size: .6875em;
		}
		.amp-wp-byline amp-img {
			border: 2px solid rgba(0,0,0,.1);
		}
		blockquote {
			font-family: <?php echo esc_html( $heading_font ); ?>;
			background: transparent;
			border: 0;
			border-top: 3px solid rgba(0,0,0,.1);
			border-bottom: 3px solid rgba(0,0,0,.1);
			padding: .475em 0 .475em 3.5em;
			position: relative;
			font-size: 1.125em;
			line-height: 1.75em;
		}
		blockquote:before {
			content: '”';
			opacity: .4;
			font-family: Roboto Slab;
			display: block;
			font-size: 4.5em;
			font-weight: 900;
			line-height: 1;
			position: absolute;
			top: 4px;
			left: 14px;
		}


		a {
			color: <?php echo esc_html( $accent_color ); ?>;
			transition: color 300ms ease;
		}

		a:hover,
		a:active,
		a:focus {
			color: <?php echo esc_html( $accent_color ); ?>;
			transition: color 300ms ease;
		}
		.amp-wp-tax-category, .amp-wp-tax-tag {
			margin: 1.5em 30px;
		}
		.amp-wp-tax-category a {
			background: <?php echo esc_html( $accent_color ); ?>;
			color: #FFF;
			text-decoration: none;
			text-transform: uppercase;
			padding: .625em 1em;
			border-radius: 2px;
			transition: opacity 300ms ease;
			margin-right: -3px;
		}
		.amp-wp-tax-category a:hover,
		.amp-wp-tax-category a:active,
		.amp-wp-tax-category a:focus {
			background: <?php echo esc_html( $alternate_color ); ?>;
		}
		.amp-wp-tax-tag a {
			color: #181818;
			background: rgba(0,0,0,.1);
			text-decoration: none;
			padding: .625em 1em;
			border-radius: 2px;
			transition: background 300ms ease, color 300ms ease;
			margin-right: -3px;
		}
		.amp-wp-tax-tag a:hover,
		.amp-wp-tax-tag a:active,
		.amp-wp-tax-tag a:focus {
			background: #181818;
			color: #FFF;
			transition: background 300ms ease, color 300ms ease;
		}
		.amp-wp-comments-link a {
			text-transform: uppercase;
			background: <?php echo esc_html( $accent_color ); ?>;
			color: #FFF;
			box-shadow: 0 1px 5px rgba(0,0,0,.35);
			border: 0;
			border-radius: 2px;
			transition: background 300ms ease;
			padding: .675em .923em;
			font-size: 12px;
		}
		.amp-wp-comments-link a:hover,
		.amp-wp-comments-link a:active,
		.amp-wp-comments-link a:focus {
			background: <?php echo esc_html( $alternate_color ); ?>;
			transition: background 300ms ease;
		}

		.amp-wp-footer {
			background: #181818;
			box-shadow: #0c0c0c 0 -40px 0 0 inset;
			color: #FFF;
			border: 0;
			border-bottom: 4px solid <?php echo esc_html( $accent_color ); ?>;
		}
		.amp-wp-footer div {
			padding: 1.5em 30px .5em;
		}
		.amp-wp-footer h2 {
			text-indent: -999999px;
			background-size: contain;
			margin: 0 0 2em;
		}
		.amp-wp-footer a {
			color: #FFF;
		}
		.back-to-top {
			bottom: 4px;
			text-transform: uppercase;
		}

		<?php
	}	
}


/*
*
*	Loading fonts in AMP
*
*/

add_action( 'amp_post_template_head', 'boldthemes_amp_post_template_add_fonts' );

if ( ! function_exists( 'boldthemes_amp_additional_css_styles' )) {

	function boldthemes_amp_post_template_add_fonts( ) {

		$body_font	=  urldecode(boldthemes_get_option('body_font'));
		if (  $body_font == 'no_change' ){
			$body_font	= BoldThemes_Customize_Default::$data['body_font'];
		}

		$heading_font =  urldecode(boldthemes_get_option('heading_font'));
		if (  $heading_font == 'no_change' ){
			$heading_font	=  BoldThemes_Customize_Default::$data['heading_font'];
		}

		if ( $body_font != 'no_change' ) {
			$url_body_font = $body_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			$body_font_state = _x( 'on', $body_font . ' font: on or off', 'zele' );
			if ( 'off' !== $body_font_state ) {
				$url_body_font = $body_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}

		if ( $heading_font != 'no_change' ) {
			$url_heading_font = $heading_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			$heading_font_state = _x( 'on', $heading_font . ' font: on or off', 'zele' );
			if ( 'off' !== $heading_font_state ) {
				$url_heading_font = $heading_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}
		
		$url_body_font		= 'https://fonts.googleapis.com/css?family=' . $url_body_font;
		$url_heading_font	= 'https://fonts.googleapis.com/css?family=' . $url_heading_font;
		
		?>
			<link rel="stylesheet" href="<?php echo  esc_url( $url_body_font ); ?>" type='text/css'>
			<link rel="stylesheet" href="<?php echo  esc_url( $url_heading_font ); ?>" type='text/css'>
		<?php

		$meta_tags = array(
			sprintf( '<link rel="icon" href="%s" sizes="32x32" />', esc_url( get_site_icon_url( 32 ) ) ),
			sprintf( '<link rel="icon" href="%s" sizes="192x192" />', esc_url( get_site_icon_url( 192 ) ) ),
			sprintf( '<link rel="apple-touch-icon-precomposed" href="%s" />', esc_url( get_site_icon_url( 180 ) ) ),
			sprintf( '<meta name="msapplication-TileImage" content="%s" />', esc_url( get_site_icon_url( 270 ) ) ),
		);
		
		foreach ( $meta_tags as $meta_tag ) {
			echo "$meta_tag\n";
		}
	}	
}

/*
*
*	Helper function for colors in AMP
*
*/

if ( ! function_exists( 'boldthemes_sanitize_hex_text_color' ) ) {
	function boldthemes_sanitize_hex_text_color( $amp_customizer_setting = 'text_color' ) {
	
		$template = new AMP_Post_Template( get_queried_object_id() );
		$color	  = $template->get_customizer_setting( $amp_customizer_setting );
		
		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}else{
			return '';
		}
		
	}
}






