<?php 
	
	// Enqueue Scripts and Styles

add_action( 'wp_enqueue_scripts', 'genesis_sitekick_enqueue_scripts_styles' );

function genesis_sitekick_enqueue_scripts_styles() {

	//Styles
	wp_enqueue_style( 'dashicons' );
	
	//jQuery UI 
	wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    
	//Scripts
/*
	wp_enqueue_script( 'sitekick-js-modernizr',  get_stylesheet_directory_uri() . '/src/js/00_modernizr.build.js', array(), '3.5', true );
	wp_enqueue_script( 'sitekick-js-resize-query',  get_stylesheet_directory_uri() . '/src/js/05_resizeQuery.js', array(), '2.0', true );
	wp_enqueue_script( 'sitekick-js-document-ready',  get_stylesheet_directory_uri() . '/src/js/10_document.ready.js', array( 'jquery' ), '1.0', true );
*/
	
	//Scripts
	wp_enqueue_script( 'sitekick-scripts',  get_stylesheet_directory_uri() . '/assets/js/scripts.js', array(), '', true );

}