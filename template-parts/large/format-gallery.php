<?php
/* Post Format - Video */

$images = get_children( 
	array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'post_mine_type' => 'image',
		'order' => 'ASC')
); ?>
<div class="mf-module-thumb">
	<?php if($images) : ?>
		<ul class="slides">
			<?php foreach($images as $image_id => $image) {
				$img_src = wp_get_attachment_image_src( $image_id, 'travbo_large' );
				echo '<li class="slide"><img class="img-responsive" src="'.$img_src[0].'" alt="'.get_the_title().'"></li>';
			} 
			?>
		</ul>
	<?php else: ?>
		<a href="<?php the_permalink();?>"><img class="img-responsive" src="<?php travbo_thumbnail_default('large');?>" alt="<?php the_title();?>"></a>
	<?php endif; ?>
</div>