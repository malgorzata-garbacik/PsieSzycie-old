<?php

/***** Latest Post Widget *****/

class neira_lite_latest_posts_widget extends WP_Widget {
	
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'neira_lite_latest_posts_widget', 'description' => esc_html__('A widget that displays your latest posts from all categories or a certain', 'neira-lite') );
		/* Create the widget. */
		parent::__construct( 'neira_lite_latest_posts_widget', esc_html__('[Neira] Latest Posts', 'neira-lite'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		
		/* User-selected settings. */
		$title        = apply_filters('widget_title', $instance['title'] );
		$categories   = $instance['categories'];
		$number       = $instance['number'];
		$query        = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories);		
		$loop         = new WP_Query($query);
		if ( $loop->have_posts() ) :
			echo wp_kses_post( $args['before_widget'] );
    		if ( $title ) {
				echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
    		} ?>
			<ul class="latest-post">
			<?php  while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li>
					<div class="post-image">
					  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php if (has_post_thumbnail()) { the_post_thumbnail('neira_lite_latest_post'); } else { echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/no-thumbnail.png' . '" alt="' . esc_attr_e( 'No Picture', 'neira-lite' ) . '" />'; } ?>
					  </a>
					</div>
					<div class="post-item-text">
						<h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title_attribute(); ?></a></h4>
						<time>
						<?php 
							$archive_year  = get_the_time( 'Y' ); 
							$archive_month = get_the_time( 'm' ); 
							$archive_day   = get_the_time( 'd' ); 
						?>
						<a class="entry-meta" href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
							<?php the_time(get_option('date_format')); ?>
						</a>
						</time>
					</div>
				</li>
			<?php endwhile; ?>
            </ul><?php
            wp_reset_postdata();
			echo wp_kses_post( $args['after_widget'] );
        endif;
	}

	function form( $instance ) {
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => esc_html__('Latest Posts', 'neira-lite'), 
			'number' => 5, 
			'categories' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'neira-lite'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e( 'Filter by Category:', 'neira-lite' ); ?></label>
    		<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories">
    			<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e( 'All categories', 'neira-lite' ); ?></option>
    			<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
    			<?php foreach($categories as $category) { ?>
    			<option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option>
    			<?php } ?>
    		</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e('Number of posts to show:', 'neira-lite'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
		</p>
		
		<?php
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = wp_strip_all_tags ( $new_instance['title'] );
		$instance['categories'] = wp_strip_all_tags ( $new_instance['categories'] );
		$instance['number'] = wp_strip_all_tags ( $new_instance['number'] );
		
		return $instance;
	}
	
} // class neira_lite_latest_posts_widget
add_action('widgets_init', 'neira_lite_latest_posts_init');
function neira_lite_latest_posts_init() {
	register_widget('neira_lite_latest_posts_widget');
}

?>