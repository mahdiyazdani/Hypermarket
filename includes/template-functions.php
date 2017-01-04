<?php
/**
 * Hypermarket Template Functions.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0
 */
// ======================================================================
// Hooked into "hypermarket_before_header_area"
// ======================================================================

/**
 * Skip links.
 *
 * @package Hooked into "hypermarket_before_header_area"
 * @since 1.0
 */
if (!function_exists('hypermarket_skip_links')):
	function hypermarket_skip_links()
	{
		get_template_part('template-parts/hypermarket-skip-links');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_header_area"
// ======================================================================

/**
 * Header wrapper start tag(s).
 *
 * @package Hooked into "hypermarket_header_area"
 * @since 1.0
 */
if (!function_exists('hypermarket_header_wrapper_start')):
	function hypermarket_header_wrapper_start()
	{
		echo '<!-- Navbar -->' . PHP_EOL;
		echo '<header id="hypermarket-header" class="navbar">' . PHP_EOL;
	}
endif;
/**
 * Site brand/logo
 *
 * @package Hooked into "hypermarket_header_area"
 * @since 0.1
 */
if (!function_exists('hypermarket_site_brand')):
	function hypermarket_site_brand()
	{
		if (function_exists('the_custom_logo') && has_custom_logo()):
			$logo = get_custom_logo();
			echo $logo;
		elseif (function_exists('jetpack_has_site_logo') && jetpack_has_site_logo()):
			jetpack_the_site_logo();
		else:
			echo '<a id="site-logo-visible-desktop" href="' . esc_url(home_url('/')) . '" class="site-logo visible-desktop" rel="home">' . esc_attr(get_bloginfo('name')) . '</a><!-- site-logo.visible-desktop -->' . PHP_EOL;
			echo '<a id="site-logo-visible-mobile" href="' . esc_url(home_url('/')) . '" class="site-logo visible-mobile" rel="home">' . esc_attr(get_theme_mod('hypermarket_mobile_blogname')) . '</a><!-- site-logo.visible-mobile -->' . PHP_EOL;
		endif;
	}
endif;
/**
 * Primary Navigation.
 *
 * @package Hooked into "hypermarket_header_area"
 * @since 0.1
 */
if (!function_exists('hypermarket_primary_navigation')):
	function hypermarket_primary_navigation()
	{
		wp_nav_menu(array(
			'depth' => 2,
			'container' => 'nav',
			'container_class' => 'main-navigation text-center',
			'menu_id' => 'hypermarket-main-navigation',
			'theme_location' => HypermarketPrimaryNavLocation,
			'fallback_cb' => 'Hypermarket_Bootstrap_Navwalker::fallback',
			'walker' => new Hypermarket_Bootstrap_Navwalker()
		));
	}
endif;
/**
 * Header Toolbar.
 *
 * @package Hooked into "hypermarket_header_area"
 * @since 0.1
 */
if (!function_exists('hypermarket_header_toolbar')):
	function hypermarket_header_toolbar()
	{
		get_template_part('template-parts/hypermarket-header-toolbar');
	}
endif;
/**
 * Header wrapper end tag(s).
 *
 * @package Hooked into "hypermarket_header_area"
 * @since 1.0
 */
if (!function_exists('hypermarket_header_wrapper_end')):
	function hypermarket_header_wrapper_end()
	{
		echo '</header>' . PHP_EOL;
		echo '<!-- .navbar -->' . PHP_EOL;
	}
endif;
// ======================================================================
// Hooked into "hypermarket_homepage_template"
// ======================================================================

/**
 * Product Categorie(s).
 *
 * @package Hooked into "hypermarket_homepage_template"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_by_category'))
{
	function hypermarket_shop_by_category($args)
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-shop-by-category');
		endif;
	}
}
/**
 * Best Seller(s).
 *
 * @package Hooked into "hypermarket_homepage_template"
 * @since 1.0
 */
if (!function_exists('hypermarket_best_sellers'))
{
	function hypermarket_best_sellers($args)
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-best-sellers');
		endif;
	}
}
/**
 * Recent Product(s).
 *
 * @package Hooked into "hypermarket_homepage_template"
 * @since 1.0
 */
if (!function_exists('hypermarket_new_arrivals'))
{
	function hypermarket_new_arrivals($args)
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-new-arrivals');
		endif;
	}
}
/**
 * Homepage content.
 *
 * @package Hooked into "hypermarket_homepage_template"
 * @since 1.0
 */
