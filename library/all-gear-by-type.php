<?php

function allGearByType($permalinkmain, $geartype, $allsublists){
	global $post;  
	$the_query = array(
		'posts_per_page'   => '1000',
		'post_type'     => 'gear',
		//'orderby'          => 'date',
		//'order'            => 'DESC',
		//'category_name'    => $a,
		'geartype'			=> $geartype,
		'suppress_filters' => false,
		//'meta_key'=>'_thumbnail_id',
		'author' => get_current_user_id(),

	);
	$posts = get_posts( $the_query );  
	if(!empty($posts)):

		foreach( $posts as $post ): setup_postdata( $post );

		?>
			<button href="#" data-dropdown="drop<?php echo get_the_ID(); ?>" aria-controls="drop<?php echo get_the_ID(); ?>" aria-expanded="false" class="button tiny dropdown"><?php the_title(); ?></button><br>
			<ul id="drop<?php echo get_the_ID(); ?>" data-dropdown-content class="f-dropdown" aria-hidden="true">
				<?php foreach ($allsublists as $value): ?>
					<li><a href="<?php echo $permalinkmain ?>?addgear=<?php echo get_the_ID(); ?>&sublist=<?php echo $value; ?>"><?php echo $value; ?></a></li>
				<?php endforeach ?>
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