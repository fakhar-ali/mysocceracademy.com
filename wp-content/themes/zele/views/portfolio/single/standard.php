<?php

	$share_html = boldthemes_get_share_html( get_permalink(), 'pf', 'xsmall' );
			
	echo '<article class="btPostSingleItemStandard btPortfolioSingle gutter ' . esc_attr( implode( ' ', get_post_class(BoldThemesFrameworkTemplate::$class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="btPostContentHolder">';

				if ( boldthemes_get_option( 'hide_headline' ) ) {
					echo '<div class="btArticleHeadline">' . boldthemes_get_heading_html (
						array (
							'superheadline' 	=> BoldThemesFrameworkTemplate::$categories_html,
							'headline' 			=> get_the_title(),
							'subheadline' 		=> '',
							'size' 				=> 'large',
							'html_tag' 			=> 'h1',
							'dash' 				=> BoldThemesFrameworkTemplate::$dash
						)
					) . '</div><!-- /btArticleHeadline -->';
				}

				if ( BoldThemesFrameworkTemplate::$media_html != '' ) {
					echo '<div class="btArticleMedia">' . BoldThemesFrameworkTemplate::$media_html . '</div><!-- /btArticleMedia -->';
				}

				echo '<div class="btArticleContent">';
					echo '<div class="btArticleContentInner">' . BoldThemesFrameworkTemplate::$content_html . '</div>';
					
					if ( ( BoldThemesFrameworkTemplate::$cf != '' && count( BoldThemesFrameworkTemplate::$cf ) > 0 ) || $share_html != '' ) {
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

							if ( $share_html != '' ) echo '<div class="btShareRow">' . wp_kses( $share_html, 'share' ) . '</div><!-- /btShareRow -->';
						echo '</div><!-- /btArticleSuperMeta -->';
					}

				echo '</div><!-- /btArticleContent -->';

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

			echo '</div><!-- /btPostContentHolder -->' ;
		echo '</div><!-- /port -->';		
	echo '</article>';

?>