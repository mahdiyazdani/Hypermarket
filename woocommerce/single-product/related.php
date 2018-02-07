<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<!-- Related Products -->
	<section class="container padding-top">
		<hr>
		<h3 class="padding-top"><?php esc_html_e('Related Products', 'hypermarket'); ?></h3>
		<div class="row padding-top">
			<?php 
				woocommerce_product_loop_start();
				// 4 Columns
				$GLOBALS['product_grid_classes'] = 'col-lg-3 col-sm-6';
				foreach ( $related_products as $related_product ) :
					$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					wc_get_template_part('content', 'product');
				endforeach; // end of the loop.
				woocommerce_product_loop_end(); 
			?>
			</div><!-- .row -->
	</section><!-- .container -->

<?php endif;

wp_reset_postdata();