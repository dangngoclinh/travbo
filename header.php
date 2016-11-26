<!DOCTYPE html>
<!--[if IE 8 ]>
<html <?php language_attributes(); ?> class="ie8">
<![endif]-->
<!--[if IE 9 ]>
<html <?php language_attributes(); ?> class="ie9">
<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo TRAVBO_URL . '/js/html5shiv.min.js'?>"></script>
    <script src="<?php echo TRAVBO_URL . '/js/respond.min.js'?>"></script>
    <![endif]-->
    <?php wp_head(); ?>
    <style type="text/css">
        <?php do_action('travbo_add_style');?>
    </style>
</head>
<body <?php body_class(); ?>>
    <?php
/*global $smof_data;
echo '<pre>' . print_r($smof_data, true) . '</pre>';
*/ ?>
<div id="wrapper-outer">
    <div id="wrapper">
        <div id="inner-wrapper">
            <div class="container">
                <div id="header">
                    <div class="site-branding clearfix">

                        <div class="logo">
                            <?php echo travbo_the_custom_logo(); ?>
                            <?php
                            $tag = (is_home() || is_front_page()) ? 'h1' : 'div';
                            echo "<$tag class='site-title'><a href='" . home_url('/') . "'>" . get_bloginfo('name') . "</a></$tag>";
                            ?>
                            <h2 class="site-description"><?php echo get_bloginfo('description'); ?></h2>
                        </div>

                        <?php
                        if (travbo_get_option('header_ads') != '' && travbo_get_option('enable_header_ads')) {
                            echo '<div class="header-adds">';
                            echo travbo_get_option('header_ads');
                            echo '</div>';
                        }
                        ?>
                        <!--END .header-ads-->

                        <?php travbo_header_social_group(); ?>
                        <!--END .header-social-group-->

                        <a id="main-menu-pull" class="pull-link" href="#">
                            <i class="pull-icon"></i>
                        </a>

                    </div>
                    <div id="main-nav-wrapper">
                        <div id="main-nav" class="clearfix">
                            <?php
                            if(has_nav_menu( 'primary' ))
                            {
                                $args = array(
                                    'menu' => 'Primary Menu',
                                    'theme_location' => 'primary',
                                    'container' => 'nav',
                                    'container_id' => 'main-menu',
                                    'menu_class' => 'main-menu',
                                    'depth' => 4
                                    );
                                wp_nav_menu($args);
                            }
                            else
                            {
                                echo '<p class="no-primary-menu fl-left">';
                                _e('Set primary menu inside WordPress Arppearance > Menu ', 'travbo');
                                echo '</p>';
                            }
                            ?>
                            <div id="search-wrap" class="fl-right">
                                <form id="search" action="<?php echo home_url('/'); ?>">
                                    <div class="search-button">
                                        <a href="#" class="btn-search"><i class="fa fa-search"></i></a>
                                    </div>
                                    <div class="search-box-wrap text-left">
                                        <div class="search-box">
                                            <input type="text" name="s" placeholder="Search">
                                            <button class="sb-search-submit" type="submit">
                                                <i class="fa fa-search sb-icon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--END #search-->
                        </div>
                        <!--END #main-nav-->
                    </div>
                    <!--END #main-nav-wrapper-->
                </div>
                <!--END #header-->