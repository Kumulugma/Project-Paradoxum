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

jQuery(document).ready(function(){
    jQuery('.k3e-toggle').hide();
    
    jQuery(document).on('click', '.btn-toggle', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        jQuery('#'+id).toggle();
    });
});
