<?php
/**
 * The template for displaying all pages with fluid width.
 * 
 * 
 * Template name: 	Fluid Template
 * @see 			https://codex.wordpress.org/Theme_Development
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 			1.0.3
 */

get_header();

if ( have_posts() ) :
	get_template_part( 'loop-templates/content', 'page' );
else:
	get_template_part( 'loop-templates/content', 'none' );
endif;

get_footer();