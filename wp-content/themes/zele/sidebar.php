<?php
	if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_checkout() || is_cart() ) ) {
		if ( is_active_sidebar( 'bt_shop_sidebar' ) ) {
			?><aside class="btSidebar"><?php
				dynamic_sidebar( 'bt_shop_sidebar' );
			?></aside><?php
		}
	} else {
		if ( is_active_sidebar( 'primary_widget_area' ) ) {
			?><aside class="btSidebar"><?php
				dynamic_sidebar( 'primary_widget_area' );
			?></aside><?php
		}
	}