<?php
function travbo_to_sidebar($classes)
{
    if (travbo_get_option('layout') == 'left-sidebar') {
        $classes[] = 'left-sidebar';
    }
    return $classes;
}

add_filter('body_class', 'travbo_to_sidebar');

function travbo_to_google_analytics()
{
    echo travbo_get_option('google_analytics');
}

add_action('wp_footer', 'travbo_to_google_analytics', 100);

function travbo_to_body_font()
{
    $switch = travbo_get_option('body_font');
    switch ($switch) {
        case 'Roboto':
            ?>
            <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic'
                  rel='stylesheet' type='text/css'>
            <style>
                body {
                    font-family: Roboto, san-serif;
                }
            </style>
            <?php
            break;
        case 'Tangerine':
            ?>
            <link href='https://fonts.googleapis.com/css?family=Tangerine:400,700' rel='stylesheet' type='text/css'>
            <style>
                body {
                    font-family: Tangerine, san-serif;
                }
            </style>
            <?php
            break;
        case 'Loved by the King':
            ?>
            <link href='https://fonts.googleapis.com/css?family=Loved+by+the+King' rel='stylesheet'
                  type='text/css'>
            <style>
                body {
                    font-family: "Loved by the King", san-serif;
                }
            </style>
            <?php
            break;
        case 'Lato':
            ?>
            <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic,300italic,300'
                  rel='stylesheet' type='text/css'>
            <style>
                body {
                    font-family: Lato, san-serif;
                }
            </style>
            <?php
            break;
        case 'Raleway':
        default:
            ?>
            <link
                href='https://fonts.googleapis.com/css?family=Raleway:400,400italic,500,500italic,600,600italic,700,700italic'
                rel='stylesheet' type='text/css'>
            <style>
                body {
                    font-family: Raleway, san-serif;
                }
            </style>
            <?php
            break;
    }
}

add_action('wp_head', 'travbo_to_body_font');

function travbo_to_styling()
{
    echo '<style>';
    if (travbo_get_option('main_color') != '') {
        ?>
        a:hover,
        .header-cart .header-cart-button .price,
        .raterater-hover-layer,
        .raterater-hover-layer.rated,
        .raterater-rating-layer,
        .raterater-outline-layer,
        .widget_categories ul li:hover a,
        .widget_categories ul li:hover:before,
        .widget_categories ul li.active:hover:before {
        color: <?php echo travbo_get_option('main_color'); ?>;
        }

        .header-cart .cart-button-group,
        .main-menu li:hover,
        .main-menu li.current-menu-item,
        .main-menu li.current-menu-ancestor,
        .main-menu li:hover .sub-menu,
        #search .search-box .sb-search-submit,
        .mf-module .module-post-element .mf-post-category,
        .comment-form .submit,
        table td#today,
        #page-title h1:after {
        background: <?php echo travbo_get_option('main_color'); ?>;
        }

        .main-block-title > span,
        .travbo_tabs_widget .tabs-title h3:hover,
        .travbo_tabs_widget .tabs-title li.active h3 {
        border-bottom-color: <?php echo travbo_get_option('main_color'); ?>;
        }

        .tags-group a:hover,
        .widget_tag_cloud .tagcloud a:hover {
        background: <?php echo travbo_get_option('main_color'); ?>;
        border-color: <?php echo travbo_get_option('main_color'); ?>;
        }

        .header-cart .pro-cart {
        border-top-color: <?php echo travbo_get_option('main_color'); ?>;
        }
        <?php
    }

    if (travbo_get_option('footer_background') != '') {
        ?>
        #footer-top-wrap {
        background-image: url(<?php echo travbo_get_option('footer_background'); ?>)
        }
        <?php
    }

    if (travbo_get_option('font_size') != '' && travbo_get_option('font_size') != '13px') {
        ?>
        body {
        font-size: <?php echo travbo_get_option('font_size'); ?>;
        }
        <?php
    }
    echo '</style>';
}

add_action('wp_head', 'travbo_to_styling');