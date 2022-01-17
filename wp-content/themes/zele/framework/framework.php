<?php

if ( ! class_exists( 'BoldThemesFramework' ) ) {
	class BoldThemesFramework {
		// vars
		public static $pfx = 'boldthemes_theme';
		public static $page_for_header_id;
		public static $date_format;
		public static $sidebar;
		public static $has_sidebar;
		public static $gfonts;
		public static $custom_fonts = array();
		public static $custom_fonts_enqueue = array();
		public static $customize_fonts;
		public static $all_pages = array();
		public static $meta_boxes = array();
		public static $crush_vars = array();
		public static $crush_vars_def = array();	
		public static $fake_customizer;
		public static $current_override_section;
	}
}

if ( ! class_exists( 'BoldThemesFrameworkTemplate' ) ) {
	class BoldThemesFrameworkTemplate {
		public static $blog_author;
		public static $blog_date;
		public static $author_url;
		public static $show_comments_number;
		public static $blog_use_dash;
		public static $class_array;
		public static $blog_side_info;
		public static $media_html;
		public static $categories_html;
		public static $tags_html;
		public static $content_final_html;
		public static $post_format;
		public static $content_html;
		public static $meta_html;
		public static $dash;
		public static $cf;
		public static $pf_use_dash;
	}
}

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

require_once( get_parent_theme_file_path( 'framework/actions.php' ) );
require_once( get_parent_theme_file_path( 'framework/filters.php' ) );

if ( file_exists( get_parent_theme_file_path( 'css-crush/CssCrush.php' ) ) ) {
	require_once( get_parent_theme_file_path( 'css-crush/CssCrush.php' ) );
} else {
	if ( ! class_exists( 'CssCrush\Functions' ) ) {
		require_once( get_parent_theme_file_path( 'framework/BTCrushFunctions.php' ) );
		require_once( get_parent_theme_file_path( 'framework/BTCrushUtil.php' ) );
		require_once( get_parent_theme_file_path( 'framework/BTCrushColor.php' ) );
		require_once( get_parent_theme_file_path( 'framework/BTCrushRegex.php' ) );
	}
}
require_once( get_parent_theme_file_path( 'framework/boldthemes_basic_functions.php' ) );
require_once( get_parent_theme_file_path( 'framework/boldthemes_functions.php' ) );
require_once( get_parent_theme_file_path( 'framework/sanitization.php' ) );
require_once( get_parent_theme_file_path( 'framework/customization.php' ) );
require_once( get_parent_theme_file_path( 'framework/editor-buttons/editor-buttons.php' ) );
require_once( get_parent_theme_file_path( 'framework/class-tgm-plugin-activation.php' ) );
require_once( get_parent_theme_file_path( 'framework/woocommerce_hooks.php' ) );

require_once( get_parent_theme_file_path( 'framework/amp.php' ) );

require_once( get_parent_theme_file_path( 'framework/config-meta-boxes.php' ) );