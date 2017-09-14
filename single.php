<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */


// Force full width page layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5);
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15);


// This file handles single entries, but only exists for the sake of child theme forward compatibility.
genesis();
