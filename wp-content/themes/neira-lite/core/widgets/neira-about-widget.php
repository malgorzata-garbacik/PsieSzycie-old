<?php

/***** About Widget *****/
class neira_lite_about_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'neira_lite_about_widget', esc_html_x('[Neira] About Widget', 'widget name', 'neira-lite'),
			array('classname' => 'neira_lite_about_widget', 'description' => esc_html('About Widget with your image and description.', 'neira-lite'))
		);
	}
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters( 'widget_title', $instance['title'] );
		$imageurl = $instance['imageurl'];
		$imagealt = $instance['imagealt'];
		$imagewidth = $instance['imagewidth'];
		$imageheight = $instance['imageheight'];
		$aboutdescription = $instance['aboutdescription'];
		$feed = $instance['feed'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$linkedin = $instance['linkedin'];
		$pinterest = $instance['pinterest'];
		$instagram = $instance['instagram'];
		$youtube = $instance['youtube'];

		echo wp_kses_post( $args['before_widget'] );
		?>

			<?php if($title != '') echo '<h4 class="widget-title">'. esc_attr($title) .'</h4>'; ?>
			
			<div class="about-widget widget-content">
				
				<div class="about-img">
					<img src="<?php echo esc_attr($imageurl); ?>" width="<?php echo esc_attr($imagewidth); ?>" height="<?php echo esc_attr($imageheight); ?>" class="about-img" alt="<?php echo esc_attr($imagealt); ?>">
				</div>
				
				<div class="about-description">
					<p><?php echo esc_attr($aboutdescription); ?></p>
					
					<p class="about-social">
						<?php if($feed != '') echo '<a href="' . esc_url($feed) . '" title="' . esc_attr( 'Feed', 'neira-lite' ) . '" class="fa fa-feed" target="_blank"></a>'; ?>
						<?php if($facebook != '') echo '<a href="' . esc_url($facebook) . '" title="' . esc_attr( 'Facebook', 'neira-lite' ) . '" class="fa fa-facebook" target="_blank"></a>'; ?>
						<?php if($twitter != '') echo '<a href="' . esc_url($twitter) . '" title="' . esc_attr( 'Twitter', 'neira-lite' ) . '" class="fa fa-twitter" target="_blank"></a>'; ?>
						<?php if($linkedin != '') echo '<a href="' . esc_url($linkedin) . '" title="' . esc_attr( 'LinkedIn', 'neira-lite' ) . '" class="fa fa-linkedin" target="_blank"></a>'; ?>
						<?php if($pinterest != '') echo '<a href="' . esc_url($pinterest) . '" title="' . esc_attr( 'Pinterest', 'neira-lite' ) . '" class="fa fa-pinterest" target="_blank"></a>'; ?>
						<?php if($instagram != '') echo '<a href="' . esc_url($instagram) . '" title="' . esc_attr( 'Instagram', 'neira-lite' ) . '" class="fa fa-instagram" target="_blank"></a>'; ?>
						<?php if($youtube != '') echo '<a href="' . esc_url($youtube) . '" title="' . esc_attr( 'Youtube', 'neira-lite' ) . '" class="fa fa-youtube" target="_blank"></a>'; ?>
					</p>
				</div>
			</div>

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
				'title' => '', 
				'imageurl' => 'http://...', 
				'imagealt' => '',  
				'imagewidth' => '300', 
				'imageheight' => '250',
				'aboutdescription' => '',
				'feed' => './feed/', 
				'facebook' => '',
				'twitter' => '',
				'linkedin' => '',
				'pinterest' => '',
				'instagram' => '',
				'youtube' => '',
			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title' )); ?>"><?php esc_html_e('Title:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imageurl' )); ?>"><?php esc_html_e('Image URL:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imageurl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imageurl' )); ?>" type="text" value="<?php echo esc_attr($instance['imageurl']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imagealt' )); ?>"><?php esc_html_e('Image ALT:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imagealt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imagealt' )); ?>" type="text" value="<?php echo esc_attr($instance['imagealt']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imagewidth' )); ?>"><?php esc_html_e('Image Width:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imagewidth' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imagewidth' )); ?>" type="text" value="<?php echo esc_attr($instance['imagewidth']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imageheight' )); ?>"><?php esc_html_e('Image Height:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imageheight' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imageheight' )); ?>" type="text" value="<?php echo esc_attr($instance['imageheight']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'aboutdescription' )); ?>"><?php esc_html_e('About Description:','neira-lite'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'aboutdescription' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'aboutdescription' )); ?>" rows="12" cols="20"><?php echo esc_attr($instance['aboutdescription']); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'feed' )); ?>"><?php esc_html_e('Feed:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'feed' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'feed')); ?>" type="text" value="<?php echo esc_attr($instance['feed']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php esc_html_e('Facebook:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" type="text" value="<?php echo esc_attr($instance['facebook']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php esc_html_e('Twitter:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" type="text" value="<?php echo esc_attr($instance['twitter']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php esc_html_e('Linkedin:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" type="text" value="<?php echo esc_attr($instance['linkedin']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php esc_html_e('Pinterest:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" type="text" value="<?php echo esc_attr($instance['pinterest']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>"><?php esc_html_e('Instagram:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" type="text" value="<?php echo esc_attr($instance['instagram']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php esc_html_e('Youtube:','neira-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" type="text" value="<?php echo esc_attr($instance['youtube']); ?>" />
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
		$instance['imageurl'] = esc_url_raw ( $new_instance['imageurl'] );
		$instance['imagealt'] = wp_strip_all_tags ( $new_instance['imagealt'] );
		$instance['imagewidth'] = wp_strip_all_tags ( $new_instance['imagewidth'] );
		$instance['imageheight'] = wp_strip_all_tags ( $new_instance['imageheight'] );
		$instance['aboutdescription'] = wp_strip_all_tags ( $new_instance['aboutdescription'] );
		$instance['feed'] = wp_strip_all_tags ( $new_instance['feed'] );
		$instance['facebook'] = esc_url_raw ( $new_instance['facebook'] );
		$instance['twitter'] = esc_url_raw ( $new_instance['twitter'] );
		$instance['linkedin'] = esc_url_raw ( $new_instance['linkedin'] );
		$instance['pinterest'] = esc_url_raw ( $new_instance['pinterest'] );
		$instance['instagram'] = esc_url_raw ( $new_instance['instagram'] );
		$instance['youtube'] = esc_url_raw ( $new_instance['youtube'] );

		return $instance;
	}
	
} // class neira_lite_about_widget
add_action('widgets_init', 'neira_lite_about_init');
function neira_lite_about_init() {
    register_widget('neira_lite_about_widget');
}

?>