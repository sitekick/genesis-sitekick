<?php
	
	
add_filter('genesis_footer_creds_text', 'sitekick_footer_creds_filter');

function sitekick_footer_creds_filter( $creds ) {
	$creds = sprintf( '[footer_copyright before="%s "] &#x000B7; [sitename] &#x000B7;  [footer_loginout]', __( 'Copyright', 'genesis-sitekick' ) );
	
	return $creds;
}

