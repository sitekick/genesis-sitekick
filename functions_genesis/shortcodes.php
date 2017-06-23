<?php

/**
* Site name shortcode
*/

function sitekick_sitename_shortcode() {
	return get_bloginfo();
}

add_shortcode( 'sitename', 'sitekick_sitename_shortcode' );