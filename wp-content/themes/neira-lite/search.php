<?php
/**
 * The template for displaying search results pages.
 *
 * @package neira-lite
 */
 
get_header(); ?>

<div class="row">

	<div class="col-md-8 site-main">
		<div id="main" class="vt-blog-standard">
		
			<header class="page-header">
				<span><?php printf( 
				/* translators: %s: for the search keyword */
				esc_html__( 'Search results for: %s', 'neira-lite' ), '</span><h3 class="archive-title">' . esc_attr( get_search_query() ) . '</h3>' ); ?>
			</header><!-- .page-header -->

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php the_posts_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
		
		</div>
	</div><!-- site-main -->

<?php get_sidebar(); ?>      
<?php get_footer(); ?>