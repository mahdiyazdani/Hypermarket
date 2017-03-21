<?php
/**
 * The template for displaying the author pages.
 *
 * @see 			https://codex.wordpress.org/Author_Templates
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4.1
 */
/**
 * Functions hooked into "hypermarket_before_loop_posts" action
 *
 * @hooked hypermarket_loop_posts_header_image             - 10
 * @since 1.0
 */
do_action('hypermarket_before_loop_posts');
$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
?>
<!-- Content -->
<section class="container padding-top-3x">
	<h1 class="mobile-center">
		<?php esc_html_e( 'About:', 'hypermarket' ); ?>
		<?php echo esc_html( $curauth->nickname ); ?>
	</h1>
	<div class="row padding-top padding-bottom">
		<div class="col-sm-12">
			<div class="quotation padding-top">
		        <div class="quotation-author">
					<div class="quotation-author-ava">
					<?php 
						if ( ! empty( $curauth->ID ) ):
							echo get_avatar( $curauth->ID );
						endif; 
					?>
					</div><!-- .quotation-author-ava -->
		        </div><!-- .quotation-author -->
        	<blockquote>
	        	<?php 
	        		if ( ! empty( $curauth->user_description ) ):
						echo '<p>' . esc_html( $curauth->user_description ) . '</p>';
        			endif; 
        		?>
	          	<cite><?php echo esc_html( $curauth->nickname ); ?></cite>
        	</blockquote>
          </div><!-- .quotation -->
		</div><!-- .col-sm-12 -->
	</div><!-- .row -->
	<?php if( have_posts() ): ?>
		<hr class="padding-bottom">
		<h3>
			<?php esc_html_e( 'Posts by', 'hypermarket' ); ?> 
			<?php echo esc_html( $curauth->nickname ); ?>
		</h3>
		<div class="row padding-top">
			<div class="col-sm-12">
				<ul class="author-posts">
					<?php while ( have_posts() ) : the_post(); ?>
						<li>
							<a rel="bookmark" href="<?php the_permalink() ?>" target="_self"><?php the_title(); ?></a>
							<span class="divider"></span>
							<?php 
								echo esc_html(human_time_diff(get_the_time('U'), current_time('timestamp'))); 
								esc_html_e(' ago', 'hypermarket');
							?>
							<span class="divider"></span>
							 <?php esc_html_e( 'in', 'hypermarket' ); ?> <?php the_category( '&' ); ?>
						</li>
					<?php endwhile; ?>
				</ul>
			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	<?php endif;?>
</section><!-- .container -->
