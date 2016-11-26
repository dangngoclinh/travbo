<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="mf-module-thumb">
            <a href="#" class="thumb">
                <?php the_post_thumbnail('travbo_large', array('class' => 'img-responsive', 'alt' => get_the_title())); ?>

            </a>
        </div>
    <?php endif; ?>
    <header class="page-title">
        <h2>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    </header>
    <!--END .mf-module-content-->
    <div class="content-body">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'travbo') . '</span>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '<span class="screen-reader-text">' . __('Page', 'travbo') . ' </span>%',
            'separator' => '<span class="screen-reader-text">, </span>',
        ));
        ?>
        <div class="tags-group">
            <?php the_tags('', '', ''); ?>
        </div>
    </div>

</div>