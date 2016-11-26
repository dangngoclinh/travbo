<?php
/**--------------------------------------------------------------------
 * Register Widget
 * --------------------------------------------------------------------*/
add_action('widgets_init', 'mf_widget_init');
function mf_widget_init()
{
    //Main Sidebar
    $before_widget = '<li id="%1$s" class="widget %2$s">';
    $after_widget = '</li>';
    $before_title = '<h2 class="main-block-title"><span>';
    $after_title = '</span></h2>';

    register_sidebar(array(
        'name' => __('Sidebar Home', 'travbo'),
        'id' => 'right_sidebar',
        'description' => __('Sidebar for Home Page', 'travbo'),
        'before_widget' => $before_widget,
        'after_widget' => $after_widget,
        'before_title' => $before_title,
        'after_title' => $after_title
    ));

    register_sidebar(array(
        'name' => __('Sidebar Archive', 'travbo'),
        'id' => 'sidebar_archive',
        'description' => __('Sidebar for archive (category, tags, blog)', 'travbo'),
        'before_widget' => $before_widget,
        'after_widget' => $after_widget,
        'before_title' => $before_title,
        'after_title' => $after_title
    ));

    if (travbo_get_option('footer_widget') == '1') {
        //Footer Widget
        $footer_before_widget = '<li class="col-md-4 col-sm-12"><div id="%1$s" class="widget %2$s">';
        $footer_after_widget = '</div></li>';
        $footer_before_title = '<h2 class="main-block-title"><span>';
        $footer_after_title = '</span></h2>';

        register_sidebar(array(
            'name' => __('Footer Widget', 'travbo'),
            'id' => 'footer_widget',
            'description' => __('Footer Widget', 'travbo'),
            'before_widget' => $footer_before_widget,
            'after_widget' => $footer_after_widget,
            'before_title' => $footer_before_title,
            'after_title' => $footer_after_title));
    }
}

/**--------------------------------------------------------------------
 * Load Widgets
 * --------------------------------------------------------------------*/
locate_template('framework/widgets/widget-about-me.php', true, true);
locate_template('framework/widgets/widget-recent-post.php', true, true);
locate_template('framework/widgets/widget-about-us.php', true, true);
locate_template('framework/widgets/widget-tabs.php', true, true);