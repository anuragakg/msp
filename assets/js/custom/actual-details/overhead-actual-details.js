var auth = TRIFED.getLocalStorageItem();
var district_id = auth.district_id;
var district_name = auth.district;
var mfpmaster_data = {};
var haatmaster_data = {};


var formData = {};
var warehouses = {};
var url_var = getUrlVars();
var form_id = url_var['id'];
var overheadData = [];
var CostOfPackagingMaterial = [];
var MultipurposeProcurementItem_data = [];
var CategoryList = [];
var mfp_result = {};

$(document).ready(function () {
    fetchFundAvailable();
    initDecimalNumeric();
    fetchPrimaryLevelAgencyList();
    fetchHaatList();
    fetchProcurementCenterList();
    fetchFormData(url_var['id']);
    fetchOverheadDetailsData(url_var['id']);
    fetchWarehouse();
    fetchPackingMaterial();
    fetchCategories();
    fetchCostOfPackagingMaterial(url_var['id']);
    fetchDiaReleaseDetailsToProcurementAgent(url_var['id']);
    
    if(actualOverheadData.getActualOverheadCollectionLevel.length != 0){
        random_collection_level_id = 0;
        $.each(actualOverheadData.getActualOverheadCollectionLevel, function (key, itemdata) {
            ++random_collection_level_id;
            RenderPackingMaterial(random_collection_level_id, itemdata);
        });
    }else{
        if (CostOfPackagingMaterial != null && CostOfPackagingMaterial != '') {
            packing_level_row = 0;
            $.each(CostOfPackagingMaterial, function (key, itemdata) {
                ++packing_level_row;
                random_packing_material_id = Date.now() + packing_level_row;
                RenderCostOfPackagingMaterial(random_packing_material_id, itemdata);
            });
        }   
    }
  

  
  

    $("#formID").submit(function (e) {
        // e.preventDefault();
    }).validate({
        rules: {

        },
        submitHandler: function (form) {
            var form = $('#formID')[0];
            var data = new FormData(form);
            var url = conf.addOverheadDetails.url;
            var method = conf.addOverheadDetails.method;
            if (form_id != undefined && form_id != '') {
                data.append('form_id', form_id);
                data.append('cons_id',url_var['cons_id']);
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    form_id = response.data.ref_id;
                    $('#preview').show();
                    TRIFED.showMessage('success', 'Successfully Added');
                    if (form.submitter == 'submit') {
                        setTimeout(function () { 
                            document.location = 'mfp_procurement_transaction_details_list.php' }, 500);
                    } else {
                        setTimeout(function () { window.location = '../fund-management/mfp_procurement_pa_received_fund.php'}, 500);
                    }

                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    });
});


 
fetchFundAvailable=()=>{
    var url = conf.getFundAvailable.url;
    var method = conf.getFundAvailable.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            //fillTypes(response.data);
            $('#fund_available').html(utils.formatCurrency(response.data));
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
function mfp_estimated_no_inc() {
    var estimated_mfp_no = 0;
    $(".estimated_mfp_no").each(function () {
        ++estimated_mfp_no;
        $(this).html(estimated_mfp_no);
    });
}

function RenderPackingMaterial(random_packing_material_id, itemsdata) {
    var source = $("#packing_material_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_packing_material_id: random_packing_material_id,
        itemdata: itemsdata,
    });
    $("#packing_material_container").append(rendered);
    fillFormMfp(formData.mfp_coverage, '#packing_material_mfp_id' + random_packing_material_id);
    $('#packing_material_mfp_id' + random_packing_material_id).val(itemsdata.mfp_id);
    fillHaatList(haatmaster_data, '#packing_material_haat_id' + random_packing_material_id);
    fillHaatList(haatmaster_data, '#packing_material_haat_id_hidden' + random_packing_material_id);

    $.each(itemsdata.haats, function (i, v) {
        $("#packing_material_haat_id" + random_packing_material_id + " option[value='" + v.haat_id + "']").prop("selected", true);
        $("#packing_material_haat_id_hidden" + random_packing_material_id + " option[value='" + v.haat_id + "']").prop("selected", true);
    });

    $('#packing_material_haat_id' + random_packing_material_id).select2();

    fillPackingMaterial(packig_material_types, '#packing_material_type' + random_packing_material_id);
    fillProcurementCenterList(MultipurposeProcurementItem_data,'#procurement_center'+random_packing_material_id);    
   
    if (itemsdata.packing_material_type != null) {
        $('#packing_material_type' + random_packing_material_id).val(itemsdata.packing_material_type).trigger('change');
    }
    
    if (itemsdata.size != null) {
        $('#packing_material_size' + random_packing_material_id).val(itemsdata.size);
    }
    if (itemsdata.procurement_center != null) {
        $('#procurement_center' + random_packing_material_id).val(itemsdata.procurement_center);
    }
}

function RenderCostOfPackagingMaterial(random_packing_material_id, itemsdata) {
    
    var source = $("#packing_material_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_packing_material_id: random_packing_material_id,
        itemdata: itemsdata,
    });
    $("#packing_material_container").append(rendered);
    fillFormMfp(formData.mfp_coverage, '#packing_material_mfp_id' + random_packing_material_id);
    $('#packing_material_mfp_id' + random_packing_material_id).val(itemsdata.mfp_id);
    fillHaatList(haatmaster_data, '#packing_material_haat_id' + random_packing_material_id);
    fillHaatList(haatmaster_data, '#packing_material_haat_id_hidden' + random_packing_material_id);

    $.each(itemsdata.haat, function (i, v) {
        $("#packing_material_haat_id" + random_packing_material_id + " option[value='" + v + "']").prop("selected", true);
        $("#packing_material_haat_id_hidden" + random_packing_material_id + " option[value='" + v + "']").prop("selected", true);
    });

    $('#packing_material_haat_id' + random_packing_material_id).select2();

    fillPackingMaterial(packig_material_types, '#packing_material_type' + random_packing_material_id);
    fillProcurementCenterList(MultipurposeProcurementItem_data,'#procurement_center'+random_packing_material_id);    
   
    // if (itemsdata.packing_material_type != null) {
    //     $('#packing_material_type' + random_packing_material_id).val(itemsdata.packing_material_type).trigger('change');
    // }
    
    // if (itemsdata.size != null) {
    //     $('#packing_material_size' + random_packing_material_id).val(itemsdata.size);
    // }
    // if (itemsdata.procurement_center != null) {
    //     $('#procurement_center' + random_packing_material_id).val(itemsdata.procurement_center);
    // }
}
function maxServiceQty(id) { 
    var mfp_ids = $("#mfp_service_charges_" + id + " option:selected").val();
    var mfp_name = $("#mfp_service_charges_" + id + " option:selected").text();
    var mfp_qty = $("#mfpdata_"+mfp_ids).val(); 
    var total_qty = 0; 
    $('.serviceQty'+id).each(function () {
        total_qty += parseFloat($(this).val());
    }); 
    if (total_qty > mfp_qty) {
        alert(mfp_name + ' Qty Should not be greater than ' + mfp_qty);
        $("#service_charges_qty_of_mfp_" + id).val(''); 
        return false;
    }
}

function fillFormMfp(formdata, item_id) {
    html = '<option value="">Select MFP</option>';
    $.each(formdata, function (i, mfp) {
        if (mfp.mfp_id != null) {
            html += '<option value="' + mfp.mfp_id + '">' + mfp.getMfpData.title + '</option>';
        }
    });
    $(item_id).html(html);
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

/*** Common js for form*/

fetchFormData = (form_id) => {
    var url = conf.getProcurementDetail.url(form_id);
    var method = conf.getProcurementDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            formData = response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
fetchDiaReleaseDetailsToProcurementAgent = (id) => {
    var url = conf.getDiaRealeasedDetailsToProcurementAgent.url(id);
    var method = conf.getDiaRealeasedDetailsToProcurementAgent.method;
    var data = {};
    TRIFED.asyncAjaxHit(url,method, data, function (response, cb) {
        if (response) {
            mfp_result = response.data;
           // console.log(mfp_result);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
function fillMfp(element_id){
    var mfps=[];
    mfp_options = '<option value="">Select MFP</option>';
    $.each(mfp_result, function( index, row ) {
        $.each(row.commodity_details, function( index, row ) {
            if(jQuery.inArray(row.mfp_id,mfps) != -1){

            }else{
                mfp_options += '<option value="' + row.mfp_id + '">' + row.get_mfp_name.get_mfp_name.title + '</option>';
            }
            
            mfps.push(row.mfp_id);
        });

    });
 
    $(element_id).html(mfp_options);
}



fetchOverheadDetailsData = (form_id) => {
    var url = conf.getActualOverheadDetail.url(form_id);
    var method = conf.getActualOverheadDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            actualOverheadData = response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;

}

fetchWarehouse = () => {
    var url = conf.getWarehouse.url;
    var method = conf.getWarehouse.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            warehouses = response.data;

        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
fillWarehouses = (warehouses, item_id = 0) => {
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouses, function (i, warehouse) {
        html += '<option value="' + warehouse.id + '">' + warehouse.warehouse_name + '</option>';
    });
    $(item_id).html(html);
}
fetchMfpMaster = (random_mfp_coverage_id) => {
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;
        }
    });
}

fillMfpMaster = (mfps, item_id = 0) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
    });
    $(item_id).html(html);
}

fetchPackingMaterial = () => {
    var url = conf.getPackingMaterial.url;
    var method = conf.getPackingMaterial.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            packig_material_types = response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}

fillPackingMaterial = (packing_materials, element_id) => {
    let html = '<option value="">Select </option>';
    $.each(packing_materials, function (i, packing_material) {
        html += '<option value="' + packing_material.id + '" data-bag_name="' + packing_material.bag_name + '" data-specifications="' + packing_material.specifications + '" >' + packing_material.bag_type + '</option>';
    });
    $(element_id).html(html);
}
fetchCategories = () => {
    var url = conf.getCategoryList.url;
    var method = conf.getCategoryList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            CategoryList = response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
fillCategories = (CategoryList, element_id) => {
    let html = '<option value="">Select Category</option>';
    $.each(CategoryList, function (i, category) {
        html += '<option value="' + category.id + '" >' + category.title + '</option>';
    });
    $(element_id).html(html);
}
$(document).on('change', '.packig_material_types', function () {
    let row_id = $(this).attr('row-id');
    var selected = $(this).find('option:selected');
    var bag_name = selected.data('bag_name');
    var specifications = selected.data('specifications');
    $('#packing_material_bag_name' + row_id).val(bag_name);
    $('#packing_material_specifications' + row_id).val(specifications);
});

fetchCostOfPackagingMaterial = (id) => {
    var url = conf.getOverheadCostOfPackagingMaterial.url(id);
    var method = conf.getOverheadCostOfPackagingMaterial.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            CostOfPackagingMaterial = response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });

}

