<?php

class travbo_about_us_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'travbo_about_us_widget',
            'description' => __('About Us Widget', 'travbo'),
        );
        parent::__construct('travbo_about_us_widget', THEME_NAME . ' - ' . __('About Us', 'travbo'), $widget_ops);
        add_action('admin_enqueue_scripts', array($this, 'register_scripts'));
    }

    public function widget($args, $instance)
    {
        $logo = (!empty($instance['logo'])) ? $instance['logo'] : TRAVBO_URL . '/images/logo.png';
        echo $args['before_widget'];
        ?>
        <div class="site-logo">
            <a href="#">
                <img src="<?php echo $logo; ?>" alt="Logo">
            </a>
        </div>
        <p class="site-desc">
            <?php echo $instance['description']; ?>
        </p>

        <?php if (!empty($instance['facebook']) || !empty($instance['twitter']) || !empty($instance['pinterest'])): ?>
        <div class="btn-social-group">
            <?php
            if (!empty($instance['facebook'])) {
                echo '<a href="' . esc_url($instance['facebook']) . '" class="btn-social social-fb"><i
                                    class="fa fa-facebook"></i></a>';
            }
            if (!empty($instance['twitter'])) {
                echo '<a href="' . esc_url($instance['twitter']) . '" class="btn-social social-tw"><i
                                    class="fa fa-twitter"></i></a>';
            }
            if (!empty($instance['pinterest'])) {
                echo '<a href="' . esc_url($instance['pinterest']) . '" class="btn-social social-pt"><i
                                    class="fa fa-pinterest-p"></i></a>';
            } ?>
        </div>
    <?php endif; ?>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $logo = (!empty($instance['logo'])) ? $instance['logo'] : TRAVBO_URL . '/images/logo.png';
        $description = !empty($instance['description']) ? $instance['description'] : __('New title', 'travbo');
        $facebook = (!empty($new_instance['desc'])) ? $new_instance['facebook'] : 'https://www.facebook.com/magazinefuse/';
        $twitter = (!empty($new_instance['desc'])) ? $new_instance['twitter'] : '';
        $pinterest = (!empty($new_instance['desc'])) ? $new_instance['pinterest'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('logo'); ?>"><?php _e('Logo: ', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('logo'); ?>"
                   name="<?php echo $this->get_field_name('logo'); ?>" type="text"
                   value="<?php echo esc_attr($logo); ?>">
            <input type="button" class="btn-upload-logo-about-us-widget button button-primary" value="Upload Image">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description: ', 'travbo'); ?></label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('description'); ?>"
                      id="<?php echo $this->get_field_id('description'); ?>"
                      rows="7"><?php echo esc_attr($description); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>"
                   name="<?php echo $this->get_field_name('facebook'); ?>" type="text"
                   value="<?php echo esc_attr($facebook); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>"
                   name="<?php echo $this->get_field_name('twitter'); ?>" type="text"
                   value="<?php echo esc_attr($twitter); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>"
                   name="<?php echo $this->get_field_name('pinterest'); ?>" type="text"
                   value="<?php echo esc_attr($pinterest); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['logo'] = (!empty($new_instance['logo'])) ? strip_tags($new_instance['logo']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? strip_tags($new_instance['description']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook'])) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter'])) ? strip_tags($new_instance['twitter']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest'])) ? strip_tags($new_instance['pinterest']) : '';

        return $instance;
    }

    public function register_scripts()
    {
        wp_enqueue_media();
        wp_enqueue_script('admin-about-us-widget', TRAVBO_URL . '/js/admin-about-us-widget.js', array('jquery'));
    }
}

function travbo_about_us_widget_register()
{
    register_widget('travbo_about_us_widget');
}

add_action('widgets_init', 'travbo_about_us_widget_register');