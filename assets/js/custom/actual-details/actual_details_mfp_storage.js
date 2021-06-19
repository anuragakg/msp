var auth = TRIFED.getLocalStorageItem();
var state_id = auth.state_id;
var url_var = getUrlVars();
var haatmaster_data = {};
var warehousemaster_data = {};
var mfp_result = {};
var formData = '';
var mfp_qty = [];
var mfp_master_value = [];
$(document).ready(function () {
    fetchFundAvailable();
    fetchFinancialYear();
    fetchDiaReleaseDetails(url_var['id']);
    //fetchSeasonalityDetails(url_var['id']);
     getTribalDetail(url_var['trible_id']);
    fetchWarehouseMaster();
    fetchHaatList();
    var disposaldata = [];
    Random_id = Date.now();
    var random_mfp_storage_plan_id = Random_id;
    RenderDisposalPlan(random_mfp_storage_plan_id, disposaldata);

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
fetchFinancialYear = () => {
    var url = conf.getFinancialYearList.url;
    var method = conf.getFinancialYearList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            fillFinancialYear(response.data);
        }
    });
}
fillFinancialYear = (years) => {
    html = '<option value="">Select Financial Year</option>';
    $.each(years, function (i, year) {
        html += '<option value="' + year.id + '">' + year.title + '</option>';
    });
    $('#year_id').html(html);
}
$("#formID").submit(function (e) {
    e.preventDefault();
}).validate({
    rules: {


    },
    submitHandler: function (form) {
        var form = $('#formID')[0];
        var data = new FormData(form);
        var url = conf.addMfpStorageDetails.url;
        var method = conf.addMfpStorageDetails.method;
        if (url_var['id'] != undefined && url_var['id'] != '') {
            data.append('id', url_var['id']);
            data.append('consolidated_id', url_var['cons_id']);
        }

        TRIFED.fileAjaxHit(url, method, data, function (response) {
            if (response.status == 1) {
                TRIFED.showMessage('success', 'Successfully Added');
                setTimeout(function () {
                    document.location = "overhead-details.php?id=" + url_var['id'] + "&&cons_id=" + url_var['cons_id'];
                }, 500);
            } else {
                TRIFED.showError('error', response.message);
            }
        });
        //submit via ajax
        return false;  //This doesn't prevent the form from submitting.
    }
});

fetchDiaReleaseDetails = (id) => {
    var url = conf.getProcurementReceivedFund.url(id);
    var method = conf.getProcurementReceivedFund.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillFields(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillFields = (data) => {
    $('#proposal_id').html(data.proposal_id);
    $('#year_id').val(data.year_id).trigger('change');
}

/*
fetchSeasonalityDetails = (id) => {
    var url = conf.getMfpDetails.url(id);
    var method = conf.getMfpDetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            //console.log(response.data.mfp_seasonality_procurement);
            fillMfpDetails(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}*/


getTribalDetail=(id)=>{
   var url = conf.getMfpProcurementActualDetailView.url(id);
    var method = conf.getMfpProcurementActualDetailView.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
       
            fillMfpDetails(response.data);
        } else {
       
            TRIFED.showMessage('error', cb);
        }
    });
    
}

fillMfpDetails = (data) => {
    mfp_result = data.commodity;
    html = ''; var i = 0; 
    mfp_result.forEach(function (row) {
        mfp_qty[row.mfp_id] = row.qty;
        mfp_master_value[row.mfp_id] = row.value;
        ++i;
        html += '<tr>';
        html += '<td>' + i + '</td>';
        html += '<td>' + row.mfp_name + '</td>';
        html += '<td style="text-align:right"><div id=mfp_' + row.mfp_id + '>' + row.qty + '</div></td>';
        html += '<td style="text-align:right">' + utils.formatAmount(row.value) + '</td>';
        html += '</tr>';
    });
    $('#mfp_list').html(html);

}

function fillMfp(element_id) {
    mfp_options = '<option value="">Select MFP</option>';
    var unique_mfp = {};
    mfp_result.forEach(function (row) {
        var name = row.mfp_name;
        mfp_options += '<option value="' + row.mfp_id + '" data-name="' + name.split(' ').join('_') + '">' + row.mfp_name + '</option>';
    });
    $(element_id).html(mfp_options);
}


fetchWarehouseMaster = () => {
    var url = conf.getWarehouse.url;
    var method = conf.getWarehouse.method;
    var data = {};
    data['state_id'] = state_id;
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            warehousemaster_data = response.data;
        }
    });
}
fillWarehouseMaster = (warehouseMaster, item_id, id) => {
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouseMaster, function (i, warehouse) {
        html += '<option value="' + warehouse.id + '" warehouse="' + warehouse.warehouse_name.split(' ').join('_') + id + '">' + warehouse.warehouse_name + '</option>';
    });
    $(item_id).html(html);

}

