<?php
$defaults = array(
    'height' => 100,
    'width' => 400,
    'flex-height' => true,
    'flex-width' => true,
    'header-text' => array('site-title', 'site-description'),
);
add_theme_support('custom-logo', $defaults);

$defaults = array(
    'default-color' => '#434a54',
    'default-image' => '%1$s/images/bg.png',
    'default-repeat' => 'no-repeat',
    'default-position-x' => 'center',
    'default-attachment' => 'scroll',
    'wp-head-callback' => '_custom_background_cb',
    'admin-head-callback' => '',
    'admin-preview-callback' => ''
);
add_theme_support('custom-background', $defaults);