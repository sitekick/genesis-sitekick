<?php

//add_filter('widget_text', 'do_shortcode');

/**
* Site name shortcode
*/

function sitekick_sitename_shortcode() {
	return get_bloginfo();
}

add_shortcode( 'sitename', 'sitekick_sitename_shortcode' );