$(document).on('change', '.mfp_name', function () {
    var mfp_id = $(this).val();
    var data_id = $(this).attr('data-id');
    var data_name = $('option:selected', this).attr('data-name');
    qty = mfp_qty[mfp_id];
    value = mfp_master_value[mfp_id];
    $('#mfp_storage_qty' + data_id).addClass(data_name);

    //$('#mfp_storage_qty'+data_id).val(qty); 

});

$(document).on('change', '.mini_ware', function () {
    var mfp_id = $(this).val();
    var data_id = $(this).attr('data-id');
    var data_name = $('option:selected', this).attr('warehouse');
    $('#storage_qty_' + data_id).addClass(data_name);
});

fetchHaatList = () => {
    var url = conf.getHaatMasterList.url;
    var method = conf.getHaatMasterList.method;
    var data = {};
    data['state'] = state_id;
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

$('#add_mfp_storage_plan').click(function () {
    random_mfp_storage_plan_id = Date.now();
    RenderDisposalPlan(random_mfp_storage_plan_id);
    mfp_storage_plan_no_inc();
});

function calculateStorewiseQty(random_mfp_storage_plan_id, random_mfp_storage_warehouse_id) {    
    var mfp_qty = $("#mfp_storage_qty" + random_mfp_storage_plan_id).val();
    maxQty(random_mfp_storage_warehouse_id, random_mfp_storage_plan_id, mfp_qty);
    var warehouse_qty = $("#storage_qty_" + random_mfp_storage_warehouse_id).val();
    var mfp_id = $("#mfp_storage_" + random_mfp_storage_plan_id).val();
    var mfp_total_qty = $("#mfp_" + mfp_id).html();
    var mfp_value = mfp_master_value[mfp_id]; 
    //alert(mfp_value + ' '+mfp_total_qty+' '+warehouse_qty);
     value = (mfp_value/mfp_total_qty)*warehouse_qty; 
    $('#disposal_value' + random_mfp_storage_warehouse_id).val(value.toFixed(4));

}
function maxQty(pid, id, val) { 
    var ware_name = $("#warehouse_dispossal_" + pid + " option:selected").text();
    var class_name = $("#warehouse_dispossal_" + pid + " option:selected").attr('warehouse');
    var total_qty = 0; 
    $('.haat_quantity_'+id).each(function () {
        total_qty += parseFloat($(this).val());
    });
    console.log(total_qty);
    if (total_qty > val) {
        alert(ware_name + ' Qty Should not be greater than ' + val);
        $("#storage_qty_" + pid).val('');
        $("#disposal_value" + pid).val('');
        return false;
    }
}
function add_mfp_storage_plan_warehouse(random_mfp_storage_plan_id) {
    itemdata = [];
    RenderDisposalWarehouse(random_mfp_storage_plan_id, itemdata);
}


function RenderDisposalPlan(random_mfp_storage_plan_id, itemsdata) {

    var source = $("#mfp_storage_plan_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_storage_plan_id: random_mfp_storage_plan_id,
        itemdata: itemsdata,
    });
    $("#mfp_storage_plan_container").append(rendered);
    fillMfp('#mfp_storage_' + random_mfp_storage_plan_id);
    mfp_storage_plan_no_inc();



    if (itemsdata != '' && itemsdata != null) {
        $('#mfp_storage_' + random_mfp_storage_plan_id).val(itemsdata.mfp_id);
        disposalPlanWarehouseData = itemsdata.getWarehouseData;
        $.each(disposalPlanWarehouseData, function (key, itemdata) {
            RenderDisposalWarehouse(random_mfp_storage_plan_id, itemdata)
        });
    } else {
        disposalWarehouseData = [];
        RenderDisposalWarehouse(random_mfp_storage_plan_id, disposalWarehouseData)
    }
}


