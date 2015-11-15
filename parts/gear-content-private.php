<?php 
$brands = wp_get_post_terms( get_the_ID(), 'brand');
$geartypes = wp_get_post_terms( get_the_ID(), 'geartype');
?>
<div class="row">

	<div class="columns small-12">
		<div data-alert class="alert-box radius">
		 Dieses Element befindet sich in Ihrem Inventar.
		</div>
	</div>
	<div class="columns small-12 medium-4"><img src="http://placehold.it/300x300&Text=Produktbild" alt="Produktbild"></div>

	<div class="columns small-12 medium-8">
		<h1><?php echo $brands[0]->name; ?> - <?php the_title(); ?></h1>
		<ul>
			<li>Gewicht: <?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>g</li>
			<li>Kategorie: <?php echo $geartypes[0]->name; ?></li>
		</ul>
		<a href="http://gearlist/gearlisten-uebersicht/" class="button" style="font-weight:bold">Jetzt neue Gearlist erstellen</a>
	</div>
</div>