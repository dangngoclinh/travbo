<div class="mf-module-thumb">
	<a href="<?php the_permalink(); ?>" class="thumb">

		<?php if(function_exists('has_post_thumbnail') && has_post_thumbnail()) :?>
			<?php the_post_thumbnail('travbo_large', array('class' => 'img-responsive', 'alt' => get_the_title())); ?>
		<?php else: ?>
			<img class="img-responsive" src="<?php travbo_thumbnail_default('large');?>" alt="<?php the_title();?>">
		<?php endif;?>

	</a>
</div>
