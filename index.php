<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @see 		http://codex.wordpress.org/Template_Hierarchy
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 		1.0.0
 */

get_header();

if (have_posts()) :
	get_template_part('loop-templates/content', 'loop');
else :
	get_template_part('loop-templates/content', 'none');
endif;

get_footer();