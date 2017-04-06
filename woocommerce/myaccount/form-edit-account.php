<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<fieldset>
		<legend><?php esc_html_e( 'Account Details', 'hypermarket' ); ?></legend>
		<div class="clearfix padding-bottom"></div>
		<p class="woocommerce-form-row woocommerce-form-row--first col-sm-6 form-element form-row form-row-first">
			<label for="account_first_name" class="sr-only"><?php esc_html_e( 'First name', 'hypermarket' ); ?> <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="account_first_name" id="account_first_name" placeholder="<?php esc_attr_e( 'First name*', 'hypermarket' ); ?>" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p><!-- .col-sm-6 -->
		<p class="woocommerce-form-row woocommerce-form-row--last col-sm-6 form-element form-row form-row-last">
			<label for="account_last_name" class="sr-only"><?php esc_html_e( 'Last name', 'hypermarket' ); ?> <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="account_last_name" id="account_last_name" placeholder="<?php esc_attr_e( 'Last name*', 'hypermarket' ); ?>" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p><!-- .col-sm-6 -->
		<div class="clearfix"></div>
		<p class="woocommerce-form-row woocommerce-form-row--wide col-sm-12 form-element form-row form-row-wide">
			<label for="account_email" class="sr-only"><?php esc_html_e( 'Email address', 'hypermarket' ); ?> <span class="required">*</span></label>
			<input type="email" class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_email" id="account_email" placeholder="<?php esc_attr_e( 'Email address*', 'hypermarket' ); ?>" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</p><!-- .col-sm-12 -->
	</fieldset>
	<div class="clearfix"></div>
	<fieldset class="space-top-2x space-bottom">
		<legend><?php esc_html_e( 'Password Change', 'hypermarket' ); ?></legend>
		<div class="clearfix padding-bottom"></div>
		<p class="woocommerce-form-row woocommerce-form-row--wide col-sm-12 form-element form-row form-row-wide">
			<label for="password_current" class="sr-only"><?php esc_html_e( 'Current Password (leave blank to leave unchanged)', 'hypermarket' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password form-control input-text" name="password_current" id="password_current" placeholder="<?php esc_attr_e( 'Current Password (leave blank to leave unchanged)', 'hypermarket' ); ?>" />
		</p><!-- .col-sm-12 -->
		<div class="clearfix"></div>
		<p class="woocommerce-form-row woocommerce-form-row--wide col-sm-6 form-element form-row form-row-wide">
			<label for="password_1" class="sr-only"><?php esc_html_e( 'New Password (leave blank to leave unchanged)', 'hypermarket' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password form-control input-text" name="password_1" id="password_1" placeholder="<?php esc_attr_e( 'New Password (leave blank to leave unchanged)', 'hypermarket' ); ?>" />
		</p><!-- .col-sm-6 -->
		<p class="woocommerce-form-row woocommerce-form-row--wide col-sm-6 form-element form-row form-row-wide">
			<label for="password_2" class="sr-only"><?php esc_html_e( 'Confirm New Password', 'hypermarket' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password form-control input-text" name="password_2" id="password_2" placeholder="<?php esc_attr_e( 'Confirm New Password', 'hypermarket' ); ?>" />
		</p><!-- .col-sm-6 -->
	</fieldset><!-- .space-top-2x space-bottom-2x -->
	<div class="clearfix"></div>
	<?php do_action( 'woocommerce_edit_account_form' ); ?>
	<p class="space-bottom-none">
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="woocommerce-Button button btn btn-primary space-top-none" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'hypermarket' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p><!-- .space-bottom-none -->
	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>
<?php do_action( 'woocommerce_after_edit_account_form' ); ?>