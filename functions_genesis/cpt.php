<?php
	
/*=============CUSTOM POST TYPE - PRODUCTS===============*/


function sitekick_cpt_scripts() {
	
	if ( 'products' == get_post_type() ) {
		wp_enqueue_script( 'slider-product', get_stylesheet_directory_uri()  . '/js/slider-product-init.js', array('carousel-base'), FALSE, FALSE);
	}

}

//add_action( 'wp_enqueue_scripts', 'sitekick_cpt_scripts' );

add_action('init', 'services_register');
 
function services_register() {
 
	$labels = array(
		'name' => _x('Services', 'post type general name'),
		'singular_name' => _x('Service', 'post type singular name'),
		'add_new' => _x('Add New Service', 'portfolio item'),
		'add_new_item' => __('Add New Services'),
		'edit_item' => __('Edit Service'),
		'new_item' => __('New Service'),
		'view_item' => __('View Service'),
		'search_items' => __('Search Services'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-tablet',
		'supports' => array('title','editor','excerpt','thumbnail','genesis-seo','genesis-cpt-archives-settings')
	  ); 
 
	register_post_type( 'services' , $args );
}



/**
 * Adds a box to the main column on the Testimonial edit screens for Company Field
 */
function services_add_meta_boxes() {

	$screens = array( 'services');

	foreach ( $screens as $screen ) {
		add_meta_box('service_plans',__( 'Service Plans', 'genesis-sitekick_textdomain' ),'service_plans_meta_box_callback',$screen);
	}
}

add_action( 'add_meta_boxes', 'services_add_meta_boxes' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function service_plans_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'service_marketmaster_meta_box', 'service_marketmaster_meta_box_nonce' );
	
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	
	$values = get_post_meta( $post->ID);
	
	$checked_new = ( !empty($values['_service_marketmaster_key'][0]) ) ? 'checked' : '';
	$op = '<p><input type="checkbox" name="service_marketmaster_field" id="service_marketmaster_field" value="true"  ' . $checked_new   .'/>';
	$op .=   '<label for="service_marketmaster_field">' . __( 'This is a Marketmaster service', 'genesis-sitekick_textdomain' ) . '</label></p>';
	$op .= '<hr>';
	
			
	print $op;
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function service_marketmaster_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['service_marketmaster_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['service_marketmaster_meta_box_nonce'], 'service_marketmaster_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'services' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_pages', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_pages', $post_id ) ) {
			return;
		}
	}

	/* OK, its safe for us to save the data now. */
	
	
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['service_marketmaster_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_service_marketmaster_key', $my_data );
}
add_action( 'save_post', 'service_marketmaster_save_meta_box_data' );




/*
function floclear_get_product_status() {
	
	$values = get_post_meta( get_the_ID() );
	
	$new = $values['_product_new_key'][0];
	$retired = $values['_product_retired_key'][0];
	
	if( !empty($retired) ){
		$span = '<div class="entry-status retired">Retired</div>';
		print $span;
		return;
	}
	
	if( !empty($new) ){
		$span = '<div class="entry-status new">New</div>';
		print $span;
	}
	
}
*/

/*
function get_promotion() {
	
	
	$pid =  get_the_ID();
	
	$news = new WP_Query( array(
				  'post_type' => 'post',
				  'category_name' => 'promotions',
				  'meta_query' => array(
				  					array(
				  						'key'     => 'Promote',
				  						'value'   => $pid,
				  						'compare' => '=',
				  						),
				  						),
				  'posts_per_page' => 1, 
				  'orderby' => 'date',
				  'order'   => 'DESC',
				  'post_status'  => 'publish',
				  ) );
	 		 
		
		while ( $news->have_posts() ) : $news->the_post();
									
				$op  = '<h2>Current Promotion on this Product:</h2>';
				$op .= '<div class="promotion">';
				$op .= '<a href="'. get_permalink() . '" title="Click to view promotion">';
				$op .= the_title('<h3>', '</h3>', false);
				$op .= '</a></div>';
				
		
		endwhile;	
				
		if( !empty($op) ) {
			print $op;	
			}
		
		
		wp_reset_postdata();
			
		
			
}
*/


/*=============CUSTOM POST TYPE - TESTIMONIALS===============*/

//add_action('init', 'testimonials_register');
 
function testimonials_register() {
 
	$labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio item'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonials'),
		'search_items' => __('Search Testimonials'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-format-quote',
		'supports' => array('title','editor','genesis-cpt-archives-settings')
	  ); 
 
	register_post_type( 'testimonials' , $args );
}




/**
 * Adds a box to the main column on the Testimonial edit screens for Company Field
 */
function testimonials_add_meta_boxes() {

	$screens = array( 'testimonials');

	foreach ( $screens as $screen ) {
		add_meta_box('testimonial_company',__( 'Company', 'floclear_textdomain' ),'company_meta_box_callback',$screen);
	}
}
add_action( 'add_meta_boxes', 'testimonials_add_meta_boxes' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function company_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'testimonial_company_meta_box', 'testimonial_company_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_testimonial_company_key', true );

	echo '<label for="testimonial_company_field">';
	_e( 'Company Name', 'floclear_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="testimonial_company_name" name="testimonial_company_name" value="' . esc_attr( $value ) . '" size="40" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function testimonial_company_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['testimonial_company_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['testimonial_company_meta_box_nonce'], 'testimonial_company_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'testimonials' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_pages', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_pages', $post_id ) ) {
			return;
		}
	}

	/* OK, its safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['testimonial_company_name'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['testimonial_company_name'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_testimonial_company_key', $my_data );
}
add_action( 'save_post', 'testimonial_company_save_meta_box_data' );

/*============= DEALERS ================*/

//add_action('init', 'dealers_register');
 
function dealers_register() {
 
	$labels = array(
		'name' => _x('Dealers', 'post type general name'),
		'singular_name' => _x('Dealer', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio item'),
		'add_new_item' => __('Add New Dealer'),
		'edit_item' => __('Edit Dealer'),
		'new_item' => __('New Dealer'),
		'view_item' => __('View Dealer'),
		'search_items' => __('Search Dealers'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-admin-users',
		'supports' => array('title','editor','thumbnail','genesis-cpt-archives-settings')
	  ); 
 
	register_post_type( 'dealers' , $args );
}

/* custom thumbnail size for dealer logos */ 

//add_image_size( 'dealer-logos', 0, 80, false );
