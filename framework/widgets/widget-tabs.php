<?php

class travbo_tabs_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'travbo_tabs_widget',
            'description' => 'Tabs Widget',
        );
        parent::__construct('travbo_tabs_widget', THEME_NAME . ' - ' . __('Tabs', 'travbo'), $widget_ops);
    }

    public function widget($args, $instance)
    {
        $posts_per_page = isset($instance['number']) ? $instance['number'] : 5;
        echo $args['before_widget'];
        ?>
        <div class="tabs-title">
            <ul class="clearfix">
                <li class="tab-link active" data-tab="latest"><h3>Lastest</h3></li>
                <li class="tab-link" data-tab="popular"><h3>Popular</h3></li>
                <li class="tab-link" data-tab="random"><h3>Random</h3></li>
                <li class="tab-link" data-tab="comments"><h3>Comments</h3></li>
            </ul>
        </div>
        <div class="mf-block mf-block-3 tabs-content">
            <div class="block-content">
                <ul class="tab-content latest active">
                    <?php
                    $query = new WP_Query(array(
                        'post_type' => array('post'),
                        'post_status' => array('publish'),
                        'posts_per_page' => $posts_per_page,
                        'ignore_sticky_posts' => true,
                        'orderby' => 'modified',
                    ));
                    if ($query->have_posts()):
                        while ($query->have_posts()) : $query->the_post();
                            ?>
                            <li class="clearfix">
                                <div class="mf-module-2">
                                    <div class="post-thumbnail">
                                        <a href="#" class="thumb">
                                            <?php if (has_post_thumbnail()) {
                                                the_post_thumbnail('travbo_small', array('alt' => get_the_title()));
                                            } ?>
                                        </a>
                                    </div>
                                    <div class="module-content">
                                        <h4 class="post-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>

                                        <div class="date-display">
                                            <?php the_time('F j, Y'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </ul>
                <ul class="tab-content popular">
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/food2.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">The Different of Lifestyle between
                                        people of
                                        small
                                        and big
                                        city</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/food3.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Nam ipsum risus, rutrum vitae,
                                        vestibulum
                                        eu,
                                        molestie
                                        vel</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/food4.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Praesent metus tellus, elementum eu,
                                        semper
                                        a,
                                        adipiscing
                                        nec</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/food5.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Cras non dolor. Ut non enim eleifend
                                        felis
                                        pretium
                                        feugiat</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/beautiful1.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Ut non enim eleifend felis pretium
                                        feugiat
                                        pellentesque
                                        egestas</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="tab-content random">
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/beautiful1.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">The Different of Lifestyle between
                                        people of
                                        small
                                        and big
                                        city</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/beautiful2.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Nam ipsum risus, rutrum vitae,
                                        vestibulum
                                        eu,
                                        molestie
                                        vel</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/beautiful3.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Praesent metus tellus, elementum eu,
                                        semper
                                        a,
                                        adipiscing
                                        nec</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/beautiful4.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Cras non dolor. Ut non enim eleifend
                                        felis
                                        pretium
                                        feugiat</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/beautitufl5.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Ut non enim eleifend felis pretium
                                        feugiat
                                        pellentesque
                                        egestas</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="tab-content comments">
                    <?php
                    $args = array(
                        'status' => 'approve',
                        'type' => 'comment',
                        'post_status' => 'publish',
                        'post_type' => 'post',
                        'number' => '5',
                    );

                    $comment_query = new WP_Comment_Query;
                    $comments = $comment_query->query($args);
                    if ($comments) :
                        foreach ($comments as $com) :
                            ?>
                            <li class="clearfix">
                                <div class="mf-module-2">
                                    <div class="post-thumbnail">
                                        <a href="#" class="thumb">
                                            <?php ?>
                                        </a>
                                    </div>
                                    <div class="module-content">
                                        <h4 class="post-title">
                                            <a href="#">The Different of Lifestyle between
                                                people of
                                                small
                                                and big
                                                city</a>
                                        </h4>

                                        <div class="date-display">
                                            October 30, 20
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/travel1.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">The Different of Lifestyle between
                                        people of
                                        small
                                        and big
                                        city</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/travel2.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Nam ipsum risus, rutrum vitae,
                                        vestibulum
                                        eu,
                                        molestie
                                        vel</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/travel3.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Praesent metus tellus, elementum eu,
                                        semper
                                        a,
                                        adipiscing
                                        nec</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/travel4.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Cras non dolor. Ut non enim eleifend
                                        felis
                                        pretium
                                        feugiat</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="mf-module-2">
                            <div class="post-thumbnail">
                                <a href="#" class="thumb">
                                    <img src="images/travel5.jpg" alt="Travel 1">
                                </a>
                            </div>
                            <div class="module-content">
                                <h4 class="post-title">
                                    <a href="#">Ut non enim eleifend felis pretium
                                        feugiat
                                        pellentesque
                                        egestas</a>
                                </h4>

                                <div class="date-display">
                                    October 30, 20
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $number = isset($instance['number']) ? $instance['number'] : 5;
        $date_display = isset($instance['date_display']) ? (bool)$instance['date_display'] : false;

        ?>
        <p>
            <label
                for="<?php echo $this->get_field_id('date_display'); ?>"><?php _e('Date display? ', 'travbo'); ?></label>
            <input type="checkbox" class="checkbox" <?php checked($date_display); ?>
                   name="<?php echo $this->get_field_name('date_display'); ?>"
                   id="<?php echo $this->get_field_id('date_display'); ?>"
                   value="<?php echo $date_display; ?>">
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('number'); ?>">
                <?php _e('How much item do you want to display?', 'travbo'); ?></label>
            <select name="<?php echo $this->get_field_name('number'); ?>"
                    id="<?php echo $this->get_field_id('number'); ?>">
                <?php
                for ($n = 1; $n <= 15; $n++) {
                    if ($number == $n) {
                        echo '<option value="' . $n . '" selected>' . $n . '</option>';
                    } else {
                        echo '<option value="' . $n . '">' . $n . '</option>';
                    }
                }
                ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}

function register_travbo_tabs_widget()
{
    register_widget('travbo_tabs_widget');
}

add_action('widgets_init', 'register_travbo_tabs_widget');