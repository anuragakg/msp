    var url_var = getUrlVars();    
    var infraFormDetail=''; 
    var formData=''; 
  $(document).ready(function() {         
    fetchHaatItemMaster();      
     fetchWarehouseItemList(); 
    infraFormDetail= fetchInfraFormData(url_var['ref_id']);       
    formData= fetchFormData(url_var['id']);     
  }); 
  


   $("#formID").submit(function(e) {
            e.preventDefault();
        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.editInfraActulaDetails.url;
            var method = conf.editInfraActulaDetails.method; 
            if (url_var['id'] != undefined && url_var['id'] != '') 
            {
                data.append('id', url_var['id'] );
                data.append('ref_id', url_var['ref_id'] );
            }
               
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Details updated succesfully');
                     setTimeout(function() { history.back(); }, 500);
                        } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    }); 


fetchInfraFormData = (form_id) => {
  var url = conf.getInfrastructureDetail.url(form_id);
  var method = conf.getInfrastructureDetail.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    if (response.status) {       
      data = response.data;  
    } else {
      TRIFED.showMessage('error', cb);
    }
  });
  return data;
}

fetchFormData = (form_id) => {
  var url = conf.getActualDetailInfrastructure.url(form_id);
  var method = conf.getActualDetailInfrastructure.method;
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
    $('#actual_date').val(data.date); 
    $('#year_id').val(data.year_id).trigger('change');
      HaatRander = data.actual_haat;
      warehouseRander = data.actual_warehouse;
}


$(document).ready(function() {  

   var random_modernized_id = Date.now();
  $("#haat_table").on('click','.add_modernized',function() {  
    random_modernized_id = Date.now();
    RenderModernized(random_modernized_id,random_modernized_id);
  });  

  var random_warehouse_id = Date.now(); 
    $("#warehouse_table").on('click','.add_warehouse',function() {  
    random_warehouse_id = Date.now();
    RenderWarehouse(random_warehouse_id,random_warehouse_id);
  });   

  if (infraFormDetail.infra_haat && infraFormDetail.infra_haat != null && infraFormDetail.infra_haat != '') {
    HaatData = infraFormDetail.infra_haat;
  
    var selectedValues = {};
    $.each(HaatData, function (key, haat) {    
      selectedValues[haat.haat_id] = haat.haat_name;
    });
    var textValue = JSON.stringify(selectedValues, null, 4);  
    haatForm=formData.actual_haat;

    $.ajax({
      type: "POST",
      url: '../actual-details/infrastructure_progress_haat.php',
      data: { option: textValue,formData:haatForm }, // serializes the form's elements.
      success: function (data) { 
        $('#haat_table').html(data); 
        if (HaatRander != null && HaatRander.length) { 
          var haat_no = 0;
          k=0; 
          $.each(HaatRander, function(key, haat) {       
            ++haat_no;
            ++k;
            random_modernized_id = haat_no;
               RenderModernized(random_modernized_id,haat,k);
          });
        }
      }
    });
  } 
    
  if (infraFormDetail.warehouse_facilities && infraFormDetail.warehouse_facilities != null && infraFormDetail.warehouse_facilities != '') {
    WarehouseData = infraFormDetail.warehouse_facilities;
    var selectedValues = {};
    $.each(WarehouseData, function (key, haat) {
      selectedValues[haat.warehouse] = haat.warehouse_name;
    });
    var textValue = JSON.stringify(selectedValues, null, 4); 
    formData=formData.actual_warehouse;
   
    $.ajax({
      type: "POST",
      url: '../actual-details/infrastructure_progress_warehouse.php',
      data: { option: textValue, formData:formData }, // serializes the form's elements.
      success: function (data) { 
        $('#warehouse_table').html(data); // show response from the php script.
        if (warehouseRander != null && warehouseRander.length) { 
          var ware_no = 0; 
           k=0;
          $.each(warehouseRander, function(key, warehouse) {      
            ++ware_no;
            ++k;
            random_warehouse_id = ware_no;               
            RenderWarehouse(random_warehouse_id, warehouse,k);
          });
        }
      }
    });
  } 

 });

function RenderModernized(random_modernized_id, itemsdata,k) {
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
       $("#itemId_"+random_modernized_id).val(itemsdata.item_id).trigger('change');

        var haat_no = 0;   
          $.each(itemsdata.fund, function(key, response) {       
                       ++haat_no; 
                         $('#estimated_funds'+k+'_'+haat_no).val(response.actual_required_funds);   //12  //12 == 1.1, 2.2
                
                });
    } 
    var count = $(".delete_haat_modernized").length;     
    modernized_haat_no_inc(); 
    delete_modernized(random_modernized_id);  
    $('#itemId_'+random_modernized_id).select2(); 
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
    {   //console.log(itemsdata.item_id);
       $("#WareitemId_"+random_warehouse_id).val(itemsdata.item_id).trigger('change');

       var haat_no = 0;   
          $.each(itemsdata.fund, function(key, response) {       
                       ++haat_no; 
                         $('#estimated_funds_'+k+'_'+haat_no).val(response.actual_required_funds);   //12  //12 == 1.1, 2.2
                
                });
    } 
    var count = $(".delete_warehouse").length;     
    warehouse_no_inc(); 
    delete_warehouse(random_warehouse_id); 
   // $('#warehouse_'+random_warehouse_id).select2(); 
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
          console.log(response.data.specification);
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
