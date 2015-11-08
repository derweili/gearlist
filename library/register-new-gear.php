<?php

function registerNewGear(){

	//
	// Element
	//
	if (isset($_GET["newitem"])) {
		$NewItem = $_GET["newitem"];
		$gearItemName = $_GET["gearitemname"];
		$gearItemWeight = $_GET["gearitemweight"];
		$gearItemType = $_GET["gearitemtype"];

		if ($NewItem != '') {
			$my_post = array(
			  'post_title'    => $gearItemName,
			  'post_type' => 'gear',
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  'tax_input'	  => array('geartype' => $gearItemType)
			);

			// Insert the post into the database
			$new_post_id = wp_insert_post( $my_post );
			add_post_meta($new_post_id, 'gearlist_weight', $gearItemWeight, false);
		}
	}

	//
	// Register New Gearlist
	//
	if (isset($_GET["gearlistname"])) {
		$gearlistName = $_GET["gearlistname"];
		$newGearlist = $_GET["newgearlist"];
		if ($newGearlist != '') {
			$my_post = array(
			  'post_title'    => $gearlistName,
			  'post_type' => 'gearlist',
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			);

			// Insert the post into the database
			$new_post_id = wp_insert_post( $my_post );
		}
	}

	//Delete Post Or Gear
	if (isset($_GET["deletepost"])) {
		$deltePost = $_GET["deletepost"];
		$deletePostId = $_GET["deletepostid"];
		if ($deltePost != '') {
			wp_delete_post($deletePostId);
		}
	}


	//
	// New Geartype Taxonomie
	//
	if (isset($_GET["newgeartype"])) {
		$newGearType = $_GET["newgeartype"];
		$newGearTypeName = $_GET["geartypename"];
		if ($newGearType != '') {
			wp_insert_term($newGearTypeName, 'geartype');
		}
	}
}

add_action('wp_head', 'registerNewGear');