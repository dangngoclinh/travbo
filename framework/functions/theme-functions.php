<?php
/**------------------------------------------------------------------------------------------
 * Set up the content width value based on the theme's design.
 *------------------------------------------------------------------------------------------*/
if (!isset($content_width)) {
    $content_width = 474;
}

function travbo_setup()
{
    /**
     * Make theme available for translation.
     */
    load_theme_textdomain('travbo', TRAVBO_DIR . '/languages');

    /**
     * Add default posts and comments RSS feed links to head.
     */
    add_theme_support('automatic-feed-links');

    /**
     * Add <title> in header
     */
    add_theme_support('title-tag');

    /**
     * Add theme suport
     */
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    add_theme_support('post-formats', array('gallery', 'video'));

    /**
     * Add theme support thumbnail and set size thumbnail
     */
    add_theme_support('post-thumbnails');
    add_image_size('travbo_small', 100, 80, array('center', 'center'));
    add_image_size('travbo_medium', 365, 250, array('center', 'center'));
    add_image_size('travbo_side_medium', 370, 200, array('center', 'center'));
    add_image_size('travbo_large', 760, 400, array('center', 'center'));

    /**
     * Register menu
     */
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'travbo'),
        'footer_menu' => __('Footer Menu', 'travbo'),
        ));

    /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
    add_editor_style(array('genericons/genericons.css'));
}

add_action('after_setup_theme', 'travbo_setup');


/**------------------------------------------------------------------------------------------
 * Move Comment Field To Bottom
 *------------------------------------------------------------------------------------------*/
function travbo_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'travbo_move_comment_field_to_bottom');


/**------------------------------------------------------------------------------------------
 * Change Custom excerpt more
 *------------------------------------------------------------------------------------------*/
function custom_excerpt_more($more)
{
    return '....';
}

add_filter('excerpt_more', 'custom_excerpt_more');


/**------------------------------------------------------------------------------------------
 * Set Length Excerpt
 *------------------------------------------------------------------------------------------*/
function custom_length_excerpt()
{
    return 25;
}

add_filter('excerpt_length', 'custom_length_excerpt');


/**------------------------------------------------------------------------------------------
 * Custom Comment Form Field
 *------------------------------------------------------------------------------------------*/
function custom_comment_form_field($fields)
{
    $commenter = wp_get_current_commenter();
    $fields = array(

        'author' => '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
        '" placeholder="Name" />',

        'email' => '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
        '" placeholder="Email Address" />',

        'url' => '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
        '" size="30" placeholder="Your Website" />'
        );
    return $fields;
}

add_filter('comment_form_default_fields', 'custom_comment_form_field');


/**------------------------------------------------------------------------------------------
 * Show RateBox
 *
 * @param array $args
 *------------------------------------------------------------------------------------------*/
function travbo_rate_box($args = array())
{
    $rating_total = (int)get_post_meta(get_the_ID(), TRAVBO_RATE_RATING, true);
    $rating_count = (int)get_post_meta(get_the_ID(), TRAVBO_RATE_TOTAL, true);
    if ($rating_count < 1) {
        $rating_count = 1;
    }
    $rating = ($rating_total / $rating_count);
    $rating = $rating % 5;
    ?>
    <div class="ratebox <?php echo $args['class']; ?>" data-id="<?php the_ID(); ?>"
       data-rating="<?php echo $rating; ?>"></div>
       <?php
   }


/**------------------------------------------------------------------------------------------
 * Category Button
 *------------------------------------------------------------------------------------------*/
function travbo_category_button()
{
    if (travbo_get_option('category_button')) {
        $category = get_the_category()[0];
        echo '<a href="' . get_category_link($category->term_id) . '" class="mf-post-category">
        ' . $category->name . '</a>';
    }
}


/**------------------------------------------------------------------------------------------
 * Archive Title
 *------------------------------------------------------------------------------------------*/
