<?php
/**
 * Displaying New Arrivals(s) products in homepage template file.
 *
 * @package 		Hooked into "hypermarket_homepage_template"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.9.0
 */
$args = apply_filters( 'hypermarket_new_arrivals_products_args', array(
	'limit'   => 8,
	'columns' => 4,
	'title'	  => esc_attr__( 'New Arrivals', 'hypermarket' )
) );
do_action('hypermarket_before_new_arrivals');
?>
<!-- New Arrivals -->
<section id="hypermarket-new-arrivals-products" class="<?php echo apply_filters('hypermarket_new_arrivals_container', 'container'); ?> padding-top padding-bottom space-top space-bottom">
	<?php if (apply_filters('hypermarket_new_arrivals_title', true)): ?>
		<h3 class="text-center"><?php echo esc_html($args['title']); ?></h3>
	<?php endif; ?>
	<div class="row padding-top">
	
	<?php
		// 4 Columns
		$GLOBALS['product_grid_classes'] = 'col-lg-3 col-sm-6';
		do_action('hypermarket_new_arrivals_before_loop');
		if (apply_filters('hypermarket_new_arrivals_display_default', true)):
			echo hypermarket_do_shortcode( 'recent_products', array(
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			) );
		endif;
		do_action('hypermarket_new_arrivals_after_loop');
	?>

	</div><!-- .row -->
</section><!-- .container -->

<?php

do_action('hypermarket_after_new_arrivals');