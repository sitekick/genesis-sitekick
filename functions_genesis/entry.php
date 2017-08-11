<?php

add_action( 'get_header', 'remove_titles_all_single' );

function remove_titles_all_single() {
    
    if ( is_singular('page') || is_singular('post')) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}



// Add featured image on single post
add_action( 'genesis_entry_header', 'sitekick_featured_image', 10 );

function sitekick_featured_image() {
	$image = genesis_get_image( array( // more options here -> genesis/lib/functions/image.php
			'format'  => 'html',
			'size'    => 'motion-image',			
			'context' => '',
			'attr'    => array ( 'class' => 'aligncenter' ), // set a default WP image class

		) );
	if ( is_singular()) {
		if ( $image ) {
			printf( '<div class="featured-image-class">%s</div>', $image ); // wraps the featured image in a div with css class you can control
		}
	}
}
