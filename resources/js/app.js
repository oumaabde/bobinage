require('./bootstrap');

require('alpinejs');
require('jquery');

import 'bootstrap';
import 'jquery';

jQuery(function () {
        $('#bobinage-table').DataTable({
            "order": [[0, 'desc']],
            "autoWidth": true,
            "scrollY": 600,
            "scrollX": true
        });
        });

jQuery(function ($) {
    $('.confimationDelete').one('click',function () {
        $('#local_id_delete_form').attr("action","locals/" + $(this).data('localid'));
        $('#local_id_delete').val($(this).data('localid'));
    });

    $('.confimationDelete').one('click', function () {
        $('#agent_id_delete_form').attr("action", "agents/" + $(this).data('agentid'));
        $('#agent_id_delete').val($(this).data('agentid'));
    });

    $('.confimationDelete').one('click', function () {
        $('#marque_id_delete_form').attr("action", "marques/" + $(this).data('marqueid'));
        $('#marque_id_delete').val($(this).data('marqueid'));
    });

    $('.confimationDelete').one('click', function () {
        $('#moteur_id_delete_form').attr("action", "moteurs/" + $(this).data('moteurid'));
        $('#moteur_id_delete').val($(this).data('moteurid'));
    });

    $('.confimationDelete').one('click', function () {
        $('#ot_id_delete_form').attr("action", "ots/" + $(this).data('otid'));
        $('#ot_id_delete').val($(this).data('otid'));
    });

    $('.confimationDelete').one('click', function () {
        $('#unite_id_delete_form').attr("action", "unites/" + $(this).data('uniteid'));
        $('#unite_id_delete').val($(this).data('uniteid'));
    });

    $('.confimationDelete').one('click', function () {
        $('#rapport_id_delete_form').attr("action", "raports/" + $(this).data('rapportid'));
        $('#rapport_id_delete').val($(this).data('rapportid'));
    });

});
