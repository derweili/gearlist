<?php
/*
Template Name: Gearpool
*/
get_header();
$permalinkmain = get_permalink();

global $post;  
$the_query = array(
	'posts_per_page'   => '9000',
	'post_type'     => 'gear',
	'suppress_filters' => false,
	'meta_key'=>'gearpool',
	'meta_value' => true,
	//'author' => get_current_user_id()

);
$posts = get_posts( $the_query );  

?>
<div class="row">
	<?php if (is_user_logged_in()): ?>
		<div class="columns small-12 medium-4 show-for-small">
			<?php registerNewGearForm( $permalinkmain ); ?>


			<!--<div style="margin-top:20px">
				<strong>Neuer Hersteller hinzufügen:</strong>
				<form action="<?php $permalinkmain ?>" method="get">
					<input type="text" name="newbrand" placeholder="Hersteller">
					<button class="button" type="submit">Hinzufügen</button>
				</form>
			</div>-->
		</div>
	<?php endif; ?>

	
	<header class="columns small-12">
		<h1><?php the_title(); ?></h1>
	</header>




	<div class="small-12 medium-8 columns" role="main">
<!-
Filter
->

<?php 
	gearlist_filter($posts);
?>


<!-
-
Loop  
-
->

	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
			<div class="row" data-equalizer>
				<?php 
					
					if(!empty($posts)):


					foreach( $posts as $post ): setup_postdata( $post );
					if ( wp_get_post_terms( get_the_ID(), 'brand') !== null) {
						$brands = wp_get_post_terms( get_the_ID(), 'brand');
						$geartype = wp_get_post_terms( get_the_ID(), 'geartype');
					}


						?>
							<div  id="post-<?php the_ID(); ?>" <?php post_class('columns small-12 medium-6 singlegearitem end'); ?> >
								<div class="panel" style="margin: 0; height: 145px">
								<a href="<?php echo get_the_permalink(); ?>">
									<div  style="margin-bottom:0">
										<header>
											<?php if( isset($brands[0]) ){ echo '<strong>' . $brands[0]->name . '</strong><br />'; };?>
											<h3><?php the_title(); ?></h3>
											<?php //foundationpress_entry_meta(); ?>
										</header>
										<div>
											<?php if( isset($geartype[0]) ){ echo 'Kategorie : <strong>' . $geartype[0]->name . '</strong><br />'; };?>
											<?php $gearsize = get_post_meta( get_the_ID(), 'item_size', true); if ($gearsize != ''){echo "Größe: " . $gearsize . "<br />";}?> 
											Gewicht: <?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>g<br />
											<!--<a href="<?php echo $permalinkmain . '?deletepost=deletepost&deletepostid=' . get_the_ID(); ?>"><span class="round alert label">löschen</span></a>-->
											<?php the_content( __( 'Continue reading...', 'foundationpress' ) ); ?>
										</div>
										<footer>
										</footer>
									</div>
								</a>
							</div>
							</div>

						<?php
					endforeach;


					endif;
				 ?>
			</div>
	<?php endwhile; ?>
	</div>


	<!-- Sidebar -->
	<div class="columns small-12 medium-4 show-for-medium-up">
		<?php if (is_user_logged_in()): ?>
			<?php registerNewGearForm( $permalinkmain ); ?>


			<div style="margin-top:20px">
				<strong>Neuer Hersteller hinzufügen:</strong>
				<form action="<?php $permalinkmain ?>" method="get">
					<input type="text" name="newbrand" placeholder="Hersteller" required>
					<button class="button" type="submit">Hinzufügen</button>
				</form>
			</div>
		<?php endif ?>
	</div>
	
	<!-- Der Nutzer bekommt nicht die Möglichkeit Gepäckkategorien zu erstellen --> 
	<!--
		<div class="columns small-12">
			<strong>Neue Gepäckkategorie erstellen:</strong>
			<form action="<?php $permalinkmain ?>" method="get">
					<input type="text" name="geartypename" placeholder="Name">
					<input type="hidden" name="newgeartype" value="newgeartype">
					<button class="button" type="submit">Erstellen</button>
				</form>
		</div>
	-->
</div>


<?php 
	/*$usedBrands = array();
	foreach( $posts as $post ): setup_postdata( $post );
		$brands = wp_get_post_terms( get_the_ID(), 'brand');
		//print_r($brands[0]);
		//echo "<hr />";
		if (isset($brands[0])) {
			$brandslug = $brands[0]->slug;
			if (in_array($brandslug, $usedBrands)) {
				# code...
			}else{
				echo $brands[0]->name . "<br />";
				$usedBrands[] = $brands[0]->slug;
			};
		}
		

	endforeach;
*/
 ?>
<?php get_footer(); ?>
