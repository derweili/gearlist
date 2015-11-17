<?php 

$brands = wp_get_post_terms( get_the_ID(), 'brand');
$geartypes = wp_get_post_terms( get_the_ID(), 'geartype');
?>
<div class="row" style="margin-bottom:20px">
	<div class="columns small-12 medium-8 end">
		<strong><?php echo $brands[0]->name; ?></strong><br />
		<h1><?php the_title(); ?></h1>
		<ul>
			<li>Größe: <?php echo get_post_meta( get_the_ID(), 'item_size', true); ?> </li>
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
