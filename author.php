<?php
/**
 * The template for displaying the author pages.
 *
 * @see 			https://codex.wordpress.org/Author_Templates
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.0
 */
get_header();

if (have_posts()) :
	get_template_part('loop-templates/content', 'author');
else :
	get_template_part('loop-templates/content', 'none');
endif;

get_footer();