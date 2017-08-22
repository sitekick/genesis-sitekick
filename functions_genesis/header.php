<?php 
	

remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'sitekick_genesis_do_header' );

function sitekick_genesis_do_header() {

	global $wp_registered_sidebars;

	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'title-area',
	) );
			//create empty anchor for logo sprite
			genesis_markup( array(
				'open'   => '<div %s>',
				'close'   => '</div>',
				'content' => '<a href="/"></a>',
				'context' => 'sitekick-logo',
			) );
			//mobile menu toggle
			//create empty anchor for logo sprite
			genesis_markup( array(
				'open'   => '<div %s>',
				'close'   => '</div>',
				'content' => '<div></div>',
				'context' => 'menu-toggle',
			) );	
				
	genesis_markup( array(
		'close'    => '</div>',
		'context' => 'title-area',
	) );

	if ( has_action( 'genesis_header_right' ) || ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) ) {

		genesis_markup( array(
			'open'    => '<div %s>' . genesis_sidebar_title( 'header-right' ),
			'context' => 'header-widget-area',
		) );

			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		genesis_markup( array(
			'close'   => '</div>',
			'context' => 'header-widget-area',
		) );

	}

}

