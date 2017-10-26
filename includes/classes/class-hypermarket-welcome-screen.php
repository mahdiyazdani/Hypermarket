<?php
/**
 * Create a dashboard page and welcome screen for Hypermarket theme.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.3.8
 */
if (!defined('ABSPATH')):
	exit;
endif;
if (!class_exists('Hypermarket_Welcome_Screen')):
	/**
	 * The setup Hypermarket Welcome Screen class
	 */
	class Hypermarket_Welcome_Screen

	{
		private $admin_assets_url;
		/**
		 * Setup class.
		 *
		 * @since 1.0.4
		 */
		public function __construct()

		{
			$this->admin_assets_url = esc_url(get_template_directory_uri() . '/assets/admin/');
			add_action('admin_menu', array(
				$this,
				'register_welcome_menu'
			) , 10);
			add_action('load-themes.php', array(
				$this,
				'activation_admin_notice'
			) , 10);
			add_action('admin_enqueue_scripts', array(
				$this,
				'enqueue'
			) , 10);
			add_action('admin_notices', array(
				$this,
				'wc_installation_admin_notice'
			) , 10);
			add_action('admin_init', array(
				$this,
				'wc_ignore_installation_admin_notice'
			) , 10);
		}
		/**
		 * Register the welcome screen page.
		 *
		 * @link  https://codex.wordpress.org/Function_Reference/add_theme_page
		 * @since 1.0.5.1
		 */
		public function register_welcome_menu()

		{
			$page_title = esc_html__('Welcome to Hypermarket Theme', 'hypermarket');
			$menu_title = esc_html__('Hypermarket', 'hypermarket');
			add_theme_page($page_title, $menu_title, 'activate_plugins', 'hypermarket-welcome-screen', array(
				$this,
				'hypermarket_welcome_screen'
			));
		}
		/**
		 * Welcome screen markup.
		 *
		 * @since 1.3.5
		 */
		public function hypermarket_welcome_screen()

		{
		?>
				<div class="wrap">
					<h2><?php esc_attr_e('Welcome to Hypermarket Theme', 'hypermarket'); ?></h2>
					<h2 id="hypermarket-welcome-screen-nav" class="nav-tab-wrapper">
						<a href="#welcome" class="nav-tab nav-tab-active"><?php esc_html_e('Welcome', 'hypermarket'); ?></a>
						<?php if(apply_filters('hypermarket_are_you_still_free', true)): ?>
							<a href="#goplus" class="nav-tab goplus"><?php esc_html_e('Go Plus!', 'hypermarket'); ?></a>
						<?php endif; ?>
						<a href="#childtheme" class="nav-tab"><?php esc_html_e('Child Theme', 'hypermarket'); ?></a>
						<a href="#support" class="nav-tab"><?php esc_html_e('Support', 'hypermarket'); ?></a>
						<a href="#translate" class="nav-tab"><?php esc_html_e('Translate', 'hypermarket'); ?></a>
						<a href="#contribute" class="nav-tab"><?php esc_html_e('Contribute', 'hypermarket'); ?></a>
					</h2><!-- #hypermarket-welcome-screen-nav -->
					<div id="poststuff">
						<div id="post-body" class="metabox-holder columns-2">
							<!-- main content -->
							<div id="post-body-content">
								<div class="meta-box-sortables ui-sortable">
									<div class="postbox">
										<div class="handlediv" title="<?php esc_attr_e('Click to toggle', 'hypermarket'); ?>"><br /></div>
										<!-- Toggle -->
										<div id="welcome-content">
											<h2 class="hndle"><span><?php esc_attr_e('This is where it all begins', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('Thanks so much for joining us and using our excellent Hypermarket theme.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('You are on your way to super-productivity and beyond!', 'hypermarket'); ?></p>
												<br />
												<h3><?php esc_attr_e('Recommended & Integrated Plugins', 'hypermarket'); ?></h3>
												 <table class="widefat" cellspacing="0">
													<tbody>
														<tr class="alternate">
															<td class="row-title">
																<?php $install_woocommerce_url = esc_url(admin_url('plugin-install.php?s=woocommerce&tab=search&type=term')); ?>
																<a href="<?php echo $install_woocommerce_url; ?>" target="_self"><?php esc_attr_e('WooCommerce - A powerful, extendable eCommerce plugin that helps you sell anything', 'hypermarket'); ?></a>
																<br />
																<small style="font-size:70%;"><em><?php esc_attr_e('Hypermarket theme is fully compatible with the WooCommerce plugin for WordPress. It includes full design integration of the WooCommerce pages, shortcodes, and widgets.', 'hypermarket'); ?></em></small>
															</td>
														</tr>
														<tr class="alternate">
															<td class="row-title">
																<?php $install_bs3_grid_builder_url = esc_url(admin_url('plugin-install.php?s=woo%20store%20vacation&tab=search&type=term')); ?>
																<a href="<?php echo $install_bs3_grid_builder_url; ?>" target="_self"><?php esc_attr_e('Woo Store Vacataion - Put your shop on pause or hold mode for a certain amount of time', 'hypermarket'); ?></a>
																<br />
																<small style="font-size:70%;"><em><?php esc_attr_e('Going on vacation? Use Woo Store Vacation settings to make sure your buyers are not disappointed by buying items and unexpectedly waiting a long time to receive them.', 'hypermarket'); ?></em></small>
															</td>
														</tr>
													</tbody>
												</table>
											</div><!-- .inside -->
										</div><!-- #welcome-content -->
										<?php if(apply_filters('hypermarket_are_you_still_free', true)): ?>
										<div id="goplus-content">
											<h2 class="hndle"><span><?php esc_attr_e('Are You Still Free? Go Plus Now!', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<h3><?php esc_attr_e('Everything you need to build stunning e-commerce website in a fast & efficient way.', 'hypermarket'); ?></h3>
												<br/>
												<table cellpadding="10" id="hypermarket-plus">
													<tbody>
														<tr>
															<td class="icon"><span class="dashicons dashicons-format-image"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Product image flipper', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Secondary product thumbnail on archives that is revealed when you hover over the main product image.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-cloud"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Ajaxify blog posts', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Fetch & display post content without the user moving away from the current page.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-format-gallery"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Gallery post type', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('An easy way to create sortable lightbox galleries consisting of images & videos.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-share"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Share buttons', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Buttons designed to be minimal, yet powerful, with support of popular networks to make your products go viral and get more traffic.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-products"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Copyright credit', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Optionally remove the Hypermarket credit and add your own custom copyright message, including HTML.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-welcome-view-site"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Hero slider', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Image & content slider which supports touch navigation with a swipe gesture.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-clock"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Product countdown', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Promote your sale campaigns in WooCommerce. Show a countdown box with the product on sale.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-format-video"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Video popup', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Embed YouTube or Vimeo videos on a call to action box using a popup lightbox overlay display.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-screenoptions"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Footer bar', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('A full-width widgetized region which will display any widget added to this region above the Hypermarket footer widget area.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-update"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Automatic updates', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('You can update the plugin automatically via the WordPress admin panel providing you have activated a valid license key.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-star-empty"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Service widget', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Service widget makes it really easy to select a Google material icon to go along with your feature.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-megaphone"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Call to action widget', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('A CTA is an ideal way to convert more of your passive website visitors into active leads and customers.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-move"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Homepage control', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Toggle the visibility and reorder the homepage components or any function hooked by Hypermarket theme or [H/M] Plus plugin.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-businessman"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Testimonials', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('A clean and easy-to-use testimonials management system to load in what your customers are saying about your business.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-art"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Color scheme', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Easily change the colors of all the main elements of the site to give your shop a unique look.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-editor-textcolor"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Typography', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Easy access to any fonts you want from Google Web Fonts, the best free fonts available. Choose between more than 600 fonts.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-sort"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Extend product sorting', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Allows you to optionally, extend, add or remove the default and core WooCommerce product order by options on the shop page.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-image-filter"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Product color filters', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Place the color filter widget on your shop & allow visitors to browse your products by using color filters.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-hidden"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Page title toggle', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Easily remove the page title from specific single pages, shop or homepage template.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-cart"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Hero product', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Add an elegant hero component to the homepage template of your Hypermarket powered shop, or on any page via shortcode - Watch conversions soar!', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-editor-table"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Tabbed interface', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Unique homepage layout that prominently displays a variety of products in an intuitive tabbed interface.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-image-rotate"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Load more products', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Enhance the customer\'s product browsing experience by replacing the default behavior of WooCommerce pagination and loading products via Ajax!', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-welcome-widgets-menus"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Header variations', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Select the perfect layout for your shop header. There are 3 pre-designed layouts and each one provides a special design for your header area.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-filter"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Shop filters bar', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Convert WooCommerce sidebar into toggle-able filters bar & help customers to find what they really want.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-location-alt"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Google Maps', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Embed Google Maps with custom markers and info title in your WordPress website within a few seconds.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-format-chat"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('FAQ', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Easily create, order and publicize FAQs. Optionally, display the questions in groups by tagging them, and even load them closed or readily open.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-groups"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Team members', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Easy-to-use team profile management system for Hypermarket theme. Load in your team members and display their profiles via a shortcode.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-feedback"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Contact form', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Create a simple contact form using Ajax technology and advanced email address validation.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-store"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Product archive customizer', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Toggle the display of core elements and enable some that are not included in WooCommerce core.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-email"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('MailChimp widget', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('An easy, lightweight way to let your users sign up for several different MailChimp lists by creating multiple instances of the widget.', 'hypermarket'); ?>
															</td>
														</tr>
														<tr>
															<td class="icon"><span class="dashicons dashicons-admin-site"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('WPML compatible', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Hypermarket theme is fully compatible and tested with most popular WordPress plugin that supports the creation of multilingual layouts.', 'hypermarket'); ?>
															</td>
															<td class="icon"><span class="dashicons dashicons-tickets-alt"></span></td>
															<td class="content">
																<strong><?php esc_attr_e('Custom related products', 'hypermarket'); ?></strong>
																<br/>
																<?php esc_attr_e('Choose which products should show in the related products instead of pulling them in by category or tag.', 'hypermarket'); ?>
															</td>
														</tr>
													</tbody>
												</table>
											</div><!-- .inside -->
										</div><!-- #goplus-content -->
										<?php endif; ?>
										<div id="childtheme-content">
											<h2 class="hndle"><span><?php esc_attr_e('Make any customization using a child theme', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('If you want to customize the theme at coding level, not just CSS, we would strongly suggest using a child theme for that. A child theme allows you to override the parent theme\'s functions, template files and CSS so you will be able to adjust them as you want.', 'hypermarket'); ?></p>
												<hr/>
												<h3><?php esc_attr_e('To download a blank Hypermarket child theme, please navigate to:', 'hypermarket'); ?></h3>
												<br />
												<p align="center">
													<a href="<?php echo esc_url('https://mahdiyazdani.github.io/Hypermarket/#/install-hypermarket-wordpress-child-theme'); ?>" class="button-primary" target="_blank"><strong><?php esc_attr_e('Download Hypermarket Child Theme', 'hypermarket'); ?></strong></a>
												</p>
												<br />
												<br />
												<h3><?php esc_attr_e('Overriding Parent Theme\'s Template Files', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('If you want to edit the code in the theme\'s template files like "header.php", "index.php", etc, you can just copy the file from the parent theme and put it into your child theme folder then edit it from there.', 'hypermarket'); ?></p>
												<h3><?php esc_attr_e('Overriding Parent Theme\'s Functions', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('If you want to edit the functions of the parent theme, for example, the "hypermarket_comments_list()" function, you can do that by copying only the function from the parent theme and put it into the "functions.php" file of your child theme.', 'hypermarket'); ?></p>
												<p><em><?php esc_attr_e('* Note that, you must copy only the "function() {...}" part, NOT including the "function_exists()" wrapper.', 'hypermarket'); ?></em></p>
												<h3><?php esc_attr_e('Overriding Parent Theme\'s CSS', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('You can do this by either using the "Custom CSS" field in our Customizer or adding your custom CSS code into the "style.css" file of your child theme.', 'hypermarket'); ?></p>
												<h3><?php esc_attr_e('Remember!', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('Whenever you finished updating the parent theme, make sure to check all the code you use in your child theme and update them as necessary to reflect any changes in the parent theme. You might back up your custom code first, update the files with the latest version, then apply your custom code back.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('By doing this, it ensures that the files and code in your child theme are always up-to-date and to prevent any problem that might occur.', 'hypermarket'); ?></p>
											</div><!-- .inside -->
										</div><!-- #childtheme-content -->
										<div id="support-content">
											<h2 class="hndle"><span><?php esc_attr_e('Support and Documentation', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('Thanks so much for downloading and using the Hypermarket theme and providing positive feedback(s). The WordPress community has helped us a lot to improve the Hypermarket theme and make it compatible with more plugins and third-parties.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('To keep doing this well, we kindly request that you post discussions and feedback(s) in our dedicated forum whenever possible, rather than in the WordPress community forum. Doing so will allow us to leverage support team and tools to answer your questions as quickly as possible. ', 'hypermarket'); ?></p>
												<h3><?php esc_attr_e('To post your issues in the forum, please navigate to:', 'hypermarket'); ?></h3>
												<br />
												<p align="center">
													<a href="<?php echo esc_url('https://support.mypreview.one'); ?>" class="button-primary" target="_blank"><strong><?php esc_attr_e('MyPreview Support Forum', 'hypermarket'); ?></strong></a>
												</p>
												<br />
												<p><?php esc_attr_e('We look forward to listening to you and continuing our development of the Hypermarket theme.', 'hypermarket'); ?></p>
												<hr>
												<h3><?php esc_attr_e('View full documentation', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('Before you get started, please be sure always to check out theme documentation files. We outline all kinds of useful information and provide you with all the details you need know to use Hypermarket Theme.', 'hypermarket'); ?></p>
												<p><a href="<?php echo esc_url('https://mahdiyazdani.github.io/Hypermarket'); ?>" class="button-secondary" target="_blank"><?php esc_attr_e('Theme Documentation', 'hypermarket'); ?></a></p>
											</div><!-- .inside -->
										</div><!-- #support-content -->
										<div id="translate-content">
											<h2 class="hndle"><span><?php esc_attr_e('Translate Hypermarket theme into any language', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('Hypermarket WordPress theme is translation-ready and localized using the GNU framework. It is the common way to translate WordPress core and almost any theme or plugin.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('If you need more advanced features such as translating menu items, categories, etc. Feel free to visit WPML website and find out more about their premium services and plugin.', 'hypermarket'); ?></p>
												<br />
												<h3><?php esc_attr_e('What are PO and MO translation files?', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('WordPress uses PO and MO files to manage translations. In fact, WordPress only needs MO files to handle translations.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('PO files are human-readable; Those files contains a list of strings ready to be translated or with a translation already included.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('MO files just compiled exports from the PO files and used by WordPress to get the conversion of each string to translate the theme. If you try to open a MO file with a regular text editor, you will not understand anything of its content.', 'hypermarket'); ?></p>
												<p><a href="<?php echo esc_url('https://mahdiyazdani.github.io/Hypermarket/#/translating-with-poedit'); ?>" class="button-primary" target="_blank"><?php esc_attr_e('How to translate Hypermarket theme with Poedit?', 'hypermarket'); ?></a></p>
												<br />
												<h3><?php esc_attr_e('WPML & Translation Ready', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('Hypermarket theme is fully compatible and tested with most popular WordPress plugin that supports the creation of multilingual layouts. Translate your website into any language with WPML!', 'hypermarket'); ?></p>
												<p><a href="<?php echo esc_url('https://wpml.org/theme/hypermarket'); ?>" target="_blank"><img src="<?php echo $this->admin_assets_url . 'img/hypermarket-wpml-certification-badge.jpg'; ?>" alt="<?php esc_attr_e('Hypermarket WPML Certification Badge', 'hypermarket'); ?>" width="210" height="210" /></a></p>
												<br />
												<h3><?php esc_attr_e('Share your Language Files', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('In case you have already translated Hypermarket theme a lot of users would be thrilled if you share your translation files with the community.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('For translations of our Hypermarket theme just push the files to the main repository for all Hypermarket code, and we will include the translation files within your name and credit to the next release, so other people who speak your language can use it.', 'hypermarket'); ?></p>
												<p><a href="<?php echo esc_url('https://github.com/mahdiyazdani/Hypermarket'); ?>" class="button-secondary" target="_blank"><?php esc_attr_e('GitHub Development Repository', 'hypermarket'); ?></a></p>
											</div><!-- .inside -->
										</div><!-- #translate-content -->
										<div id="contribute-content">
											<h2 class="hndle"><span><?php esc_attr_e('Contribute to Hypermarket', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('Now that you have found the Hypermarket theme useful, here is how you can take action.', 'hypermarket'); ?></p>
												<p><a href="<?php echo esc_url('https://github.com/mahdiyazdani/Hypermarket'); ?>" class="button-primary" target="_blank"><?php esc_attr_e('GitHub Development Repository', 'hypermarket'); ?></a></p>
												<br />
												<h3><?php esc_attr_e('Create an Issue', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('If you find a bug in a Hypermarket theme functionality (and you do not know how to fix it), have trouble following the documentation or have a question about the Hypermarket theme hooks (filters and actions) - create an issue! There is nothing to it and whatever issue you are having, you are likely not the only one, so others will find your issue helpful, too.', 'hypermarket'); ?></p>
												<br />
												<h3><?php esc_attr_e('Issues Pro Tips', 'hypermarket'); ?></h3>
												<ol>
													<li><?php esc_attr_e('Check existing issues for your issue. Duplicating an issue is slower for both parties so search through open and closed issues to see if what you are running into has been addressed already.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Be clear about what your problem is: what was the expected outcome, what happened instead? Detail how someone else can recreate the problem.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Make sure the title of your issue report explains shortly what is going on.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Take your time to post as much information about your issue and server environment if it is possible.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Paste error output or logs in your issue or in a Gist. If pasting them in the issue, wrap it in three backticks: ``` so that it renders nicely.', 'hypermarket'); ?></li>
												</ol>
												<br />
												<h3><?php esc_attr_e('Pull Request (PR)', 'hypermarket'); ?></h3>
												<p><?php esc_attr_e('If you are able to patch the bug or add the feature yourself - fantastic, make a pull request with the code!', 'hypermarket'); ?>
												<p><?php esc_attr_e('Once you have submitted a pull request we can compare your branch to the existing one and decide whether or not to incorporate (pull in) your changes.', 'hypermarket'); ?></p>
												<br />
												<h3><?php esc_attr_e('Pull Request Pro Tips', 'hypermarket'); ?></h3>
												<ol>
													<li><?php esc_attr_e('Fork the Hypermarket theme repository and clone it locally. Connect your local to the original "upstream" repository by adding it as a remote. Pull in changes from "upstream" often so that you stay up to date so that when you submit your pull request, merge conflicts will be less likely.', 'hypermarket'); ?></li>
													<small><em><?php esc_attr_e('UpStream generally refers to the original repo that you have forked.', 'hypermarket'); ?></em></small>
													<br /><br />
													<li><?php esc_attr_e('Create a branch for your edits.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Be clear about what problem is occurring and how someone can recreate that problem or why your feature will help. Then be equally as clear about the steps you took to make your changes.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('It is best to test. Run your changes against any existing tests if they exist and create new ones when needed. Whether tests exist or not, make sure your changes don not break the existing Hypermarket project or have any conflicts with WordPress or WooCommerce functionality.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('If changes are visual and related to any aspects of user interface be sure to include screenshots of the before and after if your changes include differences in HTML/CSS.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Contribute in the style of the project to the best of your abilities. This may mean using indents, semi colons or comments differently than you would in your own repository.', 'hypermarket'); ?></li>
												</ol>
											</div><!-- .inside -->
										</div><!-- #contribute-content -->
									</div><!-- .postbox -->
								</div><!-- .meta-box-sortables .ui-sortable -->
							</div><!-- .post-body-content -->
							<!-- sidebar -->
							<div id="postbox-container-1" class="postbox-container">
								<div class="meta-box-sortables">
									<div class="postbox">
										<div class="handlediv" title="<?php esc_attr_e('Click to toggle', 'hypermarket'); ?>"><br /></div>
										<!-- Toggle -->
										<div id="welcome-sidebar">
											<h2 class="hndle"><span><?php esc_attr_e('Resources & Reference', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('While making Hypermarket theme, we used third-party plugins and resources, and want to thank their creators:', 'hypermarket'); ?></p>
												<ul>
													<li><a href="<?php echo esc_url('http://bourbon.io'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Bourbon - A simple and lightweight mixin library for Sass', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://jquery.com'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('jQuery - most popular feature-rich JavaScript library', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://modernizr.com'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Modernizr - JavaScript library that detects HTML5 and CSS3 features in the users browser', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://getbootstrap.com'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Bootstrap - Most popular HTML, CSS, and JS framework for developing responsive, mobile first projects on the web', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('http://velocityjs.org'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Velocity.js - Accelerated JavaScript animation', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://www.smoothscroll.net'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Smooth Scroll - An extension for smooth scrolling in Google Chrome', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('http://fian.my.id/Waves'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Waves - Click effect inspired by Googles Material Design', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('http://brm.io/jquery-match-height'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('matchHeight - makes the height of all selected elements exactly equal', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://material.io/icons'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Material Design Icons - Icon font for the web', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://understrap.com'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('UnderStrap - Combines Automattics Underscores Starter Theme and Bootstrap 4', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('http://twittem.github.io/wp-bootstrap-navwalker'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('WP Bootstrap Navwalker - A custom WordPress nav walker class', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://woocommerce.com'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('WooCommerce - An open source eCommerce plugin for WordPress', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://accessibility.oit.ncsu.edu/it-accessibility-at-nc-state/developers/accessibility-handbook/mouse-and-keyboard-events/skip-to-main-content'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('Skip link focus - Helps with accessibility for keyboard only users', 'hypermarket'); ?></em></small></a></li>
													<li><a href="<?php echo esc_url('https://github.com/jonstipe/number-polyfill'); ?>" rel="nofollow" target="_blank"><small><em><?php esc_attr_e('HTML5 Number polyfill - A polyfill for implementing the HTML5 number element in browsers that do not currently support it', 'hypermarket'); ?></em></small></a></li>
												</ul>
											</div><!-- .inside -->
										</div><!-- #welcome-sidebar -->
										<?php if(apply_filters('hypermarket_are_you_still_free', true)): ?>
										<div id="goplus-sidebar">
											<h2 class="hndle"><span><?php esc_attr_e('Hypermarket Plus!', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p>
													<a href="<?php echo esc_url(HypermarketThemeAuthorURI . '/hypermarket-plus.html'); ?>" target="_blank">
														<img class="hypermarket-plus-featured-image" src="<?php echo $this->admin_assets_url . 'img/hypermarket-plus.png'; ?>" alt="<?php esc_attr_e('Hypermarket Plus!', 'hypermarket'); ?>" />
													</a>
												</p>
												<p><?php esc_attr_e('Being on the cutting edge of WordPress development is something we wanted to do from the start. Because of that, we made sure that we avoided the use of clunky additional admin panels and instead, opted to utilize a powerful, options panel using Customizer API. With this setup, you can preview all of the changes you make to your site live without any need to switch windows or refresh the browser in addition to searching for exactly what you need. When you are happy with your changes, hit "Save Changes" button and your updates will go live.', 'hypermarket'); ?></p>
												<p align="center">
													<a href="<?php echo esc_url(HypermarketThemeAuthorURI . '/hypermarket-plus.html'); ?>" class="button-primary" target="_blank"><strong>&nbsp;&nbsp;<?php esc_attr_e('Buy Now', 'hypermarket'); ?>&nbsp;&nbsp;</strong></a>
													<a href="<?php echo esc_url('https://demo.mypreview.one/hypermarket'); ?>" class="button-secondary" target="_blank"><strong>&nbsp;&nbsp;<?php esc_attr_e('Live Demo', 'hypermarket'); ?>&nbsp;&nbsp;</strong></a>
												</p>
											</div><!-- .inside -->
										</div><!-- #goplus-sidebar -->
										<?php endif; ?>
										<div id="childtheme-sidebar">
											<h2 class="hndle"><span><?php esc_attr_e('What is a child theme?', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('A Child Theme is a theme that inherits the same functionality and styling of another theme, called the parent theme. By creating and working on a child theme, you can add, modify or disable parts of your site without changing the original files of the parent theme.', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('You do not have to worry anymore about updates to the parent theme since there is no need to exclude your modified files from the updating process or to re-add your changes to fit the new version. After the creation of a Child Theme, you end up significantly speeding up your development time.', 'hypermarket'); ?></p>
											</div><!-- .inside -->
										</div><!-- #childtheme-sidebar -->
										<div id="support-sidebar">
											<h2 class="hndle"><span><?php esc_attr_e('Gain direct access to us', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<p><?php esc_attr_e('As you might have already gathered, we love hearing your feedback, And you seem to love giving it!', 'hypermarket'); ?></p>
												<p><?php esc_attr_e('Our top priority is that you have a great experience with us and learn to create amazing code-free websites quickly.', 'hypermarket'); ?></p>
											</div><!-- .inside -->
										</div><!-- #support-sidebar -->
										<div id="translate-sidebar">
											<h2 class="hndle"><span><?php esc_attr_e('Files that enable translation', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<ol>
													<li><?php esc_attr_e('.pot: This file is a "portable object template" that contains all of the text to be translated.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('.po: The "portable object" file contains the original text and the translations.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('.mo: This is the "machine object file." When your translation is complete, you will convert or export your .po file to this file type so that WordPress can use it.', 'hypermarket'); ?></li>
												</ol>
											</div><!-- .inside -->
										</div><!-- #translate-sidebar -->
										<div id="contribute-sidebar">
											<h2 class="hndle"><span><?php esc_attr_e('The fundamentals are:', 'hypermarket'); ?></span></h2>
											<div class="inside">
												<ol>
													<li><?php esc_attr_e('Fork the project & clone locally.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Create an upstream remote and sync your local copy before you branch.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Branch for each separate piece of work.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Do the work, write good commit messages, and read the CONTRIBUTING file if there is one.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Push to your origin repository.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Create a new PR in GitHub.', 'hypermarket'); ?></li>
													<li><?php esc_attr_e('Respond to any code review feedback.', 'hypermarket'); ?></li>
												</ol>
											</div><!-- .inside -->
										</div><!-- #contribute-sidebar -->
									</div><!-- .postbox -->
								</div><!-- .meta-box-sortables -->
							</div><!-- #postbox-container-1 .postbox-container -->
						</div><!-- #post-body .metabox-holder .columns-2 -->
					</div><!-- #poststuff -->
				</div><!-- .wrap -->
			<?php
		}
		/**
		 * Call for an admin notice upon successful activation.
		 *
		 * @since 1.0.5.1
		 */
		public function activation_admin_notice()

		{
			global $pagenow;
			if (current_user_can('manage_options') && isset($_GET['activated']) && $pagenow == 'themes.php'):
				add_action('admin_notices', array(
					$this,
					'welcome_admin_notice'
				) , 99);
			else:
				return;
			endif;
		}
		/**
		 * Admin notice welcome message markup.
		 *
		 * @since 1.0.3
		 */
		public function welcome_admin_notice()

		{
		?>
				<div id="hypermarket-welcome-message" class="notice notice-info is-dismissible">
					<p><strong><?php esc_attr_e('WooHoo! :)', 'hypermarket'); ?></strong></p>
					<p><?php esc_attr_e('Welcome to the Hypermarket theme! Clearly, you have impeccable taste in WooCommerce themes; we salute your fine choice!', 'hypermarket'); ?></p>
					<p>
						<a href="<?php echo esc_url(admin_url('themes.php?page=hypermarket-welcome-screen')); ?>" class="button-secondary"><?php esc_attr_e('Get the Tips', 'hypermarket'); ?></a>
						<?php if(apply_filters('hypermarket_are_you_still_free', true)): ?>
							&nbsp;<a href="<?php echo esc_url(admin_url('themes.php?page=hypermarket-welcome-screen&?tab=#goplus')); ?>" class="button-primary"><?php esc_attr_e('Go Plus!', 'hypermarket'); ?></a>
						<?php endif; ?>
					</p>
				</div>
			<?php
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.6
		 */
		public function enqueue()

		{
			wp_enqueue_style('hypermarket-welcome-screen-styles', $this->admin_assets_url . 'css/hypermarket-welcome-screen.css', array() , HypermarketThemeVersion);
			wp_enqueue_script('hypermarket-welcome-screen-scripts', $this->admin_assets_url . 'js/hypermarket-welcome-screen.js', array(
				'jquery'
			) , HypermarketThemeVersion, true);
		}
		/**
		 * Check if WooCommerce activated/installed or not?
		 *
		 * @since 1.0.7.0
		 */
		public function wc_installation_admin_notice() 

		{
			global $pagenow;
			global $current_user;
	        $user_id = $current_user->ID;
	        if (!hypermarket_is_woocommerce_activated() && !get_user_meta($user_id, 'hypermarket_install_woocommerce_notice_ignore') && $pagenow == 'themes.php'): 
	        	if(isset($_GET['page']) && $_GET['page'] === 'hypermarket-welcome-screen'):
		        	?>
		            <div class="notice notice-warning" style="position:relative;">
		                <p><strong><?php esc_html_e('Hypermarket is almost ready to help you start selling :)', 'hypermarket'); ?></strong></p>
		                <p><?php
		                $install_woocommerce_url = esc_url(admin_url('plugin-install.php?s=woocommerce&tab=search&type=term'));
		            printf(esc_html__('Install and activate %s to start your e-commerce website now!', 'hypermarket') , '<a href="' . $install_woocommerce_url . '" target="_self">WooCommerce</a>'); ?></p>
		                <a href="?hypermarket-install-woocommerce-ignore-notice&page=hypermarket-welcome-screen">
		                    <button class="notice-dismiss">
		                        <span class="screen-reader-text">
		                        	<?php esc_html_e('Dismiss this notice.', 'hypermarket'); ?>
		                        </span>
		                    </button>
		                </a>
		            </div>
		        <?php
		        endif;
	        endif;
		}
		/**
		 * Ignore notice, if user already dismissed WooCommerce activation/installation notice.
		 *
		 * @since 1.0.4
		 */
		public function wc_ignore_installation_admin_notice() 

		{
			global $current_user;
	        $user_id = $current_user->ID;
	        if (isset($_GET['hypermarket-install-woocommerce-ignore-notice'])) :
	            add_user_meta($user_id, 'hypermarket_install_woocommerce_notice_ignore', 'true', true);
	        endif;
		}
	}
endif;
return new Hypermarket_Welcome_Screen();