jQuery(document).ready(function ($) {

    jQuery('#K3e-Export #files').on('click', '.btn-remove', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let nonce = jQuery('#row_' + id).data('nonce');
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_export_remove", nonce: nonce, id: id},
            success: function (response) {
                if (response.type == "success") {
                    row.hide();
                } else {
                    console.log('Błąd podczas usuwania komentarza.');
                }
            }
        });
    });

});