if (!function_exists('hypermarket_homepage_content'))
{
	function hypermarket_homepage_content($args)
	{
		get_template_part('template-parts/hypermarket-homepage-content');
	}
}
// ======================================================================
// Hooked into "hypermarket_footer_area"
// ======================================================================

/**
 * Footer area wrapper start tag.
 *
 * @package Hooked into "hypermarket_footer_area"
 * @since 1.0
 */
if (!function_exists('hypermarket_footer_wrapper_start')):
	function hypermarket_footer_wrapper_start()
	{
		echo '<!-- Footer --><footer id="hypermarket-footer" class="footer space-top-3x">' . PHP_EOL;
	}
endif;
/**
 * Footer area wrapper start tag.
 *
 * @package Hooked into "hypermarket_footer_area"
 * @since 1.0
 */
if (!function_exists('hypermarket_footer_widget_areas')):
	function hypermarket_footer_widget_areas()
	{
		get_template_part('template-parts/hypermarket-footer-widget-areas');
	}
endif;
/**
 * Footer area wrapper end tag.
 *
 * @package Hooked into "hypermarket_footer_area"
 * @since 1.0
 */
if (!function_exists('hypermarket_footer_wrapper_end')):
	function hypermarket_footer_wrapper_end()
	{
		echo '</footer><!-- .footer -->';
	}
endif;
// ======================================================================
// Hooked into "hypermarket_featured_image_single_page"
// ======================================================================

/**
 * Single page content wrapper start tag.
 *
 * @package Hooked into "hypermarket_featured_image_single_page"
 * @since 1.0
 */
