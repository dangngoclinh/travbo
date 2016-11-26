jQuery(document).ready(function ($) {
    var frame;
    $(document).on('click', '.btn-upload-logo-about-us-widget', function (e) {
        e.preventDefault();
        var p = $(this).closest('p');
        var input = $('input[type="text"]', p);

        if (frame) {
            frame.open();
        }

        frame = wp.media({
            title: 'Select Or Upload Logo For Widget',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();

            input.val(attachment.url);
        });

        frame.open();
    })
});