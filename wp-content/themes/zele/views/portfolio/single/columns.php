<?php

	$share_html = boldthemes_get_share_html( get_permalink(), 'pf', 'xsmall' );
	
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
	
					echo '<div class="btArticleContent">';
						echo '<div class="btArticleContentInner">' . BoldThemesFrameworkTemplate::$content_html. '</div>';
						
						if ( ( BoldThemesFrameworkTemplate::$cf != '' && count( BoldThemesFrameworkTemplate::$cf ) > 0 ) ) {
							echo '<div class="btArticleSuperMeta">';
								echo '<dl>';
									for ( $i = 0; $i < count( BoldThemesFrameworkTemplate::$cf ); $i++ ) {
										$item = BoldThemesFrameworkTemplate::$cf[ $i ];
										$item_key = substr( $item, 0, strpos( $item, ':' ) );
										$item_value = substr( $item, strpos( $item, ':' ) + 1 );
										echo '<dt>' . esc_html( $item_key ) . ':</dt>';
										echo '<dd>' . esc_html( $item_value ) . '</dd>';
									}
								echo '</dl>';
							echo '</div><!-- /btArticleSuperMeta -->';
						}

					echo '</div><!-- /btArticleContent -->';

					if ( $share_html != '' ) echo '<div class="btShareRow">' . wp_kses( $share_html, 'share' ) . '</div><!-- /btShareRow -->';
			
					global $multipage;
			
					if ( $multipage ) { 
						echo '<div class="btClear btSeparator bottomSmallSpaced noBorder"><hr></div>';
						wp_link_pages( array( 
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