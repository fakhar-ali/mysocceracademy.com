<?php

/**
 * Custom fonts
 */

if ( ! function_exists( 'boldthemes_custom_font' ) ) {
	function boldthemes_custom_font( $font ) {
		if ( array_key_exists( $font, BoldThemesFramework::$custom_fonts ) ) {
			BoldThemesFramework::$custom_fonts_enqueue[ $font ] = $font;
			return ''; // do not enqueue as google font
		}
		return $font;
	}
}

if ( ! function_exists( 'boldthemes_enqueue_custom_fonts' ) ) {
	function boldthemes_enqueue_custom_fonts() {
		foreach ( BoldThemesFramework::$custom_fonts as $item ) {
			$font_family = $item['font'];
			foreach ( $item['variants'] as $variant_key => $variant_arr ) {
				echo '<style>';
				echo '@font-face{';
					echo 'font-family:"' . esc_html( $font_family ) . '";';
					if ( stripos( $variant_key, 'italic' ) !== false ) {
						echo 'font-style:italic;';
					} else {
						echo 'font-style:normal;';
					}
					if ( $variant_key == 'regular' || $variant_key == 'italic' ) {
						echo 'font-weight:400;';
					} else {
						echo 'font-weight:' . intval( $variant_key ) . ';';
					}
					echo 'src:';
					if ( isset( $variant_arr['woff2'] ) ) {
						echo 'url(' . esc_url( $variant_arr['woff2'] ) . ')format("woff2")';
						if ( isset( $variant_arr['woff'] ) || isset( $variant_arr['ttf'] ) ) {
							echo ',';
						}
					}
					if ( isset( $variant_arr['woff'] ) ) {
						echo 'url(' . esc_url( $variant_arr['woff'] ) . ')format("woff")';
						if ( isset( $variant_arr['ttf'] ) ) {
							echo ',';
						}
					}
					if ( isset( $variant_arr['ttf'] ) ) {
						echo 'url(' . esc_url( $variant_arr['ttf'] ) . ')format("truetype")';
					}
					echo ';';
				echo '}';
				echo '</style>';
			}
		}
		BoldThemesFramework::$custom_fonts_enqueue = array();
	}
}

if ( ! function_exists( 'boldthemes_get_custom_fonts' ) ) {
	function boldthemes_get_custom_fonts( $arr ) {
		$base_dir = $arr['base_dir'];
		$base_uri = $arr['base_uri'];
		$glob_match = glob( $base_dir . '/custom-fonts/*' );
		if ( $glob_match ) {
			foreach( $glob_match as $font_dir ) {
				if ( is_dir( $font_dir ) ) {
					preg_match( '/[^\\\\\/]+$/', $font_dir, $font_dir_match );
					$font_name = $font_dir_match[0];
					BoldThemesFramework::$custom_fonts[ $font_name ] = array(
						'font' => $font_name,
						'variants' => array()
					);
					foreach ( glob( $font_dir . '/*' ) as $font_file ) {
						if ( is_file( $font_file ) ) {
							preg_match( '/[^\\\\\/]+\.[^\.]+$/i', $font_file, $font_file_match );
							$file_name = $font_file_match[0];
							if ( stripos( $file_name, '.woff2' ) ) {
								if ( stripos( $file_name, '-' ) ) {
									preg_match( '/\-([^\-]+)\.[^\.]+$/', $file_name, $m );
									$variant = strtolower( $m[1] );
									BoldThemesFramework::$custom_fonts[ $font_name ]['variants'][ $variant ]['woff2'] = $base_uri . '/custom-fonts/' . $font_name . '/' . $file_name;
								} else {
									BoldThemesFramework::$custom_fonts[ $font_name ]['variants']['regular']['woff2'] = $base_uri . '/custom-fonts/' . $font_name . '/' . $file_name;
								}
							} else if ( stripos( $file_name, '.woff' ) ) {
								if ( stripos( $file_name, '-' ) ) {
									preg_match( '/\-([^\-]+)\.[^\.]+$/', $file_name, $m );
									$variant = strtolower( $m[1] );
									BoldThemesFramework::$custom_fonts[ $font_name ]['variants'][ $variant ]['woff'] = $base_uri . '/custom-fonts/' . $font_name . '/' . $file_name;
								} else {
									BoldThemesFramework::$custom_fonts[ $font_name ]['variants']['regular']['woff'] = $base_uri . '/custom-fonts/' . $font_name . '/' . $file_name;
								}
							} else if ( stripos( $file_name, '.ttf' ) ) {
								if ( stripos( $file_name, '-' ) ) {
									preg_match( '/\-([^\-]+)\.[^\.]+$/', $file_name, $m );
									$variant = strtolower( $m[1] );
									BoldThemesFramework::$custom_fonts[ $font_name ]['variants'][ $variant ]['ttf'] = $base_uri . '/custom-fonts/' . $font_name . '/' . $file_name;
								} else {
									BoldThemesFramework::$custom_fonts[ $font_name ]['variants']['regular']['ttf'] = $base_uri . '/custom-fonts/' . $font_name . '/' . $file_name;
								}
							}
						}
					}
				}
			}
		}
	}
}

$template_dir = get_template_directory();
$stylesheet_dir = get_stylesheet_directory();
if ( $template_dir != $stylesheet_dir ) {
	boldthemes_get_custom_fonts( array( 'base_dir' => $template_dir, 'base_uri' => get_template_directory_uri() ) );
	boldthemes_get_custom_fonts( array( 'base_dir' => $stylesheet_dir, 'base_uri' => get_stylesheet_directory_uri() ) );
} else {
	boldthemes_get_custom_fonts( array( 'base_dir' => $stylesheet_dir, 'base_uri' => get_stylesheet_directory_uri() ) );
}

/**
 * Header headline output
 */

if ( ! function_exists( 'boldthemes_header_headline' ) ) {
	function boldthemes_header_headline( $arg = array() ) {

		$extra_class = 'btPageHeadline';
		
		$dash  = '';
		$use_dash = boldthemes_get_option( 'sidebar_use_dash' );
		if ( is_singular( 'post' ) ) {
			$use_dash = boldthemes_get_option( 'blog_use_dash' );
		} else if ( is_singular( 'product' ) ) {
			$use_dash = boldthemes_get_option( 'shop_use_dash' );
		}  else if ( is_singular( 'portfolio' ) ) {
			$use_dash = boldthemes_get_option( 'pf_use_dash' );
		} 
		if ( $use_dash ) $dash  = apply_filters( 'boldthemes_header_headline_dash', 'top' );
		if ( is_front_page() ) {
			$title = get_bloginfo( 'description' );
		} else if ( is_singular() ) {
			$title = get_the_title();
		} else {
			$title = wp_title( '', false );
		}
		
		$excerpt = '';
		
		if ( BoldThemesFramework::$page_for_header_id != '' ) {
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id( BoldThemesFramework::$page_for_header_id ) );
			
			$excerpt = boldthemes_get_the_excerpt( BoldThemesFramework::$page_for_header_id );
			if ( ! $feat_image ) {
				if ( is_singular() && ! is_singular( 'product' ) ) {
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
				} else {
					$feat_image = false;
				}
			}
		} else {
			if ( is_singular() ) {
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
			} else {
				$feat_image = false;
			}
			if ( is_singular() ) {
				$excerpt = boldthemes_get_the_excerpt( get_the_ID() );
			}
		}
		
		$parallax = isset( $arg['parallax'] ) ? $arg['parallax'] : apply_filters( 'boldthemes_header_headline_parallax', '0.8' );
		$parallax_class = 'bt_bb_parallax';
		if ( wp_is_mobile() ) {
			$parallax = 0;
			$parallax_class = '';
		}
		
		$supertitle = '';
		$subtitle = $excerpt;
		
		$breadcrumbs = isset( $arg['breadcrumbs'] ) ? $arg['breadcrumbs'] : true;
		
		if ( $breadcrumbs ) {
			$heading_args = boldthemes_breadcrumbs( false, $title, $subtitle );
			$supertitle = $heading_args['supertitle'];
			$title = $heading_args['title'];
			$subtitle = $heading_args['subtitle'];
		}
		
		if ( $title != '' || $supertitle != '' || $subtitle != '' ) {
			$extra_class .= $feat_image ? ' bt_bb_background_image ' . apply_filters( 'boldthemes_header_headline_gradient', 'bt_bb_background_overlay_dark_solid' ) . ' ' . $parallax_class . ' ' . apply_filters( 'boldthemes_header_headline_skin', 'btDarkSkin' ) . ' ' : ' ';
			echo '<section class="bt_bb_section gutter bt_bb_vertical_align_top ' . esc_attr( $extra_class ) . '" style="background-image:url(' . esc_url( $feat_image ) . ')" data-parallax="' . esc_attr( $parallax ) . '" data-parallax-offset="0">';
				echo '<div class="bt_bb_port port">';
					echo '<div class="bt_bb_cell">';
						echo '<div class="bt_bb_cell_inner">';
							echo '<div class = "bt_bb_row">';
								echo '<div class="bt_bb_column">';
									echo '<div class="bt_bb_column_content">';
										echo wp_kses_post( boldthemes_get_heading_html( 
											array(
												'superheadline' => $supertitle,
												'headline' => $title,
												'subheadline' => $subtitle,
												'html_tag' => 'h1',
												'size' => apply_filters( 'boldthemes_header_headline_size', 'large' ),
												'dash' => $dash,
												'el_style' => '',
												'el_class' => ''
											)
										) );
										echo '</div><!-- /rowItemContent -->' ;
									echo '</div><!-- /rowItem -->';
							echo '</div><!-- /boldRow -->';
						echo '</div><!-- boldCellInner -->';	
					echo '</div><!-- boldCell -->';			
				echo '</div><!-- port -->';
			echo '</section>';
		}
		
	}
}

