<?php
/**
 * Theme setup and custom theme supports.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.3
 */
if (!defined('ABSPATH')):
	exit;
endif;
if (!class_exists('Hypermarket')):
	/**
	 * The setup Hypermarket class
	 */
	class Hypermarket

	{
		/**
		 * Setup class.
		 *
		 * @since 1.0.3
		 */
		public function __construct()

		{
			add_action('after_setup_theme', array(
				$this,
				'setup'
			) , 10);
			add_action('after_switch_theme', array(
				$this,
				'flush_rules'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'enqueue'
			) , 10);
			add_action('widgets_init', array(
				$this,
				'widgets'
			) , 10);
			add_action('load-themes.php', array(
				$this,
				'cleanup_default_widgets'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'child_scripts'
			) , 30);
			add_filter('body_class', array(
				$this,
				'body_classes'
			) , 10);
			add_filter('adjust_body_class', array(
				$this,
				'adjust_body_class'
			) , 10);
			add_filter('get_custom_logo', array(
				$this,
				'change_logo_class'
			) , 10);
			add_filter('excerpt_length', array(
				$this,
				'custom_excerpt_length'
			) , 10, 1);
			add_filter('excerpt_more', array(
				$this,
				'custom_excerpt_more'
			) , 10, 1);
		}
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0.1
		 */
		public function setup()

		{
			/**
			 * Set the content width based on the theme's design and stylesheet.
			 */
			if (!isset($content_width))
			{
				$content_width = 1920; /* pixels */
			}
			/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on hypermarket, use a find and replace
			* to change 'hypermarket' to the name of your theme in all the template files
			*/
			// Loads wp-content/languages/themes/hypermarket-it_IT.mo.
			load_theme_textdomain('hypermarket', trailingslashit(WP_LANG_DIR) . 'themes/');
			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain('hypermarket', get_stylesheet_directory() . '/languages');
			// Loads wp-content/themes/hypermarket/languages/it_IT.mo.
			load_theme_textdomain('hypermarket', get_template_directory() . '/languages');
			// Add default posts and comments RSS feed links to head.
			add_theme_support('automatic-feed-links');
			/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
			add_theme_support('title-tag');
			/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			*/
			add_theme_support('post-thumbnails');
			// This theme uses wp_nav_menu() in one location.
			define('HypermarketPrimaryNavLocation', 'primary');
			register_nav_menus(array(
				HypermarketPrimaryNavLocation => __('Primary Menu', 'hypermarket')
			));
			/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
			*/
			add_theme_support('html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			));
			/*
			* Enable support for Post Formats.
			* See http://codex.wordpress.org/Post_Formats
			*/
			add_theme_support('post-formats', array(
				''
			));
			/**
			 * Enable support for site logo
			 */
			add_theme_support('custom-logo', array(
				'height' => 30,
				'width' => 310,
				'flex-width' => true,
				'flex-height' => true
			));
			/**
			 *  Add support for the Site Logo plugin and the site logo functionality in JetPack
			 *  https://github.com/automattic/site-logo
			 *  http://jetpack.me/
			 */
			add_theme_support('site-logo', array(
				'size' => 'full'
			));
			// Setup the WordPress core custom header feature.
			add_theme_support('custom-header', apply_filters('hypermarket_custom_header_args', array(
				'default-image' => '',
				'header-text' => false,
				'width' => 1920,
				'height' => 530,
				'flex-width' => true,
				'flex-height' => true,
			)));
			// Setup the WordPress core custom background feature.
			add_theme_support('custom-background', apply_filters('hypermarket_custom_background_args', array(
				'default-color' => '#ffffff',
				'default-image' => ''
			)));
			// Declare WooCommerce support.
			add_theme_support('woocommerce');
			// Declare support for selective refreshing of widgets.
			add_theme_support('customize-selective-refresh-widgets');
			/**
			 *  This theme styles the visual editor to resemble the theme style,
			 *  specifically font, colors, icons, and column width.
			 */
			add_editor_style( array( get_stylesheet_directory_uri() . '/assets/css/hypermarket-editor-style.css', add_query_arg(apply_filters('hypermarket_default_font_family', array(
				'family' => 'Work+Sans:400,300,500,600',
				'subset' => 'latin,latin-ext'
			)) , 'https://fonts.googleapis.com/css')));
		}
		/**
		 * This function is useful when used with custom post types
		 * as it allows for automatic flushing of the WordPress rewrite rules
		 * (usually needs to be done manually for new custom post types).
		 *
		 * @see https://codex.wordpress.org/Function_Reference/flush_rewrite_rules
		 * @since 1.0.3
		 */
		public function flush_rules()

		{
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.3
		 */
		public function enqueue()

		{
			wp_enqueue_style('hypermarket-font', add_query_arg(apply_filters('hypermarket_default_font_family', array(
				'family' => 'Work+Sans:400,300,500,600',
				'subset' => 'latin,latin-ext'
			)) , 'https://fonts.googleapis.com/css') , array() , HypermarketThemeVersion);
			wp_enqueue_style('hypermarket-styles', get_stylesheet_directory_uri() . '/assets/css/hypermarket-core.min.css', array() , HypermarketThemeVersion);
			wp_enqueue_style('hypermarket-theme-styles', get_stylesheet_directory_uri() . '/assets/css/hypermarket.css', array() , HypermarketThemeVersion);
			wp_enqueue_script('jquery');
			wp_enqueue_script('hypermarket-scripts', get_template_directory_uri() . '/assets/js/hypermarket-core.min.js', array(
				'jquery'
			) , HypermarketThemeVersion, true);
			wp_register_script('hypermarket-theme-scripts', get_template_directory_uri() . '/assets/js/hypermarket.js', array(
				'jquery',
				'hypermarket-scripts'
			) , HypermarketThemeVersion, true);
			wp_localize_script('hypermarket-theme-scripts', 'hypermarket_vars', array(
				'ajaxurl' => admin_url('admin-ajax.php') ,
				'security' => wp_create_nonce( 'hypermarket_theme_nonce' ),
				'popular' => __('Popular', 'hypermarket') ,
				'like' => __('Like', 'hypermarket') ,
				'unlike' => __('Unlike', 'hypermarket') ,
				'loading' => __('...', 'hypermarket')
			));
			wp_enqueue_script('hypermarket-theme-scripts');
			if (is_singular() && comments_open() && get_option('thread_comments')):
				wp_enqueue_script('comment-reply');
			endif;
		}
		/**
		 * Declaring widget(s) and widget area(s).
		 *
		 * @see https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 * @since 1.0.3
		 */
		public function widgets()

		{
			// Main Shop Sidebar (if WooCommerce activated only!)
			if(hypermarket_is_woocommerce_activated()):
				$sidebar_args['sidebar'] = array(
					'name' => __('Shop Sidebar', 'hypermarket') ,
					'id' => 'sidebar',
					'description' => __('Widgets added to this region will appear in shop archive pages.', 'hypermarket')
				);
			endif;
			// Footer
			$footer_widget_areas = apply_filters('hypermarket_footer_widget_areas', 3);
			if (is_int($footer_widget_areas)):
				for ($i = 1; $i <= intval($footer_widget_areas); $i++):
					$footer = sprintf('footer_%d', $i);
					$sidebar_args[$footer] = array(
						'name' => sprintf(__('Footer %d', 'hypermarket') , $i) ,
						'id' => sprintf('footer-%d', $i) ,
						'description' => sprintf(__('Widgetized Footer Area %d.', 'hypermarket') , $i)
					);
				endfor;
			endif;
			/**
			 * Widget wrapper and title tags.
			 */
			foreach($sidebar_args as $sidebar => $args):
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>'
				);
				/**
				 * Dynamically generated filter hooks.
				 *
				 * 'hypermarket_sidebar_widget_tags' (if WooCommerce activated only!)
				 * 'hypermarket_footer_1_widget_tags'
				 * 'hypermarket_footer_2_widget_tags'
				 * 'hypermarket_footer_3_widget_tags'
				 *
				 */
				$filter_hook = sprintf('hypermarket_%s_widget_tags', $sidebar);
				$widget_tags = apply_filters($filter_hook, $widget_tags);
				if (is_array($widget_tags)):
					register_sidebar($args + $widget_tags);
				endif;
			endforeach;
		}
		/**
		 * Clean-up all widgets from all widget areas.
		 *
		 * @since 1.0.3
		 */
		public function cleanup_default_widgets()

		{
			global $pagenow;
			if(current_user_can('administrator') && isset($_GET['activated'] ) && $pagenow == 'themes.php'):
				//get all registered sidebars
			    global $wp_registered_sidebars;
			    //get saved widgets
			    $widgets = get_option('sidebars_widgets');
			    //loop over the sidebars and remove all widgets
			    foreach ($wp_registered_sidebars as $sidebar => $value):
			        unset($widgets[$sidebar]);
			    endforeach;
			    //update with widgets removed
			    update_option('sidebars_widgets',$widgets);
			else:
				return;
		    endif;
		}
		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * primary css and the separate WooCommerce css.
		 *
		 * @since 1.0
		 */
		public function child_scripts()

		{
			if (is_child_theme()):
				wp_enqueue_style('hypermarket-child-style', get_stylesheet_uri() , '');
			endif;
		}
		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @since 1.0
		 */
		public function body_classes($classes)

		{
			// Adds a class of group-blog to blogs with more than 1 published author.
			if (is_multi_author()):
				$classes[] = 'group-blog';
			endif;
			// Adds a class of hfeed to non-singular pages.
			if (!is_singular()):
				$classes[] = 'hfeed';
			endif;
			return $classes;
		}
		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @since 1.0
		 */
		public function adjust_body_class($classes)

		{
			foreach($classes as $key => $value):
				if ($value == 'tag'):
					unset($classes[$key]);
				endif;
			endforeach;
			return $classes;
		}
		/**
		 * Replaces logo CSS class.
		 *
		 * @since 1.0.2
		 */
		public function change_logo_class($html)

		{
			$html = str_replace('class="custom-logo"', 'class="img-responsive"', $html);
			$html = str_replace('class="custom-logo-link"', 'class="site-logo custom-logo-link"', $html);
			return $html;
		}
		/**
		 * Control Excerpt Length Using Filters.
		 *
		 * @since 1.0.2
		 */
		public function custom_excerpt_length($length)

		{
			return apply_filters('hypermarket_excerpt_length', 55);
		}
		/**
		 * Adds the ... to the end of excerpt read more link.
		 *
		 * @since 1.0.2
		 */
		public function custom_excerpt_more($more)

		{
			return apply_filters('hypermarket_excerpt_more', '...');
		}
	}
endif;
return new Hypermarket();