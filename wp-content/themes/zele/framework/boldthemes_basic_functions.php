<?php

/**
 * Returns heading HTML
 *
 * @param string $superheadline
 * @param string $headline
 * @param string $subheadline
 * @param string $headline_size // small/medium/large/extralarge
 * @param string $dash // no/top/bottom
 * @param string $el_class
 * @param string $el_style
 * @return string
 */
 
 if ( ! function_exists( 'boldthemes_get_heading_html' ) ) {
	function boldthemes_get_heading_html( $args ) {

		if ( !is_array($args) ) return "OLD HEADLINE";
		
		$superheadline = isset ( $args[ "superheadline" ] ) ? $args[ "superheadline" ] : ""; 
		$headline = isset ( $args[ "headline" ] ) ? $args[ "headline" ] : "";
		$subheadline = isset ( $args[ "subheadline" ] ) ? $args[ "subheadline" ] : "";
		$font = isset ( $args[ "font" ] ) ? $args[ "font" ] : "";
		$font_size = isset ( $args[ "font_size" ] ) ? $args[ "font_size" ] : "";
		$font_weight = isset ( $args[ "font_weight" ] ) ? $args[ "font_weight" ] : "";
		$color_scheme = isset ( $args[ "color_scheme" ] ) ? $args[ "color_scheme" ] : "";
		$color = isset ( $args[ "color" ] ) ? $args[ "color" ] : "";
		$align = isset ( $args[ "align" ] ) ? $args[ "align" ] : "";
		$url = isset ( $args[ "url" ] ) ? $args[ "url" ] : "";
		$target = isset ( $args[ "target" ] ) ? $args[ "target" ] : "_self";
		$html_tag = isset ( $args[ "html_tag" ] ) ? $args[ "html_tag" ] : "h2";
		$size = isset ( $args[ "size" ] ) ? $args[ "size" ] : "";
		$dash = isset ( $args[ "dash" ] ) ? $args[ "dash" ] : "";
		$el_id = isset ( $args[ "el_id" ] ) ? $args[ "el_id" ] : "";
		$el_class = isset ( $args[ "el_class" ] ) ? $args[ "el_class" ] : "";
		$el_style = isset ( $args[ "el_style" ] ) ? $args[ "el_style" ] : "";
		
		$supertitle_position = boldthemes_get_option( 'supertitle_position' );
		if ( $supertitle_position ) {
			$supertitle_position = 'outside'; 
		} else {
			$supertitle_position = ''; 
		}
		
                
		if ( shortcode_exists( 'bt_bb_headline' ) ) {

			$superheadline = htmlentities( $superheadline, ENT_QUOTES, 'UTF-8' );
			$subheadline = htmlentities( $subheadline, ENT_QUOTES, 'UTF-8' );
			$headline = htmlentities( $headline, ENT_QUOTES, 'UTF-8' );

			$output = do_shortcode( '[bt_bb_headline superheadline="' . esc_attr( $superheadline ) . '" headline="' . esc_attr( $headline ) . '" subheadline="' . esc_attr( $subheadline ) . '" font="' . esc_attr( $font ) . '" font_weight="' . esc_attr( $font_weight ) . '" font_size="' . esc_attr( $font_size ) . '" color_scheme="' . esc_attr( $color_scheme ) . '" color="' . esc_attr( $color ) . '" align="' . esc_attr( $align ) . '" url="' . esc_attr( $url ) . '" target="' . esc_attr( $target ) . '" html_tag="' . esc_attr( $html_tag ) . '" size="' . esc_attr( $size ) . '" dash="' . esc_attr( $dash ) . '" el_id="' . esc_attr( $el_id ) . '" el_class="' . esc_attr( $el_class  ) . '" el_style="' . esc_attr( $el_style ) . '" supertitle_position="' . esc_attr( $supertitle_position ) . '"]' );

		} else {
			$shortcode = "bt_bb_headline";
			$class[] = "bt_bb_headline";
			$prefix = "bt_bb_";
			
			if ( $el_class != '' ) {
				$class[] = $el_class;
			}

			$id_attr = '';
			if ( $el_id != '' ) {
				$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
			}

			if ( $font != '' && $font != 'inherit' ) {
				$el_style = $el_style . ';' . 'font-family:\'' . urldecode( $font ) . '\'';
			}

			$html_tag_style = '';
			if ( $font_size != '' ) {
				$html_tag_style = ' ' . 'style="font-size:' . $font_size . '"';
			}
			
			if ( $color_scheme != '' && function_exists( 'bt_bb_get_color_scheme_id' ) ) {
				$class[] = $prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
			}

			if ( $color != '' ) {
				$el_style = $el_style . ';' . 'color:' . $color . ';border-color:' . $color . ';';
			}

			if ( $dash != '' ) {
				$class[] = $prefix . 'dash' . '_' . $dash;
			}
			
			if ( $size != '' ) {
				$class[] = $prefix . 'size' . '_' . $size;
			}

			if ( $superheadline != '' ) {
				$class[] = $prefix . 'superheadline';
				$superheadline = '<span class="' . esc_attr( $shortcode ) . '_superheadline">' . $superheadline . '</span>';
			}
			
			if ( $subheadline != '' ) {
				$class[] = $prefix . 'subheadline';
				$subheadline = '<div class="' . esc_attr( $shortcode ) . '_subheadline">' . $subheadline . '</div>';
			}

			$style_attr = '';
			if ( $el_style != '' ) {
				$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
			}

			if ( $align != '' ) {
				$class[] = $prefix . 'align' . '_' . $align;
			}
			
			$headline = nl2br( $headline );

			if ( $url != '' ) {
				$headline = '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '">' . $headline . '</a>';
			}		

			$headline = '<span class="' . esc_attr( $shortcode ) . '_content"><span>' . $headline . '</span></span>';

			$output = '<header' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '><' . $html_tag . $html_tag_style . '>' . $superheadline . $headline . '</' . $html_tag . '>' . $subheadline . '</header>';
		
		}
		
		return $output;	

		
	}
}

