<?php

class bt_bb_section extends BT_BB_Element {

	function  bb_exist() {
		if ( file_exists( WP_PLUGIN_DIR . '/bold-page-builder/bold-builder.php' ) ) { return true; }
			return false;
	}

	function handle_shortcode( $atts, $content ) {
		if ( !$this->bb_exist() ) { return false; }

		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'layout'							=> '',
			'full_screen'						=> '',
			'vertical_align'					=> '',
			'top_spacing'						=> '',
			'bottom_spacing'					=> '',
			'color_scheme'						=> '',
			'background_color'					=> '',
			'background_image'					=> '',
			'lazy_load'							=> 'no',
			'background_overlay'				=> '',
			'background_video_yt'				=> '',
			'yt_video_settings'					=> '',
			'background_video_mp4'				=> '',
			'background_video_ogg'				=> '',
			'background_video_webm'				=> '',
			'show_video_on_mobile'				=> '',
			'parallax'							=> '',
			'parallax_offset'					=> '',
			'top_section_coverage_image'		=> '',
			'bottom_section_coverage_image'		=> '',
			'allow_content_outside'			 	=> ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );

		wp_enqueue_script(
			'bt_bb_elements',
			plugins_url() . '/bold-page-builder/content_elements/bt_bb_section/bt_bb_elements.js',
			array( 'jquery' ),
			'',
			true
		);
		
		$show_video_on_mobile = ( $show_video_on_mobile == 'show_video_on_mobile' || $show_video_on_mobile == 'yes' ) ? 1 : 0;

		if ( $top_spacing != '' ) {
			$class[] = $this->prefix . 'top_spacing' . '_' . $top_spacing;
		}

