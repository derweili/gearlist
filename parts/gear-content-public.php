<?php 

$brands = wp_get_post_terms( get_the_ID(), 'brand');
$geartypes = wp_get_post_terms( get_the_ID(), 'geartype');
?>
<div class="row" style="margin-bottom:20px">
	<div class="columns small-12 medium-4"><img src="http://placehold.it/300x300&Text=Produktbild" alt="Produktbild"></div>

	<div class="columns small-12 medium-8">
		<h1><?php echo $brands[0]->name; ?> - <?php the_title(); ?></h1>
		<ul>
			<li>Gewicht: <?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>g</li>
			<li>Kategorie: <?php echo $geartypes[0]->name; ?></li>
		</ul>
	</div>
</div>

<?php 

global $post;  
$the_query = array(
	'posts_per_page'   => '9000',
	'post_type'     => 'gear',
	'suppress_filters' => false,
	'meta_key'=>'parent_gear',
	'meta_value' => get_the_ID(),
	'author' => get_current_user_id()

);
$posts = get_posts( $the_query );  

foreach( $posts as $post ): setup_postdata( $post );
$permalink = get_permalink();
endforeach;


if (count($posts) > 0): ?>
<div  class="alert-box">
  Dieses Element befindet sich bereits in deiner Sammlung. <a href="<?php echo $permalink; ?>" style="color:white; text-decoration:underline; float:right;">Mein Element Anzeigen</a>
</div>
<?php else: ?>
<div class="row">
	<div class="columns small-12"><a href="" class="button expand" data-reveal-id="addtomygear">zu eigenem Gear hinzufügen</a></div>
</div>
<?php endif; ?>