if ( ! function_exists( 'boldthemes_get_new_media_html' ) ) {
	function boldthemes_get_new_media_html( $arg = array() ) { 

		$type = isset( $arg['type'] ) ? $arg['type'] : '';

		$featured_image = isset( $arg['featured_image'] ) ? $arg['featured_image'] : '';
		$featured_image_caption = isset( $arg['featured_image_caption'] ) ? $arg['featured_image_caption'] : '';
		$images = isset( $arg['images'] ) ? $arg['images'] : '';
		$format = isset( $arg['format'] ) ? $arg['format'] : '';
		$gallery_type = isset( $arg['gallery_type'] ) ? $arg['gallery_type'] : '';
		$video = isset( $arg['video'] ) ? $arg['video'] : '';
		$audio = isset( $arg['audio'] ) ? $arg['audio'] : '';
		$quote = isset( $arg['quote'] ) ? $arg['quote'] : '';
		$quote_author = isset( $arg['quote'] ) ? $arg['quote_author'] : '';
		$link_title = isset( $arg['quote'] ) ? $arg['link_title'] : '';
		$link_url = isset( $arg['quote'] ) ? $arg['link_url'] : '';
		$size = isset( $arg['size'] ) ? $arg['size'] : 'full';
		$permalink = isset( $arg['permalink'] ) ? $arg['permalink'] : '';
		$title = isset( $arg['title'] ) ? $arg['title'] : '';		
		
		$html = '';
		
		if ( $video != '' ) {
			
			$hw = 9 / 16;
			
			$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '"><div class="bt-video-container">';

			if ( strpos( $video, 'vimeo.com/' ) > 0 ) {
				$video_id = substr( $video, strpos( $video, 'vimeo.com/' ) + 10 );
				$html .= '<ifra' . 'me src="' . esc_url( 'https://player.vimeo.com/video/' . $video_id ) . '" allowfullscreen></ifra' . 'me>';
			} else {
				$yt_id_pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
				$youtube_id = ( preg_replace( $yt_id_pattern, '$1', $video ) );
				if ( strlen( $youtube_id ) == 11 ) {
					$html .= '<ifra' . 'me width="560" height="315" src="' . esc_url( 'https://www.youtube.com/embed/' . $youtube_id ) . '" allowfullscreen></ifra' . 'me>';
				} else {
					$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '">';				
					$html .= do_shortcode( $video );
				}
			}
			$html .= '</div></div>';
			
		} else if ( $audio != '' ) {
		
			if ( strpos( $audio, '</ifra' . 'me>' ) > 0 ) {
				$html = '<div class="btMediaBox audio">' . wp_kses( $audio, 'audio' ) . '</div>';
			} else {
				$html = '<div class="btMediaBox audio">' . do_shortcode( $audio ) . '</div>';
			}
	
		} else if ( $link_url != '' ) {
			$bt_link_bg_image = '';
			if ( $featured_image != '' ) $bt_link_bg_image .= " style='background-image: url(" . esc_url( $featured_image ) . ")'";
			$html = '<div class="btMediaBox bt-dark-skin btLink"' . $bt_link_bg_image . '><blockquote><p><a href="' . esc_url( $link_url ) . '">' . $link_title . '</a></p><cite><a href="' . esc_url( $link_url ) . '">' . $link_url . '</a></cite></blockquote></div>';
	
		} else if ( $quote != '' ) {
			$bt_quote_bg_image = '';
			if ( $featured_image != '' ) $bt_quote_bg_image .= " style='background-image: url(" . esc_url( $featured_image ) . ")'";
			$html = $quote;
			if ( $permalink != '' ) $html = '<a href="' . esc_url( $permalink ) . '" title="' . esc_attr( $title ) . '">' . $html .'</a>';
			$html = '<div class="btMediaBox btQuote bt-dark-skin"' . $bt_quote_bg_image . '><blockquote><p>' . $html . '</p><cite>' . $quote_author . '</cite></blockquote></div>';
	
		} else if ( count( $images ) > 0 ) {
			if ( $gallery_type == 'carousel' ) {
				$html = '<div class="btMediaBox">';
					if ( shortcode_exists( 'bt_bb_slider' ) ) {
						$image_urls = array();
						$image_ids = array();
						foreach( $images as $image ) {
							$image_urls[] = $image['url'];
							$image_ids[] = $image['ID'];
						}
						$html .= do_shortcode( '[bt_bb_slider images="' . implode( ',', $image_ids ) . '" show_dots="bottom" height="auto" auto_play="3000" animation="fade"]' );
					}
				$html .= '</div>';
			} else {
				$html = '<div class="btMediaBox">';
					if ( shortcode_exists( 'bt_bb_masonry_image_grid' ) ) {
						$image_ids = array();
						foreach( $images as $image ) {
							$image_ids[] = $image['ID'];
						}
						$prefix = 'blog';
						if ( $type == 'single-portfolio' ) {
							$prefix = 'pf';
						}
						$html .= do_shortcode( '[bt_bb_masonry_image_grid images="' . implode( ',', $image_ids ) . '" columns="' . boldthemes_get_option( $prefix . '_grid_gallery_columns' ) .  '" gap="' . boldthemes_get_option( $prefix . '_grid_gallery_gap' ) .  '"]' );
					}
				$html .= '</div>';
			}
		} else if ( $featured_image != '' ) {	
			$html = '<img src="' . esc_url( $featured_image ) . '" alt="' . esc_attr( wp_strip_all_tags( $title ) ) . '"/>';
			if ( $permalink != '' ) $html = '<a href="' . esc_url( $permalink ) . '" title="' . esc_attr( wp_strip_all_tags( $title ) ) . '">' . $html .'</a>';
			if ( $featured_image_caption != '' ) {
				$html .= '<div class="btMediaBoxCaption">' . $featured_image_caption . '</div>';
			} 
			$html = '<div class="btMediaBox">' . $html . '</div>';
		}

		return $html;
		
	}
}

/**
 * Post media HTML
 *
 * @param string
 * @param array
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_media_html' ) ) {
	function boldthemes_get_media_html( $type, $data ) {
		
		$html = 'OLD MEDIA!!!';
		return $html;
	}
}

/**
 * Returns share icons HTML
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_share_html' ) ) {
	function boldthemes_get_share_html( $permalink, $type = 'blog', $size = 'small', $style = 'filled', $shape = 'circle', $color_scheme = '' ) {
		if ( function_exists( 'boldthemes_get_share_html2' ) ) {
			return boldthemes_get_share_html2( $permalink, $type, $size, $style, $shape, $color_scheme );
		}
	}
}

/**
 * Logo
 */
