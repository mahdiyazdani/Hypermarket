<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="col-xs-12 space-bottom">
	<?php wc_print_notices(); ?>
</div>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">
	<p class="col-sm-12 reset-password-notice"><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Enter your username or email address. You will receive a link to create a new password via email.', 'hypermarket' ) ); ?></p>
	<p class="woocommerce-form-row woocommerce-form-row--first form-row col-sm-6 form-element form-row-first">
		<label for="user_login" class="sr-only"><?php esc_html_e( 'Username or email', 'hypermarket' ); ?></label>
		<input class="woocommerce-Input woocommerce-Input--text form-control input-text" type="text" name="user_login" id="user_login" placeholder="<?php esc_attr_e( 'Username or email*', 'hypermarket' ); ?>" />
	</p><!-- .col-sm-6 -->
	<p class="woocommerce-form-row woocommerce-form-row--first form-row col-sm-6 form-element form-row-first"></p>
	<div class="clearfix"></div>
	<?php do_action( 'woocommerce_lostpassword_form' ); ?>
	<p class="woocommerce-FormRow col-sm-12 form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<input type="submit" class="woocommerce-Button button btn btn-primary space-top-none" value="<?php esc_attr_e( 'Reset Password', 'hypermarket' ); ?>" />
	</p><!-- .col-sm-12 -->
	<?php wp_nonce_field( 'lost_password' ); ?>
</form><!-- .lost_reset_password -->