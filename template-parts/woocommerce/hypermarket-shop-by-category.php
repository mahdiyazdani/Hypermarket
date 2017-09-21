<?php
/**
 * Displaying product categorie(s) in homepage template file.
 *
 * @package 		Hooked into "hypermarket_homepage_template"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.9.0
 */
$args = apply_filters('hypermarket_shop_by_category_args', array(
	'parent'		=> 	0,
	'number' 		=> 	6,
	'show_count'   	=> 	1,
	'pad_counts'   	=> 	1,
	'hierarchical' 	=> 	0,
	'hide_empty'   	=> 	1,
	'orderby'      	=> 	'name',
	'taxonomy'     	=> 	'product_cat',
	'title'			=> 	__('Catalog', 'hypermarket')
));
$all_categories = get_categories($args);
if(! empty($all_categories)):
	// Get catalog image dimensions from WooCommerce settings
	$catalog_image_dimensions = get_option('shop_catalog_image_size');
	if(! empty($catalog_image_dimensions) ):
		$catalog_image_width = $catalog_image_dimensions['width'];
		$catalog_image_height = $catalog_image_dimensions['height'];
	endif;
?>
	<!-- Catalogs -->
	<section id="hypermarket-catalog" class="container-fluid padding-top padding-bottom space-top space-bottom" aria-label="<?php echo esc_attr($args['title']); ?>">
		<?php if (apply_filters('hypermarket_shop_by_category_title', false)): ?>
			<h3 class="text-center padding-bottom"><?php echo esc_attr($args['title']); ?></h3>
		<?php endif; ?>
		<div class="row">
			<?php 
			do_action('hypermarket_before_shop_by_category');
			$limit = absint($args['number']);
			$counter = 0;
			foreach ($all_categories as $category): 
				if ($counter < $limit):
					if (! apply_filters('hypermarket_shop_by_category_grid', false)):
				?>
					<div class="col-md-6" data-mh="mh-categories">
						<a href="<?php echo esc_url( get_term_link($category->slug, 'product_cat') ); ?>" class="category-tile" target="_self">
							<div class="inner">
								<div class="column">
									<h3 class="space-bottom-half"><?php echo esc_html($category->name); ?></h3>
									<p class="text-sm text-gray"><?php echo esc_html($category->category_description); ?></p>
								</div><!-- .column -->
								<div class="column">
									<div class="category-thumb">
										<?php
										$category_thumbnail = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
										if(! empty($category_thumbnail) ):
											echo wp_get_attachment_image($category_thumbnail, 'large');
										endif; 
										?>
									</div><!-- .category-thumb -->
								</div><!-- .column -->
							</div><!-- .inner -->
						</a><!-- .category-tile -->
					</div><!-- .col-md-6 -->
				<?php elseif (apply_filters('hypermarket_shop_by_category_grid', false)): ?>
					<div class="col-sm-3 col-xs-6" data-mh="mh-categories">
						<a href="<?php echo esc_url( get_term_link($category->slug, 'product_cat') ); ?>" class="category-link">
							 <?php
							 $category_thumbnail = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
							if(! empty($category_thumbnail) ):
								echo wp_get_attachment_image($category_thumbnail, 'large');
							endif;
						  	echo '&nbsp;' . esc_html($category->name); 
							?>
						</a><!-- .category-link -->
					</div><!-- .col-sm-3.col-xs-6 -->
				<?php
				else: 
					break;
				endif;
			endif;
			$counter++;
			endforeach; 
			woocommerce_reset_loop();
			wp_reset_postdata();
			do_action('hypermarket_after_shop_by_category');
			?>
		</div><!-- .row -->
	</section><!-- .container-fluid -->
<?php endif; ?>