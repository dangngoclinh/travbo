<?php
$args = array(
    'post_type' => array('post'),
    'post_status' => array('publish'),
    'posts_per_page' => '3',
    'ignore_sticky_posts' => true,
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id',
        ),
    ),
);

if (travbo_get_option('slider_post') != '') {
    $post_int = travbo_get_option('slider_post');
    $post_int = explode(',', $post_int);
    $args['post__in'] = $post_int;
} elseif (travbo_get_option('slider_cat') != 'Select a Category') {
    $args['category_name'] = travbo_get_option('slider_cat');
}

$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <div id="slider" class="clearfix">
        <?php
        $i = 0;
        while ($query->have_posts()) :
            $i++;
            $query->the_post();
            if ($i == 1) {
                ?>
                <div class="mf-module-0 thumb">
                    <?php the_post_thumbnail('travbo_large', array('class' => 'img-responsive', 'alt' => get_the_title())); ?>
                    <div class="mf-module-content-wrapper">
                        <div class="mf-module-content">
                            <h2 class="module-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <div class="date-display"><?php the_time('F d, Y'); ?></div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="mf-module-0 small thumb">
                    <?php the_post_thumbnail('travbo_side_medium', array('class' => 'img-responsive', 'alt' => get_the_title())); ?>
                    <div class="mf-module-content-wrapper">
                        <div class="mf-module-content">
                            <h3 class="module-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="date-display"><?php the_time('F d, Y'); ?></div>
                        </div>
                    </div>
                </div>
                <?php
            }
        endwhile;
        ?>
    </div>
    <!--END slider-->
    <?php
endif;
wp_reset_postdata();