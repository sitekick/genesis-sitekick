<?php
	

add_filter('genesis_footer_creds_text', 'sitekick_footer_creds_filter');

function sitekick_footer_widgets_title() {
	
	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'footer-widgets-title',
		'content' => '<h2>Continuous website improvement:</h2>', 
		'close' => '</div>'
	) );


}

add_action( 'genesis_sidebar_title_output', function ( $heading, $id ) {
	if ( 'Footer' == $id ) {
		$heading = '<h2 class="genesis-sidebar-title">Continuous website improvement:</h2>';
	}

	return $heading;
}, 10, 2 );


function sitekick_footer_creds_filter( $creds ) {
	$creds = sprintf( '[footer_copyright before="%s "] &#x000B7; [sitename] &#x000B7;  [footer_loginout]', __( 'Copyright', 'genesis-sitekick' ) );
	
	return $creds;
}

