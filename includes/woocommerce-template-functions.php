<?php
/**
 * Hypermarket WooCommerce Template Functions.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.3.5
 */
// ======================================================================
// Hooked into "wp"
// ======================================================================

/**
 * Remove Sidebar on all the Single Product Pages.
 *
 * @package Hooked into "wp"
 * @since 1.0.2
 */
function hypermarket_remove_sidebar_shop()
{
	if (hypermarket_is_woocommerce_activated() && is_singular('product')):
		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
	endif;
}
// ======================================================================
// Hooked into "hypermarket_items_present_in_cart"
// ======================================================================

/**
 * Ensure cart contents update when products are added to the cart via AJAX.
 *
 * @package Hooked into "hypermarket_items_present_in_cart"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_cart_link_fragment')):
	function hypermarket_cart_link_fragment($fragments)
	{
		if (hypermarket_is_woocommerce_activated()):
			global $woocommerce;
			ob_start();
			hypermarket_cart_link();
			$fragments['a.cart-items'] = ob_get_clean();
			return $fragments;
		endif;
	}
endif;
/**
 * Displayed a link to the cart including the number of items present.
 *
 * @package Hooked into "hypermarket_items_present_in_cart"
 * @since 1.1.0
 */
if (!function_exists('hypermarket_cart_link')):
	function hypermarket_cart_link()
	{
		if (hypermarket_is_woocommerce_activated()):
		?>
			<a class="cart-items <?php echo (apply_filters('hypermarket_toolbar_toggle_cls', false)) ? 'toolbar-toggle' : ''; ?>" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" target="_self">
	            <i>
	            	<span class="material-icons shopping_basket"></span>
	        		<?php
						// Number of items present and the cart total
						$cart_items = wp_kses_data(WC()->cart->get_cart_contents_count());
						echo ($cart_items != 0) ? '<span class="count">' . intval($cart_items) . '</span>' : '';
					?>
	            </i>
	        </a><!-- .cart-items -->
		<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_main_content"
// ======================================================================

/**
 * Shop page featured image.
 *
 * @package Hooked into "woocommerce_before_main_content"
 * @since 1.0.6
 */
if (!function_exists('hypermarket_shop_featured_image')):
	function hypermarket_shop_featured_image()
	{
		if (hypermarket_is_woocommerce_activated() && is_shop()):
			$get_shop_page_featured_image_url = get_the_post_thumbnail_url(get_option('woocommerce_shop_page_id'));
			if (!empty($get_shop_page_featured_image_url)):
				get_template_part('template-parts/hypermarket-featured-image-single-page');
			endif;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_shop_loop_item"
// ======================================================================

/**
 * Shop thumbnail wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop_item"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_thumbnail_wrapper_start')):
	function hypermarket_shop_thumbnail_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<div class="shop-thumbnail">
			<?php
		endif;
	}
endif;
/**
 * Display sale badge on product archive page(s) only.
 *
 * @package Hooked into "woocommerce_before_shop_loop_item"
 * @since 1.3.5
 */
if (!function_exists('hypermarket_show_product_loop_sale_flash')):
	function hypermarket_show_product_loop_sale_flash(){
		if (hypermarket_is_woocommerce_activated()):
			global $post, $product;
			if ($product->is_on_sale()):
				echo apply_filters('hypermarket_show_product_loop_sale_flash_markup', '<span class="shop-label text-danger onsale">' . esc_html__('Sale', 'hypermarket') . '</span>', $post, $product);
			endif;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_shop_loop_item_title"
// ======================================================================

/**
 * Shop tools (Button(s)) wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop_item_title"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_item_tools_wrapper_start')):
	function hypermarket_shop_item_tools_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<div class="shop-item-tools">
			<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_after_shop_loop_item"
// ======================================================================

/**
 * Shop tools (Button(s)) and thumbnail wrapper end tag(s).
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_thumbnail_item_tools_wrapper_end')):
	function hypermarket_shop_thumbnail_item_tools_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</div><!-- .shop-item-tools -->
			</div><!-- .shop-thumbnail -->
			<?php
		endif;
	}
endif;
/**
 * Shop item details wrapper start tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_item_details_wrapper_start')):
	function hypermarket_shop_item_details_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<div class="shop-item-details">
			<?php
		endif;
	}
endif;
/**
 * Shop item title wrapped with product URL.
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0.4.2
 */
if (!function_exists('hypermarket_template_loop_product_title')):
	function hypermarket_template_loop_product_title()
	{
		if (hypermarket_is_woocommerce_activated()):
			global $product;
			echo '<h3 class="shop-item-title"><a href="' . esc_url(get_permalink($product->get_id())) . '" target="_self">' . esc_html(get_the_title()) . '</a></h3><!-- .shop-item-title -->';
		endif;
	}
endif;
/**
 * Shop item price(s).
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0.4.2
 */
if (!function_exists('hypermarket_template_loop_price')):
	function hypermarket_template_loop_price()
	{
		if (hypermarket_is_woocommerce_activated()):
			global $product;
			if ($price_html = $product->get_price_html()):
				echo '<span class="shop-item-price">';
					echo wp_kses($price_html, array(
						'a' => array(
							'id' => array() ,
							'href' => array() ,
							'title' => array() ,
							'class' => array()
						) ,
						'span' => array(
							'id' => array() ,
							'class' => array()
						),
						'del' => array(
							'id' => array() ,
							'class' => array()
						),
						'ins' => array(
							'id' => array() ,
							'class' => array()
						)
					));
				echo '</span>'; 
 			endif;
		endif;
	}
endif;
/**
 * Shop item details wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_item_details_wrapper_end')):
	function hypermarket_shop_item_details_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</div><!-- .shop-item-details -->
			<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_shop_loop"
// ======================================================================

/**
 * Shop wrapper start tag(s) before main loop.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_woocommerce_before_shop_loop')):
	function hypermarket_woocommerce_before_shop_loop()
	{
		if (hypermarket_is_woocommerce_activated()):
			if (is_active_sidebar('sidebar')):
				?>
				<div class="row padding-top">
				<!-- Products Grid -->
				<div class="col-md-9 col-sm-8">
				<?php
			else:
				?>
				<!-- Products Grid -->
				<?php
				// 4 Columns
				$GLOBALS['product_grid_classes'] = 'col-lg-3 col-md-4 col-sm-6 without-sidebar';
				$hypermarket_woocommerce_loop_columns = 4;
				add_filter('hypermarket_woocommerce_loop_columns', function ($arg) use($hypermarket_woocommerce_loop_columns)
				{
					return $hypermarket_woocommerce_loop_columns;
				});
			endif;
		endif;
	}
endif;
/**
 * Shop bar wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_bar_wrapper_start')):
	function hypermarket_shop_bar_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<!-- Shop Bar -->
			<div class="shop-bar">
			<?php
		endif;
	}
endif;
/**
 * Shop bar wrapper end tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_bar_wrapper_end')):
	function hypermarket_shop_bar_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</div><!-- .shop-bar -->
			<?php
		endif;
	}
endif;
/**
 * Main shop wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_shop_product_subcategories')):
	function hypermarket_shop_product_subcategories()
	{
		if (hypermarket_is_woocommerce_activated()):
			$args = apply_filters('hypermarket_shop_product_subcategories_args', array(
				'before' => '<div class="hypermarket-category-wrapper row padding-top padding-bottom-3x">',
				'after' => '</div><!-- .hypermarket-category-wrapper -->',
				'force_display' => true
			));
			woocommerce_product_subcategories($args);
			woocommerce_reset_loop();
		endif;
	}
endif;
/**
 * Main shop wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.1.1
 */
if (!function_exists('hypermarket_shop_loop_wrapper_start')):
	function hypermarket_shop_loop_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<div class="row hypermarket-woocommerce-loop">
			<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_after_shop_loop"
// ======================================================================

/**
 * Main shop wrapper start tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_loop_wrapper_end')):
	function hypermarket_shop_loop_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</div><!-- .row -->
			<hr>
			<?php
		endif;
	}
endif;
/**
 * Main shop wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_woocommerce_after_shop_loop')):
	function hypermarket_woocommerce_after_shop_loop()
	{
		if (hypermarket_is_woocommerce_activated()):
			if (is_active_sidebar('sidebar')):
				?>
				</div><!-- .col-md-9 col-sm-8 -->
				<?php
			endif;
		endif;
	}
endif;
/**
 * Shop catalog wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_shop_catalog_wrapper_end')):
	function hypermarket_shop_catalog_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</section><!-- .container -->
			<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_subcategory"
// ======================================================================

/**
 * Add "category-link" class name to category link.
 *
 * @package Hooked into "woocommerce_before_subcategory"
 * @since 1.0.4.1
 */
if (!function_exists('hypermarket_loop_category_link_open')):
	function hypermarket_loop_category_link_open($category)
	{
		echo '<a href="' . esc_url(get_term_link($category, 'product_cat')) . '" class="category-link">';
	}
endif;
// ======================================================================
// Hooked into "subcategory_archive_thumbnail_size"
// ======================================================================

/**
 * Subcategory thumbnails size.
 *
 * @package Hooked into "subcategory_archive_thumbnail_size"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_subcategory_archive_thumbnail_size')):
	function hypermarket_subcategory_archive_thumbnail_size()
	{
		return 'full';
	}
endif;
// ======================================================================
// Hooked into "woocommerce_shop_loop_subcategory_title"
// ======================================================================

/**
 * Show the subcategory title in the product loop.
 *
 * @package Hooked into "woocommerce_shop_loop_subcategory_title"
 * @since 1.0.4.1
 */
if (!function_exists('hypermarket_template_loop_subcategory_title')):
	function hypermarket_template_loop_subcategory_title($category)
	{
		echo esc_html($category->name);
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_single_product"
// ======================================================================

/**
 * Navigation to next/previous set of products.
 *
 * @package Hooked into "woocommerce_before_single_product"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_product_paging_navigation')):
	function hypermarket_product_paging_navigation()
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-product-paging-navigation');
		endif;
	}
endif;
/**
 * WooCommerce notice wrapper start tag(s).
 *
 * @package Hooked into "woocommerce_before_single_product"
 * @since 1.0.2
 */
if (!function_exists('hypermarket_product_notice_wrapper_start')):
	function hypermarket_product_notice_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<div id="hypermarket-single-product-notice" class="container">
			<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<?php
		endif;
	}
endif;
/**
 * WooCommerce notice wrapper end tag(s).
 *
 * @package Hooked into "woocommerce_before_single_product"
 * @since 1.0.2
 */
if (!function_exists('hypermarket_product_notice_wrapper_end')):
	function hypermarket_product_notice_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</div><!-- .col-md-8 -->
			</div><!-- .row -->
			</div><!-- #hypermarket-single-product-notice -->
			<?php
		endif;
	}
endif;
/**
 * Single product image and thumbnails.
 *
 * @package Hooked into "woocommerce_before_single_product_summary"
 * @since 1.0.4.2
 */
if (!function_exists('hypermarket_show_product_images')):
	function hypermarket_show_product_images()
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-single-product-gallery');
		endif;
	}
endif;
/**
 * Product info wrapper start tag.
 *
 * @package Hooked into "woocommerce_single_product_summary"
 * @since 1.0.4.2
 */
if (!function_exists('hypermarket_single_product_summary_wrapper_start')):
	function hypermarket_single_product_summary_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<!-- Product Info -->
			<div class="product-info padding-top-2x padding-bottom-3x text-center">
			<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_single_product_summary"
// ======================================================================

/**
 * Product tools wrapper start tag.
 *
 * @package Hooked into "woocommerce_single_product_summary"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_single_add_to_cart_wrapper_start')):
	function hypermarket_single_add_to_cart_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<div class="product-tools shop-item">
			<?php
		endif;
	}
endif;
/**
 * Product tools wrapper end tag.
 *
 * @package Hooked into "woocommerce_single_product_summary"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_single_add_to_cart_wrapper_end')):
	function hypermarket_single_add_to_cart_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</div><!-- .product-tools -->
			<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_after_single_product_summary"
// ======================================================================

/**
 * Product info and main section wrapper end tag(s).
 *
 * @package Hooked into "woocommerce_after_single_product_summary"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_single_product_summary_wrapper_end')):
	function hypermarket_single_product_summary_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</div><!-- .product-info -->
			</div><!-- .container -->
			</section><!-- .fw-section.bg-gray -->
			<?php
		endif;
	}
endif;
/**
 * Product tabs wrapper start tag.
 *
 * @package Hooked into "woocommerce_after_single_product_summary"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_output_product_data_tabs_wrapper_start')):
	function hypermarket_output_product_data_tabs_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			<!-- Product Tabs -->
			<section class="container padding-top-2x">
			<?php
		endif;
	}
endif;
/**
 * Single product main wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_single_product_summary"
 * @since 1.0.0
 */
if (!function_exists('hypermarket_output_product_data_tabs_wrapper_end')):
	function hypermarket_output_product_data_tabs_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			?>
			</section><!-- .container -->
			<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "gettext"
// ======================================================================

/**
 * Update remove text to material icon in cart and checkout pages.
 *
 * @package Hooked into "gettext"
 * @since 1.0.5
 */
if (!function_exists('hypermarket_change_remove_text')):
	function hypermarket_update_remove_text($translated_text, $text, $domain)
	{
		if (hypermarket_is_woocommerce_activated() && (is_cart() || is_checkout())):
			switch ($translated_text):
				case esc_attr('[Remove]'):
					$translated_text = wp_kses_post('<i class="material-icons close"></i>');
					break;
			endswitch;
		endif;
		return $translated_text;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_review_order_before_submit"
// ======================================================================

/**
 * Back to cart button.
 *
 * @package Hooked into "woocommerce_review_order_before_submit"
 * @since 1.0.4.1
 */
if (!function_exists('hypermarket_back_to_cart_btn_before_submit')):
	function hypermarket_back_to_cart_btn_before_submit()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<a href="' . esc_url(WC()->cart->get_cart_url()) . '" class="btn btn-default btn-ghost icon-left btn-block waves-effect waves-light" target="_self">';
			echo '<i class="material-icons arrow_back"></i>';
			esc_html_e('Back To Cart', 'hypermarket');
			echo '</a><!-- .btn -->';
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_no_products_found"
// ======================================================================

/**
 * No products are found matching the current query.
 *
 * @package Hooked into "woocommerce_no_products_found"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_no_products_found')):
	function hypermarket_no_products_found()
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-no-products-found');
		endif;
	}
endif;