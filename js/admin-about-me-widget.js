jQuery(document).ready(function ($) {
    var frame;
    $(document).on('click', '.btn-upload-background-about-me-widget', function (event) {
        event.preventDefault();
        var p = $(this).closest('p');
        var input = $('input[type="text"]', p);
        if (frame) {
            frame.open();
        }
        frame = wp.media({
            title: 'Select or Upload Background for About Me Widget',
            button: {
                text: 'Use This Image for Background'
            },
            multiple: false,
            type: 'image'
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();

            input.val(attachment.url);
        });

        frame.open();
    });

    $(document).on('click', '.btn-upload-avatar-about-me-widget', function (event) {
        event.preventDefault();
        var p = $(this).closest('p');
        var input = $('input[type="text"]', p);
        if (frame) {
            frame.open();
        }
        frame = wp.media({
            title: 'Select or Upload Avatar for About Me Widget',
            button: {
                text: 'Use This Image for Avatar'
            },
            multiple: false,
            type: 'image'
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();

            input.val(attachment.url);
        });

        frame.open();
    });
});