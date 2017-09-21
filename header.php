<?php
/**
 * The header for our theme.
 * Displays all of the <head> section.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.4.2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<!--Mobile Specific Meta Tag-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php
		/**
		 * Functions hooked into "hypermarket_before_header_area" action
		 *
		 * @hooked hypermarket_skip_links				- 0
		 * @since 1.0.4.2
		 */
		do_action('hypermarket_before_header_area');
	?>
	<!-- Page Wrapper -->
  	<div class="page-wrapper">
	<?php
		/**
		 * Functions hooked into "hypermarket_header_area" action
		 *
		 * @hooked hypermarket_header_wrapper_start		- 2
		 * @hooked hypermarket_site_brand				- 5
		 * @hooked hypermarket_primary_navigation		- 10
		 * @hooked hypermarket_header_toolbar			- 10
		 * @hooked hypermarket_header_wrapper_end		- 12
		 * @since 1.0
		 */
		do_action('hypermarket_header_area');

		do_action('hypermarket_after_header_area');