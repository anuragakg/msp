
$(document).ready(function () {
    var random_service_charge_dia_id = Date.now();
   
    if(actualOverheadData.getActualOverheadServiceChargesDIA && actualOverheadData.getActualOverheadServiceChargesDIA!=null && actualOverheadData.getActualOverheadServiceChargesDIA!=''){
        var getMfpServiceChargesDIA = actualOverheadData.getActualOverheadServiceChargesDIA;
        random_service_charge_dia_id = 0;
        $.each(getMfpServiceChargesDIA, function(key, itemdata) {
            ++random_service_charge_dia_id;
            RenderServiceChargesDIA(random_service_charge_dia_id, itemdata);

        });
      
    }else{
        var mfp_coveragedata = mfp_result;
        random_service_charge_dia_id = 0;
         var mfps=[];
        $.each(mfp_coveragedata, function(key, mfp_coverageRow) {
            $.each(mfp_coverageRow.commodity_details, function(key, itemdata) {
                ++random_service_charge_dia_id;
                if(jQuery.inArray(itemdata.mfp_id,mfps) != -1){
                }
                else{
                RenderServiceChargesDIA(random_service_charge_dia_id, itemdata);
            }
            mfps.push(itemdata.mfp_id);
            });
        });
       
    }

    function RenderServiceChargesDIA(random_service_charge_dia_id, itemdata) {
        var source = $("#service_charges_dia_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_service_charge_dia_id: random_service_charge_dia_id,
            itemdata: itemdata,
        });
      
        $("#service_charges_dia_container").append(rendered);
        $("#service_charge_at_dia_district_id"+random_service_charge_dia_id).val(district_id);
        $("#service_charge_at_dia_district_name"+random_service_charge_dia_id).val(district_name);
        //$("#procurement_estimated_value"+random_service_charge_dia_id).val(itemdata.estimated_value_of_procurement);
        $("#service_charges_percentage"+random_service_charge_dia_id).val(itemdata.service_charges_percentage);
        $("#service_charge"+random_service_charge_dia_id).val(itemdata.service_charge_value);
        if(itemdata.mfp_id){
            getEstimatedValueOfProcurement(itemdata.mfp_id,random_service_charge_dia_id);
        }
       
       
        
        
    }
    initDecimalNumeric();
});

function getEstimatedValueOfProcurement(mfp_id,item_id){
    var url = conf.getEstimatedValueOfProcurement.url(form_id,mfp_id);
    var method = conf.getEstimatedValueOfProcurement.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            var value_in_lakhs = response.data/100000;
            $("#procurement_estimated_value"+item_id).val(value_in_lakhs);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}

function calculateSeriveCharge(service_id){
    var totalMfpPrice =  $("#procurement_estimated_value"+service_id).val();
    var service_charge_per = $("#service_charges_percentage"+service_id).val();
    service_charge_value =  (totalMfpPrice * service_charge_per)/100;
    $("#service_charge"+service_id).val(service_charge_value.toFixed(4));

}


