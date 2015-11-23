<?php
function updateGear(){


	if (isset($_GET["updategear"])) {
		$updateGear = $_GET["updategear"];

		$my_post = array(
			'ID'           => $updateGear,
		);

		//Update Title
		if (isset($_GET["updatetitle"])) {
			$updateTitle = $_GET["updatetitle"];
			$my_post['post_title'] = $updateTitle;
		}




		$updatedPost = wp_update_post( $my_post );


		//Update Taxonomies
		$updatetax =  array();
			if (isset($_GET["updatebrand"])) {
				$updateBrand = $_GET["updatebrand"];
				$updatetax['brand'] = $updateBrand;
				wp_set_object_terms( $updateGear, $updateBrand, 'brand', false );
			}

			if (isset($_GET["updatetype"])) {
				$updateType = $_GET["updatetype"];
				$updatetax['geartype'] = $updateType;
				wp_set_object_terms( $updateGear, $updateType, 'geartype', false );
			}

		/*if (!empty($updatetax)) {
			$my_post['tax_input'] = $updatetax;
		}*/


		//Update Metas


		if (isset($_GET["updatesize"])) {
			$updateSize = $_GET["updatesize"];
			$oldSize = get_post_meta($updatedPost, 'item_size', true);
			if (!empty($oldSize)) {
				update_post_meta($updatedPost, 'item_size', $updateSize, $oldSize, true);
			}else{
				add_post_meta($updatedPost, 'item_size', $updateSize, true);
			}
			
		}
		if (isset($_GET["updateweight"])) {
			$updateWeight = $_GET["updateweight"];
			$oldWeight = get_post_meta($updatedPost, 'gearlist_weight', true);
			update_post_meta($updatedPost, 'gearlist_weight', $updateWeight, $oldWeight, true);
		}

		$newItemUrl = get_the_permalink($updatedPost);
		echo '<script type="text/javascript">
		<!--
		window.location = "' . $newItemUrl . '?alertMessage=Die Änderungen wurden gespeichert&alertMessageType=success";
		//–>
		</script>';
		exit();


	}


};

add_action('wp_head', 'updateGear');


function updateGearForm($idmain, $permalinkmain){

$brands = wp_get_post_terms( $idmain, 'brand');
$geartypes = wp_get_post_terms( $idmain, 'geartype');


	?>


	<div id="updategear" class="reveal-modal small" data-reveal aria-labelledby="Bearbeiten" aria-hidden="true" role="dialog">
	  <h2 id="modalTitle"><?php the_title(); ?> bearbeiten</h2>
	  	
	<form action="<?php $permalinkmain ?>" method="get">
		<input type="hidden" name="updategear" value="<?php echo get_the_ID(); ?>">
		<label for="">
			Hersteller
			<select name="updatebrand" id="gearitembrand" class="updategearbrand" required>
				<!--<option value="" disabled selected>Hersteller auswählen</option>-->
				<?php 
				$allbrands = get_terms( 'brand', 'orderby=name&hide_empty=0' );
				$groupFirstLetter = 'A';
				echo '<optgroup label="A">';

					foreach ($allbrands as $singlebrand) {

						$firstletter = $singlebrand->name;
						$firstletter = $firstletter[0];
						if ($firstletter != $groupFirstLetter) {
							echo '</optgroup>';
							echo '<optgroup label="' . $firstletter . '">';
							$groupFirstLetter = $firstletter;
						}
						if ($singlebrand->slug == $brands[0]->slug) {
							echo '<option value="' . $singlebrand->slug . '" selected>' . $singlebrand->name . '</option>';
						}else{
							echo '<option value="' . $singlebrand->slug . '">' . $singlebrand->name . '</option>';
						};
					}
					echo "</optgroup>";

				?>
			</select>
		</label>
		<label for="">
			Name
			<input type="text" name="updatetitle" placeholder="Name" value="<?php the_title(); ?>" required>
		</label>
		<label for="">
			Größe
			<input type="text" name="updatesize" placeholder="Größe" value="<?php echo get_post_meta( $idmain, 'item_size', true); ?>">
		</label>
		<div class="row collapse">
			<label for="">Gewicht in Gramm</label>
			<div class="small-11 columns">
				<input type="number" name="updateweight" placeholder="Gewicht in Gramm" value="<?php echo get_post_meta( $idmain, 'gearlist_weight', true); ?>" required>
			</div>
			<div class="small-1 columns">
	          <span class="postfix">g</span>
	        </div>
		</div>
		<label for="">
			Kategorie
			<select name="updatetype" id="gearitemtype" required>
				<option value="" disabled>Kategorie auswählen</option>
				<?php
				$allgeartypes = get_terms( 'geartype', 'orderby=name&hide_empty=0&parent=0' );
					foreach ($allgeartypes as $geartypesingle) {
						if ($geartypes[0]->slug == $geartypesingle->slug) {
							if ( get_term_children($geartypesingle->term_id, 'geartype') != null) {
								echo '<option value="' . $geartypesingle->slug . '" selected disabled>' . $geartypesingle->name . '</option>';
								gearlist_term_children_option($geartypesingle->term_id, $geartypesingle->slug, 'geartype', '- ' );
							}else{
								echo '<option value="' . $geartypesingle->slug . '" selected>' . $geartypesingle->name . '</option>';
							}

						}else{
							if ( get_term_children($geartypesingle->term_id, 'geartype') != null) {
								echo '<option value="' . $geartypesingle->slug . '" disabled>' . $geartypesingle->name . '</option>';
								gearlist_term_children_option($geartypesingle->term_id, $geartypesingle->slug, 'geartype', '- ' );
							}else{
								echo '<option value="' . $geartypesingle->slug . '">' . $geartypesingle->name . '</option>';
							}
						};
					}
				?>
			</select>
		</label>
		<button class="button" type="submit">Änderungen speichern</button>
	</form>


	  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
	<?php
}