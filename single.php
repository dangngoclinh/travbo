<?php get_header(); ?>

    <div id="main">
        <?php
        if (travbo_get_option('slider_in_post')) {
            get_template_part('slider');
        }
        ?>
        <div id="main-content">
            <div class="row">
                <div id="primary-wrapper" class="col-md-8 col-sm-12">
                    <div id="primary">
                        <div class="content">
                            <?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post(); ?>
                                    <?php get_template_part('content', 'single'); ?>
                                    <!--END content-single-->
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php comments_template(); ?>
                        </div>
                    </div>
                    <!--END #primary-->
                </div>
                <!--END #primary-wrap-->

                <?php get_sidebar(); ?>
                <!--END sidebar-->
            </div>
        </div>
        <!--END #content-->
    </div>
    <!--END #main-->
<?php get_footer(); ?>