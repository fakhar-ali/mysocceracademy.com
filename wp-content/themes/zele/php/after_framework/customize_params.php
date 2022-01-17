<?php

/* Remove unused params */

remove_action( 'customize_register', 'boldthemes_customize_blog_side_info' );
remove_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_side_info' );
remove_action( 'customize_register', 'boldthemes_customize_footer_dark_skin' );
remove_action( 'boldthemes_customize_register', 'boldthemes_customize_footer_dark_skin' );


/* GENERAL SECTION 
-------------------------------------------------------------- */

// CREST

if ( ! function_exists( 'boldthemes_customize_crest' ) ) {
	function boldthemes_customize_crest( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[crest]', array(
			'default'           => BoldThemes_Customize_Default::$data['crest'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crest', array(
			'label'    => esc_html__( 'Crest', 'zele' ),
			'description'    => esc_html__( 'Main website crest, displayed in the header area, next to main logo. Crest size should match height defined in Header and Footer > Crest Height (in px).', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[crest]',
			'priority' => 0,
			'context'  => BoldThemesFramework::$pfx . '_crest'
		)));		
	}
}
add_action( 'customize_register', 'boldthemes_customize_crest' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_crest' );


// CREST WIDTH

if ( ! function_exists( 'boldthemes_customize_crest_width' ) ) {
	function boldthemes_customize_crest_width( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[crest_width]', array(
			'default'           => BoldThemes_Customize_Default::$data['crest_width'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));

		$wp_customize->add_control( 'crest_width', array(
			'label'    => esc_html__( 'Crest Width (in px)', 'zele' ),
			'description'    => esc_html__( 'Define the crest height by setting it’s size in pixels (without px unit).', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[crest_width]',
			'priority' => 50,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_crest_width' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_crest_width' );


// STICKY LOGO SIZE

if ( ! function_exists( 'boldthemes_customize_sticky_height' ) ) {
	function boldthemes_customize_sticky_height( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sticky_height]', array(
			'default'           => BoldThemes_Customize_Default::$data['sticky_height'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));

		$wp_customize->add_control( 'sticky_height', array(
			'label'    => esc_html__( 'Sticky Logo Height (in px)', 'zele' ),
			'description'    => esc_html__( 'Define the sticky logo height by setting it’s size in pixels (without px unit)', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[sticky_height]',
			'priority' => 51,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sticky_height' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_sticky_height' );


// VERTICAL FULLSCREEN MENU IMAGE BACKGROUND

if ( ! function_exists( 'boldthemes_customize_menu_background' ) ) {
	function boldthemes_customize_menu_background( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_background]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_background'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'menu_background', array(
			'label'    => esc_html__( 'Fullscreen Menu Background Image', 'zele' ),
			'description'    => esc_html__( 'Set static image as a vertical fullscreen menu background. Minimum recommended size: 1920x1080px', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[menu_background]',
			'priority' => 62,
			'context'  => BoldThemesFramework::$pfx . '_menu_background'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_menu_background' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_menu_background' );


// VERTICAL FULLSCREEN MENU IMAGE BACKGROUND OPACITY

if ( ! function_exists( 'boldthemes_customize_menu_background_opacity' ) ) {
	function boldthemes_customize_menu_background_opacity( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_background_opacity]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_background_opacity'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'menu_background_opacity', array(
			'label'    => esc_html__( 'Fullscreen Menu Background Opacity', 'zele' ),
			'description'    => esc_html__( 'Set opacity for static image which is a vertical fullscreen menu background. Ex. 0.8', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[menu_background_opacity]',
			'priority' => 62,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_menu_background_opacity' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_menu_background_opacity' );



// BACK TO TOP BUTTON

if ( ! function_exists( 'boldthemes_customize_back_to_top' ) ) {
	function boldthemes_customize_back_to_top( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[back_to_top]', array(
			'default'           => BoldThemes_Customize_Default::$data['back_to_top'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'back_to_top', array(
			'label'     => esc_html__( 'Enable Back To Top', 'zele' ),
			'description'    => esc_html__( 'Checking this enables the small feature that shows the styled back to top element at the bottom of the page, which appears after some scrolling.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[back_to_top]',
			'priority'  => 110,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_back_to_top' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_back_to_top' );


// BACK TO TOP TEXT

if ( ! function_exists( 'boldthemes_customize_back_to_top_text' ) ) {
	function boldthemes_customize_back_to_top_text( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[back_to_top_text]', array(
			'default'           => BoldThemes_Customize_Default::$data['back_to_top_text'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'back_to_top_text', array(
			'label'    => esc_html__( 'Back To Top Text', 'zele' ),
			'description'    => esc_html__( 'You can add text to your back to top button, but if you leave it blank you\'ll get only an arrow pointing upwards, which is also nice.', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[back_to_top_text]',
			'priority' => 111,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_back_to_top_text' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_back_to_top_text' );



// CUSTOM 404 IMAGE

if ( ! function_exists( 'boldthemes_customize_image_404' ) ) {
	function boldthemes_customize_image_404( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[image_404]', array(
			'default'           => BoldThemes_Customize_Default::$data['image_404'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'image_404', array(
			'label'    => esc_html__( 'Custom Error 404 Page Image', 'zele' ),
			'description'    => esc_html__( 'Set static image as a background on Error page. Minimum recommended size: 1920x1080px', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[image_404]',
			'priority' => 121,
			'context'  => BoldThemesFramework::$pfx . '_image_404'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_image_404' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_image_404' );




/* TYPO SECTION
-------------------------------------------------------------- */

// BODY WEIGHT

BoldThemes_Customize_Default::$data['default_body_weight'] = 'default';
if ( ! function_exists( 'boldthemes_customize_default_body_weight' ) ) {
	function boldthemes_customize_default_body_weight( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[default_body_weight]', array(
			'default'           => BoldThemes_Customize_Default::$data['default_body_weight'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));

		$wp_customize->add_control( 'default_body_weight', array(
			'label'     		=> esc_html__( 'Body Font Weight', 'zele' ),
			'section'   		=> BoldThemesFramework::$pfx . '_typo_section',
			'settings'  		=> BoldThemesFramework::$pfx . '_theme_options[default_body_weight]',
			'priority'  		=> 98,
			'type'      		=> 'select',
			'choices'   => array(
				'default'		=> esc_html__( 'Default', 'zele' ),
				'thin' 			=> esc_html__( 'Thin', 'zele' ),
				'lighter' 		=> esc_html__( 'Lighter', 'zele' ),
				'light' 		=> esc_html__( 'Light', 'zele' ),
				'normal' 		=> esc_html__( 'Normal', 'zele' ),
				'medium' 		=> esc_html__( 'Medium', 'zele' ),
				'semi-bold' 	=> esc_html__( 'Semi bold', 'zele' ),
				'bold' 			=> esc_html__( 'Bold', 'zele' ),
				'bolder' 		=> esc_html__( 'Bolder', 'zele' ),
				'black' 		=> esc_html__( 'Black', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_default_body_weight' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_default_body_weight' );


// HEADING WEIGHT

BoldThemes_Customize_Default::$data['default_heading_weight'] = 'default';
if ( ! function_exists( 'boldthemes_customize_default_heading_weight' ) ) {
	function boldthemes_customize_default_heading_weight( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[default_heading_weight]', array(
			'default'           => BoldThemes_Customize_Default::$data['default_heading_weight'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));

		$wp_customize->add_control( 'default_heading_weight', array(
			'label'     		=> esc_html__( 'Heading Font Weight', 'zele' ),
			'section'   		=> BoldThemesFramework::$pfx . '_typo_section',
			'settings'  		=> BoldThemesFramework::$pfx . '_theme_options[default_heading_weight]',
			'priority'  		=> 101,
			'type'      		=> 'select',
			'choices'   => array(
				'default'		=> esc_html__( 'Default', 'zele' ),
				'thin' 			=> esc_html__( 'Thin', 'zele' ),
				'lighter' 		=> esc_html__( 'Lighter', 'zele' ),
				'light' 		=> esc_html__( 'Light', 'zele' ),
				'normal' 		=> esc_html__( 'Normal', 'zele' ),
				'medium' 		=> esc_html__( 'Medium', 'zele' ),
				'semi-bold' 	=> esc_html__( 'Semi bold', 'zele' ),
				'bold' 			=> esc_html__( 'Bold', 'zele' ),
				'bolder' 		=> esc_html__( 'Bolder', 'zele' ),
				'black' 		=> esc_html__( 'Black', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_default_heading_weight' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_default_heading_weight' );


// HEADING STYLE

BoldThemes_Customize_Default::$data['heading_style'] = 'default';
if ( ! function_exists( 'boldthemes_customize_heading_style' ) ) {
	function boldthemes_customize_heading_style( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['heading_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));

		$wp_customize->add_control( 'heading_style', array(
			'label'     		=> esc_html__( 'Heading Font Style', 'zele' ),
			'section'   		=> BoldThemesFramework::$pfx . '_typo_section',
			'settings'  		=> BoldThemesFramework::$pfx . '_theme_options[heading_style]',
			'priority'  		=> 102,
			'type'      		=> 'select',
			'choices'   => array(
				'default'		=> esc_html__( 'Default', 'zele' ),
				'italic' 		=> esc_html__( 'Italic', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_style' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_heading_style' );


// SUPERTITLE WEIGHT

BoldThemes_Customize_Default::$data['default_supertitle_weight'] = 'default';
if ( ! function_exists( 'boldthemes_customize_default_supertitle_weight' ) ) {
	function boldthemes_customize_default_supertitle_weight( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[default_supertitle_weight]', array(
			'default'           => BoldThemes_Customize_Default::$data['default_supertitle_weight'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));

		$wp_customize->add_control( 'default_supertitle_weight', array(
			'label'     		=> esc_html__( 'Supertitle Font Weight', 'zele' ),
			'section'   		=> BoldThemesFramework::$pfx . '_typo_section',
			'settings'  		=> BoldThemesFramework::$pfx . '_theme_options[default_supertitle_weight]',
			'priority'  		=> 104,
			'type'      		=> 'select',
			'choices'   => array(
				'default'		=> esc_html__( 'Default', 'zele' ),
				'thin' 			=> esc_html__( 'Thin', 'zele' ),
				'lighter' 		=> esc_html__( 'Lighter', 'zele' ),
				'light' 		=> esc_html__( 'Light', 'zele' ),
				'normal' 		=> esc_html__( 'Normal', 'zele' ),
				'medium' 		=> esc_html__( 'Medium', 'zele' ),
				'semi-bold' 	=> esc_html__( 'Semi bold', 'zele' ),
				'bold' 			=> esc_html__( 'Bold', 'zele' ),
				'bolder' 		=> esc_html__( 'Bolder', 'zele' ),
				'black' 		=> esc_html__( 'Black', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_default_supertitle_weight' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_default_supertitle_weight' );


// SUPERTITLE DASH STYLE

BoldThemes_Customize_Default::$data['supertitle_dash_style'] = 'default';
if ( ! function_exists( 'boldthemes_customize_supertitle_dash_style' ) ) {
	function boldthemes_customize_supertitle_dash_style( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[supertitle_dash_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['supertitle_dash_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));

		$wp_customize->add_control( 'supertitle_dash_style', array(
			'label'     		=> esc_html__( 'Supertitle Top Dash Style', 'zele' ),
			'section'   		=> BoldThemesFramework::$pfx . '_typo_section',
			'settings'  		=> BoldThemesFramework::$pfx . '_theme_options[supertitle_dash_style]',
			'priority'  		=> 105,
			'type'      		=> 'select',
			'choices'   => array(
				'default'	=> esc_html__( 'Default', 'zele' ),
				'skew' 		=> esc_html__( 'Skew', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_supertitle_dash_style' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_supertitle_dash_style' );


// DASH COLOR

BoldThemes_Customize_Default::$data['dash_color'] = '';

if ( ! function_exists( 'boldthemes_customize_dash_color' ) ) {
	function boldthemes_customize_dash_color( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[dash_color]', array(
			'default'           => BoldThemes_Customize_Default::$data['dash_color'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'dash_color', array(
			'label'     => esc_html__( 'Supertitle Top Dash Color', 'zele' ),
			'description'    => esc_html__( 'Define Top Dash color in Blog, Portfolio & Shop Headlines, Page Headline, Widgets etc.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[dash_color]',
			'priority'  => 105,
			'type'      => 'select',
			'choices'   => array(
				''				=> esc_html__( 'Light font, accent background', 'zele' ),
				'dark_accent' 	=> esc_html__( 'Dark font, accent background', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_dash_color' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_dash_color' );


// SUBTITLE WEIGHT

BoldThemes_Customize_Default::$data['default_subtitle_weight'] = 'default';
if ( ! function_exists( 'boldthemes_customize_default_subtitle_weight' ) ) {
	function boldthemes_customize_default_subtitle_weight( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[default_subtitle_weight]', array(
			'default'           => BoldThemes_Customize_Default::$data['default_subtitle_weight'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));

		$wp_customize->add_control( 'default_subtitle_weight', array(
			'label'     		=> esc_html__( 'Subtitle Font Weight', 'zele' ),
			'section'   		=> BoldThemesFramework::$pfx . '_typo_section',
			'settings'  		=> BoldThemesFramework::$pfx . '_theme_options[default_subtitle_weight]',
			'priority'  		=> 107,
			'type'      		=> 'select',
			'choices'   => array(
				'default'		=> esc_html__( 'Default', 'zele' ),
				'thin' 			=> esc_html__( 'Thin', 'zele' ),
				'lighter' 		=> esc_html__( 'Lighter', 'zele' ),
				'light' 		=> esc_html__( 'Light', 'zele' ),
				'normal' 		=> esc_html__( 'Normal', 'zele' ),
				'medium' 		=> esc_html__( 'Medium', 'zele' ),
				'semi-bold' 	=> esc_html__( 'Semi bold', 'zele' ),
				'bold' 			=> esc_html__( 'Bold', 'zele' ),
				'bolder' 		=> esc_html__( 'Bolder', 'zele' ),
				'black' 		=> esc_html__( 'Black', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_default_subtitle_weight' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_default_subtitle_weight' );


// BUTTON FONT

if ( ! function_exists( 'boldthemes_customize_button_font' ) ) {
	function boldthemes_customize_button_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[button_font]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['button_font'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'button_font', array(
			'label'     => esc_html__( 'Button Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[button_font]',
			'priority'  => 108,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_button_font' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_button_font' );


// BUTTON FONT WEIGHT

BoldThemes_Customize_Default::$data['default_button_weight'] = 'default';

if ( ! function_exists( 'boldthemes_customize_default_button_weight' ) ) {
	function boldthemes_customize_default_button_weight( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[default_button_weight]', array(
			'default'           => BoldThemes_Customize_Default::$data['default_button_weight'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'default_button_weight', array(
			'label'     => esc_html__( 'Button Font Weight', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[default_button_weight]',
			'priority'  => 109,
			'type'      => 'select',
			'choices'   => array(
				'default'	=> esc_html__( 'Default', 'zele' ),
				'thin' 		=> esc_html__( 'Thin', 'zele' ),
				'lighter' 	=> esc_html__( 'Lighter', 'zele' ),
				'light' 	=> esc_html__( 'Light', 'zele' ),
				'normal' 	=> esc_html__( 'Normal', 'zele' ),
				'medium' 	=> esc_html__( 'Medium', 'zele' ),
				'semi-bold' => esc_html__( 'Semi bold', 'zele' ),
				'bold' 		=> esc_html__( 'Bold', 'zele' ),
				'bolder' 	=> esc_html__( 'Bolder', 'zele' ),
				'black' 	=> esc_html__( 'Black', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_default_button_weight' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_default_button_weight' );


// MENU WEIGHT

BoldThemes_Customize_Default::$data['default_menu_weight'] = 'default';

if ( ! function_exists( 'boldthemes_customize_default_menu_weight' ) ) {
	function boldthemes_customize_default_menu_weight( $wp_customize ) {

		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[default_menu_weight]', array(
			'default'           => BoldThemes_Customize_Default::$data['default_menu_weight'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'default_menu_weight', array(
			'label'     => esc_html__( 'Menu Font Weight', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[default_menu_weight]',
			'priority'  => 112,
			'type'      => 'select',
			'choices'   => array(
				'default'	=> esc_html__( 'Default', 'zele' ),
				'thin' 		=> esc_html__( 'Thin', 'zele' ),
				'lighter' 	=> esc_html__( 'Lighter', 'zele' ),
				'light' 	=> esc_html__( 'Light', 'zele' ),
				'normal' 	=> esc_html__( 'Normal', 'zele' ),
				'medium' 	=> esc_html__( 'Medium', 'zele' ),
				'semi-bold' => esc_html__( 'Semi bold', 'zele' ),
				'bold' 		=> esc_html__( 'Bold', 'zele' ),
				'bolder' 	=> esc_html__( 'Bolder', 'zele' ),
				'black' 	=> esc_html__( 'Black', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_default_menu_weight' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_default_menu_weight' );


// CAPITALIZE MAIN MENU

BoldThemes_Customize_Default::$data['capitalize_main_menu'] = true;
if ( ! function_exists( 'boldthemes_customize_capitalize_main_menu' ) ) {
	function boldthemes_customize_capitalize_main_menu( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[capitalize_main_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['capitalize_main_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'capitalize_main_menu', array(
			'label'     => esc_html__( 'Capitalize Menu Items', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[capitalize_main_menu]',
			'priority'  => 113,
			'type'      => 'checkbox'
		));
	}
}

add_action( 'customize_register', 'boldthemes_customize_capitalize_main_menu' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_capitalize_main_menu' );



// CAPITALIZE BLOG & SHOP

BoldThemes_Customize_Default::$data['capitalize_headlines'] = true;
if ( ! function_exists( 'boldthemes_customize_capitalize_headlines' ) ) {
	function boldthemes_customize_capitalize_headlines( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[capitalize_headlines]', array(
			'default'           => BoldThemes_Customize_Default::$data['capitalize_headlines'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'capitalize_headlines', array(
			'label'     => esc_html__( 'Capitalize Headlines', 'zele' ),
			'description'    => esc_html__( 'Capitalize Blog, Portfolio, Shop Headlines, Page Headline, Widgets etc.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[capitalize_headlines]',
			'priority'  => 114,
			'type'      => 'checkbox'
		));
	}
}

add_action( 'customize_register', 'boldthemes_customize_capitalize_headlines' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_capitalize_headlines' );







/* Helper function */

if ( ! function_exists( 'zele_body_class' ) ) {
	function zele_body_class( $extra_class ) {
		if ( boldthemes_get_option( 'default_heading_weight' ) ) {
			$extra_class[] =  'btHeadingWeight' . boldthemes_convert_param_to_camel_case ( boldthemes_get_option( 'default_heading_weight' ) );
		}
		if ( boldthemes_get_option( 'heading_style' ) ) {
			$extra_class[] =  'btHeadingStyle' . boldthemes_convert_param_to_camel_case ( boldthemes_get_option( 'heading_style' ) );
		}
		if ( boldthemes_get_option( 'default_supertitle_weight' ) ) {
			$extra_class[] =  'btSupertitleWeight' . boldthemes_convert_param_to_camel_case ( boldthemes_get_option( 'default_supertitle_weight' ) );
		}
		if ( boldthemes_get_option( 'supertitle_dash_style' ) ) {
			$extra_class[] =  'btSupertitleDash' . boldthemes_convert_param_to_camel_case ( boldthemes_get_option( 'supertitle_dash_style' ) );
		}
		if ( boldthemes_get_option( 'default_subtitle_weight' ) ) {
			$extra_class[] =  'btSubtitleWeight' . boldthemes_convert_param_to_camel_case ( boldthemes_get_option( 'default_subtitle_weight' ) );
		}
		if ( boldthemes_get_option( 'default_button_weight' ) ) {
			$extra_class[] =  'btButtonWeight' . boldthemes_convert_param_to_camel_case ( boldthemes_get_option( 'default_button_weight' ) );
		}
		return $extra_class;
	}
}