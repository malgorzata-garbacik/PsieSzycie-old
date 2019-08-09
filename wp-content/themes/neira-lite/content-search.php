<?php
/**
 * The template used for displaying content search.php
 *
 * @package neira-lite
 */
?>

<?php $sticky_class = ( is_sticky() ) ? 'vt-post-sticky' : null; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="post-inner">
	
	  <?php if ( has_post_thumbnail() ) : ?>
		<div class="neira-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
				<span class="neira-format-icon"></span>
			</a>
			<div class="neira-categories"><?php neira_lite_first_category(); ?></div>
		</div>
	  <?php endif; ?>
                    
		<div class="entry-content">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a></h2>

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
				<?php the_excerpt(); ?>
			</div>
			
			<?php get_template_part('template-parts/entry', 'footer'); ?>
			
		</div><!-- entry-content -->
		
  </div><!-- post-inner -->
		
</article><!-- #post-## -->