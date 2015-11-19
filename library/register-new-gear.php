<?php

function registerNewGear(){

	//
	// Element
	//
	if (isset($_GET["newitem"])) {
		$NewItem = $_GET["newitem"];
		//$gearItemName = $_GET["gearitemname"]; 		// Item Name
		$gearItemWeight = $_GET["gearitemweight"];	// Item Weight
		$gearItemType = $_GET["gearitemtype"];		// Item Type
		$gearItemBrand = $_GET["gearitembrand"];	// Item Brand



		if ($NewItem != '') {
			$my_post = array(
			  'post_title'    => $NewItem,
			  'post_type' => 'gear',
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  'tax_input'	  => array('geartype' => $gearItemType, 'brand' => $gearItemBrand)
			);

			// Insert the post into the database
			$new_post_id = wp_insert_post( $my_post );
			add_post_meta($new_post_id, 'gearlist_weight', $gearItemWeight, false);

			if (isset($_GET["newitemparent"])) {
				add_post_meta($new_post_id, 'parent_gear', $_GET["newitemparent"], true);
			}
			if (isset($_GET["gearpool"])) {
				add_post_meta($new_post_id, 'gearpool', true, true);
			}
			if (isset($_GET["gearitemsize"])) {
				add_post_meta($new_post_id, 'item_size', $_GET["gearitemsize"], true);
			}

			if ( is_singular( 'gear' ) ) {
				$newItemUrl = get_the_permalink($new_post_id);
				echo '<script type="text/javascript">
				<!--
				window.location = "' . $newItemUrl . '?alertMessage=Ihr Neues Element wurde erfolgreich erstellt&alertMessageType=success";
				//–>
				</script>';
				exit();
			}
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
		addSublist($new_post_id, 'Körper', ''); //Automaticly register new Sublist
	}



	//Delete Gear
	if (isset($_GET["deletepost"])) {
		$deltePost = $_GET["deletepost"];
		$deletePostId = $_GET["deletepostid"];
		if ($deltePost != '') {
			wp_delete_post($deletePostId);
		}
	}

	//Delete Post
	if (isset($_GET["deletegearlist"])) {
		$deleteGearlist = $_GET["deletegearlist"];
		$sublistsToDelete = get_post_meta( $deleteGearlist, 'sublists', false);
		foreach ($sublistsToDelete as $sublistToDelete) {
			wp_delete_post($sublistToDelete);
		}
		wp_delete_post($deleteGearlist);
	}



	//
	// New Geartype Taxonomie
	//
	if (isset($_GET["newbrand"])) {
		$newBrand = $_GET["newbrand"];
		if ($newBrand != '') {
			wp_insert_term($newBrand, 'brand');
		}
	}
}

add_action('wp_head', 'registerNewGear');





function registerNewGearForm( $permalinkmain ){
	?>
	<strong>Neue Ausrüstung erstellen:</strong>
		<form action="<?php $permalinkmain ?>" method="get">
			<select name="gearitembrand" id="gearitembrand" required>
				<option value="" disabled selected>Hersteller auswählen</option>
				<?php 
				$brands = get_terms( 'brand', 'orderby=name&hide_empty=0' );
					foreach ($brands as $brand) {
						echo '<option value="' . $brand->slug . '">' . $brand->name . '</option>';
					}
				?>
				<option value="other">Anderer Hersteller</option>
			</select>
			<input type="text" name="newitem" placeholder="Name" required>
			<input type="text" name="gearitemsize" placeholder="Größe" required>
			<input type="number" name="gearitemweight" placeholder="Gewicht in Gramm" required>
			
			<select name="gearitemtype" id="gearitemtype" required>
				<option value="">Kategorie auswählen</option>
				<?php 
				$geartype = get_terms( 'geartype', 'orderby=name&hide_empty=0' );
					foreach ($geartype as $geartypesingle) {
						echo '<option value="' . $geartypesingle->slug . '">' . $geartypesingle->name . '</option>';
					}
				?>
			</select>
			<div class="row">
				 <input id="gearpool_checkbox" type="checkbox" name="gearpool" checked>
				<!--<div class="switch round columns small-3" style="margin-left:10px">
				 
				  <label for="gearpool_checkbox"></label>
				</div>-->
				<div class="columns small-8 end">
					In Ausrüstung veröffentlichen.
				</div>
			</div>
			<button class="button" type="submit">Erstellen</button>
		</form>
		<?
}