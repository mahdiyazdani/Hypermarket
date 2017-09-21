<?php
/**
 * Displaying header toolbar links.
 *
 * @package 	Hooked into "hypermarket_header_area"
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.4.1
 */
?>
<!-- Toolbar -->
<div class="toolbar">
    <div class="inner">
        <?php
            if(! hypermarket_is_woocommerce_activated()):
                echo '<a href="#" class="mobile-menu-toggle menu-text-right"><i class="material-icons menu"></i></a>';
            else:
                echo '<a href="#" class="mobile-menu-toggle"><i class="material-icons menu"></i></a>';
            endif;
        	// Append WooCommerce my-account page link
        	if (apply_filters('hypermarket_header_toolbar_myaccount', true) && hypermarket_is_woocommerce_activated() && get_option('users_can_register')):
        		echo '<a href="' . esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )) . '" target="_self"><i class="material-icons person"></i></a>';
        	endif;
            // Append WooCommerce Mini Cart
        	if (apply_filters('hypermarket_header_toolbar_mini_cart', true) && hypermarket_is_woocommerce_activated()):
            ?>
		        <div class="cart-btn">
	            	<?php do_action('hypermarket_items_present_in_cart'); ?>		
		            <!-- Cart Dropdown -->
		            <div class="cart-dropdown">
		            	<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
					</div>
		            <!-- .cart-dropdown -->
		        </div>
		        <!-- .cart-btn -->
    	<?php endif; ?>
    </div>
    <!-- .inner -->
</div>
<!-- .toolbar -->