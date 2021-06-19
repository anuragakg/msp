

$(document).ready(function () {
    var random_warehouse_labour_charge_id = Date.now();
    $('#add_warehouse_labour_charges_button').click(function () {
        random_warehouse_labour_charge_id = Date.now();
        RenderWarehouseLabourCharges(random_warehouse_labour_charge_id);

    });

    if(actualOverheadData.getActualOverheadWarhouseLabourCharges && actualOverheadData.getActualOverheadWarhouseLabourCharges!=null && actualOverheadData.getActualOverheadWarhouseLabourCharges!=''){
        var warehouseLabourChargeData = actualOverheadData.getActualOverheadWarhouseLabourCharges;
        random_warehouse_labour_charge_id = 0;
        $.each(warehouseLabourChargeData, function(key, itemdata) {
            ++random_warehouse_labour_charge_id;
            RenderWarehouseLabourCharges(random_warehouse_labour_charge_id, itemdata);
        });
    } else {
        var warehouse_labour_charges_data = [] ;
        RenderWarehouseLabourCharges(random_warehouse_labour_charge_id, warehouse_labour_charges_data);

    }
    
    function RenderWarehouseLabourCharges(random_warehouse_labour_charge_id, itemsdata) {
        var source = $("#warehouse_labour_charges_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_warehouse_labour_charge_id: random_warehouse_labour_charge_id,
            itemdata: itemsdata,
        });
        $("#warehouse_labour_charges_container").append(rendered);
        fillMfp('#mfp_warehouse_labour_charges_'+random_warehouse_labour_charge_id);
        //fillFormMfp(formData.mfp_coverage,'#mfp_warehouse_labour_charges_'+random_warehouse_labour_charge_id);
        fillWarehouses(warehouses,'#labour_charges_warehouse_'+random_warehouse_labour_charge_id);
        pr_warehouse_labour_charges_no_inc();
        if (itemsdata != '' && itemsdata != null) {
            $('#mfp_warehouse_labour_charges_' + random_warehouse_labour_charge_id).val(itemsdata.mfp);
            $('#labour_charges_warehouse_' + random_warehouse_labour_charge_id).val(itemsdata.warehouse)
            $('#warehouse_labour_quantity' + random_warehouse_labour_charge_id).val(itemsdata.qty)
            $('#warehouse_labour_unit_rate' + random_warehouse_labour_charge_id).val(itemsdata.unit_rate)
            $('#warehouse_labour_total_estimated_cost' + random_warehouse_labour_charge_id).val(itemsdata.total_estimated_cost)

        } 

    }


    function pr_warehouse_labour_charges_no_inc() {
        var count = $(".delete_warehouse_labour_charges").length;
        $('.remove_warehouse_labour_charges').show();
        if (count == 1) {
            $('.remove_warehouse_labour_charges').hide();
        } else {
            $('.remove_warehouse_labour_charges').first().hide();
        }



    }
    initDecimalNumeric();


});

function delete_warehouse_labour_charges(random_warehouse_labour_charge_id) {
    var count = $(".remove_warehouse_labour_charges").length;
    if (count > 1) {
        $("#warehouse_labour_charges_" + random_warehouse_labour_charge_id).remove();
    }
}

/*** To calculate total estimated labour cost***/
function calculateTotalWarehouseLabourCost(random_warehouse_labour_charges_id) {
        maxWarehouseQty(random_warehouse_labour_charges_id);
    var unit_manday_rate = $("#warehouse_labour_quantity" + random_warehouse_labour_charges_id).val() ? parseFloat($("#warehouse_labour_quantity" + random_warehouse_labour_charges_id).val()) : '';
    var warehouse_labour_unit_rate = $("#warehouse_labour_unit_rate" + random_warehouse_labour_charges_id).val() ? parseFloat($("#warehouse_labour_unit_rate" + random_warehouse_labour_charges_id).val()) : '';
    if (unit_manday_rate != '' && warehouse_labour_unit_rate != '') {
        //calculate value
        total_estimated_labour_cost = unit_manday_rate * warehouse_labour_unit_rate;
      
        //populate in field
        $("#warehouse_labour_total_estimated_cost" + random_warehouse_labour_charges_id).val(total_estimated_labour_cost);
    } else {
        $("#warehouse_labour_total_estimated_cost" + random_warehouse_labour_charges_id).val('');
    }

}


function maxWarehouseQty(id) { 
    var mfp_ids = $("#mfp_warehouse_labour_charges_" + id + " option:selected").val();
    var mfp_name = $("#mfp_warehouse_labour_charges_" + id + " option:selected").text();
    var mfp_qty = $("#mfpdata_"+mfp_ids).val(); 
    var total_qty = 0; 
    $('.warehouseqty'+id).each(function () {
        total_qty += parseFloat($(this).val());
    });
    
    if (total_qty > mfp_qty) {
        alert(mfp_name + ' Qty Should not be greater than ' + mfp_qty);
        $("#warehouse_labour_quantity" + id).val(''); 
        return false;
    }
}



