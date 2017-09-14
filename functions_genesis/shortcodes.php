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

add_shortcode( 'post_to_top', 'sitekick_to_top_shortcode' );

function sitekick_to_top_shortcode( $atts ) {

	$defaults = array(
		'after'  => '',
		'before' => '',
		'anchor' => 'Back to top',
		'target' => '#top'
		);
	
	$atts = shortcode_atts( $defaults, $atts, 'post_shortcode' );

	
	if ( genesis_html5() ) {
		
		$anchor = sprintf( '%s<a href="%s">%s</a>%s',
		$atts['before'],
		$atts['target'],
		$atts['anchor'],
		$atts['after']
		);
	
		$output = sprintf( '<span %s>', genesis_attr( 'entry-totop' ) ) . $anchor . '</span >';
	} else {
		$anchor = $atts['before'] . '<a href="' . $atts['target'] . '">' . $atts['anchor'] . '</a>' . $atts['after'];
		$output = '<span class="entry-totop">' . $anchor . '</span>';
	}

	return apply_filters( 'sitekick_to_top_shortcode', $output, $atts );

}

