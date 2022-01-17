<?php


// HEADER AND FOOTER

// HEADER STYLE
if ( ! function_exists( 'boldthemes_customize_header_style' ) ) {
	function boldthemes_customize_header_style( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[header_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['header_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'header_style', array(
			'label'     => esc_html__( 'Header Style', 'zele' ),
			'description'    => esc_html__( 'Select header style for all the pages on the site.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[header_style]',
			'priority'  => 62,
			'type'      => 'select',
			'choices'   => array(
				'transparent-light'  			=> esc_html__( 'Transparent Light', 'zele' ),
				'transparent-dark'   			=> esc_html__( 'Transparent Dark', 'zele' ),
				'special-transparent-light'  	=> esc_html__( 'Special Transparent Light', 'zele' ),
				'dark-transparent-light'  		=> esc_html__( 'Dark + Transparent Light', 'zele' ),
				'accent-transparent-light'  	=> esc_html__( 'Accent + Transparent Light', 'zele' ),
				'accent-dark' 					=> esc_html__( 'Accent + Dark', 'zele' ),
				'accent-light' 					=> esc_html__( 'Light + Accent ', 'zele' ),
				'light-accent' 					=> esc_html__( 'Accent + Light', 'zele' ),
				'light-dark' 					=> esc_html__( 'Light + Dark', 'zele' ),
				'hidden' 						=> esc_html__( 'Hidden', 'zele' )
			)
		));
	}
}


// MENU TYPE
if ( ! function_exists( 'boldthemes_customize_menu_type' ) ) {
	function boldthemes_customize_menu_type( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_type]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_type'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'menu_type', array(
			'label'     => esc_html__( 'Menu Type', 'zele' ),
			'description'    => esc_html__( 'Set the menu layout for all the pages on the site. Menu can be horizontal, in line with logo or below logo, or vertical on left or right, or fullscreen vertical hidden by default.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[menu_type]',
			'priority'  => 60,
			'type'      => 'select',
			'choices'   => array(
				'horizontal-left'			=> esc_html__( 'Horizontal Left', 'zele' ),
				'horizontal-center'			=> esc_html__( 'Horizontal Centered', 'zele' ),
				'horizontal-right'			=> esc_html__( 'Horizontal Right', 'zele' ),
				'horizontal-below-left'		=> esc_html__( 'Horizontal Left Below Logo', 'zele' ),
				'horizontal-below-center'	=> esc_html__( 'Horizontal Center Below Logo', 'zele' ),
				'horizontal-below-right'	=> esc_html__( 'Horizontal Right Below Logo', 'zele' ),
				'vertical-left'				=> esc_html__( 'Vertical Left', 'zele' ),
				'vertical-right'			=> esc_html__( 'Vertical Right', 'zele' ),
				'vertical-fullscreen'		=> esc_html__( 'Vertical Full Screen', 'zele' )
			)
		));
	}
}


// SUPERTITLE HEADING FONT
if ( ! function_exists( 'boldthemes_customize_heading_supertitle_font' ) ) {
	function boldthemes_customize_heading_supertitle_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_supertitle_font]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['heading_supertitle_font'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'heading_supertitle_font', array(
			'label'     => esc_html__( 'Supertitle Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_supertitle_font]',
			'priority'  => 103,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}

// HEADING SUBTITLE FONT
if ( ! function_exists( 'boldthemes_customize_heading_subtitle_font' ) ) {
	function boldthemes_customize_heading_subtitle_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_subtitle_font]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['heading_subtitle_font'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'heading_subtitle_font', array(
			'label'     => esc_html__( 'Subtitle Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_subtitle_font]',
			'priority'  => 106,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}


// BUTTONS SHAPE
if ( ! function_exists( 'boldthemes_customize_heading_buttons_shape' ) ) {
	function boldthemes_customize_heading_buttons_shape( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[buttons_shape]', array(
			'default'           => BoldThemes_Customize_Default::$data['buttons_shape'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'buttons_shape', array(
			'label'     => esc_html__( 'Buttons Shape', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[buttons_shape]',
			'priority'  => 110,
			'type'      => 'select',
			'choices'   => array(
				'hard-rounded' => esc_html__( 'Hard Rounded', 'zele' ),
				'soft-rounded' => esc_html__( 'Soft Rounded', 'zele' ),
				'square' => esc_html__( 'Square', 'zele' )			
			)
		));
	}
}

// MENU FONT
if ( ! function_exists( 'boldthemes_customize_heading_menu_font' ) ) {
	function boldthemes_customize_heading_menu_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_font]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['menu_font'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'menu_font', array(
			'label'     => esc_html__( 'Menu Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[menu_font]',
			'priority'  => 111,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}


