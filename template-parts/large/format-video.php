<?php
/* Post Format - Video */

$post_options = get_post_meta( get_the_id(), '_post_options', true );
$video = !empty($post_options['video']) ? $post_options['video'] : '';
?>

<div class="mf-module-thumb">
	<?php if($video) : 
	global $wp_embed;
	$post_embed = $wp_embed->run_shortcode( '[embed width="750" height="500"]'.$video.'[/embed]' );
	echo $post_embed;
	else: ?>
	<a href="<?php the_permalink();?>"><img class="img-responsive" src="<?php travbo_thumbnail_default('large');?>" alt="<?php the_title();?>"></a>
	<?php 
	endif; ?>
</div>