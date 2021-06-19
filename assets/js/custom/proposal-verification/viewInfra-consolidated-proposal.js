var auth = TRIFED.getLocalStorageItem();
var district_id = auth.district_id;
var district_name = auth.district;

var formData = {};
var url_var = getUrlVars();
var form_id = url_var['id'];
var form_data='';
$(document).ready(function () {

    formData=fetchFormData(url_var['id']); 
    haatdata=formData.getHaat;   
         warehouse_fund=formData.getWarehouse;            
         other_warehouse=formData.warehouseData;            
        modernized_id=0; 
        $.each(haatdata, function(key, itemdata) {
            ++modernized_id;
            RenderWarehouseInformation(modernized_id, itemdata);
        });
    
    var warehouse_no = 0;
    $.each(other_warehouse, function (key, warehouse) {
      ++warehouse_no;
      random_warehouse_id = warehouse_no;
      RenderWarehouse(random_warehouse_id, warehouse);
    });

         /*if ( !warehouse_fund!= null && warehouse_fund != '') { 
          total=0; 
        $.each(warehouse_fund, function (key, warehouse) {  
                if (!isNaN(warehouse.estimated_fund)) {
                    total += parseInt(warehouse.estimated_fund);
                }                            
            });  
      }*/
        
        old_fund=0;
         warehouse_total=0; 
        $.each(formData.getSummary, function(key, data) {   
             if (!isNaN(data.old_fund_available)) {
                    old_fund += parseFloat(data.old_fund_available);
                       warehouse_total += parseFloat(data.total_warehouse_facilities);
                }  
        });
        $("#total_fund_warehouse").val(decimalValues(warehouse_total)); 
           $("#old_fund").val(decimalValues(old_fund)); 
           calculateAutoSum();
    

 });


fetchFormData = (form_id) => {
    var url = conf.getInfraConsolidatedDetail.url(form_id);
    var method = conf.getInfraConsolidatedDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            data = response.data;
           // console.log(response);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}

 function RenderWarehouse(random_warehouse_id, warehouse) {
  var source = $("#warehouse_template").html();
  Mustache.parse(source);
  var rendered = Mustache.render(source, {
    random_warehouse_id: random_warehouse_id,
    warehouse: warehouse
  });

  $("#other_warehouse").append(rendered);
   if(warehouse!='' && warehouse!=null)
    {    console.log(random_warehouse_id);
        $('#storage_capacity_'+random_warehouse_id).text(decimalValues(warehouse.storage_capacity));
        total_fund=decimalValues(warehouse.estimated_fund); 
        $('#estimated_fund_' + random_warehouse_id).html(total_fund);
        local_name = '';
    $.each(warehouse.mfp_data, function (i, t) {      
  
      if (warehouse.mfp_data.length && i != 0) {
        local_name += ','
      }
      local_name = local_name + t.mfp_name;  
    });
    //console.log("#mfp_" + random_warehouse_id);
    $("#mfp_" + random_warehouse_id).html(local_name);
    $("#mfpName_" + random_warehouse_id).html(local_name);

     block= '';
    $.each(warehouse.block_data, function (i, t) {
      if (warehouse.block_data.length && i != 0) {
        block += ','
      }
      block = block + t.block_name;
    });
     $("#block_" + random_warehouse_id).html(block);

      }
  var count = $(".delete_warehouse").length;
  other_warehouse_no_inc();
}



function other_warehouse_no_inc() {
  var other_warehouse_no = 0;
  $(".other_warehouse_no").each(function () {
    ++other_warehouse_no;
    $(this).html(other_warehouse_no);
  });
  var count = $(".delete_warehouse").length;

  if (count > 1) {
    $(".remove_warehouse").show();
  } else {
    $(".remove_warehouse")
      .first()
      .hide();
  }
}
function RenderWarehouseInformation(modernized_id, itemsdata) {
    var source = $("#modernized_fund_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      modernized_id: modernized_id,
      itemsdata: itemsdata
    }); 
    $("#modernized_data").append(rendered);     
    if(itemsdata!='' && itemsdata!=null)
    {   
        $('#haat_'+modernized_id).val(itemsdata.haat_id).trigger('change'); 
        $('#fund_'+modernized_id).val(itemsdata.requirement_fund_summary);
    }
    var count = $(".delete_modernized_mfp").length;     
    haat_no_inc(); 
  } 


function haat_no_inc() { 
    var other_proposed_mfp_no = 0;
    $(".other_proposed_mfp_no").each(function() {
      ++other_proposed_mfp_no;
      $(this).html(other_proposed_mfp_no);
    });
    var count = $(".delete_proposed_mfp").length;
    if (count > 1) {
      $(".remove_proposed_mfp").show();
    } else {
      $(".remove_proposed_mfp")
        .first()
        .hide();
    }
  }
  
 function calculateAutoSum(){
    
    var sum = 0;
    $(".auto-sum").each(function(){
        sum += +$(this).val();
    });
      var total_require_fund=sum.toFixed(4);
    $("#total_fund").val(total_require_fund);

     var haat = 0;
    $(".mdt_feild").each(function(){
        haat += +$(this).val();
    });
    console.log(haat);
    $("#total").html(decimalValues(haat));
    $("#total_estimated_fund").val(haat);
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





