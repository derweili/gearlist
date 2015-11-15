<?php
/*
Template Name: Gearlist-Overview
*/
get_header();
$permalinkmain = get_permalink();
?>
<div class="row">
	<header class="columns small-12">
		<h1><?php the_title(); ?></h1>
	</header>
	<div class="small-12 medium-8 columns" role="main">

	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<div>
				<?php the_content(); ?>
			</div>
			<div>
				<?php 
					global $post;  
					$the_query = array(
						'posts_per_page'   => '1000',
						'post_type'     => 'gearlist',
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
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php //foundationpress_entry_meta(); ?>
								</header>
								<div >
									<a href="<?php echo $permalinkmain . '?deletegearlist=' . get_the_ID(); ?>"><span class="round alert label">löschen</span></a>
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
	<div class="columns small-12 medium-4">
		<strong>Neue Packliste erstellen:</strong>
		<form action="<?php get_permalink() ?>" method="get">
			<input type="text" name="gearlistname" placeholder="Name">
			<input type="hidden" name="newgearlist" value="newgearlist">
			<button class="button" type="submit">Erstellen</button>
		</form>
	</div>
</div>
<?php get_footer(); ?>
