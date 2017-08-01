<?php
/**
 * The template used for displaying single post content in single.php
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.9.0
 */
/**
 * Functions hooked into "hypermarket_before_single_post" action
 *
 * @hooked hypermarket_featured_image_single_post     - 10
 * @since 1.0.9.0
 */
do_action('hypermarket_before_single_post');
?>
<!-- Content -->
<section id="hypermarket-post-content" class="container<?php echo (apply_filters('hypermarket_fluid_template', false)) ? '-fluid' : ''; ?> padding-top-3x">
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
						<?php
							/**
							 * Functions hooked into "hypermarket_end_single_post_content" action
							 *
							 * @hooked hypermarket_single_post_paging     - 10
							 * @since 1.0.4
							 */
							do_action('hypermarket_end_single_post_content');
						?>
						<hr>
						<div class="blog-post-meta">
							<div class="column">
								<span><?php esc_html_e('by', 'hypermarket'); ?> </span>
								<?php the_author_posts_link(); ?>
								<span class="divider"></span>
								<?php the_date(get_option('date_format')); ?>
								<?php 
									$get_categories = get_the_category();
									if( !empty( $get_categories ) ): 
								?>
									<span class="divider"></span>
									<span><?php esc_html_e('in', 'hypermarket'); ?> </span>
									<?php the_category(', '); ?>
								<?php endif; ?>
								<?php 
									$get_tags = get_the_tags();
									if( !empty( $get_tags ) ): 
								?>
									<span class="divider"></span>
									<?php the_tags('#', ' #', ''); ?>
								<?php endif; ?>
							</div><!-- .column -->
							<div class="column">
								<?php
									$is_comment_open = comments_open($post->ID);
									$num_comments = intval(get_comments_number());
									if(($is_comment_open && post_password_required() === false) || (!$is_comment_open && $num_comments >= 1)):
								?>
										<a href="#comments" class="single-comments-link scroll-to" target="_self">
										<i class="material-icons comment"></i>
											<?php echo ($num_comments >= 1) ? esc_html($num_comments) : ''; ?>
										</a><!-- .single-comments-link -->
								<?php endif; ?>
							</div><!-- .column -->
						</div><!-- .blog-post-meta -->
						<?php do_action('hypermarket_after_single_post_content'); ?>
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