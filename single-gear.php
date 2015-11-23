<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); 
$permalinkmain = get_permalink();
$idmain = get_the_ID();




?>
<?php while ( have_posts() ) : the_post(); 

$brands = wp_get_post_terms( $idmain, 'brand');
$geartypes = wp_get_post_terms( get_the_ID(), 'geartype');


?>
<div class="row">
	<div class="columns small-12 large-8 large-offset-2"><a href="<?php echo get_permalink( 91 ); ?>" class="button">Zurück zu meiner Ausrüstung</a></div>
	<div class="small-12 medium-12 large-8 large-offset-2 columns end">

	<?php do_action( 'foundationpress_before_content' ); ?>
	
		<br />

		 	<?php

		 	//Nutzerweiche
		 	$author = get_the_author_meta('ID');
		 	$current_user = wp_get_current_user()->ID;




		 	if ($author == $current_user) {
		 		get_template_part( 'parts/gear-content-private' );
		 	}elseif( 0 != $current_user){
		 		get_template_part( 'parts/gear-content-public' );
		 	}else{
		 		get_template_part( 'parts/gear-content-no-login' );
		 	}
		 	?>

	<?php do_action( 'foundationpress_after_content' ); ?>

	</div>
<?php endwhile;?>


</div><!-- row -->









<?php get_footer(); ?>