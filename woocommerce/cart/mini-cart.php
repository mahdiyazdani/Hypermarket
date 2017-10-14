<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     	https://docs.woocommerce.com/document/template-structure/
 * @author  	WooThemes
 * @package 	WooCommerce/Templates
 * @version 	3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php do_action( 'woocommerce_before_mini_cart_contents' ); ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<div class="cart-item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<?php if ( ! $_product->is_visible() ) : ?>
							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>" class="item-thumb">
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							</a>
						<?php endif; ?>
						<?php echo WC()->cart->get_item_data( $cart_item ); ?>
						<div class="item-details">
						<h3 class="item-title"><a href="<?php echo esc_url( $product_permalink ); ?>" target="_self"><?php echo esc_html($product_name); ?></a></h3>
						<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<h4 class="item-price">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</h4>', $cart_item, $cart_item_key ); ?>
						</div><!-- .item-details -->
						<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="close-btn remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="material-icons close"></i></a>',
							esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
							__( 'Remove this item', 'hypermarket' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
						?>
					</div><!-- .cart-item -->
					<?php
				}
			}
		?>

		<?php do_action( 'woocommerce_mini_cart_contents' ); ?>

	<?php else : ?>

		<span class="empty"><small><em><?php esc_html_e( 'Most likely, you just have not put anything into your basket.', 'hypermarket' ); ?></em></small></span>

	<?php endif; ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<div class="cart-subtotal space-bottom">
		<div class="column">
			<?php if (! apply_filters('hypermarket_tilted_toolbar_minicart_style', false)): ?>
			<span>
				<?php esc_html_e( 'Subtotal', 'hypermarket' ); ?>:
			</span> 
			<?php else: ?>
			<h3 class="toolbar-title">
				<?php esc_html_e( 'Subtotal', 'hypermarket' ); ?>:
			</h3> 
			<?php endif; ?>
		</div><!-- .column -->
		<div class="column">
			<?php if (! apply_filters('hypermarket_tilted_toolbar_minicart_style', false)): ?>
			<?php echo WC()->cart->get_cart_subtotal(); ?>
			<?php else: ?>
			<h3 class="amount">
				<?php echo WC()->cart->get_cart_subtotal(); ?>
			</h3>
			<?php endif; ?>
		</div><!-- .column -->
	</div><!-- .cart-subtotal -->
	<div class="<?php echo (apply_filters('hypermarket_tilted_toolbar_minicart_style', false)) ? 'text-right' : 'text-center'; ?>">
		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn <?php echo (apply_filters('hypermarket_tilted_toolbar_minicart_style', false)) ? '' : 'btn-sm'; ?> btn-default btn-ghost waves-effect waves-light button wc-forward"><?php esc_html_e( 'View Cart', 'hypermarket' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn <?php echo (apply_filters('hypermarket_tilted_toolbar_minicart_style', false)) ? '' : 'btn-sm'; ?> btn-primary waves-effect waves-light button checkout wc-forward"><?php esc_html_e( 'Checkout', 'hypermarket' ); ?></a>
	</div><!-- .text-center -->
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>