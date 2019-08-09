<?php

/** Neira - Customizer - Add Settings */
function neira_lite_register_theme_customizer( $wp_customize )
{
	/** Add Sections -----------------------------------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'neira_new_section_blog_settings', array(
		'title' 	   => __('Blog Settings','neira-lite'),
   		'description'  => '',
		'priority' => 60,
	) );
	$wp_customize->add_section( 'neira_new_section_ctboxes', array(
		'title' 	   => __('Content Boxes','neira-lite'),
   		'description'  => '',
		'priority' => 70,
	) );
    $wp_customize->add_section( 'neira_lite_new_section_social_media', array(
		'title' 	   => __('Social Media Settings','neira-lite'),
		'description'  => __('Enter social media url. including <strong>http://</strong> or <strong>https://</strong>','neira-lite'),
		'priority' => 80,

	) );
    $wp_customize->add_section( 'color', array(
		'title' 	   => __('Color Scheme','neira-lite'),
   		'description'  => ''
	) );
	$wp_customize->add_section('vt_upgrade', array(
		'title' 	   => __('Upgrade to Premium','neira-lite'),
		'priority' => 200,
	) );

    /** Add Settings ------------------------------------------------------------------------------------------------------------*/
  
    // Blog Settings
	$wp_customize->add_setting( 'neira_entry_excerpt', array('default' => 45,'sanitize_callback' => 'neira_lite_sanitize_text') );
	$wp_customize->add_setting( 'neira_header_search', array('default' => 0,'sanitize_callback' => 'neira_lite_sanitize_checkbox') );
	$wp_customize->add_setting( 'neira_author_box', array('default' => 0,'sanitize_callback' => 'neira_lite_sanitize_checkbox') );
	$wp_customize->add_setting( 'neira_related_posts', array('default' => 0,'sanitize_callback' => 'neira_lite_sanitize_checkbox') );
	$wp_customize->add_setting( 'neira_button_up', array('default' => 0,'sanitize_callback' => 'neira_lite_sanitize_checkbox') );

    // Content Boxes
    $wp_customize->add_setting( 'neira_ctboxes_show', array('default' => 0,'sanitize_callback' => 'neira_lite_sanitize_checkbox') );
    $wp_customize->add_setting( 'neira_ctboxes_one_title', array('default' => '','sanitize_callback' => 'neira_lite_sanitize_text') );
    $wp_customize->add_setting( 'neira_ctboxes_one_link', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_ctboxes_one_image', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_ctboxes_two_title', array('default' => '','sanitize_callback' => 'neira_lite_sanitize_text') );
    $wp_customize->add_setting( 'neira_ctboxes_two_link', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_ctboxes_two_image', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_ctboxes_three_title', array('default' => '','sanitize_callback' => 'neira_lite_sanitize_text') );
    $wp_customize->add_setting( 'neira_ctboxes_three_link', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_ctboxes_three_image', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_ctboxes_border', array('default' => 1,'sanitize_callback' => 'neira_lite_sanitize_checkbox') );
    
	// Social media settings
    $wp_customize->add_setting( 'neira_lite_facebook', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_lite_twitter', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_lite_linkedin', array('default' => '','sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_setting( 'neira_lite_pinterest', array('default' => '','sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_setting( 'neira_lite_instagram', array('default' => '','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_setting( 'neira_lite_youtube', array('default' => '','sanitize_callback' => 'esc_url_raw') );

	
    
	// Color Scheme
    $wp_customize->add_setting( 'neira_lite_color_scheme', array('default' => '#f25d46','sanitize_callback' => 'sanitize_hex_color') );  
	$wp_customize->add_setting( 'neira_lite_nav_bg_color', array('default'=> '#333333','sanitize_callback' => 'sanitize_hex_color') );
	$wp_customize->add_setting( 'neira_lite_nav_link_color', array('default' => '#cccccc','sanitize_callback' => 'sanitize_hex_color') );
	$wp_customize->add_setting( 'neira_lite_nav_link_hover_color', array('default' => '#ffffff','sanitize_callback' => 'sanitize_hex_color') );

	// Upgrade
	$wp_customize->add_setting('vt_options[premium_version_upgrade]', array('default' => '','type' => 'option','sanitize_callback' => 'esc_url_raw') );
    
    /** Add Control ------------------------------------------------------------------------------------------------------------*/

	// Blog Settings
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_entry_excerpt',
			array(
				'label'	     => __('Number of words to show on excerpt', 'neira-lite'),
				'section'    => 'neira_new_section_blog_settings',
				'settings'   => 'neira_entry_excerpt',
				'type'		 => 'text',
				'description' => __( 'Default: 45', 'neira-lite' )	
			)
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_header_search',
			array(
				'label'	     => __('Hide header search form', 'neira-lite'),
				'section'    => 'neira_new_section_blog_settings',
				'settings'   => 'neira_header_search',
				'type'		 => 'checkbox'
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_author_box',
			array(
				'label'	     => __('Hide author box on single posts', 'neira-lite'),
				'section'    => 'neira_new_section_blog_settings',
				'settings'   => 'neira_author_box',
				'type'		 => 'checkbox'
			)
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_related_posts',
			array(
				'label'	     => __('Hide related posts on single posts', 'neira-lite'),
				'section'    => 'neira_new_section_blog_settings',
				'settings'   => 'neira_related_posts',
				'type'		 => 'checkbox'
			)
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_button_up',
			array(
				'label'	     => __('Hide "back to top" icon link on the site bottom', 'neira-lite'),
				'section'    => 'neira_new_section_blog_settings',
				'settings'   => 'neira_button_up',
				'type'		 => 'checkbox'
			)
		)
	);
	
	// Content Boxes
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_show',
			array(
				'label'	     => __('Display Content Boxes', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_show',
				'type'		 => 'checkbox',
				'priority'	 => 2
			)
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_one_title',
			array(
				'label'		 => __('Content Box 1 - Title', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_one_title',
				'type'		 => 'text'
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_one_link',
			array(
				'label'		 => __('Content Box 1 - URL', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_one_link',
				'type'		 => 'url'
			)
		)
	);
    
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'neira_ctboxes_one_image',
			array(
				'label'		 => __('Content Box 1 - Image', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_one_image'
			)
		)
	);
    
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_two_title',
			array(
				'label'		 => __('Content Box 2 - Title', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_two_title',
				'type'		 => 'text'
			)
		)
	);
     
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_two_link',
			array(
				'label'		 => __('Content Box 2 - URL', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_two_link',
				'type'		 => 'url'
			)
		)
	);
     
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'neira_ctboxes_two_image',
			array(
				'label'		 => __('Content Box 2 - Image', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_two_image'
			)
		)
	);
    
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_three_title',
			array(
				'label'		 => __('Content Box 3 - Title', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_three_title',
				'type'		 => 'text'
			)
		)
	);
    
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_three_link',
			array(
				'label'		 => __('Content Box 3 - URL', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_three_link',
				'type'		 => 'url'
			)
		)
	);
    
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'neira_ctboxes_three_image',
			array(
				'label'		 => __('Content Box 3 - Image', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_three_image'
			)
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'neira_ctboxes_border',
			array(
				'label'	     => __('Show Border Bottom', 'neira-lite'),
				'section'    => 'neira_new_section_ctboxes',
				'settings'   => 'neira_ctboxes_border',
				'type'		 => 'checkbox'
			)
		)
	);
	
	// Social Media
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'facebook',
			array(
				'label'	     => __('Facebook', 'neira-lite'),
				'section'    => 'neira_lite_new_section_social_media',
				'settings'   => 'neira_lite_facebook',
				'type'		 => 'url',
				'priority'	 => 1
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'twitter',
			array(
				'label'	     => __('Twitter', 'neira-lite'),
				'section'    => 'neira_lite_new_section_social_media',
				'settings'   => 'neira_lite_twitter',
				'type'		 => 'url',
				'priority'	 => 2
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'linkedin',
			array(
				'label'	     => __('Linkedin', 'neira-lite'),
				'section'    => 'neira_lite_new_section_social_media',
				'settings'   => 'neira_lite_linkedin',
				'type'		 => 'url',
				'priority'	 => 3
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'pinterest',
			array(
				'label'	     => __('Pinterest', 'neira-lite'),
				'section'    => 'neira_lite_new_section_social_media',
				'settings'   => 'neira_lite_pinterest',
				'type'		 => 'url',
				'priority'	 => 4
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'instagram',
			array(
				'label'	     => __('Instagram', 'neira-lite'),
				'section'    => 'neira_lite_new_section_social_media',
				'settings'   => 'neira_lite_instagram',
				'type'		 => 'url',
				'priority'	 => 5
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'youtube',
			array(
				'label'	     => __('Youtube', 'neira-lite'),
				'section'    => 'neira_lite_new_section_social_media',
				'settings'   => 'neira_lite_youtube',
				'type'		 => 'url',
				'priority'	 => 6
			)
		)
	);

	// Color Scheme
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_scheme',
			array(
				'label'	     => __('Color Scheme', 'neira-lite'),
				'section'    => 'colors',
				'settings'   => 'neira_lite_color_scheme',
				'priority'	 => 1
			)
		)
	);

	/* Menu Navigation */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'neira_lite_nav_bg_color',
			array(
				'label'		 => __('Menu Background', 'neira-lite'),
				'section'    => 'colors',
				'settings'   => 'neira_lite_nav_bg_color',
				'priority'	 => 12
			)
		)
	);

	// Menu Link Color
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'neira_lite_nav_link_color',
			array(
				'label'		 => __('Menu Link Color', 'neira-lite'),
				'section'    => 'colors',
				'settings'   => 'neira_lite_nav_link_color',
				'priority'	 => 13
			)
		)
	);
	
	// Menu Link Hover Color
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'neira_lite_nav_link_hover_color',
			array(
				'label'		 => __('Menu Link Hover Color', 'neira-lite'),
				'section'    => 'colors',
				'settings'   => 'neira_lite_nav_link_hover_color',
				'priority'	 => 14
			)
		)
	);
	
	// Premium upgrade
	class neira_lite_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="vt-upgrade-thumb">
        		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/neira-premium.png" />
        	</p>
        	<p class="vt-upgrade-title">
        		<span class="customize-control-title">
        			<?php esc_html_e('More Features and Options', 'neira-lite'); ?>
        		</span>
        	</p>
        	<p class="vt-upgrade-text">
        		<span class="textfield">
        			<?php esc_html_e('Check out the premium version of this theme which comes with more great features, Sticky Header, Sticky Sidebar, Featured Slider and Advanced customization options for your website.', 'neira-lite'); ?>
        		</span>
			</p>
			<p class="vt-upgrade-button">
				<a href="https://volthemes.com/theme/neira/?utm_source=WordPress&utm_medium=link&utm_campaign=neira-lite" target="_blank" class="button button-secondary">
					<?php esc_html_e('Learn more about premium version', 'neira-lite'); ?>
				</a>
			</p><?php
        }
    }
		
	$wp_customize->add_control(
		new neira_lite_Customize_Upgrade_Control(
			$wp_customize,
			'premium_version_upgrade', 
			array(
				'section' => 'vt_upgrade',
				'settings' => 'vt_options[premium_version_upgrade]',
			)
		)
	);
	
}

add_action( 'customize_register', 'neira_lite_register_theme_customizer' );

/*
 * Sanitize functions.
 */
function neira_lite_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize checkbox for customizer
*/
function neira_lite_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}