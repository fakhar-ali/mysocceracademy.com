<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 6.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dash = boldthemes_get_option( 'shop_use_dash' ) ? apply_filters( 'boldthemes_product_widget_headline_dash', 'bottom' ) : "";

global $product; ?>
<li>
	<div class="btImageTextWidget">
		<div class="btImageTextWidgetImage">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>" title="<?php echo esc_attr( $product->get_name() ); ?>">
				<?php echo wp_kses( $product->get_image(), 'wc_image' ); ?>
			</a>
		</div>
		<div class="btImageTextWidgetText">
			<?php

			$subheadline = '';
			if ( ! empty( $show_rating ) ) {
				$subheadline = wc_get_rating_html( $product->get_average_rating() );
			}

			echo wp_kses_post( boldthemes_get_heading_html( 
				array( 
					'headline' => $product->get_name(), 
					'subheadline' => $subheadline, 
					'size' => apply_filters( 'boldthemes_product_widget_headline_size', 'extrasmall' ), 
					'dash' => $dash,
					'url' => $product->get_permalink()
				)  
			) );
			
			?>
			<p class="posted"><?php echo wp_kses( $product->get_price_html(), 'wc_price' ); ?></p>
		</div> 
	</div> 
</li>