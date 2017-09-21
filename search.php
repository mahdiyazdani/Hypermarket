<?php
/**
 * The template for displaying search results pages.
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.0
 */
get_header();

if (have_posts()) :
	get_template_part('loop-templates/content', 'search');
else :
	get_template_part('loop-templates/content', 'none');
endif;

get_footer();