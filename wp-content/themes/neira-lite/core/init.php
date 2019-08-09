<?php
if ( function_exists('neira_lite_require_file') )
{
    // Load Classes
    neira_lite_require_file( NEIRA_CORE_CLASSES . 'wp-bootstrap-navwalker.php' );
    
    // Load Customizer
    neira_lite_require_file( NEIRA_CORE_CUSTOMIZER . 'neira-custom-control.php' );
    neira_lite_require_file( NEIRA_CORE_CUSTOMIZER . 'neira-customizer-settings.php' );
    neira_lite_require_file( NEIRA_CORE_CUSTOMIZER . 'neira-customizer-style.php' );
	
    // Load Functions
    neira_lite_require_file( NEIRA_CORE_FUNCTIONS . 'template-tags.php' );
    neira_lite_require_file( NEIRA_CORE_FUNCTIONS . 'custom-header.php' );
    
    // Load Widgets
    neira_lite_require_file( NEIRA_CORE_WIDGETS . 'neira-about-widget.php' );
    neira_lite_require_file( NEIRA_CORE_WIDGETS . 'neira-latest-posts-widget.php' );
}