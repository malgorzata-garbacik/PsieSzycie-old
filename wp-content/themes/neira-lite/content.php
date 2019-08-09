<?php
/**
 * The default template for displaying content
 *
 * @package neira-lite
 */

$sticky_class = ( is_sticky() ) ? 'is_sticky' : null;
$pin_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) );

?>
			
<article <?php post_class("post {$sticky_class}"); ?>>

	<div class="neira-thumbnail">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
			<span class="neira-format-icon"></span>
		</a>
		<div class="neira-categories"><?php neira_lite_first_category(); ?></div>
	</div>
		
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
				
		<?php if( strpos( $post->post_content, '<!--more-->' ) ) : ?>
				
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<?php get_template_part('template-parts/entry', 'footer'); ?>

		<?php else : ?>			
		  <div class="entry-summary">
			<?php
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'neira-lite' ),
					'after'  => '</div>',
				) );
			?>
		  </div>
		<?php endif; ?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->