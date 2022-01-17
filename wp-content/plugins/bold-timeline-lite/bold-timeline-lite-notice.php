<?php
if (!class_exists('BoldTimelineLiteNotice')) {
	 class BoldTimelineLiteNotice {
			public function __construct() {				
				if(is_admin()){					
					add_action( 'admin_notices', array( $this, 'bold_timeline_lite_admin_notice_for_upgrade_plugin' ) );
					add_action( 'admin_print_scripts', array( $this, 'bold_timeline_lite_admin_load_script' ) );
					add_action( 'admin_enqueue_scripts', array( $this, 'bold_timeline_lite_admin_notice_style' ));	
					add_action( 'wp_ajax_bold_timeline_lite_dismiss_notice_callto_action_snooze', array( $this, 'bold_timeline_lite_dismiss_notice_callto_action_snooze' ) );					
				}
			}

			function bold_timeline_lite_admin_notice_style() {
				if ( ! wp_script_is( 'bold_timeline_admin_style', 'enqueued' ) ) {
					wp_enqueue_style( 'bold_timeline_admin_style', plugin_dir_url( __FILE__ ) . 'style-admin.css' );
				}
			}

			public function bold_timeline_lite_admin_load_script() {
				wp_register_script( 'bold-timeline-lite-admin-feedback-notice', plugins_url( 'bold-timeline-lite-admin-feedback-notice.js', __FILE__  ), array( 'jquery' ),null, true );
				wp_enqueue_script( 'bold-timeline-lite-admin-feedback-notice' );
			}

			public function bold_timeline_lite_admin_notice_for_upgrade_plugin(){
					if( !current_user_can( 'update_plugins' ) ){
						return;
					}
					
					$dismissed_value = get_transient( 'bold-timeline-lite-plugin-notice-dismissed' );	
					if( $dismissed_value === false )
					{
						echo $this->bold_timeline_lite_create_notice_for_upgrade_plugin();
					}
			}

			public function bold_timeline_lite_dismiss_notice_callto_action_snooze(){
					
					set_transient ( 'bold-timeline-lite-plugin-notice-dismissed', 'dismissed', 7 * DAY_IN_SECONDS );
					echo  json_encode( array("success"=>"true") );
					wp_die();
			}

			function bold_timeline_lite_create_notice_for_upgrade_plugin(){
					$ajax_url			= admin_url( 'admin-ajax.php' );
					$ajax_callback		= 'bold_timeline_lite_dismiss_notice_callto_action_snooze';
					
					$plugin_name		= 'Bold Timeline Lite';
					$plugin_link		= esc_url('https://codecanyon.net/item/bold-timeline-wordpress-timeline-plugin/25260473/');				
					$boldthemes_link	= esc_url('https://bold-themes.com/');

					$img_path			= plugin_dir_url( __FILE__ ) . 'assets/gfx/BT-Icon.png';
					$button_text_buy	= esc_html__( 'Buy full version', 'bold-timeline' );
					$button_text_snooze	= esc_html__( 'Snooze for 7 days', 'bold-timeline' );
					
					$message	= esc_html__( 'Thanks for using Bold Timeline Lite by Bold Themes. It\'s fast to set up, hassle-free and super easy to use WordPress plugin. For many more additional and advanced features check out Bold Timeline full version.', 'bold-timeline' );
					
					$html = '<div class="bold_timeline_lite_admin_notice">
									<div  data-ajax-url="%2$s"  data-ajax-callback="%3$s" class="bold-timeline-lite-feedback-notice-wrapper notice notice-info is-dismissible">
										<div  class="bold_timeline_lite_admin_notice_image_container">
											<a href="%7$s" target="_blank" >
												<img src="%6$s" alt="%8$s"/>
											</a>
										</div>
										<div class="bold_timeline_lite_admin_notice_message_container">
											<p>%1$s</p>
											<div class="bold_timeline_lite_dismiss_notice_callto_action">
												<ul>
													<li>
														<a href="%7$s" target="_blank" class="button button-primary" title="%4$s">%4$s</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="button bold_timeline_lite_dismiss_notice_callto_action_snooze" title="%5$s">%5$s</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
							</div>';
				
					return sprintf($html,
						$message,
						$ajax_url,
						$ajax_callback,
						$button_text_buy,
						$button_text_snooze,//5
						$img_path,
						$plugin_link,
						$plugin_name,
						$boldthemes_link
					);
			}
	 }
}

function bold_timeline_wpdocs_this_screen() {    
	if( class_exists( 'BoldThemesFramework' )) {
		$currentScreen = get_current_screen();	
		if(  $currentScreen->id === "bold-timeline_page_bold-timeline-edit" || $currentScreen->id === "toplevel_page_bold-timeline" ) {		
			new BoldTimelineLiteNotice();
		}
	}else{
		 new BoldTimelineLiteNotice();
	}	
}
add_action( 'current_screen', 'bold_timeline_wpdocs_this_screen' );