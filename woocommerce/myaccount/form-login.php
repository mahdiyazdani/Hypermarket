<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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

<div class="<?php echo (apply_filters('hypermarket_tilted_toolbar_account_style', false)) ? '' : 'col-xs-12 space-bottom'; ?>">
	<?php wc_print_notices(); ?>
</div>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
	<?php if (! apply_filters('hypermarket_tilted_toolbar_account_style', false)): ?>
	<div class="col-md-5 padding-bottom">
		<h3><?php esc_html_e( 'Login', 'hypermarket' ); ?></h3>
		<?php else: ?>
		<h3 class="toolbar-title login-form-toolbar-title space-bottom"><?php esc_html_e('You are not logged in.', 'hypermarket'); ?></h3>
		<?php endif; ?>
		<form method="post" class="login-form login">
			<?php do_action( 'woocommerce_login_form_start' ); ?>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-element form-row-wide">
				<label for="username" class="sr-only"><?php esc_html_e( 'Username or email address', 'hypermarket' ); ?> <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="username" id="username" placeholder="<?php esc_attr_e( 'Username or email address*', 'hypermarket' ); ?>" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</p><!-- .form-element -->
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-element form-row-wide">
				<label for="password" class="sr-only"><?php esc_html_e( 'Password', 'hypermarket' ); ?> <span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text form-control input-text" type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password*', 'hypermarket' ); ?>" />
			</p><!-- .form-element -->
			<div class="clearfix"></div>
			<?php do_action( 'woocommerce_login_form' ); ?>
			<div class="form-footer form-element form-row">
				<div class="rememberme">
					<label for="rememberme" class="inline">
						<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'hypermarket' ); ?>
					</label>
				</div><!-- .rememberme -->
				<div class="form-submit">
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<input type="submit" class="woocommerce-Button button btn btn-primary btn-block space-top-none" name="login" value="<?php esc_attr_e( 'Login', 'hypermarket' ); ?>" />
				</div><!-- .form-submit -->
			</div><!-- .form-footer -->
			<div class="woocommerce-LostPassword lost_password">
				<p class="form-row">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'hypermarket' ); ?></a>
				</p>
			</div><!-- .lost_password -->
			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</form><!-- .login-form -->
	<?php if (! apply_filters('hypermarket_tilted_toolbar_account_style', false)): ?>
	</div><!-- .col-md-6 -->
	<?php elseif (apply_filters('hypermarket_tilted_toolbar_account_style', false) && get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes'): ?>
	<p class="text-sm space-top signup-form-notice"><?php esc_html_e('Don\'t have an account?', 'hypermarket'); ?> <a class="toggle-signup-form"><?php echo esc_html_e('Signup here', 'hypermarket'); ?></a></p>
	<?php endif; ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<?php if (! apply_filters('hypermarket_tilted_toolbar_account_style', false)): ?>
	<div class="col-md-6 col-md-offset-1">
		<h3><?php esc_html_e( 'Register', 'hypermarket' ); ?></h3>
		<?php else: ?>
		<h3 class="toolbar-title signup-form-toolbar-title space-bottom"><?php esc_html_e('Sign up, it\'s free.', 'hypermarket'); ?></h3>
		<?php endif; ?>
		<form method="post" class="login-form register">
			<?php do_action( 'woocommerce_register_form_start' ); ?>
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-element form-row-wide">
					<label for="reg_username" class="sr-only"><?php esc_html_e( 'Username', 'hypermarket' ); ?> <span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="username" id="reg_username" placeholder="<?php esc_attr_e( 'Username*', 'hypermarket' ); ?>" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p><!-- .form-element -->
			<?php endif; ?>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-element form-row-wide">
				<label for="reg_email" class="sr-only"><?php esc_html_e( 'Email address', 'hypermarket' ); ?> <span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="email" id="reg_email" placeholder="<?php esc_attr_e( 'Email address*', 'hypermarket' ); ?>" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</p><!-- .form-element -->
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-element form-row form-row-wide">
					<label for="reg_password" class="sr-only"><?php esc_html_e( 'Password', 'hypermarket' ); ?> <span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="password" id="reg_password" placeholder="<?php esc_attr_e( 'Password*', 'hypermarket' ); ?>" />
				</p><!-- .form-element -->
			<?php endif; ?>
			<div class="clearfix"></div>
			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>
			<div class="form-footer form-element form-row">
				<div class="rememberme"></div>
				<div class="form-submit">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<input type="submit" class="woocommerce-Button button btn btn-primary btn-block space-top-none" name="register" value="<?php esc_attr_e( 'Register', 'hypermarket' ); ?>" />
				</div><!-- .form-submit -->
			</div><!-- .form-footer -->
			<?php do_action( 'woocommerce_register_form_end' ); ?>
		</form>
	<?php if (! apply_filters('hypermarket_tilted_toolbar_account_style', false)): ?>
	</div><!-- .col-md-6 -->
	<?php else: ?>
	<p class="text-sm space-top login-form-notice"><?php esc_html_e('Already have an account?', 'hypermarket'); ?> <a class="toggle-login-form"><?php echo esc_html_e('Login here', 'hypermarket'); ?></a></p>
	<?php endif; ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>