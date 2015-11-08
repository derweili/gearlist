<?php 
/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function registerGearList() {

	$labels = array(
		'name'                => __( 'Gear Lists', 'gearlist' ),
		'singular_name'       => __( 'Gear List', 'gearlist' ),
		'add_new'             => _x( 'Add New Gear List', 'gearlist', 'gearlist' ),
		'add_new_item'        => __( 'Add New Gear List', 'gearlist' ),
		'edit_item'           => __( 'Edit Gear List', 'gearlist' ),
		'new_item'            => __( 'New Gear List', 'gearlist' ),
		'view_item'           => __( 'View Gear List', 'gearlist' ),
		'search_items'        => __( 'Search Gear Lists', 'gearlist' ),
		'not_found'           => __( 'No Gear Lists found', 'gearlist' ),
		'not_found_in_trash'  => __( 'No Gear Lists found in Trash', 'gearlist' ),
		'parent_item_colon'   => __( 'Parent Gear List:', 'gearlist' ),
		'menu_name'           => __( 'Gear Lists', 'gearlist' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'author', 'thumbnail',
			'excerpt','custom-fields',
			'revisions'
			)
	);

	register_post_type( 'gearlist', $args );
}

add_action( 'init', 'registerGearList' );


/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function registerGear() {

	$labels = array(
		'name'                => __( 'Gears', 'gearlist' ),
		'singular_name'       => __( 'Gear', 'gearlist' ),
		'add_new'             => _x( 'Add New Gear', 'gearlist', 'gearlist' ),
		'add_new_item'        => __( 'Add New Gear', 'gearlist' ),
		'edit_item'           => __( 'Edit Gear', 'gearlist' ),
		'new_item'            => __( 'New Gear', 'gearlist' ),
		'view_item'           => __( 'View Gear', 'gearlist' ),
		'search_items'        => __( 'Search Gears', 'gearlist' ),
		'not_found'           => __( 'No Gears found', 'gearlist' ),
		'not_found_in_trash'  => __( 'No Gears found in Trash', 'gearlist' ),
		'parent_item_colon'   => __( 'Parent Gear:', 'gearlist' ),
		'menu_name'           => __( 'Gears', 'gearlist' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'author', 'thumbnail',
			'excerpt','custom-fields',
			'revisions'
			)
	);

	register_post_type( 'gear', $args );
}

add_action( 'init', 'registerGear' );


/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function registerGearType() {

	$labels = array(
		'name'					=> _x( 'Gear Types', 'Taxonomy plural name', 'gearlist' ),
		'singular_name'			=> _x( 'Gear Type', 'Taxonomy singular name', 'gearlist' ),
		'search_items'			=> __( 'Search Gear Types', 'gearlist' ),
		'popular_items'			=> __( 'Popular Gear Types', 'gearlist' ),
		'all_items'				=> __( 'All Gear Types', 'gearlist' ),
		'parent_item'			=> __( 'Parent Gear Type', 'gearlist' ),
		'parent_item_colon'		=> __( 'Parent Gear Type', 'gearlist' ),
		'edit_item'				=> __( 'Edit Gear Type', 'gearlist' ),
		'update_item'			=> __( 'Update Gear Type', 'gearlist' ),
		'add_new_item'			=> __( 'Add New Gear Type', 'gearlist' ),
		'new_item_name'			=> __( 'New Gear Type Name', 'gearlist' ),
		'add_or_remove_items'	=> __( 'Add or remove Gear Types', 'gearlist' ),
		'choose_from_most_used'	=> __( 'Choose from most used gearlist', 'gearlist' ),
		'menu_name'				=> __( 'Gear Type', 'gearlist' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'geartype', array( 'gear' ), $args );
}

add_action( 'init', 'registerGearType' );
 ?>