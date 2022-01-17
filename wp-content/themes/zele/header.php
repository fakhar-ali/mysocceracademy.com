<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php boldthemes_theme_data(); ?>>
<head>

<?php

	boldthemes_set_override();
	boldthemes_header_init();
	boldthemes_header_meta();

	$body_style = '';
	
	$menu_type = boldthemes_get_option( 'menu_type' );

	$page_background = boldthemes_get_option( 'page_background' );
	if ( $page_background ) {
		if ( is_numeric( $page_background ) ) {
			$page_background = wp_get_attachment_image_src( $page_background, 'full' );
			$page_background = $page_background[0];
		}
		$body_style = 'background-image:url(' . $page_background . ')';
	}

	$header_extra_class = ''; 

	if ( boldthemes_get_option( 'boxed_menu' ) ) {
		$header_extra_class .= 'gutter ';
	}


	$crest = boldthemes_get_option( 'crest' ); 
	if ( ! is_string( $crest ) ) { // erased from disk
		$crest = '';
	}
	if ( $crest != '' ) {
		$body_class[] = 'btHasCrest';
		$image_id = 0;
		if( is_numeric( $crest ) ) {
			$image_id = $crest + 0;
		} else {
			$tmp = $crest;
			if ( strpos( $crest, '/wp-content' ) === 0 ) {
				$crest = get_home_url() . $crest;
			}
			$image_id = attachment_url_to_postid( $crest );
			if ( $image_id == 0 ) {
				$crest = $tmp;
			}
			$image_id = attachment_url_to_postid( $crest );
		}
		if( $image_id > 0) {
			$image = wp_get_attachment_image_src( $image_id, 'full' );
			if ( $image ) {
				$crest = $image[0];
				$width = $image[1];
				$height = $image[2];
			} else {
				$crest = '';
			}
		} else {
			$crest = '';
		}
	}

	$logo = '';
	$logo = boldthemes_get_option( 'logo' );

	wp_head(); ?>
	
</head>

<body <?php body_class(); ?> <?php if ( $body_style != '' ) echo  ' style="' . esc_attr( $body_style ) .'"'; ?>>

<?php wp_body_open(); ?>

<?php echo boldthemes_preloader_html(); ?>

