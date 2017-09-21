<?php
/**
 * Displaying featured image or user gravatar in my account page.
 *
 * @package 		Hooked into "hypermarket_featured_image_single_page"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.3.0
 */
if (hypermarket_is_woocommerce_activated() && is_account_page() && is_user_logged_in() && ! has_post_thumbnail()):
	$current_user = wp_get_current_user();
	echo '<!-- Featured Background --><div class="featured-background">';
	echo get_avatar($current_user->user_email, 320, '', $current_user->display_name);
	echo '</div><!-- .featured-background -->';
elseif (hypermarket_is_woocommerce_activated() && is_shop()):
	$get_shop_page_featured_image_url = get_the_post_thumbnail_url(get_option('woocommerce_shop_page_id'));
	if (!empty($get_shop_page_featured_image_url)):
		echo '<!-- Featured Image --><div class="featured-image data-background" data-background="' . esc_url(get_the_post_thumbnail_url(get_option('woocommerce_shop_page_id'))) . '"></div><!-- .featured-image -->';
	endif;
else:
	if (has_post_thumbnail()):
		global $post;
		$image_id = get_post_thumbnail_id($post->ID);
		echo '<!-- Featured Image --><div class="featured-image data-background" data-background="' . esc_url(wp_get_attachment_image_url($image_id, 'full')) . '"></div><!-- .featured-image -->';
	endif;
endif;