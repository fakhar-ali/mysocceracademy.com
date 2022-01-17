<?php
                $prefix = 'bold_timeline_item_posts';
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
                
		/* args for query posts */
		$args   = bold_timeline_get_args_for_query_posts( $atts );                
		/* query posts */
		$posts  = bold_timeline_query_posts_data( $args );
		
		$output = '<div class="' . implode( ' ', $class ) . '"' . $id_attr . $style_attr . '><div class="bold_timeline_item_posts_inner">';
               
			if ( $posts && count( $posts ) > 0 ) {
				foreach ( $posts as $item ) {                            
					$post_data              = bold_timeline_post_data( $item );                        
					$post_title             = $post_data['title'];                        
					$post_date              = $post_data['date'];                        
					$post_cats              = $post_data['cats'];                        
					$post_comments          = $post_data['comments'];                        
					$post_excerpt           = $post_data['excerpt'];                        
					$post_featured_image    = $post_data['featured_image'];                        
					$post_permalink         = $post_data['permalink'];                            

					// timeline item element
					$bold_timeline_item_title           = $post_title;
					$bold_timeline_item_subtitle        = '';
					$bold_timeline_item_supertitle      = '';
					$bold_timeline_item_images          = '';

					// timeline text element                       
					$bold_timeline_item_text_content    = '';

					//timeline design
					switch ( $show_date ){
						case 'no':break;
						case 'supertitle':
							$show_date_class = $prefix . '_date';
							$bold_timeline_item_supertitle  .= bold_timeline_date_output( $post_date, $post_permalink, $show_date_class );                                 
							break;
						case 'subtitle':
							$show_date_class = $prefix . '_date';
							$bold_timeline_item_subtitle    .= bold_timeline_date_output( $post_date, $post_permalink, $show_date_class );
							break;
						default:break;
					}

					switch ( $show_categories ){
						case 'no':break;
						case 'supertitle':
							$show_categories_class = $prefix . '_cats';
							$bold_timeline_item_supertitle   .= bold_timeline_categories_output($post_cats, $post_permalink, $show_categories_class);
							break;
						case 'subtitle':
							$show_categories_class = $prefix . '_cats';
							$bold_timeline_item_subtitle     .= bold_timeline_categories_output($post_cats, $post_permalink, $show_categories_class);
							break;
						default:break;
					}

					switch ( $show_comments ){
						case 'no':break;
						case 'supertitle':
							$show_comments_class = $prefix . '_comments';
							$bold_timeline_item_supertitle  .= bold_timeline_comments_output( $post_comments, $post_permalink, $show_comments_class );
							break;
						case 'subtitle':
							$show_comments_class = $prefix . '_comments';
							$bold_timeline_item_subtitle    .= bold_timeline_comments_output( $post_comments, $post_permalink, $show_comments_class );
							break;
						default:break;
					}  

					if ( $show_excerpt == 'yes' ){
						$bold_timeline_item_text_content    = $post_excerpt;
					}                        

					if ( $show_featured_image == 'yes' ){
						 $bold_timeline_item_images         = $post_featured_image;
					}
					
					//timeline item posts output
					$output .= wptexturize( do_shortcode( 
						'[bold_timeline_item'
						. ' title="<a href=\'' . $post_permalink . '\'>' . $bold_timeline_item_title . '</a>"'
						. ' subtitle="' . $bold_timeline_item_subtitle . '"'
						. ' supertitle="' . $bold_timeline_item_supertitle . '"'
						. ' images="' . $bold_timeline_item_images . '"'
						. ']'
							. '[bold_timeline_item_text]'
								. $bold_timeline_item_text_content 
							. '[/bold_timeline_item_text]'
						. '[/bold_timeline_item]' 
					 ) );
				}
			} else {
				$output .= wptexturize( do_shortcode('[bold_timeline_item][bold_timeline_item_text]' . esc_html__( 'No Posts Found', 'bold-timeline' ) . '[/bold_timeline_item_text][/bold_timeline_item]'));
			}

		$output .= '</div></div>';

