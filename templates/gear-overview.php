<?php
/*
Template Name: Gear-Overview
*/
get_header();
$permalinkmain = get_permalink();
?>
<div class="row">
	<header class="columns small-12">
		<h1><?php the_title(); ?></h1>
	</header>
	<div class="small-12 medium-12 columns end" role="main">
	<?php if (is_user_logged_in()): ?>
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
							'posts_per_page'   => '9000',
							'post_type'     => 'gear',
							'suppress_filters' => false,
							//'meta_key'=>'_thumbnail_id',
							'author' => get_current_user_id()

						);
						$posts = get_posts( $the_query );  
						if(!empty($posts)):

						foreach( $posts as $post ): setup_postdata( $post );
						if ( wp_get_post_terms( get_the_ID(), 'brand') !== null) {
							$brands = wp_get_post_terms( get_the_ID(), 'brand');
						}

							?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('columns small-12 medium-4 singlegearitem end'); ?> >
									<div class="panel" style="position:relative; height:180px">
										<a href="<?php echo get_the_permalink(); ?>">
											<header>
												<?php if( isset($brands[0]) ){ echo '<strong>' . $brands[0]->name . '</strong>'; };?>
												<h3><?php the_title(); ?></h3>
												<?php //foundationpress_entry_meta(); ?>
											</header>
											<div >
												Größe: <?php echo get_post_meta( get_the_ID(), 'item_size', true); ?> <br />
												Gewicht: <?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>g <br />
												<?php the_content( __( 'Continue reading...', 'foundationpress' ) ); ?>
											</div>
											<footer>
											</footer>
										</a>
										<a href="<?php echo $permalinkmain . '?deletepost=deletepost&deletepostid=' . get_the_ID(); ?>"  onclick="return confirm('<?php the_title(); ?> endgültig löschen?')"><i class="fa fa-trash-o" style="position:absolute; bottom: 10px; right:10px;"></i></a>
									</div>
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
		<?php else: ?>
			<div style="text-align: center;">
				<strong>Um Deine Ausrüstung verwalten zu können musst du dich anmelden:</strong><br /><br />
				<a href="<?php echo home_url(); ?>/wp-login.php?redirect_to=<?php echo home_url(); ?>" class="button">Login</a>
			</div>
		<?php endif ?>
	</div>
</div>
<?php get_footer(); ?>
