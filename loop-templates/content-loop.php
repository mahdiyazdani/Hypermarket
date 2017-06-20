<?php
/**
 * The loop template file.
 * Included on pages like index.php, archive.php and search.php to display a loop of posts.
 *
 * @see 			http://codex.wordpress.org/The_Loop
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.6
 */
/**
 * Functions hooked into "hypermarket_before_loop_posts" action
 *
 * @hooked hypermarket_loop_posts_header_image             - 10
 * @since 1.0
 */
do_action('hypermarket_before_loop_posts');
?>
<!-- Content -->
<section class="container padding-top-3x">
		<?php 
			$get_posts_page = get_option('page_for_posts', true);
			if( !empty($get_posts_page) ):
				echo '<h1 class="mobile-center">' . get_the_title( get_option('page_for_posts', true) ) . '</h1>'; 
			endif;
			while (have_posts()):
				the_post();
		?>
				<!-- Post -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('row padding-top paddin-bottom hypermarket-post-loop'); ?>>
					<?php 
						/**
						 * Functions hooked into "hypermarket_loop_posts" action
						 *
						 * @hooked hypermarket_post_meta                    - 10
						 * @hooked hypermarket_post_entry    			    - 30
						 * @since 1.0.6
						 */
						do_action('hypermarket_loop_posts');
					?>
				</article><!-- #post-<?php the_ID(); ?> -->
				<hr>
		<?php 
			endwhile; 
			/**
			 * Functions hooked into "hypermarket_loop_posts_paging_navigation" action
			 *
			 * @hooked hypermarket_paging_navigation                       - 10
			 * @since 1.0
			 */
			do_action('hypermarket_loop_posts_paging_navigation');
		?>
</section><!-- .container -->