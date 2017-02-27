<?php
/**
 * The template used for displaying single post content in single.php
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.3
 */
/**
 * Functions hooked into "hypermarket_featured_image_single_post" action
 *
 * @hooked hypermarket_featured_image_background_single_post        - 10
 * @since 1.0
 */
do_action('hypermarket_featured_image_single_post');
?>
<!-- Content -->
<section class="container padding-top-3x">
	<h1 class="mobile-center"><?php the_title(); ?></h1>
		<?php
			while (have_posts()):
				the_post();
		?>
				<!-- Post -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('row padding-top paddin-bottom'); ?>>
					<div class="col-sm-12">
						<?php do_action('hypermarket_before_single_post_content'); ?>
						<?php the_content(); ?>
						<hr>
						<div class="blog-post-meta">
							<div class="column">
								<span><?php _e('by', 'hypermarket'); ?> </span>
								<?php the_author_posts_link(); ?>
								<span class="divider"></span>
								<?php the_date('j F', '', '', true); ?>
								<?php if( !empty(get_the_category()) ): ?>
									<span class="divider"></span>
									<span><?php _e('in', 'hypermarket'); ?> </span>
									<?php the_category(', '); ?>
								<?php endif; ?>
								<?php if( !empty(get_the_tags()) ): ?>
									<span class="divider"></span>
									<?php the_tags('#', ' #', ''); ?>
								<?php endif; ?>
							</div><!-- .column -->
							<div class="column">
								<?php echo hypermarket_get_simple_likes_button( $post->ID ); ?>
							</div><!-- .column -->
						</div><!-- .blog-post-meta -->
						<?php 
							/**
							 * Functions hooked into "hypermarket_after_single_post_content" action
							 *
							 * @hooked hypermarket_post_sharing        - 20
							 * @since 1.0
							 */
							do_action('hypermarket_after_single_post_content'); 
						?>
  					</div><!-- .col-sm-12 -->
				</article><!-- #post-<?php the_ID(); ?> -->
		<?php 
			endwhile;
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ):
				comments_template();
			endif;
		?>
</section><!-- .container -->