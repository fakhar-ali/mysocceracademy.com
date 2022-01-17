<?php
if ( ! class_exists( 'BoldThemes_Customize_Default' ) ) {
  
	class BoldThemes_Customize_Default {

		public static $data = array(
		
			// GENERAL SETTINGS
			
			'logo'                      => '',
			'alt_logo'                  => '',
			'accent_color'              => '',
			'alternate_color'           => '',
			'page_background'           => '',
			'page_width'                => 'no_change',
			'hide_headline'             => false,
			'supertitle_position'     	=> 'outside',
			'template_skin'             => 'light',
			'sidebar'                   => 'right',
			'sidebar_use_dash'          => false,
			'disable_preloader'         => true,
			'preloader_text'            => '',
			'autoplay_interval'         => '',
			'custom_js'                 => '',
			
			// HEADER AND FOOTER
			
			'logo_height'               => '',
			'menu_type'                 => 'horizontal-right',
			'boxed_menu'                => true,
			'header_style'				=> 'transparent-dark',
			'below_menu'                => false,
			'sticky_header'             => false,
			'hide_menu'                 => false,
			'footer_dark_skin'          => false,
			'custom_text'               => '',
			'footer_page_slug'          => '',
			
			// TYPOGRAPHY
			
			'body_font'                 => 'no_change',
			'heading_font'              => 'no_change',
			'heading_supertitle_font'   => 'no_change',
			'heading_subtitle_font'     => 'no_change',
			'menu_font'                 => 'no_change',

			'buttons_shape' 			=> 'square',
			
			// BLOG
			
			'blog_grid_gallery_columns' => '3',
			'blog_grid_gallery_gap'     => 'small',
			'blog_list_view'            => 'standard',
			'blog_single_view'          => 'standard',
			'blog_author'               => true,
			'blog_date'                 => true,
			'blog_side_info'            => false,
			'blog_author_info'          => false,
		    'blog_share_facebook'       => false,
		    'blog_share_twitter'        => false,
		    'blog_share_linkedin'       => false,
		    'blog_share_vk'             => false,
		    'blog_share_whatsapp'       => false,
		    'blog_use_dash'             => false,
		    'blog_settings_page_slug'   => '',
			
			// PORTFOLIO
			
			'pf_grid_gallery_columns'   => '4',
			'pf_grid_gallery_gap'       => 'small',
			'pf_list_view'            	=> 'standard',
			'pf_single_view'            => 'standard',
			'pf_share_facebook'         => false,
			'pf_share_twitter'          => false,
			'pf_share_linkedin'         => false,
			'pf_share_vk'               => false,
			'pf_share_whatsapp'          => false,
			'pf_use_dash'               => false,
			'pf_settings_page_slug'     => '',
			'pf_slug'     				=> '',
			'pf_category_slug'     		=> '',

			// SHOP
			
			'shop_share_facebook'       => false,
			'shop_share_twitter'        => false,
			'shop_share_linkedin'       => false,
			'shop_share_vk'             => false,
			'shop_share_whatsapp'        => false,
			'shop_use_dash'             => false,
			'shop_settings_page_slug'   => ''	
		
		);
	}
}

if ( ! function_exists( 'boldthemes_custom_controls' ) ) {
	function boldthemes_custom_controls() {
		class BoldThemes_Customize_Textarea_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value()); ?></textarea>
				</label>
				<?php
			}
		}
		
		class BoldThemes_Reset_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<div style="margin: 5px 0px 10px 0px">
				<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>			
					<input type="submit" onclick="var c = confirm('<?php echo esc_js( esc_html__( 'Reset theme settings to default values?', 'zele' ) ); ?>'); if (c != true) return false;var href=window.location.href;if (href.indexOf('?') > -1) {window.location.replace(href + '&boldthemes_reset=reset')} else {window.location.replace(href + '?boldthemes_reset=reset')};return false;" name="boldthemes_reset" id="boldthemes_reset" class="button" value="Reset">
				</div>
				<?php
			}
		}
	}
}
add_action( 'customize_register', 'boldthemes_custom_controls' );
add_action( 'boldthemes_customize_register', 'boldthemes_custom_controls' );

