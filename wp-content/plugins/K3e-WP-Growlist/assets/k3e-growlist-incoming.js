jQuery(document).ready(function ($) {

    jQuery('#species').on('click', '.btn-add', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let species = jQuery('#incoming_species option:selected').val();
        let nonce = jQuery('#species').data('nonce');
        let counter = jQuery('#species').data('counter');
        let tbody = jQuery('#species tbody');

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_incoming_species", nonce: nonce, id: id, species: species},
            success: function (response) {
                if (response.type == "success") {
                    tbody.html(tbody.html() + '<tr id="row_' + species + '" data-form="0"><td>' + (counter + 1) + '</td><td id="code_' + species + '">' + response.code + '</td><td>' + response.name + '</td><td id="status_' + species + '" data-status="'+response.status_id+'">' + response.status + '</td><td><span class="badge badge-' + response.badge + '"></span></td><td id="passport_' + species + '">' + response.passport + '</td><td class="actions"> <button data-species="' + response.species + '" data-id="' + response.id + '"  class="button button-secondary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i></button> <button ata-species="' + response.species + '" data-id="' + response.id + '"   class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
                    jQuery('#species').data('counter', counter + 1);
                } else {
                    console.log('Błąd dodawania wpisu');
                }
            }
        });
    });

    jQuery('#species').on('click', '.btn-remove', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let species = jQuery(this).data('species');
        let nonce = jQuery('#species').data('nonce');
        let row = jQuery('#row_' + species);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_incoming_species_remove", nonce: nonce, id: id, species: species},
            success: function (response) {
                if (response.type == "success") {
                    row.hide();
                } else {
                    console.log('Błąd podczas usuwania gatunku.');
                }
            }
        });
    });


    jQuery('#species').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let species = jQuery(this).data('species');
        let code = jQuery('#code_' + species);
        let status = jQuery('#status_' + species);
        let passport = jQuery('#passport_' + species);
        let code_val = code.html();
        let status_val = status.data('status');
        let passport_val = passport.html();
        let form = jQuery('#row_' + species).data('form');

        if (form == 0) {
            code.html('<input type="text" name="species_code" value="' + code_val + '"/>');
            status.html('<select name="species_status"><option value="1"' + (status_val == 1 ? 'selected' : '') + '>Transport</option><option value="2"' + (status_val == 2 ? 'selected' : '') + '>Wysiane</option><option value="3"' + (status_val == 3 ? 'selected' : '') + '>Rośnie</option><option value="4"' + (status_val == 4 ? 'selected' : '') + '>Oczekuje</option><option value="5"' + (status_val == 5 ? 'selected' : '') + '>Zimuje</option><option value="6"' + (status_val == 6 ? 'selected' : '') + '>Stracone</option></status>');
            passport.html('<input type="text" name="species_passport" value="' + passport_val.trim() + '"/>');
            jQuery(this).parent().html('<button id="save_' + species + '" data-species="' + species + '" data-id="' + id + '"  class="button button-primary btn-save"><i class="fa fa-save" aria-hidden="true"></i></button>' + jQuery(this).parent().html());
            jQuery('#row_' + species).data('form', 1);
        }
    });

    jQuery('#species').on('click', '.btn-save', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let species = jQuery(this).data('species');
        let code = jQuery('#species #code_' + species);
        let badge = jQuery('#species #badge_' + species);
        let status = jQuery('#species #status_' + species);
        let passport = jQuery('#species #passport_' + species);
        let code_val = jQuery('#species #code_' + species).find('input').val();
        let status_val = jQuery('#species #status_' + species + ' select option:selected').val();
        let passport_val = jQuery('#species #passport_' + species).find('input').val();
        let nonce = jQuery('#species').data('nonce');
        
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_incoming_species_save", nonce: nonce, id: id, species: species, code: code_val, status: status_val, passport: passport_val},
            success: function (response) {
                if (response.type == "success") {
                    code.html(response.code);
                    status.html(response.status);
                    passport.html(response.passport);
                    badge.find('span').removeClass(response.removeClass);
                    badge.find('span').addClass(response.addClass);
                    jQuery('#species #save_' + species).remove();
                    jQuery('#row_' + species).data('form', 0);
                    status.data('status', status_val);
                } else {
                    console.log('Błąd podczas zapisu gatunku');
                    jQuery('#row_' + species).data('form', 0);
                    jQuery('#species #save_' + species).remove();
                }
            }
        });
    });
    
    jQuery('#species').on('click', '.btn-code', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let species = jQuery(this).data('species');
        let code = jQuery('#species #code_' + species);
        let nonce = jQuery('#species').data('nonce');
        
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_incoming_species_generate_code", nonce: nonce, id: id, species: species},
            success: function (response) {
                if (response.type == "success") {
                    code.html(response.species_code);
                    jQuery('#species #generate_' + species).remove();
                } else {
                    console.log('Błąd podczas generowania kodu');
                }
            }
        });
    });
});