if ( ! function_exists( 'boldthemes_logo' ) ) {
	function boldthemes_logo( $type = 'header' ) {
		$logo = boldthemes_get_option( 'logo' );
		$alt_logo = boldthemes_get_option( 'alt_logo' );        
		$hw = '';
		if ( ! is_string( $logo ) ) { // erased from disk
			$logo = '';
		}
		if ( $logo != '' ) {
			$image_id = 0;
			if( is_numeric( $logo ) ) {
				$image_id = $logo + 0;
			} else {
				$tmp = $logo;
				if ( strpos( $logo, '/wp-content' ) === 0 ) {
					$logo = get_home_url() . $logo;
				}
				$image_id = attachment_url_to_postid( $logo );
				if ( $image_id == 0 ) {
					$logo = $tmp;
				}
				$image_id = attachment_url_to_postid( $logo );
			}
			if( $image_id > 0) {
				$image = wp_get_attachment_image_src( $image_id, 'full' );                               
				if ( $image ) {
					if ( is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1 ) {              
						// fix svg logo dimensions
						$image[1] = $image[2] = null;                
						$xml = '';
						$allow_url = ini_get('allow_url_fopen');
						if ( $allow_url ){                            
							$xml = simplexml_load_file($image[0]);                           
						} else {
							$args['curl_url'] = $image[0];
							$xml = boldthemes_get_curl($args);
							$xml = simplexml_load_string($xml);
						}
						if ( $xml ) {
							$attr = $xml->attributes();
							$viewbox = explode(' ', $attr->viewBox);
							$image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
							$image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
						}
					} 
					$logo = $image[0];
					$width = $image[1];
					$height = $image[2];
					if ( $height != 0 ) {
						$hw = $width / $height;
					} else {
						$meta = wp_get_attachment_metadata( $image_id );
						$width  = isset($meta['width']) ? $meta['width'] : 0;
						$height = isset($meta['height']) ? $meta['height'] : 0;
						if ( $height != 0 ) {
							$hw = $width / $height;
						} 
					}					
				} else {
					$logo = '';
				}
			} else {
				$logo = '';
			}
		}

		if ( ! is_string( $alt_logo ) ) { // erased from disk
			$alt_logo = '';
		}
		
		if ( $alt_logo != '' ) {
			$image_id = 0;
			if( is_numeric( $alt_logo ) ) {
				$image_id = $alt_logo + 0;
			} else {
				$tmp = $alt_logo;
				if ( strpos( $alt_logo, '/wp-content' ) === 0 ) {
					$alt_logo = get_home_url() . $alt_logo;
				}
				$image_id = attachment_url_to_postid( $alt_logo );
				if ( $image_id == 0 ) {
					$alt_logo = $tmp;
				}
				$image_id = attachment_url_to_postid( $alt_logo );		
			}
			
			if( $image_id > 0) {
				$image = wp_get_attachment_image_src( $image_id, 'full' );
				if ( $image ) {
					$alt_logo = $image[0];		
				} else {
					$alt_logo = '';
				}
			} else {
				$alt_logo = '';
			}
		}

		$home_link =  home_url( '/' ) ;
		if ( $logo != '' && $logo != ' ' ) {
			if ( $type == 'header' ) {
				echo '<a href="' . esc_url( $home_link ) . '"><img class="btMainLogo" data-hw="' . esc_attr( $hw ) . '" src="' . esc_attr( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				if ( $alt_logo != '' && $alt_logo != ' ' ) echo '<img class="btAltLogo" src="' . esc_attr( $alt_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				echo '</a>';
			} else if ( $type == 'footer' ) {
				echo '<a href="' . esc_url( $home_link ) . '"><img src="' . esc_attr( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
			} else if ( $type == 'preloader' ) {
				echo '<img class="preloaderLogo" src="' . esc_attr( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" data-alt-logo="' . esc_attr( $alt_logo ) . '">';
			}
		} else {
			echo '<a href="' . esc_url( $home_link ) . '" class="btTextLogo">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
		}
	}
}

/**
 * Top bar HTML output
 */
 if ( ! function_exists( 'boldthemes_top_bar_html' ) ) {
	function boldthemes_top_bar_html( $type = 'top', $menu_type = '' ) {
		
		if ( $type == 'top' ) {
			if ( is_active_sidebar( 'header_left_widgets' ) || is_active_sidebar( 'header_right_widgets' ) ) { ?>
				<div class="topBar bt-clear">
					<div class="topBarPort port bt-clear">
						<?php if ( is_active_sidebar( 'header_left_widgets' ) ) { ?>
						<div class="topTools btTopToolsLeft">
							<?php dynamic_sidebar( 'header_left_widgets' ); ?>
						</div><!-- /ttLeft -->
						<?php }
						if ( is_active_sidebar( 'header_right_widgets' ) ) { ?>
						<div class="topTools btTopToolsRight">
							<?php dynamic_sidebar( 'header_right_widgets' ); ?>
						</div><!-- /ttRight -->
						<?php } ?>
					</div><!-- /topBarPort -->
				</div><!-- /topBar -->
			<?php }
				} else if( $type == 'menu' ) { 
                    if ( is_active_sidebar( 'header_menu_widgets' ) ) { ?>
					<div class="topBarInMenu">
						<div class="topBarInMenuCell">
							<?php dynamic_sidebar( 'header_menu_widgets' ); ?>
						</div><!-- /topBarInMenu -->
					</div><!-- /topBarInMenuCell -->
				<?php } 
                             }	else if( $type == 'logo' ) { 
                                     if ( is_active_sidebar( 'header_logo_widgets' ) || $menu_type == 'fullscreen-center' ) { ?>
					<div class="topBarInLogoArea">
						<div class="topBarInLogoAreaCell">
							<?php  
							if ( is_active_sidebar( 'header_logo_widgets' ) ) { 
								 dynamic_sidebar( 'header_logo_widgets' ); 
							} 
							if ( $menu_type == 'fullscreen-center' ) { ?>
							<div class="bt-fullscreen-menu-trigger">&nbsp;<div class="bt_bb_icon"><div class="bt_bb_icon_holder"></div></div></div>							
							<?php }
							?>
						</div><!-- /topBarInLogoAreaCell -->
					</div><!-- /topBarInLogoArea -->
			<?php } 
		}

	}
}

/**
 * Preloader HTML output
 */
 if ( ! function_exists( 'boldthemes_preloader_html' ) ) {
	function boldthemes_preloader_html() {
		if ( ! boldthemes_get_option( 'disable_preloader' ) ) { ?>
			<div id="btPreloader" class="btPreloader">
				<div class="animation">
					<div><?php boldthemes_logo( 'preloader' ); ?></div>
					<div class="btLoader"></div>
					<p><?php echo wp_kses_post( boldthemes_get_option( 'preloader_text' ) ); ?></p>
				</div>
			</div><!-- /.preloader -->
		<?php }
	}
}

/**
 * Share links.
 */
if ( ! function_exists( 'boldthemes_get_share_link' ) ) {
	function boldthemes_get_share_link( $service, $url ) {
		if ( $service == 'facebook' ) {
			return 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
		} else if ( $service == 'twitter' ) {
			return 'https://twitter.com/intent/tweet?text=' . $url;
		} else if ( $service == 'linkedin' ) {
			return 'https://www.linkedin.com/shareArticle?url=' . $url;
		} else if ( $service == 'vk' ) {
			return 'https://vkontakte.ru/share.php?url=' . $url;		
		} else if ( $service == 'whatsapp' ) {
			return 'https://api.whatsapp.com/send?text=' . $url;		
		} else {
			return '#';
		}
	}
}

/**
 * Get option.
 */
if ( ! function_exists( 'boldthemes_get_option' ) ) {
	function boldthemes_get_option( $opt ) {

		global $boldthemes_options;
		global $boldthemes_page_options;

		if ( isset( BoldThemes_Customize_Default::$data[ $opt ] ) ) {
			if ( isset( $_GET[ $opt ] ) || isset( $_GET[ 'bt_' . $opt ] ) ) {
				$ret = isset( $_GET[ $opt ] ) ? sanitize_text_field( $_GET[ $opt ] ) : sanitize_text_field( $_GET[ 'bt_' . $opt ] );
				if ( $ret === 'true' ) {
					$ret = true;
				} else if ( $ret === 'false' ) {
					$ret = false;
				}
                                
				return sanitize_text_field( $ret );
			}			
		}
		if ( $boldthemes_page_options !== null && array_key_exists( BoldThemesFramework::$pfx . '_' . $opt, $boldthemes_page_options ) && $boldthemes_page_options[ BoldThemesFramework::$pfx . '_' . $opt ] === 'null' ) {

                    return BoldThemes_Customize_Default::$data[ $opt ];
		}

		if ( $boldthemes_page_options !== null && array_key_exists( BoldThemesFramework::$pfx . '_' . $opt, $boldthemes_page_options ) ) {
			$ret = $boldthemes_page_options[ BoldThemesFramework::$pfx . '_' . $opt ];

			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}

			return $ret;
		}
		if ( $boldthemes_options !== null && $boldthemes_options !== false && array_key_exists( $opt, $boldthemes_options ) ) {
			$ret = $boldthemes_options[ $opt ];
			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}

			return $ret;
		} else { 
			if ( $boldthemes_options !== null ) {

				return BoldThemes_Customize_Default::$data[ $opt ];
			} else {
				$boldthemes_options = get_option( BoldThemesFramework::$pfx . '_theme_options' );
				if ( is_array( $boldthemes_options ) && array_key_exists( $opt, $boldthemes_options ) ) {
					$ret = $boldthemes_options[ $opt ];
					if ( $ret === 'true' ) {
						$ret = true;
					} else if ( $ret === 'false' ) {
						$ret = false;
					}

					return $ret;
				} else {

					return BoldThemes_Customize_Default::$data[ $opt ];
				}
			}
		}

	}
}

/**
 * Pagination output for post archive
 */
if ( ! function_exists( 'boldthemes_pagination' ) ) {
	function boldthemes_pagination() {
	
		$prev = get_previous_posts_link( esc_html__( 'Newer Posts', 'zele' ) );
		$next = get_next_posts_link( esc_html__( 'Older Posts', 'zele' ) );
		
		$extra_slass = '';
		if ( boldthemes_get_option( 'blog_list_view' ) == 'columns' ) {
			$extra_slass = 'btPostListColumns';
		} 
		
		$pattern = '/(<a href=".*">)(.*)(<\/a>)/';
		
		if ( $prev != '' || $next != '' ) {
			echo '<div class="btPagination boldSection gutter ' . $extra_slass . '">';
				echo '<div class="port">';
					if ( $prev != '' ) {
						echo '<div class="paging onLeft">';
							echo '<p class="pagePrev">';
								echo preg_replace( $pattern, '<span class="nbsItem"><span class="nbsTitle">$2</span></span>', $prev );
							echo '</p>';
						echo '</div>';
					}
					if ( $next != '' ) {
						echo '<div class="paging onRight">';
							echo '<p class="pageNext">';
								echo preg_replace( $pattern, '<span class="nbsItem"><span class="nbsTitle">$2</span></span>', $next );
							echo '</p>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';			
		}

	}
}

/**
 * Custom comments HTML output
 */
if ( ! function_exists( 'boldthemes_theme_comment' ) ) {
	function boldthemes_theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
		
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php echo esc_html__( 'Pingback:', 'zele' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'zele' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class = "">
				<?php $avatar_html = get_avatar( $comment, 140 ); 
					if ( $avatar_html != '' ) {
						echo '<div class="commentAvatar">' . wp_kses( $avatar_html, 'avatar' ) . '</div>';
					}
				?>
				<div class="commentTxt">
					<div class="vcard divider">
						<?php
							printf( '<h5 class="author"><span class="fn">%1$s</span></h5>', get_comment_author_link() );
							echo '<p class="posted">' . sprintf( esc_html__( '%1$s at %2$s', 'zele' ), get_comment_date(), get_comment_time() ) . '</p>';
							if ( $rating > 0 && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) { ?>
								<div itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'zele' ), $rating ) ?>">
									<span style="width:<?php echo esc_html( ( $rating / 5 ) * 100 ); ?>%"><strong itemprop="ratingValue"><?php echo esc_html( $rating ); ?></strong> <?php echo esc_html__( 'out of 5', 'zele' ); ?></span>
								</div>
							<?php }
						?>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'zele' ); ?></p>
					<?php endif; ?>

					<div class="comment">
						

						<?php comment_text();

						if ( comments_open() ) {
							echo '<p class="reply">';
								comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'zele' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
							echo '</p>';
						}
						edit_comment_link( esc_html__( 'Edit', 'zele' ), '<p class="edit-link">', '</p>' ); ?>
					</div>
				</div>
				
				
			</article>
		<?php
			break;
		endswitch;
	}
}

