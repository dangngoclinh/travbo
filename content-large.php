<div id="post-<?php the_ID(); ?>" <?php post_class(array('mf-module', 'mf-module-1')) ?>>
    <?php get_template_part( 'template-parts/large/format', get_post_format() );?>
    <div class="mf-module-content-wrap">
        <div class="mf-module-content">
            <h2 class="mf-module-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <div class="mf-module-except">
                <?php the_excerpt(); ?>
            </div>

            <div class="mf-module-meta-info clearfix">
                <div class="module-post-element fl-left">
                    <?php travbo_category_button(); ?>
                    <?php travbo_comment_number(); ?>
                </div>
                <?php travbo_social_group('fl-right'); ?>
            </div>
        </div>
        <!--END .mf-module-content-->
    </div>
    <!--END .mf-module-content-wrap-->
</div>