		if ( $bottom_spacing != '' ) {
			$class[] = $this->prefix . 'bottom_spacing' . '_' . $bottom_spacing;
		}

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}
		
		if ( $background_color != '' ) {
			$el_style = $el_style . ';' . 'background-color:' . $background_color . ';';
		}

		if ( $layout != '' ) {
			$class[] = $this->prefix . 'layout' . '_' . $layout;
		}

		if ( $full_screen == 'yes' ) {
			$class[] = $this->prefix . 'full_screen';
		}

		if ( $vertical_align != '' ) {
			$class[] = $this->prefix . 'vertical_align' . '_' . $vertical_align;
		}
		$background_data_attr = '';

		if ( $background_image != '' ) {
			$background_image = wp_get_attachment_image_src( $background_image, 'full' );
		}

		$background_image_url = '';
		$data_parallax_attr = '';

		if ( $background_image ) {
			$background_image_url = isset($background_image[0]) ? $background_image[0] : '';
		}
		if ( $background_image_url != '' ) {
			if ( $lazy_load == 'yes' ) {
				$blank_image_src = BT_BB_Root::$path . 'img/blank.gif';
				$background_image_style = 'background-image:url(\'' . $blank_image_src . '\');';
				$background_data_attr .= ' data-background_image_src="\'' . $background_image_url . '\'"';
				$class[] = 'btLazyLoadBackground';
			} else {
				$background_image_style = 'background-image:url(\'' . $background_image_url . '\');';
				
			}
			$el_style = $background_image_style . $el_style;	
			$class[] = $this->prefix . 'background_image';

			if ( $parallax != '' ) {
				$data_parallax_attr = 'data-parallax="' . esc_attr( $parallax ) . '" data-parallax-offset="' . esc_attr( intval( $parallax_offset ) ) . '"';
				$class[] = $this->prefix . 'parallax';
			}
		}

		if ( $background_overlay != '' ) {
			$class[] = $this->prefix . 'background_overlay' . '_' . $background_overlay;
		}

		$id_attr = '';
		if ( $el_id == '' ) {
			$el_id = uniqid( 'bt_bb_section' );
		}
		$id_attr = 'id="' . esc_attr( $el_id ) . '"';

		$background_video_attr = '';

		$video_html = '';

		if ( $background_video_yt != '' ) {
			wp_enqueue_style( 'bt_bb_style_yt', plugins_url() . '/bold-page-builder/content_elements/bt_bb_section/YTPlayer.css' );
			wp_enqueue_script( 
				'bt_bb_yt',
				plugins_url() . '/bold-page-builder/content_elements/bt_bb_section/jquery.mb.YTPlayer.min.js',
				array( 'jquery' ),
				'',
				true
			);

			$class[] = $this->prefix . 'background_video_yt';

			if ( $yt_video_settings == '' ) {
				$yt_video_settings = 'showControls:false,showYTLogo:false,startAt:0,loop:true,mute:true,stopMovieOnBlur:false,opacity:1';
				// $yt_video_settings = '';
			}
			
			$yt_video_settings .= $show_video_on_mobile ? ',useOnMobile:true' : ',useOnMobile:false';
			
			$yt_video_settings .= '';
			// $yt_video_settings .= ',cc_load_policy:false,showAnnotations:false,optimizeDisplay:true,anchor:\'center,center\'';
			$yt_video_settings .= ',useNoCookie:false';

			$background_video_attr = ' ' . 'data-property="{videoURL:\'' . $background_video_yt . '\',containment:\'#' . $el_id . '\',' . $yt_video_settings . '}"';
			
			$video_html .= '<div class="' . esc_attr( $this->prefix ) . 'background_video_yt_inner" ' . $background_video_attr . ' ></div>';

			
			$proxy = new BT_BB_YT_Video_Proxy( $this->prefix, $el_id );
			add_action( 'wp_footer', array( $proxy, 'js_init' ) );

		} else if ( ( $background_video_mp4 != '' || $background_video_ogg != '' || $background_video_webm != '' ) && ! ( wp_is_mobile() && ! $show_video_on_mobile ) ) {
			$class[] = $this->prefix . 'video';
			$video_html = '<video autoplay loop muted playsinline onplay="bt_bb_video_callback( this )">';
			if ( $background_video_mp4 != '' ) {
				$video_html .= '<source src="' . esc_url_raw( $background_video_mp4 ) . '" type="video/mp4">';
			}
			if ( $background_video_ogg != '' ) {
				$video_html .= '<source src="' . esc_url_raw( $background_video_ogg ) . '" type="video/ogg">';
			}
			if ( $background_video_webm != '' ) {
				$video_html .= '<source src="' . esc_url_raw( $background_video_webm ) . '" type="video/webm">';
			}
			$video_html .= '</video>';
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );

		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}

		if ( $allow_content_outside != '' ) {
			$class_attr = $class_attr . ' ' . $this->shortcode . '_allow_content_outside_' . $allow_content_outside;
		}

		$top_section_coverage_image_output = '';
			if ( $top_section_coverage_image != '' ) { 
				$alt_top_section_coverage_image = get_post_meta($top_section_coverage_image, '_wp_attachment_image_alt', true);
				$alt_top_section_coverage_image = $alt_top_section_coverage_image ? $alt_top_section_coverage_image : $this->shortcode . '_top_section_coverage_image';

				$top_section_coverage_image = wp_get_attachment_image_src( $top_section_coverage_image, 'full' );
				if ( isset($top_section_coverage_image[0]) ) {
					$class_attr = $class_attr . ' ' . $this->shortcode . '_with_top_coverage_image';
					$top_section_coverage_image = $top_section_coverage_image[0];
					$top_section_coverage_image_output = 
						'<div class="' . esc_attr( $this->shortcode ) . '_top_section_coverage_image"><img src="' . esc_url( $top_section_coverage_image ) . '" alt="' . esc_attr($alt_top_section_coverage_image) . '" /></div>';
					$class[] = $this->prefix . 'top_section_coverage_image';
				}
			}

		$bottom_section_coverage_image_output = '';
			if ( $bottom_section_coverage_image != '' ) {
				$alt_bottom_section_coverage_image = get_post_meta($bottom_section_coverage_image, '_wp_attachment_image_alt', true);
				$alt_bottom_section_coverage_image = $alt_bottom_section_coverage_image ? $alt_bottom_section_coverage_image : $this->shortcode . '_bottom_section_coverage_image';

				$bottom_section_coverage_image = wp_get_attachment_image_src( $bottom_section_coverage_image, 'full' );
				if ( isset($bottom_section_coverage_image[0]) ) {
					$class_attr = $class_attr . ' ' .$this->shortcode . '_with_bottom_coverage_image';
					$bottom_section_coverage_image = $bottom_section_coverage_image[0];
					$bottom_section_coverage_image_output = 
						'<div class="' . esc_attr( $this->shortcode ) . '_bottom_section_coverage_image"><img src="' . esc_url( $bottom_section_coverage_image ) . '" alt="' . esc_attr($alt_bottom_section_coverage_image) . '" /></div>';
					$class[] = $this->prefix . 'bottom_section_coverage_image';
				}
			}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}

		$output = '<section ' . $id_attr . ' ' . $data_parallax_attr . $background_data_attr . ' class="' . esc_attr( $class_attr ) . '" ' . $style_attr . '>';
		$output .= $video_html;
			$output .= '<div class="' . esc_attr( $this->prefix ) . 'port">';
				$output .= '<div class="' . esc_attr( $this->prefix ) . 'cell">';
					$output .= '<div class="' . esc_attr( $this->prefix ) . 'cell_inner">';
					$output .= do_shortcode( $content );
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

			$output .= $top_section_coverage_image_output;
			$output .= $bottom_section_coverage_image_output;

		$output .= '</section>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		
		if ( !$this->bb_exist() ) { return false; }
		require_once( WP_PLUGIN_DIR   . '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Section', 'zele' ), 'description' => esc_html__( 'Basic root element', 'zele' ), 'root' => true, 'container' => 'vertical', 'accept' => array( 'bt_bb_row' => true ), 'toggle' => true, 'auto_add' => 'bt_bb_row', 'show_settings_on_create' => false,
			'params' => array( 
				array( 'param_name' => 'layout', 'type' => 'dropdown', 'default' => 'boxed_1200', 'heading' => esc_html__( 'Layout', 'zele' ), 'group' => esc_html__( 'General', 'zele' ), 'weight' => 0, 'preview' => true,
					'value' => array(
						esc_html__( 'Boxed (800px)', 'zele' ) 	=> 'boxed_800',
						esc_html__( 'Boxed (900px)', 'zele' ) 	=> 'boxed_900',
						esc_html__( 'Boxed (1000px)', 'zele' ) 	=> 'boxed_1000',
						esc_html__( 'Boxed (1100px)', 'zele' ) 	=> 'boxed_1100',
						esc_html__( 'Boxed (1200px)', 'zele' ) 	=> 'boxed_1200',
						esc_html__( 'Boxed (1300px)', 'zele' ) 	=> 'boxed_1300',
						esc_html__( 'Boxed (1400px)', 'zele' ) 	=> 'boxed_1400',
						esc_html__( 'Boxed (1500px)', 'zele' ) 	=> 'boxed_1500',
						esc_html__( 'Boxed (1600px)', 'zele' ) 	=> 'boxed_1600',
						esc_html__( 'Wide', 'zele' ) 			=> 'wide'
					)
				),
				array( 'param_name' => 'top_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Top spacing', 'zele' ), 'preview' => true,
					'value' => array(
						esc_html__( 'No spacing', 'zele' ) 	=> '',
						esc_html__( 'Extra small', 'zele' ) 	=> 'extra_small',
						esc_html__( 'Small', 'zele' ) 		=> 'small',		
						esc_html__( 'Normal', 'zele' ) 		=> 'normal',
						esc_html__( 'Medium', 'zele' ) 		=> 'medium',
						esc_html__( 'Large', 'zele' ) 		=> 'large',
						esc_html__( 'Extra large', 'zele' ) 	=> 'extra_large',
						esc_html__( '5px', 'zele' ) 			=> '5',
						esc_html__( '10px', 'zele' ) 		=> '10',
						esc_html__( '15px', 'zele' ) 		=> '15',
						esc_html__( '20px', 'zele' ) 		=> '20',
						esc_html__( '25px', 'zele' ) 		=> '25',
						esc_html__( '30px', 'zele' ) 		=> '30',
						esc_html__( '35px', 'zele' ) 		=> '35',
						esc_html__( '40px', 'zele' ) 		=> '40',
						esc_html__( '45px', 'zele' ) 		=> '45',
						esc_html__( '50px', 'zele' ) 		=> '50',
						esc_html__( '55px', 'zele' ) 		=> '55',
						esc_html__( '60px', 'zele' ) 		=> '60',
						esc_html__( '65px', 'zele' ) 		=> '65',
						esc_html__( '70px', 'zele' ) 		=> '70',
						esc_html__( '75px', 'zele' ) 		=> '75',
						esc_html__( '80px', 'zele' ) 		=> '80',
						esc_html__( '85px', 'zele' ) 		=> '85',
						esc_html__( '90px', 'zele' ) 		=> '90',
						esc_html__( '95px', 'zele' ) 		=> '95',
						esc_html__( '100px', 'zele' ) 		=> '100'
					)
				),
				array( 'param_name' => 'bottom_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Bottom spacing', 'zele' ), 'preview' => true,
					'value' => array(
						esc_html__( 'No spacing', 'zele' ) 	=> '',
						esc_html__( 'Extra small', 'zele' ) 	=> 'extra_small',
						esc_html__( 'Small', 'zele' ) 		=> 'small',		
						esc_html__( 'Normal', 'zele' ) 		=> 'normal',
						esc_html__( 'Medium', 'zele' ) 		=> 'medium',
						esc_html__( 'Large', 'zele' ) 		=> 'large',
						esc_html__( 'Extra large', 'zele' ) 	=> 'extra_large',
						esc_html__( '5px', 'zele' ) 			=> '5',
						esc_html__( '10px', 'zele' ) 		=> '10',
						esc_html__( '15px', 'zele' ) 		=> '15',
						esc_html__( '20px', 'zele' ) 		=> '20',
						esc_html__( '25px', 'zele' ) 		=> '25',
						esc_html__( '30px', 'zele' ) 		=> '30',
						esc_html__( '35px', 'zele' ) 		=> '35',
						esc_html__( '40px', 'zele' ) 		=> '40',
						esc_html__( '45px', 'zele' ) 		=> '45',
						esc_html__( '50px', 'zele' ) 		=> '50',
						esc_html__( '55px', 'zele' ) 		=> '55',
						esc_html__( '60px', 'zele' ) 		=> '60',
						esc_html__( '65px', 'zele' ) 		=> '65',
						esc_html__( '70px', 'zele' ) 		=> '70',
						esc_html__( '75px', 'zele' ) 		=> '75',
						esc_html__( '80px', 'zele' ) 		=> '80',
						esc_html__( '85px', 'zele' ) 		=> '85',
						esc_html__( '90px', 'zele' ) 		=> '90',
						esc_html__( '95px', 'zele' ) 		=> '95',
						esc_html__( '100px', 'zele' ) 		=> '100'
					)
				),
				array( 'param_name' => 'full_screen', 'type' => 'dropdown', 'heading' => esc_html__( 'Full screen', 'zele' ), 
					'value' => array(
						esc_html__( 'No', 'zele' ) 		=> '',
						esc_html__( 'Yes', 'zele' ) 		=> 'yes'
					)
				),
				array( 'param_name' => 'vertical_align', 'type' => 'dropdown', 'heading' => esc_html__( 'Vertical align (for fullscreen section)', 'zele' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Top', 'zele' )     => 'top',
						esc_html__( 'Middle', 'zele' )  => 'middle',
						esc_html__( 'Bottom', 'zele' )  => 'bottom'					
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'zele' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'zele' )  ),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 'preview' => true ),
				array( 'param_name' => 'background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Background image', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load background image', 'zele' ),
					'value' => array(
						esc_html__( 'No', 'zele' ) 	=> 'no',
						esc_html__( 'Yes', 'zele' ) 	=> 'yes'
					)
				),
				array( 'param_name' => 'background_overlay', 'type' => 'dropdown', 'heading' => esc_html__( 'Background overlay', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ), 
					'value' => array(
						esc_html__( 'No overlay', 'zele' )    		=> '',
						esc_html__( 'Light stripes', 'zele' ) 		=> 'light_stripes',
						esc_html__( 'Dark stripes', 'zele' )  		=> 'dark_stripes',
						esc_html__( 'Light solid', 'zele' )	  		=> 'light_solid',
						esc_html__( 'Dark solid', 'zele' )	  		=> 'dark_solid',
						esc_html__( 'Light gradient', 'zele' )	  	=> 'light_gradient',
						esc_html__( 'Dark gradient', 'zele' )	  	=> 'dark_gradient'
					)
				),

				array( 'param_name' => 'top_section_coverage_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Top Section Coverage Image', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'bottom_section_coverage_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Bottom Section Coverage Image', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				
				array( 'param_name' => 'allow_content_outside', 'type' => 'dropdown', 'heading' => esc_html__( 'Top & Bottom Coverage Images position', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ),
					'value' => array(
							esc_html__( 'Top & Bottom Coverage Image above content', 'zele' ) 			=> '',
							esc_html__( 'Top & Bottom Coverage Image under content', 'zele' ) 			=> 'under',
							esc_html__( 'Only Top Coverage Image under content', 'zele' ) 				=> 'top_under',
							esc_html__( 'Bottom Coverage Image under content', 'zele' ) 					=> 'bottom_under'
					)
				),

				array( 'param_name' => 'parallax', 'type' => 'textfield', 'heading' => esc_html__( 'Parallax (e.g. 0.7)', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'parallax_offset', 'type' => 'textfield', 'heading' => esc_html__( 'Parallax offset in px (e.g. -100)', 'zele' ), 'group' => esc_html__( 'Design', 'zele' ) ),
				array( 'param_name' => 'background_video_yt', 'type' => 'textfield', 'heading' => esc_html__( 'YouTube background video', 'zele' ), 'group' => esc_html__( 'Video', 'zele' ) ),
				array( 'param_name' => 'yt_video_settings', 'type' => 'textfield', 'heading' => esc_html__( 'YouTube video settings (e.g. startAt:20, mute:true, stopMovieOnBlur:false)', 'zele' ), 'group' => esc_html__( 'Video', 'zele' ) ),
				array( 'param_name' => 'background_video_mp4', 'type' => 'textfield', 'heading' => esc_html__( 'MP4 background video', 'zele' ), 'group' => esc_html__( 'Video', 'zele' ) ),
				array( 'param_name' => 'background_video_ogg', 'type' => 'textfield', 'heading' => esc_html__( 'OGG background video', 'zele' ), 'group' => esc_html__( 'Video', 'zele' ) ),
				array( 'param_name' => 'background_video_webm', 'type' => 'textfield', 'heading' => esc_html__( 'WEBM background video', 'zele' ), 'group' => esc_html__( 'Video', 'zele' ) ),
				array( 'param_name' => 'show_video_on_mobile',  'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'zele' ) => 'yes' ), 'default' => '', 'heading' => esc_html__( 'Show Video on Mobile Devices', 'zele' ), 'group' => esc_html__( 'Video', 'zele' ) )
			)
		) );
	}
}

class BT_BB_YT_Video_Proxy {
	function __construct( $prefix, $el_id ) {
		$this->prefix = $prefix;
		$this->el_id = $el_id;
	}
	public function js_init() {
		// wp_register_script( 'boldthemes-script-bt-bb-section-js-init', '' );
		// wp_enqueue_script( 'boldthemes-script-bt-bb-section-js-init' );
		// wp_add_inline_script( 'boldthemes-script-bt-bb-section-js-init', 'jQuery(function() { jQuery( "#' . esc_html( $this->el_id ) . ' .' . esc_html( $this->prefix ) . 'background_video_yt_inner" ).YTPlayer();});' );
		wp_add_inline_script( 'bt_bb_yt', 'jQuery(function() { jQuery( "#' . esc_html( $this->el_id ) . ' .' . esc_html( $this->prefix ) . 'background_video_yt_inner" ).YTPlayer();});' );
    }

}
