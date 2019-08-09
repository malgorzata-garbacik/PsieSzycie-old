<div class="entry-footer">

  <?php if( $post->comment_status == 'open' ) { ?>
	<div class="entry-comments">
		<?php comments_popup_link( esc_html__( 'No Comments', 'neira-lite' ), esc_html__( '1 Comment', 'neira-lite' ), esc_html__( '% Comments', 'neira-lite' ), '', esc_html__( 'Comments Off', 'neira-lite' ) ); ?>				
	</div>
  <?php }?>
  
	<div class="readmore">
		<a href="<?php the_permalink(); ?>" class="link-more"><?php echo wp_kses_post( esc_html__( 'View Post', 'neira-lite' )  ); ?></a>
	</div>
	
</div><!-- end entry-footer-->