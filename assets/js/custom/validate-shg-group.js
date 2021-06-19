$(document).ready(function() {
  /* Binds form submission and fields to the validation engine */
  $("#create-sgh-group-form").validationEngine();

  /* Toggle for SGH Group Ajeevika Area */
  $('input').on('ifChecked', function(event){
    var ajeevika_id = $(this).val();
    if(ajeevika_id === "1") {
      $(".toggle_shg_group_ajeevika").show();
    }else {
      $(".toggle_shg_group_ajeevika").hide();
    }
  });

  /* For DataTable */
  
});