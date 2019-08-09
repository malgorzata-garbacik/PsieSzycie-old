<div class="page-content error-page">
	<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'neira-lite' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
	?>
	<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'neira-lite'); ?></p>
	<?php get_search_form(); ?>
	<?php else : ?>
	<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'neira-lite'); ?></p>
	<?php get_search_form(); ?>
	<?php endif; ?>
</div>