/*** To calculate total estimated labour cost***/
function calculateTotalPackingCost(random_id) {

    var total_packing_bags = $("#total_packing_bags_" + random_id).val() ? parseFloat($("#total_packing_bags_" + random_id).val()) : '';
    var unit_cost = $("#unit_cost_" + random_id).val() ? parseFloat($("#unit_cost_" + random_id).val()) : '';

    if (unit_cost != '' && total_packing_bags != '') {
        //calculate value
        total_packing_cost = unit_cost * total_packing_bags;
        //populate in field
        $("#total_cost_of_packaging_material_" + random_id).val(total_packing_cost);
    } else {
        $("#total_cost_of_packaging_material_" + random_id).val('0');
    }



}
fetchHaatList = () => {
    var url = conf.getHaatMasterList.url;
    var method = conf.getHaatMasterList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            haatmaster_data = response.data;
        }
    });
}

fillHaatList = (Haats, item_id) => {
    html = '<option value="">Select Haat</option>';
    $.each(Haats, function (i, Haat) {
        html += '<option value="' + Haat.id + '">' + Haat.haat_bazaar_name + '</option>';
    });
    $(item_id).html(html);
}
fetchProcurementCenterList = () => {
    var url = conf.getProcurementCenter.url;
    var method = conf.getProcurementCenter.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            MultipurposeProcurementItem_data = response.data;
        }
    });
}