/**
 * Custom MetaBox getter function
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_rwmb_meta' ) ) {
	function boldthemes_rwmb_meta( $key, $args = array(), $post_id = null ) {
		if ( function_exists( 'rwmb_meta' ) ) {
			return rwmb_meta( $key, $args, $post_id );
		} else {
			return null;
		}
	}
}

/**
 * Custom MetaBox input used for Override Global Settings
 */
if ( ! class_exists( 'RWMB_BoldThemesText_Field' ) && class_exists( 'RWMB_Field' ) ) {
	class RWMB_BoldThemesText_Field extends RWMB_Field {
	
		static function admin_enqueue_scripts() {
			wp_enqueue_script( 
				'boldthemes-framework-text',
				get_parent_theme_file_uri( 'framework/js/boldthemes_text.js' ),
				array( 'jquery' ),
				'',
				true
			);
			$fake_customizer_js = 'window.bt_fake_customizer_controls={};';
			if ( is_array( BoldThemesFramework::$fake_customizer->control_arr ) ) {
				foreach( BoldThemesFramework::$fake_customizer->control_arr as $k => $v ) {
					$fake_customizer_js .= 'window.bt_fake_customizer_controls["' . $k . '"]=' . json_encode( $v ) . ';';
				}
			}
			wp_add_inline_script( 'boldthemes-framework-text', $fake_customizer_js );
		}

		static function sort_fake_customizer_sections( $a, $b ) {
			$sections = BoldThemesFramework::$fake_customizer->section_arr;
			if ( isset( $sections[ $a['section'] ] ) && isset( $sections[ $b['section'] ] ) ) {
				if ( $sections[ $a['section'] ]['priority'] == $sections[ $b['section'] ]['priority'] ) {
					return 0;
				}
				return ( $sections[ $a['section'] ]['priority'] < $sections[ $b['section'] ]['priority'] ) ? -1 : 1;
			} else {
				return 0;
			}
		}

		static function stable_uasort( & $array, $cmp_function ) {
			if ( count( $array ) < 2 ) {
				return;
			}
			$halfway = count( $array ) / 2;
			$array1 = array_slice( $array, 0, $halfway, TRUE );
			$array2 = array_slice( $array, $halfway, NULL, TRUE );

			self::stable_uasort( $array1, $cmp_function );
			self::stable_uasort( $array2, $cmp_function );
			if ( call_user_func( $cmp_function, end( $array1 ), reset( $array2 ) ) < 1 ) {
				$array = $array1 + $array2;
				return;
			}
			$array = array();
			reset( $array1 );
			reset( $array2 );
			while( current( $array1 ) && current( $array2 ) ) {
				if ( call_user_func( $cmp_function, current( $array1 ), current( $array2 ) ) < 1 ) {
					$array[ key( $array1 ) ] = current( $array1 );
					next( $array1 );
				} else {
					$array[ key( $array2 ) ] = current( $array2 );
					next( $array2 );
				}
			}
			while( current( $array1 ) ) {
				$array[ key( $array1 ) ] = current( $array1 );
				next( $array1 );
			}
			while( current( $array2 ) ) {
				$array[ key( $array2 ) ] = current( $array2 );
				next( $array2 );
			}
			return;
		}

		static function sort_fake_customizer_controls( $a, $b ) {
			if ( isset( $a['priority'] ) && isset ( $b['priority'] ) ) {
				if ( $a['priority'] == $b['priority'] ) {
					return 0;
				}
				return ( $a['priority'] < $b['priority'] ) ? -1 : 1;
			} else {
				return 0;
			}
		}

		static function html( $meta, $field ) {

			$meta_key = substr( $meta, 0, strpos( $meta, ':' ) );
			$meta_value = substr( $meta, strpos( $meta, ':' ) + 1 );

			$vars = BoldThemesFramework::$fake_customizer->control_arr;
			self::stable_uasort( $vars, array( 'self', 'sort_fake_customizer_controls' ) );
			self::stable_uasort( $vars, array( 'self', 'sort_fake_customizer_sections' ) );
			

			$select = '<select class="boldthemes_key_select" data-pfx="' . BoldThemesFramework::$pfx . '">';
			$select .= '<option value=""></option>';
			if ( is_array( $vars ) ) {
				foreach ( $vars as $key => $v ) {
					if ( isset( BoldThemesFramework::$fake_customizer->control_arr[ $key ] ) && isset( BoldThemesFramework::$fake_customizer->section_arr[ BoldThemesFramework::$fake_customizer->control_arr[ $key ]['section'] ] ) && BoldThemesFramework::$current_override_section != BoldThemesFramework::$fake_customizer->section_arr[ BoldThemesFramework::$fake_customizer->control_arr[ $key ]['section'] ]['title'] ) {
						BoldThemesFramework::$current_override_section = BoldThemesFramework::$fake_customizer->section_arr[ BoldThemesFramework::$fake_customizer->control_arr[ $key ]['section'] ]['title'];
						$select .= '<option disabled>' . BoldThemesFramework::$current_override_section . '</option>';
					}
					$selected_html = '';
					if ( BoldThemesFramework::$pfx . '_' . $key == $meta_key ) {
						$selected_html = 'selected="selected"';
					}
					if ( isset( BoldThemesFramework::$fake_customizer->control_arr[ $key ] ) ) {
						$select .= '<option value="' . esc_attr( BoldThemesFramework::$pfx . '_' . $key ) . '" ' . $selected_html . '>' . esc_html( BoldThemesFramework::$fake_customizer->control_arr[ $key ]['label'] ) . '</option>';
					}
				}
			}
			$select .= '</select>';
	
			$input = '<input type="text" class="boldthemes_value" value="' . esc_attr( $meta_value ) . '">';

			$part_meta_key = str_replace( BoldThemesFramework::$pfx . '_', '', $meta_key );

			if ( isset( BoldThemesFramework::$fake_customizer->control_arr[ $part_meta_key ] ) ) {
				if ( isset( BoldThemesFramework::$fake_customizer->control_arr[ $part_meta_key ]['type'] ) ) {
					$type = BoldThemesFramework::$fake_customizer->control_arr[ $part_meta_key ]['type'];
					if ( $type == 'checkbox' ) {
						$input = $meta_value == 'true' ? '<input type="checkbox" class="boldthemes_value" checked>' : '<input type="checkbox" class="boldthemes_value">';
					} else if ( $type == 'select' ) {
						$input = '<select class="boldthemes_value">';
							foreach( BoldThemesFramework::$fake_customizer->control_arr[ $part_meta_key ]['choices'] as $k => $v ) {
								if ( $meta_value == $k ) {
									$input .= '<option value="' . esc_attr( $k ) . '" selected>' . $v . '</option>';
								} else {
									$input .= '<option value="' . esc_attr( $k ) . '">' . $v . '</option>';
								}
							}
						$input .= '</select>';
					} else if ( $type == 'WP_Customize_Color_Control' ) {
						$input = '<input type="text" class="boldthemes_value boldthemes_override_color_field" value="' . esc_attr( $meta_value ) . '">';
					} else if ( $type == 'WP_Customize_Image_Control' ) {
						$input = '<input type="text" class="boldthemes_value" value="' . esc_attr( $meta_value ) . '">';
						if ( is_numeric( $meta_value ) ) {
							$image = wp_get_attachment_image_src( $meta_value, 'medium' );
							if ( $image ) {
								$src = $image[0];
							}
						} else {
							$src = $meta_value;
						}
						if ( $src != '' ) {
							$input .= '<img src="' . esc_url( $src ) . '"><span class="boldthemes_override_add_image"><i class="dashicons dashicons-plus-alt"></i></span>';
						} else {
							$input .= '<span class="boldthemes_override_add_image"><i class="dashicons dashicons-plus-alt"></i></span>';
						}
					}
				}
			}

			$input = ' ' . $input;
			
			return sprintf(
				'<input type="hidden" class="rwmb-text" name="%s" id="%s" value="%s" placeholder="%s" %s>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['placeholder'],
				'',
				self::datalist_html( $field )
			) . $select . $input;
		}

		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'size'        => 30,
				'datalist'    => false,
				'placeholder' => '',
			) );
			return $field;
		}

		static function datalist_html( $field ) {
			return '';
		}
	}
}

