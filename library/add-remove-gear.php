<?php

function addRemoveGear(){


	/**
	Delete Gear
	*/

	if (isset($_GET["removegear"])) {
	$removeGear = $_GET["removegear"];
	$removeGearSublist = $_GET["removegearsublist"];

		delete_post_meta($removeGearSublist, 'items', $removeGear); //Löschen wie gewünscht durchführen
		delete_post_meta($removeGearSublist, $removeGear . '-count' ); //Löschen wie gewünscht durchführen

	}

	/**
	 Reduce Gear
	*/

	if (isset($_GET["reducegear"])) {
	$reduceGear = $_GET["reducegear"];
	$reduceGearSublist = $_GET["reducegearsublist"];

		$current_gear_count = get_post_meta( $reduceGearSublist, $reduceGear . '-count', true );
		
		if($current_gear_count == 1){
			delete_post_meta($reduceGearSublist, 'items', $reduceGear); //Löschen wie gewünscht durchführen
			delete_post_meta($reduceGearSublist, $reduceGear . '-count' ); //Löschen wie gewünscht durchführen
		}else{
			$new_gearcount = $current_gear_count - 1;
			update_post_meta($reduceGearSublist, $reduceGear . '-count', $new_gearcount, $current_gear_count);
		}
	}

	/**
	Increase Gear
	*/

	if (isset($_GET["increasegear"])) {
	$increaseGear = $_GET["increasegear"];
	$increaseGearSublist = $_GET["increasegearsublist"];

		$current_gear_count = get_post_meta( $increaseGearSublist, $increaseGear . '-count', true );

		$new_gearcount = $current_gear_count + 1;

		update_post_meta($increaseGearSublist, $increaseGear . '-count', $new_gearcount, $current_gear_count);

	}



	/**
	Add Gear
	*/
	if (isset($_GET["addgear"])) {
		$addGear = $_GET["addgear"];
		$addGearSublist = $_GET["addgearsublist"];

		
		$current_items = get_post_meta($addGearSublist, 'items' );
		if (in_array( $addGear, $current_items)) {
			$current_value = get_post_meta($addGearSublist, $addGear . '-count', true);
			if (isset($_GET["addgearcount"])) {
				$new_value = $current_value + $_GET["addgearcount"];
			}else{
				$new_value = $current_value + 1;
			}
			update_post_meta($addGearSublist, $addGear . '-count', $new_value, $current_value);
		}else{
			add_post_meta($addGearSublist, 'items', $addGear, false);
			if (isset($_GET["addgearcount"])) {
				add_post_meta($addGearSublist, $addGear . '-count', $_GET["addgearcount"], false);
			}else{
				add_post_meta($addGearSublist, $addGear . '-count', 1, false);
			}
		}
	}
}

add_action('wp_head', 'addRemoveGear');