/**
 * Returns image with link HTML
 *
 * @param string $image
 * @param string $caption_text
 * @param string $size
 * @param string $url 
 * @param string $target
 * @param string $el_style 
 * @param string $el_class 
 * @return string
 */
 if ( ! function_exists( 'boldthemes_get_image_html' ) ) {
	function boldthemes_get_image_html( $arg ) {
		
		$image = isset( $arg['image'] ) ? $arg['image'] : '';
		$size = isset( $arg['size'] ) ? $arg['size'] : 'large';
		$shape = isset( $arg['shape'] ) ? $arg['shape'] : '';
		$align = isset( $arg['align'] ) ? $arg['align'] : '';
		$url = isset( $arg['url'] ) ? $arg['url'] : '';
		$target = isset( $arg['target'] ) ? $arg['target'] : '';
		$el_style = isset( $arg['el_style'] ) ? $arg['el_style'] : '';
		$el_class = isset( $arg['el_class'] ) ? $arg['el_class'] : '';
		$el_id = isset( $arg['el_id'] ) ? $arg['el_id'] : '';

		$el_style = sanitize_text_field( $el_style );
		$el_class = sanitize_text_field( $el_class );
		
		$prefix = "bt_bb_";
		
	
		if ( shortcode_exists( 'bt_bb_image' ) ) {
			$output = do_shortcode( '[bt_bb_image image="' . $image . '" size="' . $size . '" shape="' . $shape . '" align="' . $align . '" url="' . $url . '" target="' . $target . '" el_style="' . $el_style . '" el_class="' . $el_class . '" el_id="' . $el_id . '"]', false );
		} else {
			$class = array ( 'bt_bb_image' );
			
			if ( $el_class != '' ) {
				$class[] = $el_class;
			}
			
			$id_attr = '';
			if ( $el_id != '' ) {
				$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
			}

			$style_attr = '';
			if ( $el_style != '' ) {
				$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
			}
			
			if ( $shape != '' ) {
				$class[] = $prefix . 'shape' . '_' . $shape;
			}
			
			if ( $align != '' ) {
				$class[] = $prefix . 'align' . '_' . $align;
			}
			
			$title_attr = '';
			$caption = '';
			
			if ( $image != '' && is_numeric( $image ) ) {
				$post_image = get_post( $image );
				if ( $post_image == '' ) return;
				$caption = get_post( $image )->post_excerpt;
				if ( $caption != '' ) {
					$title_attr = ' ' . 'title="' . esc_attr( $caption ) . '"';
				}
				$image = wp_get_attachment_image_src( $image, $size );
				$image = $image[0];
			}
		
			$output = '';
			
			if ( ! empty( $image ) ) {
				$output .= '<img src="' . esc_url( $image ) . '"' . $title_attr . '>';
			}
			
			if ( ! empty( $url ) ) {
				$output = '<a href="' . esc_url( $url ) . '"  target="' . esc_attr( $target ) . '" title="' . esc_attr( $caption ) . '">' . $output . '</a>';
			}
			
			$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $output . '</div>';			
		}
		

		
		return $output;		
		
	}
}

