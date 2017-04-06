<?php
/**
 * Displaying Footer widget areas.
 *
 * @package 		Hooked into "hypermarket_footer_area"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4
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
		echo '<div class="column">';
		dynamic_sidebar('footer-' . intval($counter));
		if($counter == 1):
			hypermarket_credits();
		endif;
		if($counter == $widget_columns):
			hypermarket_scroll_top();
		endif;
		echo '</div><!-- .column -->';
	endif;
endfor;
if($widget_columns === 0):
	echo '<div class="column">';
		hypermarket_credits();
		hypermarket_scroll_top();
	echo '</div><!-- .column -->';
endif;