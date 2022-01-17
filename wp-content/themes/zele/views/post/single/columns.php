<?php
	
	$share_html = boldthemes_get_share_html( get_permalink(), 'blog', 'xsmall' );
	
	echo '<article class="btPostSingleItemColumns gutter ' . esc_attr( implode( ' ', get_post_class(BoldThemesFrameworkTemplate::$class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="btArticleContentHolder">';
	
				if ( BoldThemesFrameworkTemplate::$media_html != '' ) {
					echo '<div class="btArticleMedia">' . BoldThemesFrameworkTemplate::$media_html . '</div><!-- /btArticleMedia -->';
				}

				echo '<div class="btArticleTextContent">';
					
					if ( boldthemes_get_option( 'hide_headline' ) ) {
						echo '<div class="btArticleHeadline">';
							echo boldthemes_get_heading_html (
								array (
									'superheadline' 	=> BoldThemesFrameworkTemplate::$categories_html,
									'headline' 			=> get_the_title(),
									'subheadline' 		=> BoldThemesFrameworkTemplate::$meta_html,
									'size' 				=> 'normal',
									'dash' 				=> BoldThemesFrameworkTemplate::$dash
								)
							);
						echo '</div><!-- /btArticleHeadline -->' ;
					}
				
					$extra_class = '';

					echo '<div class="btArticleContent ">' . BoldThemesFrameworkTemplate::$content_html . '</div>';
				
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
				
					global $multipage;
					if ( $multipage ) { 
						echo '<div class="btClear btSeparator bottomSmallSpaced noBorder"><hr></div>';
						wp_link_pages( array ( 
							'before'      => '<ul>' . esc_html__( 'Pages:', 'zele' ),
							'separator'   => '<li>',
							'after'       => '</ul>'
						));	
					}

				echo '</div><!-- /btArticleTextContent -->' ;

			echo '</div><!-- /btArticleContentHolder -->' ;
		echo '</div><!-- /port -->';		
	echo '</article>';
?>