<?php

class bt_bb_single_product extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'product_id'        		=> '',
			'product_image'      		=> '',

			'product_title'        		=> '',
			'categories'				=> '',
			'product_price'      		=> '',
			'html_tag'      			=> 'h4',
			
			'hide_title'				=> '',
			'hide_price'				=> '',
			'product_description'		=> '',
			'hide_button'				=> '',
			'hide_description'			=> '',
			'dash'						=> '',
			'supertitle_color_scheme'	=> ''
		) ), $atts, $this->shortcode ) );

		if ( class_exists( 'WooCommerce' ) && $product_id != '' ) {
			$product = wc_get_product( $product_id );
		} else {
			$product = false;
		}
		$product_exists = ( $product != false ) ? true : false;

		$product_description = html_entity_decode( $product_description ) ;
		$product_description = nl2br( $product_description );
		$product_price = html_entity_decode( $product_price ) ;
		$product_price = nl2br( $product_price );
		
		$class = array( $this->shortcode, 'woocommerce' );

		if ( !$product_exists ) {
			$class[] = "btNoWooProduct";
		}

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}


		if ( $product_title == '' && $product_exists ) {
			$product_title = $product->get_title();
		}

		if ( $product_description == '' && $product_exists ) {
			$product_description = $product->get_short_description();
		}

		if ( $product_price == '' && $product_exists ) {
			$product_price = $product->get_price_html();
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}


		// PRODUCT IMAGE		
		if ( $product_image == '' ) {
			if ( $product_exists ) {
				$product_image = $product->get_image( 'boldthemes_medium_square' );	
			} else {
				$product_image = "";
			}
		} else {
			$post_image = get_post( $product_image );
			if ( $post_image == '' ) return;
		
			$image = wp_get_attachment_image_src( $product_image, "full" );
			$caption = $post_image->post_excerpt;
			
			$image = $image[0];
			if ( $caption == '' ) {
				$caption = $product_title;
			}
			$product_image = '<img src="' . esc_url_raw( $image ) . '" alt="' . esc_attr( $caption ) . '" title="' . esc_attr( $caption ) . '" >';
		}

		// CATEGORIES
		$product_categories = "";
		if ( $product_exists) {
			$product_categories_arr = get_the_terms( $product->get_id(), 'product_cat' );
			$product_categories = '';
			if ( !empty( $product_categories_arr ) && ( $categories == '' ) ) {
				$product_categories .= '<span class="btArticleCategories">';
				foreach ( $product_categories_arr as $key => $category ) {
					$product_categories .= '<a href="'.get_term_link( $category ).'" class="btProductCategory" >';
					$product_categories .= $category->name;
					$product_categories .= '</a>';
				}
				$product_categories .= "</span>";
			}
		}

		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		


		$output = '<div class="' . implode( ' ', $class ) . '"' . $style_attr . '' . $id_attr . '>';

			
			// IMAGE
			if ( $product_image != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_image' ) . '"><a href="' . get_permalink($product_id) . '" target="_self">' . $product_image . '</a></div>';

			
			// CONTENT
			$output .= '<div class="' . esc_attr( $this->shortcode . '_content' ) . '">';

				// TITLE
				if ( $hide_title == '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_title') . '">' .  do_shortcode('[bt_bb_headline headline="' . esc_attr( $product_title ) . '" superheadline="' . esc_attr( $product_categories ) . '" html_tag="'. esc_attr( $html_tag ) .'" dash="' . esc_attr( $dash ) . '" size="small" supertitle_color_scheme="' . esc_attr( $supertitle_color_scheme ) . '" url="' . get_permalink ( $product_id ) . '" target="_self" ]' ) . '</div>';

				// DESCRIPTION
				if ( $product_description != '' && $hide_description == '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_description' ) . '">' . $product_description . '</div>';

				if ( ( $product_price != '' ) && ( $hide_price == '' ) ) $output .= '<div class="' . esc_attr( $this->shortcode . '_price' ) . '">' . $product_price . '</div>';

				if ( $product_exists && ( $hide_button == '' )  ) {
					$output .= '<div class="' . esc_attr( $this->shortcode . '_button' ) . '">';
						$output .= do_shortcode( '[add_to_cart id="' . esc_attr( $product_id ) . '" style="" show_price="false"]' );
					$output .= '</div>';
				}

				
			$output .= '</div>';
		$output .= '</div>';


		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}


	function map_shortcode() {

		/* Get product list */
		if ( class_exists( 'WooCommerce' )  ) {
			$args = array(
				'limit' 		=> -1,
				'orderby' 		=> 'title',
				'order' 		=> 'ASC',
			);
			$query = new WC_Product_Query( $args );
			$products = $query->get_products();
			$products_arr = array();
			$products_arr[ 'Not selected' ] = 0;
			foreach($products as $product) {
				$products_arr[ $product->get_name() ] = $product->get_id();
			}
		} else {
			$products_arr = array();
		}

		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Single product', 'zele' ), 'description' => esc_html__( 'Single product', 'zele' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'product_id', 'type' => 'dropdown', 'heading' => esc_html__( 'Product', 'zele' ), 'description' => esc_html__( 'Choose WooCommerce product', 'zele' ), 'preview' => true, 'value' => $products_arr ),

				
				array( 'param_name' => 'categories', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'zele' ) => 'yes' ), 'default' => '', 'heading' => esc_html__( 'Hide categories', 'zele' ) ),
				array( 'param_name' => 'hide_title', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'zele' ) => 'yes' ), 'default' => '', 'heading' => esc_html__( 'Hide title', 'zele' ) ),
				array( 'param_name' => 'hide_price', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'zele' ) => 'yes' ), 'default' => '', 'heading' => esc_html__( 'Hide price', 'zele' ) ),
				array( 'param_name' => 'hide_button', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'zele' ) => 'yes' ), 'default' => '', 'heading' => esc_html__( 'Hide button', 'zele' ) ),
				array( 'param_name' => 'hide_description', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'zele' ) => 'yes' ), 'default' => '', 'heading' => esc_html__( 'Hide description', 'zele' ) ),

				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'default' => 'h4', 'heading' => esc_html__( 'HTML title tag', 'zele' ),
					'value' => array(
						esc_html__( 'h1', 'zele' ) 		=> 'h1',
						esc_html__( 'h2', 'zele' ) 		=> 'h2',
						esc_html__( 'h3', 'zele' ) 		=> 'h3',
						esc_html__( 'h4', 'zele' ) 		=> 'h4',
						esc_html__( 'h5', 'zele' ) 		=> 'h5',
						esc_html__( 'h6', 'zele' ) 		=> 'h6'
				) ),

				

				
				array( 'param_name' => 'product_image', 'type' => 'attach_image', 'group' => esc_html__( 'Override', 'zele' ), 'heading' => esc_html__( 'Custom product image', 'zele' ) ),
				array( 'param_name' => 'product_title', 'type' => 'textarea', 'heading' => esc_html__( 'Custom product title', 'zele' ), 'group' => esc_html__( 'Override', 'zele' ), 'description' => esc_html__( 'Type custom product title to override or leave blank to display default title', 'zele' ) ),
				
				array( 'param_name' => 'product_price', 'type' => 'textfield', 'description' => esc_html__( 'Type custom product price to override or leave blank to display default price', 'zele' ), 'group' => esc_html__( 'Override', 'zele' ), 'heading' => esc_html__( 'Custom product price', 'zele' ) ),
				
				array( 'param_name' => 'product_description', 'type' => 'textarea', 'description' => esc_html__( 'Type custom product description to override or leave blank to display default description', 'zele' ), 'group' => esc_html__( 'Override', 'zele' ), 'heading' => esc_html__( 'Custom product description', 'zele' ) ),
				
				array( 'param_name' => 'dash', 'type' => 'dropdown', 'heading' => esc_html__( 'Title dash', 'zele' ), 
					'value' => array(
						esc_html__( 'None', 'zele' ) 			=> 'none',
						esc_html__( 'Top', 'zele' ) 				=> 'top',
						esc_html__( 'Bottom', 'zele' ) 			=> 'bottom',
						esc_html__( 'Top and bottom', 'zele' ) 	=> 'top_bottom'
					)
				),
				array( 'param_name' => 'supertitle_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Supertitle color scheme (for top dash)', 'zele' ), 'value' => $color_scheme_arr )
			)
		) );
	}
}