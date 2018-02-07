<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
	return;
}

wp_enqueue_script( 'wc-country-select' );

do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<p><a href="#!" class="shipping-calculator-button"><?php esc_html_e( 'Calculate', 'hypermarket' ); ?></a></p>

	<section class="shipping-calculator-form" style="display:none;">
		<div id="calc_shipping_country_field" class="form-element form-select">
			<select name="calc_shipping_country" id="calc_shipping_country" class="form-control country_to_state country_select" rel="calc_shipping_state">
				<option value=""><?php esc_html_e( 'Select a country&hellip;', 'hypermarket' ); ?></option>
				<?php
					foreach( WC()->countries->get_shipping_countries() as $key => $value )
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				?>
			</select>
		</div><!-- #calc_shipping_country_field -->

		<?php
			$current_cc = WC()->customer->get_shipping_country();
			$current_r  = WC()->customer->get_shipping_state();
			$states     = WC()->countries->get_states( $current_cc );

			// Hidden Input
			if ( is_array( $states ) && empty( $states ) ) {

				?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / county', 'hypermarket' ); ?>" /><?php

			// Dropdown Input
			} elseif ( is_array( $states ) ) {

				?><div id="calc_shipping_state_field" class="form-element form-select">
					<select name="calc_shipping_state state_select" id="calc_shipping_state" class="state_select form-control" placeholder="<?php esc_attr_e( 'State / county', 'hypermarket' ); ?>">
						<option value=""><?php esc_html_e( 'Select a state&hellip;', 'hypermarket' ); ?></option>
						<?php
							foreach ( $states as $ckey => $cvalue )
								echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
						?>
					</select>
				</div><!-- #calc_shipping_state_field -->
				<?php

			// Standard Input
			} else {

				?>
				<div id="calc_shipping_state_field" class="form-element">
					<input type="text" class="form-control input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / county', 'hypermarket' ); ?>" name="calc_shipping_state" id="calc_shipping_state" />
				</div><!-- #calc_shipping_state_field -->
				<?php

			}
		?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>
			<div id="calc_shipping_city_field" class="form-element">
				<input type="text" class="form-control input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City', 'hypermarket' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
			</div><!-- #calc_shipping_city_field -->

		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
			<div id="calc_shipping_postcode_field" class="form-element">
				<input type="text" class="form-control input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'hypermarket' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
			</div><!-- #calc_shipping_postcode_field -->

		<?php endif; ?>

		<p><button type="submit" name="calc_shipping" value="1" class="btn btn-default btn-block waves-effect waves-light button"><?php esc_html_e( 'Update Totals', 'hypermarket' ); ?></button></p>

		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>