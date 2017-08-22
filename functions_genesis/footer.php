<?php
	

add_filter('genesis_footer_creds_text', 'sitekick_footer_creds_filter');


add_action( 'genesis_sidebar_title_output', function ( $heading, $id ) {
	if ( 'Footer' == $id ) {
		$heading = '<h2 class="genesis-sidebar-title">' . SITEKICK_TITLE_FOOTER . '</h2>';
	}

	return $heading;
}, 10, 2 );


function sitekick_footer_creds_filter( $creds ) {
	$creds = sprintf( '[footer_copyright before="%s "] &#x000B7; [sitename] &#x000B7;  [footer_loginout]', __( 'Copyright', 'genesis-sitekick' ) );
	
	return $creds;
}


function sitekick_footer_landing() {

	genesis_markup( array(
		'open'    => '<div %s>',
		'content' => get_bloginfo('description'),
		'context' => 'landing-footer-column',
		'close'    => '</div>',
	) );
	
	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'landing-footer-column',
	) );
			//create empty anchor for logo sprite
			genesis_markup( array(
				'open'   => '<div %s>',
				'close'   => '</div>',
				'content' => '<div></div>',
				'context' => 'sitekick-logo-footer',
			) );
				
	genesis_markup( array(
		'close'    => '</div>'
	) );
	
	genesis_markup( array(
		'open'    => '<div %s>',
		'content' => SITEKICK_PHONE,
		'context' => 'landing-footer-column',
		'close'    => '</div>',
	) );

}

