<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `hypermarket_homepage_template` action.
 * By default this includes a variety of product displays and the page content itself.
 *
 * Template name: 	Homepage
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.0
 *
 */
get_header();

/**
 * Functions hooked into "hypermarket_homepage_template" action
 *
 * @hooked hypermarket_shop_by_category            - 10
 * @hooked hypermarket_best_sellers				   - 20
 * @hooked hypermarket_new_arrivals         	   - 30
 * @hooked hypermarket_homepage_content            - 40
 *
 * @since 1.0.0
 */
do_action('hypermarket_homepage_template');

get_footer();