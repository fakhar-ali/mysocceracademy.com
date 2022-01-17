<?php

	$share_html = boldthemes_get_share_html( get_permalink(), 'blog', 'xsmall' );

	$meta_html = '';
	if ( BoldThemesFrameworkTemplate::$blog_author || BoldThemesFrameworkTemplate::$blog_date || BoldThemesFrameworkTemplate::$show_comments_number ) {
		$meta_html .= '';
		if ( BoldThemesFrameworkTemplate::$blog_date && ! BoldThemesFrameworkTemplate::$blog_side_info ) $meta_html .= boldthemes_get_post_date(); 
		if ( BoldThemesFrameworkTemplate::$blog_author && ! BoldThemesFrameworkTemplate::$blog_side_info ) $meta_html .= boldthemes_get_post_author();
		if ( BoldThemesFrameworkTemplate::$show_comments_number ) {
			if ( $meta_html != '' ) {
				$meta_html .= boldthemes_get_post_comments();
			} else {
				BoldThemesFrameworkTemplate::$categories_html .= boldthemes_get_post_comments();
			}
		}
	}

	$dash = BoldThemesFrameworkTemplate::$blog_use_dash ? 'top' : '';
	
	echo '<article class="btPostSingleItemStandard btPostListStandard gutter ' . esc_attr( implode( ' ', get_post_class( BoldThemesFrameworkTemplate::$class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="btArticleContentHolder">';
				
				if ( BoldThemesFrameworkTemplate::$blog_side_info ) {
					echo '<div class="articleSideGutter">';
					
						$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 144 ); 
						
						if ( $avatar_html != '' ) {
							echo '<div class="asgItem avatar"><a href="' . esc_url_raw( BoldThemesFrameworkTemplate::$author_url ) . '">' . wp_kses( $avatar_html, 'avatar' ) . '</a></div>';
						}

						if ( BoldThemesFrameworkTemplate::$blog_author ) {
							echo '<div class="asgItem title"><span>' . boldthemes_get_post_author() . '</span></div>';
						}

						if ( BoldThemesFrameworkTemplate::$blog_date ) {
							echo '<div class="asgItem date"><small>' . boldthemes_get_post_date( array( 'prefix' => '', 'suffix' => '' ) ) . '</small></div>';
						}	
					
					echo '</div><!-- /articleSideGutter -->';
				}

				if ( BoldThemesFrameworkTemplate::$media_html != '' ) {
					$extra_class = '';
					if ( BoldThemesFrameworkTemplate::$post_format == 'link' && BoldThemesFrameworkTemplate::$media_html == '' ) {
						$extra_class = ' linkOrQuote';
					}
					echo '<div class="btArticleMedia ' . esc_attr( $extra_class ) . '">';
						echo ' ' . BoldThemesFrameworkTemplate::$media_html;
					echo '</div><!-- /btArticleMedia -->';
				}

				echo '<div class="btArticleHeadline">';
					echo boldthemes_get_heading_html(
						array (
							'superheadline' 	=> BoldThemesFrameworkTemplate::$categories_html,
							'headline' 			=> get_the_title(),
							'subheadline' 		=> $meta_html,
							'url' 				=> get_permalink(),
							'target' 			=> '_self',
							'size' 				=> 'normal',
							'html_tag' 			=> 'h2',
							'dash' 				=> $dash,
							'el_style' 			=> '',
							'el_class' 			=> ''
						)
					);
				echo '</div><!-- /btArticleHeadline -->';
				
				echo '<div class="btArticleContent">' . BoldThemesFrameworkTemplate::$content_final_html . '</div>';
					
				echo '<div class="btArticleShareEtc">';
					if ( $share_html != '') echo '<div class="btShareColumn">' . wp_kses( $share_html, 'share' ) . '</div><!-- /btShareColumn -->';
					
					echo '<div class="btReadMoreColumn">';
						$continue_icon = !is_rtl() ? 'arrow_e900' : 'arrow_e900';
						$continue_icon_position = !is_rtl() ?  'right' : 'left';
						echo boldthemes_get_button_html ( 
							array ( 
								'icon' 			=> $continue_icon, 
								'url' 			=> get_permalink(), 
								'text' 			=> esc_html__( 'READ MORE', 'zele' ), 
								'style' 		=> 'clean',
								'size' 			=> 'small', 
								'icon_position' => $continue_icon_position
							)
						);
					echo '</div><!-- /btReadMoreColumn -->';
					
				echo '</div><!-- /btArticleShareEtc -->';
				
			echo '</div><!-- /btArticleContentHolder -->' ;
		echo '</div><!-- /port -->';
	echo '</article>';

?>