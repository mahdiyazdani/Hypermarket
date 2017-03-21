<?php
/**
 * Displaying header image.
 *
 * @package 		Hooked into "hypermarket_before_loop_posts"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4.1
 */
$header_image = esc_url( get_header_image() );
if( ! empty($header_image) ):
	echo '<!-- Featured Image -->';
	echo '<div class="featured-image data-background" data-background="' . $header_image . '"></div><!-- .featured-image -->';
endif;