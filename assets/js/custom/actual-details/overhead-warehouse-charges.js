
// $(function(){
//     $('.date').datepicker({
    
//         todayBtn: "linked",
//         format: 'dd/mm/yyyy',
//         endDate: new Date()
//     });
// });

var labels_no = 0;

$(document).ready(function () {

    

    var random_warehouse_charge_id = Date.now();
    $('#add_warehouse_charges_button').click(function () {
        random_warehouse_charge_id = Date.now();
        RenderWarehouseCharges(random_warehouse_charge_id);

    });

    if(actualOverheadData.getActualOverheadWarhouseCharges && actualOverheadData.getActualOverheadWarhouseCharges!=null && actualOverheadData.getActualOverheadWarhouseCharges!=''){
        var warehouseChargeData = actualOverheadData.getActualOverheadWarhouseCharges;
        random_warehouse_charge_id = 0;
        $.each(warehouseChargeData, function(key, itemdata) {
            ++random_warehouse_charge_id;
            RenderWarehouseCharges(random_warehouse_charge_id, itemdata);
        });
    } else {
        var warehouse_charges_data = [] ;
        RenderWarehouseCharges(random_warehouse_charge_id, warehouse_charges_data);

    }

  
    function RenderWarehouseCharges(random_warehouse_charge_id, itemsdata) {
        var source = $("#warehouse_charges_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_warehouse_charge_id: random_warehouse_charge_id,
            itemdata: itemsdata,
        });
        $("#warehouse_charges_container").append(rendered);
        fillMfp("#warehouse_charges_mfp_"+random_warehouse_charge_id);
        //fillFormMfp(formData.mfp_coverage,'#warehouse_charges_mfp_'+random_warehouse_charge_id);
        fillWarehouses(warehouses,'#warehouse_charges_warehouse_'+random_warehouse_charge_id);
        pr_warehouse_charges_no_inc();
        $('#warehouse_charges_from_date_'+random_warehouse_charge_id).datepicker({
            todayBtn: "linked",
            format: 'dd/mm/yyyy',
            endDate: new Date()
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#warehouse_charges_to_date_'+random_warehouse_charge_id).datepicker('setStartDate', minDate);
        });
    
       
        //to populate data
        if (itemsdata != '' && itemsdata != null) {
            $('#warehouse_charges_mfp_' + random_warehouse_charge_id).val(itemsdata.mfp);
            $('#warehouse_charges_warehouse_' + random_warehouse_charge_id).val(itemsdata.warehouse);
            $('#warehouse_charges_unit_' + random_warehouse_charge_id).val(itemsdata.unit);
            $('#warehouse_charges_unit_storage_rate_' + random_warehouse_charge_id).val(itemsdata.unit_storage_rate_per_month);
            $('#warehouse_charges_estimated_quantity_'+random_warehouse_charge_id).val(itemsdata.estimated_quantity);
            $('#warehouse_charges_total_estimated_cost_' + random_warehouse_charge_id).val(itemsdata.total_estimated_cost);
            $('#warehouse_charges_estimated_duration_of_storage_'+random_warehouse_charge_id).val(itemsdata.estimation_duration_of_storage);
            $('#warehouse_charges_from_date_'+random_warehouse_charge_id).val(itemsdata.from_date);
            $('#warehouse_charges_to_date_'+random_warehouse_charge_id).val(itemsdata.to_date);

        } 
      
    }
    
    $('#warehouse_charges_to_date_'+random_warehouse_charge_id).datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });

    

    function pr_warehouse_charges_no_inc() {
        var count = $(".delete_warehouse_charges").length;
        $('.remove_warehouse_charges').show();
        if (count == 1) {
            $('.remove_warehouse_charges').hide();
        } else {
            $('.remove_warehouse_charges').first().hide();
        }
    }
    initDecimalNumeric();

    

});

function delete_warehouse_charges(random_warehouse_charge_id) {
    var count = $(".remove_warehouse_charges").length;
    if (count > 1) {
        $("#warehouse_charges_" + random_warehouse_charge_id).remove();
        // pr_no_inc();
    }
}

/*** To calculate total estimated labour cost***/
function calculateTotalWarehouseCost(random_warehouse_charge_id) {
maxWarehouseCharQty(random_warehouse_charge_id);
    var unit_manday_rate = $("#warehouse_charges_unit_storage_rate_" + random_warehouse_charge_id).val() ? parseFloat($("#warehouse_charges_unit_storage_rate_" + random_warehouse_charge_id).val()) : '';
    var mandays = $("#warehouse_charges_estimated_quantity_" + random_warehouse_charge_id).val() ? parseFloat($("#warehouse_charges_estimated_quantity_" + random_warehouse_charge_id).val()) : '';
    if (unit_manday_rate != '' && mandays != '') {
        //calculate value
        total_estimated_warehouse_cost = unit_manday_rate * mandays;
        //populate in field
        $("#warehouse_charges_total_estimated_cost_" + random_warehouse_charge_id).val(total_estimated_warehouse_cost);
    } else {
        $("#warehouse_charges_total_estimated_cost_" + random_warehouse_charge_id).val('');
    }



}

function maxWarehouseCharQty(id) { 
    var mfp_ids = $("#warehouse_charges_mfp_" + id + " option:selected").val();
    var mfp_name = $("#warehouse_charges_mfp_" + id + " option:selected").text();
    var mfp_qty = $("#mfpdata_"+mfp_ids).val(); 
    var total_qty = 0;
    console.log(mfp_ids);
    console.log(mfp_name);
    console.log(mfp_qty);
    $('.warehouseChrqty'+id).each(function () {
        total_qty += parseFloat($(this).val());
    });
    
    console.log(total_qty);
    if (total_qty > mfp_qty) {
        alert(mfp_name + ' Qty Should not be greater than ' + mfp_qty);
        $("#warehouse_charges_estimated_quantity_" + id).val(''); 
        return false;
    }
}





