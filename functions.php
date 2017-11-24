<?php
/**
 * Hypermarket functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * Do not add any custom code here.
 * Please use a custom plugin or child theme so that your customizations aren't lost during updates.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 *
 * @see 		https://codex.wordpress.org/Theme_Development
 * @see 		https://codex.wordpress.org/Plugin_API
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 		1.4.2
 */
// Assign the "Hypermarket" info to constants.
$hypermarket_theme = wp_get_theme('hypermarket');
define('HYPERMARKET_THEME_NAME', $hypermarket_theme->get('Name'));
define('HYPERMARKET_THEME_URI', $hypermarket_theme->get('ThemeURI'));
define('HYPERMARKET_THEME_AUTHOR', $hypermarket_theme->get('Author'));
define('HYPERMARKET_THEME_AUTHOR_URI', $hypermarket_theme->get('AuthorURI'));
define('HYPERMARKET_THEME_VERSION', $hypermarket_theme->get('Version'));
// Hypermarket only works in WordPress 4.7 or later.
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')):
	require 'includes/back-compat.php';
endif;
/**
 * Theme setup and custom theme supports.
 * Theme Customizer.
 * Bootstrap NavWalker.
 * Payment method icons widget.
 * Social icons widget.
 *
 * @since 1.0.0
 */
$hypermarket = (object)array(
	// Theme setup and custom theme supports.
	'setup' => require 'includes/classes/class-hypermarket.php',
	// Customizer Additions.
	'customizer' => require 'includes/classes/class-customizer.php',
	// Bootstrap NavWalker.
	'navwalker' => require 'includes/classes/class-bootstrap-navwalker.php',
	// Payment method icons widget.
	'payment-method-icons' => require 'includes/classes/class-payment-method-icons-widget.php',
	// Social icons widget.
	'payment-method-icons' => require 'includes/classes/class-social-icons-widget.php',
);
/**
 * Custom functions that act independently of the theme templates.
 *
 * @since 1.0.0
 */
require 'includes/extras.php';

/**
 * Template hooks.
 *
 * @since 1.0.0
 */
require 'includes/template-hooks.php';

/**
 * Template functions.
 *
 * @since 1.0.0
 */
require 'includes/template-functions.php';

/**
 * Load WooCommerce functions.
 *
 * @since 1.0.9.0
 */
if (hypermarket_is_woocommerce_activated()):
	// WooCommerce Order by
	$orderby_options = '';
	// 3 Columns (Default)
	$product_grid_classes = 'col-md-4 col-sm-6';
	$hypermarket->woocommerce = require 'includes/classes/class-woocommerce.php';
	// Custom functions that act independently of the theme templates.
	require 'includes/woocommerce-extras.php';
	// WooCommerce template Hooks.
	require 'includes/woocommerce-template-hooks.php';
	// WooCommerce template functions.
	require 'includes/woocommerce-template-functions.php';

endif;

/**
 * Hypermarket welcome screen.
 *
 * @since 1.0.5.1
 */
if (current_user_can('manage_options')):
	require 'includes/classes/class-hypermarket-welcome-screen.php';
endif;