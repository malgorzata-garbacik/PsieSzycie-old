<?php
/**
 * The template for displaying all pages.
 *
 * @package neira-lite
 */

get_header(); ?>

<div class="row">
	<div class="col-md-8 site-main">
	
		<?php while ( have_posts() ) : the_post(); ?>
		
			<?php get_template_part( 'content', 'page' ); ?>
			
		<?php endwhile; // end of the loop. ?>

	</div><!-- .site-main -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>