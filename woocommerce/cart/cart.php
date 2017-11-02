<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();
do_action( 'woocommerce_before_cart' ); ?>
<!-- Cart -->
<form class="col-sm-8 padding-bottom-2x woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
		<p class="text-sm">
			<span class="text-gray">
		    <?php 
		    	$cart_items = wp_kses_data(WC()->cart->get_cart_contents_count());
		    	printf(esc_html__('Currently %1$s %2$d item(s)', 'hypermarket'), '</span>', $cart_items); ?>
			<span class="text-gray"><?php esc_html_e('in cart', 'hypermarket'); ?></span>
		</p>
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<div class="shopping-cart">
			<?php 
				do_action( 'woocommerce_before_cart_contents' ); 
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
						<!-- Item -->
						<div class="item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<?php
		              		$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							if ( ! $product_permalink ):
								echo $thumbnail;
							else:
								printf( '<a href="%s" class="item-thumb product-thumbnail">%s</a>', esc_url( $product_permalink ), $thumbnail );
							endif;
	              		?>
		              		<div class="item-details">
								<h3 class="item-title">
									<?php
										if ( ! $product_permalink ):
											echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
										else:
											echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
										endif;
									?>
								</h3>
								<?php
								// Meta data
								echo WC()->cart->get_item_data( $cart_item );
								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo '<p class="backorder_notification"><small>' . esc_html__( 'Available on backorder', 'hypermarket' ) . '</small></p>';
								}
								?>
								<h4 class="item-price">
									<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
								</h4>
								<?php
									if ( $_product->is_sold_individually() ):
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									else:
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
											'min_value'   => '0',
										), $_product, false );
									endif;
									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
								?>
			          		</div>
			          		<div class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="item-remove remove pull-right" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="material-icons remove_shopping_cart"></i></a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
											__( 'Remove this item', 'hypermarket' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							</div>
						</div><!-- .item -->
			<?php
					endif;
            	endforeach;
        	?>

		</div><!-- .shopping-cart -->
		<?php do_action( 'woocommerce_cart_contents' ); ?>
		<?php if ( wc_coupons_enabled() ): ?>
			<!-- Coupon -->
			<div class="cart-coupon">
				<p class="text-gray text-sm"><?php esc_html_e('Have discount coupon?', 'hypermarket'); ?></p>
				<div class="col-md-8 col-sm-7 coupon-input">
					<div class="form-element">
						<label class="screen-reader-text" for="coupon_code"><?php esc_html_e( 'Coupon:', 'hypermarket' ); ?></label>
						<input type="text" name="coupon_code" class="form-control input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter coupon code', 'hypermarket' ); ?>" /> 
					</div>
				</div><!-- .coupon-input -->
				<div class="col-md-4 col-sm-5 coupon-btn">
					<input type="submit" class="button btn btn-default btn-ghost btn-block space-top-none space-bottom" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'hypermarket' ); ?>" />
				<?php do_action( 'woocommerce_cart_coupon' ); ?>
				</div><!-- .coupon-btn -->
			</div><!-- .cart-coupon -->
		<?php endif; ?>
		<input type="submit" class="button sr-only" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'hypermarket' ); ?>" />
		<?php 
			do_action( 'woocommerce_cart_actions' );
			wp_nonce_field( 'woocommerce-cart' ); 
			do_action( 'woocommerce_after_cart_contents' );
		?>
	</div><!-- .col-sm-8 -->
<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
<div class="<?php echo apply_filters('hypermarket_cart_checkout_order_details_offset', true) ? 'col-md-3 col-md-offset-1' : 'col-md-4'; ?> col-sm-4 padding-bottom-2x">
	<div class="cart-collaterals">
		<?php do_action( 'woocommerce_cart_collaterals' ); ?>
	</div>
</div><!-- .col-md-3 -->
<?php do_action( 'woocommerce_after_cart' ); ?>