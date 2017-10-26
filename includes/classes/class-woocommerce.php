<?php
/**
 * WooCommerce Compatibility File.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.3.8
 */
if (!defined('ABSPATH')):
	exit;
endif;
if (!class_exists('Hypermarket_WooCommerce')):
	/**
	 * Hypermarket WooCommerce Integration
	 */
	class Hypermarket_WooCommerce

	{
		/**
		 * Setup class.
		 *
		 * @since 1.0.6.3
		 */
		public function __construct()

		{
			add_filter('woocommerce_get_image_size_shop_single', array(
				$this,
				'single_image_dimensions'
			) , 10, 1);
			add_filter('woocommerce_get_image_size_shop_catalog', array(
				$this,
				'catalog_image_dimensions'
			) , 10, 1);
			add_filter('woocommerce_get_image_size_shop_thumbnail', array(
				$this,
				'thumbnail_image_dimensions'
			) , 10, 1);
			add_filter('loop_shop_columns', array(
				$this,
				'loop_columns'
			) , 10);
			add_filter('body_class', array(
				$this,
				'body_class'
			) , 10);
			add_filter('woocommerce_enqueue_styles', 
				'__return_empty_array'
			, 10);
			add_filter('woocommerce_output_related_products_args', array(
				$this,
				'related_products_args'
			) , 10);
			add_filter('woocommerce_product_thumbnails_columns', array(
				$this,
				'thumbnail_columns'
			) , 10);
			add_filter('loop_shop_per_page', array(
				$this,
				'products_per_page'
			) , 10);
			add_filter('get_product_search_form', array(
				$this,
				'custom_product_search_form'
			) , 10, 1);
			add_filter('woocommerce_product_description_heading', array(
				$this,
				'remove_product_description_heading'
			) , 10);
			add_filter('woocommerce_product_review_comment_form_args', array(
				$this,
				'review_comment_form_args'
			) , 10, 1);
			add_filter('woocommerce_checkout_fields', array(
				$this,
				'billing_checkout_order_fields'
			) , 10, 1);
			add_filter('woocommerce_checkout_fields', array(
				$this,
				'shipping_checkout_order_fields'
			) , 10, 1);
			add_filter('woocommerce_checkout_fields', array(
				$this,
				'override_checkout_fields'
			) , 10, 1);
			add_filter('woocommerce_default_address_fields', array(
				$this,
				'override_default_address_fields'
			) , 10, 1);
			add_filter('woocommerce_billing_fields', array(
				$this,
				'override_default_billing_address_fields'
			) , 10, 1);
			add_filter('theme_page_templates', array(
				$this,
				'reenable_page_template_for_shop'
			) , 11, 3);
			add_filter('wc_empty_cart_message', array(
				$this,
				'empty_cart_message'
			) , 10, 1);
		}
		/**
		 * Using appropriate image dimensions to avoid pixellation.
		 * Single product image
		 *
		 * @since 1.0.5.1
		 */
		public function single_image_dimensions(array $single = array())

		{
			$single = apply_filters('hypermarket_single_image_dimensions', array(
				'width' => '954', // px
				'height' => '782', // px
				'crop' => 1 // true
			));
			return $single;
		}
		/**
		 * Using appropriate image dimensions to avoid pixellation.
		 * Catalog product image(s)
		 *
		 * @since 1.0.5.1
		 */
		public function catalog_image_dimensions(array $catalog = array())

		{
			$catalog = apply_filters('hypermarket_catalog_image_dimensions', array(
				'width' => '500', // px
				'height' => '455', // px
				'crop' => 1 // true
			));
			return $catalog;
		}
		/**
		 * Using appropriate image dimensions to avoid pixellation.
		 * Thumbnail product image(s)
		 *
		 * @since 1.0.5.1
		 */
		public function thumbnail_image_dimensions(array $thumbnail = array())

		{
			$thumbnail = apply_filters('hypermarket_thumbnail_image_dimensions', array(
				'width' => '160', // px
				'height' => '131', // px
				'crop' => 1 // true
			));
			return $thumbnail;
		}
		/**
		 * Default loop columns on product archives (Shop).
		 *
		 * @since 1.0.0
		 */
		public function loop_columns()

		{
			return apply_filters('hypermarket_woocommerce_loop_columns', 3);
		}
		/**
		 * Add 'hypermarket-woocommerce-running' class to the body tag.
		 *
		 * @since 1.0.0
		 */
		public function body_class($classes)

		{
			if (hypermarket_is_woocommerce_activated()):
				$classes[] = 'hypermarket-woocommerce-running';
			endif;
			return $classes;
		}
		/**
		 * Related Products Args.
		 *
		 * @since 1.0.0
		 */
		public function related_products_args($args)

		{
			$args = apply_filters('hypermarket_related_products_args', array(
				'posts_per_page' => 4,
				'columns' => 4
			));
			return $args;
		}
		/**
		 * Product gallery thumnail columns on single product page.
		 *
		 * @since 1.0.0
		 */
		public function thumbnail_columns()

		{
			return intval(apply_filters('hypermarket_product_thumbnail_columns', 4));
		}
		/**
		 * Products per page on product archives (Shop).
		 *
		 * @since 1.0.0
		 */
		public function products_per_page()

		{
			return intval(apply_filters('hypermarket_products_per_page', 12));
		}
		/**
		 * Customize WooCommerce Products Search Form
		 *
		 * @since 1.0.9.0
		 */
		public function custom_product_search_form($form)

		{
			$form = '<form method="get" id="searchform" action="' . esc_url(home_url('/')) . '" class="search-box">
			<label class="screen-reader-text" for="s">' . esc_html__('Search for:', 'hypermarket') . '</label>
			<input name="s" id="s" type="text" class="form-control" value="' . get_search_query() . '" required="required" placeholder="' . esc_html__('Type and hit enter', 'hypermarket') . '" />
			<input type="hidden" name="post_type" value="product" />
			<button type="submit">
				<i class="material-icons search"></i>
			</button>
			</form>';
			return $form;
		}
		/**
		 * Remove product description heading text
		 *
		 * @since 1.0.0
		 */
		public function remove_product_description_heading()

		{
			return false;
		}
		/**
		 * The template for displaying review comment form.
		 *
		 * @link http://hookr.io/filters/woocommerce_product_review_comment_form_args/
		 * @since 1.0.0
		 */
		public function review_comment_form_args($comment_form)

		{
			$commenter = wp_get_current_commenter();
			$comment_form['title_reply'] = have_comments() ? __('Leave a review', 'hypermarket') : sprintf(__('Be the first to review &ldquo;%s&rdquo;', 'hypermarket') , get_the_title());
			$comment_form['comment_notes_before'] = '';
			$comment_form['title_reply_before'] = '<!-- Review Form --><h4 class="padding-top">';
			$comment_form['title_reply_after'] = '</h4>';
			$comment_form['class_form'] = 'row padding-top';
			// Name Field
			$comment_form['fields']['author'] = '<div class="col-sm-4"><div class="form-element"><label for="author" class="screen-reader-text">' . __('Name', 'hypermarket') . '</label><input id="author" name="author" type="text" class="form-control" required="required" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . __('Name*', 'hypermarket') . '" /></div></div>';
			// Email Field
			$comment_form['fields']['email'] = '<div class="col-sm-4"><div class="form-element"><label for="email" class="screen-reader-text">' . __('Email', 'hypermarket') . '</label><input id="email" name="email" type="email" class="form-control" required="required" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . __('Email*', 'hypermarket') . '" /></div></div>';
			// Stars
			if (get_option('woocommerce_enable_review_rating') === 'yes'):
				$comment_form['comment_field'] = '<div class="col-sm-4"><div class="form-element form-select"><p class="comment-form-rating"><label for="rating" class="screen-reader-text">' . __('Your Rating', 'hypermarket') . '</label><select name="rating" id="rating" aria-required="true" class="form-control" required="required">
                    <option value="">' . __('Rate*', 'hypermarket') . '</option>
                    <option value="5">' . __('Perfect', 'hypermarket') . '</option>
                    <option value="4">' . __('Good', 'hypermarket') . '</option>
                    <option value="3">' . __('Average', 'hypermarket') . '</option>
                    <option value="2">' . __('Not that bad', 'hypermarket') . '</option>
                    <option value="1">' . __('Very poor', 'hypermarket') . '</option>
                </select></div></div>';
			endif;
			// Review Field
			$comment_form['comment_field'].= '<div class="col-sm-12"><div class="form-element"><label for="comment" class="screen-reader-text">' . __('Comment', 'hypermarket') . '</label><textarea id="comment" name="comment" class="form-control" rows="8" required="required" placeholder="' . __('Review*', 'hypermarket') . '"></textarea></div></div>';
			$comment_form['class_submit'] = 'btn btn-block btn-primary space-top-none space-bottom-none';
			$comment_form['label_submit'] = __('Leave Review', 'hypermarket');
			return $comment_form;
		}
		/**
		 * Reorder billing fields in WooCommerce Checkout template.
		 * $fields is passed via the filter!
		 *
		 * @since 1.0.0
		 */
		public function billing_checkout_order_fields($fields)

		{
			$order = array(
				'billing_first_name',
				'billing_last_name',
				'billing_email',
				'billing_phone',
				'billing_address_1',
				'billing_address_2',
				'billing_company',
				'billing_country',
				'billing_state',
				'billing_city',
				'billing_postcode'
			);
			foreach($order as $field):
				$ordered_fields[$field] = $fields['billing'][$field];
			endforeach;
			$fields['billing'] = $ordered_fields;
			return $fields;
		}
		/**
		 * Reorder shipping fields in WooCommerce Checkout template.
		 * $fields is passed via the filter!
		 *
		 * @since 1.0.0
		 */
		public function shipping_checkout_order_fields($fields)

		{
			$order = array(
				'shipping_first_name',
				'shipping_last_name',
				'shipping_address_1',
				'shipping_address_2',
				'shipping_company',
				'shipping_country',
				'shipping_state',
				'shipping_city',
				'shipping_postcode'
			);
			foreach($order as $field):
				$ordered_fields[$field] = $fields['shipping'][$field];
			endforeach;
			$fields['shipping'] = $ordered_fields;
			return $fields;
		}
		/**
		 * Customize shipping and billing fields.
		 * $fields is passed via the filter!
		 *
		 * @since 1.3.8
		 */
		public function override_checkout_fields($fields)

		{
			// First name
			$fields['billing']['billing_first_name']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_first_name']['placeholder'] = _x('First name*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_first_name']['class'] = array(
				'col-sm-6 form-element'
			);
			// Last name
			$fields['billing']['billing_last_name']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_last_name']['placeholder'] = _x('Last name*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_last_name']['class'] = array(
				'col-sm-6 form-element'
			);
			// Email
			$fields['billing']['billing_email']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_email']['placeholder'] = _x('Email*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_email']['required'] = true;
			$fields['billing']['billing_email']['class'] = array(
				'col-sm-6 form-element'
			);
			// Phone
			$fields['billing']['billing_phone']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_phone']['placeholder'] = _x('Phone*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_phone']['required'] = true;
			$fields['billing']['billing_phone']['class'] = array(
				'col-sm-6 form-element'
			);
			// Address 1
			$fields['billing']['billing_address_1']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_address_1']['placeholder'] = _x('Address 1*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_address_1']['class'] = array(
				'col-sm-6 form-element'
			);
			// Address 2
			$fields['billing']['billing_address_2']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_address_2']['placeholder'] = _x('Address 2', 'placeholder', 'hypermarket');
			$fields['billing']['billing_address_2']['class'] = array(
				'col-sm-6 form-element'
			);
			// Company
			$fields['billing']['billing_company']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_company']['placeholder'] = _x('Company', 'placeholder', 'hypermarket');
			$fields['billing']['billing_company']['class'] = array(
				'col-sm-12 form-element'
			);
			// Country
			$fields['billing']['billing_country']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_country']['placeholder'] = _x('Country*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_country']['class'] = array(
				'col-sm-6 form-element'
			);
			// State
			$fields['billing']['billing_state']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_state']['placeholder'] = _x('State*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_state']['class'] = array(
				'col-sm-6 form-element'
			);
			// Zip code
			$fields['billing']['billing_postcode']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_postcode']['placeholder'] = _x('ZIP code*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_postcode']['class'] = array(
				'col-sm-6 form-element'
			);
			// City
			$fields['billing']['billing_city']['label_class'] = array(
				'sr-only'
			);
			$fields['billing']['billing_city']['placeholder'] = _x('City*', 'placeholder', 'hypermarket');
			$fields['billing']['billing_city']['class'] = array(
				'col-sm-6 form-element'
			);
			// First name
			$fields['shipping']['shipping_first_name']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_first_name']['placeholder'] = _x('First name*', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_first_name']['class'] = array(
				'col-sm-6 form-element'
			);
			// Last name
			$fields['shipping']['shipping_last_name']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_last_name']['placeholder'] = _x('Last name*', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_last_name']['class'] = array(
				'col-sm-6 form-element'
			);
			// Address 1
			$fields['shipping']['shipping_address_1']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_address_1']['placeholder'] = _x('Address 1*', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_address_1']['class'] = array(
				'col-sm-6 form-element'
			);
			// Address 2
			$fields['shipping']['shipping_address_2']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_address_2']['placeholder'] = _x('Address 2', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_address_2']['class'] = array(
				'col-sm-6 form-element'
			);
			// Company
			$fields['shipping']['shipping_company']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_company']['placeholder'] = _x('Company', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_company']['class'] = array(
				'col-sm-12 form-element'
			);
			// Country
			$fields['shipping']['shipping_country']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_country']['placeholder'] = _x('Country*', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_country']['class'] = array(
				'col-sm-6 form-element'
			);
			// State
			$fields['shipping']['shipping_state']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_state']['placeholder'] = _x('State*', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_state']['class'] = array(
				'col-sm-6 form-element'
			);
			// Zip code
			$fields['shipping']['shipping_postcode']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_postcode']['placeholder'] = _x('ZIP code*', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_postcode']['class'] = array(
				'col-sm-6 form-element'
			);
			// City
			$fields['shipping']['shipping_city']['label_class'] = array(
				'sr-only'
			);
			$fields['shipping']['shipping_city']['placeholder'] = _x('City*', 'placeholder', 'hypermarket');
			$fields['shipping']['shipping_city']['class'] = array(
				'col-sm-6 form-element'
			);
			// Order
			$fields['order']['order_comments']['label_class'] = array(
				'sr-only'
			);
			$fields['order']['order_comments']['class'] = array(
				'col-sm-12 form-element'
			);
			// Username
			$fields['account']['account_username']['label_class'] = array(
				'sr-only'
			);
			$fields['account']['account_username']['placeholder'] = _x('Username*', 'placeholder', 'hypermarket');
			if (! is_checkout()):
				$fields['account']['account_username']['class'] = array(
					'col-sm-12 form-element'
				);
			else:
				$fields['account']['account_username']['class'] = array(
					'col-sm-6 form-element'
				);
			endif;
			// Password
			$fields['account']['account_password']['label_class'] = array(
				'sr-only'
			);
			$fields['account']['account_password']['placeholder'] = _x('Password*', 'placeholder', 'hypermarket');
			$fields['account']['account_password']['class'] = array(
				'col-sm-6 form-element'
			);
			if (! is_checkout()):
				// Password 2
				$fields['account']['account_password-2']['label_class'] = array(
					'sr-only'
				);
				$fields['account']['account_password-2']['placeholder'] = _x('Confirm password*', 'placeholder', 'hypermarket');
				$fields['account']['account_password-2']['class'] = array(
					'col-sm-6 form-element'
				);
			endif;
			return $fields;
		}
		/**
		 * Customize shipping and billing fields in edit address page(s).
		 * $fields is passed via the filter!
		 * billing_email & billing_phone hooked into "woocommerce_billing_fields"
		 * 
		 * @since 1.0.4
		 */
		public function override_default_address_fields($fields)

		{
			// First name
			$fields['first_name']['label_class'] = array(
				'sr-only'
			);
			$fields['first_name']['placeholder'] = _x('First name*', 'placeholder', 'hypermarket');
			$fields['first_name']['class'] = array(
				'col-sm-6 form-element'
			);
			// Last name
			$fields['last_name']['label_class'] = array(
				'sr-only'
			);
			$fields['last_name']['placeholder'] = _x('Last name*', 'placeholder', 'hypermarket');
			$fields['last_name']['class'] = array(
				'col-sm-6 form-element'
			);
			// Address 1
			$fields['address_1']['label_class'] = array(
				'sr-only'
			);
			$fields['address_1']['placeholder'] = _x('Address 1*', 'placeholder', 'hypermarket');
			$fields['address_1']['class'] = array(
				'col-sm-6 form-element'
			);
			// Address 2
			$fields['address_2']['label_class'] = array(
				'sr-only'
			);
			$fields['address_2']['placeholder'] = _x('Address 2', 'placeholder', 'hypermarket');
			$fields['address_2']['class'] = array(
				'col-sm-6 form-element'
			);
			// Company
			$fields['company']['label_class'] = array(
				'sr-only'
			);
			$fields['company']['placeholder'] = _x('Company', 'placeholder', 'hypermarket');
			$fields['company']['class'] = array(
				'col-sm-12 form-element'
			);
			// Country
			$fields['country']['label_class'] = array(
				'sr-only'
			);
			$fields['country']['placeholder'] = _x('Country*', 'placeholder', 'hypermarket');
			$fields['country']['class'] = array(
				'col-sm-6 form-element'
			);
			// State
			$fields['state']['label_class'] = array(
				'sr-only'
			);
			$fields['state']['placeholder'] = _x('State*', 'placeholder', 'hypermarket');
			$fields['state']['class'] = array(
				'col-sm-6 form-element'
			);
			// Zip code
			$fields['postcode']['label_class'] = array(
				'sr-only'
			);
			$fields['postcode']['placeholder'] = _x('ZIP code*', 'placeholder', 'hypermarket');
			$fields['postcode']['class'] = array(
				'col-sm-6 form-element'
			);
			// City
			$fields['city']['label_class'] = array(
				'sr-only'
			);
			$fields['city']['placeholder'] = _x('City*', 'placeholder', 'hypermarket');
			$fields['city']['class'] = array(
				'col-sm-6 form-element'
			);
			return $fields;
		}
		/**
		 * Customize billing fields in edit address page(s).
		 * $fields is passed via the filter!
		 *
		 * @since 1.0.4
		 */
		public function override_default_billing_address_fields($fields)

		{
			// Email
			$fields['billing_email']['label_class'] = array(
				'sr-only'
			);
			$fields['billing_email']['placeholder'] = _x('Email*', 'placeholder', 'hypermarket');
			$fields['billing_email']['required'] = true;
			$fields['billing_email']['class'] = array(
				'col-sm-6 form-element'
			);
			// Phone
			$fields['billing_phone']['label_class'] = array(
				'sr-only'
			);
			$fields['billing_phone']['placeholder'] = _x('Phone*', 'placeholder', 'hypermarket');
			$fields['billing_email']['required'] = true;
			$fields['billing_phone']['class'] = array(
				'col-sm-6 form-element'
			);
			return $fields;
		}
		/**
		 * Re-enable template selection for the Shop page
		 *
		 * @since 1.0.4
		 */
		public function reenable_page_template_for_shop($page_templates, $class, $post)

		{
			$shop_page_id = wc_get_page_id('shop');
			if ($post && absint($shop_page_id) === absint($post->ID)):
				$page_templates['page-templates/template-fluid.php'] = 'Fluid Template';
			endif;
			return $page_templates;
		}
		/**
		 * Modify empty cart notice
		 *
		 * @since 1.0.6.3
		 */
		public function empty_cart_message($notice)

		{
			$output = '<p class="cart-empty">';
			$output.= esc_html__( 'Most likely, you just have not put anything into your basket.', 'hypermarket' );
			$output.= '</p>';
			return $output;
		}
	}
endif;
return new Hypermarket_WooCommerce();