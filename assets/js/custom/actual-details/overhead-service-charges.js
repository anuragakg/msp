$(document).ready(function () {
    
    var random_service_charge_id = Date.now();
    $('#add_service_charges_button').click(function () {
        random_service_charge_id = Date.now();
        RenderServiceCharges(random_service_charge_id);

    });


    if(actualOverheadData.getActualOverheadServiceCharges && actualOverheadData.getActualOverheadServiceCharges!=null && actualOverheadData.getActualOverheadServiceCharges!=''){
        var getActualOverheadServiceCharges = actualOverheadData.getActualOverheadServiceCharges;
        random_service_charge_id = 0;
        $.each(getActualOverheadServiceCharges, function(key, itemdata) {
            ++random_service_charge_id;
            RenderServiceCharges(random_service_charge_id, itemdata);
        });
    } else {
        itemdata = {};
        RenderServiceCharges(random_service_charge_id, itemdata);

    }

    function RenderServiceCharges(random_service_charge_id, itemsdata) {
      
        var labels_no = $(".delete_items").length;
        ++labels_no;
        var source = $("#service_charges_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_service_charge_id: random_service_charge_id,
            itemdata: itemsdata,
        });
        $("#service_charges_container").append(rendered);
        fillMfp("#mfp_service_charges_" + random_service_charge_id);
        //fillFormMfp(formData.mfp_coverage,'#mfp_service_charges_'+random_service_charge_id);
        fillPrimaryLevelAgency(primaryLevelAgency,'#service_charges_primary_level_agency_'+random_service_charge_id);
        if (itemsdata != null && itemsdata != '') {
            $("#mfp_service_charges_"+random_service_charge_id).val(itemsdata.mfp);
            $("#service_charges_qty_of_mfp_"+random_service_charge_id).val(itemsdata.qty_of_mfp);
            $("#service_charges_primary_level_agency_"+random_service_charge_id).val(itemsdata.primary_level_agency)
            $("#service_charges_estimated_value_of_mfp_procurement"+random_service_charge_id).val(itemsdata.estimated_value_of_mfp_procurement);
            $("#estimated_service_charges_"+random_service_charge_id).val(itemsdata.estimated_service_charge_primary_level_agency);
            $("#share_service_charge_"+random_service_charge_id).val(itemsdata.service_charge_in_total_value_of_procurement);
        } 
        pr_service_charges_no_inc();
       

    }


    function pr_service_charges_no_inc() {
        var count = $(".delete_service_charges").length;
       
        $('.remove_service_charges').show();
        if (count == 1) {
            $('.remove_service_charges').hide();
        } else {
            $('.remove_service_charges').first().hide();
        }

    }

    initDecimalNumeric();


});


function delete_service_charges(random_service_charge_id) {
    var count = $(".delete_service_charges").length;
    
    if (count > 1) {
        $("#service_charges_" + random_service_charge_id).remove();
        
    }
}
function getServiceChargesProcurementValue(item_id){
    
    var mfp_id = $("#mfp_service_charges_"+item_id).val();

    var url = conf.getProcurementQtyValue.url(form_id,mfp_id);
    var method = conf.getProcurementQtyValue.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        //console.log(response.data);
        if (response.status) {
            $("#service_charges_estimated_value_of_mfp_procurement"+item_id).val(response.data.value);
          
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
  
    function calculateShareServiceCharge(service_id){
        var totalMfpPrice =  $("#service_charges_estimated_value_of_mfp_procurement"+service_id).val();
        var service_charge_per = $("#share_service_charge_"+service_id).val();
        service_charge_value =  (totalMfpPrice * service_charge_per)/100;
        $("#estimated_service_charges_"+service_id).val(service_charge_value);

    }

  
