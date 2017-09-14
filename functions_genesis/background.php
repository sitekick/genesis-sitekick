<?php
		
add_action ( 'genesis_before_header', 'backgroundObject', 1 );


function backgroundObject() {
	
	printf('<object id="svgBg" type="image/svg+xml" data="%s/assets/img/bodySvgOpt.svg" class="background"></object>',
	get_stylesheet_directory_uri());
	
}