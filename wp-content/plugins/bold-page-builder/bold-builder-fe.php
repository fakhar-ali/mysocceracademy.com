<?php

class BT_BB_FE {
	public static $elements = array();
	public static $fe_id = -1;
}

add_action( 'admin_bar_init', 'bt_bb_fe_init' );

function bt_bb_fe_init() {
	if ( ! bt_bb_active_for_post_type_fe() || ( isset( $_GET['preview'] ) && ! isset( $_GET['bt_bb_fe_preview'] ) ) ) {
		return;
	}
	if ( current_user_can( 'edit_pages' ) ) {
		BT_BB_FE::$elements = apply_filters( 'bt_bb_fe_elements', array(
			'bt_bb_accordion_item' => array(
				'edit_box_selector' => '> .bt_bb_accordion_item_title',
				'params' => array(
					'title' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_accordion_item_title', 'type' => 'inner_html' ) ),
				),
			),
			'bt_bb_counter' => array(
				'edit_box_selector' => '',
				'ajax_animate_elements' => true,
				'params' => array(
					'number' => array(),
					'size' => array(),
				),
			),
			'bt_bb_countdown' => array(
				'edit_box_selector' => '',
				'use_ajax_placeholder' => true,
				'params' => array(
					'datetime' => array( 'js_handler' => array( 'target_selector' => '.btCountdownHolder', 'type' => 'countdown' ) ),
				),
			),
			'bt_bb_button' => array(
				'edit_box_selector' => '> a',
				'params' => array(
					'text' => array(),
					'icon' => array(),
					'color_scheme' => array( 'ajax_filter' => array( 'class' ) ),
					'url' => array( 'js_handler' => array( 'target_selector' => 'a', 'type' => 'attr', 'attr' => 'href' ) ),
					'target' => array( 'js_handler' => array( 'target_selector' => 'a', 'type' => 'attr', 'attr' => 'target' ) ),
					'size' => array(),
					'style' => array(),
				),
			),
			'bt_bb_headline' => array(
				'edit_box_selector' => '',
				'ajax_animate_elements' => true,
				'params' => array(
					'superheadline' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_headline_superheadline', 'type' => 'inner_html' ) ),
					'headline' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_headline_content', 'type' => 'inner_html_nl2br' ) ),
					'subheadline' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_headline_subheadline', 'type' => 'inner_html_nl2br' ) ),
					'size' => array(),
					'color_scheme' => array( 'ajax_filter' => array( 'class' ) ),
				),
			),
			'bt_bb_image' => array(
				'edit_box_selector' => '',
				'use_ajax_placeholder' => true,
				'params' => array(
					'image' => array(),
					'caption' => array(),
					'size' => array(),
					'shape' => array(),
					'url' => array(),
					'target' => array(),
					'hover_style' => array(),
				),
			),
			'bt_bb_text' => array(
				'ajax_mejs' => true,
				'edit_box_selector' => '',
			),
			'bt_bb_icon' => array(
				'edit_box_selector' => '',
				'params' => array(
					'icon' => array(),
					'colored_icon' => array(),
					'text' => array(),
					'url' => array(),
					'url_title' => array(),
					'target' => array(),
					'size' => array(),
					'color_scheme' => array( 'ajax_filter' => array( 'class' ) ),
					'style' => array(),
					'shape' => array(),
				),
			),
			'bt_bb_service' => array(
				'edit_box_selector' => '',
				'params' => array(
					'icon' => array(),
					'title' => array(),
					'text' => array(),
					'url' => array(),
					'target' => array(),
					'size' => array(),
					'color_scheme' => array( 'ajax_filter' => array( 'class' ) ),
					'style' => array(),
					'shape' => array(),
				),
			),
			'bt_bb_masonry_image_grid' => array(
				'edit_box_selector' => '',
				'ajax_trigger_window_load' => true,
				'params' => array(
					'images' => array(),
				),
			),
			'bt_bb_column' => array(
				'edit_box_selector' => '',
				'params' => array(
					'background_image' => array( 'js_handler' => array( 'target_selector' => '', 'type' => 'background_image' ) ),
					'inner_background_image' => array( 'js_handler' => array( 'target_selector' =>  '>div', 'type' => 'background_image' ) ),
				),
				'condition_params' => true,
			),
			'bt_bb_column_inner' => array(
				'edit_box_selector' => '',
				'params' => array(
					'background_image' => array( 'js_handler' => array( 'target_selector' => '', 'type' => 'background_image' ) ),
					'inner_background_image' => array( 'js_handler' => array( 'target_selector' =>  '.bt_bb_column_content', 'type' => 'background_image' ) ),
				),
				'condition_params' => true,
			),
			'bt_bb_content_slider_item' => array(
				'edit_box_selector' => '',
				'params' => array(
					'image' => array( 'js_handler' => array( 'target_selector' => '', 'type' => 'background_image' ) ),
				),
				'condition_params' => true,
			),			
			'bt_bb_price_list' => array(
				'edit_box_selector' => '',
				'params' => array(
					'title' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_price_list_title', 'type' => 'inner_html' ) ),
					'subtitle' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_price_list_subtitle', 'type' => 'inner_html' ) ),
					'currency' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_price_list_currency', 'type' => 'inner_html' ) ),
					'price' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_price_list_amount', 'type' => 'inner_html' ) ),
					'items' => array(),
				),
			),
			'bt_bb_progress_bar' => array(
				'edit_box_selector' => '',
				'params' => array(
					'percentage' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_progress_bar_inner', 'type' => 'attr', 'attr' => 'style', 'preprocess' => 'progress_bar_style' ) ),
					'text' => array( 'js_handler' => array( 'target_selector' => '.bt_bb_progress_bar_text', 'type' => 'inner_html' ) ),
				),
			),
			'bt_bb_section' => array(
				'edit_box_selector' => '',
				'params' => array(
					'background_image' => array( 'js_handler' => array( 'target_selector' => '', 'type' => 'background_image' ) ),
					'parallax' => array( 'js_handler' => array( 'target_selector' => '','type' => 'attr', 'attr' => 'data-parallax' ) ),
					'parallax_offset' => array( 'js_handler' => array( 'target_selector' => '', 'type' => 'attr', 'attr' => 'data-parallax-offset' ) ),
				),
			),
			'bt_bb_separator' => array(
				'edit_box_selector' => '',
				'params' => array(
					'top_spacing' => array( 'ajax_filter' => array( 'class', 'data-bt-override-class' ) ),
					'bottom_spacing' => array( 'ajax_filter' => array( 'class', 'data-bt-override-class' ) ),
				),
			),
			'bt_bb_slider' => array(
				'edit_box_selector' => '',
				'ajax_slick' => true,
				'params' => array(
					'images' => array(),
				),
			),
			'bt_bb_tab_item' => array(
				'edit_box_selector' => '',
				'params' => array(
					'title' => array( 'js_handler' => array( 'target_selector' => 'span', 'type' => 'inner_html' ) ),
				),
			),
			'bt_bb_video' => array(
				'edit_box_selector' => '',
				'ajax_mejs' => true,
				'params' => array(
					'video' => array(),
				),
			),
		) );
		add_action( 'wp_head', 'bt_bb_fe_head' );
		add_action( 'wp_head', 'bt_bb_translate' );
		add_action( 'wp_footer', 'bt_bb_fe_dialog' );
	}
}

