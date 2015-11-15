<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); 
$permalinkmain = get_permalink();
$idmain = get_the_ID();




?>
<?php while ( have_posts() ) : the_post(); 

$brands = wp_get_post_terms( $idmain, 'brand');
$geartypes = wp_get_post_terms( get_the_ID(), 'geartype');


?>
<div class="row">
	<div class="small-12 medium-12 large-8 large-offset-2 columns">

	<?php do_action( 'foundationpress_before_content' ); ?>
	
		<br />

		 	<?php

		 	//Nutzerweiche
		 	$author = get_the_author_meta('ID');
		 	$current_user = wp_get_current_user()->ID;
		 	//print_r( $author );
		 	/*echo "<br>";
		 	echo $current_user;*/
		 	if ($author == $current_user) {

		 		get_template_part( 'parts/gear-content-private' );


		 	}else{
		 		get_template_part( 'parts/gear-content-public' );
		 	}

		 	?>

	<?php do_action( 'foundationpress_after_content' ); ?>

	</div>
<?php endwhile;?>

</div><!-- row -->








<div id="addtomygear" class="reveal-modal small" data-reveal aria-labelledby="Zu eigenem Gear hinzufügen." aria-hidden="true" role="dialog">
  <h2 id="modalTitle">Zu eigenem Gear hinzufügen.</h2>
  	
<form action="<?php $permalinkmain ?>" method="get">
	<label for="">
		Name
		<input type="text" name="gearitemname" placeholder="Name" value="<?php the_title(); ?>">
	</label>
	<div class="row collapse">
		<label for="">Eigenes Gewicht in Gramm</label>
		<div class="small-11 columns">
			<input type="number" name="gearitemweight" placeholder="Gewicht in Gramm" value="<?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>">
		</div>
		<div class="small-1 columns">
          <span class="postfix">g</span>
        </div>
	</div>
	<label for="">
		Hersteller
		<select name="gearitembrand" id="gearitembrand">
			<option value="<?php echo $brands[0]->slug; ?>" selected><?php echo $brands[0]->name; ?></option>
		</select>
	</label>
	<label for="">
		Kategorie
		<select name="gearitemtype" id="gearitemtype">
			<option value="<?php echo $geartypes[0]->slug; ?>" selected><?php echo $geartypes[0]->name; ?></option>
		</select>
	</label>
	<input type="hidden" name="newitem" value="newitem">
	<input type="hidden" name="newitemparent" value="<?php echo $idmain; ?>">
	<button class="button" type="submit">Erstellen</button>
</form>


  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<?php get_footer(); ?>