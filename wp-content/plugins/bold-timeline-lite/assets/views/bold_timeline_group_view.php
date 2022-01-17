<?php		
		$prefix = 'bold_timeline_group';
		$class = array( $prefix );	

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
			$class[] = $responsive;
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . $el_style . '"';
		}		

		if ( $group_style != '' ) {
			$class[] = $prefix . '_override_style_' . $group_style;
		}		

		if ( $group_thickness != '' ) {
			$class[] = $prefix . '_override_thickness_' . $group_thickness;
		}		

		if ( $group_shape != '' ) {
			$class[] = $prefix . '_override_shape_' . $group_shape;
		}	

		if ( $group_content_display != '' ) {
			$class[] = $prefix . '_override_content_display_' . $group_content_display;
		}

		if ( $group_title_size != '' ) {
			$class[] = $prefix . '_override_title_size_' . $group_title_size;
		}
		
		
		if ( $group_title_font != '' && $group_title_font != 'inherit' ) {
			bold_timeline_enqueue_google_font( $group_title_font, $group_font_subset );
			$custom_css  = '#' . $el_id . '.bold_timeline_group .bold_timeline_group_header h1, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_group .bold_timeline_group_header h2, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_group .bold_timeline_group_header h3, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_group .bold_timeline_group_header h4, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_group .bold_timeline_group_header h5, ';
			$custom_css .= '#' . $el_id . '.bold_timeline_group .bold_timeline_group_header h6 ';
			$custom_css .= ' { font-family:\'' . urldecode( $group_title_font ) . '\' } ';
			wp_register_style( 'bold-timeline-footer', false );
			wp_add_inline_style( 'bold-timeline-footer', $custom_css );
		}
		
		$css_override = '';
		
		if ( $group_frame_color != '' ) {
			Bold_Timeline::$crush_vars['defaultGroupColor'] = $group_frame_color;
			$css_override_temp = $css_override;
			require( dirname(__FILE__) . '/../../css-override-group.php' );
			$css_override = $css_override_temp . $css_override;

		}
		
		$class[] = 'bold_timeline_animate';
				
		$output = '<div class="' . implode( ' ', $class ) . '"' . $id_attr . $style_attr . ' data-css-override="' . $css_override . '">';
			$output .= '<div class="bold_timeline_group_inner">';
				if ( $title != '' ) {
						$output .= '<div class="bold_timeline_group_header">';
						$output .= '<div class="bold_timeline_group_header_inner">';
							if ( $title != '' ) $output .= '<' . $group_title_tag . ' class="bold_timeline_group_header_title">' . $title . '</' . $group_title_tag . '>';	
						$output .= '</div>';
					$output .= '</div>';
				}
			$output .= '</div>';
			if ( $content != '' ) {
				$output .= '<div class="bold_timeline_group_content">';
				$output .= wptexturize( do_shortcode( $content ) );
				$output .= '</div>';
				$output .= '<div class="bold_timeline_group_show_button"><div class="bold_timeline_group_show_button_inner">';
				$output .= wptexturize( do_shortcode( '[bold_timeline_item_button title="' . esc_html__( 'Expand', 'bold-timeline' ) . '" style="' . $group_show_button_style . '" shape="' . $group_show_button_shape . '" color="' . $group_show_button_color . '" size="inline" url="#" el_class="bold_timeline_group_button"]' ) );
				$output .= '</div></div>';
			}
		$output .= '</div>';