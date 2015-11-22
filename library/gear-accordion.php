<?php
function gear_accordion($parent, $permalinkmain, $allsublists, $current_user){
	$args = array(
	    'orderby'           => 'name', 
	    'parent'            => $parent,
	); 
	$geartype = get_terms( 'geartype', $args ); //Get all Geartype Taxonomie entries
	$totalgeartypecount = count($geartype);
	$geartypecount = 0;
	$endclass = '';
	foreach ($geartype as $geartypesingle) {
		$geartypecount++;
		echo '<li class="accordion-navigation">
				<a href="#panel' . $geartypesingle->slug . '">';
				echo $geartypesingle->name . '</a>';
				echo '<div id="panel' . $geartypesingle->slug . '" class="content">';

								$geartypesingleid = $geartypesingle->term_id;
								if ( get_term_children($geartypesingleid, 'geartype') != null) {
									echo '<ul class="accordion" data-accordion>';
									gear_sub_accordion( $geartypesingleid, $permalinkmain, $allsublists, $current_user);
									echo '</ul>';
								}else{

									allGearByType($permalinkmain, $geartypesingle->slug, $allsublists, $current_user);			//Get Gearoverview by Geartype Taxonomie
								}
				echo '</div>';

		echo '</li>';
	}
}



function gear_sub_accordion($parent, $permalinkmain, $allsublists, $current_user){
	$args = array(
	    'orderby'           => 'name', 
	    'parent'            => $parent,
	    'hide_empty'		=> false
	); 
	$geartype = get_terms( 'geartype', $args ); //Get all Geartype Taxonomie entries
	$totalgeartypecount = count($geartype);
	$geartypecount = 0;
	$endclass = '';
	foreach ($geartype as $geartypesingle) {
		$geartypecount++;
		echo '<li class="accordion-navigation">
				<a href="#panel' . $geartypesingle->slug . '">';
				echo $geartypesingle->name . '</a>';
				echo '<div id="panel' . $geartypesingle->slug . '" class="content">';

								$geartypesingleid = $geartypesingle->term_id;
								if ( get_term_children($geartypesingleid, 'geartype') != null) {
									echo '<ul class="accordion" data-accordion>';
									gear_sub_accordion( $geartypesingleid, $permalinkmain, $allsublists, $current_user);
									echo '</ul>';
								}else{

									allGearByType($permalinkmain, $geartypesingle->slug, $allsublists, $current_user);			//Get Gearoverview by Geartype Taxonomie
								}
				echo '</div>';

		echo '</li>';
	}
}