<div class="bt-page-wrap" id="top">
	
	<?php if ( boldthemes_get_option( 'header_style' ) != 'hidden' ) { ?>
    <div class="bt-vertical-header-top">
		<?php if ( has_nav_menu( 'primary' ) ) { ?>
		<div class="bt-vertical-menu-trigger">&nbsp;<div class="bt_bb_icon"><div class="bt_bb_icon_holder"></div></div></div>
		<?php } ?>	
		<div class="bt-logo-area">

			
			<?php if ( ( $crest != '' ) && ( $logo != '' ) ) { ?>
				<div class="logo">
					<?php 
						$home_link =  home_url( '/' ) ;
						if ( $crest != '' ) {
							echo "<div class='btCrest'><a href='" . esc_url( $home_link ) . "'><img src='" . esc_attr( $crest ) . "' class='btCrestImg' alt='" . esc_attr( get_bloginfo( 'name' ) ) . "'/></a></div>";
						}
					?>
					<span>
						<?php boldthemes_logo( 'header' ); ?>
					</span>
				</div>
			<!-- Crest & Logo -->

			
			<?php } else if ( ( $crest != '' ) && ( $logo == '' ) ) { ?>
				<div class="logo">
					<?php 
						$home_link =  home_url( '/' ) ;
						if ( $crest != '' ) {
							echo "<div class='btCrest'><a href='" . esc_url( $home_link ) . "'><img src='" . esc_attr( $crest ) . "' class='btCrestImg' alt='" . esc_attr( get_bloginfo( 'name' ) ) . "'/></a></div>";
						}
					?>
				</div>
			<!-- Only Crest -->

			
			<?php } else if ( ( $crest == '' )  && ( $logo != '' ) ) { ?>
				<div class="logo">
					<span>
						<?php boldthemes_logo( 'header' ); ?>
					</span>
				</div>
			<!-- Only Logo -->

			
			<?php } else if ( ( $crest == '' )  && ( $logo == '' ) ) { ?>
				<div class="logo">
					<?php 
						$home_link =  home_url( '/' ) ;
							echo '<a href="' . esc_url( $home_link ) . '" class="btTextLogo">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
					?>
				</div>
			<!-- No Crest & No Logo -->


			<?php } ?>


		</div><!-- /btLogoArea -->
	</div><!-- /btVerticalHeaderTop -->


	<header class="mainHeader btClear <?php echo esc_attr( $header_extra_class ); ?>">
		<div class="main-header-inner">
			<?php boldthemes_top_bar_html( 'top', $menu_type ); ?>
			<div class="bt-logo-area menu-holder btClear">
				<div class="port">
					<?php 
						$menu_prefix = 'primary';
						$blog_page_menu = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name', array(), get_option( 'page_for_posts' ) );
						$shop_page_menu = false;
						if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && get_option( 'woocommerce_shop_page_id' ) ) {
							$shop_page_menu = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name', array(), get_option( 'woocommerce_shop_page_id' ) );
						}
						if ( has_nav_menu( 'primary' ) || ( is_home() && $blog_page_menu != '' ) || $shop_page_menu || boldthemes_rwmb_meta( BoldThemesFramework::$pfx . $menu_prefix . '_menu_name' ) != '' ) { ?>
						<div class="bt-horizontal-menu-trigger">&nbsp;<div class="bt_bb_icon"><div class="bt_bb_icon_holder"></div></div></div>
					<?php } ?>

					<?php if ( ( $crest != '' ) && ( $logo != '' ) ) { ?>
						<div class="logo">
							<?php 
								$home_link =  home_url( '/' ) ;
								if ( $crest != '' ) {
									echo "<div class='btCrest'><a href='" . esc_url( $home_link ) . "'><img src='" . esc_attr( $crest ) . "' class='btCrestImg' alt='" . esc_attr( get_bloginfo( 'name' ) ) . "'/></a></div>";
								}
							?>
							<span>
								<?php boldthemes_logo( 'header' ); ?>
							</span>
						</div>
					<!-- Crest & Logo -->

					
					<?php } else if ( ( $crest != '' ) && ( $logo == '' ) ) { ?>
						<div class="logo">
							<?php 
								$home_link =  home_url( '/' ) ;
								if ( $crest != '' ) {
									echo "<div class='btCrest'><a href='" . esc_url( $home_link ) . "'><img src='" . esc_attr( $crest ) . "' class='btCrestImg' alt='" . esc_attr( get_bloginfo( 'name' ) ) . "'/></a></div>";
								}
							?>
						</div>
					<!-- Only Crest -->

					
					<?php } else if ( ( $crest == '' )  && ( $logo != '' ) ) { ?>
						<div class="logo">
							<span>
								<?php boldthemes_logo( 'header' ); ?>
							</span>
						</div>
					<!-- Only Logo -->

					
					<?php } else if ( ( $crest == '' )  && ( $logo == '' ) ) { ?>
						<div class="logo">
							<?php 
								$home_link =  home_url( '/' ) ;
									echo '<a href="' . esc_url( $home_link ) . '" class="btTextLogo">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
							?>
						</div>
					<!-- No Crest & No Logo -->

					<?php } ?>

					<?php 
						if ( $menu_type == 'horizontal-below-right' || $menu_type == 'horizontal-below-center' || $menu_type == 'horizontal-below-left' || $menu_type == 'vertical-left' || $menu_type == 'vertical-right' || $menu_type == 'fullscreen-center' ) {
							boldthemes_top_bar_html( 'logo', $menu_type );
							echo '</div><!-- /port --></div><!-- /menu-holder -->';
							echo '<div class="bt-below-logo-area btClear"><div class="port">';
						}
					?>
					<div class="menuPort">
						<?php boldthemes_top_bar_html( 'menu', $menu_type ); ?>
						<nav>
							<?php boldthemes_nav_menu(); ?>

							<?php boldthemes_menu_background( $menu_type ); ?>	
						</nav>
					</div><!-- .menuPort -->
				</div><!-- /port -->
			</div><!-- /menu-holder / bt-below-logo-area -->
		</div><!-- / inner header for scrolling -->
    </header><!-- /.mainHeader -->
	<?php } ?>
	<div class="bt-content-wrap btClear">
		<?php 
		$hide_headline = boldthemes_get_option( 'hide_headline' );
		if ( ( ( ! $hide_headline && ! is_404() ) || is_search() ) ) {
			boldthemes_header_headline( array( 'breadcrumbs' => true ) ); 
		}
		?>
		<?php if ( BoldThemesFramework::$page_for_header_id != '' && ! is_search() ) { ?>
			<?php
				$content = get_post( BoldThemesFramework::$page_for_header_id );
				if ( !is_null( $content ) && $content != '' ) {
					$top_content = $content->post_content;
					if ( $top_content != '' ) {
						$top_content = do_shortcode($top_content);
						$top_content = preg_replace( '/data-edit_url="(.*?)"/s', 'data-edit_url="' . get_edit_post_link( BoldThemesFramework::$page_for_header_id, '' ) . '"', $top_content );
						echo '<div class="bt-blog-header-content">' . str_replace( ']]>', ']]&gt;', $top_content ) . '</div>';
					}
				}
				
			?>
		<?php } ?>
		<div class="bt-content-holder">
			
			<div class="bt-content">
			