/**
 * Custom MetaBox input used for custom key-value pairs
 */
if ( ! class_exists( 'RWMB_BoldThemesText1_Field' ) && class_exists( 'RWMB_Field' ) ) {
	class RWMB_BoldThemesText1_Field extends RWMB_Field {
	
		static function admin_enqueue_scripts() {
			wp_enqueue_script( 
				'boldthemes-framework-text',
				get_parent_theme_file_uri( 'framework/js/boldthemes_text.js' ),
				array( 'jquery' ),
				'',
				true
			);
		}

		static function html( $meta, $field ) {
		
			$meta_key = substr( $meta, 0, strpos( $meta, ':' ) );
			$meta_value = substr( $meta, strpos( $meta, ':' ) + 1 );
			
			$key_input = '<input type="text" class="boldthemes_key" value="' . esc_attr( $meta_key ) . '">';
			
			$input = ' <input type="text" class="boldthemes_value" value="' . esc_attr( $meta_value ) . '">';
			
			return sprintf(
				'<input type="hidden" class="rwmb-text" name="%s" id="%s" value="%s" placeholder="%s" %s>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['placeholder'],
				'',
				self::datalist_html( $field )
			) . $key_input . $input;
		}
		
		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'size'        => 30,
				'datalist'    => false,
				'placeholder' => '',
			) );
			return $field;
		}

		static function datalist_html( $field ) {
			return '';
		}
	}
}

/**
 * Get array of data for a range of posts, used in grid layout
 *
 * @param int $number
 * @param int $offset
 * @param string $cat_slug Category slug
 * @param string $post_type
 * @param string $related
 * @return array Array of data for a range of posts
 */
if ( ! function_exists( 'boldthemes_get_posts_data' ) ) {
	function boldthemes_get_posts_data( $number, $offset, $cat_slug, $post_type = 'blog' ) {
		
		$posts_data1 = array();
		$posts_data2 = array();
		
		$sticky = false;
		
		if ( $offset == 0 && $sticky && count( $sticky_array ) > 0 ) {
			$recent_posts_q_sticky = new WP_Query( array( 'post__in' => $sticky_array, 'post_status' => 'publish' ) );
			$posts_data1 = boldthemes_get_posts_array( $recent_posts_q_sticky, $post_type, array() );
		}
		
		if ( $number > 0 ) {
			if ( $post_type == 'portfolio' ) {
				if ( $cat_slug != '' ) {
					$recent_posts_q = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $number, 'offset' => $offset, 'tax_query' => array( array( 'taxonomy' => 'portfolio_category', 'field' => 'slug', 'terms' => explode( ',', $cat_slug ) ) ), 'post_status' => 'publish' ) );
				} else {
					$recent_posts_q = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $number, 'offset' => $offset, 'post_status' => 'publish' ) );
				}
			} else {
				if ( $cat_slug != '' ) {
					$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'category_name' => $cat_slug, 'post_status' => 'publish' ) );
				} else {
					$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'post_status' => 'publish' ) );
				}
			}
		}

		if ( $sticky ) {
			$posts_data2 = boldthemes_get_posts_array( $recent_posts_q, $post_type, $sticky_array );
		} else {
			$posts_data2 = boldthemes_get_posts_array( $recent_posts_q, $post_type, array() );
		}		

		return array_merge( $posts_data1, $posts_data2 );

	}
}

/**
 * boldthemes_get_posts_data helper function
 *
 * @param object
 * @param array 
 * @return array 
 */
if ( ! function_exists( 'boldthemes_get_posts_array' ) ) {
	function boldthemes_get_posts_array( $recent_posts_q, $post_type, $sticky_arr ) {
		
		$posts_data = array();

		while ( $recent_posts_q->have_posts() ) {
			$recent_posts_q->the_post();
			$post = get_post();
			$post_author = $post->post_author;
			$post_id = get_the_ID();
			if ( in_array( $post_id, $sticky_arr ) ) {
				continue;
			}
			$posts_data[] = boldthemes_get_posts_array_item( $post_type, $post_id, $post_author );
		}
		
		wp_reset_postdata();
		
		return $posts_data;
	}
}

/**
 * boldthemes_get_posts_array helper function
 *
 * @return array
 */
