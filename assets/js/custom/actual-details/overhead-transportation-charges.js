

$(document).ready(function () {
    var random_transportation_charge_id = Date.now();
    $('#add_transportation_charges_button').click(function () {
        random_transportation_charge_id = Date.now();
        RenderTransportationCharges(random_transportation_charge_id);

    });


    if (actualOverheadData.getActualOverheadTransportationCharges && actualOverheadData.getActualOverheadTransportationCharges != null && actualOverheadData.getActualOverheadTransportationCharges != '') {
        var getActualOverheadTransportationCharges = actualOverheadData.getActualOverheadTransportationCharges;
        random_transportation_charge_id = 0;
        $.each(getActualOverheadTransportationCharges, function (key, itemdata) {
            ++random_transportation_charge_id;
            RenderTransportationCharges(random_transportation_charge_id, itemdata);
        });
    } else {
        itemdata = {};
        RenderTransportationCharges(random_transportation_charge_id, itemdata);
    }

    function RenderTransportationCharges(random_transportation_charge_id, itemsdata) {

        var labels_no = $(".delete_items").length;
        ++labels_no;
        var source = $("#transportation_charges_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_transportation_charge_id: random_transportation_charge_id,
            itemdata: itemsdata,
        });
        $("#transportation_charges_container").append(rendered);
        fillMfp("#mfp_transportation_charges_" + random_transportation_charge_id);
        //fillFormMfp(formData.mfp_coverage, '#mfp_transportation_charges_' + random_transportation_charge_id);
        fillHaatList(haatmaster_data, '#haat_transportation_charges_' + random_transportation_charge_id);
        if (itemsdata != null && itemsdata != '') {
            //console.log(itemsdata);
            $("#mfp_transportation_charges_" + random_transportation_charge_id).val(itemsdata.mfp);
            $("#haat_transportation_charges_" + random_transportation_charge_id).val(itemsdata.haat);
            $("#distance_to_aggregate_point_" + random_transportation_charge_id).val(itemsdata.approx_distance)
            $("#transportation_charges_qty_" + random_transportation_charge_id).val(itemsdata.qty);
            $("#type_of_transport_" + random_transportation_charge_id).val(itemsdata.type_of_transport);
            $("#charges_per_quintal_" + random_transportation_charge_id).val(itemsdata.charges_per_qunital);
            $("#total_transportation_cost_" + random_transportation_charge_id).val(itemsdata.estimated_total_cost_of_transportation);
        }
        pr_transportation_no_inc();

    }


    function pr_transportation_no_inc() {
        var count = $(".delete_transportation_charges").length;
        $('.remove_transportation_charges').show();
        if (count == 1) {
            $('.remove_transportation_charges').hide();
        } else {
            $('.remove_transportation_charges').first().hide();
        }
    }

    initDecimalNumeric();


});


function delete_transportation_charges(random_items_id) {
    var count = $(".delete_transportation_charges").length;
    if (count > 1) {
        $("#transportation_charges_" + random_items_id).remove();
    }
}

// $(document).on('keyup', '.trans_charges', function () {
//     data_id = $(this).attr('data-id');
//     var charges_per_quintal = 0;
//     var qty = 0;
//     if ($('#charges_per_quintal_' + data_id).val() != '') {
//         charges_per_quintal = $('#charges_per_quintal_' + data_id).val();
//         charges_per_quintal = parseFloat(charges_per_quintal);
//     }
//     if ($('#transportation_charges_qty_' + data_id).val() != '') {
//         qty = $('#transportation_charges_qty_' + data_id).val();
//         qty = parseFloat(qty);
//     }
//     total_transportation_cost = charges_per_quintal * qty;
//     $('#total_transportation_cost_' + data_id).val(total_transportation_cost)

// });


