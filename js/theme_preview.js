jQuery(document).ready(function ($) {

    // Setting Sidebar
    wp.customize('travbo_setting_sidebar', function (value) {
        value.bind(function (newval) {
            if (newval == 0) {
                $('body').addClass("left-sidebar");
            } else {
                $('body').removeClass("left-sidebar");
            }
        });
    });
});