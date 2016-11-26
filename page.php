<?php
get_header(); ?>
    <div id="main">
        <div id="main-content">
            <div class="row">
                <div id="primary-wrapper" class="col-md-8 col-sm-12">
                    <div id="primary">
                        <?php
                        while (have_posts()): the_post();
                            get_template_part('content', 'page');
                        endwhile; ?>
                    </div>
                    <!--END #primary-->

                </div>
                <!--END #primary-wrapper-->

                <?php get_sidebar(); ?>
                <!--END sidebar-->
            </div>
        </div>
        <!--END #main-content-->
    </div>
<?php
get_footer();