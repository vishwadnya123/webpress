<?php 
/* Template Name: Homepage */ 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}; 

global $post;
get_header(); ?>

<?php the_breadcrumb(); ?>

<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<div class="contactwidgets">
<?php 
if ( is_active_sidebar( 'contact-widget1' ) ) {
	dynamic_sidebar( 'contact-widget1' ); 
} ?><div class="widget" style="width:calc(5.5% - 10px)"></div>
<?php 
if ( is_active_sidebar( 'contact-widget2' ) ) {
	dynamic_sidebar( 'contact-widget2' ); 
} ?>
</div>

<?php get_footer(); ?>