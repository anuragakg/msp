COMMIDITY=[];
$(function() { 
  
  addHaatItem();
  var formid = TRIFED.getUrlParameters().id;
 if(formid!= undefined && formid!= null)
  {
      getFormData(formid);
  } 
  
});
 

addHaatItem= () => {
  $("#formID").on("submit", function(e) {
    $("#submitButton").attr("disabled", true);
        e.preventDefault();
       
       var formid = TRIFED.getUrlParameters().id;
       if(formid!= undefined && formid!= null)
       {
          var url = conf.updateHaatItem.url(formid);
          var method = conf.updateHaatItem.method; 
          var data = $('#formID').serializeArray();
        TRIFED.asyncAjaxHit(url, method, data, function (response) {
            if (response.status == 1) {
              response_data=response.data;
              TRIFED.showMessage('success', 'Successfully Updated');
              setTimeout(function() {document.location = "haat-bazaar-items.php";}, 500);              
            } else {
              TRIFED.showError('error', response.message);
              $("#submitButton").attr("disabled", false);
              z= false;
            }
        });   
       }else{
          var url = conf.addHaatItem.url;
          var method = conf.addHaatItem.method;
          var data = $('#formID').serializeArray();
        TRIFED.asyncAjaxHit(url, method, data, function (response) {
            if (response.status == 1) {
              response_data=response.data;
              TRIFED.showMessage('success', 'Successfully Added');
              setTimeout(function() {document.location = "haat-bazaar-items.php";}, 500);              
            } else {
              TRIFED.showError('error', response.message);
              $("#submitButton").attr("disabled", false);
              z= false;
            }
        });  
       }
         
      
  });
};


fillFormData = data => {
  $('#item_name').val(data.item_name);
  $('#specification').val(data.specification);
  $('#unit').val(data.unit);
  $('#cost').val(data.cost); 
};

function getFormData(id)
{ 
    var url = conf.addHaatItem.url+'/' + id; 
    var method = 'GET';
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
      if (response) {
        addressData = response.data;
        fillFormData(addressData);
      } else {
        TRIFED.showMessage("error", cb);
      }
    });
}  