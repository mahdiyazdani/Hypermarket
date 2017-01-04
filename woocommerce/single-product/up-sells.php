<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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

if ( ! $upsells = $product->get_upsells() ) {
	return;
}

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => WC()->query->get_meta_query()
);

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'up-sells';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_up_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<!-- UpSells -->
	<section class="container padding-top padding-bottom up-sells upsells products">
		<hr>
		<h3 class="padding-top"><?php _e( 'You May Also Like&hellip;', 'hypermarket' ) ?></h3>
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
	</section><!-- .container -->

<?php endif;

wp_reset_postdata();