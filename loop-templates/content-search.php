<?php
/**
 * The template for displaying search results pages.
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4.1
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
			echo '<h1 class="mobile-center">';
				printf( esc_html__( 'Search Results for: %s', 'hypermarket' ), '<span>' . get_search_query() . '</span>' );
			echo '</h1>';
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
						 * @hooked hypermarket_process_simple_like          - 20
						 * @hooked hypermarket_post_entry    			    - 30
						 * @since 1.0
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