<?php

	$share_html = boldthemes_get_share_html( get_permalink(), 'blog', 'xsmall' );
			
	echo '<article class="btPostSingleItemStandard gutter ' . esc_attr( implode( ' ', get_post_class( BoldThemesFrameworkTemplate::$class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="btPostContentHolder">';
						
				if ( boldthemes_get_option( 'hide_headline' ) ) {
					echo '<div class="btArticleHeadline">' . boldthemes_get_heading_html (
						array (
							'superheadline' 	=> BoldThemesFrameworkTemplate::$categories_html,
							'headline' 			=> get_the_title(),
							'subheadline' 		=> BoldThemesFrameworkTemplate::$meta_html,
							'size' 				=> 'large',
							'html_tag' 			=> 'h1',
							'dash' 				=> BoldThemesFrameworkTemplate::$dash
						)
					) . '</div><!-- /btArticleHeadline -->';
				}

				if ( BoldThemesFrameworkTemplate::$media_html != '' ) {
					echo '<div class="btArticleMedia">' . BoldThemesFrameworkTemplate::$media_html . '</div><!-- /btArticleMedia -->';
				}

				$extra_class = '';
				
				if ( BoldThemesFrameworkTemplate::$post_format == 'link' && BoldThemesFrameworkTemplate::$media_html == '' ) {
					$extra_class = ' btLinkOrQuote';
				}

				echo '<div class="btArticleContent ' . esc_attr( $extra_class ) . '">' . BoldThemesFrameworkTemplate::$content_html . '</div>';

				global $multipage;
				if ( $multipage ) { 
					echo '<div class="bt-link-pages">';
						wp_link_pages( array( 
							'before'      => '<ul>' . esc_html__( 'Pages:', 'zele' ),
							'separator'   => '<li>',
							'after'       => '</ul>'
						));
					echo '</div><!-- /bt-link-pages -->';
				}
				
				
				if ( ( BoldThemesFrameworkTemplate::$tags_html != '' ) || ( $share_html != '' ) ) {
					echo '<div class="btArticleShareEtc">';
						
						if ( BoldThemesFrameworkTemplate::$tags_html != '' ) {
							echo '<div class="btTagsColumn">';
								echo wp_kses( BoldThemesFrameworkTemplate::$tags_html, 'tags' );
							echo '</div><!-- /btTagsColumn -->';
						}
						
						if ( $share_html != '' ) {
							echo '<div class="btShareColumn">' . wp_kses( $share_html, 'share' ) . '</div><!-- /btShareColumn -->';
						}

					echo '</div><!-- /btArticleShareEtc -->';
				}
				
			echo '</div><!-- /btPostContentHolder -->' ;
		echo '</div><!-- /port -->';		
	echo '</article>';

?>