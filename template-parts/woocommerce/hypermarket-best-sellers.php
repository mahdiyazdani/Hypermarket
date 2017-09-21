<?php
/**
 * Displaying best seller(s) products in homepage template file.
 *
 * @package 		Hooked into "hypermarket_homepage_template"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.9.0
 */
$args = apply_filters('hypermarket_best_sellers_products_args', array(
	'limit'   => 3,
	'columns' => 3,
	'title'	  => esc_attr__('Best Sellers', 'hypermarket')
) );
do_action('hypermarket_before_best_sellers');
?>
<!-- Bestsellers -->
<section id="hypermarket-best-sellers-products" class="container padding-top padding-bottom space-top space-bottom">
	<h3 class="text-center"><?php echo esc_html($args['title']); ?></h3>
	<div class="row padding-top">
	
	<?php
		echo hypermarket_do_shortcode('best_selling_products', array(
			'per_page' => intval($args['limit']),
			'columns'  => intval($args['columns']),
		) );
	?>

	</div><!-- .row -->
</section><!-- .container -->

<?php

do_action('hypermarket_after_best_sellers');