function bt_bb_fe_head() {
	echo '<script>';
		echo 'window.bt_bb_fe_elements = ' . bt_bb_json_encode( BT_BB_FE::$elements ) . ';';
		BT_BB_Root::$elements = apply_filters( 'bt_bb_elements', BT_BB_Root::$elements );
		$elements = BT_BB_Root::$elements;
		foreach ( $elements as $key => $value ) {
			$params = isset( $value[ 'params' ] ) ? $value[ 'params' ] : null;
			$params1 = array();
			if ( is_array( $params ) ) {
				foreach ( $params as $param ) {
					$params1[ $param['param_name'] ] = $param;
				}
			}
			$elements[ $key ][ 'params' ] = $params1;
		}
		echo 'window.bt_bb_elements = ' . bt_bb_json_encode( $elements ) . ';';
		global $post;
		echo 'window.bt_bb_post_id = ' . $post->ID . ';';
		echo 'window.bt_bb_settings = [];';
		$options = get_option( 'bt_bb_settings' );
		$slug_url = array_key_exists( 'slug_url', $options ) ? $options['slug_url'] : '';
		echo 'window.bt_bb_settings.slug_url = "' . esc_js( $slug_url ) . '";';
		echo 'window.bt_bb_ajax_url = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '";';
		echo 'window.bt_bb_fa_url = "' . plugins_url( 'css/font-awesome.min.css', __FILE__ ) . '";';
		echo 'window.bt_bb_fe_dialog_content_css_url = "' . plugins_url( 'css/front_end/fe_dialog_content.crush.css', __FILE__ ) . '";';
		echo 'window.bt_bb_fe_dialog_bottom_css_url = "' . plugins_url( 'css/front_end/fe_dialog_bottom.crush.css', __FILE__ ) . '";';
		if ( is_rtl() ) {
			echo 'window.bt_bb_rtl = true;';
		} else {
			echo 'window.bt_bb_rtl = false;';
		}
		if ( function_exists('boldthemes_get_icon_fonts_bb_array') ) {
			$icon_arr = boldthemes_get_icon_fonts_bb_array();
		} else {
			require_once( dirname(__FILE__) . '/content_elements_misc/fa_icons.php' );
			require_once( dirname(__FILE__) . '/content_elements_misc/s7_icons.php' );
			$icon_arr = array( 'Font Awesome' => bt_bb_fa_icons(), 'S7' => bt_bb_s7_icons() );
		}
		echo 'window.bt_bb_icons = JSON.parse(\'' . bt_bb_json_encode( $icon_arr ) . '\')';
	echo '</script>';
}

