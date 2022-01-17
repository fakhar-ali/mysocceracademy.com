<?php 

if ( isset( $boldthemes_options['pf_slug'] ) && !is_null( $boldthemes_options['pf_slug'] ) && $boldthemes_options['pf_slug'] != "" && !is_null( boldthemes_get_id_by_slug( $boldthemes_options['pf_slug'] ) ) && boldthemes_get_id_by_slug( $boldthemes_options['pf_slug'] ) != '' ) {
	BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( $boldthemes_options['pf_slug'] );
} else if ( !is_null( boldthemes_get_id_by_slug('portfolio') ) && boldthemes_get_id_by_slug('portfolio') != '' ) {
	$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( 'portfolio' ) );
	BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( 'portfolio' );
} else if ( get_option( 'page_for_posts' ) ) {
	$tmp_boldthemes_page_options1 = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override', array(), boldthemes_get_id_by_slug( $boldthemes_options['pf_settings_page_slug'] ) );
	BoldThemesFramework::$page_for_header_id = get_option( 'page_for_posts' );
}

$pf_list_view = boldthemes_get_option( 'pf_list_view' );
$image_size = $pf_list_view == 'columns' ? 'boldthemes_medium_rectangle' : 'boldthemes_large_rectangle';

get_header();

if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();

		$featured_image = '';
		if ( has_post_thumbnail() ) {
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$image = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
			$featured_image = $image[0];		
		}
		
		$images = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_images', 'type=image&size=' . $image_size );
		if ( $images == null ) $images = array();
		$images = array_slice( $images, 0, 3 );
		$video = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_video' );
		$audio = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_audio' );

		BoldThemesFrameworkTemplate::$media_html = boldthemes_get_new_media_html( array( 'video' => $video, 'audio' => $audio, 'images' => $images, 'size' => $image_size, 'gallery_type' => 'carousel', 'featured_image' => $featured_image ) );
		
		$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		$permalink = get_permalink();
		
		$post_categories = get_the_terms( $post, 'portfolio_category' );
		
		BoldThemesFrameworkTemplate::$categories_html = boldthemes_get_post_categories( array( "categories" => $post_categories ) );
		
		BoldThemesFrameworkTemplate::$pf_use_dash = boldthemes_get_option( 'pf_use_dash' );
		
		BoldThemesFrameworkTemplate::$class_array = array( 'btArticleListItem', 'animate', 'bt_bb_animation_fade_in', 'bt_bb_animation_move_up' );
		if ( BoldThemesFrameworkTemplate::$media_html == '' ) BoldThemesFrameworkTemplate::$class_array[] = 'btNoMedia';
		
		BoldThemesFrameworkTemplate::$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );

		$comments_open = comments_open();
		$comments_number = get_comments_number();
		BoldThemesFrameworkTemplate::$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			BoldThemesFrameworkTemplate::$show_comments_number = false;
		}
		
		BoldThemesFrameworkTemplate::$content_final_html = get_post()->post_excerpt != '' || is_search() ? '<p>' . esc_html( get_the_excerpt() ) . '</p>' : $content_html;

		if ( $pf_list_view == 'columns' ) {
			get_template_part( 'views/portfolio/list/columns' );
		} else {
			get_template_part( 'views/portfolio/list/standard' );
		}

	}
	
	boldthemes_pagination();
	
} else {
	if ( is_search() ) { ?>
		<article class="bt-no-search-results bt_bb_section bt_bb_top_spacing_large bt_bb_bottom_spacing_large bt_bb_layout_boxed_1200">
			<div class="bt_bb_port">
				<div class="bt_bb_cell">
				<?php 
				echo boldthemes_get_heading_html(
					array(
						'headline' => esc_html__( 'We are sorry, no results for: ', 'zele' ) . get_search_query(),
						'subheadline' => esc_html__( 'Back to homepage', 'zele' ),
						'url' => home_url( '/' ),
						'size' => 'medium'
					)									 
				);
				?>
				</div>
			</div>
		</article>
	<?php }
}
 
?>

<?php

get_footer();

?>