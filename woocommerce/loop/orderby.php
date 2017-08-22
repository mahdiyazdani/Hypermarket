<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $orderby_options;
$orderby_options = $catalog_orderby_options;
?>
<div class="column<?php echo (apply_filters('hypermarket_toggle_wc_ordering', false)) ? ' hidden' : ''; ?>">
	<form class="woocommerce-ordering" method="get">
		<div class="form-element form-select space-bottom-none">
			<select name="orderby" class="orderby form-control">
				<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
					<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div><!-- .form-select -->
		<?php wc_query_string_form_fields( null, array( 'orderby', 'submit' ) ); ?>
	</form>
</div><!-- .column -->