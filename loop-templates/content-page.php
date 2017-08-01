<?php
/**
 * The template used for displaying page content in page.php and fluid width template.
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.9.0
 */
/**
 * Functions hooked into "hypermarket_before_single_page" action
 *
 * @hooked hypermarket_featured_image_single_page     - 10
 * @since 1.0.9.0
 */
do_action('hypermarket_before_single_page');
?>
<!-- Content -->
<section id="hypermarket-page-content" class="container<?php echo (apply_filters('hypermarket_fluid_template', false)) ? '-fluid' : ''; ?> padding-top-3x">
	<?php if (apply_filters('hypermarket_single_page_title', true)): ?>
	<h1 class="mobile-center"><?php the_title(); ?></h1>
	<?php endif; ?>
	<div id="page-<?php the_ID(); ?>" <?php post_class('row padding-top'); ?>>
		<?php
			/**
			 * Functions hooked into "hypermarket_before_single_page_content" action
			 *
			 * @hooked hypermarket_before_single_page_content_wrapper_start     - 20
			 * @since 1.0
			 */
			do_action('hypermarket_before_single_page_content');
			while (have_posts()):
				the_post();
				the_content();
				/**
				 * Functions hooked into "hypermarket_end_single_page_content" action
				 *
				 * @hooked hypermarket_single_page_paging     - 10
				 * @since 1.0.4.2
				 */
				do_action('hypermarket_end_single_page_content');
			endwhile;
			/**
			 * Functions hooked into "hypermarket_after_single_page_content" action
			 *
			 * @hooked hypermarket_after_single_page_content_wrapper_end       - 30
			 * @since 1.0
			 */
			do_action('hypermarket_after_single_page_content');
		?>
	</div><!-- .row -->
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ):
			comments_template();
		endif;
	?>
</section><!-- .container -->
