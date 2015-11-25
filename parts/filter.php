<?php 

function gearlist_filter($posts = '') {

	if (!empty($post)) {
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
			$geartype = get_terms( 'geartype', 'orderby=name&hide_empty=0' );
				foreach ($geartype as $geartypesingle) {
					echo '<span class="label filteritem ' . $geartypesingle->slug . '" data-filter="geartype-' . $geartypesingle->slug . '">' . $geartypesingle->name . '</span> ';
			}
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
};