<?php

if (is_home() || is_archive() || is_search()) {
	if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	} else {
		if ($wp_query->max_num_pages > 1):

			$previous_link = get_previous_posts_link(__('<i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous', 'travbo'));
		$next_link     = get_next_posts_link(__('Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>', 'travbo'));
		?>
		<ul class="travbo-pagination clearfix">
			<?php
			if ($previous_link) {
				echo '<li class="previous fl-left">' . $previous_link . '</li>';
			}
			if ($next_link) {
				echo '<li class="next fl-right">' . $next_link . '</li>';
			}
			?>
		</ul>
		<?php
		endif;
	}
}

if (is_singular()) {
	if (is_attachment()) {
		?>
		<?php
	} else {
		$defaults = array(
			'before'           => '<p>' . __( 'Pages:', 'travbo'),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page', 'travbo' ),
			'previouspagelink' => __( 'Previous page', 'travbo' ),
			'pagelink'         => '%',
			'echo'             => 1
			);
		
		wp_link_pages( $defaults );
	}
}