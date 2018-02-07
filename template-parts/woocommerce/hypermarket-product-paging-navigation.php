<?php
/**
 * Displaying navigation to next/previous set of products when applicable.
 *
 * @package 		Hooked into "hypermarket_product_paging_navigation"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.1.1
 */
$prev_single_product = get_previous_post();
$next_single_product = get_next_post();
if (apply_filters('hypermarket_toggle_single_prodcut_paging', true)):
?>
<!-- Page Navigation -->
<?php if( ! empty($prev_single_product) ): ?>
	<a href="<?php echo esc_url(get_permalink($prev_single_product->ID)); ?>" class="page-nav page-prev" target="_self">
		<span class="page-preview">
		<?php if (has_post_thumbnail( $prev_single_product->ID ) ): ?>
			<img src="<?php echo esc_url(wp_get_attachment_image_src( get_post_thumbnail_id( $prev_single_product->ID ), 'full' )[0]); ?>" alt="<?php echo esc_attr($prev_single_product->post_title); ?>" />
		<?php endif; ?>
		</span><!-- .page-preview -->
		&mdash;&nbsp;<?php echo esc_html($prev_single_product->post_title); ?>
	</a><!-- .page-prev -->
<?php endif; ?>
<?php if( ! empty($next_single_product) ): ?>
	<a href="<?php echo esc_url(get_permalink($next_single_product->ID)); ?>" class="page-nav page-next" target="_self">
		<span class="page-preview">
		<?php if (has_post_thumbnail( $next_single_product->ID ) ): ?>
			<img src="<?php echo esc_url(wp_get_attachment_image_src( get_post_thumbnail_id( $next_single_product->ID ), 'full' )[0]); ?>" alt="<?php echo esc_attr($next_single_product->post_title); ?>" />
		<?php endif; ?>
		</span><!-- .page-preview -->
		<?php echo esc_html($next_single_product->post_title); ?>&nbsp;&mdash;
	</a><!-- .page-next -->
<?php endif; ?>
<?php endif; ?>