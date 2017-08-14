<?php
	
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action('genesis_loop' , 'sitekick_do_loop');
	
	add_action('genesis_before_content', 'sitekick_before_loop');
	
	function sitekick_before_loop() {
		
		if ( is_singular('page') || is_singular('post') || is_front_page() ) {
        add_action('genesis_before_loop', 'sitekick_do_post_title');
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
	
	function sitekick_do_loop() {

		//added wrapper
		genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'wrap',
		) );
		
/*
		if( is_page_template( 'page_landing.php' ) ){
			
			genesis_markup( array(
			'open'    => '<div %s>',
			'context' => 'entry-header'
			) );
			
			genesis_do_post_title();
			
			genesis_markup( array(
			'close' => '</div>'
			) );
			
		}
*/
		
		genesis_do_loop();
	
		genesis_markup( array(
		'close' => '</div>',
		) );

}
