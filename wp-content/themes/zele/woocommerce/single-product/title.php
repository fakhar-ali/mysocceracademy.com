<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    6.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$review_count = $product->get_review_count();
$rating_count = $product->get_rating_count();
$average      = $product->get_average_rating();

$subtitle = '';

if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

	if ( $rating_count > 0 ) {
		$subtitle = wc_get_rating_html( $product->get_average_rating() );
	}

}
	
if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {

	$sku = $product->get_sku() ? $product->get_sku() : esc_html__( 'N/A', 'zele' );
	$subtitle .= '<span class = "btProductSKU product_meta">' . esc_html__( 'SKU:', 'zele' ) . ' <span class="sku">' . $sku . '</span></span>'; 

}

$categories = wp_get_post_terms( $product->get_id(), 'product_cat' );
$supertitle = boldthemes_get_post_categories( array( 'categories' => $categories ) );

$dash = boldthemes_get_option( 'shop_use_dash' );
if ( $dash != '' ) {
	$dash = apply_filters( 'boldthemes_product_headline_dash', 'bottom' );
}


woocommerce_template_product_title( $supertitle, get_the_title(), $subtitle, $dash );