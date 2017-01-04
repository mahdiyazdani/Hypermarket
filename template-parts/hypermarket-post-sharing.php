<?php
/**
 * Displaying post sharing icons
 *
 * @package 		Hooked into "woocommerce_single_product_summary"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0
 */
global $post;
$post_title = wp_strip_all_tags( get_the_title($post->ID), false );
$post_permalink = hypermarket_sanitize_url( get_the_permalink($post->ID), false );
// Check if we are on single product page or not?
if(hypermarket_is_woocommerce_activated() && is_product()):
	$share_wrapper_class = 'product-share';
	$share_before_notice = __('Share this product:', 'hypermarket');
// Anywhere else...
else: 
	$share_wrapper_class = 'post-share';
	$share_before_notice = __('Share this post:', 'hypermarket');
endif;
?>
<div class="<?php echo $share_wrapper_class; ?>">
	<span><?php echo $share_before_notice; ?>&nbsp;</span>
	<div class="social-bar">
		<?php if( apply_filters('hypermarket_facebook_share_icon', true) ): ?>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo $post_permalink;?>&amp;t=<?php echo $post_title; ?>" title="<?php _e('Share on Facebook', 'hypermarket'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php _e('Facebook', 'hypermarket'); ?>">
				<i class="hypermarket-icon hypermarket-facebook-solid"></i>
			</a>
		<?php endif; ?>
		<?php if( apply_filters('hypermarket_google_plus_share_icon', true) ): ?>
			<a href="https://plus.google.com/share?url=<?php echo $post_permalink; ?>" onclick="javascript:window.open(this.href,
	  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php _e('Share on Google+', 'hypermarket'); ?>">
				<i class="hypermarket-icon hypermarket-google-plus-solid"></i>
			</a>
		<?php endif; ?>
		<?php if( apply_filters('hypermarket_twitter_share_icon', true) ): ?>
			<a href="http://twitter.com/home/?status=<?php echo $post_title; ?> - <?php echo $post_permalink; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php _e('Tweet this', 'hypermarket'); ?>">
				<i class="hypermarket-icon hypermarket-twitter-solid"></i>
			</a>
		<?php endif; ?>
		<?php if( apply_filters('hypermarket_linkedin_share_icon', true) ): ?>
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php echo $post_title; ?>&amp;url=<?php echo $post_permalink; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php _e('Share on LinkedIn', 'hypermarket'); ?>">
				<i class="hypermarket-icon hypermarket-linkedin-solid"></i>
			</a>
		<?php endif; ?>
		<?php if( apply_filters('hypermarket_stumbleupon_share_icon', true) ): ?>
			<a href="http://www.stumbleupon.com/submit?url=<?php echo $post_permalink; ?>&amp;title=<?php echo $post_title; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php _e('Stumble it', 'hypermarket'); ?>">
				<i class="hypermarket-icon hypermarket-stumbleupon-solid"></i>
			</a>
		<?php endif; ?>
	</div><!-- .social-bar -->
</div><!-- .product-share -->