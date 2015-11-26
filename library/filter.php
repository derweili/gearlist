<?php 

function gearlist_filter($posts = '') {

//print_r($posts);

	 ?>

<div class="filter-section">
	Filter:<br />

	<dl class="tabs" data-tab>
	  <dd class="active"><a href="#panel1">Kategorie</a></dd>
	  <dd><a href="#panel2">Hersteller</a></dd>
	</dl>
	<div class="tabs-content">
	  <div class="content active" id="panel1">
	  	<span class="label filteritem" data-filter="singlegearitem">Alle</span>
		<?php 
		/*	$geartype = get_terms( 'geartype', 'orderby=name&hide_empty=0' );
				foreach ($geartype as $geartypesingle) {
					echo '<span class="label filteritem ' . $geartypesingle->slug . '" data-filter="geartype-' . $geartypesingle->slug . '">' . $geartypesingle->name . '</span> ';
			}*/
		?>
		<?php 
		$usedTypes = array();
		global $post;
		foreach( $posts as $post ): setup_postdata( $post );
			$types = wp_get_post_terms( get_the_ID(), 'geartype');
			//echo get_the_id() . ' | ';
			//print_r($brands[0]);
			//echo "<hr />";
			if (isset($types[0])) {
				$brandslug = $types[0]->slug;
				if (in_array($brandslug, $usedTypes)) {
					# code...
				}else{
					//echo $types[0]->name . "<br />";
					echo '<span class="label filteritem" data-filter="brand-' . $brandslug . '">' . $types[0]->name . '</span> ';
					$usedTypes[] = $types[0]->slug;
				};
			}
			

		endforeach;
		 ?>
	  </div>
	  <div class="content" id="panel2">
	  	<span class="label filteritem" data-filter="singlegearitem">Alle</span>


		<?php 

	$usedBrands = array();
	$usedBrandsSlug = array();
	global $post;
	foreach( $posts as $post ): setup_postdata( $post );
		$brands = wp_get_post_terms( get_the_ID(), 'brand');
		//echo get_the_id() . ' | ';
		//print_r($brands[0]);
		//echo "<hr />";
		if (isset($brands[0])) {
			$brandslug = $brands[0]->slug;
			if (in_array($brandslug, $usedBrandsSlug)) {
				# code...
			}else{
				//echo $brands[0]->name . "<br />";
				//echo '<span class="label filteritem" data-filter="brand-' . $brandslug . '">' . $brands[0]->name . '</span> ';
				$brandinfo = array('slug' => $brands[0]->slug, 'name' => $brands[0]->slug );
				//$usedBrands[] = $brands[0]->slug;
				$usedBrands[] = $brandinfo;
				$usedBrandsSlug[] = $brands[0]->slug;
			};
		};
		

	endforeach;
/**
Array Sortieren
*/	
foreach ($usedBrands as $nr => $inhalt)
{
    $slug[$nr]  = strtolower( $inhalt['slug'] );
    $name[$nr]   = strtolower( $inhalt['name'] );
    //$datum[$nr] = strtolower( $inhalt['Datum'] );
}
array_multisort($name, SORT_ASC, $usedBrands);


foreach ($usedBrands as $key => $value) {
	echo '<span class="label filteritem" data-filter="' . $value['slug'] . '">';
	echo $value['name'];
	echo "</span> ";
}
//print_r($usedBrands);


		 ?>



	  </div>
	</div>
</div>
<?php
};