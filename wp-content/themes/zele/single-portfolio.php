<?php

$boldthemes_options = get_option( BoldThemesFramework::$pfx . '_theme_options' );

$tmp_boldthemes_page_options = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_override' );
if ( ! is_array( $tmp_boldthemes_page_options ) ) $tmp_boldthemes_page_options = array();
$tmp_boldthemes_page_options = boldthemes_transform_override( $tmp_boldthemes_page_options );

if ( isset( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] ) && $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug'] != '' ) {
	BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( $tmp_boldthemes_page_options[ BoldThemesFramework::$pfx . '_pf_settings_page_slug' ] );
} else if ( isset( $boldthemes_options['pf_settings_page_slug'] ) && $boldthemes_options['pf_settings_page_slug'] != '' ) {
	BoldThemesFramework::$page_for_header_id = boldthemes_get_id_by_slug( $boldthemes_options['pf_settings_page_slug'] );
}

BoldThemesFrameworkTemplate::$cf = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_custom_fields' );
$pf_use_dash = boldthemes_get_option( 'pf_use_dash' );
BoldThemesFrameworkTemplate::$dash = $pf_use_dash ? 'top' : '';
$gallery_type = intval( boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_grid_gallery' ) ) == 0 ? 'carousel' : 'grid'; 

get_header();

if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();

		$featured_image = '';
		if ( has_post_thumbnail() && boldthemes_get_option( 'hide_headline' ) ) {
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$image = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
			$featured_image = $image[0];		
		}

		$images = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_images', 'type=image&size=large' );
		if ( $images == null ) $images = array();
		
		$video = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_video' );
		$audio = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_audio' );
	
		BoldThemesFrameworkTemplate::$media_html = boldthemes_get_new_media_html( array( 'type' => 'single-portfolio', 'video' => $video, 'audio' => $audio, 'images' => $images, 'size' => 'boldthemes_large_rectangle', 'gallery_type' => $gallery_type, 'featured_image' => $featured_image ) );

		$permalink = get_permalink();
		$post_format = get_post_format();

		$content_html = apply_filters( 'the_content', get_the_content() );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		BoldThemesFrameworkTemplate::$content_html = $content_html;
		
		$post_categories = get_the_terms( $post, 'portfolio_category' );
		BoldThemesFrameworkTemplate::$categories_html = boldthemes_get_post_categories( array( "categories" => $post_categories ) );
		
		$tags = get_the_tags();
		BoldThemesFrameworkTemplate::$tags_html = '';
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				BoldThemesFrameworkTemplate::$tags_html .= '<li><a href="' . esc_url_raw( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
			}
			BoldThemesFrameworkTemplate::$tags_html = rtrim( $tags_html, ', ' );
			BoldThemesFrameworkTemplate::$tags_html = '<div class="btTags"><ul>' . BoldThemesFrameworkTemplate::$tags_html . '</ul></div>';
		}
		
		$comments_open = comments_open();
		$comments_number = get_comments_number();
		BoldThemesFrameworkTemplate::$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			BoldThemesFrameworkTemplate::$show_comments_number = false;
		}
		
		BoldThemesFrameworkTemplate::$class_array = array( );
		if ( BoldThemesFrameworkTemplate::$media_html == '' ) BoldThemesFrameworkTemplate::$class_array[] = 'noPhoto';

			BoldThemesFrameworkTemplate::$meta_html = boldthemes_get_post_meta();

			if ( boldthemes_get_option( 'pf_single_view' ) == 'columns' ) {
				get_template_part( 'views/portfolio/single/columns' );	
			} else {
				get_template_part( 'views/portfolio/single/standard' );
			}

			if ( comments_open() || get_comments_number() ) {
				get_template_part( 'views/comments' );
			}
			
			get_template_part( 'views/prev_next' );
		}

	}

	?>
	

<?php

get_footer();

?>