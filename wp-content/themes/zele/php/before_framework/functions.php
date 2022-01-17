<?php



/**
 * Returns custom 404 image
 *
 * @return string - 404 image path
 */
if ( ! function_exists( 'boldthemes_get_404_image' ) ) {
	function boldthemes_get_404_image() {		
		$image_404 = boldthemes_get_option( 'image_404' );
			if ( is_numeric( $image_404 ) ) {
				$image_404 = wp_get_attachment_image_src( $image_404, 'full' );
				$image_404 = isset($image_404[0]) ? $image_404[0] : BoldThemes_Customize_Default::$data['image_404'];
			}
		return $image_404;
	}
}

// VERTICAL FULLSCREEN MENU BACKGROUND
if ( ! function_exists( 'boldthemes_menu_background' ) ) {
	function boldthemes_menu_background( $menu_type = '' ) {
		if ( $menu_type == 'vertical-fullscreen' ) {
			$menu_background = boldthemes_get_option( 'menu_background' );
			if ( $menu_background ) {
				if ( is_numeric( $menu_background ) ) {
					$menu_background = wp_get_attachment_image_src( $menu_background, 'full' );
					$menu_background = isset($menu_background[0]) ? $menu_background[0] : '';
				}
			}	
			$menu_background_opacity = boldthemes_get_option( 'menu_background_opacity' );
			$menu_background_opacity = $menu_background_opacity != '' ? $menu_background_opacity : '1';
			
			echo '<div class="header_fullscreen_image" style="background-image:url(' . esc_url( $menu_background ) . ');opacity: ' . esc_attr( $menu_background_opacity ) . ';"></div>';
		}
	}
}



// PRODUCT HEADLINE DASH
if ( ! function_exists( 'boldthemes_product_list_headline_dash' ) ) {
	function boldthemes_product_list_headline_dash( $dash ) {
		return 'top';
	}
}
add_filter( 'boldthemes_product_list_headline_dash', 'boldthemes_product_list_headline_dash' );


// PRODUCT HEADLINE SIZE
if ( ! function_exists( 'boldthemes_product_list_headline_size' ) ) {
	function boldthemes_product_list_headline_size( $size ) {
		return 'small';
	}
}
add_filter( 'boldthemes_product_list_headline_size', 'boldthemes_product_list_headline_size' );


// SINGLE PRODUCT SHARE
if ( ! function_exists( 'boldthemes_shop_share_settings' ) ) {
	function boldthemes_shop_share_settings ( ) {
		return array( 'xsmall', 'filled', 'circle' );
	}
}
add_filter( 'boldthemes_shop_share_settings', 'boldthemes_shop_share_settings' );


// PRODUCT HEADLINE DASH
if ( ! function_exists( 'boldthemes_product_headline_dash' ) ) {
	function boldthemes_product_headline_dash( $dash ) {
		return 'top';
	}
}
add_filter( 'boldthemes_product_headline_dash', 'boldthemes_product_headline_dash' );