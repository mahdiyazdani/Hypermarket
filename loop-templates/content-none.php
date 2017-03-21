<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4.1
 */
?>
<!-- Content -->
<section class="container padding-top-3x">
	<h1 class="mobile-center"><?php esc_html_e( 'Nothing Found', 'hypermarket' ); ?></h1>
		<div class="row padding-top">
			<div class="col-md-12">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

					<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.',
					'hypermarket' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
					'hypermarket' ); ?></p>
					<?php get_search_form(); ?>

				<?php else : ?>

					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.',
					'hypermarket' ); ?></p>

					<?php get_search_form(); ?>

				<?php endif; ?>
			</div><!-- .col-md-12 -->
		</div><!-- .row -->
</section><!-- .container -->
