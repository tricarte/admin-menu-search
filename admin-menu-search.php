<?php
/*
Plugin Name: Admin Menu Search - Fixed
Plugin URI: https://github.com/tricarte/admin-menu-search
Description: Clone of admin-menu-search. Fixes the hardcoded wp-content directory url.
Version: 1.2
Author: tricarte
Author URI: https://github.com/tricarte
*/

add_action('admin_enqueue_scripts', 'fhqwhgads_load_scripts');
function fhqwhgads_load_scripts() {
	wp_enqueue_script( 'admin-menu-search', plugin_dir_url( __FILE__ )  . "/admin-menu-search.js", array(), '1.2', true );
    wp_localize_script( 'admin-menu-search', 'ams_consts', array(
        'plugin_dir' => plugin_dir_url( __FILE__ )
    )
    );
}

if ( is_admin() ) {
	add_filter( 'plugin_row_meta', 'fhqwhgads_donate_link', 10, 2 );
}

//Come on, Fhqwhgads...
function fhqwhgads_donate_link( $links, $file ) {
	if ( $file == 'admin-menu-search/admin-menu-search.php' ) {
		$donation_url  = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8NJPQ6RHLT5HN&source=url';
		$donation_url .= urlencode( sprintf( __( 'Donation for Admin Menu Search plugin: %s', 'admin-menu-search' ), "Admin Menu Search" ) );
		$links[] = '<a href="' . esc_url( $donation_url ) . '" target="_blank">' . __( 'Donate', 'admin-menu-search' ) . '</a>';
	}
	return $links;
}
