
$(document).ready(function () {
    var random_labour_charge_id = Date.now();
    $('#add_labour_charges_button').click(function () {
        random_labour_charge_id = Date.now();
        RenderLabourCharges(random_labour_charge_id);

    });

    if(actualOverheadData.getActualOverheadLabourCharges && actualOverheadData.getActualOverheadLabourCharges!=null && actualOverheadData.getActualOverheadLabourCharges!=''){
        var getMfpLabourCharges = actualOverheadData.getActualOverheadLabourCharges;
        random_labour_charge_id = 0;
        $.each(getMfpLabourCharges, function(key, itemdata) {
            ++random_labour_charge_id;
            RenderLabourCharges(random_labour_charge_id, itemdata);
        });
    } else {
        labour_charges_data = [];
        RenderLabourCharges(random_labour_charge_id,labour_charges_data );


    }

    function RenderLabourCharges(random_labour_charge_id, itemsdata) {
        var source = $("#labour_charges_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_labour_charge_id: random_labour_charge_id,
            itemdata: itemsdata,
        });
        $("#labour_charges_container").append(rendered);
        fillMfp('#mfp_labour_charges_'+random_labour_charge_id);
        //fillFormMfp(formData.mfp_coverage,'#mfp_labour_charges_'+random_labour_charge_id);
        fillHaatList(haatmaster_data,'#haat_labour_charges_'+random_labour_charge_id);
        if (itemsdata != null && itemsdata != '') {
            $("#mfp_labour_charges_"+random_labour_charge_id).val(itemsdata.mfp);
            $("#haat_labour_charges_"+random_labour_charge_id).val(itemsdata.haat);
            $("#unit_manday_rate"+random_labour_charge_id).val(itemsdata.unit_manday_rate);
            $("#estimated_mandays"+random_labour_charge_id).val(itemsdata.estimated_mandays);
            $("#total_estimated_labour_cost_"+random_labour_charge_id).val(itemsdata.total_estimated_cost);
        } 
        pr_labour_charges_no_inc();
      
    }


    function pr_labour_charges_no_inc() {
        var count = $(".delete_labour_charges").length;
        $('.remove_labour_charges').show();
        if (count == 1) {
            $('.remove_labour_charges').hide();
        } else {
            $('.remove_labour_charges').first().hide();
        }



    }

    initDecimalNumeric();

});

function delete_labour_charges(random_labour_charge_id) {
    var count = $(".remove_labour_charges").length;
    if (count > 1) {
        $("#labour_charges_" + random_labour_charge_id).remove();
        // pr_no_inc();
    }
}



function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}


/*** To calculate total estimated labour cost***/
function calculateTotalLabourCost(random_labour_charges_id) {

    var unit_manday_rate = $("#unit_manday_rate" + random_labour_charges_id).val() ? parseFloat($("#unit_manday_rate" + random_labour_charges_id).val()) : '';
    var mandays = $("#estimated_mandays" + random_labour_charges_id).val() ? parseFloat($("#estimated_mandays" + random_labour_charges_id).val()) : '';
    if (unit_manday_rate != '' && mandays != '') {
        //calculate value
        total_estimated_labour_cost = unit_manday_rate * mandays;
        //populate in field
        $("#total_estimated_labour_cost_" + random_labour_charges_id).val(total_estimated_labour_cost);
    } else {
        $("#total_estimated_labour_cost_" + random_labour_charges_id).val('0');
    }



}

