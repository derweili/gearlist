<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); 

//$addGear = $_GET["addgear"];
//$removeGear = $_GET["removegear"];
//$removeGearSublist = $_GET["removegearsublist"];
//$gearSublist = $_GET["sublist"];





$permalinkmain = get_permalink();
$idmain = get_the_ID();
?>

<div class="row">
	<div class="small-12 columns" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
		</article>
	<?php endwhile;?>
		<div class="gearlist">
		<?php 
			$allsublists = get_post_meta( get_the_ID(), 'sublists' ) ;
			foreach ($allsublists as $singlesublist):
				sublistTable($idmain, $singlesublist, $permalinkmain, $allsublists);
			endforeach;
		 ?>
		<?php 
			
		 ?>
			

		</div>
		<div class="addgearcontainer row hide-for-print">
			<div class="columns small-12">
				<h3>Vorhandenes Element hinzufügen:</h3>
			</div>	
			
				<?php 
				$geartype = get_terms( 'geartype', 'orderby=count&hide_empty=1' ); //Get all Geartype Taxonomie entries
				$totalgeartypecount = count($geartype);
				$geartypecount = 0;
				$endclass = '';
				foreach ($geartype as $geartypesingle) {
					$geartypecount++;
					if($totalgeartypecount == $geartypecount){$endclass = 'end';};
					echo '<div class="columns small-12 medium-6 ' . $endclass . '">';
					echo $geartypesingle->name . '<br />';
					allGearByType($permalinkmain, $geartypesingle->slug, $allsublists);			//Get Gearoverview by Geartype Taxonomie
					echo "</div>";
				}
	 ?>
		</div>

		<div class="addgearitem hide-for-print">
			<h2>Neues Element erstellen:</h2>
			<form action="<?php $permalinkmain ?>" method="get">
				<input type="text" name="gearitemname" placeholder="Name">
				<input type="number" name="gearitemweight" placeholder="Gewicht in Gramm">
				<input type="hidden" name="newitem" value="newitem">
				<select name="gearitemtype" id="gearitemtype">
					<option value="" disabled selected>Kategorie auswählen</option>
					<?php 
					$geartype = get_terms( 'geartype', 'orderby=count&hide_empty=0' );
						foreach ($geartype as $geartypesingle) {
							echo '<option value="' . $geartypesingle->slug . '">' . $geartypesingle->name . '</option>';
						}
					?>
				</select>
				<button class="button" type="submit">Erstellen</button>
			</form>
		</div>
		<div class="addgearsublist hide-for-print">
			<h2>Neue Untergeordnete Liste:</h2>
			<form action="<?php $permalinkmain ?>" method="get">
				<input type="text" name="newsublist" placeholder="Name">
				<button class="button" type="submit">Erstellen</button>
			</form>
		</div>

	<?php do_action( 'foundationpress_after_content' ); ?>

	</div>
</div>
<?php get_footer(); ?>