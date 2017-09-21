<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * @package 		Hooked into "woocommerce_no_products_found"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4.1
 */

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
?>
<div class="row padding-top">
	<div class="col-sm-12 padding-bottom-2x">
		<p><?php esc_html_e( 'It looks like no products were found matching your selection. Maybe try one of the links below or a search?',
					'hypermarket' ); ?></p>
		<?php the_widget('WC_Widget_Product_Search'); ?>
	</div><!-- .col-sm-12 -->			
</div><!-- .row -->
<?php 
$args = apply_filters('hypermarket_best_sellers_products_args', array(
	'limit'   => 3,
	'columns' => 3,
	'title'	  => esc_attr__('Best Sellers', 'hypermarket')
));
?>
<!-- Bestsellers -->
<section id="hypermarket-best-sellers-products" class="padding-top">
	<h3 class="text-center"><?php echo esc_html($args['title']); ?></h3>
	<div class="row padding-top">
	<?php
		echo hypermarket_do_shortcode( 'best_selling_products', array(
			'per_page' => intval($args['limit']),
			'columns'  => intval($args['columns']),
		) );
	?>
	</div><!-- .row -->
</section><!-- .container -->
<?php
$args = apply_filters('hypermarket_new_arrivals_products_args', array(
	'limit'   => 8,
	'columns' => 4,
	'title'	  => esc_attr__('New Arrivals', 'hypermarket')
));
?>
<!-- New Arrivals -->
<section id="hypermarket-new-arrivals-products" class="padding-top-3x space-top-half">
	<h3 class="text-center"><?php echo esc_html($args['title']); ?></h3>
	<div class="row padding-top">
	<?php
		// 4 Columns
		$GLOBALS['product_grid_classes'] = 'col-lg-3 col-sm-6';
		echo hypermarket_do_shortcode( 'recent_products', array(
			'per_page' => intval($args['limit']),
			'columns'  => intval($args['columns']),
		) );
	?>
	</div><!-- .row -->
</section><!-- .container -->