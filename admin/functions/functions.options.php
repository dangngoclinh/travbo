<?php

add_action('init', 'of_options');

if (!function_exists('of_options')) {
    function of_options()
    {
        //Access the WordPress Categories via an Array
        $of_categories = array();
        $of_categories_obj = get_categories('hide_empty=0');
        foreach ($of_categories_obj as $of_cat) {
            $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
        }
        array_unshift($of_categories, 'Select a Category');

        //Access the WordPress Pages via an Array
        $of_pages = array();
        $of_pages_obj = get_pages('sort_column=post_parent,menu_order');
        foreach ($of_pages_obj as $of_page) {
            $of_pages[$of_page->ID] = $of_page->post_name;
        }


        //Sample Homepage blocks for the layout manager (sorter)
        $of_options_homepage_blocks = array
        (
            "disabled" => array(
                "placebo" => "placebo", //REQUIRED!
                "block_one" => "Block One",
                "block_two" => "Block Two",
                "block_three" => "Block Three",
            ),
            "enabled" => array(
                "placebo" => "placebo", //REQUIRED!
                "block_four" => "Block Four",
            ),
        );


        //Background Images Reader
        $bg_images_path = get_stylesheet_directory() . '/images/bg/'; // change this to where you store your bg images
        $bg_images_url = get_template_directory_uri() . '/images/bg/'; // change this to where you store your bg images
        $bg_images = array();

        if (is_dir($bg_images_path)) {
            if ($bg_images_dir = opendir($bg_images_path)) {
                while (($bg_images_file = readdir($bg_images_dir)) !== false) {
                    if (stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                        natsort($bg_images); //Sorts the array into a natural order
                        $bg_images[] = $bg_images_url . $bg_images_file;
                    }
                }
            }
        }


        /*-----------------------------------------------------------------------------------*/
        /* TO DO: Add options/functions that use these */
        /*-----------------------------------------------------------------------------------*/

        //More Options
        $uploads_arr = wp_upload_dir();
        $all_uploads_path = $uploads_arr['path'];
        $all_uploads = get_option('of_uploads');
        $other_entries = array("Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19");
        $body_repeat = array("no-repeat", "repeat-x", "repeat-y", "repeat");
        $body_pos = array("top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right");

        // Image Alignment radio box
        $of_options_thumb_align = array("alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center");

        // Image Links to Options
        $of_options_image_link_to = array("image" => "The Image", "post" => "The Post");


        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        // Set the Options Array
        global $of_options;
        $of_options = array();

        /**
         * Home Setting Section
         */
        $of_options[] = array('name' => __('Home Settings', 'travbo'),
            'type' => 'heading',
            'icon' => '<span class="dashicons dashicons-admin-home"></span>',
        );

        $of_options[] = array(
            'name' => __('Hello there!', 'travbo'),
            'desc' => '',
            'id' => 'introduction',
            'std' => '<h3 style=\"margin: 0 0 10px;\">Welcome to the ' . THEME_NAME . ' Option.</h3>
						TravBo is Free WordPRess blog themes for magazine, personal blog, travel blog and more.
						<a href="' . admin_url('customize.php') . '">Click here</a> to custom Logo, Custom background',
            'icon' => true,
            'type' => 'info'
        );

        /*        $of_options[] = array(
        'name' => __('Logo', 'travbo'),
        'desc' => __('Change LOGO Width Image Upload', 'travbo'),
        'id' => THEME_PREFIX . 'logo',
        'std' => '',
        'type' => 'upload',
        );*/

        $of_options[] = array(
            'name' => __('Enable Footer Menu', 'travbo'),
            'desc' => __('Disable OR Enable Footer Menu', 'travbo'),
            'id' => THEME_PREFIX . 'footer_menu',
            'std' => 1,
            'type' => 'switch'
        );

        $of_options[] = array(
            'name' => __('Enable Slider', 'travbo'),
            'desc' => 'Disable OR Enable Slider',
            'id' => THEME_PREFIX . 'slider',
            'std' => 1,
            'type' => 'switch'
        );

        $of_options[] = array(
            'name' => __('Enable Slider in post', 'travbo'),
            'desc' => 'Disable OR Enable Slider in post ',
            'id' => THEME_PREFIX . 'slider_in_post',
            'std' => 0,
            'type' => 'switch'
        );

        $of_options[] = array(
            'name' => __('Post for Slider', 'travbo'),
            'desc' => __('Enter post id or page id for slider (post and page must has post thumbnail). <br> Example: 2, 33, 423, 4', 'travbo'),
            'id' => THEME_PREFIX . 'slider_post',
            'std' => '',
            'type' => 'text'
        );

        $of_options[] = array(
            'name' => __('Category for Slider', 'travbo'),
            'desc' => __('If you don\'t input Text field: Post for slider, You must select category for slider', 'travbo'),
            'id' => THEME_PREFIX . 'slider_cat',
            'std' => 'Select a Category',
            'type' => 'select',
            'options' => $of_categories,
        );

        /**
         * General Setting
         */
        $of_options[] = array(
            'name' => __('General Settings', 'travbo'),
            'type' => 'heading',
            'icon' => '<span class="dashicons dashicons-admin-generic"></span>',
        );

        $url = ADMIN_DIR . 'assets/images/';
        $of_options[] = array(
            'name' => __('Main Layout', 'travbo'),
            'desc' => 'Select main content and sidebar alignment. Choose between left sidebar or right sidebar.',
            'id' => THEME_PREFIX . 'layout',
            'std' => 'right-sidebar',
            'type' => 'images',
            'options' => array(
                'right-sidebar' => $url . '2cr.png',
                'left-sidebar' => $url . '2cl.png',
            )
        );

        $url = ADMIN_DIR . 'assets/images/';
        $of_options[] = array(
            'name' => __('Archive Style', 'travbo'),
            'id' => THEME_PREFIX . 'archive_style',
            'std' => 'medium',
            'type' => 'images',
            'options' => array(
                'large' => $url . 'content-large.png',
                'medium' => $url . 'content-medium.png',
            ),
        );

        $of_options[] = array(
            'name' => __('Category Button', 'travbo'),
            'id' => THEME_PREFIX . 'category_button',
            'std' => 1,
            'desc' => __('Show and Hidden category button in archive', 'travbo'),
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Social Group', 'travbo'),
            'id' => THEME_PREFIX . 'social_group',
            'std' => 1,
            'desc' => __('Show and Hidden social group button in archive', 'travbo'),
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Tracking Code', 'travbo'),
            'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'travbo'),
            'id' => THEME_PREFIX . 'google_analytics',
            'std' => '',
            'type' => 'textarea'
        );

        $of_options[] = array(
            'name' => __('Footer Widget Active', 'travbo'),
            'desc' => __('Enable / Disable Footer Widget', 'travbo'),
            'id' => THEME_PREFIX . 'footer_widget',
            'std' => 1,
            'type' => 'switch'
        );

        $of_options[] = array('name' => __('Footer Text', 'travbo'),
            'desc' => 'You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]',
            'id' => THEME_PREFIX . 'footer_text',
            'std' => 'Powered by <a href="https://wordpress.org/">WordPress</a>.',
            'type' => 'textarea'
        );

        /**
         * Social Network
         */
        $of_options[] = array(
            'name' => __('Social Network', 'travbo'),
            'icon' => '<span class="dashicons dashicons-admin-site"></span>',
            'type' => 'heading',
        );

        $of_options[] = array(
            'name' => __('Show Social Button in Header', 'travbo'),
            'desc' => __('Enable / Disable Social Button Group', 'travbo'),
            'id' => THEME_PREFIX . 'social_button_header',
            'std' => 1,
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Facebook', 'travbo'),
            'desc' => __('Facebook URl', 'travbo'),
            'id' => THEME_PREFIX . 'social_fb',
            'std' => 'https://www.facebook.com/magazinefuse/',
            'type' => 'text',
        );

        $of_options[] = array(
            'name' => __('Twitter', 'travbo'),
            'desc' => __('Twitter URl', 'travbo'),
            'id' => THEME_PREFIX . 'social_tw',
            'std' => 'https://twitter.com/magazinefuse',
            'type' => 'text',
        );

        $of_options[] = array(
            'name' => __('Pinterest', 'travbo'),
            'desc' => __('Pinterest URl', 'travbo'),
            'id' => THEME_PREFIX . 'social_pt',
            'std' => '',
            'type' => 'text',
        );

        $of_options[] = array(
            'name' => __('Google +', 'travbo'),
            'desc' => __('Google + URl', 'travbo'),
            'id' => THEME_PREFIX . 'social_gl',
            'std' => '',
            'type' => 'text',
        );

        /**
         * Post Options Sections
         */
        $of_options[] = array(
            'name' => __('Post Setting', 'travbo'),
            'icon' => '<span class="dashicons dashicons-format-aside"></span>',
            'type' => 'heading'
        );

        $of_options[] = array(
            'name' => __('Post Settings!', 'travbo'),
            'desc' => '',
            'id' => THEME_PREFIX . 'post_setting',
            'std' => '<h3 style=\"margin: 0 0 10px;\">' . __('Post Settings', 'travbo') . ' Option.</h3> Setting all element in Post Single Page',
            'icon' => true,
            'type' => 'info'
        );

        $of_options[] = array(
            'name' => __('Category button', 'travbo'),
            'desc' => __('Enable / Disable category button in post', 'travbo'),
            'id' => THEME_PREFIX . 'post_setting_category',
            'std' => 1,
            'type' => 'switch',
        );
        $of_options[] = array(
            'name' => __('Date Display button', 'travbo'),
            'desc' => __('Enable / Disable date display in post', 'travbo'),
            'id' => THEME_PREFIX . 'post_setting_date',
            'std' => 1,
            'type' => 'switch',
        );
        $of_options[] = array(
            'name' => __('Number comments', 'travbo'),
            'desc' => __('Enable / Disable number comments in post', 'travbo'),
            'id' => THEME_PREFIX . 'post_setting_comments',
            'std' => 1,
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Social sharing button', 'travbo'),
            'desc' => __('Enable / Disable Social sharing button in post', 'travbo'),
            'id' => THEME_PREFIX . 'post_setting_social',
            'std' => 1,
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Tags', 'travbo'),
            'desc' => __('Enable / Disable tags in post', 'travbo'),
            'id' => THEME_PREFIX . 'post_setting_tags',
            'std' => 1,
            'type' => 'switch',
        );
        /**
         * Page Contact Sections
         */
        $of_options[] = array(
            'name' => __('Contact Setting', 'travbo'),
            'type' => 'heading',
            'icon' => '<span class="dashicons dashicons-email"></span>',
        );

        $of_options[] = array(
            'name' => __('Contact Settings!', 'travbo'),
            'desc' => '',
            'std' => '<h3 style=\"margin: 0 0 10px;\">' . __('Contact Settings', 'travbo') . ' Option.</h3> Setting all element in Post Single Page',
            'icon' => true,
            'type' => 'info'
        );

        $of_options[] = array(
            'name' => __('Map Enable', 'travbo'),
            'desc' => __('Show map in contact page', 'travbo'),
            'id' => THEME_PREFIX . 'contact_map',
            'std' => 1,
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Map LatLng', 'travbo'),
            'desc' => __('LatLng in Google Map ', 'travbo'),
            'id' => THEME_PREFIX . 'contact_map_latlng',
            'std' => '15.4450035,108.0057559',
            'type' => 'text',
        );

        $of_options[] = array(
            'name' => __('Place Title', 'travbo'),
            'id' => THEME_PREFIX . 'contact_map_title',
            'std' => 'Title',
            'type' => 'text',
        );

        $of_options[] = array(
            'name' => __('Place Description', 'travbo'),
            'id' => THEME_PREFIX . 'contact_map_desc',
            'std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, porro.',
            'type' => 'textarea',
        );

        $of_options[] = array(
            'name' => __('Contact Address', 'travbo'),
            'id' => THEME_PREFIX . 'contact_address',
            'std' => '',
            'type' => 'textarea'
        );

        $of_options[] = array(
            'name' => __('Contact Phone  Enable', 'travbo'),
            'id' => THEME_PREFIX . 'contact_phone_enable',
            'std' => 1,
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Contact Phone', 'travbo'),
            'id' => THEME_PREFIX . 'contact_phone',
            'std' => '+1 123 456 7890
+1 323 456 8900',
            'type' => 'textarea'
        );

        $of_options[] = array(
            'name' => __('Contact Email Enable', 'travbo'),
            'id' => THEME_PREFIX . 'contact_email_enable',
            'std' => 1,
            'type' => 'switch',
        );

        $of_options[] = array(
            'name' => __('Contact Email', 'travbo'),
            'id' => THEME_PREFIX . 'contact_email',
            'std' => 'mail@example.com',
            'type' => 'textarea'
        );

        $of_options[] = array(
            'name' => __('Social Network Enable', 'travbo'),
            'id' => THEME_PREFIX . 'contact_social_network',
            'std' => 1,
            'type' => 'switch',
        );

        /**
         * Styling Options Sections
         */
        $of_options[] = array(
            "name" => "Styling Options",
            "type" => "heading",
            'icon' => '<span class="dashicons dashicons-sos"></span>',
        );

        $of_options[] = array('name' => 'Body Font',
            'desc' => __('Choose font for website, Raleway is default.', 'travbo'),
            'id' => THEME_PREFIX . 'body_font',
            'std' => 'Select a font',
            'type' => 'select_google_font',
            'preview' => array(
                'text' => __('This is my preview text!', 'travbo'), //this is the text from preview box
                'size' => '30px' //this is the text size from preview box
            ),
            'options' => array(
                'none' => __('Select a font', 'travbo'),//please, always use this key: 'none'
                'Lato' => 'Lato',
                'Loved by the King' => 'Loved By the King',
                'Tangerine' => 'Tangerine',
                'Roboto' => 'Roboto',
                'Raleway' => 'Raleway'
            )
        );

        $of_font_size = array();
        for ($i = 9; $i <= 17; $i++) {
            $px = $i . 'px';
            $of_font_size[$px] = $px;
        }

        $of_options[] = array(
            'name' => __('Body Font Size', 'travbo'),
            'desc' => 'Select Font Size.',
            'id' => THEME_PREFIX . 'font_size',
            'std' => '13px',
            'type' => 'select',
            'mod' => 'mini',
            'options' => $of_font_size,
        );

        $of_options[] = array('name' => 'Styling Color',
            'desc' => __('Pick a background color for the theme (default: #ffcd03).', 'travbo'),
            'id' => THEME_PREFIX . 'main_color',
            'std' => '',
            'type' => 'color'
        );

        $of_options[] = array(
            'name' => __('Footer Background', 'travbo'),
            'desc' => __('Change Footer Background', 'travbo'),
            'id' => THEME_PREFIX . 'footer_background',
            'std' => '',
            'type' => 'upload'
        );

        $of_options[] = array('name' => __('Body Font', 'travbo'),
            'desc' => __('Specify the body font properties', 'travbo'),
            'id' => 'body_font',
            'std' => array('size' => '12px', 'style' => 'normal', 'color' => '#000000'),
            'type' => 'typography'
        );

        $of_options[] = array('name' => __('Custom CSS', 'travbo'),
            'desc' => __('Quickly add some CSS to your theme by adding it to this block.', 'travbo'),
            'id' => THEME_PREFIX . 'custom_css',
            'std' => '',
            'type' => 'textarea'
        );

        /**
         * Advertising Section
         */
        $of_options[] = array(
            'name' => __('Advertising', 'travbo'),
            'type' => 'heading',
            'icon' => '<span class="dashicons dashicons-chart-pie"></span>',
        );

        $of_options[] = array(
            'name' => __('Enable Header Ads', 'travbo'),
            'id' => THEME_PREFIX . 'enable_header_ads',
            'std' => 1,
            'type' => 'switch',
            'desc' => __('ON / OFF Header Ads', 'travbo'),
        );

        $of_options[] = array(
            'name' => __('Header Ads', 'travbo'),
            'id' => THEME_PREFIX . 'header_ads',
            'type' => 'textarea',
            'std' => '<a href="#" class="thumb"><img src="' . TRAVBO_URL . '/images/top-ads.jpg" alt="Header Ads"></a>'
        );

        /**
         * Backup Options
         */
        $of_options[] = array(
            'name' => __('Backup Options', 'travbo'),
            'type' => 'heading',
            'icon' => '<span class="dashicons dashicons-backup"></span>',
        );

        $of_options[] = array('name' => 'Backup and Restore Options',
            'id' => 'of_backup',
            'std' => '',
            'type' => 'backup',
            'desc' => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
        );

        $of_options[] = array('name' => 'Transfer Theme Options Data',
            'id' => 'of_transfer',
            'std' => '',
            'type' => 'transfer',
            'desc' => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
        );

    }//End function: of_options()
}//End chack if function exists: of_options()