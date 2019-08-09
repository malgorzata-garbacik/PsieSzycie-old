<?php
/**
 * Custom template tags for neira-lite theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package neira-lite
 */

/**
 * Display the first (single) category of post.
 */
if ( ! function_exists( 'neira_lite_first_category' ) ) :
function neira_lite_first_category() {
    $category = get_the_category();
    if ($category) {
	  /* translators: Display the first category of post. */
      echo '<a href="' . esc_html(get_category_link( $category[0]->term_id )) . '" title="' . sprintf( esc_html( "View all posts in %s", 'neira-lite' ), esc_html($category[0]->name )) . '" ' . '>' . esc_html($category[0]->name).'</a> ';
    }    
}
endif;

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
if ( ! function_exists( 'neira_lite_custom_excerpt_length' ) ) :

function neira_lite_custom_excerpt_length( $length ) {
    return get_theme_mod('neira_entry_excerpt', '45');
}
add_filter( 'excerpt_length', 'neira_lite_custom_excerpt_length', 999 );

endif;

/**
 * Customize excerpt more.
 */
if ( ! function_exists( 'neira_lite_excerpt_more' ) ) :

function neira_lite_excerpt_more( $more ) {
   return '... ';
}
add_filter( 'excerpt_more', 'neira_lite_excerpt_more' );

endif;

// Url Encode
function neira_lite_url_encode($title)
{
    $title = html_entity_decode($title);
    $title = urlencode($title);
    return $title;
}

if ( ! function_exists( 'neira_lite_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function neira_lite_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $time_string,
		esc_attr( get_the_date( get_option('date_format') ) ),
		esc_html( get_the_date(get_option('date_format')) )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html( '%s', 'post date' ),
			'<a href="' . esc_url( get_month_link(esc_html(get_the_time('Y')), esc_html(get_the_time('m')) ) ) . '" rel="bookmark">' .$time_string. '</a>'
		);

		echo '<span class="posted-on ">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'neira_lite_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function neira_lite_posted_by() {

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'neira-lite' ),
			'<span class="author vcard mr-auto">
			<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
	
		echo '<span class="byline"> ' . $byline .'&nbsp'. '</span>'; // WPCS: XSS OK.

	}
endif;

// Comment Layout
function neira_lite_custom_comment($comment, $args, $depth) {
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	} ?>
	
	<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
		<div class="comment-author">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<div class="comment-content">
			<?php printf( '<h4 class="author-name">%s</h4>', get_comment_author_link() ); ?>
			<span class="date-comment">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				  <time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( esc_html__( '%1$s at %2$s ', 'neira-lite' ), get_comment_date(), get_comment_time() ); ?>
				  </time>
				</a>
			</span>
			<div class="reply">
				<?php edit_comment_link( esc_html__( '(Edit)', 'neira-lite' ), '  ', '' );?>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'neira-lite' ); ?></em>
				<br />
			<?php endif; ?>
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/**
 * Footer info, copyright information
 */
if ( ! function_exists( 'neira_lite_footer' ) ) :
function neira_lite_footer() {
   $site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

   $wp_link = '<a href="'.esc_url("https://wordpress.org").'" target="_blank" title="' . esc_attr__( 'WordPress', 'neira-lite' ) . '"><span>' . __( 'WordPress', 'neira-lite' ) . '</span></a>';

   $tg_link =  '<a href="'.esc_url("https://volthemes.com/theme/neira/").'" target="_blank" title="'.esc_attr__( 'VolThemes', 'neira-lite' ).'"><span>'.__( 'VolThemes', 'neira-lite') .'</span></a>';

   $default_footer_value = 
   /* translators: 1: year, 2: sitename */
   sprintf( __( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'neira-lite' ), date_i18n( 'Y' ), $site_link ).'<br>'.sprintf( __( 'Theme: %1$s by %2$s.', 'neira-lite' ), 'Neira Lite', $tg_link ).' '.sprintf( __( 'Powered by %s.', 'neira-lite' ), $wp_link );

   $neira_lite_footer = '<div class="copyright">'.$default_footer_value.'</div>';
	echo wp_kses_post($neira_lite_footer);
   
}
endif;
add_action( 'neira_lite_footer', 'neira_lite_footer', 10 );

/**
 * Scroll to top
 */
function neira_lite_scroll_to_top() {
	if (get_theme_mod('neira_button_up', 0) == 0){
?>
<div id="backtotop"><a href="#top"><span><i class="fa fa-angle-double-up"></i></span></a></div>
<?php
}}
add_action('wp_footer', 'neira_lite_scroll_to_top');

/**
 * Flush out the transients used in neira_lite_categorized_blog.
 */
function neira_lite_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'neira_lite_categories' );
}
add_action( 'edit_category', 'neira_lite_category_transient_flusher' );
add_action( 'save_post',     'neira_lite_category_transient_flusher' );