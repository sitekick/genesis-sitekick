<?php

//add_filter('widget_text', 'do_shortcode');

/**
* Site name shortcode
*/

function sitekick_sitename_shortcode() {
	return get_bloginfo();
}

add_shortcode( 'sitename', 'sitekick_sitename_shortcode' );


add_shortcode( 'post_readmore', 'sitekick_post_readmore_shortcode' );

function sitekick_post_readmore_shortcode( $atts ) {

	$defaults = array(
		'after'  => '',
		'before' => '',
		'anchor' => 'read more'
		);
	
	$atts = shortcode_atts( $defaults, $atts, 'post_shortcode' );

	$permalink = get_the_permalink();
	// Do nothing if no tags.
	if ( ! $permalink ) {
		return '';
	}

	if ( genesis_html5() ) {
		
		$anchor = sprintf( '%s<a href="%s" class="read-more">%s</a>%s',
		$atts['before'],
		$permalink,
		$atts['anchor'],
		$atts['after']
		);
	
		$output = sprintf( '<span %s>', genesis_attr( 'entry-readmore' ) ) . $anchor . '</span >';
	} else {
		$anchor = $atts['before'] . '<a href="' . $permalink . '" class="read-more">' . $atts['anchor'] . '</a>' . $atts['after'];
		$output = '<span class="entry-readmore">' . $anchor . '</span>';
	}

	return apply_filters( 'sitekick_post_readmore_shortcode', $output, $atts );

}