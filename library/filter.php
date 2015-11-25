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
		/*$brands = get_terms( 'brand', 'orderby=name&hide_empty=0' );
		$tabs = "<ul class='tabs' data-tab><li class='tab-title active'><a href='#brandA'><Hersteller A</li>";
		$tabs_content = '<div class="content active" id="brandA">'
		$groupFirstLetter = 'A';
		foreach ($brands as $brand) {
			$firstletter = $brand->name;
			$firstletter = $firstletter[0];
			if ($firstletter != $groupFirstLetter) {
				$tabs .= "<li class='tab-title'>Hersteller " . $firstletter . "</li>";
				//echo '<optgroup label="' . $firstletter . '">';
				$tabs_content .= '</div><div class="content" id="panel'. $firstletter . '">';
				$groupFirstLetter = $firstletter;
			}
			$tabs_content .= '<span class="label filteritem ' . $brand->slug . '" data-filter="brand-' . $brand->slug . '">' . $brand->name . '</span> ';
		};

		$tabs .= '</ul>';
		$tabs_content .= '</div>'
		echo $tabs;
		echo $tabs_content;*/

		?>

		<?php 

	$usedBrands = array();
	global $post;
	foreach( $posts as $post ): setup_postdata( $post );
		$brands = wp_get_post_terms( get_the_ID(), 'brand');
		//echo get_the_id() . ' | ';
		//print_r($brands[0]);
		//echo "<hr />";
		if (isset($brands[0])) {
			$brandslug = $brands[0]->slug;
			if (in_array($brandslug, $usedBrands)) {
				# code...
			}else{
				//echo $brands[0]->name . "<br />";
				echo '<span class="label filteritem" data-filter="brand-' . $brandslug . '">' . $brands[0]->name . '</span> ';
				$usedBrands[] = $brands[0]->slug;
			};
		}
		

	endforeach;


		 ?>

<!--<ul class="tabs" data-tab>
  <li class="tab-title active"><a href="#panel1">Tab 1</a></li>
  <li class="tab-title"><a href="#panel2">Tab 2</a></li>
  <li class="tab-title"><a href="#panel3">Tab 3</a></li>
  <li class="tab-title"><a href="#panel4">Tab 4</a></li>
</ul>
<div class="tabs-content">
  <div class="content active" id="panel1">
    <p>This is the first panel of the basic tab example. You can place all sorts of content here including a grid.</p>
  </div>
  <div class="content" id="panel2">
    <p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
  </div>
  <div class="content" id="panel3">
    <p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
  </div>
  <div class="content" id="panel4">
    <p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
  </div>
</div>-->


	  </div>
	</div>
</div>
<?php
};