<?php
/**
 * Custom functions that act independently of the WooCommerce templates.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.2
 */
/**
 * Checks if the current page is an account page and user not logged-in.
 *
 * @since 1.0.2
 */
if (!function_exists('hypermarket_is_account_page_not_logged_in')):
    function hypermarket_is_account_page_not_logged_in()
    {
    	if (hypermarket_is_woocommerce_activated()):
        	return (is_account_page() && ! is_user_logged_in()) ? true : false;
    	endif;
    }
endif;