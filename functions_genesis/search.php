<?php
	

//add_filter('genesis_search_text', 'sitekick_search_text');

function sitekick_search_text( $text ) {
	return esc_attr( 'Search' );
}

add_filter('genesis_search_button_text', 'sitekick_search_button_text');

function sitekick_search_button_text( $text ) {
	return esc_attr( 'Go' );
}

remove_filter( 'get_search_form', 'genesis_search_form' );
add_filter( 'get_search_form', 'sitekick_search_form' );

function sitekick_search_form() {
	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) . ' &#x02026;' );

	$button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );

	$onfocus = "if ('" . esc_js( $search_text ) . "' === this.value) {this.value = '';}";
	$onblur  = "if ('' === this.value) {this.value = '" . esc_js( $search_text ) . "';}";

	// Empty label, by default. Filterable.
	$label = apply_filters( 'genesis_search_form_label', '' );

	$value_or_placeholder = ( get_search_query() == '' ) ? 'placeholder' : 'value';

	if ( genesis_html5() ) {

		$string = genesis_attr( 'search-form' ) ;
		$string .= ' tabindex="0"';
		$form  = sprintf( '<form %s>', $string );
		
		if ( genesis_a11y( 'search-form' ) ) {

			if ( '' == $label )  {
				$label = apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) );
			}

			$form_id = uniqid( 'searchform-', true );

			$form .= sprintf(
				'<meta itemprop="target" content="%s"/><label class="search-form-label screen-reader-text" for="%s">%s</label><input itemprop="query-input" type="search" name="s" id="%s" placeholder="Search" /><input type="submit" value="%s" /></form>',
				home_url( '/?s={s}' ),
				esc_attr( $form_id ),
				esc_html( $label ),
				esc_attr( $form_id ),
				//value="%s"
				//apply_filters( 'the_search_query', get_search_query() ),
				esc_attr( $button_text )
			);

		} else {

			$form .= sprintf(
				'%s<meta itemprop="target" content="%s"/><input itemprop="query-input" type="search" name="s" %s="%s" /><input type="submit" value="%s"  /></form>',
				esc_html( $label ),
				home_url( '/?s={s}' ),
				$value_or_placeholder,
				esc_attr( $search_text ),
				esc_attr( $button_text )
			);
		}


	} else {

		$form = sprintf(
			'<form method="get" class="searchform search-form" action="%s" role="search" >%s<input type="text" value="%s" name="s" class="s search-input" onfocus="%s" onblur="%s" /><input type="submit" class="searchsubmit search-submit" value="%s" /></form>',
			home_url( '/' ),
			esc_html( $label ),
			esc_attr( $search_text ),
			esc_attr( $onfocus ),
			esc_attr( $onblur ),
			esc_attr( $button_text )
		);

	}

	return apply_filters( 'genesis_search_form', $form, $search_text, $button_text, $label );

}