/**
 * Returns button HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @param string $el_style 
 * @param string $target 
 * @return string
 * old: function boldthemes_get_button_html( $icon, $url, $text, $el_class, $el_style = '', $target = '' ) {
 */
 if ( ! function_exists( 'boldthemes_get_button_html' ) ) {
	function boldthemes_get_button_html( $args ) {
		
		if ( !is_array($args) ) return "OLD BUTTON";

		$icon = isset( $args['icon'] ) ? $args['icon'] : '';
		$url = isset( $args['url'] ) ? $args['url'] : '';
		$text = isset( $args['text'] ) ? $args['text'] : '';
		$target = isset( $args['target'] ) ? $args['target'] : '';
		$style = isset( $args['style'] ) ? $args['style'] : '';
		$size = isset( $args['size'] ) ? $args['size'] : '';
		$width = isset( $args['width'] ) ? $args['width'] : '';
		$shape = isset( $args['shape'] ) ? $args['shape'] : '';
		$color_scheme = isset( $args['color_scheme'] ) ? $args['color_scheme'] : '';
		$align = isset( $args['align'] ) ? $args['align'] : '';
		$icon_position = isset( $args['icon_position'] ) ? $args['icon_position'] : '';
		$el_id = isset( $args['el_id'] ) ? $args['el_id'] : '';
		$el_style = isset( $args['el_style'] ) ? $args['el_style'] : '';
		$el_class = isset( $args['el_class'] ) ? $args['el_class'] : '';
		
		if ( shortcode_exists( 'bt_bb_button' ) ) {
			$output = do_shortcode( '[bt_bb_button icon="' . esc_attr( $icon ) . '" text="' . esc_attr( $text ) . '" url="' . esc_attr( $url ) . '" target="' . esc_attr( $target ) . '" style="' . esc_attr( $style ) . '" size="' . esc_attr( $size ) . '" width="' . esc_attr( $width ) . '" shape="' . esc_attr( $shape ) . '" color_scheme="' . esc_attr( $color_scheme ) . '" align="' . esc_attr( $align ) . '" icon_position="' . esc_attr(  $icon_position) . '" el_id="' . esc_attr( $el_id ) . '" el_style="' . esc_attr( $el_style ) . '" el_class="' . esc_attr( $el_class ) . '"]', false );
		} else {
			$shortcode = "bt_bb_button";
			$class[] = "bt_bb_button";
			$prefix = "bt_bb_";
			
			if ( $el_class != '' ) {
				$class[] = $el_class;
			}	
			
			$id_attr = '';
			if ( $el_id != '' ) {
				$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
			}

			$style_attr = '';
			if ( $el_style != '' ) {
				$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
			}
			
			if ( $icon_position != '' ) {
				$class[] = $prefix . 'icon_position' . '_' . $icon_position;
			}
			
			if ( $color_scheme != '' && function_exists( 'bt_bb_get_color_scheme_id' ) ) {
				$class[] = $prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
			}
			
			if ( $style != '' ) {
				$class[] = $prefix . 'style' . '_' . $style;
			}
			
			if ( $size != '' ) {
				$class[] = $prefix . 'size' . '_' . $size;
			}
			
			if ( $width != '' ) {
				$class[] = $prefix . 'width' . '_' . $width;
			}
			
			if ( $shape != '' ) {
				$class[] = $prefix . 'shape' . '_' . $shape;
			}
			
			if ( $align != '' ) {
				$class[] = $prefix . 'align' . '_' . $align;
			}

			if ( $url == '' ) {
				$url = '#';
			}
			
			if ( $target == '' ) {
				$target = '_self';
			}

			if ( $text != '' ) {
				$text = '<span class="bt_bb_button_text">' . $text . '</span>';
			}

			$link = boldthemes_get_permalink_by_slug( $url );

			$output = '<a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">';
				if ( $icon == '' || $icon == 'no_icon' ) {
					$output .= $text;
				} else {
					$icon_set = substr( $icon, 0, -5 );
					$icon = substr( $icon, -4 );
					$output .= $text . '<span data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';" class="bt_bb_icon_holder"></span>';;
				}
			$output .= '</a>';
			
			$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . '>' . $output . '</div>'; 			
		}
	

		
		return $output;
	}
}