if ( ! function_exists( 'boldthemes_custom_text' ) ) {
	function boldthemes_custom_text( $text ) {
		return $text;
	}
}

if ( ! function_exists( 'boldthemes_custom_js' ) ) {
	function boldthemes_custom_js( $js ) {
		return trim( $js );
	}
}

if ( ! function_exists( 'boldthemes_customize_register' ) ) {
	function boldthemes_customize_register( $wp_customize ) {
		
		global $wpdb;
		
		if ( isset( $_GET['boldthemes_reset'] ) && $_GET['boldthemes_reset'] == 'reset' ) {
			$wpdb->query( $wpdb->prepare( "delete from " . $wpdb->options . " where option_name = %s", BoldThemesFramework::$pfx . '_theme_options' ) );
			header( 'Location: ' . wp_customize_url() );
		}

		$wp_customize->remove_section( 'colors' );
		
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_general_section' , array(
			'title'      => esc_html__( 'General Settings', 'zele' ),
			'priority'   => 10,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_header_footer_section' , array(
			'title'      => esc_html__( 'Header and Footer', 'zele' ),
			'priority'   => 20,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_typo_section' , array(
			'title'      => esc_html__( 'Typography', 'zele' ),
			'description'    => esc_html__( 'Set the font family applied throughout the website. Theme uses Google webfonts.', 'zele' ),
			'priority'   => 30,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_blog_section' , array(
			'title'      => esc_html__( 'Blog', 'zele' ),
			'priority'   => 40,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_pf_section' , array(
			'title'      => esc_html__( 'Portfolio', 'zele' ),
			'priority'   => 50,
		));
		$wp_customize->add_section( BoldThemesFramework::$pfx . '_shop_section' , array(
			'title'      => esc_html__( 'Shop', 'zele' ),
			'priority'   => 60,
		));

		require_once( get_parent_theme_file_path( 'framework/web_fonts.php' ) );
	}
}
add_action( 'customize_register', 'boldthemes_customize_register' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_register' );



/* GENERAL SETTINGS */

// LOGO
if ( ! function_exists( 'boldthemes_customize_logo' ) ) {
	function boldthemes_customize_logo( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[logo]', array(
			'default'           => BoldThemes_Customize_Default::$data['logo'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
			'label'    => esc_html__( 'Logo', 'zele' ),
			'description'    => esc_html__( 'Main website logo, displayed in the header area, on Preloader screen and on Sticky Header. Logo size should match height defined in Header and Footer > Logo Height (in px).', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[logo]',
			'priority' => 20,
			'context'  => BoldThemesFramework::$pfx . '_logo'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_logo' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_logo' );

// ALTERNATE LOGO
if ( ! function_exists( 'boldthemes_customize_alt_logo' ) ) {
	function boldthemes_customize_alt_logo( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[alt_logo]', array(
			'default'           => BoldThemes_Customize_Default::$data['alt_logo'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'alt_logo', array(
			'label'    => esc_html__( 'Alternate Sticky Header Logo', 'zele' ),
			'description'    => esc_html__( 'If defined, used on top of the page when Content Below Menu and Sticky Header options are activated.', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[alt_logo]',
			'priority' => 22,
			'context'  => BoldThemesFramework::$pfx . '_alt_logo'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_alt_logo' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_alt_logo' );

// ACCENT COLOR
if ( ! function_exists( 'boldthemes_customize_accent_color' ) ) {
	function boldthemes_customize_accent_color( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[accent_color]', array(
			'default'        	   => BoldThemes_Customize_Default::$data['accent_color'],
			'type'           	   => 'option',
			'capability'     	   => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
			'label'    => esc_html__( 'Primary Accent Color', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[accent_color]',
			'priority' => 26,
			'context'  => BoldThemesFramework::$pfx . '_accent_color'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_accent_color' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_accent_color' );

// ALTERNATE COLOR
if ( ! function_exists( 'boldthemes_customize_alternate_color' ) ) {
	function boldthemes_customize_alternate_color( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[alternate_color]', array(
			'default'        	   => BoldThemes_Customize_Default::$data['alternate_color'],
			'type'           	   => 'option',
			'capability'     	   => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alternate_color', array(
			'label'    => esc_html__( 'Secondary Accent Color', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[alternate_color]',
			'priority' => 26,
			'context'  => BoldThemesFramework::$pfx . 'alternate_color'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_alternate_color' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_alternate_color' );

// PAGE BACKGROUND
if ( ! function_exists( 'boldthemes_customize_page_background' ) ) {
	function boldthemes_customize_page_background( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[page_background]', array(
			'default'           => BoldThemes_Customize_Default::$data['page_background'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'page_background', array(
			'label'    => esc_html__( 'Page Background', 'zele' ),
			'description'    => esc_html__( 'Set static image as a site background. Minimum recommended size: 1920x1080px', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[page_background]',
			'priority' => 27,
			'context'  => BoldThemesFramework::$pfx . '_page_background'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_page_background' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_page_background' );

// PAGE WIDTH
if ( ! function_exists( 'boldthemes_customize_page_width' ) ) {
	function boldthemes_customize_page_width( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[page_width]', array(
			'default'           => BoldThemes_Customize_Default::$data['page_width'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'page_width', array(
			'label'     => esc_html__( 'Page Width', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[page_width]',
			'priority'  => 95,
			'type'      => 'select',
			'choices'   => array(
				'no_change' => esc_html__( 'Default', 'zele' ),
				'boxed' 	=> esc_html__( 'Boxed', 'zele' )	
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_page_width' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_page_width' );

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
			'description'    => esc_html__( 'Select header style for all the pages with default header turned on.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[header_style]',
			'priority'  => 62,
			'type'      => 'select',
			'choices'   => array(
				'transparent-light'  	=> esc_html__( 'Transparent Light', 'zele' ),
				'transparent-dark'   	=> esc_html__( 'Transparent Dark', 'zele' ),
				'accent-dark' 			=> esc_html__( 'Accent + Dark', 'zele' ),
				'accent-light' 			=> esc_html__( 'Light + Accent ', 'zele' ),
				'light-accent' 			=> esc_html__( 'Accent + Light', 'zele' ),
				'light-dark' 			=> esc_html__( 'Light + Dark', 'zele' ),				
				'hidden' 				=> esc_html__( 'Hidden', 'zele' )				
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_header_style' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_header_style' );

// HIDE HEADLINE
if ( ! function_exists( 'boldthemes_customize_hide_headline' ) ) {
	function boldthemes_customize_hide_headline( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[hide_headline]', array(
				'default'           => BoldThemes_Customize_Default::$data['hide_headline'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'hide_headline', array(
				'label'    => esc_html__( 'Hide Default Headline', 'zele' ),
				'section'  => BoldThemesFramework::$pfx . '_general_section',
				'settings' => BoldThemesFramework::$pfx . '_theme_options[hide_headline]',
				'priority' => 64,
				'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_hide_headline' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_hide_headline' );

// SUPERHEADLINE POSITION
if ( ! function_exists( 'boldthemes_customize_supertitle_position' ) ) {
	function boldthemes_customize_supertitle_position( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[supertitle_position]', array(
				'default'           => BoldThemes_Customize_Default::$data['supertitle_position'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'supertitle_position', array(
				'label'    => esc_html__( 'Default Headline Supertitle Outside of H Tag', 'zele' ),
				'section'  => BoldThemesFramework::$pfx . '_general_section',
				'settings' => BoldThemesFramework::$pfx . '_theme_options[supertitle_position]',
				'priority' => 64,
				'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_supertitle_position' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_supertitle_position' );

// TEMPLATE SKIN
if ( ! function_exists( 'boldthemes_customize_template_skin' ) ) {
	function boldthemes_customize_template_skin( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[template_skin]', array(
			'default'           => BoldThemes_Customize_Default::$data['template_skin'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'template_skin', array(
			'label'    => esc_html__( 'Template skin', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[template_skin]',
			'priority' => 80,
			'type'      => 'select',
			'choices'   => array(
				'light'     => esc_html__( 'Light', 'zele' ),
				'dark'      => esc_html__( 'Dark', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_template_skin' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_template_skin' );

// SIDEBAR
if ( ! function_exists( 'boldthemes_customize_sidebar' ) ) {
	function boldthemes_customize_sidebar( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sidebar]', array(
			'default'           => BoldThemes_Customize_Default::$data['sidebar'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'sidebar', array(
			'label'     => esc_html__( 'Sidebar', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[sidebar]',
			'priority'  => 93,
			'type'      => 'select',
			'choices'   => array(
				'no_sidebar' => esc_html__( 'No Sidebar', 'zele' ),
				'left'       => esc_html__( 'Left', 'zele' ),
				'right'      => esc_html__( 'Right', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sidebar' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_sidebar' );

// USE DASH SIDEBAR
if ( ! function_exists( 'boldthemes_customize_sidebar_use_dash' ) ) {
	function boldthemes_customize_sidebar_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sidebar_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['sidebar_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'sidebar_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Template Headlines', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[sidebar_use_dash]',
			'priority' => 98,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sidebar_use_dash' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_sidebar_use_dash' );

// DISABLE PRELOADER
if ( ! function_exists( 'boldthemes_customize_disable_preloader' ) ) {
	function boldthemes_customize_disable_preloader( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[disable_preloader]', array(
			'default'           => BoldThemes_Customize_Default::$data['disable_preloader'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'disable_preloader', array(
			'label'    => esc_html__( 'Disable Preloader', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[disable_preloader]',
			'priority' => 101,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_disable_preloader' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_disable_preloader' );

// PRELOADER TEXT
if ( ! function_exists( 'boldthemes_customize_preloader_text' ) ) {
	function boldthemes_customize_preloader_text( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[preloader_text]', array(
			'default'           => BoldThemes_Customize_Default::$data['preloader_text'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'preloader_text', array(
			'label'    => esc_html__( 'Preloader Text', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[preloader_text]',
			'priority' => 102,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_preloader_text' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_preloader_text' );

// RESET
if ( ! function_exists( 'boldthemes_customize_reset' ) ) {
	function boldthemes_customize_reset( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[reset]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BoldThemes_Reset_Control( $wp_customize, 'reset', array(
			'label'    => esc_html__( 'Reset Theme Settings', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'priority' => 150,
			'settings' => BoldThemesFramework::$pfx . '_theme_options[reset]'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_reset' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_reset' );

/* HEADER AND FOOTER */

// LOGO HEIGHT
if ( ! function_exists( 'boldthemes_customize_logo_height' ) ) {
	function boldthemes_customize_logo_height( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[logo_height]', array(
			'default'           => BoldThemes_Customize_Default::$data['logo_height'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'logo_height', array(
			'label'    => esc_html__( 'Logo Height (in px)', 'zele' ),
			'description'    => esc_html__( 'Define the logo height by setting it’s size in pixels (without px unit).', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[logo_height]',
			'priority' => 50,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_logo_height' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_logo_height' );

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
			'description'    => esc_html__( 'Set the menu layout for all the pages on the site. Menu can be horizontal, in line with logo or below logo, or vertical, on left or right.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[menu_type]',
			'priority'  => 60,
			'type'      => 'select',
			'choices'   => array(
				'horizontal-left'       => esc_html__( 'Horizontal Left', 'zele' ),
				'horizontal-center'     => esc_html__( 'Horizontal Centered', 'zele' ),
				'horizontal-right'      => esc_html__( 'Horizontal Right', 'zele' ),
				'horizontal-below-left'  => esc_html__( 'Horizontal Left Below Logo', 'zele' ),
				'horizontal-below-center'  => esc_html__( 'Horizontal Center Below Logo', 'zele' ),
				'horizontal-below-right' => esc_html__( 'Horizontal Right Below Logo', 'zele' ),
				'vertical-left'       => esc_html__( 'Vertical Left', 'zele' ),
				'vertical-right'      => esc_html__( 'Vertical Right', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_menu_type' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_menu_type' );

// BOXED MENU
if ( ! function_exists( 'boldthemes_customize_boxed_menu' ) ) {
	function boldthemes_customize_boxed_menu( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[boxed_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['boxed_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'boxed_menu', array(
			'label'    => esc_html__( 'Boxed Menu', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[boxed_menu]',
			'priority' => 65,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_boxed_menu' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_boxed_menu' );

// BELOW MENU
if ( ! function_exists( 'boldthemes_customize_below_menu' ) ) {
	function boldthemes_customize_below_menu( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[below_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['below_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'below_menu', array(
			'label'    => esc_html__( 'Show Content Below Menu', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[below_menu]',
			'priority' => 70,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_below_menu' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_below_menu' );

// STICKY HEADER
if ( ! function_exists( 'boldthemes_customize_sticky_header' ) ) {
	function boldthemes_customize_sticky_header( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[sticky_header]', array(
			'default'           => BoldThemes_Customize_Default::$data['sticky_header'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'sticky_header', array(
			'label'    => esc_html__( 'Use Sticky Header', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[sticky_header]',
			'priority' => 80,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_sticky_header' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_sticky_header' );

// HIDE MENU
if ( ! function_exists( 'boldthemes_customize_hide_menu' ) ) {
	function boldthemes_customize_hide_menu( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[hide_menu]', array(
			'default'           => BoldThemes_Customize_Default::$data['hide_menu'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'hide_menu', array(
			'label'    => esc_html__( 'Hide Menu on Load', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[hide_menu]',
			'priority' => 80,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_hide_menu' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_hide_menu' );

// FOOTER DARK SKIN
if ( ! function_exists( 'boldthemes_customize_footer_dark_skin' ) ) {
	function boldthemes_customize_footer_dark_skin( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[footer_dark_skin]', array(
			'default'           => BoldThemes_Customize_Default::$data['footer_dark_skin'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footer_dark_skin', array(
			'label'    => esc_html__( 'Use Dark Skin in Footer', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[footer_dark_skin]',
			'priority' => 80,
			'type'     => 'checkbox'
		));	
	}
}
add_action( 'customize_register', 'boldthemes_customize_footer_dark_skin' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_footer_dark_skin' );

// FOOTER CUSTOM TEXT
if ( ! function_exists( 'boldthemes_customize_custom_text' ) ) {
	function boldthemes_customize_custom_text( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[custom_text]', array(
			'default'           => BoldThemes_Customize_Default::$data['custom_text'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'custom_text', array(
			'label'    => esc_html__( 'Custom Footer Text', 'zele' ),
			'description'    => esc_html__( 'Enter any text shown in footer (e.g. Copyright notice).', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[custom_text]',
			'priority' => 120,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_custom_text' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_custom_text' );

// FOOTER PAGE
if ( ! function_exists( 'boldthemes_customize_footer_page_slug' ) ) {
	function boldthemes_customize_footer_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[footer_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['footer_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'footer_page_slug', array(
			'label'    => esc_html__( 'Footer Page', 'zele' ),
			'description'    => esc_html__( 'Use static page with content as a footer template for all pages. Select the page that serves as a template for footer.', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[footer_page_slug]',
			'priority' => 120,
			'type'      => 'select',
			'choices'   => boldthemes_get_all_pages()
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_footer_page_slug' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_footer_page_slug' );

/* TYPOGRAPHY */

// BODY FONT
if ( ! function_exists( 'boldthemes_customize_body_font' ) ) {
	function boldthemes_customize_body_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[body_font]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['body_font'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'body_font', array(
			'label'     => esc_html__( 'Body Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[body_font]',
			'priority'  => 97,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_body_font' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_body_font' );

// HEADING FONT
if ( ! function_exists( 'boldthemes_customize_heading_font' ) ) {
	function boldthemes_customize_heading_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_font]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['heading_font'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'heading_font', array(
			'label'     => esc_html__( 'Heading Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_font' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_heading_font' );

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
			'label'     => esc_html__( 'Heading Supertitle Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_supertitle_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_supertitle_font' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_heading_supertitle_font' );

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
			'label'     => esc_html__( 'Heading Subtitle Font', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_subtitle_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_subtitle_font' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_heading_subtitle_font' );

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
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_menu_font' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_heading_menu_font' );

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
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => array(
				'hard-rounded' => esc_html__( 'Hard Rounded', 'zele' ),
				'soft-rounded' => esc_html__( 'Soft Rounded', 'zele' ),
				'square' => esc_html__( 'Square', 'zele' )			
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_buttons_shape' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_heading_buttons_shape' );

/* BLOG */

// GRID GALLERY COLUMNS
if ( ! function_exists( 'boldthemes_customize_blog_grid_gallery_columns' ) ) {
	function boldthemes_customize_blog_grid_gallery_columns( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_columns]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_grid_gallery_columns'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_grid_gallery_columns', array(
			'label'     => esc_html__( 'Grid Gallery Columns', 'zele' ),
			'description'    => esc_html__( 'Define number of columns in grid gallery. Works only for Gallery post format.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_columns]',
			'priority'  => 6,
			'type'      => 'select',
			'choices'   => array(
				'2' => esc_html__( '2', 'zele' ),
				'3' => esc_html__( '3', 'zele' ),
				'4' => esc_html__( '4', 'zele' ),
				'5' => esc_html__( '5', 'zele' ),
				'6' => esc_html__( '6', 'zele' )				
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_grid_gallery_columns' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_grid_gallery_columns' );

// GRID GALLERY GAP
if ( ! function_exists( 'boldthemes_customize_blog_grid_gallery_gap' ) ) {
	function boldthemes_customize_blog_grid_gallery_gap( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_gap]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_grid_gallery_gap'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'zele' ),
			'description'    => esc_html__( 'Define the gap between grid gallery items.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_gap]',
			'priority'  => 7,
			'type'      => 'select',
			'choices'   => array(
				'no_gap' => esc_html__( 'No gap', 'zele' ),
				'small' => esc_html__( 'Small', 'zele' ),
				'normal' => esc_html__( 'Normal', 'zele' ),
				'large' => esc_html__( 'Large', 'zele' )
			)
		));	
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_grid_gallery_gap' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_grid_gallery_gap' );
		
// BLOG LIST VIEW
if ( ! function_exists( 'boldthemes_customize_blog_list_view' ) ) {
	function boldthemes_customize_blog_list_view( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_list_view]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_list_view'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_list_view', array(
			'label'     => esc_html__( 'Archive Layout', 'zele' ),
			'description'    => esc_html__( 'Set the layouts for blog archive pages - main Blog page, Archive, Category and Tag pages.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_list_view]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'standard' => esc_html__( 'Standard', 'zele' ),
				'columns' => esc_html__( 'Columns', 'zele' ),
				'simple' => esc_html__( 'Simple', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_list_view' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_list_view' );
		
// BLOG SINGLE VIEW
if ( ! function_exists( 'boldthemes_customize_blog_single_view' ) ) {
	function boldthemes_customize_blog_single_view( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_single_view]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_single_view'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_single_view', array(
			'label'     => esc_html__( 'Single Post Layout', 'zele' ),
			'description'    => esc_html__( 'Single post layout - one column or two columns (for media box and the content).', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_single_view]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'standard' => esc_html__( 'Standard', 'zele' ),
				'columns' => esc_html__( 'Columns', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_single_view' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_single_view' );
		
// AUTHOR
if ( ! function_exists( 'boldthemes_customize_blog_author' ) ) {
	function boldthemes_customize_blog_author( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_author]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_author'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_author', array(
			'label'    => esc_html__( 'Show Author Name', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_author]',
			'priority' => 8,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_author' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_author' );
		
// DATE
if ( ! function_exists( 'boldthemes_customize_blog_date' ) ) {
	function boldthemes_customize_blog_date( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_date]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_date'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_date', array(
			'label'    => esc_html__( 'Show Post Date', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_date]',
			'priority' => 10,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_date' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_date' );

// BLOG SIDE INFO
if ( ! function_exists( 'boldthemes_customize_blog_side_info' ) ) {
	function boldthemes_customize_blog_side_info( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_side_info]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_side_info'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_side_info', array(
			'label'    => esc_html__( 'Show Author Avatar in Post List', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_side_info]',
			'priority' => 12,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_side_info' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_side_info' );
		
// AUTHOR INFO
if ( ! function_exists( 'boldthemes_customize_blog_author_info' ) ) {
	function boldthemes_customize_blog_author_info( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_author_info]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_author_info'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_author_info', array(
			'label'    => esc_html__( 'Show Author Info in Single Post', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_author_info]',
			'priority' => 15,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_author_info' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_author_info' );
		
// USE DASH
if ( ! function_exists( 'boldthemes_customize_blog_use_dash' ) ) {
	function boldthemes_customize_blog_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blog_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Headlines', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_use_dash]',
			'priority' => 50,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_use_dash' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_use_dash' );
	
// SETTINGS PAGE
if ( ! function_exists( 'boldthemes_customize_blog_settings_page_slug' ) ) {
	function boldthemes_customize_blog_settings_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_settings_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_settings_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_settings_page_slug', array(
			'label'    => esc_html__( 'Settings Page', 'zele' ),
			'description'    => esc_html__( 'Use static page with content as a template for all single posts. Select the page which serves as a template.', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_settings_page_slug]',
			'priority' => 60,
			'type'     => 'select',
			'choices'  => boldthemes_get_all_pages()
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_settings_page_slug' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_settings_page_slug' );

/* PORTFOLIO */
		
// GRID GALLERY COLUMNS
if ( ! function_exists( 'boldthemes_customize_pf_grid_gallery_columns' ) ) {
	function boldthemes_customize_pf_grid_gallery_columns( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_columns]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_grid_gallery_columns'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_grid_gallery_columns', array(
			'label'     => esc_html__( 'Grid Gallery Columns', 'zele' ),
			'description'    => esc_html__( 'Define the number of columns for grid gallery on portfolio items.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_columns]',
			'priority'  => 5,
			'type'      => 'select',
			'choices'   => array(
				'2' => esc_html__( '2', 'zele' ),
				'3' => esc_html__( '3', 'zele' ),
				'4' => esc_html__( '4', 'zele' ),
				'5' => esc_html__( '5', 'zele' ),
				'6' => esc_html__( '6', 'zele' )				
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_grid_gallery_columns' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_grid_gallery_columns' );
		
// GRID GALLERY GAP
if ( ! function_exists( 'boldthemes_customize_pf_grid_gallery_gap' ) ) {
	function boldthemes_customize_pf_grid_gallery_gap( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_gap]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_grid_gallery_gap'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'zele' ),
			'description'    => esc_html__( 'Define the gap between grid gallery items in pixels.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_gap]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'no_gap' => esc_html__( 'No gap', 'zele' ),
				'small' => esc_html__( 'Small', 'zele' ),
				'normal' => esc_html__( 'Normal', 'zele' ),
				'large' => esc_html__( 'Large', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_grid_gallery_gap' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_grid_gallery_gap' );

// PORTFOLIO SINGLE VIEW
if ( ! function_exists( 'boldthemes_customize_pf_single_view' ) ) {
	function boldthemes_customize_pf_single_view( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_single_view]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_single_view'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_single_view', array(
			'label'     => esc_html__( 'Single project view', 'zele' ),
			'description'    => esc_html__( 'Define layout for all single portfolio items pages - one column or two columns.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_single_view]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'standard' => esc_html__( 'Standard', 'zele' ),
				'columns' => esc_html__( 'Columns', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_single_view' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_single_view' );

// PORTFOLIO LIST VIEW
if ( ! function_exists( 'boldthemes_customize_portfolio_list_view' ) ) {
	function boldthemes_customize_portfolio_list_view( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_list_view]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_list_view'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_list_view', array(
			'label'     => esc_html__( 'Archive Layout', 'zele' ),
			'description'    => esc_html__( 'Set the layout of the main Portfolio page, Archive, Category, and Tag pages.', 'zele' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_list_view]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'standard' => esc_html__( 'Standard', 'zele' ),
				'columns' => esc_html__( 'Columns', 'zele' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_portfolio_list_view' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_portfolio_list_view' );

// USE DASH
if ( ! function_exists( 'boldthemes_customize_pf_use_dash' ) ) {
	function boldthemes_customize_pf_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'pf_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Headlines', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_use_dash]',
			'priority' => 50,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_use_dash' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_use_dash' );

// SETTINGS PAGE
if ( ! function_exists( 'boldthemes_customize_pf_settings_page_slug' ) ) {
	function boldthemes_customize_pf_settings_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_settings_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_settings_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_settings_page_slug', array(
			'label'    => esc_html__( 'Settings Page', 'zele' ),
			'description'    => esc_html__( 'Use this page to create template for the single portfolio post. For portfolio list create page with slug \'portfolio\'.', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_settings_page_slug]',
			'priority' => 60,
			'type'     => 'select',
			'choices'  => boldthemes_get_all_pages()
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_settings_page_slug' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_settings_page_slug' );

// PORTFOLIO SLUG
if ( ! function_exists( 'boldthemes_customize_pf_slug' ) ) {
	function boldthemes_customize_pf_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'pf_slug', array(
			'label'    => esc_html__( 'Portfolio Slug', 'zele' ),
			'description'    => esc_html__( 'This value will be used to generate urls for Portfolio custom post type. To apply changes, go to Settings > Permalinks and click Save Changes', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_slug]',
			'priority' => 70,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_slug' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_slug' );

// PORTFOLIO CATEGORY SLUG
if ( ! function_exists( 'boldthemes_customize_pf_category_slug' ) ) {
	function boldthemes_customize_pf_category_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_category_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_category_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'pf_category_slug', array(
			'label'    => esc_html__( 'Portfolio Category Slug', 'zele' ),
			'description'    => esc_html__( 'This value will be used to generate urls for Portfolio category custom post type. To apply changes, go to Settings > Permalinks and click Save Changes', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_category_slug]',
			'priority' => 80,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_category_slug' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_category_slug' );

/* SHOP */

// USE DASH
if ( ! function_exists( 'boldthemes_customize_shop_use_dash' ) ) {
	function boldthemes_customize_shop_use_dash( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[shop_use_dash]', array(
			'default'           => BoldThemes_Customize_Default::$data['shop_use_dash'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'shop_use_dash', array(
			'label'    => esc_html__( 'Use Dash in Headlines', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_shop_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[shop_use_dash]',
			'priority' => 50,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_shop_use_dash' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_shop_use_dash' );

// SETTINGS PAGE
if ( ! function_exists( 'boldthemes_customize_shop_settings_page_slug' ) ) {
	function boldthemes_customize_shop_settings_page_slug( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[shop_settings_page_slug]', array(
			'default'           => BoldThemes_Customize_Default::$data['shop_settings_page_slug'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'shop_settings_page_slug', array(
			'label'    => esc_html__( 'Settings Page', 'zele' ),
			'description'    => esc_html__( 'Select a page with content which serves as a template for all single product pages.', 'zele' ),
			'section'  => BoldThemesFramework::$pfx . '_shop_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[shop_settings_page_slug]',
			'priority' => 60,
			'type'     => 'select',
			'choices'  => boldthemes_get_all_pages()
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_shop_settings_page_slug' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_shop_settings_page_slug' );