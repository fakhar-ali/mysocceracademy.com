<?php

		$prefix = 'bold_timeline_container';
		$class = array( $prefix );
	
		wp_enqueue_script( 'bold-timeline', plugins_url( '../../assets/js/bold-timeline.js', __FILE__  ), array( 'jquery' ) );
		wp_enqueue_style( 'bold-timeline', plugins_url( '../../style.css', __FILE__ ) );
		
		if ( $el_id == '' ) {
			$el_id = 'id_' . uniqid();
		} else {
			$el_id = 'id_' . $el_id . '_' . uniqid();
		}		
		$id_attr = ' ' . 'id="' . $el_id . '"';
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
                
                if ( $responsive != '' ) {
			$class[] = 'bold_timeline_responsive_' . $responsive;
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . $el_style . '"';
		}
		
		/* Container properties */
		
		$line_output = '';
		
		if ( $line_style != '' && $line_style != 'none' && $line_position != 'none' ) {
			$class[] = $prefix . '_line_style_' . $line_style;
			$class[] = $prefix . '_has_line_style';
			$line_output = '<div class = "bold_timeline_container_line"></div>';
		}

		if ( $line_thickness != '' ) {
			$class[] = $prefix . '_line_thickness_' . $line_thickness;
		}
		
		if ( $item_style != '' ) {
			$class[] = $prefix . '_item_style_' . $item_style;
		}
		
		if ( $line_position == 'center_overlap' || $line_position == 'center' || $line_position == 'left' || $line_position == 'right' || $line_position == 'none'  ) {
			$class[] = $prefix . '_line_position_vertical';
			$slider = false;
		} else {
			$class[] = $prefix . '_line_position_horizontal';
			$slider = true;
		} 
		
		if ( $line_position == 'center_overlap' ) {
			$class[] = $prefix . '_line_position_overlap';
			$class[] = $prefix . '_line_position_center';
		} else if ( $line_position != '' ) {
			$class[] = $prefix . '_line_position_' . $line_position;
		}
		
		/* Item properties */
		
		if ( $item_frame_thickness != '' ) {
			$class[] = $prefix . '_item_frame_thickness_' . $item_frame_thickness;
		}

		if ( $item_shape != '' ) {
			$class[] = $prefix . '_item_shape_' . $item_shape;
		}
				
		if ( $item_icon_position != '' ) {
			$class[] = $prefix . '_item_icon_position_' . $item_icon_position;
		}
				
		if ( $item_icon_shape != '' ) {
			$class[] = $prefix . '_item_icon_shape_' . $item_icon_shape;
		}
				
		if ( $item_icon_style != '' ) {
			$class[] = $prefix . '_item_icon_style_' . $item_icon_style;
		}
		
		if ( $item_connection_type != '' ) {
			$class[] = $prefix . '_item_connection_type_' . $item_connection_type;
		}
		
		if ( $item_content_display != '' ) {
			$class[] = $prefix . '_item_content_display_' . $item_content_display;
		}
		
		if ( $item_marker_type != '' ) {
			$class[] = $prefix . '_item_marker_type_' . $item_marker_type;
		}

		if ( $item_title_size != '' ) {
			$class[] = $prefix . '_item_title_size_' . $item_title_size;
		}

		if ( $item_supertitle_style != '' ) {
			$class[] = $prefix . '_item_supertitle_style_' . $item_supertitle_style;
		}

		if ( $item_alignment != '' ) {
			$class[] = $prefix . '_item_alignment_' . $item_alignment;
		}
		
		wp_register_style( 'bold-timeline-footer', false );
		
		if ( $item_body_font != '' && $item_body_font != 'inherit' ) {
			bold_timeline_enqueue_google_font( $item_body_font, $item_font_subset );
			$custom_css = '#' . $el_id . ' { font-family:\'' . urldecode( $item_body_font ) . '\' } ';
			wp_add_inline_style( 'bold-timeline-footer', $custom_css );
		}
		
		if ( $item_title_font != '' && $item_title_font != 'inherit' ) {
			bold_timeline_enqueue_google_font( $item_title_font, $item_font_subset );
			$custom_css  = '#' . $el_id . ' .bold_timeline_item h1, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_item h2, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_item h3, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_item h4, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_item h5, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_item h6 ';
			$custom_css .= ' { font-family:\'' . urldecode( $item_title_font ) . '\' } ';
			wp_add_inline_style( 'bold-timeline-footer', $custom_css );
		}
		
		if ( $group_title_font != '' && $group_title_font != 'inherit' ) {
			bold_timeline_enqueue_google_font( $group_title_font, $group_font_subset );
			$custom_css  = '#' . $el_id . ' .bold_timeline_group_header h1, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_group_header h2, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_group_header h3, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_group_header h4, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_group_header h5, ';
			$custom_css .= '#' . $el_id . ' .bold_timeline_group_header h6 ';
			$custom_css .= ' { font-family:\'' . urldecode( $group_title_font ) . '\' } ';
			wp_add_inline_style( 'bold-timeline-footer', $custom_css );
		}
		
		if ( $el_css != '' ) {
			$el_css = str_replace( '#this', '#' . $el_id , $el_css );
			wp_add_inline_style( 'bold-timeline-footer', $el_css );
		}
		
		if ( $item_media_position != '' ) {
			$class[] = $prefix . '_item_media_position_' . $item_media_position;
		}

		if ( $item_images_columns != '' ) {
			$class[] = $prefix . '_item_images_columns_' . $item_images_columns;
		}

		if ( $item_animation != '' && $item_animation != 'no_animation' ) {
			$item_animations = explode( ' ', $item_animation );
			foreach ( $item_animations as $anim) {
				$class[] = $prefix . '_item_animation_' . $anim;
			}
		}
		
		/* Group properties */
		
		if ( $group_style != '' ) {
			$class[] = $prefix . '_group_style_' . $group_style;
		}
		
		if ( $group_shape != '' ) {
			$class[] = $prefix . '_group_shape_' . $group_shape;
		}
		
		if ( $group_frame_thickness != '' ) {
			$class[] = $prefix . '_group_thickness_' . $group_frame_thickness;
		}
		
		if ( $group_content_display != '' ) {
			$class[] = $prefix . '_group_content_display_' . $group_content_display;
		}
		
		if ( $button_style != '' ) {
			$class[] = $prefix . '_button_style_' . $button_style;
		}
		
		if ( $button_shape != '' ) {
			$class[] = $prefix . '_button_shape_' . $button_shape;
		}
		
		if ( $button_size != '' ) {
			$class[] = $prefix . '_button_size_' . $button_size;
		}

		if ( $group_title_size != '' ) {
			$class[] = $prefix . '_group_title_size_' . $group_title_size;
		}
		
		/* Slider properties */
		
		$data_slick = '';
		
		if ( $slider ) {
			
			$data_slick .= ' ' . 'data-slick=\'{ "lazyLoad": "progressive", "cssEase": "ease-in", "speed": "500", "infinite": false';
			
			if ( $slider_animation == 'fade' ) {
				$data_slick .= ', "fade": true';
				$slider_slides_to_show = 1;
			}
			
			if ( intval( $slider_slides_to_show ) > 1 ) {
				$data_slick .= ',"slidesToShow": ' . intval( $slider_slides_to_show );
				$class[] = $prefix . '_multiple_slides';
			}
			
			if ( $slider_gap != '' ) {
				$class[] = $prefix . '_slider_gap_' . $slider_gap;
			}
			
			if ( $slider_dots_style != 'hide' ) {
				$data_slick .= ', "dots": true, "dotsClass": "bold_timeline_slick_dots"' ;
				$class[] = $prefix . '_slider_dots_style_' . $slider_dots_style;
			}
			
			if ( $slider_arrows_shape != '' ) {
				$class[] = $prefix . '_slider_arrows_shape_' . $slider_arrows_shape;
			}
			
			if ( $slider_arrows_size != '' ) {
				$class[] = $prefix . '_slider_arrows_size_' . $slider_arrows_size;
			}

			if ( $slider_arrows_style != 'hide' ) {
				$data_slick  .= ', "prevArrow": "&lt;button type=\"button\" class=\"bold_timeline_slick_prev bold_timeline_slick_arrow\"&gt;", "nextArrow": "&lt;button type=\"button\" class=\"bold_timeline_slick_next bold_timeline_slick_arrow\"&gt;"';
				$class[] = $prefix . '_slider_arrows_style_' . $slider_arrows_style;
			} else {
				$data_slick  .= ', "prevArrow": "", "nextArrow": ""';
			}
			
			if ( $slider_auto_play != '' && intval( $slider_auto_play ) > 0 ) {
				$data_slick .= ',"autoplay": true, "autoplaySpeed": ' . intval( $slider_auto_play );
			}
			
			if ( is_rtl() ) {
				$data_slick .= ', "rtl": true' ;
			}
			
			if ( $slider_slides_to_show > 1 ) {
				$data_slick .= ', "responsive": [';
				if ( $slider_slides_to_show > 1 ) {
					$data_slick .= '{ "breakpoint": 768, "settings": { "slidesToShow": 1, "slidesToScroll": 1 } }';	
				}
				if ( $slider_slides_to_show > 2 ) {
					$data_slick .= ',{ "breakpoint": 920, "settings": { "slidesToShow": 2, "slidesToScroll": 1 } }';	
				}
				if ( $slider_slides_to_show > 3 ) {
					$data_slick .= ',{ "breakpoint": 1024, "settings": { "slidesToShow": 3, "slidesToScroll": 1 } }';	
				}				
				$data_slick .= ']';
			}
			
			$data_slick = $data_slick . '}\' ';
	
			wp_enqueue_script( 'bt_bb_slick', plugins_url( '../../assets/js/slick/slick.min.js', __FILE__  ), array( 'jquery' ) );
			wp_enqueue_style( 'bt_bb_slick', plugins_url( '../../assets/js/slick/slick.css', __FILE__ ) );
			// wp_enqueue_style( 'bt_bb_slick-theme', plugins_url( '../../assets/js/slick/slick-theme.css', __FILE__ ) );			
			
		}

		$css_override = '';
		Bold_Timeline::$crush_vars = array();
		
		if ( $line_color != '' ) {
			Bold_Timeline::$crush_vars['defaultLineColor'] = $line_color;
			$css_override_temp = $css_override;
			require( dirname(__FILE__) . '/../../css-override-container.php' );
			$css_override = $css_override_temp . $css_override;
		}
		
		if ( $group_frame_color != '' ) {
			Bold_Timeline::$crush_vars['defaultGroupColor'] = $group_frame_color;
			$css_override_temp = $css_override;
			require( dirname(__FILE__) . '/../../css-override-group.php' );
			$css_override = $css_override_temp . $css_override;

		}
		
		if ( $item_background_color != '' || $item_frame_color != '' || $item_icon_color != '' || $item_marker_color != '' || $item_connection_color != '' || $item_sticker_color != '' ) {
			if ( $item_background_color != '' ) {
                Bold_Timeline::$crush_vars['defaultItemBackgroundColor'] = $item_background_color;		
			}
			if ( $item_frame_color != '' ) {
				Bold_Timeline::$crush_vars['defaultFrameColor'] = $item_frame_color;		
			}
			if ( $item_connection_color != '' ) {
				Bold_Timeline::$crush_vars['defaultConnectionColor'] = $item_connection_color;	
			} else {
				Bold_Timeline::$crush_vars['defaultConnectionColor'] = '';
			}
			if ( $item_sticker_color != '' ) {
				Bold_Timeline::$crush_vars['defaultStickerColor'] = $item_sticker_color;	
			} else {
				Bold_Timeline::$crush_vars['defaultStickerColor'] = '';
			}
			if ( $item_icon_color != '' ) {
				Bold_Timeline::$crush_vars['defaultIconColor'] = $item_icon_color;	
			} else {
				Bold_Timeline::$crush_vars['defaultIconColor'] = '';
			}
			if ( $item_marker_color != '' ) {
				Bold_Timeline::$crush_vars['defaultMarkerColor'] = $item_marker_color;
			} else {
				Bold_Timeline::$crush_vars['defaultMarkerColor'] = '';
			}
			
			$css_override_temp = $css_override;
			require( dirname(__FILE__) . '/../../css-override-item.php' );
			$css_override = $css_override_temp . $css_override;
		}
		
		if ( $slider_navigation_color != '' ) {
			
			if ( $slider_navigation_color != '' ) {
				Bold_Timeline::$crush_vars['defaultSliderNavigationColor'] = $slider_navigation_color;
			} else {
				Bold_Timeline::$crush_vars['defaultSliderNavigationColor'] = '';
			}
			
			$css_override_temp = $css_override;
			require( dirname(__FILE__) . '/../../css-override-slider.php' );
			$css_override = $css_override_temp . $css_override;
		}
		
		if ( $button_color != '' ) {
			if ( $button_color != '' ) Bold_Timeline::$crush_vars['defaultButtonColor'] = $button_color;	
			$css_override_temp = $css_override;
			require( dirname(__FILE__) . '/../../css-override-button.php' );
			$css_override = $css_override_temp . $css_override;
		}
		
		/* Output */
		
		$output = '<div class="' . implode( ' ', $class ) . '"' . $id_attr . $style_attr . ' data-css-override="' . $css_override . '">';
			$output .= $line_output;
			$output .= '<div class="bold_timeline_container_content"' . $data_slick . '>';
				$output .= wptexturize( do_shortcode( $content ) );
			$output .= '</div>';
		$output .= '</div>';
		