/**
 * Returns icon HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @return string
 */
 if ( ! function_exists( 'boldthemes_get_icon_html' ) ) {
	function boldthemes_get_icon_html( $args ) {
			
		if ( !is_array($args) ) return "OLD ICON";
			
		$icon = isset( $args['icon'] ) ? $args['icon'] : '';
		$url = isset( $args['url'] ) ? $args['url'] : '';;
		$url_title = isset( $args['url_title'] ) ? $args['url_title'] : '';
		$text = isset( $args['text'] ) ? $args['text'] : '';
		$content = isset( $args['content'] ) ? $args['content'] : '';
		$size = isset( $args['size'] ) ? $args['size'] : '';
		$shape = isset( $args['shape'] ) ? $args['shape'] : '';
		$style = isset( $args['style'] ) ? $args['style'] : '';
		$color_scheme = isset( $args['color_scheme'] ) ? $args['color_scheme'] : '';
		$target = isset( $args['target'] ) ? $args['target'] : '';
		$align = isset( $args['align'] ) ? $args['align'] : '';
		$el_id = isset( $args['el_id'] ) ? $args['el_id'] : '';
		$el_style = isset( $args['el_style'] ) ? $args['el_style'] : '';
		$el_class = isset( $args['el_class'] ) ? $args['el_class'] : '';
		
		
		
		if ( shortcode_exists( 'bt_bb_icon' ) ) {
			$output = do_shortcode( '[bt_bb_icon icon="' . esc_attr( $icon ) . '" url_title="' . esc_attr( $url_title ) . '" url="' . esc_attr( $url ) . '" text="' . esc_attr( $text ) . '" content="' . esc_attr( $content ) . '" size="' . esc_attr(  $size) . '" shape="' . esc_attr( $shape ) . '" style="' . esc_attr( $style ) . '" color_scheme="' . esc_attr( $color_scheme ) . '" url="' . esc_attr( $url ) . '" target="' . esc_attr( $target ) . '" align="' . esc_attr( $align ) . '" icon="' . esc_attr( $icon ) . '" el_id="' . esc_attr( $el_id ) . '" el_style="' . esc_attr( $el_style ) . '" el_class="' . esc_attr( $el_class ) . '"]', false );
		} else {
		
			$shortcode = "bt_bb_icon";
			$class[] = "bt_bb_icon";
			$prefix = "bt_bb_";
			
			if ( $el_class != '' ) {
				$class[] = $el_class;
			}

			$id_attr = '';
			if ( $el_id != '' ) {
				$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
			}

			$style_attr = '';
			if ( $el_style != '' ) {
				$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
			}
			
			if ( $color_scheme != '' && function_exists( 'bt_bb_get_color_scheme_id' ) ) {
				$class[] = $prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
			}

			if ( $style != '' ) {
				$class[] = $prefix . 'style' . '_' . $style;
			}

			if ( $size != '' ) {
				$class[] = $prefix . 'size' . '_' . $size;
			}

			if ( $shape != '' ) {
				$class[] = $prefix . 'shape' . '_' . $shape;
			}
			
			if ( $align != '' ) {
				$class[] = $prefix . 'align' . '_' . $align;
			}

			$icon_set = substr( $icon, 0, -5 );
			$icon = substr( $icon, -4 );

			if ( substr( $url, 0, 3 ) == 'www' ) {
				$url = 'http://' . $url;
			}

			$link = boldthemes_get_permalink_by_slug( $url );

			if ( $text != '' ) {
				$text = '<span>' . $text . '</span>';
			}

			if ( $link == '' ) {
				$ico_tag = 'span' . ' ';
				$ico_tag_end = 'span';	
			} else {
				$target_attr = 'target="_self"';
				if ( $target != '' ) {
					$target_attr = ' ' . 'target="' . ( $target ) . '"';
				}
				$ico_tag = 'a href="' . esc_url( $link ) . '"' . ' ' . $target_attr;
				$ico_tag_end = 'a';
			}

			$output = '<' . $ico_tag . ' title="' . esc_attr( $url_title ) . '" data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';" class="bt_bb_icon_holder">' . $text . '</' . $ico_tag_end . '>';

			$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $output . '</div>';
		
		}
		return $output;	
			
	}
}

