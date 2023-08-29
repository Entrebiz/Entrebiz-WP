(function($) {

    $(document).ready(function($) {

        /* Image upload */
        var meta_image_frame;

        $('body').on('click', '#rodller-image-upload', function(e) {

            e.preventDefault();

            if (meta_image_frame) {
                meta_image_frame.open();
                return;
            }

            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: 'Choose your image',
                button: {
                    text: 'Set Category image'
                },
                library: {
                    type: 'image'
                }
            });

            meta_image_frame.on('select', function() {

                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                $('#rodller-image-url').val(media_attachment.id);
                $('#rodller-image-preview').attr('src', media_attachment.sizes.medium.url);
                $('#rodller-image-preview').show();
                $('#rodller-image-clear').show();

            });

            meta_image_frame.open();
        });


        $('body').on('click', '#rodller-image-clear', function(e) {
            $('#rodller-image-preview').hide();
            $('#rodller-image-url').val('');
            $(this).hide();
        });
    })

})(jQuery);