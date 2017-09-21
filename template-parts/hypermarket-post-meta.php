<?php
/**
 * Display the post meta.
 *
 * @package 		Hooked into "hypermarket_loop_posts"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.3.0
 */
?>
<div class="col-md-3 col-sm-4">
	<?php 
	//Exclude publish date and author name from static pages.
	if(get_post_type() === 'post'): 
	?>
	<div class="blog-post-meta">
		<div class="column">
			<span><?php esc_html_e('by', 'hypermarket'); ?> </span>
			<?php the_author_posts_link(); ?>
			<span class="divider"></span>
			<?php echo get_the_date(get_option('date_format')); ?>
		</div><!-- .column -->
		<div class="column">
			<?php
			$is_comment_open = comments_open($post->ID);
			$num_comments = intval(get_comments_number());
			if(($is_comment_open && post_password_required() === false) || (!$is_comment_open && $num_comments >= 1)):
			?>
				<a href="<?php echo esc_url(get_comments_link($post->ID)); ?>" class="comments-link" target="_self">
				<i class="material-icons comment"></i>
					<?php echo ($num_comments >= 1) ? esc_html($num_comments) : ''; ?>
				</a><!-- .comments-link -->
			<?php endif; ?>
		</div><!-- .column -->
	</div><!-- .blog-post-meta -->
	<?php endif; ?>
	<h2 class="blog-post-title">
		<a href="<?php the_permalink(); ?>" class="<?php echo apply_filters('hypermarket_post_title_cls', ''); ?>" target="_self" data-postid="<?php the_ID(); ?>"><?php the_title(); ?></a>
		<?php 
		if(is_sticky()):
			echo '<small class="sticky-badge">' . esc_html__('(Sticky)', 'hypermarket') . '</small>';
		endif;
		?>
	</h2><!-- .blog-post-title -->
</div><!-- .col-md-3 -->