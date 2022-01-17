<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="bt-comments-box">

	<?php if ( have_comments() ) : ?>

	<h4>
		<?php
			printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'zele' ), number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h4>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<?php 
			$prev_html = get_previous_comments_link( esc_html__( 'Older Comments', 'zele' ) );
			$next_html = get_next_comments_link( esc_html__( 'Newer Comments', 'zele' ) );
			if ( $prev_html != '' && $next_html != '' ) {
				echo get_previous_comments_link( esc_html__( 'Older Comments', 'zele' ) );
				echo '<span>|</span>';
				echo get_next_comments_link( esc_html__( 'Newer Comments', 'zele' ) );
			} else {
				echo get_previous_comments_link( esc_html__( 'Older Comments', 'zele' ) );
				echo get_next_comments_link( esc_html__( 'Newer Comments', 'zele' ) );
			}
			?>
		</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ul class="comments">
		<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'callback'   => 'boldthemes_theme_comment'
			) );
		?>
	</ul><!-- .comments -->

	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'zele' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
	
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
	
		$fields =  array(
			'author' =>
				'<div class="pc-item"><label for="author">' . esc_html__( 'Name', 'zele' ) . ( $req ? ' *' : '' ) . '</label>
				<p><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" ' . $aria_req . ' /></p></div>',

			'email' =>
				'<div class="pc-item"><label for="email">' . esc_html__( 'Email', 'zele' ) . ( $req ? ' *' : '' ) . '</label>
				<p><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" ' . $aria_req . ' /></p></div>',

			'url' =>
				'<div class="pc-item"><label for="url">' . esc_html__( 'Website', 'zele' ) . '</label>' .
				'<p><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p></div>',
		);
	
		$args = array(
		  'id_form'           => 'commentform',
		  'id_submit'         => 'submit',
		  'title_reply'       => esc_html__( 'Leave a Reply', 'zele' ),
		  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'zele' ),
		  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'zele' ),
		  'label_submit'      => esc_html__( 'Post Comment', 'zele' ),
		  
		  'submit_button' => '<span class="pc-item"><button type="submit" value="' . esc_html__( 'Post Comment', 'zele' ) . '" id="bt-submit" class="bt-comment-submit" name="submit" data-ico-fa="&#xf1d8;"><span class="btnInnerText">' . esc_html__( 'Post Comment', 'zele' ) . '</span></button></span>',

		  'comment_field' =>  '<div class="pc-item bt-comment"><label for="comment">' . _x( 'Comment', 'noun', 'zele' ) .
			' <span class="required">*</span></label><p><textarea id="comment" name="comment" cols="30" rows="8" aria-required="true">' .
			'</textarea></p></div>',

		  'must_log_in' => '<p class="must-log-in">' .
			sprintf(
				wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'zele' ), 'comments' ),
				wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			) . '</p>',

		  'logged_in_as' => '<p class="logged-in-as">' .
			sprintf(
				wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="%4$s">%5$s</a>', 'zele' ), 'comments' ),
				admin_url( 'profile.php' ),
				$user_identity,
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ),
                                esc_attr__( 'Log out of this account', 'zele' ),
                                esc_html__( 'Log out?', 'zele' )
			) . '</p>',

		  'comment_notes_before' => '<p class="comment-notes">' .
			esc_html__( 'Your email address will not be published.', 'zele' ) . ' ' . ( $req ? esc_html__( 'Required fields are marked *', 'zele' ) : '' ) .
			'</p>',

		  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		);
		comment_form( $args );
	?>

</div><!-- #comments -->