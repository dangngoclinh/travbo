<?php
/* Post Format - Video */

$post_options = get_post_meta( get_the_id(), '_post_options', true );
$video = !empty($post_options['video']) ? $post_options['video'] : '';
?>

<div class="mf-module-thumb format-video">
	<?php if($video) : 
	global $wp_embed;
	$post_embed = $wp_embed->run_shortcode( '[embed width="330" height="250"]'.$video.'[/embed]' );
	echo $post_embed;
	else: ?>
	<a href="<?php the_permalink();?>"><img class="img-responsive" src="<?php travbo_thumbnail_default('medium');?>" alt="<?php the_title();?>"></a>
	<?php 
	endif; ?>
</div>