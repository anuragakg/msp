var url_var = getUrlVars();
$(function () {
    result_data = '';


    if (url_var['id'] != undefined) {
        form_id = url_var['id'];
        form_data = fetchFormData(form_id);
        labourChargesData = form_data.getActualOverheadLabourCharges;
        MfpCollectionLevel = form_data.getActualOverheadCollectionLevel;
        MfpWeightmentCharges = form_data.getActualOverheadWeightmentCharges;
        transportationChargesData = form_data.getActualOverheadTransportationCharges;
        serviceChargesData = form_data.getActualOverheadServiceCharges;
        serviceChargesDiaData = form_data.getActualOverheadServiceChargesDIA;
        otherCostData = form_data.getActualOverheadOtherCosts,
        $('#year_id').html(form_data.financialYear)
        random_collection_level_id = 0;
        random_weightment_charges_id = 0;
        random_labour_charges_id = 0;
        random_transportation_charges_id = 0;
        random_service_charges_id = 0;
        random_service_charges_dia_id = 0;
        random_other_cost_id = 0;

        $.each(labourChargesData, function (key, itemdata) {
            ++random_labour_charges_id;
            RenderLabourCharges(random_labour_charges_id, itemdata);
        });
        $.each(MfpCollectionLevel, function (key, itemdata) {
            ++random_collection_level_id;
            RenderPackingMaterial(random_collection_level_id, itemdata);
        });
        $.each(form_data.getActualOverheadWeightmentCharges, function (key, itemdata) {
            ++random_weightment_charges_id;
            RenderWeightmentCharges(random_weightment_charges_id, itemdata);
        });
        $.each(form_data.getActualOverheadTransportationCharges, function (key, itemdata) {
            ++random_transportation_charges_id;
            RenderTransportationCharges(random_transportation_charges_id, itemdata);
        });
        $.each(form_data.getActualOverheadServiceCharges, function (key, itemdata) {
            ++random_service_charges_id;
            RenderServiceCharges(random_service_charges_id, itemdata);
        });
        //warehouse level
        $.each(form_data.getActualOverheadWarhouseLabourCharges, function (key, itemdata) {
            ++random_service_charges_dia_id;
            RenderWarehouseLabourCharges(random_service_charges_dia_id, itemdata);
        });
        $.each(form_data.getActualOverheadWarhouseCharges, function (key, itemdata) {
            ++random_service_charges_dia_id;
            RenderWarehouseCharges(random_service_charges_dia_id, itemdata);
        });
        $.each(form_data.getActualOverheadEstimatedWastages, function (key, itemdata) {
            ++random_service_charges_dia_id;
            RenderEstimatedWastage(random_service_charges_dia_id, itemdata);
        });
        $.each(serviceChargesDiaData, function (key, itemdata) {
            ++random_service_charges_dia_id;
            RenderServiceChargesDia(random_service_charges_dia_id, itemdata);
        });
        $.each(otherCostData, function (key, itemdata) {
            ++random_other_cost_id;
            RenderOtherCosts(random_other_cost_id, itemdata);
        });


        //auto fill cost of packaging material
        // if (CostOfPackagingMaterial != null && CostOfPackagingMaterial != '') {
        //     $.each(CostOfPackagingMaterial, function (key, itemdata) {
        //         $(".cost-of-packing-material td[mfp_id=" + itemdata.mfp_id + "]").html(itemdata.total_cost_of_packaging_material);
        //     });
        // }

        //auto fill weighment charges
        if (form_data.getMfpWeightmentCharges && form_data.getMfpWeightmentCharges != null && form_data.getMfpWeightmentCharges != '') {

            $.each(form_data.getMfpWeightmentCharges, function (key, itemdata) {
                $(".weighment-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);

            });
        }

       
        //auto fill labour charge cost by mfp id
        if (form_data.getMfpLabourCharges && form_data.getMfpLabourCharges != null && form_data.getMfpLabourCharges != '') {
            $.each(form_data.getMfpLabourCharges, function (key, itemdata) {
                $(".labour-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);
            });
        }
        //auto fill tranportation charge cost by mfp id
        if (form_data.getMfpTransportationCharges && form_data.getMfpTransportationCharges != null && form_data.getMfpTransportationCharges != '') {
            $.each(form_data.getMfpTransportationCharges, function (key, itemdata) {
                $(".transportation-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.estimated_total_cost_of_transportation);
            });
        }
        //auto fill service charge cost by mfp id
        if (form_data.getMfpServiceCharges && form_data.getMfpServiceCharges != null && form_data.getMfpServiceCharges != '') {
            $.each(form_data.getMfpServiceCharges, function (key, itemdata) {
                $(".service-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.service_charge_in_total_value_of_procurement);
            });
        }
        //auto fill warehouse labour charge cost by mfp id
        if (form_data.getMfpWarhouseLabourCharges && form_data.getMfpWarhouseLabourCharges != null && form_data.getMfpWarhouseLabourCharges != '') {
            $.each(form_data.getMfpWarhouseLabourCharges, function (key, itemdata) {
                $(".warehouse-labour-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);
            });
        }
        //auto fill warehouse charge cost by mfp id
        if (form_data.getMfpWarhouseCharges && form_data.getMfpWarhouseCharges != null && form_data.getMfpWarhouseCharges != '') {
            $.each(form_data.getMfpWarhouseCharges, function (key, itemdata) {
                $(".warehouse-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);
            });
        }
        //auto fill estimated wastages cost by mfp id
        if (form_data.getMfpEstimatedWastages && form_data.getMfpEstimatedWastages != null && form_data.getMfpEstimatedWastages != '') {
            $.each(form_data.getMfpEstimatedWastages, function (key, itemdata) {
                $(".estimated-wastages td[mfp_id=" + itemdata.mfp + "]").html(itemdata.estimated_driage_rs);
            });
        }

        //auto fill service charge by mfp id
        if (form_data.getMfpServiceChargesDIA && form_data.getMfpServiceChargesDIA != null && form_data.getMfpServiceChargesDIA != '') {
            $.each(form_data.getMfpServiceChargesDIA, function (key, itemdata) {
                $(".service-charges-dia td[mfp_id=" + itemdata.mfp_id + "]").html(itemdata.service_charge_value);
            });
        }

        //auto fill other cost by mfp id
        if (form_data.getMfpOtherCosts && form_data.getMfpOtherCosts != null && form_data.getMfpOtherCosts != '') {
            $.each(form_data.getMfpOtherCosts, function (key, itemdata) {
                $(".other-costs td[mfp_id=" + itemdata.mfp_id + "]").html(itemdata.other_cost);
            });
        }

    }
});



fetchFormData = (form_id) => {
    var url = conf.getActualOverheadDetail.url(form_id);
    var method = conf.getActualOverheadDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            data = response.data;
            //console.log(actualOverheadData);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;

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


function GetMonthName(monthNumber) {
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return months[monthNumber - 1];
}

function RenderLabourCharges(random_labour_charges_id, itemdata) {

    var source = $("#labour_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_labour_charges_id: random_labour_charges_id,
        itemdata: itemdata
    });
    $("#labour_charges_container").append(rendered_data);
    var labour_charges_no = 0;
    $(".other_labour_charges_no").each(function () {
        ++labour_charges_no;
        $(this).html(labour_charges_no);
    });
}
function RenderPackingMaterial(random_collection_level_id, itemdata) {
    var source = $("#packing_material_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_packing_material_id: random_collection_level_id,
        itemdata: itemdata
    });
    $("#packing_material_container").append(rendered_data);
    if (itemdata.haats != '' && itemdata.haats != null) {
        $("#packing_material_haat_id" + random_collection_level_id).html(itemdata.haats.map(v => v.HaatName).join(","));
    }
    //$('#packing_material_category'+random_collection_level_id).val(itemdata.category)
    $('#packing_material_size' + random_collection_level_id).val(itemdata.size)
}
function RenderWeightmentCharges(random_weightment_charges_id, itemdata) {
    var source = $("#weightment_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_weightment_charge_id: random_weightment_charges_id,
        itemdata: itemdata
    });

    $("#weightment_charges_container").append(rendered_data);
    var weightment_charges_no = 0;
    $(".weightment_charges_no").each(function () {
        ++weightment_charges_no;
        $(this).html(weightment_charges_no);
    });
}
function RenderTransportationCharges(random_transportation_charges_id, itemdata) {

    var source = $("#transportation_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_transportation_charges_id: random_transportation_charges_id,
        itemdata: itemdata
    });
    $("#transportation_charges_container").append(rendered_data);
    var transportation_charges_no = 0;
    $(".other_transportation_charges_no").each(function () {
        ++transportation_charges_no;
        $(this).html(transportation_charges_no);
    });
}

function RenderServiceCharges(random_service_charges_id, itemdata) {
    var source = $("#service_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_service_charges_id: random_service_charges_id,
        itemdata: itemdata
    });
    $("#service_charges_container").append(rendered_data);
    var service_charges_no = 0;
    $(".other_service_charges_no").each(function () {
        ++service_charges_no;
        $(this).html(service_charges_no);
    });
}
//warehouse level 

function RenderWarehouseLabourCharges(random_id, itemdata) {

    var source = $("#warehouse_labour_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_id: random_id,
        itemdata: itemdata
    });
    $("#warehouse_labour_charges_container").append(rendered_data);
    var warehouse_labour_charges_no = 0;
    $(".warehouse_labour_charges_no").each(function () {
        ++warehouse_labour_charges_no;
        $(this).html(warehouse_labour_charges_no);
    });
}

function RenderWarehouseCharges(random_id, itemdata) {

    var source = $("#warehouse_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_id: random_id,
        itemdata: itemdata
    });
    $("#warehouse_charges_container").append(rendered_data);
    var warehouse_charges_no = 0;
    $(".warehouse_charges_no").each(function () {
        ++warehouse_charges_no;
        $(this).html(warehouse_charges_no);
    });
}
function RenderEstimatedWastage(random_id, itemdata) {

    var source = $("#estimated_wastages_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_id: random_id,
        itemdata: itemdata
    });
    $("#estimated_wastages_container").append(rendered_data);
    var estimated_wastages_template_no = 0;
    $(".estimated_wastages_no").each(function () {
        ++estimated_wastages_template_no;
        $(this).html(estimated_wastages_template_no);
    });
}

function RenderServiceChargesDia(random_service_charges_dia_id, itemdata) {

    var source = $("#service_charges_at_dia_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_service_charges_dia_id: random_service_charges_dia_id,
        itemdata: itemdata
    });
    $("#service_charges_at_dia_container").append(rendered_data);
    var service_charges_dia_no = 0;
    $(".service_charges_dia_no").each(function () {
        ++service_charges_dia_no;
        $(this).html(service_charges_dia_no);
    });
}

function RenderOtherCosts(random_other_cost_id, itemdata) {

    var source = $("#other_costs_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
        random_other_cost_id: random_other_cost_id,
        itemdata: itemdata
    });
    $("#other_costs_container").append(rendered_data);
    var other_cost_no = 0;
    $(".other_cost_no").each(function () {
        ++other_cost_no;
        $(this).html(other_cost_no);
    });
}

fetchCostOfPackagingMaterial = (id) => {
    var url = conf.getCostOfPackagingMaterial.url(id);
    var method = conf.getCostOfPackagingMaterial.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            CostOfPackagingMaterial = response.data;

        } else {
            TRIFED.showMessage('error', cb);
        }
    });

}