function bt_bb_fe_dialog() {
	echo '<div id="bt_bb_fe_dialog">';
		echo '<div>';
			echo '<div id="bt_bb_fe_dialog_main">';
				echo '<div class="bt_bb_dialog_header">';
					echo '<div class="bt_bb_dialog_header_text" >Edit Column</div>';
					echo '<div class="bt_bb_dialog_close" id="bt_bb_fe_dialog_close" title="Close dialog"></div>';
					echo '<div id="bt_bb_fe_dialog_switch" title="Switch side"><i class="fa fa-exchange"></i></div>';
				echo '</div>';
				echo '<div id="bt_bb_fe_dialog_content"></div>';
				echo '<div id="bt_bb_fe_dialog_tinymce_container">';
					// https://developer.wordpress.org/reference/classes/_wp_editors/parse_settings/
					wp_editor( '' , 'bt_bb_fe_dialog_tinymce', array( 'media_buttons' => false, 'editor_height' => 200, 'tinymce' => array(
						'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator',
						'toolbar2'      => '',
						'toolbar3'      => '',
					) ) );
				echo '</div>';
				echo '<div id="bt_bb_fe_dialog_bottom"></div>';
			echo '</div>';
			// echo '<div id="bt_bb_fe_dialog_close" title="Close dialog"><i class="fa fa-close"></i></div>';
			
		echo '</div>';
	echo '</div>';
	echo '<div id="bt_bb_fe_init_mouseover"></div>';
}

/**
 * Save post
 */
 
function bt_bb_fe_save() {
	check_ajax_referer( 'bt_bb_fe_nonce', 'nonce' );
	$post_id = intval( $_POST['post_id'] );
	$post_content = wp_kses_post( $_POST['post_content'] );
	if ( current_user_can( 'edit_post', $post_id ) ) {
		$post = array(
			'ID'           => $post_id,
			'post_content' => $post_content,
		);
		wp_update_post( $post );
		echo 'ok';
	}
	wp_die();
}
add_action( 'wp_ajax_bt_bb_fe_save', 'bt_bb_fe_save' );

/**
 * Get HTML
 */
 
function bt_bb_fe_get_html() {
	check_ajax_referer( 'bt_bb_fe_nonce', 'nonce' );
	$post_id = intval( $_POST['post_id'] );
	$content = stripslashes( wp_kses_post( $_POST['content'] ) );
	if ( current_user_can( 'edit_post', $post_id ) ) {
		$html = apply_filters( 'the_content', $content );
		$html = str_ireplace( array( '``', '`{`', '`}`' ), array( '&quot;', '&#91;', '&#93;' ), $html );
		$html = str_ireplace( array( '*`*`*', '*`*{*`*', '*`*}*`*' ), array( '``', '`{`', '`}`' ), $html );
		echo $html;
	}
	wp_die();
}
add_action( 'wp_ajax_bt_bb_fe_get_html', 'bt_bb_fe_get_html' );
