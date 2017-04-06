<?php
/**
 * Displaying homepage content.
 *
 * @package 	Hooked into "hypermarket_homepage_template"
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.3
 */
if (have_posts() &&  '' !== get_post()->post_content):
?>
<!-- Homepage Content -->
<section id="hypermarket-content" class="container padding-top-2x padding-bottom-2x">
	<?php 
		if(hypermarket_is_woocommerce_activated()):
			echo '<hr>';
			echo wp_kses_post( hypermarket_do_shortcode( 'woocommerce_messages' ) );
		endif;
		if( apply_filters('hypermarket_homepage_page_title', true) ): 
			echo '<h3 class="text-center padding-top-2x">' . get_the_title() . '</h3>';
		endif;
	?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('row padding-top'); ?>>
		<div class="col-sm-12">
			<?php
				while (have_posts()):
					the_post();
					the_content();
				endwhile;
			?>
		</div><!-- .col-sm-12 -->
	</div><!-- .row -->
</section><!-- .container -->
<?php endif; ?>