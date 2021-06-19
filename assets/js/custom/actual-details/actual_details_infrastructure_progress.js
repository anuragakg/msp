
    var url_var = getUrlVars();  
  var HaatItemMaster={}; 
  var WarehouseItemMaster={};  
    var formData=''; 
  $(document).ready(function() { 
    formData= fetchFormData(url_var['id']);    
     fetchHaatItemMaster();      
     fetchWarehouseItemList();   
   
  }); 


fetchFormData = (form_id) => {
  var url = conf.getInfrastructureDetail.url(form_id);
  var method = conf.getInfrastructureDetail.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    if (response.status) { 
      fillFields(response.data);
      data = response.data;  
    } else {
      TRIFED.showMessage('error', cb);
    }
  });
  return data;
}


fillFields = (data) => { 
    $('#proposal_id').html(data.proposal_id); 
    $('#infra_id').val(data.proposal_id); 
    $('#year_id').val(data.year_id).trigger('change'); 
    
$(document).ready(function() {
    $('.date').datepicker({
        todayBtn: "linked",        
        format: 'dd-mm-yyyy',
        startDate: new Date(data.max_proposal_date),
        endDate: new Date()

    });
});

}

   $("#formID").submit(function(e) {
            e.preventDefault();
        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addInfraActulaDetails.url;
            var method = conf.addInfraActulaDetails.method; 
            if (url_var['id'] != undefined && url_var['id'] != '') 
            {
                data.append('id', url_var['id'] );
            }
               
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Successfully Added');
                     setTimeout(function() { window.location = '../fund-management/infrastructure_received_fund.php'}, 500);
                        } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    }); 

  
   
  
$(document).ready(function() { 
  var random_modernized_id = Date.now();
  $("#haat_table").on('click','.add_modernized',function() {  
    random_modernized_id = Date.now();
    RenderModernized(random_modernized_id,random_modernized_id);
  });  
}); 

$(document).ready(function() { 
   if (formData.infra_haat && formData.infra_haat != null && formData.infra_haat != '') {
    HaatData = formData.infra_haat;
    var selectedValues = {};
    $.each(HaatData, function (key, haat) {
      selectedValues[haat.haat_id] = haat.haat_name;
    });
    var textValue = JSON.stringify(selectedValues, null, 4); 
    $.ajax({
      type: "POST",
      url: '../actual-details/infrastructure_progress_haat.php',
      data: { option: textValue }, // serializes the form's elements.
      success: function (data) { 
        $('#haat_table').html(data); // show response from the php script.
        var random_modernized_id = Date.now();  
        haat = {};
        RenderModernized(random_modernized_id, haat);
      }
    });
  } 

  var random_modernized_id = Date.now();    
     modernized_data='';         
  if (modernized_data != null && modernized_data.length) { 
    var haat_no = 0; 
    $.each(modernized_data, function(key, haat) {       
      ++haat_no;
      random_modernized_id = haat_no;
         RenderModernized(random_modernized_id,haat);
    });
  } else {
    haat = {};
    RenderModernized(random_modernized_id, haat);
  } 
});

function RenderModernized(random_modernized_id, itemsdata) {
    var source = $("#modernized_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_modernized_id: random_modernized_id,
      itemsdata: itemsdata
    }); 
    $("#haat_bazaar_modernized").append(rendered);  
     fillHaatItemMaster('#itemId_'+random_modernized_id);
     if(itemsdata!='' && itemsdata!=null)
    {   
       
    }
    var count = $(".delete_haat_modernized").length;     
    modernized_haat_no_inc(); 
    delete_modernized(random_modernized_id); 
    $('#haat_'+random_modernized_id).select2(); 
  } 

function modernized_haat_no_inc() { 
    var random_modernized_id_no = 0;
    $(".random_modernized_id_no").each(function() {
      ++random_modernized_id_no;
      $(this).html(random_modernized_id_no);
    });
    var count = $(".delete_haat_modernized").length;

    if (count > 1) {
      $(".remove_modernized").show();
    } else {
      $(".remove_modernized")
        .first()
        .hide();
    }
  }

  function delete_modernized(random_modernized_id) {
    $("#remove_modernized" + random_modernized_id).click(function() {
      var data_id = $(this).attr("data_id");
      var count = $(".delete_haat_modernized").length;
      if (count > 1) {
        $("#delete_haat_modernized" + random_modernized_id).remove();       
      }
    });
  } 


