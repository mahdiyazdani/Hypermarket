<?php
/**
 * Displaying featured image or user avatar in my account page.
 *
 * @package 		Hooked into "hypermarket_featured_image_single_page"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0
 */
if (hypermarket_is_woocommerce_activated() && is_account_page() && is_user_logged_in() && ! has_post_thumbnail()):
	echo '<!-- Featured Background -->';
	$current_user = wp_get_current_user();
	echo '<div class="featured-background">';
	echo get_avatar( $current_user->user_email, 320, '', $current_user->display_name );
	echo '</div><!-- .featured-background -->';
else:
	if(has_post_thumbnail()):
		global $post;
		echo '<!-- Featured Image -->';
		echo '<div class="featured-image data-background" data-background="' . wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' )[0] . '"></div><!-- .featured-image -->';
	endif;
endif;