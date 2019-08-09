<?php
/**
 * Neira functions and definitions
 *
 * @package neira-lite
 */
$theme = wp_get_theme();
define('NEIRA_LITE_VERSION', $theme -> get('Version'));
define('NEIRA_LITE_AUTHOR_URI', $theme -> get('AuthorURI'));
define('NEIRA_LIBS_URI', get_template_directory_uri() . '/libs/');
define('NEIRA_CORE_PATH', get_template_directory() . '/core/');
define('NEIRA_CORE_URI', get_template_directory_uri() . '/core/');
define('NEIRA_CORE_CLASSES', NEIRA_CORE_PATH . 'classes/');
define('NEIRA_CORE_FUNCTIONS', NEIRA_CORE_PATH . 'functions/');
define('NEIRA_CORE_CUSTOMIZER', NEIRA_CORE_PATH . 'customizer/');
define('NEIRA_CORE_WIDGETS', NEIRA_CORE_PATH . 'widgets/');

// Set Content Width
if ( ! isset( $content_width ) ) { $content_width = 1140; }

// Theme setup
add_action('after_setup_theme', 'neira_lite_setup');
function neira_lite_setup() {
	
	// Translations can be filed in the /languages/ directory.
    load_theme_textdomain( 'neira-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );
	
	/* Enable support for Post Thumbnails on posts and pages */
	add_theme_support('post-thumbnails');
	add_image_size( 'neira_lite_latest_post', 80, 70, true);
	add_image_size( 'neira_lite_related_post',  200, 120, true);
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__('Primary menu', 'neira-lite')
    ));
	
	/* Add callback for custom TinyMCE editor stylesheets. (editor-style.css) */
	add_editor_style('editor-style.css');

	// Enable support for Post Formats.
	add_theme_support('post-formats', array('image', 'video', 'audio', 'gallery'));
	
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'neira_lite_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );
	
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
	
	// Custom logo
	add_theme_support( 'custom-logo', array(
	   'height'      => 175,
	   'width'       => 400,
	   'flex-width' => true,
	   'header-text' => array( 'site-title', 'site-description' ),
	) );
	
}

// Register & Enqueue Styles / Scripts
add_action('wp_enqueue_scripts', 'neira_lite_load_scripts');
function neira_lite_load_scripts() {
    // CSS
    wp_enqueue_style('bootstrap', NEIRA_LIBS_URI . 'bootstrap/css/bootstrap.min.css', array(), '4.3.1' );
    wp_enqueue_style('font-awesome', NEIRA_LIBS_URI . 'font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
    wp_enqueue_style('chosen', NEIRA_LIBS_URI . 'chosen/chosen.min.css', array(), '1.6.2' );
    wp_enqueue_style('neira-lite-style', get_stylesheet_uri(), '', NEIRA_LITE_VERSION );

    // JS
	wp_enqueue_script('fitvids', NEIRA_LIBS_URI . 'fitvids/fitvids.js', array(), '1.1', true );
    wp_enqueue_script('chosen', NEIRA_LIBS_URI . 'chosen/chosen.jquery.js', array(), '1.6.2', true );
	wp_enqueue_script('jquery'); // default Scripts Included and Registered by WordPress
	wp_enqueue_script('neira-lite-scripts', get_template_directory_uri() . '/assets/js/neira-scripts.js', array(), '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }
}

// Load Google fonts
function neira_lite_google_fonts_url() {
    $fonts_url = '';
    $Montserrat = _x( 'on', 'Montserrat font: on or off', 'neira-lite' );
    $Dancing = _x( 'on', 'BenchNine font: on or off', 'neira-lite' );    

    if ( 'off' !== $Dancing || 'off' !== $Montserrat )
    {
        $font_families = array();

        if ('off' !== $Dancing) {
            $font_families[] = 'BenchNine:300,400,700';
        }
        
        if ('off' !== $Montserrat) {
            $font_families[] = 'Montserrat:400,700';
        }

        $query_args = array(
            'family' => urlencode(implode('|', $font_families )),
            'subset' => urlencode('latin,latin-ext')
        );

        $fonts_url = add_query_arg($query_args, '//fonts.googleapis.com/css' );
    }

    return esc_url_raw($fonts_url);
}

// Google fonts
function neira_lite_enqueue_googlefonts() {
    wp_enqueue_style( 'neira-lite-googlefonts', neira_lite_google_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'neira_lite_enqueue_googlefonts');

/* Add Admin stylesheet to the admin page */
function neira_lite_selectively_enqueue_admin_script( $hook ) {
	if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'neira-lite-adminstyle', get_template_directory_uri() . '/assets/css/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'neira_lite_selectively_enqueue_admin_script' );

// Sidebar Widgets
function neira_lite_widgets_init() {
	register_sidebar(array(
		'name'          => __( 'Sidebar', 'neira-lite' ),
		'id'              => 'sidebar',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
}
add_action( 'widgets_init', 'neira_lite_widgets_init' );

/**
 * Assign the Neira lite version to a variable.
 */
$theme = wp_get_theme( 'neira-lite' );
$neira_lite_version = $theme['Version'];

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/core/class-neira-admin.php';
}

function neira_lite_require_file( $path ) {
    if ( file_exists($path) ) {
        require $path;
    }
}

// Require core files
neira_lite_require_file( get_template_directory() . '/core/init.php' );