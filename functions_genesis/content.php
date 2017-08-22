<?php
	
	
	add_action('genesis_after_header', 'sitekick_after_header');
	
	function sitekick_after_header() {
		
		if ( is_singular('page') || is_singular('post') || is_front_page() ) {
        	add_action('genesis_after_header', 'sitekick_do_post_title', 12);
    	} 
    	   
    	
	}
	
	function sitekick_do_post_title() {
		
		if( !is_page_template( 'page_landing.php' ) ) {
					
			genesis_markup( array(
			'open'    => '<div %s>',
			'context' => 'title-banner',
			) );
			
			if( is_front_page() ) {
				
				genesis_markup( array(
					'open'    => '<h1 %s>',
					'context' => 'entry-title',
					'content' => SITEKICK_TITLE_HOME,
					'close' => '</h1>'
				) );
			
			} else {
				genesis_do_post_title();
			}
				
			genesis_markup( array(
			'close'    => '</div>'
			) );
		}
	}
	

