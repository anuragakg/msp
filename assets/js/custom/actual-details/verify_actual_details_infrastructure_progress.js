    var url_var = getUrlVars();    
    var infraFormDetail=''; 
    var formData=''; 
    var form_id=''; 
  $(document).ready(function() { 
      form_id = url_var['id']; 
    infraFormDetail= fetchInfraFormData(url_var['id']);       
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
        $('#warehouse_table').html(data);  
      }
    });
  } 

 });
 
 
$(function(){ 
    
    if(url_var['id']!=undefined)
    {
        $('#approve').on('click',function(){
             if(confirm("Are you sure to Approve this?"))
            {
            if($('#remarks').val()=='')
            {
                $('#remarks_err').html('Please enter remarks');
            }else{
                $('#remarks_err').html('');
                var url = conf.approveInfrastructureProgress.url;
                var method = conf.approveInfrastructureProgress.method;
                data={'remarks':$('#remarks').val(),'form_id':form_id};
                TRIFED.asyncAjaxHit(url, method, data, function (response) {
          document.getElementById("approve").disabled = true;
                    if (response.status == 1) {
                        TRIFED.showMessage('success', 'Approved Successfully');
                        setTimeout(function() { window.location = '../fund-management/received_infrastructure_consolidated_proposal.php'}, 500);
                    } else {
                        TRIFED.showError('error', response.message);
                    }
                });
            }
}
        });

        $('#revert').on('click',function(){
             if(confirm("Are you sure to revert this?"))
            {
            if($('#remarks').val()=='')
            {
                $('#remarks_err').html('Please enter remarks');
            }else{
                $('#remarks_err').html('');
                var url = conf.revertInfrastructureProgress.url;
                var method = conf.revertInfrastructureProgress.method;
                data={'remarks':$('#remarks').val(),'form_id':form_id};
                TRIFED.asyncAjaxHit(url, method, data, function (response) {
          document.getElementById("revert").disabled = true;
                    if (response.status == 1) {
                        TRIFED.showMessage('success', 'Reverted Successfully');
                        setTimeout(function() { window.location = '../fund-management/received_infrastructure_consolidated_proposal.php'}, 500);
                    } else {
                        TRIFED.showError('error', response.message);
                    }
                });
            }
        }
        });

        $('#reject').on('click',function(){
            if(confirm("Are you sure to reject this?"))
            {
            if($('#remarks').val()=='')
            {
                $('#remarks_err').html('Please enter remarks');
            }else{
                $('#remarks_err').html('');
                var url = conf.rejectInfrastructureProgress.url;
                var method = conf.rejectInfrastructureProgress.method;
                data={'remarks':$('#remarks').val(),'form_id':form_id};
                TRIFED.asyncAjaxHit(url, method, data, function (response) {
                document.getElementById("reject").disabled = true;
                    if (response.status == 1) {
                        TRIFED.showMessage('success', 'Rejected Successfully');
                        setTimeout(function() { window.location = '../fund-management/received_infrastructure_consolidated_proposal.php'}, 500);
                    } else {
                        TRIFED.showError('error', response.message);
                    }
                });
            }
        }
        });
        
    }
});

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
