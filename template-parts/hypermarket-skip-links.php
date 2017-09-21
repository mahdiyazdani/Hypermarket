<?php
/**
 * Displaying skip links.
 *
 * @package 	Hooked into "hypermarket_before_header_area"
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.0
 */
?>
<a class="skip-link screen-reader-text" href="#hypermarket-main-navigation">
	<?php esc_attr_e('Skip to navigation', 'hypermarket'); ?>
</a><!-- .skip-link -->
<a class="skip-link screen-reader-text" href="#hypermarket-content">
	<?php esc_attr_e('Skip to content', 'hypermarket'); ?>
</a><!-- .skip-link -->