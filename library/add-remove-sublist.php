<?php
//Add or Remove Sublist


function addRemoveSublist(){

	//
	//Add Subliste
	//
	if (isset($_GET["newsublist"])) {
		$addsublist = $_GET["newsublist"];
		$baseweight = $_GET["baseweight"];
			
		addSublist(get_the_ID(), $addsublist, $baseweight);
			/*
			$my_post = array(
			  'post_title'    => $addsublist,
			  'post_type' => 'sublist',
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  //'tax_input'	  => array('geartype' => $gearItemType)
			);

			// Insert the post into the database
			$new_sublist_id = wp_insert_post( $my_post );

			add_post_meta( get_the_ID(), 'sublists', $new_sublist_id, false); //Add Sublist zu Gearlist
			add_post_meta( $new_sublist_id, 'parent_gearlist', get_the_ID(), true); //Add Gearlist to Sublist (cross-check)
			add_post_meta( $new_sublist_id, 'baseweight', $baseweight, true); //Add Baseweight to Sublist
			*/
	}

	//
	//Subliste löschen
	//
	if (isset($_GET["removesublist"])) {
		$removesublist = $_GET["removesublist"];
		if ($removesublist != '') {
			wp_delete_post( $removesublist, true );
			delete_post_meta(get_the_ID(), 'sublists', $removesublist);
		}
	}


}

add_action('wp_head', 'addRemoveSublist');



function addSublist($gearlistID, $addsublist, $baseweight){
	$my_post = array(
	  'post_title'    => $addsublist,
	  'post_type' => 'sublist',
	  'post_status'   => 'publish',
	  'post_author'   => get_current_user_id(),
	  //'tax_input'	  => array('geartype' => $gearItemType)
	);

	// Insert the post into the database
	$new_sublist_id = wp_insert_post( $my_post );

	add_post_meta( $gearlistID, 'sublists', $new_sublist_id, false); //Add Sublist zu Gearlist
	add_post_meta( $new_sublist_id, 'parent_gearlist', $gearlistID, true); //Add Gearlist to Sublist (cross-check)
	add_post_meta( $new_sublist_id, 'baseweight', $baseweight, true); //Add Baseweight to Sublist
}