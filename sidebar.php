<div id="sidebars-wrapper" class="col-md-4 col-sm-12">
    <ul id="sidebar">
        <?php
        if (is_home()) {
            dynamic_sidebar('right_sidebar');
        } else {
            if (is_active_sidebar('sidebar_archive')) {
                dynamic_sidebar('sidebar_archive');
            } else {
                dynamic_sidebar('right_sidebar');
            }
        }
        ?>
    </ul>
</div>