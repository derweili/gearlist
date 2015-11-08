<?php
//Add or Remove Sublist


function addRemoveSublist(){

	//
	//Add Subliste
	//
	if (isset($_GET["newsublist"])) {
		$addsublist = $_GET["newsublist"];

		if( $addsublist != ''){ 
			$allsublists = get_post_meta( get_the_ID(), 'sublists' ); 
			if (in_array($addsublist, $allsublists)) { //Check is a sublist with this name already exists if.
			}
			else{
				add_post_meta( get_the_ID(), 'sublists', $addsublist, false);
			}
		}
	}

	//
	//Subliste löschen
	//
	if (isset($_GET["removesublist"])) {
		$removesublist = $_GET["removesublist"];
		if ($removesublist != '') {
			delete_post_meta(get_the_ID(), "sublists", $removesublist);
		}
	}


}

add_action('wp_head', 'addRemoveSublist');