if ( ! function_exists( 'boldthemes_get_posts_array_item' ) ) {
	function boldthemes_get_posts_array_item( $post_type, $post_id, $post_author ) {
		
		$post_data = array();
		$post_data['permalink'] = get_permalink( $post_id );
		$post_data['format'] = get_post_format( $post_id );
		$post_data['title'] = get_the_title( $post_id );
		
		$post_data['excerpt'] = boldthemes_get_the_excerpt( $post_id );
		if ( ! has_filter( 'get_the_time' ) ) {
			$post_data['date'] = date_i18n( BoldThemesFramework::$date_format, strtotime( get_the_time( 'Y-m-d G:m', $post_id ) ) );	
		} else {
			$post_data['date'] =  get_the_time( 'Y-m-d G:m', $post_id ) ;
		}
		
		$user_data = get_userdata( $post_author );
		if ( $user_data ) {
			$author = $user_data->data->display_name;
			$author_url = get_author_posts_url( $post_author );
			$post_data['author'] = '<a href="' . esc_url( $author_url ) . '" class="btArticleAuthorURL">' . esc_html( $author ) . '</a>';
			$post_data['author_id'] = $user_data->data->ID;
			$post_data['author_url'] = $author_url;
			$post_data['author_name'] = $author;
		} else {
			$post_data['author'] = '';
			$post_data['author_id'] = '';
			$post_data['author_url'] = '';
			$post_data['author_name'] = '';
		}

		if ( $post_type == 'portfolio' ) {
			$categories = wp_get_post_terms( $post_id, 'portfolio_category' );
		} else {
			$categories = get_the_category( $post_id );
		}
		
		if ( $post_type == 'portfolio' ) {
			$categories_html = boldthemes_get_post_categories( array( 'categories' => $categories ) );
		} else {
			$categories_html = boldthemes_get_post_categories( array( 'categories' => $categories ) );
		}

		$post_data['category'] = $categories_html;
		
		$comments_open = comments_open( $post_id );
		$comments_number = get_comments_number( $post_id );
		if ( ! $comments_open && $comments_number == 0 ) {
			$comments_number = false;
		}			
		
		$post_data['thumbnail'] = get_post_thumbnail_id( $post_id );
		$post_data['images'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_images', 'type=image', $post_id );
		if ( $post_data['images'] == null ) $post_data['images'] = array();
		$post_data['video'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_video', array(), $post_id );
		$post_data['audio'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_audio', array(), $post_id );
		$post_data['grid_gallery'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_grid_gallery', array(), $post_id );
		$post_data['link_title'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_link_title', array(), $post_id );
		$post_data['link_url'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_link_url', array(), $post_id );
		$post_data['quote'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_quote', array(), $post_id );
		$post_data['quote_author'] = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_quote_author', array(), $post_id );
		$post_data['comments'] = $comments_number;
		$post_data['ID'] = $post_id;
		
		return $post_data;
	}
}

/**
 * Returns post excerpt by post id
 *
 * @param int
 * @return string 
 */
if ( ! function_exists( 'boldthemes_get_the_excerpt' ) ) {
	function boldthemes_get_the_excerpt( $post_id ) {
		$excerpt = get_post_field( 'post_excerpt', $post_id );
		if ( $excerpt == '' && $post_id ) {
			$post = get_post( $post_id );
			if ( !is_null( $post ) && $post != '' ) {
				if ( $post->post_type == 'post' ) {
					// Was: temporary removed get_the_excerpt, core bug https://core.trac.wordpress.org/ticket/42814
					// $excerpt = get_the_excerpt( $post_id ); 
				}				
			}
		}
		return $excerpt;
	}
}

// Remove default hellip 
if ( ! function_exists( 'boldthemes_remove_hellip' ) ) {
	function boldthemes_remove_hellip( $more ) {
	    return '...';
	}
}

add_filter('excerpt_more', 'boldthemes_remove_hellip');

/**
 * Returns page id by slug
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_id_by_slug' ) ) {
	function boldthemes_get_id_by_slug( $page_slug ) {
		$page = get_posts(
			array(
				'name'      => $page_slug,
				'post_type' => 'page'
			)
		);
		if ( isset($page[0]->ID) ) {
			return $page[0]->ID;	
		} else {
			return null;
		}
		
	}
}

/**
 * Creates override of global options for individual posts
 */
if ( ! function_exists( 'boldthemes_set_override' ) ) {
	function boldthemes_set_override() {
		global $boldthemes_options;
		$boldthemes_options = get_option( BoldThemesFramework::$pfx . '_theme_options' );

		global $boldthemes_page_options;
		$boldthemes_page_options = array();
		
		if ( ! is_404() ) {
			if ( is_singular() ) {
				$tmp_boldthemes_page_options = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override' );
			} else {
				$tmp_boldthemes_page_options = array();
			}
			if ( ! is_array( $tmp_boldthemes_page_options ) ) {
				$tmp_boldthemes_page_options = array();
			}
			$tmp_boldthemes_page_options = boldthemes_transform_override( $tmp_boldthemes_page_options );

			$tmp_boldthemes_page_options1 = '';
			if ( ( is_search() || is_archive() || is_home() ) && get_option( 'page_for_posts' ) != 0 ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'page_for_posts' ) );
			} 

			if ( is_singular( 'post' ) || is_singular( 'attachment' ) ) {
				if ( isset( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_blog_settings_page_slug' ] ) && $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_blog_settings_page_slug'] != '' ) { 
					// override with override
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_blog_settings_page_slug'] ) );
				} else if ( isset( $boldthemes_options['blog_settings_page_slug'] ) && $boldthemes_options['blog_settings_page_slug'] != '' ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['blog_settings_page_slug'] ) );
				} else if ( BoldThemes_Customize_Default::$data['blog_settings_page_slug'] != '' ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( BoldThemes_Customize_Default::$data['blog_settings_page_slug'] ) );
				}				
			}

			if ( is_singular( 'portfolio' ) ) {
				if ( isset( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] ) && $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] != '' ) { 
					// override with override
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] ) );
				} else if ( isset( $boldthemes_options['pf_settings_page_slug'] ) && $boldthemes_options['pf_settings_page_slug'] != '' ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['pf_settings_page_slug'] ) );
				}				
			}

				
			if ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' )) {
				if ( isset( $boldthemes_options['pf_slug'] ) && !is_null( $boldthemes_options['pf_slug'] ) && $boldthemes_options['pf_slug'] != "" && !is_null( boldthemes_get_id_by_slug( $boldthemes_options['pf_slug'] ) ) && boldthemes_get_id_by_slug( $boldthemes_options['pf_slug'] ) != '' ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['pf_slug'] ) );
				} else if ( !is_null( boldthemes_get_id_by_slug('portfolio') ) && boldthemes_get_id_by_slug('portfolio') != '' ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( 'portfolio' ) );
				} else if ( get_option( 'page_for_posts' ) ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'page_for_posts' ) );
				}
			}
			
			if ( function_exists( 'is_shop' ) && is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'woocommerce_shop_page_id' ) );
			}
			
			if ( function_exists( 'is_product_category' ) && is_product_category() && get_option( 'woocommerce_shop_page_id' ) ) {
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), get_option( 'woocommerce_shop_page_id' ) );
			}
			
			if ( function_exists( 'is_product' ) && is_product() ) {
				if ( isset( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_shop_settings_page_slug'] ) && $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_shop_settings_page_slug'] != '' ) {
					// override with override
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_shop_settings_page_slug'] ) );
				} else if ( isset( $boldthemes_options['shop_settings_page_slug'] ) && $boldthemes_options['shop_settings_page_slug'] != '' ) {
					$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['shop_settings_page_slug'] ) );
				}
			}
			
			$post_type = get_post_type();

			if ( ( $post_type == 'tribe_events' || $post_type == 'tribe_venue' || $post_type == 'tribe_organizer' ) && isset( $boldthemes_options['events_settings_page_slug'] ) && $boldthemes_options['events_settings_page_slug'] != '' ) {
				BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( $boldthemes_options['events_settings_page_slug'] );
				$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['events_settings_page_slug'] ) );
			} 

			if ( is_array( $tmp_boldthemes_page_options1 ) ) {
				if ( is_singular() ) {
					$tmp_boldthemes_page_options = array_merge( boldthemes_transform_override( $tmp_boldthemes_page_options1 ), $tmp_boldthemes_page_options );
				} else {
					$tmp_boldthemes_page_options = boldthemes_transform_override( $tmp_boldthemes_page_options1 );
				}
			}

			foreach ( $tmp_boldthemes_page_options as $key => $value ) {
				$boldthemes_page_options[ $key ] = $value;
			}
			
			
		}
	}
}

/**
 * boldthemes_set_override helper function
 *
 * @param array
 * @return array
 */
if ( ! function_exists( 'boldthemes_transform_override' ) ) {
	function boldthemes_transform_override( $arr ) {
		$new_arr = array();
		foreach( $arr as $item ) {
			$key = substr( $item, 0, strpos( $item, ':' ) );
			$value = substr( $item, strpos( $item, ':' ) + 1 );
			$new_arr[ $key ] = $value;
		}
		return $new_arr;
	}
}

/**
 * theme name and version in data attribute
 */
if ( ! function_exists( 'boldthemes_theme_data' ) ) {
	function boldthemes_theme_data() {
		$data = wp_get_theme();
		echo 'data-bt-theme="' . esc_attr( $data['Name'] ) . ' ' . esc_attr( $data['Version'] ) . '"';
	}
}

/**
 * Header meta tags output
 */
if ( ! function_exists( 'boldthemes_header_meta' ) ) {
	function boldthemes_header_meta() { ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
	<?php }
}

/**
 * Header menu output
 */
