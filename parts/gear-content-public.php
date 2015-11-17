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


if (count($posts) > 0): ?>
<div  class="alert-box">
  Dieses Element befindet sich bereits in deiner Sammlung. <a href="<?php echo $permalink; ?>" style="color:white; text-decoration:underline; float:right;">Mein Element Anzeigen</a>
</div>
<?php else: ?>
<div class="row">
	<div class="columns small-12"><a href="" class="button expand" data-reveal-id="addtomygear">zu eigenem Gear hinzufügen</a></div>
</div>
<?php endif; ?>




<div id="addtomygear" class="reveal-modal small" data-reveal aria-labelledby="Zu eigenem Gear hinzufügen." aria-hidden="true" role="dialog">
  <h2 id="modalTitle">Zu eigenem Gear hinzufügen.</h2>
  	
<form action="<?php $permalinkmain ?>" method="get">
	<label for="">
		Hersteller
		<select name="gearitembrand" id="gearitembrand" required>
			<option value="<?php echo $brands[0]->slug; ?>" selected><?php echo $brands[0]->name; ?></option>
		</select>
	</label>
	<label for="">
		Name
		<input type="text" name="gearitemname" placeholder="Name" value="<?php the_title(); ?>" required>
	</label>
	<label for="">
		Größe
		<input type="text" name="gearitemsize" placeholder="Größe" value="<?php echo get_post_meta( get_the_ID(), 'item_size', true); ?>" required>
	</label>
	<div class="row collapse">
		<label for="">Eigenes Gewicht in Gramm</label>
		<div class="small-11 columns">
			<input type="number" name="gearitemweight" placeholder="Gewicht in Gramm" value="<?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>" required>
		</div>
		<div class="small-1 columns">
          <span class="postfix">g</span>
        </div>
	</div>
	<label for="">
		Kategorie
		<select name="gearitemtype" id="gearitemtype" required>
			<option value="<?php echo $geartypes[0]->slug; ?>" selected><?php echo $geartypes[0]->name; ?></option>
		</select>
	</label>
	<input type="hidden" name="newitem" value="newitem">
	<input type="hidden" name="newitemparent" value="<?php echo $idmain; ?>">
	<button class="button" type="submit">Erstellen</button>
</form>


  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>