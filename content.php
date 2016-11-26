<div id="post-<?php the_ID(); ?>" <?php post_class(array('mf-module', 'mf-module-4', 'clearfix')); ?>>

    <?php get_template_part( 'template-parts/medium/format', get_post_format() );?>

    <div class="mf-module-content">
        <h3 class="mf-module-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>

        <div class="mf-module-meta-info clearfix">
            <div class="module-post-element">
                <?php travbo_category_button(); ?>
                <span class="mf-post-comments">
                    <?php travbo_comment_number(); ?>
                </span>
            </div>
        </div>
        <div class="mf-module-except">
            <?php the_excerpt(); ?>
        </div>

        <?php travbo_social_group(); ?>
    </div>
    <!--END .mf-module-content-->
</div>