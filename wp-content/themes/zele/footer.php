		</div><!-- /boldthemes_content -->
<?php

if ( BoldThemesFramework::$has_sidebar ) {
	include( get_parent_theme_file_path( 'sidebar.php' ) );					
}

?> 
	</div>
</div>

<div class="bt-site-footer">

<?php

$page_slug = boldthemes_get_option( 'footer_page_slug' );
if ( $page_slug != '' ) {
	$page_id = boldthemes_get_id_by_slug( $page_slug );
	if ( ! is_null( $page_id ) ) {
		$page = get_post( $page_id );
		$content = $page->post_content;
		if ( get_post_type() != 'attachment' && ! is_404() ) $content = apply_filters( 'the_content', $content );
		$content = do_shortcode($content);
		$content = preg_replace( '/data-edit_url="(.*?)"/s', 'data-edit_url="' . get_edit_post_link( $page_id, '' ) . '"', $content );
		echo str_replace( ']]>', ']]&gt;', $content );
	}
}

$custom_text_html = '';
$custom_text = boldthemes_get_option( 'custom_text' );
if ( $custom_text != '' ) {
	$custom_text_html = '<p class="copy-line">' . $custom_text . '</p>';
} 

if ( boldthemes_get_option( 'footer_dark_skin' ) ) {
	echo '<footer class="btDarkSkin">';
} else {
	echo '<footer class="btLightSkin">';
}

?>
<?php if ( is_active_sidebar( 'footer_widgets' ) ) {
	echo '
	
		<section class="bt-site-footer-widgets gutter">
			<div class="port">
				<div class="bt_bb_row" id="boldSiteFooterWidgetsRow">';
				dynamic_sidebar( 'footer_widgets' );
		echo '	
				</div>
			</div>
		</section>
	';
}

?>
<?php if ( $custom_text_html != '' || has_nav_menu( 'footer' )) { ?>
	<section class="gutter bt-site-footer-copy-menu">
		<div class="port">
			<div>
				<?php if ( $custom_text_html != '' ) { ?>
				<div class="bt-footer-copy">
					<div class="bt_bb_column_content">
						<?php echo wp_kses_post( $custom_text_html ); ?>
					</div>
				</div>
				<?php } ?>
				<div class="bt-footer-menu">
					<div class="bt_bb_column_content">
						<?php boldthemes_nav_menu( false, 'footer'); ?>
					</div>
				</div>
			</div>
		</div><!-- /port -->
	</section>
<?php } ?>
</footer>
</div><!-- /bt-site-footer -->

</div>

<?php

if ( function_exists( 'zele_back_to_top' ) ) {
	zele_back_to_top();
}

wp_footer();

?>

</body>
</html>