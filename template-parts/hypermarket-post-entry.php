<?php
/**
 * Display the post entry.
 *
 * @package 		Hooked into "hypermarket_loop_posts"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0
 */
?>
<div class="col-md-offset-1 col-sm-8">
	<?php
		if (has_post_thumbnail()):
			the_post_thumbnail( 'large', array( 'class' => 'space-bottom' ) );
		endif;
		if ( strpos( get_the_content(), 'more-link' ) === false ):
			the_excerpt();
		else:
			the_content( '' );
		endif;
	?>
	<div class="blog-post-meta space-top">
		<div class="column">
			<span><?php _e('in', 'hypermarket'); ?> </span>
			<?php the_category(', '); ?>
			<?php if( !empty( get_the_tags() ) ): ?>
				<span class="divider"></span>
				<?php the_tags('#', ' #', ''); ?>
			<?php endif; ?>
		</div><!-- .column -->
		<div class="column">
			<a href="<?php the_permalink(); ?>" target="_self" class="read-more">
				<?php _e('Read More', 'hypermarket'); ?>
			</a><!-- .read-more -->
		</div><!-- .column -->
	</div><!-- .blog-post-meta -->
</div><!-- .col-sm-8 -->