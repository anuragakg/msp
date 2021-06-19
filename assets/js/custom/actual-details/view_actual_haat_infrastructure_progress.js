    var url_var = getUrlVars();    
    var infraFormDetail=''; 
    var formData=''; 
  $(document).ready(function() { 
    infraFormDetail= fetchInfraFormData(url_var['ref_id']);       
    formData= fetchFormData(url_var['id']);       
   
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
    $('#actual_date').val(data.date); 
    $('#year_id').val(data.year_id).trigger('change');
      HaatRander = data.actual_haat;
      warehouseRander = data.actual_warehouse;
}
$(document).ready(function() {  
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
      url: '../actual-details/preview_infrastructure_progress_haat.php',
      data: { option: textValue,formData:haatForm }, // serializes the form's elements.
      success: function (data) { 
        $('#haat_table').html(data); 
        if (HaatRander != null && HaatRander.length) { 
          var haat_no = 0; 
          $.each(HaatRander, function(key, haat) {       
            ++haat_no;
            random_modernized_id = haat_no;
               RenderModernized(random_modernized_id,haat);
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
      url: '../actual-details/preview_infrastructure_progress_warehouse.php',
      data: { option: textValue, formData:formData }, // serializes the form's elements.
      success: function (data) { 
        $('#warehouse_table').html(data); // show response from the php script.
        if (warehouseRander != null && warehouseRander.length) { 
          var ware_no = 0; 
          $.each(warehouseRander, function(key, warehouse) {      
            ++ware_no;
            random_warehouse_id = ware_no;               
            RenderWarehouse(random_warehouse_id, warehouse);
          });
        }
      }
    });
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
    var count = $(".delete_haat_modernized").length;     
    modernized_haat_no_inc(); 
    delete_modernized(random_modernized_id);  
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
     if(itemsdata!='' && itemsdata!=null)
    {    
      //console.log(itemsdata);
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