function RenderDisposalWarehouse(random_mfp_storage_plan_id, itemsdata) {
    // var labels_no = $(".delete_disposal_plan").length;
    // ++labels_no;
    var source = $("#mfp_storage_plan_warehouse_template").html();
    Mustache.parse(source);
    var random_mfp_storage_plan_warehouse_id = Date.now();
    var rendered = Mustache.render(source, {
        random_mfp_storage_plan_id: random_mfp_storage_plan_id,
        random_mfp_storage_plan_warehouse_id: random_mfp_storage_plan_warehouse_id,
        itemdata: itemsdata,
    });
    $("#mfp_storage_plan_warehouse_info_" + random_mfp_storage_plan_id).append(rendered);
    fillWarehouseMaster(warehousemaster_data, '#warehouse_dispossal_' + random_mfp_storage_plan_warehouse_id, random_mfp_storage_plan_id);
    fillHaatList(haatmaster_data, '#haat_' + random_mfp_storage_plan_warehouse_id);
    if (itemsdata != '' && itemsdata != null) {
        $('#disposal_value' + random_mfp_storage_plan_warehouse_id).val(itemsdata.value).trigger('change');
        $('#disposal_qty' + random_mfp_storage_plan_warehouse_id).val(itemsdata.qty).trigger('change');
        $.each(itemsdata.months, function (i, v) {
            $("#quarter" + random_mfp_storage_plan_warehouse_id + " option[value='" + v.month + "']").prop("selected", true);
        });
    }
    $('#warehouse_dispossal_' + random_mfp_storage_plan_id + '_' + random_mfp_storage_plan_warehouse_id).val(itemsdata.warehouse_id)
    $('#quarter' + random_mfp_storage_plan_warehouse_id).select2();
    mfp_storage_plan_warehouse_no_inc(random_mfp_storage_plan_id);
    $('#haat_'+random_mfp_storage_plan_warehouse_id).select2();
}

function delete_disposal_plan(random_mfp_storage_plan_id) {
    var count = $(".main-div").length;
    if (count > 1) {
        $("#delete_disposal_plan" + random_mfp_storage_plan_id).remove();
        mfp_storage_plan_no_inc();
    }
}

function delete_disposal_plan_warehouse(random_mfp_storage_plan_id, random_mfp_storage_plan_warehouse_id) {

    var count = $(".remove_disposal_plan_warehouse_" + random_mfp_storage_plan_id).length;
    // alert(count);
    if (count > 1) {
        $("#disposal_plan_warehouse_info" + random_mfp_storage_plan_warehouse_id).remove();
        mfp_storage_plan_warehouse_no_inc(random_mfp_storage_plan_id);
        //change total value on delete
        if (random_mfp_storage_plan_warehouse_id in data) {

            warehouse_wise_total_qty[random_mfp_storage_plan_id] = warehouse_wise_total_qty[random_mfp_storage_plan_id] - data[random_mfp_storage_plan_warehouse_id];

            delete data[random_mfp_storage_plan_warehouse_id];

            $("#warehouse_wise_total_qty_" + random_mfp_storage_plan_id).val(warehouse_wise_total_qty[random_mfp_storage_plan_id]);
        }
        if (random_mfp_storage_plan_warehouse_id in warehouse_value_data) {
            warehouse_wise_total_value[random_mfp_storage_plan_id] = warehouse_wise_total_value[random_mfp_storage_plan_id] - warehouse_value_data[random_mfp_storage_plan_warehouse_id];
            delete warehouse_value_data[random_mfp_storage_plan_warehouse_id];
            $("#warehouse_wise_total_value_" + random_mfp_storage_plan_id).val(warehouse_wise_total_value[random_mfp_storage_plan_id]);
        }
    }
}


function mfp_storage_plan_no_inc() {
    var count = $(".remove_disposal_plan").length;
    // alert(count);
    $('.remove_disposal_plan').show();
    $('.remove_disposal_plan').first().hide();
}

function mfp_storage_plan_warehouse_no_inc(random_mfp_storage_plan_id) {
    var count = $(".remove_disposal_plan_warehouse_" + random_mfp_storage_plan_id).length;
    //alert(count+'-'+random_mfp_storage_plan_id);
    $('.remove_disposal_plan_warehouse_' + random_mfp_storage_plan_id).show();
    $('.remove_disposal_plan_warehouse_' + random_mfp_storage_plan_id).first().hide();
}



function getTotalQty(id) {
    var mfp_id = $("#mfp_storage_" + id).val();
    var mfp_name = $("#mfp_storage_" + id + " option:selected").text();
    var total_mfp_qty = $("#mfp_" + mfp_id).text();
    var class_name = $("#mfp_storage_" + id + " option:selected").attr('data-name');

    var total_qty = 0;
    $('.' + class_name).each(function () {
        total_qty += parseInt($(this).val());
    });

    $(".haat_quantity_" + id).val('');
    $(".haat_value_" + id).val('');
    if (total_qty > total_mfp_qty) {
        alert(mfp_name + ' Should not be greater than ' + total_mfp_qty);
        $("#mfp_storage_qty" + id).val('');
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
