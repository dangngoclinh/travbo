<?php
/**
 * Template Name: Home
 * @package Travbo
 * @since Travbo 1.0
 */
get_header(); ?>
    <div id="main">
        <?php
        if (travbo_get_option('slider')) {
            get_template_part('slider');
        }
        ?>

        <div id="main-content">
            <div class="row">
                <div id="primary-wrapper" class="col-md-8 col-sm-12">
                    <div id="primary">
                        <?php
                        if (have_posts()) :
                            while (have_posts()):
                                the_post();
                                echo do_shortcode(get_the_content());
                            endwhile;
                        endif; ?>
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