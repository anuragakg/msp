$(document).ready(function () {
    var url_var = getUrlVars();

    haat_master_id = url_var['id'];
    var random_weightment_charge_id = Date.now();

    $('#add_weightment_charges_button').click(function () {
        random_weightment_charge_id = Date.now();
        RenderWeightmentCharges(random_weightment_charge_id);

    });


    
    if(actualOverheadData.getActualOverheadWeightmentCharges && actualOverheadData.getActualOverheadWeightmentCharges!=null && actualOverheadData.getActualOverheadWeightmentCharges!=''){
        var getMfpWeightmentCharges = actualOverheadData.getActualOverheadWeightmentCharges;
        random_weightment_charge_id = 0;
        $.each(getMfpWeightmentCharges, function(key, itemdata) {
            ++random_weightment_charge_id;
            RenderWeightmentCharges(random_weightment_charge_id, itemdata);
        });
    }  else {
        itemdata = {};
        RenderWeightmentCharges(random_weightment_charge_id, itemdata);
    }

    function RenderWeightmentCharges(random_weightment_charge_id, itemsdata) {
        var source = $("#weightment_charges_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_weightment_charge_id: random_weightment_charge_id,
            itemdata: itemsdata,
        });
        $("#weightment_charges_container").append(rendered);
        fillMfp('#mfp_weightment_charges_'+random_weightment_charge_id);
        //fillFormMfp(formData.mfp_coverage,'#mfp_weightment_charges_'+random_weightment_charge_id);
        fillHaatList(haatmaster_data,'#haat_weightment_charges_haat'+random_weightment_charge_id);
        fillProcurementCenterList(MultipurposeProcurementItem_data,'#haat_weightment_charges_procurement_center_id'+random_weightment_charge_id);
        if (itemsdata != null && itemsdata != '') {
            $('#mfp_weightment_charges_'+random_weightment_charge_id).val(itemsdata.mfp);
            $('#'+random_weightment_charge_id+'_'+itemsdata.type).prop('checked', true);
            if(itemsdata.type == 'H'){
                  $('#weightment_charges_haat'+random_weightment_charge_id).show();
                  $('#haat_weightment_charges_haat'+random_weightment_charge_id).val(itemsdata.haat_id);
            }
            if(itemsdata.type == 'P'){
                   $('#weightment_charges_procurement'+random_weightment_charge_id).show();    
                   $('#haat_weightment_charges_procurement_center_id'+random_weightment_charge_id).val(itemsdata.procurement_center_id);
            }
        }
        pr_weightment_charges_no_inc();
    }


    function pr_weightment_charges_no_inc() {
        var count = $(".delete_weightment_charges").length;

        //$('.remove_items').first().hide();   
        $('.remove_weightment_charges').show();
        if (count == 1) {
            $('.remove_weightment_charges').hide();
        } else {
            $('.remove_weightment_charges').first().hide();
        }
    }

    initDecimalNumeric();


});

function delete_weightment_charges(random_weightment_charge_id) {
      
    var count = $(".delete_weightment_charges").length;
    if (count > 1) {
        $("#weightment_charges_" + random_weightment_charge_id).remove();
        
    }
    
}

function haatProcurementCheck(type,random_weightment_charge_id) {
    if (type == 'H') {
        $('#weightment_charges_haat'+random_weightment_charge_id).show();
        $('#weightment_charges_procurement'+random_weightment_charge_id).hide();
        $("input:radio[name=weightment_charges]["+random_weightment_charge_id+"][type]'")[0].checked = true;
     }
     if(type=='P'){
        $('#weightment_charges_haat'+random_weightment_charge_id).hide();
        $('#weightment_charges_procurement'+random_weightment_charge_id).show();
        $("input:radio[name=weightment_charges]["+random_weightment_charge_id+"][type]'")[1].checked = true;
     }
    // else document.getElementById('ifYes').style.visibility = 'hidden';

}

