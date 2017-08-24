<?php
	

// Remove Post Info, Post Meta from Archive Pages
function sitekick_archive_entry_header() {
	if (is_archive() || is_home() ) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		}
		
	if ( is_home() ) {
		add_action ( 'genesis_entry_header', 'sitekick_category_image', 12 );
		add_filter( 'genesis_post_meta', 'sitekick_entry_meta_footer' );
		add_action( 'genesis_entry_footer', 'genesis_post_meta', 12 );
		
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



function sitekick_category_image() {
	
	$category = get_the_category();
	
	$op = '<div class="entry-image ' . $category[0]->slug .'">';
	$op .= file_get_contents( get_stylesheet_directory_uri() . "/img/category.svg");
	$op .= '</div>';
	
	print $op;
	
}


function sitekick_excerpt_length($length) {
	
	return 25;
	
}



function sitekick_entry_meta_footer($post_meta) {
	$post_meta = '[post_categories before=""]';
	return $post_meta;
}