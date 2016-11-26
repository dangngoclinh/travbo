<?php

class mf_about_me_widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'mf_about_me_widget',
            'description' => __('Widget About Me', 'travbo'),
        );
        parent::__construct('mf_about_me_widget', THEME_NAME . ' - ' . __('About Me', 'travbo'), $widget_ops);

        add_action('admin_enqueue_scripts', array($this, 'register_scripts'));
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <div class="about-me-widget-inner" style="background-image: url(<?php echo $instance['background']; ?>);">
            <div class="about-me-widget-content">
                <div class="avatar">
                    <a href="#" class="thumb">
                        <img src="<?php echo $instance['avatar']; ?>" alt="avatar">
                    </a>
                </div>
                <h3 class="name"><?php echo $instance['name']; ?></h3>

                <div class="desc"><?php echo $instance['desc']; ?></div>

                <?php if (!empty($instance['facebook']) || !empty($instance['twitter']) || !empty($instance['pinterest'])): ?>
                    <div class="btn-social-group">
                        <?php
                        if (!empty($instance['facebook'])):
                            echo '<a href="' . $instance['facebook'] . '" class="btn-social social-fb"><i
                                class="fa fa-facebook"></i></a>';
                        endif;
                        if (!empty($instance['twitter'])):
                            echo '<a href="' . $instance['twitter'] . '" class="btn-social social-tw"><i
                                class="fa fa-twitter"></i></a>';
                        endif;
                        if (!empty($instance['pinterest'])):
                            echo '<a href="' . $instance['pinterest'] . '" class="btn-social social-pt"><i
                                class="fa fa-pinterest-p"></i></a>';
                        endif; ?>
                    </div>
                <?php endif; ?>

            </div>
            <!--END .widget-about-me-content-->
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['avatar'] = (!empty($new_instance['avatar'])) ? strip_tags($new_instance['avatar']) : TRAVBO_URL . '/images/no-avatar.png';
        $instance['name'] = (!empty($new_instance['name'])) ? strip_tags($new_instance['name']) : '';
        $instance['desc'] = (!empty($new_instance['desc'])) ? $new_instance['desc'] : '';
        $instance['facebook'] = (!empty($new_instance['desc'])) ? $new_instance['facebook'] : 'https://www.facebook.com/magazinefuse/';
        $instance['twitter'] = (!empty($new_instance['desc'])) ? $new_instance['twitter'] : '';
        $instance['pinterest'] = (!empty($new_instance['desc'])) ? $new_instance['pinterest'] : '';
        $instance['background'] = (!empty($new_instance['desc'])) ? $new_instance['background'] : TRAVBO_URL . '/images/about-me-bg.jpg';

        return $instance;
    }

    public function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('avatar'); ?>"><?php _e('Avatar:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('avatar'); ?>"
                   name="<?php echo $this->get_field_name('avatar'); ?>" type="text"
                   value="<?php echo esc_attr($instance['avatar']); ?>">
            <input class="btn-upload-avatar-about-me-widget button button-primary" type="button" value="Upload Image"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>"
                   name="<?php echo $this->get_field_name('name'); ?>" type="text"
                   value="<?php echo esc_attr($instance['name']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description:', 'travbo'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('desc'); ?>"
                      name="<?php echo $this->get_field_name('desc'); ?>"
                      rows="7"><?php echo esc_attr($instance['desc']); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>"
                   name="<?php echo $this->get_field_name('facebook'); ?>" type="text"
                   value="<?php echo esc_attr($instance['facebook']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>"
                   name="<?php echo $this->get_field_name('twitter'); ?>" type="text"
                   value="<?php echo esc_attr($instance['twitter']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>"
                   name="<?php echo $this->get_field_name('pinterest'); ?>" type="text"
                   value="<?php echo esc_attr($instance['pinterest']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Background:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('background'); ?>"
                   name="<?php echo $this->get_field_name('background'); ?>" type="text"
                   value="<?php echo esc_attr($instance['background']); ?>">
            <input class="btn-upload-background-about-me-widget button button-primary" type="button"
                   value="Upload Image"/>
        </p>
        <?php
    }

    public function register_scripts()
    {
        wp_enqueue_media();
        wp_enqueue_script('admin-about-me-widget', TRAVBO_URL . '/js/admin-about-me-widget.js', array('jquery'));
    }
}

function mf_about_me_widget_register()
{
    register_widget('mf_about_me_widget');
}
add_action('widgets_init', 'mf_about_me_widget_register');