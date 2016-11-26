<div id="footer">
    <?php
    if (is_active_sidebar('footer_widget') && travbo_get_option('footer_widget') == '1') : ?>
    <div id="footer-top-wrap">
        <div id="footer-top">
            <ul class="ft-widget clearfix">
                <?php dynamic_sidebar('footer_widget'); ?>
            </ul>
        </div>
        <!--END #footer-top-->
    </div>
    <!--END #footer-top-wrap-->
    <?php
    endif; ?>
    <div id="copyright" class="clearfix">
        <?php do_action('travbo_copyright'); ?>
        <?php
        if (travbo_get_option('footer_menu')) {
            if(has_nav_menu( 'footer_menu' ))
            {
                $args = array(
                    'menu' => 'Footer Menu',
                    'depth' => 1,
                    'theme_location' => 'footer_menu',
                    'container' => 'div',
                    'container_class' => 'footer-menu fl-right',
                    'fallback_cb' => '',
                    );
                wp_nav_menu($args);
            }
            else
            {
                echo '<span class="fl-right">';
                _e('Set footer menu inside WordPress Arppearance > Menu ', 'travbo');
                echo '</span>';
            }
        } ?>
    </div>
</div>
<!--END #footer-->
</div>
</div>
<!--END #inner-wrapper-->
</div>
<!--END #wrapper-->
<div id="menu-main-mobile">
    <div class="search-mobile">
        <form action="<?php echo home_url('/'); ?>">
            <input type="text" name="s" placeholder="Search...">
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
    <?php
    $args = array(
        'menu' => 'Primary Menu',
        'theme_location' => 'primary',
        'container' => '',
        'menu_class' => 'menu-mobile',
        'depth' => 4,
        'fallback_cb' => '',
        );
    wp_nav_menu($args);
    ?>
</div>
</div>
<!--<div class="template-option">
    <a href="#" class="left-sidebar">
        Left Sidebar
    </a>
</div>-->
<div id="fb-root"></div>
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=335676953259212";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php wp_footer(); ?>
<!--END Script-->
</body>
</html>