fillProcurementCenterList = (Procurements, item_id) => {
    let html = '<option value="">Select Procurement Center</option>';
    $.each(Procurements, function (i, Procurement) {
        html += '<option value="' + Procurement.id + '">' + Procurement.name + '</option>';
    });
    $(item_id).html(html);
}

fetchPrimaryLevelAgencyList = () => {
    var url = conf.getPrimaryLevelAgency.url;
    var method = conf.getPrimaryLevelAgency.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            primaryLevelAgency = response.data;
        }
    });
}


fillPrimaryLevelAgency = (primaryLevelAgency, item_id) => {
    let html = '<option value="">Select</option>';
    $.each(primaryLevelAgency, function (i, agency) {
        html += '<option value="' + agency.id + '">' + agency.name + '</option>';
    });
    $(item_id).html(html);
}



function readonly_select2(objs, action) {
    objs.prepend('<div class="disabled-select"></div>');
}


function initDecimalNumeric() {
    $(".decimalNumeric").keyup(decimalNumericKeyUp);
}

function decimalNumericKeyUp(e) {

    $(this).val(
        $(this)
            .val()
            .replace(/[^0-9\.]/g, "")
    );
    var x = $(this).val();
    var t = x;
    y =
        t.indexOf(".") >= 0
            ? t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)
            : t;
    $(this).val(y);
}

