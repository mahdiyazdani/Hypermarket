<?php
/**
 * The sidebar containing the main widget area.
 *
 * @see 		https://codex.wordpress.org/Function_Reference/dynamic_sidebar
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 		1.0.1
 */

if (! is_active_sidebar('sidebar')) :
	return;
endif;
?>
<!-- Sidebar -->
<div class="col-md-3 col-sm-4" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<aside class="sidebar sidebar-right">
		<span class="sidebar-close"><i class="material-icons close"></i></span>
		<div class="widgets">
			<?php dynamic_sidebar('sidebar'); ?>
		</div><!-- .widgets -->
	</aside><!-- .sidebar -->
</div><!-- .col-md-3.col-sm-4 -->