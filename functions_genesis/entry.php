<?php

add_action( 'get_header', 'remove_titles_all_single' );

function remove_titles_all_single() {
    
    if ( is_singular('page') || is_singular('post')) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}

