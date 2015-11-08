<?php
/*
Template Name: Gear-Overview
*/
get_header();
$permalinkmain = get_permalink();
?>
<div class="row">
	<div class="small-12 columns" role="main">

	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<div>
				<?php the_content(); ?>
			</div>
			<div>
				<?php 
					global $post;  
					$the_query = array(
						'posts_per_page'   => '9000',
						'post_type'     => 'gear',
						'suppress_filters' => false,
						//'meta_key'=>'_thumbnail_id',
						'author' => get_current_user_id()

					);
					$posts = get_posts( $the_query );  
					if(!empty($posts)):

					foreach( $posts as $post ): setup_postdata( $post );
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header>
									<h3><?php the_title(); ?></h3>
									<?php //foundationpress_entry_meta(); ?>
								</header>
								<div >
									Gewicht: <?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>g <a href="<?php echo $permalinkmain . '?deletepost=deletepost&deletepostid=' . get_the_ID(); ?>"><span class="round alert label">löschen</span></a>
									<?php the_content( __( 'Continue reading...', 'foundationpress' ) ); ?>
								</div>
								<footer>
								</footer>
								<hr />
							</article>

						<?php
					endforeach;

					endif;
				 ?>
			</div>
			
			<footer>
			</footer>
		</article>
	<?php endwhile; ?>
	</div>
	<div class="columns small-12">
		<strong>Neues Gepäckstück erstellen:</strong>
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
	<div class="columns small-12">
		<strong>Neue Gepäckkategorie erstellen:</strong>
		<form action="<?php $permalinkmain ?>" method="get">
				<input type="text" name="geartypename" placeholder="Name">
				<input type="hidden" name="newgeartype" value="newgeartype">
				<button class="button" type="submit">Erstellen</button>
			</form>
	</div>
</div>
<?php get_footer(); ?>