$(document).ready(function() {     
  var random_warehouse_id = Date.now();
  //$("#add_warehouse").click(function() {
    $("#warehouse_table").on('click','.add_warehouse',function() {  
    random_warehouse_id = Date.now();
    RenderWarehouse(random_warehouse_id,random_warehouse_id);
  });  
}); 

$(document).ready(function() { 
   if (formData.warehouse_facilities && formData.warehouse_facilities != null && formData.warehouse_facilities != '') {
    WarehouseData = formData.warehouse_facilities;
    var selectedValues = {};
    $.each(WarehouseData, function (key, haat) {
      selectedValues[haat.warehouse] = haat.warehouse_name;
    });
    var textValue = JSON.stringify(selectedValues, null, 4); 
    $.ajax({
      type: "POST",
      url: '../actual-details/infrastructure_progress_warehouse.php',
      data: { option: textValue }, // serializes the form's elements.
      success: function (data) { 
        $('#warehouse_table').html(data); // show response from the php script.
        var random_warehouse_id = Date.now();  
        warehouse_data = {};
        RenderWarehouse(random_warehouse_id, warehouse_data);
      }
    });
  } 

  var random_warehouse_id = Date.now();    
     warehouse_data='';         
  if (warehouse_data != null && warehouse_data.length) { 
    var warehouse_no = 0; 
    $.each(warehouse_data, function(key, warehouse) {       
      ++warehouse_no;
      random_warehouse_id = warehouse_no;
         RenderWarehouse(random_warehouse_id,warehouse)    
    });
  } else {
    warehouse = {};
    RenderWarehouse(random_warehouse_id, warehouse);
  } 
});

function RenderWarehouse(random_warehouse_id, itemsdata) {
    var source = $("#warehouse_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_warehouse_id: random_warehouse_id,
      itemsdata: itemsdata
    }); 
    $("#warehouse_facilities").append(rendered);  
    fillWarehouseItemList('#WareitemId_'+random_warehouse_id);
     if(itemsdata!='' && itemsdata!=null)
    {   
       $('#warehouse_'+random_warehouse_id).val(itemsdata.warehouse_id).trigger('change');
       $('#blocks_'+random_warehouse_id).val(itemsdata.block_id).trigger('change');
       $('#operation_'+random_warehouse_id).val(itemsdata.operation_day).trigger('change');
        $.each(itemsdata.mfp_data, function( i, v ){ 
              $("#mfp_"+random_warehouse_id +" option[value='" +v.mfp_id + "']").prop("selected", true);
        });  
    }
    var count = $(".delete_warehouse").length;     
    warehouse_no_inc(); 
    delete_warehouse(random_warehouse_id); 
    $('#warehouse_'+random_warehouse_id).select2(); 
  } 

