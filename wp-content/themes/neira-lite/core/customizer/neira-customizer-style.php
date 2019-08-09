<?php
// Customizer CSS
add_action( 'wp_head', 'neira_lite_customizer_css' );
function neira_lite_customizer_css() {

	// Color Scheme
	$color_scheme = esc_html(get_theme_mod('neira_lite_color_scheme'));
	$nav_bg_color = esc_html(get_theme_mod('neira_lite_nav_bg_color')); //Nav Background Color
	$menu_link_color = esc_html(get_theme_mod('neira_lite_nav_link_color')); //Menu Link Color
	$menu_link_hover_color = esc_html(get_theme_mod('neira_lite_nav_link_hover_color')); // Menu Nav Color
	
?>
    <style type="text/css">
        <?php if ( get_theme_mod('neira_lite_color_scheme') ) : ?>
            a, a:hover, a:focus,
			.topbar-menu li a:hover,
            .neira-thumbnail .neira-categories:hover,
            .post .entry-meta .socials li a:hover,
            .post .link-more:hover,
			.entry-footer .entry-comments a:hover,
			#content article .link-more:hover,
			.entry-related h3 span,
			.entry-related .hentry .entry-title a:hover,
            .widget a:hover, .latest-post .post-item-text h4 a:hover,
			.widget_categories ul li a:hover,
			button:hover, input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			.site-footer .copyright a {
				color: <?php echo esc_attr($color_scheme); ?>;
            }
            .single-post-footer .social-share a:hover,
			.about-social a:hover {
				background-color: <?php echo esc_attr($color_scheme); ?>;
				color: #fff !important;
            }
			.neira-thumbnail .neira-categories a,
			.vt-post-tags a:hover,
			.tagcloud a:hover,
			.pagination .nav-links span,
			.pagination .nav-links a:hover {
				background:  <?php echo esc_attr($color_scheme); ?>;
			}
			.tagcloud a:hover { 
				border: 1px solid <?php echo esc_attr($color_scheme); ?>;
			}
			blockquote, #content article.format-quote .entry-summary {
				border-color: <?php echo esc_attr($color_scheme); ?>;
			}
        <?php endif; ?>

		<?php if ( get_theme_mod('neira_lite_nav_bg_color') ) : ?>
			#nav-wrapper, #nav-wrapper .dropdown-menu { 
				background: <?php echo esc_attr($nav_bg_color); ?>;
			}
		<?php endif; ?>
			
		<?php if ( get_theme_mod('neira_lite_nav_bg_color') ) : ?>
			.main-navigation ul ul, .main-navigation li,
			#nav-wrapper .vtmenu .dropdown-menu a {
				background-color: <?php echo esc_attr($nav_bg_color); ?>;
			}
			@media (max-width: 985px) {
				#nav-wrapper .vtmenu li a:hover {
					background: <?php echo esc_attr($nav_bg_color); ?>;
				}
			}
		<?php endif; ?>
	
		<?php if ( get_theme_mod('neira_lite_nav_link_color') ) : ?>
			@media (min-width: 985px) {
				#nav-wrapper .vtmenu a,
				#nav-wrapper .vtmenu .dropdown-menu a,
				#nav-wrapper .vtmenu .current-menu-item > a { 
					color: <?php echo esc_attr($menu_link_color); ?>;
				}
			}	
		<?php endif; ?>
		
		<?php if ( get_theme_mod('neira_lite_nav_link_hover_color') ) : ?>
			#nav-wrapper .vtmenu a:hover, #nav-wrapper .vtmenu .dropdown-menu a:hover { 
				color: <?php echo esc_attr($menu_link_hover_color); ?>;
			}
			#nav-wrapper .dropdown-menu li:hover{ 
				background: <?php echo esc_attr($menu_link_hover_bg); ?>;
			}
		<?php endif; ?>
	
    </style>
	
    <?php
}