<?php
/**
 * Displaying Footer widget areas.
 *
 * @package 		Hooked into "hypermarket_footer_area"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.1
 */
if (is_active_sidebar('footer-3')):
	$widget_columns = apply_filters('hypermarket_footer_widget_areas', 3);
elseif (is_active_sidebar('footer-2')):
	$widget_columns = apply_filters('hypermarket_footer_widget_areas', 2);
elseif (is_active_sidebar('footer-1')):
	$widget_columns = apply_filters('hypermarket_footer_widget_areas', 1);
else:
	$widget_columns = apply_filters('hypermarket_footer_widget_areas', 0);
endif;
for ($counter = 0; $counter <= $widget_columns; $counter++):
	if (is_active_sidebar('footer-' . $counter)):
		echo '<div class="column">' . PHP_EOL;
		dynamic_sidebar('footer-' . intval($counter));
		if($counter == 1):
			echo '<p class="copyright space-top"><span>' . apply_filters('hypermarket_copyright_text', $content = '&copy; ' . get_bloginfo('name') . ' ' . date('Y')) . '</span>';
			if( apply_filters( 'hypermarket_credit_link', true ) ):
				// You `HAVE` to keep this credit link. We really do appreciate it ;)
				printf(esc_attr__(' | Get %1$s for free.', 'hypermarket') , '<a href="' . esc_url( HypermarketThemeURI ) . '" rel="author" target="_blank">' . HypermarketThemeName . '</a>');
			endif;
			echo '</p>' . PHP_EOL;
		endif;
		if($counter == $widget_columns):
			echo '<!-- Scroll To Top Button --><div class="scroll-to-top-btn"><i class="material-icons trending_flat"></i></div>' . PHP_EOL;
		endif;
		echo '</div><!-- .column -->' . PHP_EOL;
	endif;
endfor;