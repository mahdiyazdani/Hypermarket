<?php
/**
 * Displaying New Arrivals(s) products in homepage template file.
 *
 * @package 		Hooked into "hypermarket_homepage_template"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4.2
 */
$args = apply_filters( 'hypermarket_new_arrivals_products_args', array(
	'limit'   => 8,
	'columns' => 4,
	'title'	  => esc_attr__( 'New Arrivals', 'hypermarket' )
) );
do_shortcode('hypermarket_before_new_arrivals');
?>
<!-- New Arrivals -->
<section id="hypermarket-new-arrivals-products" class="container padding-top-3x space-top-half">
	<h3 class="text-center"><?php echo esc_html($args['title']); ?></h3>
	<div class="row padding-top">
	
	<?php
		// 4 Columns
		$GLOBALS['product_grid_classes'] = 'col-lg-3 col-sm-6';
		echo hypermarket_do_shortcode( 'recent_products', array(
			'per_page' => intval( $args['limit'] ),
			'columns'  => intval( $args['columns'] ),
		) );
	?>

	</div><!-- .row -->
</section><!-- .container -->

<?php

do_shortcode('hypermarket_after_new_arrivals');