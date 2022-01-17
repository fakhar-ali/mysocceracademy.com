<?php
		$prefix = 'bold_timeline_item';
		$class = array( $prefix );
		
		if ( $el_id == '' ) {
			$el_id = 'id_' . uniqid();
		}else{
			$el_id = 'id_' . $el_id . '_' . uniqid();
		}		
		$id_attr = ' ' . 'id="' . $el_id . '"';
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
                
        if ( $responsive != '' ) {
			$class[] = $responsive;
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . $el_style . '"';
		}		

		if ( $item_style != '' ) {
			$class[] = $prefix . '_override_style_' . $item_style;
		}
		
		if ( $item_shape != '' ) {
			$class[] = $prefix . '_override_shape_' . $item_shape;
		}

		if ( $item_frame_thickness != '' ) {
			$class[] = $prefix . '_override_frame_thickness_' . $item_frame_thickness;
		}
		
		if ( $item_connection_type != '' ) {
			$class[] = $prefix . '_override_connection_type_' . $item_connection_type;
		}
		
		if ( $item_content_display != '' ) {
			$class[] = $prefix . '_override_content_display_' . $item_content_display;
		}

		if ( $item_animation != '' ) {
			$item_animations = explode( ' ', $item_animation );
			foreach ( $item_animations as $anim) {
				$class[] = $prefix . '_override_animation_' . $anim;
			}
		}
		$class[] = 'bold_timeline_animate';

		if ( $item_marker_type != '' ) {
			$class[] = $prefix . '_override_marker_type_' . $item_marker_type;
		}
		
		if ( $item_icon_position != '' ) {
			$class[] = $prefix . '_override_icon_position_' . $item_icon_position;
		}
		
		if ( $item_icon_style != '' ) {
			$class[] = $prefix . '_override_icon_style_' . $item_icon_style;
		}
		
		if ( $item_icon_shape != '' ) {
			$class[] = $prefix . '_override_icon_shape_' . $item_icon_shape;
		}
		
		if ( $item_media_position != '' ) {
			$class[] = $prefix . '_override_media_position_' . $item_media_position;
		}

		if ( $item_title_size != '' ) {
			$class[] = $prefix . '_override_title_size_' . $item_title_size;
		}

		if ( $item_supertitle_style != '' ) {
			$class[] = $prefix . '_override_supertitle_style_' . $item_supertitle_style;
		}

		if ( $item_alignment != '' ) {
			$class[] = $prefix . '_override_alignment_' . $item_alignment;
		}
		
		if ( $item_title_font != '' && $item_title_font != 'inherit' ) {
			bold_timeline_enqueue_google_font( $item_title_font, $item_font_subset );
			$custom_css  = '#' . $el_id . '.bold_timeline_item h1, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_item h2, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_item h3, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_item h4, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_item h5, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_item h6 ';
			$custom_css .= ' { font-family:\'' . urldecode( $item_title_font ) . '\' } ';
			wp_register_style( 'bold-timeline-footer', false );
			wp_add_inline_style( 'bold-timeline-footer', $custom_css );
		}
		
		if ( $item_body_font != '' && $item_body_font != 'inherit' ) {
			bold_timeline_enqueue_google_font( $item_body_font, $item_font_subset );
			$custom_css = '#' . $el_id . '.bold_timeline_item { font-family:\'' . urldecode( $item_body_font ) . '\' } ';
			wp_register_style( 'bold-timeline-footer', false );
			wp_add_inline_style( 'bold-timeline-footer', $custom_css );
		}
		
		if ( $icon != '' ) {
			$class[] = $prefix . '_has_icon';
		}

		if ( $item_images_columns != '' ) {
			$class[] = $prefix . '_override_images_columns_' . $item_images_columns;
		}
		
		$header_class = array( 'bold_timeline_item_header' ); 
		if ( $content == '' ) $header_class[] = 'bold_timeline_item_header_no_content';
		
		$images = explode( ',', $images );
		$images_str = '';
		foreach ( $images as $image ) {
			if ( isset( $image ) && $image != '' ) {
				$image_attributes = wp_get_attachment_image_src( $image, 'medium_large' );
				if ( $image_attributes && $image_attributes[0] != '' ) $images_str .= '<div class="bold_timeline_item_media_image"><img src="' . $image_attributes[0] . '"></div>';
			} 
		}
		
		$video_str = '';
		if ( $video != '' ) {
			$video_str .= '<div class="bold_timeline_item_media_video_inner">';
			$video_str .= do_shortcode( '[video src="' . $video . '"]' );
			$video_str .= '</div>';	
		}		
		
		$audio_str = '';
		if ( $audio != '' ) {
			$audio_str .= '<div class="bold_timeline_item_media_audio_inner">';
			$audio_str .= do_shortcode( '[audio src="' . $audio . '"]' );
			// https://en.support.wordpress.com/soundcloud-audio-player/
			// https://help.soundcloud.com/hc/en-us/articles/115003565128-Embedding-a-track-or-playlist-on-WordPress
			$audio_str .= '</div>';	
		}
		
		$css_override = '';
		Bold_Timeline::$crush_vars = array();
		
		if ( $item_background_color != '' || $item_frame_color != '' || $item_icon_color != '' || $item_marker_color != '' || $item_connection_color != '' || $item_sticker_color != '' ) {
			if ( $item_background_color != '' ) {
				Bold_Timeline::$crush_vars['defaultItemBackgroundColor'] = $item_background_color;
			} else {
				Bold_Timeline::$crush_vars['defaultItemBackgroundColor'] = '';
			}
			if ( $item_frame_color != '' ) {
				Bold_Timeline::$crush_vars['defaultFrameColor'] = $item_frame_color;
			} else {
				Bold_Timeline::$crush_vars['defaultFrameColor'] = '';
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
			Bold_Timeline::$crush_vars['defaultButtonColor'] = '';
			require( dirname(__FILE__) . '/../../css-override-item.php' );
		}
		
		$output = '<div class="' . implode( ' ', $class ) . '"' . $id_attr . $style_attr . ' data-css-override="' . $css_override . '" data-margin-top="0">';
			if ( $icon != '' ) {
				$icon_set = substr( $icon, 0, -5 );
				$icon = substr( $icon, -4 );
				$output .= '<div class = "bold_timeline_item_icon" data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';"></div>';
			}
			$output .= '<div class = "bold_timeline_item_marker"></div>';
			$output .= '<div class = "bold_timeline_item_connection"></div>';
			$output .= '<div class="bold_timeline_item_inner">';
				$output .= '<div class="' . implode( ' ', $header_class ) . '">';
					$output .= '<div class="bold_timeline_item_header_inner">';
						if ( $supertitle != '' ) $output .= '<p class="bold_timeline_item_header_supertitle"><span class="bold_timeline_item_header_supertitle_inner">' . $supertitle . '</span></p>';
						if ( $title != '' ) $output .= '<' . $item_title_tag . ' class="bold_timeline_item_header_title">' . $title . '</' . $item_title_tag . '>';
						if ( $subtitle != '' ) $output .= '<p class="bold_timeline_item_header_subtitle">' . $subtitle . '</p>';
					$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="bold_timeline_item_content">';
					if ( $content != '' ) $output .= '<div class="bold_timeline_item_content_inner">' . wptexturize( do_shortcode( $content ) ) . '</div>';
					if ( $images_str != '' || $video_str != '' || $audio_str != '' ) {
						$output .= '<div class="bold_timeline_item_media">';
							$output .= '<div class="bold_timeline_item_media_inner">';
								if ( $images_str != '' ) $output .= '<div class="bold_timeline_item_media_images">' . $images_str . '</div>';
								if ( $video_str != '' ) $output .= '<div class="bold_timeline_item_media_video">' . $video_str . '</div>';
								if ( $audio_str != '' ) $output .= '<div class="bold_timeline_item_media_audio">' . $audio_str . '</div>';
							$output .= '</div>';					
						$output .= '</div>';					
					}
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';