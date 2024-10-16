jQuery(function ($) {
    $(document).on('click', '.select_file_upload', function (e) {
        e.preventDefault();
        var frame;
        var _this = $(this);

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create the media frame.
        frame = wp.media(
            {
                multiple: false,
                library: {
                    type: 'application/*'
                },
                // Set the title of the modal.
                // title: jQueryel.data('choose'),
                title: 'Select file',
                // Customize the submit button.
                button: {
                    // Set the text of the button.
                    text: 'Select'
                    // text: jQueryel.data('update')
                    // Tell the button not to close the modal, since we're
                    // going to refresh the page when the image is selected.

                }
            }
        );

        // When an image is selected, run a callback.
        frame.on(
            'select', function () {
                // Grab the selected attachment.
                var attachment = frame.state().get('selection').first();
                frame.close();
                _this.parents('.rc-select-file').find('.rc-select-file-icon').html('<img src="'+attachment.attributes.icon+'">');
                _this.parents('.rc-select-file').find('.rc-select-file-title').html(attachment.attributes.filename);
                _this.parent().find('.select-file-id').val(attachment.attributes.id);
            }
        );
        frame.open();
    });
    $(document).on('click', '.select_file_remove', function (e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.rc-select-file').find('.rc-select-file-icon').html('');
        _this.parents('.rc-select-file').find('.rc-select-file-title').html('');
        _this.parent().find('.select-file-id').val('');
    });
});