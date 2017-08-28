<?php
	

// Remove Post Info, Post Meta from Archive Pages
function sitekick_archive_entry_header() {
	if (is_archive() || is_home() ) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		add_filter( 'genesis_post_meta', 'sitekick_entry_meta_footer' );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		}
		
	if ( is_home() ) {
		add_action ( 'genesis_entry_header', 'sitekick_page_image', 12 );
	}
	if ( is_archive() ) {
		add_action ( 'genesis_entry_header', 'genesis_do_post_image', 8 );
	}
}


function get_read_more_link() {
   return '... <a class="read-more" href="' . get_permalink() . '">Read More</a>';
}

add_action ( 'genesis_before_entry', 'sitekick_archive_entry_header' );

function genesis_sitekick_post_title() {
	 print '<h2 class="entry-title" itemprop="headline">' . get_the_title() . '</h2> ';
}


function sitekick_archive_entry_content() {
	
	if ( is_archive() || is_home() ) {
		
		add_action( 'genesis_entry_content', 'genesis_sitekick_post_title', 1 );
		
		add_filter('excerpt_length', 'sitekick_excerpt_length');
		// Add Read More Link to Excerpts
		add_filter('excerpt_more', 'get_read_more_link');
		add_filter( 'the_content_more_link', 'get_read_more_link' );
		}
	
	
}

add_action ( 'genesis_before_entry', 'sitekick_archive_entry_content' );

function sitekick_before_loop() {
	
	if( is_home() ) {
		remove_action('genesis_loop', 'genesis_do_loop');
		add_action( 'genesis_loop', 'sitekick_custom_home_loop' );
	}
}

function sitekick_custom_home_loop() {
 
    global $paged; // current paginated page
    global $query_args; // grab the current wp_query() args
   
	$args = array(
		'post_type' => 'page',
		'post_name__in' => array('web-design','google-adwords-ppc', 'usability', 'content-strategy', 'google-analytics', 'search-engine-optimization' ),
		'orderby' => 'name',
		'order'   => 'ASC',
		'post_status' => 'published'
	);
    
    genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}

add_action ( 'genesis_before_loop', 'sitekick_before_loop' );

function sitekick_category_image() {
	
	$category = get_the_category();
	
	$op = '<div class="entry-image ' . $category[0]->slug .'">';
	$op .= file_get_contents( get_stylesheet_directory_uri() . '/assets/img/categorySprites/' . $category[0]->slug . '.svg');
	$op .= '</div>';
	
	print $op;
	
}

function sitekick_page_image() {
	//temporary until post content available
	$slug = get_post_field( 'post_name', get_post() );
	
	$filename ='';
	
	switch($slug) {
		case 'content-strategy' :
		case 'usability' :
		case 'web-design' :
		$filename = $slug;
		break;
		case 'search-engine-optimization' :
		$filename = 'seo';
		break;
		case 'google-adwords-ppc' :
		$filename = 'ppc';
		break;
		case 'google-analytics' :
		$filename = 'analytics';
		break;
	}
	
	$op = '<div class="entry-image ' . $filename .'">';
	$op .= file_get_contents( get_stylesheet_directory_uri() . '/assets/img/categorySprites/' . $filename . '.svg');
	$op .= '</div>';
	
	print $op;
	
}

function sitekick_excerpt_length($length) {
	
	return 25;
	
}

function sitekick_entry_meta_footer($post_meta) {
	
	return !is_archive() ? '[post_categories before=""]' : '[post_date]';
	
}

add_action( 'genesis_before_loop', 'sitekick_output_taxonomy_intro_text', 8 );
function sitekick_output_taxonomy_intro_text() {
	
	global $wp_query;

	if ( ! is_category() && ! is_tag() && ! is_tax() ) {
		return;
	}

	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

	if ( ! $term ) {
		return;
	}

	
	$intro_text = get_term_meta( $term->term_id, 'intro_text', true );
	$intro_text = apply_filters( 'genesis_term_intro_text_output', $intro_text ? $intro_text : '' );

	echo $intro_text;
}