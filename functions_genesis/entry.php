<?php


// Add featured image on single post
add_action( 'genesis_entry_header', 'sitekick_featured_image', 10 );

function sitekick_featured_image() {
	$image = genesis_get_image( array( // more options here -> genesis/lib/functions/image.php
			'format'  => 'html',
			'size'    => 'large',			
			'context' => '',
			'attr'    => array ( 'class' => 'aligncenter responsive' ), // set a default WP image class

		) );
	if ( is_singular()) {
		if ( $image ) {
			printf( '<div class="featured-image">%s</div>', $image ); // wraps the featured image in a div with css class you can control
		}
	}
}
