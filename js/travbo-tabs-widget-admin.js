jQuery(document).ready(function ($) {

    $(document).on('click', '.travbo_tabs_widget_setting .setting_btn', function (e) {
        e.preventDefault();
        var li = $(this).closest('li');
        $('.setting_form', li).slideToggle();
    });
});