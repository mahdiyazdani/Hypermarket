<?php
/**
 * Hypermarket Hooks.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.9.0
 */
/**
 * Before Header Area
 *
 * @see  hypermarket_skip_links()				-> template-functions.php
 * @since 1.0.4.2
 */
add_action('hypermarket_before_header_area', 'hypermarket_skip_links', 0);
/**
 * Header Area
 *
 * @see  hypermarket_header_wrapper_start()		 -> template-functions.php
 * @see  hypermarket_site_brand()				 -> template-functions.php
 * @see  hypermarket_primary_navigation()		 -> template-functions.php
 * @see  hypermarket_header_toolbar()			 -> template-functions.php
 * @see  hypermarket_header_wrapper_end()		 -> template-functions.php
 * @since 1.0.0
 */
add_action('hypermarket_header_area', 'hypermarket_header_wrapper_start', 2);
add_action('hypermarket_header_area', 'hypermarket_site_brand', 5);
add_action('hypermarket_header_area', 'hypermarket_primary_navigation', 10);
add_action('hypermarket_header_area', 'hypermarket_header_toolbar', 10);
add_action('hypermarket_header_area', 'hypermarket_header_wrapper_end', 12);
/**
 * Homepage Template
 *
 * @see  hypermarket_shop_by_category()			 -> template-functions.php
 * @see  hypermarket_best_sellers()				 -> template-functions.php
 * @see  hypermarket_new_arrivals()				 -> template-functions.php
 * @see  hypermarket_homepage_content()			 -> template-functions.php
 * @since 1.0.0
 */
add_action('hypermarket_homepage_template', 'hypermarket_shop_by_category', 10);
add_action('hypermarket_homepage_template', 'hypermarket_best_sellers', 20);
add_action('hypermarket_homepage_template', 'hypermarket_new_arrivals', 30);
add_action('hypermarket_homepage_template', 'hypermarket_homepage_content', 40);
/**
 * Footer Area
 *
 * @see  hypermarket_footer_wrapper_start()		 -> template-functions.php
 * @see  hypermarket_footer_widget_areas()		 -> template-functions.php
 * @see  hypermarket_footer_wrapper_end()		 -> template-functions.php
 * @since 1.0.0
 */
add_action('hypermarket_footer_area', 'hypermarket_footer_wrapper_start', 10);
add_action('hypermarket_footer_area', 'hypermarket_footer_widget_areas', 20);
add_action('hypermarket_footer_area', 'hypermarket_footer_wrapper_end', 30);
/**
 * Single page
 *
 * @see  hypermarket_featured_image_single_page()					 -> template-functions.php
 * @see  hypermarket_before_single_page_content_wrapper_start()		 -> template-functions.php
 * @see  hypermarket_single_page_paging()							 -> template-functions.php
 * @see  hypermarket_after_single_page_content_wrapper_end()		 -> template-functions.php
 * @since 1.0.9.0
 */
add_action('hypermarket_before_single_page', 'hypermarket_featured_image_single_page', 10);
add_action('hypermarket_before_single_page_content', 'hypermarket_before_single_page_content_wrapper_start', 20);
add_action('hypermarket_end_single_page_content', 'hypermarket_single_page_paging', 10);
add_action('hypermarket_after_single_page_content', 'hypermarket_after_single_page_content_wrapper_end', 30);
/**
 * Blog
 *
 * @see  hypermarket_loop_posts_header_image()		 -> template-functions.php
 * @see  hypermarket_post_meta()					 -> template-functions.php
 * @see  hypermarket_post_entry()					 -> template-functions.php
 * @see  hypermarket_paging_navigation()			 -> woocommerce-template-functions.php
 * @since 1.0.4
 */
add_action('hypermarket_before_loop_posts', 'hypermarket_loop_posts_header_image', 10);
add_action('hypermarket_loop_posts', 'hypermarket_post_meta', 10);
add_action('hypermarket_loop_posts', 'hypermarket_post_entry', 30);
add_action('hypermarket_loop_posts_paging_navigation', 'hypermarket_paging_navigation', 10);
/**
 * Single post
 *
 * @see  hypermarket_featured_image_single_page()		 -> template-functions.php
 * @see  hypermarket_single_post_paging()				 -> template-functions.php
 * @since 1.0.4
 */
add_action('hypermarket_before_single_post', 'hypermarket_featured_image_single_page', 10);
add_action('hypermarket_end_single_post_content', 'hypermarket_single_post_paging', 10);