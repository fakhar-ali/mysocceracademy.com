<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version  6.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<?php do_action( 'woocommerce_before_mini_cart_all' ); ?>
<div class="btCartWidget btIconWidget<?php do_action( 'woocommerce_before_mini_cart_class' ); ?>">
	<span class="btCartWidgetIcon btIconWidgetIcon">
		<?php 
			echo wp_kses( boldthemes_get_icon_html( array( 'icon' => 'fa_f07a') ), 'wc_icon' );
		?>
		<span class="cart-contents" title="<?php echo esc_attr__( 'View your shopping cart', 'zele' ) ; ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	</span>
	<?php do_action( 'woocommerce_before_mini_cart' ); ?>
	<div class="btCartWidgetInnerContent btImageTextWidgetWrapper btIconWidgetContent">
		<div class="verticalMenuCartToggler"></div>
		<ul class="cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">

			<?php if ( ! WC()->cart->is_empty() ) : 
				
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
							<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
								<div class="ppRemove">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'zele' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
								</div>
								<div class="btImageTextWidget">
										<?php if ( $thumbnail != '' ) : ?>
										<div class="btImageTextWidgetImage">
											<?php if ( ! $_product->is_visible() ) : 
												echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . ''; 
											else : ?>
											<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
												<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . ''; ?>
											</a>
										<?php endif; ?>
										</div><!-- /btImageTextWidgetImage -->
										<?php endif; ?>
										<div class="btImageTextWidgetText">
										<?php echo wp_kses_post( boldthemes_get_heading_html( 
												array(
													'headline' => $product_name, 
													'subheadline' => apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ), 
													'size' => 'extrasmall'
												) 
											) );
										
                                                                                    echo wc_get_formatted_cart_item_data( $cart_item ); ?>
									</div><!-- /btImageTextWidgetText -->
								</div><!-- /btImageTextWidget -->
							</li>
							<?php
						}
					}
				

			else : ?>

				<li class="empty"><?php echo esc_html__( 'No products in the cart.', 'zele' ); ?></li>

			<?php endif; ?>

		</ul><!-- end product list -->

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<p class="total"><strong><?php echo esc_html__( 'Subtotal', 'zele' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php esc_html( _e( 'View Cart', 'zele' ) ); ?></a>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php esc_html( _e( 'Checkout', 'zele' ) ); ?></a>
		</p>

	<?php endif; ?>

	</div>
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
