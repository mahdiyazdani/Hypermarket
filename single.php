<?php
/**
 * The template for displaying all single posts.
 *
 * @see 		http://codex.wordpress.org/Template_Hierarchy
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 		1.0.0
 */

get_header();

if (have_posts()) :
	get_template_part('loop-templates/content', 'post');
else :
	get_template_part('loop-templates/content', 'none');
endif;

get_footer();