function warehouse_no_inc() { 
    var random_warehouse_id_no = 0;
    $(".random_warehouse_id_no").each(function() {
      ++random_warehouse_id_no;
      $(this).html(random_warehouse_id_no);
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

  function delete_warehouse(random_warehouse_id) {
    $("#remove_warehouse" + random_warehouse_id).click(function() {
      var data_id = $(this).attr("data_id");
      var count = $(".delete_warehouse").length;
      if (count > 1) {
        $("#delete_warehouse" + random_warehouse_id).remove();       
      }
    });
  } 

  function isNumber(ev) {
    if (ev.type === "paste" || ev.type === "drop") {
        var textContent = (ev.type === "paste" ? ev.clipboardData : ev.dataTransfer).getData('text');
        return !isNaN(textContent) && textContent.indexOf(".") === -1;
    } else if (ev.type === "keydown") {
        if (ev.ctrlKey || ev.metaKey) {
            return true
        };
        var keysToAllow = [8, 46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
        return keysToAllow.indexOf(ev.keyCode) > -1;
    } else {
        return true
    }
}
  /*
$(document).ready(function() {
  var random_mpc_id = "";
  var random_mpc_id = Date.now();
  $("#add_mpc").click(function() {
    random_mpc_id = Date.now();
    Render_mpc(random_mpc_id,random_mpc_id);
  });  
}); 

$(document).ready(function() { 
  var random_mpc_id = Date.now();    
     mpc_data='';         
  if (mpc_data != null && mpc_data.length) { 
    var mpc_no = 0; 
    $.each(mpc_data, function(key, add_mpc) {       
      ++mpc_no;
      random_mpc_id = mpc_no;
         Render_mpc(random_mpc_id,add_mpc)    
    });
  } else {
    add_mpc = {};
    Render_mpc(random_mpc_id, add_mpc);
  } 
});

function Render_mpc(random_mpc_id, itemsdata) {
    var source = $("#mpc_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_mpc_id: random_mpc_id,
      itemsdata: itemsdata
    }); 
    $("#mpc_facilities").append(rendered);  
     if(itemsdata!='' && itemsdata!=null)
    {   
       $('#add_mpc_'+random_mpc_id).val(itemsdata.add_mpc_id).trigger('change');
       $('#blocks_'+random_mpc_id).val(itemsdata.block_id).trigger('change');
       $('#operation_'+random_mpc_id).val(itemsdata.operation_day).trigger('change');
        $.each(itemsdata.mfp_data, function( i, v ){ 
              $("#mfp_"+random_mpc_id +" option[value='" +v.mfp_id + "']").prop("selected", true);
        });  
    }
    var count = $(".delete_mpc").length;     
    mpc_no_inc(); 
    delete_mpc(random_mpc_id); 
    $('#mpc_'+random_mpc_id).select2(); 
  } 

function mpc_no_inc() { 
    var random_mpc_id_no = 0;
    $(".random_mpc_id_no").each(function() {
      ++random_mpc_id_no;
      $(this).html(random_mpc_id_no);
    });
    var count = $(".delete_mpc").length;

    if (count > 1) {
      $(".remove_mpc").show();
    } else {
      $(".remove_mpc")
        .first()
        .hide();
    }
  }

  function delete_mpc(random_mpc_id) {
    $("#remove_mpc" + random_mpc_id).click(function() {
      var data_id = $(this).attr("data_id");
      var count = $(".delete_mpc").length;
      if (count > 1) {
        $("#delete_mpc" + random_mpc_id).remove();       
      }
    });
  } 
  
*/

fetchHaatItemMaster=()=>{
    var url = conf.getHaatBazaarItemList.url;
    var method = conf.getHaatBazaarItemList.method;
    var data = {};
    data['status']=1;
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            HaatItemMaster=response.data; 
        }
    });
}
fillHaatItemMaster = (item_id) => {     
    html = '<option value="">Select Item</option>';
    $.each(HaatItemMaster, function(i, val) { 
        html += '<option value="'+val.id+'" data-id="'+val.id+'">'+val.item_name+'</option>';
    });
    $(item_id).html(html);
}

$(document).on('change','.mfp_coverage_haat', function (ev) {
    const v = $(this).val();
    var item_id = $(this).attr('data-id'); 
    if($(this).val()!='')
    {
        fillHaatFields(v,item_id);    
    }
    
});


fillHaatFields = (id,item_id) => { 
    var url = conf.viewHaatItem.url(id);
    var method = conf.viewHaatItem.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) { 
              $("#specification"+item_id).val(response.data.specification);
              $("#unit"+item_id).val(response.data.unit);
              $("#cost"+item_id).val(response.data.cost);
        }
    });
}
 

fetchWarehouseItemList = () => {
    var url = conf.getWarehouseItemList.url;
    var method = conf.getWarehouseItemList.method;
    var data = {};
     data['status']=1;
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            WarehouseItemMaster=response.data;
        }
    });
}


fillWarehouseItemList= (item_id) => {
    html = '<option value="">Select Item</option>';
    $.each(WarehouseItemMaster, function(i, val) {
        html += '<option value="'+val.id+'">'+val.item_name+'</option>';
    });
    $(item_id).html(html);
} 
 

$(document).on('change','.mfp_coverage_warehouse', function (ev) {
    const v = $(this).val();
    var item_id = $(this).attr('data-id'); 
    if($(this).val()!='')
    {
        fillWarehouseFields(v,item_id);    
    }
    
});

fillWarehouseFields = (id,item_id) => { 
    var url = conf.viewWarehouseItem.url(id);
    var method = conf.viewWarehouseItem.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) { 
              $("#specification_"+item_id).val(response.data.specification);
              $("#unit_"+item_id).val(response.data.unit);
              $("#cost_"+item_id).val(response.data.cost);
        }
    });
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
