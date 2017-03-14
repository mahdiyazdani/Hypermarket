<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

if ( ! $crosssells = WC()->cart->get_cross_sells() ) {
	return;
}

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => WC()->query->get_meta_query()
);

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'cross-sells';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>
	<!-- Cross sells -->
	<div class="clearfix"></div>
	<section class="col-xs-12 padding-top padding-bottom cross-sells">
		<hr>
		<h3 class="padding-top"><?php _e( 'You May be Interested in&hellip;', 'hypermarket' ) ?></h3>
		<div class="row padding-top">
			<?php 
				woocommerce_product_loop_start();
				// 4 Columns
				$GLOBALS['product_grid_classes'] = 'col-lg-3 col-sm-6';
				while ( $products->have_posts() ) : $products->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile; // end of the loop.
				woocommerce_product_loop_end(); 
			?>
		</div><!-- .row -->
	</section><!-- .col-xs-12 -->

<?php endif;

wp_reset_query();