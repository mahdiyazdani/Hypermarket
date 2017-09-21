<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the .page-wrapper div and all content after
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.2
 */
		do_action('hypermarket_before_footer_area');
		/**
		 * Functions hooked into "hypermarket_footer_area" action
		 *
		 * @hooked hypermarket_footer_wrapper_start	    - 10
		 * @hooked hypermarket_footer_widget_areas  	- 20
		 * @hooked hypermarket_footer_wrapper_end       - 30
		 * @since 1.0.1
		 */
		do_action('hypermarket_footer_area');

		do_action('hypermarket_after_footer_area');
		?>
		</div><!-- .page-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>