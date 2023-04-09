jQuery(document).ready(function ($) {

    jQuery('#K3eGrowlist').on('click', '.btn-label', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let nonce = jQuery(this).data('nonce');
        let button = jQuery(this);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_tables_add_label", nonce: nonce, id: id},
            success: function (response) {
                if (response.type == "success") {
                    button.removeClass('button-secondary');
                    button.addClass('button-primary');
                } else {
                    console.log('Błąd podczas usuwania komentarza.');
                }
            }
        });
    });

    jQuery('#K3eGrowlist #labels').on('click', '.btn-remove', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let nonce = jQuery(this).data('nonce');
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_tables_remove_label", nonce: nonce, id: id},
            success: function (response) {
                if (response.type == "success") {
                    row.hide();
                } else {
                    console.log('Błąd podczas usuwania komentarza.');
                }
            }
        });
    });
    
    jQuery('#K3eGrowlist #labels').on('click', '.btn-save', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let nonce = jQuery(this).data('nonce');
        let value = jQuery('#amount_' + id).val();
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_tables_save_label", nonce: nonce, id: id, value: value},
            success: function (response) {
                if (response.type == "success") {
                    console.log('Zapisano');
                    row.addClass('done');
                } else {
                    console.log('Błąd podczas usuwania komentarza.');
                }
            }
        });
    });
    
        jQuery('#K3eGrowlist #files .btn-edit').click(function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let value = jQuery('#comment_' + id).html();
        let row = jQuery('#row_' + id);
        if (parseInt(row.data('form')) === 0) {
            row.data('form', 1);
            jQuery('#comment_' + id).html('<input type="text" name="comment" id="comment-data-' + id + '" value="' + value + '"> <button data-id="' + id + '" class="button button-primary btn-save"><i class="fa fa-save" aria-hidden="true"></i></button> <button data-id="' + id + '" class="button button-danger btn-close"><i class="fa fa-close" aria-hidden="true"></i></button>');
        }
    });
    
    jQuery('#K3eGrowlist #files').on('click', '.btn-save', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let comment = jQuery('#comment-data-' + id).val();
        let nonce = jQuery('#row_' + id).data('nonce');
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_tables_new_label_comment", nonce: nonce, id: id, comment: comment},
            success: function (response) {
                if (response.type == "success") {
                    row.data('form', 0);
                    jQuery("#comment_" + id).html(response.comment);
                } else {
                    row.data('form', 0);
                    jQuery("#comment_" + id).html(response.comment);
                }
            }
        });
    });

jQuery('#K3eGrowlist #files').on('click', '.btn-close', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let row = jQuery('#row_' + id);
        let comment = jQuery('#comment-data-' + id).val();
        let nonce = jQuery('#row_' + id).data('nonce');
        if (parseInt(row.data('form')) === 1) {
            row.data('form', 0);
            jQuery.ajax({
                type: "post",
                dataType: "json",
                url: myAjax.ajaxurl,
                data: {action: "k3e_tables_new_label_old_comment", nonce: nonce, id: id, comment: comment},
                success: function (response) {
                    if (response.type == "success") {
                        jQuery("#comment_" + id).html(response.comment);
                    } else {
                        jQuery("#comment_" + id).html();
                    }
                }
            });
        }
    });
    
    jQuery('#K3eGrowlist #files').on('click', '.btn-remove', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let nonce = jQuery('#row_' + id).data('nonce');
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_tables_new_label_remove", nonce: nonce, id: id},
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