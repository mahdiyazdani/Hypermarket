<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
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
	exit; // Exit if accessed directly
}
if(! is_singular('product')):

	// Check if current page template is "Fluid Template"?
	$fluid = '';
	if( get_post_field('page_template', get_option( 'woocommerce_shop_page_id' )) === 'page-templates/template-fluid.php'):
		$fluid = '-fluid';
	endif;
?>
	<!-- Shop Catalog -->
	<section class="container<?php echo esc_attr($fluid); ?> padding-top-3x">
	<?php if ( is_active_sidebar( 'sidebar' ) && ! is_singular() && apply_filters('hypermarket_toggle_wc_sidebar_filter_list', true) ) : ?>
		<!-- Sidebar Toggle / visible only on mobile -->
		<div class="sidebar-toggle sidebar-toggle-right">
			<i class="material-icons filter_list"></i>
		</div>
	<?php 
	endif;
else:
	?>
	<!-- Product Gallery -->
	<section class="fw-section bg-gray padding-top-3x">
	<?php
endif;