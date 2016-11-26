<?php
if (!function_exists('travbo_breadcrumbs')) :
    /**
     * Display breadcrumbs
     * @since Travel Blog 1.0
     */
    function travbo_breadcrumbs()
    {
        echo '<div class="breadcrumb">';
        echo '    <ul>';
        echo '<li><a href="' . get_home_url('/') . '">Home <i class="bc-link-icon fa fa-angle-double-right"></i></a></li>';
        if (is_category()) { ?>
            <li class="item-current">
                <?php single_cat_title(''); ?>
            </li>
        <?php } elseif (is_tag()) { ?>
            <li class="item current">
                <?php single_tag_title(''); ?>
            </li>
        <?php } elseif (is_year()) { ?>
            <li class="item">
                <?php echo get_the_time('Y') ?>
            </li>
        <?php } elseif (is_month()) { ?>
            <li class="item">
                <a href="<?php echo get_year_link(get_the_time('Y')); ?>">
                    <?php echo get_the_time('Y') ?> <i class="bc-link-icon fa fa-angle-double-right"></i>
                </a>
            </li>

            <li class="item item-current"><?php echo get_the_time('F'); ?></li>
        <?php } elseif (is_day()) { ?>
            <li class="item">
                <a href="<?php echo get_year_link(get_the_time('Y')); ?>">
                    <?php echo get_the_time('Y') ?> <i class="bc-link-icon fa fa-angle-double-right"></i>
                </a>
            </li>

            <li>
                <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>">
                    <?php echo get_the_time('F'); ?> <i class="bc-link-icon fa fa-angle-double-right"></i>
                </a>
            </li>

            <li>
                <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>">
                    <?php echo get_the_time('d'); ?>
                </a>
            </li>

            <?php
        } elseif (is_page()) {
// Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

            }
        }
        echo '</ul>';
        echo '</div>';
    }
endif;