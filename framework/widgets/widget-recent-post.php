<?php

class travbo_recent_post_widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'travbo_recent_post_widget',
            'description' => __('Recent Post Widget', 'travbo')
        );
        parent::__construct('mf_recent_post_widget', THEME_NAME . ' - ' . __('Recent Post', 'travbo'), $widget_ops);
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) :
            echo $args['before_title'];
            echo apply_filters('widget_title', $instance['title']);
            echo $args['after_title'];
        endif;
        ?>
        <ul class="block-content">
            <?php
            // WP_Query arguments
            $number_of_post = (!empty($instance['number_of_post'])) ? $instance['number_of_post'] : 5;
            $args = array(
                'post_type' => array('post'),
                'post_status' => array('publish'),
                'posts_per_page' => $number_of_post,
                'ignore_sticky_posts' => true,
            );

            // The Query
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()): $query->the_post();
                    $no_thumbnail = '';
                    if (!has_post_thumbnail()) {
                        $no_thumbnail = 'no-thumbnail';
                    }
                    ?>
                    <li class="clearfix">
                        <div class="mf-module-2 <?php echo $no_thumbnail; ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="post-thumbnail">
                                    <a href="#" class="thumb">
                                        <?php the_post_thumbnail('travbo_small', array('alt' => get_the_title())); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>

                                <?php travbo_rate_box(); ?>
                                <?php if ($instance['date_display']) : ?>
                                    <div class="date-display">
                                        <?php the_time('F j, Y'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endwhile;
            endif;
            wp_reset_postdata(); ?>
        </ul>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = sanitize_text_field($instance['title']);
        $number_of_post = isset($instance['number_of_post']) ? $instance['number_of_post'] : 5;
        $date_display = isset($instance['date_display']) ? (bool)$instance['date_display'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'travbo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('number_of_post'); ?>"><?php _e('How many items would you like to display? ', 'travbo'); ?></label>
            <select name="<?php echo $this->get_field_name('number_of_post') ?>"
                    id="<?php echo $this->get_field_id('number_of_post') ?>">
                <?php
                for ($i = 1; $i <= 15; $i++) {
                    if ($number_of_post == $i) {
                        echo '<option value="' . $i . '" selected>' . $i . '</option>';
                    } else {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                }
                ?>
            </select>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($date_display); ?>
                   id="<?php echo $this->get_field_id('date_display'); ?>"
                   name="<?php echo $this->get_field_name('date_display'); ?>">
            <label for="<?php echo $this->get_field_id('date_display'); ?>">Display post
                date?</label>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number_of_post'] = (!empty($new_instance['number_of_post'])) ? (int)$new_instance['number_of_post'] : 5;
        $instance['date_display'] = isset($new_instance['date_display']) ? (bool)$new_instance['date_display'] : false;
        return $instance;
    }
}


add_action('widgets_init', 'travbo_recent_post_widget_register');
function travbo_recent_post_widget_register()
{
    register_widget('travbo_recent_post_widget');
}