<?php
/**
 * Genesis Sitekick.
 *
 * This file adds functions to the Genesis Sitekick theme.
 *
 * @package Genesis Sitekick
 * @author  Hunter Williams
 * @license GPL-2.0+
 * @link    http://www.sitekick.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );


// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sitekick_localization_setup' );
function genesis_sitekick_localization_setup(){
	load_child_theme_textdomain( 'genesis-sitekick', get_stylesheet_directory() . '/languages' );
}

// Child theme 
define( 'CHILD_THEME_NAME', 'Genesis Sitekick' );
define( 'CHILD_THEME_URL', 'http://www.sitekick.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );


// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 4-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 2 );

// Add excerpts to pages
add_post_type_support( 'page', 'excerpt' );


foreach (glob(__DIR__ . '/functions_genesis/*.php') as $filename){
    require_once( $filename );
}