<?php
	
	
add_filter('wp_generate_tag_cloud', 'xf_tag_cloud',10,3);

function xf_tag_cloud($tag_string){
   return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}