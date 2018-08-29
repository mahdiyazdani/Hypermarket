<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
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
 * @version 	3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}
?>
<!-- Coupon -->
<div class="col-sm-12 cart-coupon">
	<p class="text-gray text-sm"><?php esc_html_e('Have discount coupon?', 'hypermarket'); ?></p>
	<form class="checkout_coupon woocommerce-form-coupon" method="post">
		<div class="col-md-8 col-sm-7 coupon-input">
			<div class="form-element">
				<label class="screen-reader-text" for="coupon_code"><?php esc_html_e( 'Coupon:', 'hypermarket' ); ?></label>
				<input type="text" name="coupon_code" class="form-control input-text" placeholder="<?php esc_attr_e( 'Enter coupon code', 'hypermarket' ); ?>" id="coupon_code" value="" required="required" />
			</div>
		</div><!-- .coupon-input -->
		<div class="col-md-4 col-sm-5 coupon-btn">
			<button type="submit" class="button btn btn-default btn-ghost btn-block space-top-none space-bottom" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'hypermarket' ); ?>"><?php esc_html_e( 'Apply Coupon', 'hypermarket' ); ?></button>
		</div><!-- .coupon-btn -->
	</form><!-- .checkout_coupon -->
	<hr>
	<div class="clearfix"></div>
</div><!-- .cart-coupon -->