if (!function_exists('hypermarket_featured_image_background_single_page')):
	function hypermarket_featured_image_background_single_page()
	{
		get_template_part('template-parts/hypermarket-featured-image-background-single-page');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_before_single_page_content"
// ======================================================================

/**
 * Single page content wrapper start tag.
 *
 * @package Hooked into "hypermarket_before_single_page_content"
 * @since 1.0
 */
if (!function_exists('hypermarket_before_single_page_content_wrapper_start')):
	function hypermarket_before_single_page_content_wrapper_start()
	{
		if (!hypermarket_is_woocommerce_activated()):
			echo '<div class="col-sm-12">';
		elseif (hypermarket_is_woocommerce_activated() && !is_checkout() && !is_cart() && !hypermarket_is_account_page_not_logged_in()):
			echo '<div class="col-sm-12">';
		endif;
	}
endif;
// ======================================================================
// Hooked into "hypermarket_after_single_page_content"
// ======================================================================

/**
 * Single page content wrapper end tag.
 *
 * @package Hooked into "hypermarket_after_single_page_content"
 * @since 1.0
 */
if (!function_exists('hypermarket_after_single_page_content_wrapper_end')):
	function hypermarket_after_single_page_content_wrapper_end()
	{
		if (!hypermarket_is_woocommerce_activated()):
			echo '</div>';
		elseif (hypermarket_is_woocommerce_activated() && !is_checkout() && !is_cart() && !hypermarket_is_account_page_not_logged_in()):
			echo '</div>';
		endif;
	}
endif;
// ======================================================================
// Hooked into "hypermarket_before_loop_posts"
// ======================================================================

/**
 * The post meta.
 *
 * @package Hooked into "hypermarket_before_loop_posts"
 * @since 1.0
 */
if (!function_exists('hypermarket_loop_posts_header_image')):
	function hypermarket_loop_posts_header_image()
	{
		get_template_part('template-parts/hypermarket-loop-posts-header-image');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_loop_posts"
// ======================================================================

/**
 * The post meta.
 *
 * @package Hooked into "hypermarket_loop_posts"
 * @since 1.0
 */
if (!function_exists('hypermarket_post_meta')):
	function hypermarket_post_meta()
	{
		get_template_part('template-parts/hypermarket-post-meta');
	}
endif;
/**
 * Processes like/unlike.
 * A simple and efficient post like system for WordPress.
 *
 * @package Hooked into "wp_ajax_nopriv_hypermarket_process_simple_like"
 * @package Hooked into "wp_ajax_hypermarket_process_simple_like"
 * @link https://github.com/JonMasterson/WordPress-Post-Like-System
 * @since 1.0
 */
if (!function_exists('hypermarket_process_simple_like')):
	function hypermarket_process_simple_like()
	{
		// Security
		$nonce = isset($_REQUEST['nonce']) ? sanitize_text_field($_REQUEST['nonce']) : 0;
		if (!wp_verify_nonce($nonce, 'simple-likes-nonce')):
			exit(__('Not permitted', 'hypermarket'));
		endif;
		// Test if javascript is disabled
		$disabled = (isset($_REQUEST['disabled']) && $_REQUEST['disabled'] == true) ? true : false;
		// Test if this is a comment
		$is_comment = (isset($_REQUEST['is_comment']) && $_REQUEST['is_comment'] == 1) ? 1 : 0;
		// Base variables
		$post_id = (isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : '';
		$result = array();
		$post_users = NULL;
		$like_count = 0;
		if ($post_id != ''):
			$count = ($is_comment == 1) ? get_comment_meta($post_id, "_comment_like_count", true) : get_post_meta($post_id, "_post_like_count", true); // like count
			$count = (isset($count) && is_numeric($count)) ? $count : 0;
			if (!hypermarket_already_liked($post_id, $is_comment)): // Like the post
				if (is_user_logged_in()): // user is logged in
					$user_id = get_current_user_id();
					$post_users = hypermarket_post_user_likes($user_id, $post_id, $is_comment);
					if ($is_comment == 1):
						// Update User & Comment
						$user_like_count = get_user_option("_comment_like_count", $user_id);
						$user_like_count = (isset($user_like_count) && is_numeric($user_like_count)) ? $user_like_count : 0;
						update_user_option($user_id, "_comment_like_count", ++$user_like_count);
						if ($post_users):
							update_comment_meta($post_id, "_user_comment_liked", $post_users);
						endif;
					else:
						// Update User & Post
						$user_like_count = get_user_option("_user_like_count", $user_id);
						$user_like_count = (isset($user_like_count) && is_numeric($user_like_count)) ? $user_like_count : 0;
						update_user_option($user_id, "_user_like_count", ++$user_like_count);
						if ($post_users):
							update_post_meta($post_id, "_user_liked", $post_users);
						endif;
					endif;
				else: // user is anonymous
					$user_ip = hypermarket_sl_get_ip();
					$post_users = hypermarket_post_ip_likes($user_ip, $post_id, $is_comment);
					// Update Post
					if ($post_users):
						if ($is_comment == 1):
							update_comment_meta($post_id, "_user_comment_IP", $post_users);
						else:
							update_post_meta($post_id, "_user_IP", $post_users);
						endif;
					endif;
				endif;
				$like_count = ++$count;
				$response['status'] = "liked";
				$response['icon'] = hypermarket_get_liked_icon();
			else: // Unlike the post
				if (is_user_logged_in()): // user is logged in
					$user_id = get_current_user_id();
					$post_users = hypermarket_post_user_likes($user_id, $post_id, $is_comment);
					// Update User
					if ($is_comment == 1):
						$user_like_count = get_user_option("_comment_like_count", $user_id);
						$user_like_count = (isset($user_like_count) && is_numeric($user_like_count)) ? $user_like_count : 0;
						if ($user_like_count > 0):
							update_user_option($user_id, "_comment_like_count", --$user_like_count);
						endif;
					else:
						$user_like_count = get_user_option("_user_like_count", $user_id);
						$user_like_count = (isset($user_like_count) && is_numeric($user_like_count)) ? $user_like_count : 0;
						if ($user_like_count > 0):
							update_user_option($user_id, '_user_like_count', --$user_like_count);
						endif;
					endif;
					// Update Post
					if ($post_users):
						$uid_key = array_search($user_id, $post_users);
						unset($post_users[$uid_key]);
						if ($is_comment == 1):
							update_comment_meta($post_id, "_user_comment_liked", $post_users);
						else:
							update_post_meta($post_id, "_user_liked", $post_users);
						endif;
					endif;
				else: // user is anonymous
					$user_ip = hypermarket_sl_get_ip();
					$post_users = hypermarket_post_ip_likes($user_ip, $post_id, $is_comment);
					// Update Post
					if ($post_users):
						$uip_key = array_search($user_ip, $post_users);
						unset($post_users[$uip_key]);
						if ($is_comment == 1):
							update_comment_meta($post_id, "_user_comment_IP", $post_users);
						else:
							update_post_meta($post_id, "_user_IP", $post_users);
						endif;
					endif;
				endif;
				$like_count = ($count > 0) ? --$count : 0; // Prevent negative number
				$response['status'] = "unliked";
				$response['icon'] = hypermarket_get_unliked_icon();
			endif;
			if ($is_comment == 1):
				update_comment_meta($post_id, "_comment_like_count", $like_count);
				update_comment_meta($post_id, "_comment_like_modified", date('Y-m-d H:i:s'));
			else:
				update_post_meta($post_id, "_post_like_count", $like_count);
				update_post_meta($post_id, "_post_like_modified", date('Y-m-d H:i:s'));
			endif;
			$response['count'] = hypermarket_get_like_count($like_count);
			$response['testing'] = $is_comment;
			if ($disabled == true):
				if ($is_comment == 1):
					wp_redirect(get_permalink(get_the_ID()));
					exit();
				else:
					wp_redirect(get_permalink($post_id));
					exit();
				endif;
			else:
				wp_send_json($response);
			endif;
		endif;
	}
endif;
/**
 * Utility to test if the post is already liked.
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_already_liked')):
	function hypermarket_already_liked($post_id, $is_comment)
	{
		$post_users = NULL;
		$user_id = NULL;
		if (is_user_logged_in()): // user is logged in
			$user_id = get_current_user_id();
			$post_meta_users = ($is_comment == 1) ? get_comment_meta($post_id, "_user_comment_liked") : get_post_meta($post_id, "_user_liked");
			if (count($post_meta_users) != 0):
				$post_users = $post_meta_users[0];
			endif;
		else: // user is anonymous
			$user_id = hypermarket_sl_get_ip();
			$post_meta_users = ($is_comment == 1) ? get_comment_meta($post_id, "_user_comment_IP") : get_post_meta($post_id, "_user_IP");
			if (count($post_meta_users) != 0): // meta exists, set up values
				$post_users = $post_meta_users[0];
			endif;
		endif;
		if (is_array($post_users) && in_array($user_id, $post_users)):
			return true;
		else:
			return false;
		endif;
	}
endif;
/**
 * Output the like button.
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_get_simple_likes_button')):
	function hypermarket_get_simple_likes_button($post_id, $is_comment = NULL)
	{
		$is_comment = (NULL == $is_comment) ? 0 : 1;
		$output = '';
		$nonce = wp_create_nonce('simple-likes-nonce'); // Security
		if ($is_comment == 1):
			$post_id_class = esc_attr(' hypermarket-sl-comment-button-' . $post_id);
			$comment_class = esc_attr(' hypermarket-sl-comment');
			$like_count = get_comment_meta($post_id, "_comment_like_count", true);
			$like_count = (isset($like_count) && is_numeric($like_count)) ? $like_count : 0;
		else:
			$post_id_class = esc_attr(' hypermarket-sl-button-' . $post_id);
			$comment_class = esc_attr('');
			$like_count = get_post_meta($post_id, "_post_like_count", true);
			$like_count = (isset($like_count) && is_numeric($like_count)) ? $like_count : 0;
		endif;
		$count = hypermarket_get_like_count($like_count);
		$icon_empty = hypermarket_get_unliked_icon();
		$icon_full = hypermarket_get_liked_icon();
		// Loader
		$loader = '<span id="hypermarket-sl-loader"></span>';
		// Liked/Unliked Variables
		if (hypermarket_already_liked($post_id, $is_comment)):
			$class = esc_attr(' liked');
			$title = __('Unlike', 'hypermarket');
			$icon = $icon_full;
		else:
			$class = '';
			$title = __('Like', 'hypermarket');
			$icon = $icon_empty;
		endif;
		$output = '<span class="hypermarket-sl-wrapper"><a href="' . admin_url('admin-ajax.php?action=hypermarket_process_simple_like' . '&post_id=' . $post_id . '&nonce=' . $nonce . '&is_comment=' . $is_comment . '&disabled=true') . '" class="hypermarket-sl-button' . $post_id_class . $class . $comment_class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" data-iscomment="' . $is_comment . '" title="' . $title . '">' . $icon . $count . '</a>' . $loader . '</span>';
		return $output;
	}
endif;
/**
 * Utility retrieves post meta user likes (user id array),
 * then adds new user id to retrieved array
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_post_user_likes')):
	function hypermarket_post_user_likes($user_id, $post_id, $is_comment)
	{
		$post_users = '';
		$post_meta_users = ($is_comment == 1) ? get_comment_meta($post_id, "_user_comment_liked") : get_post_meta($post_id, "_user_liked");
		if (count($post_meta_users) != 0):
			$post_users = $post_meta_users[0];
		endif;
		if (!is_array($post_users)):
			$post_users = array();
		endif;
		if (!in_array($user_id, $post_users)):
			$post_users['user-' . $user_id] = $user_id;
		endif;
		return $post_users;
	}
endif;
/**
 * Utility retrieves post meta ip likes (ip array),
 * then adds new ip to retrieved array
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_post_ip_likes')):
	function hypermarket_post_ip_likes($user_ip, $post_id, $is_comment)
	{
		$post_users = '';
		$post_meta_users = ($is_comment == 1) ? get_comment_meta($post_id, "_user_comment_IP") : get_post_meta($post_id, "_user_IP");
		// Retrieve post information
		if (count($post_meta_users) != 0):
			$post_users = $post_meta_users[0];
		endif;
		if (!is_array($post_users)):
			$post_users = array();
		endif;
		if (!in_array($user_ip, $post_users)):
			$post_users['ip-' . $user_ip] = $user_ip;
		endif;
		return $post_users;
	}
endif;
/**
 * Utility to retrieve IP address.
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_sl_get_ip')):
	function hypermarket_sl_get_ip()
	{
		if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])):
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else:
			$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
		endif;
		$ip = filter_var($ip, FILTER_VALIDATE_IP);
		$ip = ($ip === false) ? '0.0.0.0' : $ip;
		return $ip;
	}
endif;
/**
 * Utility returns the button icon for "like" action
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_get_liked_icon')):
	function hypermarket_get_liked_icon()
	{
		$icon = '<i class="material-icons favorite"></i>';
		return $icon;
	}
endif;
/**
 * Utility returns the button icon for "unlike" action
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_get_unliked_icon')):
	function hypermarket_get_unliked_icon()
	{
		$icon = '<i class="material-icons favorite_border"></i>';
		return $icon;
	}
endif;
/**
 * Utility function to format the button count,
 * appending "K" if one thousand or greater,
 * "M" if one million or greater,
 * and "B" if one billion or greater (unlikely).
 * $precision = how many decimal points to display (1.25K)
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_sl_format_count')):
	function hypermarket_sl_format_count($number)
	{
		$precision = 2;
		if ($number >= 1000 && $number < 1000000):
			$formatted = number_format($number / 1000, $precision) . 'K';
		elseif ($number >= 1000000 && $number < 1000000000):
			$formatted = number_format($number / 1000000, $precision) . 'M';
		elseif ($number >= 1000000000):
			$formatted = number_format($number / 1000000000, $precision) . 'B';
		else:
			$formatted = $number; // Number is less than 1000
		endif;
		$formatted = str_replace('.00', '', $formatted);
		return $formatted;
	}
endif;
/**
 * Utility retrieves count plus count options,
 * returns appropriate format based on options
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_get_like_count')):
	function hypermarket_get_like_count($like_count)
	{
		if (is_numeric($like_count) && $like_count > 0):
			$number = '&nbsp;' . hypermarket_sl_format_count($like_count);
		else:
			$number = '';
		endif;
		$count = '<span class="hypermarket-sl-count">' . $number . '</span>';
		return $count;
	}
endif;
/**
 * The post entry.
 *
 * @package Hooked into "hypermarket_loop_posts"
 * @since 1.0
 */
if (!function_exists('hypermarket_post_entry')):
	function hypermarket_post_entry()
	{
		get_template_part('template-parts/hypermarket-post-entry');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_loop_posts_paging_navigation"
// ======================================================================

/**
 * Navigation to next/previous set of posts when applicable.
 *
 * @package Hooked into "hypermarket_loop_posts_paging_navigation"
 * @package Hooked into "woocommerce_after_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_paging_navigation')):
	function hypermarket_paging_navigation()
	{
		get_template_part('template-parts/hypermarket-paging-navigation');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_after_single_post_content"
// ======================================================================

/**
 * Post sharing.
 *
 * @package Hooked into "hypermarket_after_single_post_content"
 * @since 1.0
 */
if (!function_exists('hypermarket_post_sharing')):
	function hypermarket_post_sharing()
	{
		get_template_part('template-parts/hypermarket-post-sharing');
	}
endif;