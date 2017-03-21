<?php
/**
 * Displaying page preloader.
 *
 * @package 	Hooked into "hypermarket_before_header_area"
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.4.1
 */
?>
<!-- Page Pre-Loader -->
<div class="page-preloader">
	<div class="preloader">
		<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/img/preloader.gif" alt="<?php __('Preloader', 'hypermarket'); ?>" width="64" height="64" />
	</div><!-- .preloader -->
</div><!-- .page-preloader -->