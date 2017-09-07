<?php
	
/*=============CUSTOM POST TYPE - SERVICES===============*/

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
	wp_nonce_field( 'service_promote_meta_box', 'service_promote_meta_box_nonce' );
	wp_nonce_field( 'service_benefit_meta_box', 'service_benefit_meta_box_nonce' );
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$fields = get_post_meta( $post->ID) ;
	
	$op = sprintf('<p><input type="checkbox" name="service_marketmaster_field" id="service_marketmaster_field" value="true" %s /><label for="service_marketmaster_field">%s</label></p><hr>',
	!empty( $fields['_service_marketmaster_key'][0] ) ? 'checked' : '',
	__( 'This is a Marketmaster service', 'genesis-sitekick_textdomain' ) 
	);
	$op .= sprintf('<p><input type="checkbox" name="service_promote_field" id="service_promote_field" value="true" %s /><label for="service_promote_field">%s</label></p><hr>',
	!empty( $fields['_service_promote_key'][0] ) ? 'checked' : '',
	__( 'Promote this service', 'genesis-sitekick_textdomain' ) 
	);
	$op .= sprintf('<p><label for="service_benefit_field">%s</label> <input type="text" name="service_benefit_field" size="35" id="service_benefit_field" value="%s" /></p><hr>',
	 __( 'Benefit', 'genesis-sitekick_textdomain' ),
	!empty( $fields['_service_benefit_key'] ) ? $fields['_service_benefit_key'][0] : '' );
	
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

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function service_promote_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['service_promote_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['service_promote_meta_box_nonce'], 'service_promote_meta_box' ) ) {
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
	$my_data = sanitize_text_field( $_POST['service_promote_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_service_promote_key', $my_data );
}
add_action( 'save_post', 'service_promote_save_meta_box_data' );


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function service_benefit_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['service_benefit_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['service_benefit_meta_box_nonce'], 'service_benefit_meta_box' ) ) {
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
	$my_data = sanitize_text_field( $_POST['service_benefit_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_service_benefit_key', $my_data );
}
add_action( 'save_post', 'service_benefit_save_meta_box_data' );

/*=============CUSTOM POST TYPE - QUOTES===============*/

add_action('init', 'quotes_register');
 
function quotes_register() {
 
	$labels = array(
		'name' => _x('Quotes', 'post type general name'),
		'singular_name' => _x('Quote', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio item'),
		'add_new_item' => __('Add New Quote'),
		'edit_item' => __('Edit Quote'),
		'new_item' => __('New Quote'),
		'view_item' => __('View Quotes'),
		'search_items' => __('Search Quotes'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => false,
		'has_archive' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'taxonomies'  => array( 'category' ),
		'menu_position' => null,
		'menu_icon' => 'dashicons-format-quote',
		'supports' => array('title','editor')
	  ); 
 
	register_post_type( 'quotes' , $args );
}




/**
 * Adds a box to the main column on the Testimonial edit screens for Company Field
 */
function quotes_add_meta_boxes() {

	$screens = array( 'quotes');

	foreach ( $screens as $screen ) {
		add_meta_box('quotes_source',__( 'Source', 'genesis-sitekick_textdomain' ),'quote_source_meta_box_callback',$screen);
	}
}
add_action( 'add_meta_boxes', 'quotes_add_meta_boxes' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function quote_source_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'quote_source_name_meta_box', 'quote_source_name_meta_box_nonce' );
	wp_nonce_field( 'quote_source_company_meta_box', 'quote_source_company_meta_box_nonce' );
	wp_nonce_field( 'quote_source_link_meta_box', 'quote_source_link_meta_box_nonce' );
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$name = get_post_meta( $post->ID, '_quote_source_name_key', true );
	$co = get_post_meta( $post->ID, '_quote_source_company_key', true );
	$link = get_post_meta( $post->ID, '_quote_source_link_key', true );
	
	$op = '<label for="quote_source_name">' . __( 'Name', 'genesis-sitekick_textdomain' ) . '</label>';
	$op .= '<input type="text"  id="quote_source_name" name="quote_source_name" value="' . esc_attr( $name ) . '" size="40" />';
	$op .= '<br><label for="quote_source_company">' . __( 'Company', 'genesis-sitekick_textdomain' ) . '</label>';
	$op .= '<input type="text" id="quote_source_company" name="quote_source_company" value="' . esc_attr( $co ) . '" size="40" />';
	$op .= '<br><label for="quote_source_link">' . __( 'Link', 'genesis-sitekick_textdomain' ) . '</label>';
	$op .= '<input type="text" id="quote_source_link" name="quote_source_link" value="' . esc_attr( $link ) . '" size="40" />';
	
	print $op;
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function quote_source_name_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['quote_source_name_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['quote_source_name_meta_box_nonce'], 'quote_source_name_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'quotes' == $_POST['post_type'] ) {

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
	if ( ! isset( $_POST['quote_source_name'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['quote_source_name'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_quote_source_name_key', $my_data );
}
add_action( 'save_post', 'quote_source_name_save_meta_box_data' );

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function quote_source_company_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['quote_source_company_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['quote_source_company_meta_box_nonce'], 'quote_source_company_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'quotes' == $_POST['post_type'] ) {

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
	if ( ! isset( $_POST['quote_source_company'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['quote_source_company'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_quote_source_company_key', $my_data );
}
add_action( 'save_post', 'quote_source_company_save_meta_box_data' );

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function quote_source_link_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['quote_source_link_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['quote_source_link_meta_box_nonce'], 'quote_source_link_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'quotes' == $_POST['post_type'] ) {

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
	if ( ! isset( $_POST['quote_source_link'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['quote_source_link'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_quote_source_link_key', $my_data );
}
add_action( 'save_post', 'quote_source_link_save_meta_box_data' );