if ( ! function_exists( 'boldthemes_nav_menu' ) ) {
	function boldthemes_nav_menu( $walker = false, $theme_location = 'primary' ) {
		$menu_prefix = ( $theme_location == 'primary') ? '' : '_' . $theme_location;
		$blog_page_menu = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name', array(), get_option( 'page_for_posts' ) );
		$shop_page_menu = false;
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && get_option( 'woocommerce_shop_page_id' ) ) {
			$shop_page_menu = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name', array(), get_option( 'woocommerce_shop_page_id' ) );
		}
		$menu_depth = ( $theme_location == 'primary' ) ? apply_filters( 'boldthemes_primary_menu_depth', 4 ) : 1;
		if ( $walker ) {
			if ( is_home() && $blog_page_menu != '' ) {
				wp_nav_menu( array( 'menu' => $blog_page_menu, 'container' => '', 'depth' => $menu_depth, 'fallback_cb' => false, 'walker' => $walker ) ); 
			} else if ( boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name' ) != '' ) {
				wp_nav_menu( array( 'menu' => boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name' ), 'container' => '', 'depth' => $menu_depth, 'fallback_cb' => false, 'walker' => $walker ) ); 
			} else {
				wp_nav_menu( array( 'theme_location' => $theme_location, 'container' => '', 'depth' => $menu_depth, 'fallback_cb' => false, 'walker' => $walker ) );
			}
		} else {
			if ( is_home() && $blog_page_menu != '' ) {				
				wp_nav_menu( array( 'menu' => $blog_page_menu, 'container' => '', 'depth' => $menu_depth, 'fallback_cb' => false ) );
			} else if ( $shop_page_menu ) {
				wp_nav_menu( array( 'menu' => $shop_page_menu, 'container' => '', 'depth' => $menu_depth, 'fallback_cb' => false ) );
			} else if ( boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name' ) != '' ) {
				wp_nav_menu( array( 'menu' => boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name' ), 'container' => '', 'depth' => $menu_depth, 'fallback_cb' => false ) ); 
			} else {
				wp_nav_menu( array( 'theme_location' => $theme_location, 'container' => '', 'depth' => $menu_depth, 'fallback_cb' => false ) );
			}
		}
	}
}

/**
 * Returns custom header class
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_body_class' ) ) {
	function boldthemes_get_body_class( $extra_class ) {
		
		if ( boldthemes_get_option( 'alt_logo' ) ) {
			$extra_class[] = 'btHasAltLogo';
		}
		
		$menu_type = boldthemes_get_option( 'menu_type' );
		if ( $menu_type == 'horizontal-center' ) {
			$extra_class[] = 'btMenuCenterEnabled'; 
		} else if ( $menu_type == 'horizontal-left' ) {
			$extra_class[] = 'btMenuLeftEnabled';
		}  else if ( $menu_type == 'horizontal-right' ) {
			$extra_class[] = 'btMenuRightEnabled';
		} else if ( $menu_type == 'horizontal-below-left' ) {
			$extra_class[] = 'btMenuLeftEnabled';
			$extra_class[] = 'btMenuBelowLogo';
		} else if ( $menu_type == 'horizontal-below-center' ) {
			$extra_class[] = 'btMenuCenterBelowEnabled';
			$extra_class[] = 'btMenuBelowLogo';
		} else if ( $menu_type == 'horizontal-below-right' ) {
			$extra_class[] = 'btMenuRightEnabled';
			$extra_class[] = 'btMenuBelowLogo';
		} else if ( $menu_type == 'vertical-left' ) {
			$extra_class[] = 'btMenuVerticalLeftEnabled';
		} else if ( $menu_type == 'vertical-right' ) {
			$extra_class[] = 'btMenuVerticalRightEnabled';
		} else if ( $menu_type == 'fullscreen-center' ) {
			$extra_class[] = 'btMenuFullScreenCenter';
		} else {
			$extra_class[] = 'btMenuRightEnabled';
		}

		if ( boldthemes_get_option( 'sticky_header' ) ) {
			$extra_class[] = 'btStickyEnabled';
		}

		if ( boldthemes_get_option( 'hide_menu' ) ) {
			$extra_class[] = 'btHideMenu';
		}

		if ( boldthemes_get_option( 'hide_headline' ) || boldthemes_get_option( 'hide_headline' ) == 'hide' ) {
			$extra_class[] = 'btHideHeadline';
		}

		$template_skin = boldthemes_get_option( 'template_skin' );
		if ( $template_skin == '' ) $template_skin = 'light';
		if ( $template_skin != '' ) {
			$extra_class[] = 'bt' . boldthemes_convert_param_to_camel_case( $template_skin ) . 'Skin';
		}

		if ( boldthemes_get_option( 'below_menu' ) ) {
			$extra_class[] = 'btBelowMenu';
		}

		if ( ! boldthemes_get_option( 'sidebar_use_dash' ) ) {
			$extra_class[] = 'btNoDashInSidebar';
		}

		if ( boldthemes_get_option( 'disable_preloader' ) ) {
			$extra_class[] = 'noBodyPreloader';
		} else {
			$extra_class[] = 'bodyPreloader'; 
		}
		
		$buttons_shape = boldthemes_get_option( 'buttons_shape' );
		if ( $buttons_shape != '' ) {
			$extra_class[] = 'bt' . boldthemes_convert_param_to_camel_case( $buttons_shape ) . 'Buttons';
		}
		
		$header_style = boldthemes_get_option( 'header_style' );
		if ( $header_style != '' ) {
			$extra_class[] =  'bt' . boldthemes_convert_param_to_camel_case( $header_style ) . 'Header';
		} else {
			$extra_class[] =  'btTransparentDarkHeader';
		}
		
		if ( boldthemes_get_option( 'page_width' ) == 'boxed' ) {
			$extra_class[] = 'btBoxedPage';
		}

		BoldThemesFramework::$sidebar = boldthemes_get_option( 'sidebar' );
		
		global $wp_registered_sidebars;
		$widget_areas = array_keys( $wp_registered_sidebars );
	

		if ( ! ( ( BoldThemesFramework::$sidebar == 'left' || BoldThemesFramework::$sidebar == 'right' ) && ! is_404() )
			|| 
			( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_checkout() || is_cart() ) && in_array( 'bt_shop_sidebar', $widget_areas ) && ! is_active_sidebar( 'bt_shop_sidebar' ) )
			||
			( ( ! function_exists( 'is_woocommerce' ) || ! ( is_woocommerce() || is_checkout() || is_cart() ) )  && ! is_active_sidebar( 'primary_widget_area' ) )
			) {
			BoldThemesFramework::$has_sidebar = false;
			$extra_class[] = 'btNoSidebar';
		} else {
			BoldThemesFramework::$has_sidebar = true;
			if ( BoldThemesFramework::$sidebar == 'left' ) {
				$extra_class[] = 'btWithSidebar btSidebarLeft';
			} else {
				$extra_class[] = 'btWithSidebar btSidebarRight';
			}
		}
		
		
		$animations = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_animations' );
		if ( $animations == 'half_page' ) {
			$extra_class[] = 'btHalfPage';
		}
		
		$extra_class = apply_filters( 'boldthemes_extra_class', $extra_class );
		
		return $extra_class;
	}
}

/**
 * Enqueue comment script
 */
if ( ! function_exists( 'boldthemes_header_init' ) ) {
	function boldthemes_header_init() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

/**
 * Set JS AJAX URL and JS text labels
 */
if ( ! function_exists( 'boldthemes_set_global_uri' ) ) {
	function boldthemes_set_global_uri() {
		$data = 'window.BoldThemesURI = "' . esc_js( get_parent_theme_file_uri() ) . '"; window.BoldThemesAJAXURL = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '";';
		$data .= 'window.boldthemes_text = [];';
		$data .= 'window.boldthemes_text.previous = \'' . esc_html__( 'previous', 'zele' ) . '\';';
		$data .= 'window.boldthemes_text.next = \'' . esc_html__( 'next', 'zele' ) . '\';';
		return $data;
	}
}

/**
 * Get post date
 */
if ( ! function_exists( 'boldthemes_get_post_date' ) ) {
	function boldthemes_get_post_date( $arg = array() ) {
		$prefix = isset( $arg['prefix'] ) ? $arg['prefix'] : '<span class="btArticleDate">';
		$suffix = isset( $arg['suffix'] ) ? $arg['suffix'] : '</span>';
		return $prefix . esc_html( date_i18n( BoldThemesFramework::$date_format, get_the_time( 'G' ) ) ) . $suffix;
	}
}

/**
 * Get post author
 */
if ( ! function_exists( 'boldthemes_get_post_author' ) ) {
	function boldthemes_get_post_author( $author_url = false, $prefix = 'by', $show_avatar = false ) {
		if ( $prefix == 'by' ) $prefix = esc_html__( 'by', 'zele' );
		$post = get_post();
		$post_author_id = $post->post_author;
		if ( ! $author_url ) {
			$author_url = get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) );
		}
		$output = '<span class="btArticleAuthor">';
		if ( $show_avatar ) {
			$output .= get_avatar( get_the_author_meta( 'ID' ), 80 );
		}
		$output .= '<a href="' . esc_url( $author_url ) . '" class="btArticleAuthorURL">' . $prefix . ' ' . esc_html( get_the_author_meta( 'display_name', $post_author_id )  ) . '</a>';
		$output .= '</span>';
		return $output;
	}
}

/**
 * Get post comments
 */
if ( ! function_exists( 'boldthemes_get_post_comments' ) ) {
	function boldthemes_get_post_comments() {
		return '<a href="' . esc_url( get_permalink() ) . '#comments" class="btArticleComments">' . get_comments_number() . '</a>';
	}
}

/**
 * Get post meta data
 */
if ( ! function_exists( 'boldthemes_get_post_meta' ) ) {
	function boldthemes_get_post_meta() {
		$blog_author = boldthemes_get_option( 'blog_author' );
		$blog_date = boldthemes_get_option( 'blog_date' );
		$comments_open = comments_open();
		$comments_number = get_comments_number();
		$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			$show_comments_number = false;
		}

		
		$meta_html = '';
		if ( $blog_author || $blog_date || $show_comments_number ) {
			if ( $blog_date ) $meta_html .= boldthemes_get_post_date(); 
			if ( $blog_author ) $meta_html .= boldthemes_get_post_author();
			if ( $show_comments_number ) $meta_html .= boldthemes_get_post_comments();
		}
		return $meta_html;
	}
}

/**
 * Get post categories
 */
if ( ! function_exists( 'boldthemes_get_post_categories' ) ) {
	function boldthemes_get_post_categories( $arg = array() ) {


		$categories = isset( $arg['categories'] ) ? $arg['categories'] : get_the_category();
		$csv = isset( $arg['csv'] ) ? $arg['csv'] : false;
		$no_link = isset( $arg['no_link'] ) ? $arg['no_link'] : false;

		$categories_html = '';
		if ( $categories ) {
			$categories_html = '<span class="btArticleCategories">';
			foreach ( $categories as $cat ) {
				if ( ! $no_link ) $categories_html .= '<a href="' . esc_url( get_term_link( $cat->term_id ) ) . '" class="btArticleCategory ' . $cat->slug . '">';
				$categories_html .= esc_html( $cat->name );
				if ( ! $no_link ) $categories_html .= '</a>';
				if ( $csv ) {
					$categories_html .= ', ';
				}
			}
			if ( $csv ) {
				$categories_html = trim( $categories_html, ', ' );
			}
			$categories_html .= '</span>';
			
			
		}
		return $categories_html;
	}
}

/**
 * Breadcrumbs
 */
if ( ! function_exists( 'boldthemes_breadcrumbs' ) ) {
	function boldthemes_breadcrumbs( $simple, $title, $subtitle ) {
		$home_link = home_url( '/' );
		$output  = '';
		$item_prefix = '<span>';
		$item_suffix = '</span>';
		if ( $simple ) {
			$item_prefix = '';
			$item_suffix = ' / ';
		}
		if ( ! is_404() && ! is_front_page() ) {
		
			if ( ! $simple ) {
				$output .= '<span class="btBreadCrumbs">';
				if ( ! is_singular() || is_page() ) {
					$output .= '<span><a href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'zele' ) . '</a></span>';
				}
			} else {
				if ( ! is_singular() || is_page() ) {
					$output .= '<a href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'zele' ) . '</a>';
				}
			}
			
			if ( is_home() ) {
				
				$subtitle = '';
				
				$page_for_posts = get_option( 'page_for_posts' );
				if ( $page_for_posts ) {
					$page = get_post( $page_for_posts );
					$subtitle = $page->post_excerpt;
					$title = $page->post_title;
				}
			
			} else if ( is_page() ) {

				$ancestors = get_ancestors( get_the_ID(), 'page' );
				$ancestors = array_reverse( $ancestors );
			
				foreach( $ancestors as $ancestor ) {
					$output .= $item_prefix . '<a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a>' . $item_suffix;
				}
				
				$page = get_post( get_the_ID() );
				$subtitle = $page->post_excerpt;
		  
			} else if ( is_singular( 'post' ) ) {
				
				$output .= boldthemes_get_post_categories();
				
				$subtitle = boldthemes_get_post_meta();

			
			} else if ( is_singular( 'portfolio' ) ) {
				
				$categories = wp_get_post_terms( get_the_ID(), 'portfolio_category' );
				$output .= boldthemes_get_post_categories( array( 'categories' => $categories ) );
				
				$subtitle = boldthemes_get_the_excerpt( get_the_ID() );
				
			} else if ( is_singular( 'product' ) ) {
				
				$id = get_queried_object_id();
				$categories = wp_get_post_terms( $id, 'product_cat' );
				$output .= boldthemes_get_post_categories( array( 'categories' => $categories ) );
				
				$pf = new WC_Product_Factory();
				$product = $pf->get_product( $id );
				$rating_count = $product->get_rating_count();
				
				$subtitle = '';
				if ( $rating_count > 0 ) {
					$subtitle .= wc_get_rating_html( $product->get_average_rating() );
				}
				//if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {

					$sku = $product->get_sku() ? $product->get_sku() : esc_html__( 'N/A', 'zele' );
					$subtitle = '<span class = "btProductSKU">' . esc_html__( 'SKU:', 'zele' ) . ' ' . $sku . '</span>'; 

				//}
				
			} else if ( is_post_type_archive( 'portfolio' ) ) {
				
				if ( ! is_null( boldthemes_get_option( 'pf_slug' ) ) && boldthemes_get_option( 'pf_slug' ) != '' ) {
					$pf_slug_id = boldthemes_get_id_by_slug( boldthemes_get_option( 'pf_slug' ) );
					if ( $pf_slug_id > 0 ) {
						$title = get_the_title( $pf_slug_id );					
					} else {
						$title = $pf_slug_id . ucwords( boldthemes_get_option( 'pf_slug' ) );	
					}
					$output .= $item_prefix . ucwords( str_replace( array( '-', '_' ), ' ', $title ) ) . $item_suffix;
				} else if ( ! is_null( boldthemes_get_id_by_slug( 'portfolio' ) ) && boldthemes_get_id_by_slug( 'portfolio' ) != '' ) {
					$output .= $item_prefix . esc_html__( 'Portfolio', 'zele' ) . $item_suffix;
				} else {
					$output .= $item_prefix . esc_html__( 'Portfolio', 'zele' ) . $item_suffix;
				}
				
				if ( ! is_null( boldthemes_get_id_by_slug( 'portfolio' ) ) && boldthemes_get_id_by_slug( 'portfolio' ) != '' ) {
					$title = get_the_title( boldthemes_get_id_by_slug( 'portfolio' ) );
				}

			} else if ( is_attachment() ) {
			
				$output .= $item_prefix . get_the_title() . $item_suffix;
				
			} else if ( is_category() ) {

				$output .= $item_prefix . esc_html__( 'Category', 'zele' ) . $item_suffix;

				$subtitle = '';
				
			} else if ( is_tax() ) {
				
				$output .= $item_prefix . esc_html__( 'Category', 'zele' ) . $item_suffix;
				
				$title = single_term_title( '', false );
				$subtitle = '';				
		  
			} else if ( is_tag() ) {
			
				$output .= $item_prefix . esc_html__( 'Tag', 'zele' ) . $item_suffix;
				
				$subtitle = '';
		  
			} else if ( is_author() ) {
			
				$output .= $item_prefix . esc_html__( 'Author', 'zele' ) . $item_suffix;
				
				$subtitle = '';
				
			} else if ( is_day() ) {

				$output .= $item_prefix . get_the_time( 'Y/m ' ) . $item_suffix;
		  
			} else if ( is_month() ) {
			
				$output .= $item_prefix . get_the_time( 'Y' ) . $item_suffix;
		  
			} else if ( is_year() ) {
			
				$output .= $item_prefix . $item_suffix;			
				
			} else if ( is_search() ) {
				
				$output .= $item_prefix . esc_html__( 'Search', 'zele' ) . $item_suffix;

				$title = esc_html( get_search_query() );
				$subtitle = '';
				
			}
			
			if ( ! $simple ) {
				$output .= '</span>';
			}
			
		}
		
		return array( 'supertitle' => $output, 'title' => $title, 'subtitle' => $subtitle );
	
	}
}

/**
 * Get related posts
 */
if ( ! function_exists( 'boldthemes_get_related_posts' ) ) {
	function boldthemes_get_related_posts( $post_id = false, $num = 3 ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$cat_list = '';
		$cat_arr = get_the_category( $post_id );
		if ( count( $cat_arr ) == 0 ) {
			$cat_list = 0;
		}
		foreach ( $cat_arr as $cat ) {
			$cat_list .= $cat->name . ',';
		}
		$cat_list = rtrim( $cat_list, ',' );
		$related_posts = boldthemes_get_posts_data( $num, 0, $cat_list );
		return $related_posts;
	}
}

/**
 * Remove customize setting
 */
if ( ! function_exists( 'boldthemes_remove_customize_setting' ) ) {
	function boldthemes_remove_customize_setting( $id ) {
		unset( BoldThemes_Customize_Default::$data[ $id ] );
		remove_action( 'customize_register', 'boldthemes_customize_' . $id );
		remove_action( 'boldthemes_customize_register', 'boldthemes_customize_' . $id );
	}
}

/**
 * Add meta box
 */
if ( ! function_exists( 'boldthemes_add_mb' ) ) {
	function boldthemes_add_mb( $arr ) { // id, title, post_type, autosave
		BoldThemesFramework::$meta_boxes[ $arr['id'] ] = array(
			'title'     => $arr['title'],
			'post_type' => $arr['post_type'],
			'autosave'  => $arr['autosave'],
			'fields'    => array()
		);
	}
}

/**
 * Remove meta box
 */
if ( ! function_exists( 'boldthemes_remove_meta_box' ) ) {
	function boldthemes_remove_meta_box( $id ) {
		unset( BoldThemesFramework::$meta_boxes[ $id ] );
	}
}

/**
 * Convert param to camel case
 */
if ( ! function_exists( 'boldthemes_convert_param_to_camel_case' ) ) {
	function boldthemes_convert_param_to_camel_case( $str ) {
		return str_replace( ' ', '', ucwords( str_replace( "-", " ", $str ) ) );
	}
}

/**
 * Add meta box field
 */
if ( ! function_exists( 'boldthemes_add_mb_field' ) ) {
	function boldthemes_add_mb_field( $arr ) { // mb_id, field_id, name, type, order*, options*, clone*

		BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ] = array(
			'id' => $arr['field_id']
		);

		foreach ( $arr as $k => $v ) {
			if ( $k != 'order' &&  $k != 'field_id' ) {
				BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ][ $k ] = $v;
			}
		}

		if ( isset( $arr['order'] ) ) {
			BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ]['order'] = $arr['order'];
		} else {
			BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'][ $arr['field_id'] ]['order'] = count( BoldThemesFramework::$meta_boxes[ $arr['mb_id'] ]['fields'] );
		}

	}
}