/**
 * Returns the permalink for a page based on the incoming slug.
 *
 * @param   string  $slug   The slug of the page to which we're going to link.
 * @return  string          The permalink of the page
 */
 if ( ! function_exists( 'boldthemes_get_permalink_by_slug' ) ) {
	function boldthemes_get_permalink_by_slug( $slug, $post_type = 'any' ) {
		if ( $slug != '' && $slug != '#' && substr( $slug, 0, 4 ) != 'http' && substr( $slug, 0, 5 ) != 'https' && substr( $slug, 0, 6 ) != 'mailto' ) {
			$permalink = null;
			$args = array(
				'name'          => $slug,
				'max_num_posts' => 1
			);
			
			$args = array_merge( $args, array( 'post_type' => $post_type ) );
			
			$query = new WP_Query( $args );
			if( $query->have_posts() ) {
				$query->the_post();
				$permalink = get_permalink( get_the_ID() );
				wp_reset_postdata();
			}
			if ( $permalink ) {
				return $permalink;
			}
			return $slug;
		} else {
			return $slug;
		}

	}
}

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Get all pages
 */
if ( ! function_exists( 'boldthemes_get_all_pages' ) ) {
	function boldthemes_get_all_pages() {
		$defaults = array(
			'depth'                 => 0,
			'child_of'              => 0,
			'selected'              => 0,
			'echo'                  => 1,
			'name'                  => 'page_id',
			'id'                    => '',
			'class'                 => '',
			'show_option_none'      => '',
			'show_option_no_change' => '',
			'option_none_value'     => '',
			'value_field'           => 'ID',
		);
 
		$pages = get_pages( $defaults );
		
		$r = array( '' => '' );

		foreach( $pages as $page ) {
			$parent_id = $page->post_parent;
			$depth = 0;
			$pre = '';
			while( $parent_id > 0 ) {
				$page1 = get_page( $parent_id );
				$parent_id = $page1->post_parent;
				$depth++;
				$pre .= '&nbsp;&nbsp;&nbsp;';
			}
			$r[ $page->post_name ] = $pre . $page->post_title;
		}
		
		return $r;
		
	}
}