function travbo_archive_title()
{
    $title = __('Archives', 'travbo');
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_year()) {
        $title = get_the_date(_x('Y', 'yearly archives date format', 'travbo'));
    } elseif (is_month()) {
        $title = get_the_date(_x('F Y', 'monthly archives date format', 'travbo'));
    } elseif (is_day()) {
        $title = get_the_date(_x('F j, Y', 'daily archives date format', 'travbo'));
    } elseif (is_tax('post_format')) {
        if (is_tax('post_format', 'post-format-aside')) {
            $title = _x('Asides', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-gallery')) {
            $title = _x('Galleries', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-image')) {
            $title = _x('Images', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-video')) {
            $title = _x('Videos', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-quote')) {
            $title = _x('Quotes', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-link')) {
            $title = _x('Links', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-status')) {
            $title = _x('Statuses', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-audio')) {
            $title = _x('Audio', 'post format archive title', 'travbo');
        } elseif (is_tax('post_format', 'post-format-chat')) {
            $title = _x('Chats', 'post format archive title', 'travbo');
        }
    } elseif (is_post_type_archive()) {
        $title = sprintf(__('Archives: %s', 'travbo'), post_type_archive_title('', false));
    } elseif (is_tax()) {
        $tax = get_taxonomy(get_queried_object()->taxonomy);
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf(__('%1$s: %2$s', 'travbo'), $tax->labels->singular_name, single_term_title('', false));
    }
    return $title;
}

add_filter('get_the_archive_title', 'travbo_archive_title');


/**------------------------------------------------------------------------------------------
 * Show number of comment in post
 *------------------------------------------------------------------------------------------*/
function travbo_comment_number()
{
    comments_number(__('<strong>No</strong> Comments', 'travbo'),
        __('<strong>One</strong> Comments', 'travbo'),
        __('<strong>%</strong> Comments', 'travbo')
        );
}

/**------------------------------------------------------------------------------------------
 * Get Options info
 *
 * @param $str
 * @return string
 *------------------------------------------------------------------------------------------*/
function travbo_get_option($str)
{
    global $smof_data;
    $str = THEME_PREFIX . $str;
    if (isset($smof_data[$str]) && !empty($smof_data[$str]))
        return $smof_data[$str];
    else
        return '';
}

function travbo_social_group($class = "")
{
    if (travbo_get_option('social_group') != ''):
        ?>
    <div class="mf-module-social-share <?php echo $class; ?>">
        <a target="_blank"
        href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u=' . wp_get_shortlink()); ?>"
        class="btn-social social-fb"><i
        class="fa fa-facebook"></i></a>
        <a target="_blank" href="<?php echo esc_url('https://twitter.com/home?status=' . get_the_title() .
        ' ' . wp_get_shortlink()); ?>" class="btn-social social-tw"><i
        class="fa fa-twitter"></i></a>
        <a target="_blank"
        href="<?php echo esc_url('https://pinterest.com/pin/create/button/?url=' . wp_get_shortlink() . '&media=&description=' . get_the_title()); ?>"
        class="btn-social social-pt"><i
        class="fa fa-pinterest-p"></i></a>
    </div>
    <?php
    endif;
}

/**------------------------------------------------------------------------------------------
 * Get Options info
 *------------------------------------------------------------------------------------------*/
function travbo_copyright()
{
    ?>
    <div class="copyright fl-left">
        <?php echo travbo_get_option('footer_text'); ?>
        TravBo theme by <a href="#">MagazineFuse</a>
    </div>
    <?php
}

add_action('travbo_copyright', 'travbo_copyright');

/**------------------------------------------------------------------------------------------
 * Filter Add Ads To Post
 *
 * @param $content
 *------------------------------------------------------------------------------------------*/
function travbo_the_content_ads250($content)
{
    return $content;
}

add_action('the_content', 'travbo_the_content_ads250');

function travbo_time()
{
    the_time('F d, Y');
}

/**------------------------------------------------------------------------------------------
 * Get Thumbnail Default
 *
 * @param $size
 * @param bool|true $echo
 * @return string
 *------------------------------------------------------------------------------------------*/
function travbo_thumbnail_default($size, $echo = true)
{
    $result = TRAVBO_URL . '/images/travbo_small.png';
    switch ($size) {
        case 'medium':
        $result = TRAVBO_URL . '/images/travbo_medium.png';
        break;
        case 'large' :
        $result = TRAVBO_URL . '/images/travbo_large.png';
        break;        
    }
    if ($echo) {
        echo $result;
    } else {
        return $result;
    }
}

/**------------------------------------------------------------------------------------------
 * Add menu to Admin Bar
 *
 * @param $wp_admin_bar
 *------------------------------------------------------------------------------------------*/
function travbo_admin_bar_custom($wp_admin_bar)
{
    $args = array(
        'id' => 'travbo_theme_options',
        'title' => 'Theme Options',
        'href' => admin_url('themes.php?page=optionsframework'),
        'parent' => 'site-name',
        );
    $wp_admin_bar->add_menu($args);
}

add_action('admin_bar_menu', 'travbo_admin_bar_custom');

function travbo_header_social_group()
{
    if (travbo_get_option('social_button_header')) : ?>
    <div class="header-social-group">
        <?php
        if (travbo_get_option('social_fb')) : ?>
        <a href="<?php echo travbo_get_option('social_fb'); ?>"
         class="btn-social social-fb"><i
         class="fa fa-facebook"></i></a>
         <?php
         endif;
         if (travbo_get_option('social_tw')): ?>
         <a href="<?php echo travbo_get_option('social_tw'); ?>"
             class="btn-social social-tw"><i
             class="fa fa-twitter"></i></a>
             <?php
             endif;
             if (travbo_get_option('social_pt')): ?>
             <a href="<?php echo travbo_get_option('social_pt'); ?>"
                 class="btn-social social-pt"><i
                 class="fa fa-pinterest"></i></a>
                 <?php
                 endif;
                 ?>
             </div>
             <?php
             endif;
         }

         function travbo_social_link_group()
         {
            if (travbo_get_option('social_fb')) : ?>
            <a href="<?php echo travbo_get_option('social_fb'); ?>"
             class="btn-social social-fb"><i
             class="fa fa-facebook"></i></a>
             <?php
             endif;
             if (travbo_get_option('social_tw')): ?>
             <a href="<?php echo travbo_get_option('social_tw'); ?>"
                 class="btn-social social-tw"><i
                 class="fa fa-twitter"></i></a>
                 <?php
                 endif;
                 if (travbo_get_option('social_pt')): ?>
                 <a href="<?php echo travbo_get_option('social_pt'); ?>"
                     class="btn-social social-pt"><i
                     class="fa fa-pinterest"></i></a>
                     <?php
                     endif;
                 }

                 function travbo_add_style()
                 {
                    ?>
                    <style type="text/css">
                        <?php do_action('travbo_add_style');?>
                    </style>
                    <?php
                }

                add_action('wp_head', 'travbo_add_style');

/**------------------------------------------------------------------------------------------
 * Add menu to Admin Bar
 *
 * @param $wp_admin_bar
 *------------------------------------------------------------------------------------------*/
if (!function_exists('travbo_register_required_plugins')) {
    function travbo_register_required_plugins()
    {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            // This is an example of how to include a plugin bundled with a theme.
            array(
                'name' => 'Travbo ShortCode', // The plugin name.
                'slug' => 'travbo-shortcode', // The plugin slug (typically the folder name).
                'source' => get_template_directory() . '/framework/lib/plugins/travbo-shortcode.zip', // The plugin source.
                'required' => true, // If false, the plugin is only 'recommended' instead of required.
                'version' => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
                'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url' => '', // If set, overrides default API URL and points to an external URL.
                'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
                ),
            array(
                'name'      => 'Yoast SEO',
                'slug'      => 'wordpress-seo',
                'required'  => false,
                ),
            array(
                'name' => 'Regenerate Thumbnails',
                'slug' => 'regenerate-thumbnails',
                'required' => false,
                ),
            );

        $config = array(
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'travbo' ),
                'menu_title'                      => __( 'Install Plugins', 'travbo' ),
                'installing'                      => __( 'Installing Plugin: %s', 'travho' ), // %s = plugin name.
                // <snip>...</snip>
                'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa($plugins, $config);
    }

}

add_action('tgmpa_register', 'travbo_register_required_plugins');

/**
 * Show Logo
 * 
 * @return [type] [description]
 */
function travbo_the_custom_logo()
{
    $output = '';
    if (function_exists('get_custom_logo')) {
        $output = get_custom_logo();
    }
    return $output;
}
