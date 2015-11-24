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
global $post;
global $user;

$permalinkmain = get_permalink();
$idmain = get_the_ID();


$author = $post->post_author;
$current_user = wp_get_current_user()->ID;

?>

<div class="row">
	<div class="small-12 medium-9 large-9 columns" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
			  <form class="row edit-title-form" style="display: none" action="<?php $permalinkmain ?>" method="get">
			    <div class="large-12 columns">
			      <div class="row collapse">
			        <div class="small-8 columns">
			          <input type="text" placeholder="Titel" id="edittitletext" name="editgearlisttitle" value="<?php the_title(); ?>">
			          <input type="hidden" name="editgearlistid" value="<?php echo get_the_id(); ?>">
			        </div>
			        <div class="small-4 columns">
			          <button class="button postfix" type="submit">Umbenennen</button>
			        </div>
			      </div>
			    </div>
			  </form>

				<h1 class="entry-title"><?php the_title(); ?> <i class="fa fa-pencil edit-title" style="font-size:0.5em; margin-top:-10px; display:inline-block; position:relative; cursor:pointer"></i></h1>
			</header>
		</article>
	<?php endwhile;?>
		<div class="gearlist">
		<?php
			$allsublists = get_post_meta( get_the_ID(), 'sublists' ) ;
			$bodyWeight = 0; $consumerGoodsWeight = 0; $equipmentWeight = 0; $totalWeight = 0;//Set Statistics to 0;
			foreach ($allsublists as $singlesublist):
				$sublistoutput = sublistTable($idmain, $singlesublist, $permalinkmain, $allsublists);
				echo $sublistoutput['html'];
				$bodyWeight = $bodyWeight + $sublistoutput['bodyWeight'];
				$consumerGoodsWeight = $consumerGoodsWeight + $sublistoutput['consumerGoodsWeight'];
				$equipmentWeight = $equipmentWeight + $sublistoutput['equipmentWeight'];
				$totalWeight = $totalWeight + $sublistoutput['totalWeight'];
			endforeach;
		 ?>
		<?php
			echo "<div style='text-align:right; margin-right:40px'><strong >Gesamtgewicht: " . $totalWeight . "g</strong></div>";
		 ?>


		</div>
		
		<div class="columns small-12">
			<h3>Auswertung:</h3>
		</div>
		<div class="columns small-4">
			<div id="my-cool-chart"></div>
		</div>
		<div class="columns small-5 end">
			<ul data-pie-id="my-cool-chart" data-options='{"donut": "false", "donut_inner_ratio": 0, "show_percent": true}'>
			  <li data-value="<?php echo $bodyWeight; ?>">Gewicht am Körper: <?php echo $bodyWeight; ?>g</li>
			  <li data-value="<?php echo $consumerGoodsWeight; ?>">Gepäck - Verbrauchsgüter: <?php echo $consumerGoodsWeight; ?>g</li>
			  <li data-value="<?php echo $equipmentWeight; ?>">Gepäck - Ausrüstung: <?php echo $equipmentWeight; ?>g</li>

			</ul>
		</div>
		

	</div>

	<div class="addgearcontainer columns small-12 medium-3 large-3 hide-for-print">
		<?php if ($author == $current_user) { ?>
		<div class="columns small-12">
			<h3>Vorhandenes Element hinzufügen:</h3>
		</div>
		<hr>
		<ul class="accordion" data-accordion>
			<?php gear_accordion(0, $permalinkmain, $allsublists, $current_user); ?>
 		</ul>
 		<?php }; ?>
	</div>

	
</div>
	<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>
