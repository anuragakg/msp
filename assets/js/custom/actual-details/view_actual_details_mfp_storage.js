
    var url_var = getUrlVars();  
  var haatmaster_data={}; 
  var warehousemaster_data={}; 
  var mfp_result={}; 
  var formData = {};
  var mfp_qty=[];
var mfp_master_value=[];
  $(document).ready(function() {
    fetchFinancialYear();
     fetchDiaReleaseDetails(url_var['id']);
     fetchSeasonalityDetails(url_var['id']);
     fetchMfpStorageDetails(url_var['id']);   

        

  });

fetchMfpStorageDetails = (id) => {
    var url = conf.getMfpStorageDetails.url(id);
    var method = conf.getMfpStorageDetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
        formData = response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

 $(document).ready(function() {

          var disposaldata=formData;
        random_mfp_storage_plan_id=0;
        $.each(disposaldata, function(key, itemdata) {
            ++random_mfp_storage_plan_id;
            RenderDisposalPlan(random_mfp_storage_plan_id, itemdata);
        });
    });

fetchFinancialYear=()=>{
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
    $.each(years, function(i, year) {
        html += '<option value="'+year.id+'">'+year.title+'</option>';
    });
    $('#year_id').html(html);
}  
   

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

 
fetchSeasonalityDetails = (id) => {
    var url = conf.getMfpProcurementSeasonalityDetails.url(id);
    var method = conf.getMfpProcurementSeasonalityDetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillMfpDetails(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}


fillMfpDetails = (data) => {
    mfp_result=data; 
    html='';var i=0;
    
    mfp_result.forEach(function(row){
        mfp_qty[row.mfp_id]=row.qty;
        mfp_master_value[row.mfp_id]=row.master_value; 
        ++i;
        html +='<tr>';
            html +='<td>'+ i +'</td>';
            html +='<td>'+ row.mfp_name +'</td>';
            html +='<td>'+ row.qty +'</td>';
            html +='<td>'+ row.qty*row.master_value*1000 +'</td>';
        html +='</tr>';
    });
    $('#mfp_list').html(html);
    
} 

 
 $(document).on('change','.mfp_name',function(){
    var mfp_id=$(this).val();
    var data_id=$(this).attr('data-id');   
    qty=mfp_qty[mfp_id];
    value=mfp_master_value[mfp_id]; 
    $('#mfp_storage_qty'+data_id).val(qty); 
   

});



function RenderDisposalPlan(random_mfp_storage_plan_id, itemsdata) {
    
    var source = $("#mfp_storage_plan_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_storage_plan_id: random_mfp_storage_plan_id,
        itemdata: itemsdata,
    }); 
    $("#mfp_storage_plan_container").append(rendered); 
    mfp_storage_plan_no_inc();
    
    

    if (itemsdata != '' && itemsdata != null) {   
        disposalPlanWarehouseData = itemsdata.other_mfp_actual;
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
            itemsdata: itemsdata,
        });
        $("#mfp_storage_plan_warehouse_info_" + random_mfp_storage_plan_id).append(rendered); 
        if (itemsdata != '' && itemsdata != null) {
            $('#totalmfpVal_'+random_mfp_storage_plan_warehouse_id).html(itemsdata.value*1000);
            }        
        mfp_storage_plan_warehouse_no_inc(random_mfp_storage_plan_id);
       
    }
 
    function delete_disposal_plan(random_mfp_storage_plan_id) {
        var count = $(".main-div").length;
        if (count > 1) {
            $("#delete_disposal_plan" + random_mfp_storage_plan_id).remove();
            mfp_storage_plan_no_inc();
        }
    }

    function delete_disposal_plan_warehouse(random_mfp_storage_plan_id,random_mfp_storage_plan_warehouse_id) {
       
        var count = $(".remove_disposal_plan_warehouse_"+random_mfp_storage_plan_id).length;
       // alert(count);
        if (count > 1) {
            $("#disposal_plan_warehouse_info" + random_mfp_storage_plan_warehouse_id).remove();
            mfp_storage_plan_warehouse_no_inc(random_mfp_storage_plan_id);
            //change total value on delete
            if (random_mfp_storage_plan_warehouse_id in data){
                
                warehouse_wise_total_qty[random_mfp_storage_plan_id] = warehouse_wise_total_qty[random_mfp_storage_plan_id] - data[random_mfp_storage_plan_warehouse_id];

                delete data[random_mfp_storage_plan_warehouse_id];

                $("#warehouse_wise_total_qty_"+random_mfp_storage_plan_id).val(warehouse_wise_total_qty[random_mfp_storage_plan_id]);
            }
            if (random_mfp_storage_plan_warehouse_id in warehouse_value_data){
                warehouse_wise_total_value[random_mfp_storage_plan_id] = warehouse_wise_total_value[random_mfp_storage_plan_id] - warehouse_value_data[random_mfp_storage_plan_warehouse_id];
                delete warehouse_value_data[random_mfp_storage_plan_warehouse_id];
                $("#warehouse_wise_total_value_"+random_mfp_storage_plan_id).val(warehouse_wise_total_value[random_mfp_storage_plan_id]);
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
        var count = $(".remove_disposal_plan_warehouse_"+random_mfp_storage_plan_id).length;
        //alert(count+'-'+random_mfp_storage_plan_id);
        $('.remove_disposal_plan_warehouse_'+random_mfp_storage_plan_id).show();
        $('.remove_disposal_plan_warehouse_'+random_mfp_storage_plan_id).first().hide();   
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
