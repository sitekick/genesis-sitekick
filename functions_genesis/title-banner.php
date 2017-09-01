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
					'content' => get_bloginfo('description'),
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

remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_headline');

add_action('genesis_after_header', 'sitekick_archive_after_header');
	
function sitekick_archive_after_header() {
		
	if ( is_archive() ) {
        add_action('genesis_after_header', 'sitekick_do_archive_title', 12);
    } 
    	   	
}


function sitekick_do_archive_title() {

	global $wp_query;

	if ( is_category() || is_tag() || is_tax() ) {
		$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

		if ( ! $term ) {
			return;
		}
		
		$heading = get_term_meta( $term->term_id, 'headline', true );
		
		if ( empty( $heading ) && genesis_a11y( 'headings' ) ) {
			$heading = $term->name;
		}
		
	} else if ( is_post_type_archive() ) {
		
		$archive_settings = get_option( 'genesis-cpt-archive-settings-services' );
		
		$heading = trim($archive_settings['headline']) ? $archive_settings['headline'] : $wp_query->get_queried_object()->name;
	
	} else {
		return;
	}
	
	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'title-banner',
		'content' => '<a name="top"></a>'
	) );
			
	genesis_markup( array(
		'open'    => '<h1 %s>',
		'context' => 'archive-title',
		'content' => $heading,
		'close' => '</h1>'
	) );
	
	genesis_markup( array(
		'close'    => '</div>'
	) );

}

