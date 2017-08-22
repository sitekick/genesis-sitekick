<?php
/**
 * Genesis Sample.
 *
 * This file adds the landing page template to the Genesis Sample Theme.
 *
 * Template Name: Landing
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Add landing page body class to the head.
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {

	$classes[] = 'landing-page';

	return $classes;

}

// Remove Skip Links.
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );


// Dequeue Skip Links Script.
add_action( 'wp_enqueue_scripts', 'genesis_sample_dequeue_skip_links' );
function genesis_sample_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'sitekick_genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );


// Remove navigation.
remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_filter( 'genesis_attr_content', 'sitekick_landing_content_filter' );

function sitekick_landing_content_filter($attributes) {
  $attributes['class'] = $attributes['class'] . ' ' . 'content-landing';
  return $attributes;
}

// Remove footer widgets.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Site footer elements.
add_filter( 'genesis_attr_site-footer', 'sitekick_landing_footer_filter' );

function sitekick_landing_footer_filter($attributes) {
  $attributes['class'] = $attributes['class'] . ' ' . 'site-footer-landing';
  return $attributes;
}
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action('genesis_footer', 'sitekick_footer_landing');


//add entry footer
add_action( 'genesis_entry_footer', 'sitekick_entry_footer_markup_open', 5 );

function sitekick_entry_footer_markup_open() {
	printf( '<footer %s>', genesis_attr( 'entry-footer' ) );
}

add_action( 'genesis_entry_footer', 'sitekick_entry_footer_markup_close', 15 );

function sitekick_entry_footer_markup_close() {
	echo '</footer>';
}


//Custom fields
add_action( 'genesis_entry_header', 'sitekick_landing_header_fields', 12 );

function sitekick_landing_header_fields() {
  
   $subHeader = get_field('sub_headline');
   $teaserText = get_field('teaser_text');
   
   $op = '<a name="action"></a>';
   $op .= '<div class="entry-teaser">';
   $op .= '<h2>' . $subHeader . '</h2>';
   $op .= wpautop($teaserText);
   $op .= '</div>';
   
   print $op;
}
add_action( 'genesis_entry_content', 'sitekick_landing_content_action_fields', 9 );

function sitekick_landing_content_action_fields(){
	
	$buttonText = get_field('download_button_text');
	$formHeader = get_field('cform_header');
	$shortCode = get_field('cform_shortcode');
	$formFooter = get_field('cform_footer');
	
	$op = '<div class="entry-action">';
	$op .= '<div id="landing-page-image" class="magnet-image"><div></div></div>';
	$op .= '<div id="landing-page-form-close" class="close-btn"></div>';
	$op .= '<div class="magnet-form flex-content">';
	$op .= '<div class="column"><h3>' . $formHeader . '</h3></div>';
	$op .= '<div class="column">' . do_shortcode($shortCode) . '</div>';
	$op .= '<div class="column"><p>' . $formFooter . '</p></div>';
	$op .= '</div>';
	$op .= '<button id="landing-page-cta" class="btn btn-download btn-rounded btn-ucase btn-shadow">' . $buttonText . '</button>';
	$op .= '</div>';
	
	print $op;
}
add_action( 'genesis_entry_content', 'sitekick_landing_content_benefits_fields', 10 );

function sitekick_landing_content_benefits_fields(){
	
	$op = get_field('benefits_text');
	$op .= '<a id="landing-page-cta2" href="#action" class="btn btn-download btn-rounded btn-ucase btn-shadow">' . get_field('download_button_text') . '</a>';
	
	print $op;
}

add_action( 'genesis_entry_footer', 'sitekick_landing_footer_fields', 9 );

function sitekick_landing_footer_fields() {
   
   print get_field('entry_footer');
}

// Run the Genesis loop.
genesis();
