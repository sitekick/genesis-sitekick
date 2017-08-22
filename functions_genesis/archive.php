<?php
	
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
add_action('genesis_after_header', 'genesis_do_taxonomy_title_description', 15);
remove_filter( 'genesis_attr_taxonomy-archive-description', 'genesis_attributes_taxonomy_archive_description' );
add_filter('genesis_attr_taxonomy-archive-description','sitekick_attributes_taxonomy_archive_description');


function sitekick_attributes_taxonomy_archive_description( $attributes ) {

	$attributes['class'] = 'title-banner archive-description taxonomy-archive-description taxonomy-description';

	return $attributes;

}

// Remove Post Info, Post Meta from Archive Pages
function sitekick_archive_entry_header() {
	if (is_archive() || is_home() ) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		}
		
	if ( is_home() ) {
		add_action ( 'genesis_entry_header', 'sitekick_category_image', 12 );
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
	$op .= '<div class="responsive-sprite"></div>';
	$op .= '</div>';
	
	print $op;
	
}



function sitekick_excerpt_length($length) {
	
	return 20;
	
}






//add_action('genesis_before_loop', 'sitekick_change_home_loop');



function sitekick_change_home_loop() {

	if ( is_home() ) {
		/** Replace the home loop with our custom **/
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'sitekick_home_loop' );
	}
}
	
	
function sitekick_home_loop() {
	
	if ( have_posts() ) :

		do_action( 'genesis_before_while' );
		while ( have_posts() ) : the_post();

			do_action( 'genesis_before_entry' );

			genesis_markup( array(
				'open'    => '<article %s>',
				'context' => 'entry',
			) );

				do_action( 'genesis_entry_header' );

				do_action( 'genesis_before_entry_content' );

				printf( '<div %s>', genesis_attr( 'entry-content' ) );
				do_action( 'genesis_entry_content' );
				echo '</div>';

				do_action( 'genesis_after_entry_content' );

				do_action( 'genesis_entry_footer' );

			genesis_markup( array(
				'close'   => '</article>',
				'context' => 'entry',
			) );

			do_action( 'genesis_after_entry' );

		endwhile; // End of one post.
		do_action( 'genesis_after_endwhile' );

	else : // If no posts exist.
		do_action( 'genesis_loop_else' );
	endif; // End loop.

}
