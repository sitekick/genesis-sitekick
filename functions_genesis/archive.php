<?php


// Remove Post Info, Post Meta from Archive Pages
function sitekick_archive_entry_header() {
	
	if (is_archive() || is_home() ) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	}
		
	if ( is_home() ) {
		add_action ( 'genesis_entry_header', 'sitekick_category_image', 12 );
	}
	
	if ( is_archive() ) {
		add_action ( 'genesis_entry_header', 'genesis_do_post_image', 8 );
	}
	
	if( is_post_type_archive('services') ) {
		add_action ( 'genesis_entry_header', 'sitekick_do_named_anchor', 5 );
	}
		
}

function sitekick_do_named_anchor() {
   
   $slug = str_replace(' ', '-', strtolower( get_the_title() ));
  
   printf('<a name="%s"></a>', $slug) ;
   
}

add_action ( 'genesis_before_entry', 'sitekick_archive_entry_header' );

function genesis_sitekick_post_title() {
	 print '<h2 class="entry-title" itemprop="headline">' . get_the_title() . '</h2> ';
}

function sitekick_entry_content_footer_markup_open() {
	printf( '<footer %s>', genesis_attr( 'entry-content-footer' ) );
}

function sitekick_entry_content_footer_markup_close() {
	echo '</footer>';
}


function sitekick_archive_entry_content() {
	
	if ( is_archive() || is_home() ) {
		
		add_action( 'genesis_entry_content', 'genesis_sitekick_post_title', 1 );
		
		add_filter('excerpt_length', 'sitekick_excerpt_length');
		
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5);
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15);
		
		add_action( 'genesis_entry_content', 'sitekick_entry_content_footer_markup_open', 12);
		add_filter( 'genesis_post_meta', 'sitekick_entry_meta_footer' );
		add_action( 'genesis_entry_content', 'genesis_post_meta', 14 );
		add_action( 'genesis_entry_content', 'sitekick_entry_content_footer_markup_close', 15 );
		
		}
}

add_action ( 'genesis_before_entry', 'sitekick_archive_entry_content' );

// Change posts per page in the design category
add_action( 'pre_get_posts', 'sitekick_service_posts_per_page' );

function sitekick_service_posts_per_page( $query ) {
	if( $query->is_main_query() && is_post_type_archive( 'services' ) && ! is_admin() ) {
		$query->set( 'posts_per_page', -1 );
	}
}

add_filter('genesis_cpt_archive_intro_text_output', 'sitekick_filter_intro_text');


function sitekick_filter_intro_text($intro_text) {
	return $intro_text .= sitekick_service_panels();
}


function sitekick_before_loop() {
	
	if( is_home() ) {
		//remove_action('genesis_loop', 'genesis_do_loop');
		//add_action( 'genesis_loop', 'sitekick_custom_home_loop' );
	}
	
	if ( is_post_type_archive('services') ) {
		//add_action( 'genesis_loop', 'sitekick_service_panels', 5 );
	}
}

function sitekick_service_panels() {
	
	$args = array(
	  'post_type' => 'services',
	  'posts_per_page' => -1, 
	  'meta_key' => '_service_marketmaster_key',
	  'orderby' => array (
	  	'meta_value' => 'ASC',
	  	'menu_order'   => 'ASC'
	  ),
	  'post_status'  => 'publish',
	);
	
	$services = new WP_Query( $args );
	 	
	$webservices = 	'<ul class="services">';
		
		while ( $services->have_posts() ) : $services->the_post();
				$values = get_post_meta( get_the_ID() );
				$class = ($values['_service_marketmaster_key'][0]) ? 'marketmaster' : 'webmaster';
				$title = get_the_title();
				$slug = str_replace(' ', '-', strtolower( $title ));
				$webservices .= sprintf('<li class="%s"><a href="#%s">%s</a></li>', $class, $slug, $title);
				
		endwhile;	
	$webservices .= '</ul>';
	
	$op = '<div class="service-plans">';
	$op .= '<div class="plan webmaster">';
	$op .= '<h3>WebMaster</h3>';
	$op .= '<p>' . SITEKICK_WEBMASTER_PRICE .'/mo. <span>billed annually</span></p>';
	$op .= $webservices;
	$op .= '</div>';
	$op .= '<div class="plan marketmaster">';
	$op .= '<h3>MarketMaster</h3>';
	$op .= '<p>' . SITEKICK_MARKETMASTER_PRICE .'/mo. <span>billed annually</span></p>';
	$op .= $webservices;
	$op .= '</div></div>';
	
	wp_reset_postdata();
	
	if( !empty($op) ) {
		return $op;	
		}
}

	
function sitekick_custom_home_loop() {
 
    global $paged; // current paginated page
    global $query_args; // grab the current wp_query() args
   
	$args = array(
		'post_type' => 'page',
		'post_name__in' => array('web-design','google-adwords-ppc', 'usability', 'content-strategy', 'google-analytics', 'search-engine-optimization' ),
		'orderby' => 'name',
		'order'   => 'ASC',
		'post_status' => 'published'
	);
    
    genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}

add_action ( 'genesis_before_loop', 'sitekick_before_loop' );

function sitekick_category_image() {
	
	$category = get_the_category();
	
	$op = '<div class="entry-image ' . $category[0]->slug .'">';
	$op .= file_get_contents( get_stylesheet_directory_uri() . '/assets/img/categorySprites/' . $category[0]->slug . '.svg');
	$op .= '</div>';
	
	print $op;
	
}

function sitekick_page_image() {
	//temporary until post content available
	$slug = get_post_field( 'post_name', get_post() );
	
	$filename ='';
	
	switch($slug) {
		case 'content-strategy' :
		case 'usability' :
		case 'web-design' :
		$filename = $slug;
		break;
		case 'search-engine-optimization' :
		$filename = 'seo';
		break;
		case 'google-adwords-ppc' :
		$filename = 'ppc';
		break;
		case 'google-analytics' :
		$filename = 'analytics';
		break;
	}
	
	$op = '<div class="entry-image ' . $filename .'">';
	$op .= file_get_contents( get_stylesheet_directory_uri() . '/assets/img/categorySprites/' . $filename . '.svg');
	$op .= '</div>';
	
	print $op;
	
}

function sitekick_excerpt_length($length) {
	
	return 35;
	
}

function sitekick_entry_meta_footer($post_meta) {
	
	switch(true){
		case is_category() :
		return '[post_readmore] [post_date before=" | "]';
		break;
		case is_home() :
		return '[post_readmore] [post_categories before=" | " after=""]';
		break;
		case is_post_type_archive('services') :
		return '[post_to_top]';
		break;
		default :
		return '[post_readmore] [post_date before=" | "]';
	}
	
}