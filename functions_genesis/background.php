<?php
	
	
add_action ( 'genesis_before_header', 'backgroundObject', 1 );



function backgroundObject() {
	
	print '<object id="svgBg" type="image/svg+xml" data="' . get_stylesheet_directory_uri() . '/assets/img/background.svg" class="background">Kiwi Logo <!-- fallback image in CSS --></object>';
	
}