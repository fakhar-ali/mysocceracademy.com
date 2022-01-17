<?php

/**
 * Plugin Name: Bold Timeline Lite
 * Description: Bold Timeline Lite by BoldThemes.
 * Version: 1.0.8
 * Author: BoldThemes
 * Author URI: https://bold-themes.com/
 */

if( !in_array( 'bold-timeline/bold-timeline.php', apply_filters('active_plugins', get_option('active_plugins')))){ 

	if ( ! class_exists( 'Bold_Timeline' ) ) {

		require_once( 'bold-builder-light/bold-builder-light.php' );
		require_once( 'bold-timeline-lite-notice.php' );


		// CSS crush
		if ( ! file_exists( get_parent_theme_file_path( 'css-crush/CssCrush.php' ) ) ) {
			if ( file_exists( plugin_dir_path( __FILE__ ) . 'css-crush/CssCrush.php' ) ) {
				require_once( 'css-crush/CssCrush.php' );
			} else {
				if ( ! class_exists( 'CssCrush\Functions' ) ) {
					require_once( 'BTCrushFunctions.php' );
					require_once( 'BTCrushUtil.php' );
					require_once( 'BTCrushColor.php' );
					require_once( 'BTCrushRegex.php' );
				}
			}
		}

		/**
		 * Main class.
		 *
		 * @since 1.0.0
		 */

		class Bold_Timeline {
			static $builder;
			static $fonts_added = array();
			static $font_subsets_added = array();
			static $crush_vars_def = array();
			static $crush_vars = array();
			static $separator = " ";
		}

		// BB Light

		Bold_Timeline::$builder = new BTBB_Light(
			array(
				'slug' => 'bold-timeline',
				'single_name' => esc_html__( 'Bold Timeline', 'bold-timeline' ),
				'plural_name' => esc_html__( 'Bold Timelines', 'bold-timeline' ),
				'icon' => 'dashicons-clock',
				'home_url' => '//bold-themes.com',
				'doc_url' => '//documentation.bold-themes.com/bold-timeline-lite',
				'support_url' => '',
				'changelog_url' => '',
				'shortcode' => 'bold_timeline',
				'product_id' => '',
				'plugin_file_path' => __FILE__
			)
		);

		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.0
		 */
		function bold_timeline_enqueue() {
			
			Bold_Timeline::$crush_vars_def = array( 
				'defaultLineColor', 
				'defaultItemBackgroundColor', 
				'defaultGroupColor', 
				'defaultFrameColor', 
				'defaultButtonColor', 
				'defaultIconColor', 
				'defaultConnectionColor', 
				'defaultStickerColor', 
				'defaultSliderNavigationColor', 
				'defaultMarkerColor' 
			);
			
			wp_enqueue_script( 'bold-timeline', plugins_url( 'assets/js/bold-timeline.js', __FILE__  ), array( 'jquery' ) );
			wp_enqueue_style( 'bold-timeline', plugins_url( 'style.css', __FILE__ ) );
			
			if ( function_exists( 'boldthemes_plugin_csscrush_file' ) ) {
				boldthemes_plugin_csscrush_file( plugin_dir_path( __FILE__ ) . 'style.crush.css', array( 'source_map' => true, 'minify' => false, 'output_file' => 'style', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ), plugin_dir_path( __FILE__ ) . 'css-override.php', 'Bold_Timeline' );
				
				boldthemes_plugin_csscrush_file( plugin_dir_path( __FILE__ ) . 'assets/scss/container.crush.scss', array( 'source_map' => true, 'minify' => false, 'output_dir' => '__no_dir_do_not_change', 'output_file' => '', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ), plugin_dir_path( __FILE__ ) . 'css-override-container.php', 'Bold_Timeline' );
				
				boldthemes_plugin_csscrush_file( plugin_dir_path( __FILE__ ) . 'assets/scss/group.crush.scss', array( 'source_map' => true, 'minify' => false, 'output_dir' => '__no_dir_do_not_change', 'output_file' => '', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ), plugin_dir_path( __FILE__ ) . 'css-override-group.php', 'Bold_Timeline' );
				
				boldthemes_plugin_csscrush_file( plugin_dir_path( __FILE__ ) . 'assets/scss/item.crush.scss', array( 'source_map' => true, 'minify' => false, 'output_dir' => '__no_dir_do_not_change', 'output_file' => '', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ), plugin_dir_path( __FILE__ ) . 'css-override-item.php', 'Bold_Timeline' );
				
				boldthemes_plugin_csscrush_file( plugin_dir_path( __FILE__ ) . 'assets/scss/slider.crush.scss', array( 'source_map' => true, 'minify' => false, 'output_dir' => '__no_dir_do_not_change', 'output_file' => '', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ), plugin_dir_path( __FILE__ ) . 'css-override-slider.php', 'Bold_Timeline' );
				
				boldthemes_plugin_csscrush_file( plugin_dir_path( __FILE__ ) . 'assets/scss/button.crush.scss', array( 'source_map' => true, 'minify' => false, 'output_dir' => '__no_dir_do_not_change', 'output_file' => '', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ), plugin_dir_path( __FILE__ ) . 'css-override-button.php', 'Bold_Timeline' );
			}

		}
		add_action( 'wp_enqueue_scripts', 'bold_timeline_enqueue' );

		// Update CSS within in Admin

		function bold_timeline_admin_style() {
			wp_enqueue_style( 'bold_timeline_admin_style', plugin_dir_url( __FILE__ ) . 'style-admin.css' );
		}

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'bold-timeline-edit' ) {
			add_action( 'admin_enqueue_scripts', 'bold_timeline_admin_style' );	
		}

		/**
		 * Load plugin textdomain.
		 *
		 * @since 1.0.0
		 */
		function bold_timeline_load_textdomain() {
			load_plugin_textdomain( 'bold-timeline', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
		}
		add_action( 'plugins_loaded', 'bold_timeline_load_textdomain' );

		$glob_match = glob( plugin_dir_path( __FILE__ ) . 'content_elements/*/*.php' );
		$elements = array();
		if ( $glob_match ) {
			foreach( $glob_match as $file ) {
				if ( preg_match( '/(\w+)\/\1.php$/', $file, $match ) ) {
					$elements[ $match[1] ] = $file;
				}
			}
		}

		foreach( $elements as $key => $value ) {
			require( $value );
		}

		/**
		 * Map shortcodes.
		 *
		 * @since 1.0.0
		 */

		if ( ! function_exists( 'bold_timeline_enqueue_google_font' ) ) {
			function bold_timeline_enqueue_google_font( $font, $subset ) {

				if ( ! in_array( $font, Bold_Timeline::$fonts_added ) ) {

					Bold_Timeline::$fonts_added[] = $font;

					$subset = preg_replace( '/\s+/', '', $subset );
					$subset_arr = explode( ',', $subset );

					Bold_Timeline::$font_subsets_added = Bold_Timeline::$font_subsets_added + $subset_arr;

					add_action( 'wp_footer', 'bold_timeline_enqueue_google_fonts' );

				}
			}
		}

		if ( ! function_exists( 'bold_timeline_enqueue_google_fonts' ) ) {
			function bold_timeline_enqueue_google_fonts() {

				if ( count( Bold_Timeline::$fonts_added ) > 0 ) {

					$font_families = array();

					foreach( Bold_Timeline::$fonts_added as $item ) {
						$font_families[] = urldecode( $item ) . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
					}

					$query_args = array(
						'family' => urlencode( implode( '|', $font_families ) ),
						'subset' => urlencode( implode( ',', Bold_Timeline::$font_subsets_added ) ),
					);

					$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
					wp_enqueue_style( 'bold-timeline-footer' );
					wp_enqueue_style( 'bold-timeline-google-fonts', $font_url, array(), '1.0.0' );

				}
			}
		}

		if ( ! function_exists( 'bold_timeline_js_head' ) ) {
			function bold_timeline_js_head() { ?>
				<script>
				// Select the node that will be observed for mutations
				const targetNode = document.documentElement;

				// Options for the observer (which mutations to observe)
				const config = { attributes: false, childList: true, subtree: true };
				
				var bold_timeline_item_button_done = false;
				var css_override_item_done = false;
				var css_override_group_done = false;
				var css_override_container_done = false;

				// Callback function to execute when mutations are observed
				const callback = function( mutationsList, observer ) {
					var i;
					for ( i = 0; i < mutationsList.length; i++ ) {
						if ( mutationsList[ i ].type === 'childList' ) {
							if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_item_button' ).length > 0 && ! bold_timeline_item_button_done ) {
								bold_timeline_item_button_done = true;
								jQuery( '.bold_timeline_item_button' ).each( function() {
									var css_override = jQuery( this ).data( 'css-override' );
									if ( css_override != '' ) {
										var id = jQuery( this ).attr( 'id' );
										css_override = css_override.replace( /(\.bold_timeline_item_button)([\.\{\s])/g, '.bold_timeline_item_button#' + id + '$2' );
										var head = document.getElementsByTagName( 'head' )[0];
										var style = document.createElement( 'style' );
										style.appendChild( document.createTextNode( css_override ) );
										head.appendChild( style );
									}
								});
							}
							if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_item' ).length > 0 && ! css_override_item_done ) {
								css_override_item_done = true;
								jQuery( '.bold_timeline_item' ).each( function() {
									var css_override = jQuery( this ).data( 'css-override' );
									if ( css_override != '' ) {
										var id = jQuery( this ).attr( 'id' );
										css_override = css_override.replace( /(\.bold_timeline_item)([\.\{\s])/g, '.bold_timeline_item#' + id + '$2' );
										var head = document.getElementsByTagName( 'head' )[0];
										var style = document.createElement( 'style' );
										style.appendChild( document.createTextNode( css_override ) );
										head.appendChild( style );
									}
								});
							}
							if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_group' ).length > 0 && ! css_override_group_done ) {
								css_override_group_done = true;
								jQuery( '.bold_timeline_group' ).each( function() {
									var css_override = jQuery( this ).data( 'css-override' );
									if ( css_override != '' ) {
										var id = jQuery( this ).attr( 'id' );
										css_override = css_override.replace( /(\.bold_timeline_group)([\.\{\s])/g, '.bold_timeline_group#' + id + '$2' );
										var head = document.getElementsByTagName( 'head' )[0];
										var style = document.createElement( 'style' );
										style.appendChild( document.createTextNode( css_override ) );
										head.appendChild( style );
									}
								});
							}
							if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_container' ).length > 0 && ! css_override_container_done ) {
								css_override_container_done = true;
								jQuery( '.bold_timeline_container' ).each( function() {
									var css_override = jQuery( this ).data( 'css-override' );
									if ( css_override != '' ) {
										var id = jQuery( this ).attr( 'id' );
										css_override = css_override.replace( /(\.bold_timeline_container)([\.\{\s])/g, '#' + id + '$2' );
										var head = document.getElementsByTagName( 'head' )[0];
										var style = document.createElement( 'style' );
										style.appendChild( document.createTextNode( css_override ) );
										head.appendChild( style );
									}
								});
							}
						}
					}
				};

				// Create an observer instance linked to the callback function
				const observer = new MutationObserver(callback);

				// Start observing the target node for configured mutations
				observer.observe(targetNode, config);

				// Later, you can stop observing
				document.addEventListener( 'DOMContentLoaded', function() { observer.disconnect(); }, false );

				</script>
			<?php }
		}
		add_action( 'wp_head', 'bold_timeline_js_head' );
	}
}