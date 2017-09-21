<?php
/**
 * Display the post entry.
 *
 * @package 		Hooked into "hypermarket_loop_posts"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.3.0
 */
?>
<div class="col-md-offset-1 col-sm-8">
	<?php
	// Check for featured image toggle which may come via Ajax Post module
	$featured_image_status = false;
	if(apply_filters('hypermarket_ajax_post_featured_image_toggle', false) === true):
		$featured_image_status = get_post_meta($post->ID, '_hypermarket_ajax_post_featured_image_toggle', false);
		if(is_array($featured_image_status) && isset($featured_image_status) && !empty($featured_image_status)):
			$featured_image_status = true;
		endif;
	endif;
	if (has_post_thumbnail() && !$featured_image_status):
		the_post_thumbnail('large', array('class' => 'space-bottom'));
	endif;
	do_action('hypermarket_archive_featured_image');
	if (strpos(get_the_content(), 'more-link') === false):
		the_excerpt();
	else:
		the_content('');
	endif;
	?>
	<div class="blog-post-meta space-top">
		<div class="column">
			<?php 
			$get_categories = get_the_category();
			if(! empty($get_categories)): 
			?>
				<span><?php esc_html_e('in', 'hypermarket'); ?> </span>
			<?php 
				the_category(', ');
			endif;
			$get_tags = get_the_tags();
			if(! empty($get_tags)): 
			?>
				<span class="divider"></span>
				<?php the_tags('#', ' #', ''); ?>
			<?php endif; ?>
		</div><!-- .column -->
		<div class="column">
			<a href="<?php the_permalink(); ?>" target="_self" class="<?php echo esc_html(apply_filters('hypermarket_post_readmore_cls', 'read-more')); ?>" data-postid="<?php the_ID(); ?>">
				<?php esc_html_e('Read More', 'hypermarket'); ?>
			</a><!-- .read-more -->
		</div><!-- .column -->
	</div><!-- .blog-post-meta -->
</div><!-- .col-sm-8 -->