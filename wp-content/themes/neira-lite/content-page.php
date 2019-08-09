<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package neira-lite
 */
?>

<?php $sticky_class = ( is_sticky() ) ? 'vt-post-sticky' : null; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              
	<div class="post-inner">
	
		<div class="entry-content">
			<h2 class="entry-title post-title"><?php the_title_attribute(); ?></h2>
				
			<div class="entry-summary">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'neira-lite' ),
						'after'  => '</div>',
					) );
				?>
				<?php edit_post_link( __( 'Edit', 'neira-lite' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		</div><!-- .entry-content -->

	</div><!-- post-inner -->
  
</article><!-- #post-## -->