/**
 * Remove meta box field
 */
if ( ! function_exists( 'boldthemes_remove_mb_field' ) ) {
	function boldthemes_remove_mb_field( $mb_id, $field_id ) {
		unset( BoldThemesFramework::$meta_boxes[ $mb_id ][ 'fields' ][ $field_id ] );
	}
}

/**
 * Get icon fonts BB array
 */
if ( ! function_exists( 'boldthemes_get_icon_fonts_bb_array' ) ) {
	function boldthemes_get_icon_fonts_bb_array() {
		$fonts = array();
		$glob_match = glob( get_parent_theme_file_path( 'fonts/*/*.php' ) );
		if ( $glob_match ) {
			foreach( $glob_match as $file ) {
				if ( preg_match( '/([a-zA-Z0-9_-]+)\/\1.php$/', $file, $match ) ) {
					if ( substr( $match[1], 0, 1 ) != '_' ) {
						$fonts[ $match[1] ] = $file;
					}
				}
			}
		}
	
		$icon_arr = array();

		foreach( $fonts as $key => $value ) {
			require( $value );
			$icon_arr[ $key ] = $$set;
		}

		return $icon_arr;
	}
}

/**
 * Category select fancySelect compatibility
 */
if ( ! function_exists( 'boldthemes_cat_select' ) ) {
	function boldthemes_cat_select() {
		ob_start();
		?>
			var boldthemes_dropdown = document.querySelector( ".widget_categories #cat" );
			function boldthemes_onCatChange() {
				if ( boldthemes_dropdown.options[boldthemes_dropdown.selectedIndex].value > 0 ) {
					location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+boldthemes_dropdown.options[boldthemes_dropdown.selectedIndex].value;
				}
			}
			if ( boldthemes_dropdown !== null ) {
				boldthemes_dropdown.onchange = boldthemes_onCatChange;
			}
		<?php
		
		$js = ob_get_clean();
		
		wp_add_inline_script( 'boldthemes-framework-misc', $js );
	}
}