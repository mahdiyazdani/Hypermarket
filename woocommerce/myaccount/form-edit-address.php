<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_title = ( 'billing' === $load_address ) ? __( 'Billing Address', 'hypermarket' ) : __( 'Shipping Address', 'hypermarket' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>
	<form method="post">
		<fieldset class="space-bottom">
			<legend><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></legend>
			<div class="clearfix padding-bottom"></div>
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
			<?php 
				foreach ( $address as $key => $field ) : 
					if ( isset( $field['country_field'], $address[ $field['country_field'] ] ) ):
						$field['country'] = wc_get_post_data_by_key( $field['country_field'], $address[ $field['country_field'] ]['value'] );
					endif;
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				?>
			<?php endforeach; ?>
		</fieldset>
		<div class="clearfix"></div>
		<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
		<p class="space-bottom-none">
			<input type="submit" class="button btn btn-primary space-top-none" name="save_address" value="<?php esc_attr_e( 'Save Address', 'hypermarket' ); ?>" />
			<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
			<input type="hidden" name="action" value="edit_address" />
		</p><!-- .space-bottom-none -->
	</form>
<?php endif; ?>
<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>