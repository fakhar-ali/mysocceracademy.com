<?php

get_header();

the_post();

the_content();

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

if ( comments_open() || get_comments_number() ) {
	echo '<section class="boldSection bt-comments gutter topSpaced bottomSpaced">';
		echo '<div class="port">';
			echo '<div class="boldCell">';
				echo '<div class="boldRow">';
					echo '<div class="rowItem col-md-12 col-ms-12 btTextLeft animate-fadein animate">';
						comments_template();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>';
}

get_footer();