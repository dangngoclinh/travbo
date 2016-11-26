<?php

/**------------------------------------------------------------------------------------------
 * Init Scripts Travbo
 * -------------------------------------------------------------------------------------------*/
function travbo_scripts()
{
    wp_register_style('bootstrap', TRAVBO_URL . '/css/bootstrap.css');
    wp_enqueue_style('bootstrap');
    wp_register_style('font_awesome', TRAVBO_URL . '/css/font-awesome.min.css');
    wp_enqueue_style('font_awesome');
    wp_register_style('owl_carousel', TRAVBO_URL . '/css/owl.carousel.css');
    wp_enqueue_style('owl_carousel');
    wp_register_style('travbo_style', TRAVBO_URL . '/style.css');
    wp_enqueue_style('travbo_style');

    wp_register_script('jquery', TRAVBO_URL . '/js/jquery-1.12.2.min.js', array(), false, true);
    wp_enqueue_script('jquery');
    wp_register_script('owl_carousel', TRAVBO_URL . '/js/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('owl_carousel');
    wp_register_script('rate_rater', TRAVBO_URL . '/js/raterater.jquery.js', array('jquery'), false, true);
    wp_enqueue_script('rate_rater');
    wp_register_script('travbo_script', TRAVBO_URL . '/js/script.js', array('jquery'), '1.0', true);
    wp_localize_script('travbo_script', 'travbo_data', array(
        'admin_ajax' => admin_url('admin-ajax.php'),
    ));
    wp_enqueue_script('travbo_script');


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'travbo_scripts');


function travbo_admin_scripts()
{
    wp_register_style( 'travbo-admin-style', TRAVBO_URL . '/css/travbo-admin-style.css' );
    wp_enqueue_style( 'travbo-admin-style' );
}

add_action( 'admin_enqueue_scripts', 'travbo_admin_scripts' );

/**------------------------------------------------------------------------------------------
 * Rate Box ajax
 *------------------------------------------------------------------------------------------*/
function travbo_ratebox_ajax()
{
    $id = $_POST['id'];
    $rating = $_POST['rating'];
    $rate_rating = get_post_meta($id, TRAVBO_RATE_RATING, true);
    $rate_total = get_post_meta($id, TRAVBO_RATE_TOTAL, true);
    update_post_meta($id, TRAVBO_RATE_RATING, $rate_rating + $rating);
    update_post_meta($id, TRAVBO_RATE_TOTAL, $rate_total + 1);
    wp_send_json_success(array(
        'rating' => $rating
    ));
}

add_action('wp_ajax_travbo_ratebox', 'travbo_ratebox_ajax');