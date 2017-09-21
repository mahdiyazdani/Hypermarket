<?php
/**
 * Displaying single product image and thumbnails
 *
 * @package 		Hooked into "woocommerce_before_single_product_summary"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.3.0
 */
global $post, $product, $woocommerce;

$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$attachment_ids = $product->get_gallery_image_ids();
?>
<!-- Product Gallery -->
<div class="images product-gallery woocommerce-product-gallery__wrapper">
	<?php if(! empty($post_thumbnail_id)): ?>
		<!-- Preview -->
		<ul class="product-gallery-preview">
			<?php
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$full_size_image   = wp_get_attachment_image_src($post_thumbnail_id, 'full');
			$thumbnail_post    = get_post($post_thumbnail_id);
			$image_title       = $thumbnail_post->post_content;
			$attributes = array(
				'title'                   => $image_title,
				'data-large-image'        => $full_size_image[0],
				'data-large-image-width'  => $full_size_image[1],
				'data-large-image-height' => $full_size_image[2],
			);
			echo '<li id="preview01" data-thumb="' . esc_url(get_the_post_thumbnail_url($post->ID, 'shop_thumbnail')) . '" class="current woocommerce-product-gallery__image">';
				echo get_the_post_thumbnail($post->ID, 'shop_single', $attributes);
			echo '</li><!-- .woocommerce-product-gallery__image -->';
			if(is_array($attachment_ids) && ! empty($attachment_ids)):
				$counter = 2;
				foreach($attachment_ids as $attachment_id):
					$full_size_image  = wp_get_attachment_image_src($attachment_id, 'full');
					$thumbnail        = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
					$thumbnail_post   = get_post( $attachment_id );
					$image_title      = $thumbnail_post->post_content;
					$attributes = array(
						'title'                   => $image_title,
						'data-large-image'        => $full_size_image[0],
						'data-large-image-width'  => $full_size_image[1],
						'data-large-image-height' => $full_size_image[2],
					);
					echo '<li id="preview0' . esc_attr($counter) . '" data-thumb="' . esc_url(get_the_post_thumbnail_url($post->ID, 'shop_thumbnail')) . '" class="woocommerce-product-gallery__image">';
						echo wp_get_attachment_image($attachment_id, 'shop_single', false, $attributes);
					echo '</li><!-- .woocommerce-product-gallery__image -->';
					$counter++;
				endforeach;
			endif;
			?>
		</ul><!-- .product-gallery-preview -->
		<!-- Thumblist -->
		<ul class="product-gallery-thumblist">
			<?php
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$full_size_image   = wp_get_attachment_image_src($post_thumbnail_id, 'full');
			$thumbnail_post    = get_post($post_thumbnail_id);
			$image_title       = $thumbnail_post->post_content;
			$attributes = array(
				'title'                   => $image_title,
				'data-large-image'        => $full_size_image[0],
				'data-large-image-width'  => $full_size_image[1],
				'data-large-image-height' => $full_size_image[2],
			);
			echo '<li data-thumb="' . esc_url(get_the_post_thumbnail_url($post->ID, 'shop_thumbnail')) . '" class="active woocommerce-product-gallery__image">';
				echo '<a href="#preview01">';
					echo get_the_post_thumbnail($post->ID, 'shop_single', $attributes);
				echo '</a>';
			echo '</li><!-- .woocommerce-product-gallery__image -->';
			if(is_array($attachment_ids) && ! empty($attachment_ids)):
				$counter = 2;
				foreach($attachment_ids as $attachment_id):
					$full_size_image  = wp_get_attachment_image_src($attachment_id, 'full');
					$thumbnail        = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
					$thumbnail_post   = get_post($attachment_id);
					$image_title      = $thumbnail_post->post_content;
					$attributes = array(
						'title'                   => $image_title,
						'data-large-image'        => $full_size_image[0],
						'data-large-image-width'  => $full_size_image[1],
						'data-large-image-height' => $full_size_image[2],
					);
					echo '<li data-thumb="' . esc_url(get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' )) . '" class="woocommerce-product-gallery__image">';
						echo '<a href="#preview0' . esc_attr($counter) . '">';
							echo wp_get_attachment_image($attachment_id, 'shop_thumbnail', false, $attributes);
						echo '</a>';
					echo '</li><!-- .woocommerce-product-gallery__image -->';
					$counter++;
				endforeach;
			endif;
			?>
		</ul><!-- .product-gallery-thumblist -->
	<?php else: ?>
		<ul class="product-gallery-preview">
			<li id="preview01" class="woocommerce-product-gallery__image--placeholder current">
				<?php printf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'hypermarket')); ?>
			</li><!-- .woocommerce-product-gallery__image--placeholder -->
		</ul><!-- .product-gallery-preview -->
	<?php endif; ?>
</div><!-- .product-gallery -->
