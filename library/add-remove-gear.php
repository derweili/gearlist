<?php

function addRemoveGear(){


	//
	// Delete Gear
	//

	if (isset($_GET["removegear"])) {
	$removeGear = $_GET["removegear"];
	$removeGearSublist = $_GET["removegearsublist"];

		if ( $removeGear != '' ) {
			$gearToDelete = get_post_meta( get_the_ID(), $removeGearSublist ); //Bisherige Elemente der Sublist in Variable speichern
			delete_post_meta(get_the_ID(), $removeGearSublist, $removeGear); //Löschen wie gewünscht durchführen
			$count = 0;
			if ( in_array( $removeGear, $gearToDelete ) ) { //Funktion zum hinzufügen neuer Elemente zu einer Sublist
				foreach ($gearToDelete as $gearToDeleteSingle) { //Jedes Bisherige Element wird durchgelaufen
					if ($gearToDeleteSingle == $removeGear) { //Jedes Bisherige Element wird darauf geprüft ob Es dem gelöschten entspricht
						if ( $count > 0 ) {
							add_post_meta(get_the_ID(), $removeGearSublist, $removeGear, false); //Wenn es mehr als ein mal das gelöschte gab, wird es  wieder hinzugefügt
						}
						$count++;
					}
				}
			}
		}
	}

	//
	// Add Gear
	//
	if (isset($_GET["addgear"])) {
		$addGear = $_GET["addgear"];
		$addGearSublist = $_GET["addgearsublist"];
		if ( $addGear != '' ) { //Funktion zum hinzufügen neuer Elemente zu einer Sublist
			add_post_meta(get_the_ID(), $addGearSublist, $addGear, false);
		}
	}
}

add_action('wp_head', 'addRemoveGear');