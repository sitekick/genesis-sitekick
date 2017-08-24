<?php 
	
	/* The area between the header and content-sidebar-wrap */
	/*	for custom placement of custom page title  */
	
/*======= PAGES ==========*/
/*------- Remove ------*/

add_action( 'get_header', 'remove_titles_all_single' );

function remove_titles_all_single() {
    
    if(is_page_template( 'page_landing.php' ) ) 
	    return false;
	   
    if ( is_singular('page') || is_singular('post')  ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
    
    if( is_search() ) {
	    remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
    }
    
}


/*------- Replace ------*/

add_action('genesis_after_header', 'sitekick_after_header');
	
function sitekick_after_header() {
		
	if ( is_singular('page') || is_singular('post') || is_front_page() || is_search()) {
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
			
			} elseif( is_search() ) {
				genesis_do_search_title();
			} else {
				genesis_do_post_title();
			}
				
			genesis_markup( array(
			'close'    => '</div>'
			) );
		}
}

/*======= ARCHIVES ==========*/
/*------- Remove ------*/

remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
remove_filter( 'genesis_attr_taxonomy-archive-description', 'genesis_attributes_taxonomy_archive_description' );

add_action('genesis_after_header', 'genesis_do_taxonomy_title_description', 15);
add_filter('genesis_attr_taxonomy-archive-description','sitekick_attributes_taxonomy_archive_description');

/*------- Replace ------*/
function sitekick_attributes_taxonomy_archive_description( $attributes ) {

	$attributes['class'] = 'title-banner archive-description taxonomy-archive-description taxonomy-description';

	return $attributes;

}

