<?php
/**
 * Displaying navigation to next/previous set of posts / products when applicable.
 *
 * @package 		Hooked into "hypermarket_loop_posts_paging_navigation"
 * @package 		Hooked into "woocommerce_after_shop_loop"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0
 */
global $wp_query;
?>
<!-- Pagination -->
<div class="pagination hypermarket-pagination">
	<div class="page-numbers">
		<?php
			$big = 999999999; // need an unlikely integer
			$page_numbers = paginate_links(array(
				'base' => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ) ,
				'format' => '?paged=%#%',
				'type' => 'array',
				'prev_next' => false,
				'current' => max(1, get_query_var('paged')) ,
				'total' => $wp_query->max_num_pages,
				'prev_text' => '',
				'next_text' => '',
				'before_page_number' => '',
				'after_page_number' => ''
			));
			if (is_array($page_numbers)):
				do_action('hypermarket_before_paging_navigation');
				foreach($page_numbers as $page_number):
					echo $page_number;
				endforeach;
				do_action('hypermarket_after_paging_navigation');
			endif;
		?>
	</div><!-- .page-numbers -->
	<?php if(is_array($page_numbers)): ?>
		<div class="pager">
			<?php
				if(! empty(get_previous_posts_link())):
					previous_posts_link(__('Prev', 'hypermarket'));
				else:
					echo '<a href="#" class="current">' . __('Prev', 'hypermarket') . '</a>' . PHP_EOL;
				endif;
			?>
			<span>|</span>
			<?php 
				if(! empty(get_next_posts_link())):
					next_posts_link(__('Next', 'hypermarket'));
				else:
					echo '<a href="#" class="current">' . __('Next', 'hypermarket') . '</a>' . PHP_EOL;
				endif;
			?>
		</div><!-- .pager -->
	<?php endif; ?>
</div><!-- .pagination -->