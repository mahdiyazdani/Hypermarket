<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
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
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="woocomerce-form woocommerce-form-login login-form login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
	<?php do_action( 'woocommerce_login_form_start' ); ?>
	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
	<p class="form-row col-sm-6 form-element form-row-first">
		<label for="username" class="sr-only"><?php esc_html_e( 'Username or email', 'hypermarket' ); ?> <span class="required">*</span></label>
		<input type="text" class="form-control input-text" name="username" id="username" placeholder="<?php esc_attr( 'Username or email', 'hypermarket' ); ?>" />
	</p><!-- .form-element -->
	<p class="form-row col-sm-6 form-element form-row-last">
		<label for="password" class="sr-only"><?php esc_html_e( 'Password', 'hypermarket' ); ?> <span class="required">*</span></label>
		<input class="form-control input-text" type="password" name="password" id="password" placeholder="<?php esc_attr( 'Password', 'hypermarket' ); ?>" />
	</p><!-- .form-element -->
	<div class="clearfix"></div>
	<?php do_action( 'woocommerce_login_form' ); ?>
	<div class="form-footer col-sm-12 form-element form-row">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<div class="rememberme">
			<label for="rememberme" class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
				<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'hypermarket' ); ?>
			</label>
		</div><!-- .rememberme -->
		<div class="form-submit">
			<input type="submit" class="button btn btn-primary btn-block" name="login" value="<?php esc_attr_e( 'Login', 'hypermarket' ); ?>" />
		</div><!-- .form-submit -->
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
	</div><!-- .form-footer -->
	<div class="col-sm-12 lost_password space-bottom">
		<p class="form-row">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'hypermarket' ); ?></a>
		</p>
	</div><!-- .lost_password -->
	<div class="clearfix"></div>
	<?php do_action( 'woocommerce_login_form_end' ); ?>
</form>