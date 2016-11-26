<div
    id="post-<?php the_ID(); ?>" <?php post_class(array('mf-module', 'mf-module-1', 'no-except')) ?>>
    <?php get_template_part( 'template-parts/large/format', get_post_format() );?>
    <div class="mf-module-content-wrap">
        <div class="mf-module-content">
            <h2 class="mf-module-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <div class="mf-module-meta-info clearfix">
                <div class="module-post-element fl-left">
                    <?php
                    if (travbo_get_option('post_setting_category')) {
                        travbo_category_button();
                    }
                    ?>
                    <?php if (travbo_get_option('post_setting_date')) { ?>
                        <span class="date-display"><?php the_time('F d, Y'); ?></span>
                    <?php } ?>
                    <?php if (travbo_get_option('post_setting_comments')) { ?>
                        <span class="mf-post-comments">
                        <?php travbo_comment_number(); ?>
                    </span>
                    <?php } ?>
                </div>
                <?php
                if (travbo_get_option('post_setting_social')) {
                    travbo_social_group('fl-right');
                } ?>
            </div>
        </div>
        <!--END .mf-module-content-->
    </div>
    <!--END .mf-module-content-wrap-->
</div>
<div class="content-body">
    <?php the_content(); ?>
    <?php
    get_template_part( 'navigation' );
    /*wp_link_pages(array(
        'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'travbo') . '</span>',
        'after' => '</div>',
        'link_before' => '<span>',
        'link_after' => '</span>',
        'pagelink' => '<span class="screen-reader-text">' . __('Page', 'travbo') . ' </span>%',
        'separator' => '<span class="screen-reader-text">, </span>',
    ));*/
    ?>
    <?php if (travbo_get_option('post_setting_tags') && has_tag()) { 
        ?>
        <div class="tags-group">
            <?php the_tags('', '', ''); ?>
        </div>
    <?php 
    } ?>
</div>