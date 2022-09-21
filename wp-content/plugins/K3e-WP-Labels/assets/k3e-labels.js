jQuery(document).ready(function ($) {

    jQuery('input#csv_media_manager').click(function (e) {

        e.preventDefault();
        var image_frame;
        if (image_frame) {
            image_frame.open();
        }
        // Define image_frame as wp.media object
        image_frame = wp.media({
            title: 'Select Media',
            library: {
                type: ['text/csv'],
            }
        });

        image_frame.on('close', function () {
            // On close, get selections and save to the hidden input
            // plus other AJAX stuff to refresh the image preview
            var selection = image_frame.state().get('selection').first().toJSON();

            if (selection.length === 0)
                return true;//if closed withput selecting an image
            selection = selection.id;
            jQuery('input#csv-file').val(selection);
            Refresh_Image(selection);
        });

        image_frame.on('open', function () {
            // On open, get the id from the hidden input
            // and select the appropiate images in the media manager
            var selection = image_frame.state().get('selection');
            var id = jQuery('input#csv-file').val();
            var attachment = wp.media.attachment(id);
            attachment.fetch();
            selection.add(attachment ? [attachment] : []);
        });

        image_frame.open();
    });

    jQuery('input#csv_media_remover').click(function (e) {

        e.preventDefault();
        jQuery('#csv-box').html('<i class="fa fa-upload" aria-hidden="true" style="font-size: 4em;"></i>');
        jQuery('input#csv-file').val('');


    });

});

// Ajax request to refresh the image preview
function Refresh_Image(the_id) {
    var data = {
        action: 'labels_get_attachments',
        id: the_id
    };

    jQuery.get(ajaxurl, data, function (response) {

        if (response.success === true) {
            jQuery('#attachments-box').html("");
            jQuery.each(response.data.attachments, function (index, value) {
                jQuery('#attachments-box').append(value);
            });
        }
    });
}