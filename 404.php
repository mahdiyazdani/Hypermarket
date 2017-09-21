<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4.1
 */
get_header();
?>
<!-- Content -->
<section class="container padding-top-3x">
	<h1 class="mobile-center"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'hypermarket'); ?></h1>
		<div class="row padding-top">
			<div class="col-sm-12 padding-bottom-2x">
				<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?',
							'hypermarket'); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .col-sm-12 -->
			<div class="col-md-5 col-sm-6 padding-bottom">
				<?php the_widget('WP_Widget_Recent_Posts'); ?>
			</div><!-- .col-md-5 -->
			<div class="col-sm-6 col-md-offset-1 padding-bottom">
				<?php 
					// Only show the widget if site has multiple categories.
					if (hypermarket_categorized_blog()):  
				?>
					<div class="widget widget_categories">
						<h2 class="widgettitle"><?php esc_html_e('Most Used Categories', 'hypermarket'); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div><!-- .widget -->
				<?php endif; ?>
			</div><!-- .col-sm-6 -->
			<div class="clearfix"></div>
			<div class="col-md-5 col-sm-6 padding-bottom">
				<?php
					/* translators: %1$s: smiley */
					$archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s',
					'hypermarket'), convert_smilies(':)')) . '</p>';
					the_widget('WP_Widget_Archives', 'dropdown=0', "after_title=</h2>$archive_content");
				?>
			</div><!-- .col-md-5 -->
			<div class="col-sm-6 col-md-offset-1 padding-bottom">
				<?php the_widget('WP_Widget_Tag_Cloud'); ?>
			</div><!-- .col-sm-6 -->			
		</div><!-- .row -->
</section><!-- .container -->
<?php 
get_footer();