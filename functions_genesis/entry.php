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
	
	$image2 = get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'responsive' ));
	
	
	if ( is_singular()) {
		if ( $image2 ) {
			printf( '<div class="featured-image">%s</div>', $image2 ); // wraps the featured image in a div with css class you can control
		}
	}
}
