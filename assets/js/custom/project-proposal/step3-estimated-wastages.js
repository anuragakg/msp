
$(document).ready(function () {
  
    var random_estimated_wastages_id = Date.now();
    
    $('#add_estimated_wastages_button').click(function () {
        random_estimated_wastages_id = Date.now();
        RenderEstimatedWastages(random_estimated_wastages_id);

    });

    if(formData.getMfpEstimatedWastages && formData.getMfpEstimatedWastages!=null && formData.getMfpEstimatedWastages!=''){
        var estimatedWasatagesData = formData.getMfpEstimatedWastages;
        random_estimated_wastages_id = 0;
        $.each(estimatedWasatagesData, function(key, itemdata) {
            ++random_estimated_wastages_id;
            RenderEstimatedWastages(random_estimated_wastages_id, itemdata);
        });
    } else {
        var estimated_wastages_data = [] ;
        RenderEstimatedWastages(random_estimated_wastages_id, estimated_wastages_data);

    }


    function RenderEstimatedWastages(random_estimated_wastages_id, itemsdata) {
        var source = $("#estimated_wastages_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_estimated_wastages_id: random_estimated_wastages_id,
            itemdata: itemsdata,
        });
        $("#estimated_wastages_container").append(rendered);
        fillFormMfp(formData.mfp_coverage,'#mfp_estimated_wastages_'+random_estimated_wastages_id);
        fillWarehouses(warehouses,'#estimated_wastages_warehouse_'+random_estimated_wastages_id);
        pr_estimated_wastages_no_inc();

        if (itemsdata != '' && itemsdata != null) {
            $('#mfp_estimated_wastages_' + random_estimated_wastages_id).val(itemsdata.mfp);
            $('#estimated_wastages_warehouse_' + random_estimated_wastages_id).val(itemsdata.warehouse);
            $('#estimated_wastages_procurement_quantity_' + random_estimated_wastages_id).val(decimalValues(itemsdata.procurement_quantity));
            $('#estimated_wastages_procurement_value_'+random_estimated_wastages_id).val(decimalValues(itemsdata.procurement_value));
            $('#estimated_wastages_estimated_driage_percentage_'+random_estimated_wastages_id).val(decimalValues(itemsdata.estimated_driage_percentage));
            $('#estimated_wastages_estimated_driage_value_'+random_estimated_wastages_id).val(decimalValues(itemsdata.estimated_driage_rs))

        } 
    }


    function pr_estimated_wastages_no_inc() {
        var count = $(".delete_estimated_wastages").length;
        $('.remove_estimated_wastages').show();
        if (count == 1) {
            $('.remove_estimated_wastages').hide();
        } else {
            $('.remove_estimated_wastages').first().hide();
        }
    }
    initDecimalNumeric();


});

function delete_estimated_wastages(random_estimated_wastages_id) {
    var count = $(".remove_estimated_wastages").length;
    if (count > 1) {
        $("#estimated_wastages_" + random_estimated_wastages_id).remove();
    }
}

function getProcurementQtyValue(item_id){
    var mfp_id = $("#mfp_estimated_wastages_"+item_id).val();
    if(mfp_id){
        var url = conf.getProcurementQtyValue.url(form_id,mfp_id);
        var method = conf.getProcurementQtyValue.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                //change rs in lakhs
                var procurement_value_inlakhs = response.data.value /100000;
                $("#estimated_wastages_procurement_quantity_"+item_id).val(decimalValues(response.data.qty));
                $("#estimated_wastages_procurement_value_"+item_id).val(decimalValues(procurement_value_inlakhs));
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
        return data;

    }
  
   
}

function getEstimatedWastagesValue(item_id){
    var driage_percentage = $("#estimated_wastages_estimated_driage_percentage_"+item_id).val();
    var procurement_value = $("#estimated_wastages_procurement_value_"+item_id).val();

    if(procurement_value){
        estimatedWastagesValue =procurement_value * driage_percentage/100;
        $("#estimated_wastages_estimated_driage_value_"+item_id).val(decimalValues(estimatedWastagesValue));
    }else{
        alert("Please select mfp and procurement value");
        $("#estimated_wastages_estimated_driage_percentage_"+item_id).val();
        return false;
    }



}