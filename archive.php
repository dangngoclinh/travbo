<?php get_header(); ?>
<div id="main">
    <div id="page-title">
        <div id="page-title-inner">
            <?php the_archive_title('<h1>', '</h1>'); ?>
            <?php travbo_breadcrumbs(); ?>
            <!--END .breadcrumbs-->
        </div>
    </div>
    <div id="main-content">
        <div class="row">
            <div id="primary-wrapper" class="col-md-8 col-sm-12">
                <div id="primary">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();

                        if (travbo_get_option('archive_style') == 'large') {
                            get_template_part('content', 'large');
                        } else {
                            get_template_part('content');
                        }

                    endwhile;

                    //Navigation
                    get_template_part( 'navigation' );

                    endif; ?>
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