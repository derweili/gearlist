<?php

function allGearByType($permalinkmain, $geartype, $allsublists, $current_user){
	global $post;  
	$the_query = array(
		'posts_per_page'   => '1000',
		'post_type'     => 'gear',
		'orderby'          => 'title',
		'order'            => 'ASC',
		//'category_name'    => $a,
		'geartype'			=> $geartype,
		'suppress_filters' => false,
		//'meta_key'=>'_thumbnail_id',
		'author' => $current_user,

	);
	$posts = get_posts( $the_query );  
	if(!empty($posts)):

		foreach( $posts as $post ): setup_postdata( $post );

		global $post;

		$brand = wp_get_post_terms( get_the_id(), 'brand');

		?>	
			<button href="#" data-dropdown="drop<?php echo get_the_ID(); ?>" aria-controls="drop<?php echo get_the_ID(); ?>" aria-expanded="false" class="button tiny dropdown"><?php the_title(); ?> - <?php echo $brand[0]->name; ?> <?php if ($geartype == 'verbrauchsgueter'){ echo '- ' . get_post_meta( get_the_ID(), 'item_size', true); };?></button><br>
			<ul id="drop<?php echo get_the_ID(); ?>" data-dropdown-content class="f-dropdown" aria-hidden="true">
				<?php foreach ($allsublists as $value): ?>
					<li><a href="<?php echo $permalinkmain ?>?addgear=<?php echo get_the_ID(); ?>&addgearsublist=<?php echo $value; ?>"><?php echo get_the_title($value); ?></a></li>
				<?php endforeach ?>
				<?php if ($geartype == 'transport'): ?>
					<li><a href="<?php echo $permalinkmain ?>?newsublist=<?php echo get_the_title(); ?> <?php echo get_post_meta( get_the_ID(), 'item_size', true); ?>&baseweight=<?php echo get_post_meta( get_the_ID(), 'gearlist_weight', true); ?>">Neue untergeordnete Liste erstellen</a></li>
				<?php endif ?>
				<li style=""><a href="<?php echo $permalinkmain ?>?deletepost=deletepost&deletepostid=<?php echo get_the_ID(); ?>" style="color:lightgrey;"><?php the_title(); ?> löschen</a></li>
			</ul>
		<?php
			/*echo '<a href="';
			echo $permalinkmain . '?addgear=' . get_the_ID() . '&sublist=gearlist">';
			the_title();
			echo ' - ' . get_post_meta( get_the_ID(), 'gearlist_weight', true) . 'g';
			echo '</a>';
			echo '<a href="'. $permalinkmain . '?deletepost=deletepost&deletepostid=' . get_the_ID() . '"><span class="round alert label">löschen</span></a></li>';
		*/
		endforeach;

	endif;
}