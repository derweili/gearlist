<?php 

function gearlist_remove_admin_bar() {
		add_filter( 'show_admin_bar', '__return_false' );
}
add_action('wp', 'gearlist_remove_admin_bar');