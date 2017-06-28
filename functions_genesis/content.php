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
		
		genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'title-banner',
		) );
		
		if(! is_front_page() ) {
			genesis_do_post_title();
		} else {
			genesis_markup( array(
			'open'    => '<h1 %s>',
			'context' => 'entry-title',
			'content' => 'Latest Advice for your Website',
			'close' => '</h1>'
			) );
		}
			
		genesis_markup( array(
		'close'    => '</div>'
		) );
	}
	
	
	function sitekick_do_loop() {

		//added wrapper
		genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'wrap',
		) );
	
		genesis_do_loop();
	
/*
	if ( is_page_template( 'page_blog.php' ) ) {

		$include = genesis_get_option( 'blog_cat' );
		$exclude = genesis_get_option( 'blog_cat_exclude' ) ? explode( ',', str_replace( ' ', '', genesis_get_option( 'blog_cat_exclude' ) ) ) : '';
		$paged   = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		// Easter Egg.
		$query_args = wp_parse_args(
			genesis_get_custom_field( 'query_args' ),
			array(
				'cat'              => $include,
				'category__not_in' => $exclude,
				'showposts'        => genesis_get_option( 'blog_cat_num' ),
				'paged'            => $paged,
			)
		);

		genesis_custom_loop( $query_args );
	} else {
		genesis_standard_loop();
	}
*/
	
		genesis_markup( array(
		'close' => '</div>',
		) );

}
