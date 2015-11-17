<?php 
$brands = wp_get_post_terms( get_the_ID(), 'brand');
$geartypes = wp_get_post_terms( get_the_ID(), 'geartype');

$permalinkmain = get_permalink();
$idmain = get_the_ID();

?>
<div class="row">

	<div class="columns small-12">
		<div data-alert class="alert-box radius">
		 Dieses Element befindet sich in Ihrem Inventar.
		</div>
	</div>
	<!--<div class="columns small-12 medium-4"><img src="http://placehold.it/300x300&Text=Produktbild" alt="Produktbild"></div>-->

	<div class="columns small-12 medium-8 end">
		<strong><?php echo $brands[0]->name; ?></strong><br />
		<h1><?php the_title(); ?></h1>
		<ul>
			<li>Größe: <?php echo get_post_meta( get_the_ID(), 'item_size', true); ?> </li>
			<li>Gewicht: <?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>g</li>
			<li>Kategorie: <?php echo $geartypes[0]->name; ?></li>
			<li style="list-style:none;"><a href="" class="" data-reveal-id="updategear" style="color:darkred<">Ausrüstung bearbeiten</a></li>
		</ul>


		<div class="columns small-12"></div>
		<a href="http://gearlist/meine-packlisten/" class="button" style="font-weight:bold">Jetzt neue Gearlist erstellen</a>
	</div>
</div>



<?php 
updateGearForm($idmain, $permalinkmain);
 ?>