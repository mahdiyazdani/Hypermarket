<?php
/**
 * Hypermarket Template Functions.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.3.0
 */
// ======================================================================
// Hooked into "hypermarket_before_header_area"
// ======================================================================

/**
 * Skip links.
 *
 * @package Hooked into "hypermarket_before_header_area"
 * @since 1.0.0
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
 * @since 1.1.1
 */
if (!function_exists('hypermarket_header_wrapper_start')):
	function hypermarket_header_wrapper_start()
	{
		$navbar_sticky = '';
		$navbar_titled = '';
		$navbar_sidenav = '';
		echo '<!-- Navbar -->';
		if (apply_filters('hypermarket_sticky_header', false)):
			$navbar_sticky = ' navbar-sticky';
		endif;
		if (apply_filters('hypermarket_titled_header', false)):
			$navbar_titled = ' navbar-titled';
		endif;
		if (apply_filters('hypermarket_sidenav_header', false)):
			$navbar_sidenav = ' navbar-sidenav';
		endif;
		echo '<header id="hypermarket-header" class="navbar' . $navbar_sticky . $navbar_titled . $navbar_sidenav . '" itemscope="itemscope" itemtype="http://schema.org/WPHeader">';
	}
endif;
/**
 * Site brand/logo
 *
 * @package Hooked into "hypermarket_header_area"
 * @since 1.3.0
 */
if (!function_exists('hypermarket_site_brand')):
	function hypermarket_site_brand()
	{
		$mobile_logo = absint(get_theme_mod('hypermarket_mobile_logo', ''));
		if (function_exists('the_custom_logo') && has_custom_logo()):
			the_custom_logo();
			if (! empty($mobile_logo)):
				echo '<a href="' . esc_url(home_url('/')) . '" class="site-logo custom-logo-link visible-mobile" target="_self">
						' . wp_get_attachment_image($mobile_logo, 'full', '', array('class' => 'img-responsive')) . '
					</a>';
			endif;
		elseif (function_exists('jetpack_has_site_logo') && jetpack_has_site_logo()):
			jetpack_the_site_logo();
		else:
			$display_tagline = false;
			$toggle_tagline = get_theme_mod('hypermarket_toggle_tagline');
			if(!empty($toggle_tagline) && get_theme_mod('hypermarket_toggle_tagline') === true):
				$display_tagline = true;
			endif;
			echo '<a id="site-logo-visible-desktop" href="' . esc_url(home_url('/')) . '" class="site-logo visible-desktop' . (true === $display_tagline ? ' padding-bottom-none' : '') . '" itemprop="headline" rel="home">' . esc_attr(get_bloginfo('name')) . '</a><!-- .site-logo.visible-desktop -->';
			if(true === $display_tagline):
				echo '<span id="site-tagline-visible-desktop" class="site-tagline visible-desktop">' . esc_attr(get_bloginfo('description')) . '</span><!-- .site-tagline.visible-desktop -->';
			endif;
			echo '<a id="site-logo-visible-mobile" href="' . esc_url(home_url('/')) . '" class="site-logo visible-mobile" itemprop="headline" rel="home">' . esc_attr(get_theme_mod('hypermarket_mobile_blogname')) . '</a><!-- .site-logo.visible-mobile -->';
		endif;
	}
endif;
/**
 * Primary Navigation.
 *
 * @package Hooked into "hypermarket_header_area"
 * @since 1.2.0
 */
if (!function_exists('hypermarket_primary_navigation')):
	function hypermarket_primary_navigation()
	{
		wp_nav_menu(array(
			'depth' => 3,
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
 * @since 1.0.0
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
 * @since 1.0.0
 */
if (!function_exists('hypermarket_header_wrapper_end')):
	function hypermarket_header_wrapper_end()
	{
		?>
		</header>
		<!-- .navbar -->
		<?php
	}
endif;
// ======================================================================
// Hooked into "hypermarket_homepage_template"
// ======================================================================

/**
 * Product Categorie(s).
 *
 * @package Hooked into "hypermarket_homepage_template"
 * @since 1.0.0
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
 * @since 1.0.0
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
 * @since 1.0.0
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
 * @since 1.0.0
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
 * @since 1.0.3
 */
if (!function_exists('hypermarket_footer_wrapper_start')):
	function hypermarket_footer_wrapper_start()
	{
		?>
		<!-- Footer -->
		<footer id="hypermarket-footer" class="footer space-top-3x" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
		<?php
	}
endif;
/**
 * Footer area wrapper start tag.
 *
 * @package Hooked into "hypermarket_footer_area"
 * @since 1.0.0
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
 * @since 1.0.0
 */
if (!function_exists('hypermarket_footer_wrapper_end')):
	function hypermarket_footer_wrapper_end()
	{
		echo '</footer><!-- .footer -->';
	}
endif;
// ======================================================================
// Hooked into "hypermarket_before_single_page"
// ======================================================================

/**
 * Single page content wrapper start tag.
 *
 * @package Hooked into "hypermarket_before_single_page"
 * @since 1.0.9.0
 */
if (!function_exists('hypermarket_featured_image_single_page')):
	function hypermarket_featured_image_single_page()
	{
		get_template_part('template-parts/hypermarket-featured-image-single-page');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_before_single_page_content"
// ======================================================================

/**
 * Single page content wrapper start tag.
 *
 * @package Hooked into "hypermarket_before_single_page_content"
 * @since 1.0.0
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
// Hooked into "hypermarket_end_single_page_content"
// ======================================================================

/**
 * Split WordPress Pages into Multiple Pages.
 *
 * @package Hooked into "hypermarket_end_single_page_content"
 * @since 1.0.4.2
 */
if (!function_exists('hypermarket_single_page_paging')):
	function hypermarket_single_page_paging()
	{
		get_template_part('template-parts/hypermarket-single-paging');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_after_single_page_content"
// ======================================================================

/**
 * Single page content wrapper end tag.
 *
 * @package Hooked into "hypermarket_after_single_page_content"
 * @since 1.0.0
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
 * @since 1.0.0
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
 * @since 1.0.0
 */
if (!function_exists('hypermarket_post_meta')):
	function hypermarket_post_meta()
	{
		get_template_part('template-parts/hypermarket-post-meta');
	}
endif;
/**
 * The post entry.
 *
 * @package Hooked into "hypermarket_loop_posts"
 * @since 1.0.0
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
 * @since 1.0.0
 */
if (!function_exists('hypermarket_paging_navigation')):
	function hypermarket_paging_navigation()
	{
		get_template_part('template-parts/hypermarket-paging-navigation');
	}
endif;
// ======================================================================
// Hooked into "hypermarket_end_single_post_content"
// ======================================================================

/**
 * Split WordPress Posts into Multiple Pages.
 *
 * @package Hooked into "hypermarket_end_single_post_content"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_single_post_paging')):
	function hypermarket_single_post_paging()
	{
		get_template_part('template-parts/hypermarket-single-paging');
	}
endif;