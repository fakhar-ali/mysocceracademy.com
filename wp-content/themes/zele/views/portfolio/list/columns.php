<?php

	$share_html = boldthemes_get_share_html( get_permalink(), 'pf', 'xsmall' );

	$dash = BoldThemesFrameworkTemplate::$pf_use_dash ? 'top' : '';
	
	echo '<article class="btPostListColumns gutter ' . esc_attr( implode( ' ', get_post_class(BoldThemesFrameworkTemplate::$class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="btArticleContentHolder">';
								
				if ( BoldThemesFrameworkTemplate::$media_html != '' ) {
					$extra_class = '';
					echo '<div class="btArticleMedia ' . esc_attr( $extra_class ) . '">';
					echo ' ' . BoldThemesFrameworkTemplate::$media_html;
					echo '</div><!-- /btArticleMedia -->';
				}
				
				echo '<div class="btArticleTextContent">';
					echo '<div class="btArticleHeadline">';
					echo boldthemes_get_heading_html(
						array(
							'superheadline' 	=> BoldThemesFrameworkTemplate::$categories_html,
							'headline' 			=> get_the_title(),
							'subheadline' 		=> '',
							'url' 				=> get_permalink(),
							'size' 				=> 'medium',
							'html_tag' 			=> 'h2',
							'dash' 				=> $dash,
							'el_style' 			=> '',
							'el_class' 			=> ''
						)									 
					);
					echo '</div><!-- /btArticleHeadline -->';

					echo '<div class="btArticleContent">' . BoldThemesFrameworkTemplate::$content_final_html . '</div>';	
						
					if ( $share_html != '' ) echo '<div class="btShareRow">' . wp_kses( $share_html, 'share' ) . '</div><!-- /btShareRow -->';
				echo '</div><!-- /btArticleTextContent -->';	
			
			echo '</div><!-- /btArticleContentHolder -->' ;
		echo '</div><!-- /port -->';	
	echo '</article>';

?>