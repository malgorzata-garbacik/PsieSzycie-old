<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package neira-lite
 */

get_header(); ?>

<div class="row">

	<div class="col-md-8 site-main">
		<div id="main" class="vt-blog-standard">
		
		<?php if ( have_posts() ) : ?>

			<div class="archive-box">
			  <header class="page-header">
				<?php
					the_archive_title( '<h2 class="page-title">', '</h2>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			  </header><!-- .page-header -->
			</div>
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php the_posts_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</div>
	</div><!-- site-main -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>