<?php
/**
 * The template used for displaying single post
 *
 * @package neira-lite
 */
?>

<?php $sticky_class = ( is_sticky() ) ? 'vt-post-sticky' : null; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="post-inner">
	
	  <?php if ( has_post_thumbnail() ) : ?>
		<div class="neira-thumbnail">
			<?php the_post_thumbnail(); ?>
			<span class="neira-format-icon"></span>
			<div class="neira-categories"><?php neira_lite_first_category(); ?></div>
		</div>
	  <?php endif; ?>
                    
		<div class="entry-content">
			<h1 class="post-title"><?php the_title_attribute(); ?></h1>

			<div class="post-meta">
				<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 22 ); ?>
					<span class="by"><?php esc_html_e( 'by', 'neira-lite' ); ?></span>
					<?php the_author(); ?>
				</a>
				<span class="separator">/</span>
				<?php neira_lite_posted_on() ?>
			</div>

			<div class="entry-summary">
				<?php the_content(); ?>
				<?php edit_post_link( __( 'Edit', 'neira-lite' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			
			<?php if ( get_the_tags() ) : ?>
			<div class="vt-post-tags">
				<?php the_tags('',' '); ?>
			</div>
			<?php endif; ?>

			<?php 
				the_post_navigation( array(
					'prev_text' => '&lt; %title',
					'next_text' => '%title &gt;',
				) );
			?>
			
			<?php if ( !get_theme_mod('neira_author_box') ) { get_template_part( 'template-parts/single', 'post-author' ); } ?>
			<?php if ( !get_theme_mod('neira_related_posts') ) { get_template_part( 'template-parts/related', 'post' ); } ?>
			<?php comments_template( '', true );  ?>
			
		</div><!-- entry-content -->
		
  </div><!-- post-inner -->
		
</article><!-- #post-## -->