
function RenderProposedMFP(random_proposed_mfp_id, proposed_mfp) {
    var source = $("#proposed_mfp_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_proposed_mfp_id: random_proposed_mfp_id,
      item: proposed_mfp
    });

    $("#other_proposed_mfp").append(rendered);
    checkNumeric();
    initDecimalNumeric();
    var count = $(".delete_proposed_mfp").length;
    $('#mfp_id'+random_proposed_mfp_id).html($('#commodity_options').html());
    $('#months_'+random_proposed_mfp_id).html($('#months_options').html());
    var group_checbox=''; 
    other_proposed_mfp_no_inc();
    if (proposed_mfp) 
    {
        $("#mfp_id" + random_proposed_mfp_id).val(proposed_mfp.mfp_id);
        months=proposed_mfp.months;
        
             
        $.each(months, function(i,e){
          $("#months_"+random_proposed_mfp_id+" option[value='" + e + "']").prop("selected", true);
        });
      
        $("#available_" + random_proposed_mfp_id).val(proposed_mfp.available);
        $("#plan_" + random_proposed_mfp_id).val(proposed_mfp.plan);
        $("#shg_group" + random_proposed_mfp_id).val(proposed_mfp.shg_group);
    }
     
    delete_proposed_mfp(random_proposed_mfp_id);
  }
$(document).ready(function() {
  var other_proposed_mfp = "";
  var random_proposed_mfp_id = Date.now();
  $("#addproposed_mfp").click(function() {
    random_proposed_mfp_id = Date.now();
    RenderProposedMFPUnassigned(random_proposed_mfp_id);
  });

  if (other_proposed_mfp != null && other_proposed_mfp.length) {
   // console.log(other_proposed_mfp);
    var proposed_mfp_no = 0;
    $.each(other_proposed_mfp, function(key, proposed_mfp) {
      ++proposed_mfp_no;
      random_proposed_mfp_id = proposed_mfp_no;
      RenderProposedMFP(random_proposed_mfp_id, proposed_mfp);
    });
  } else {
    proposed_mfp = {};
    RenderProposedMFP(random_proposed_mfp_id, proposed_mfp);
  }
});

function other_proposed_mfp_no_inc() {
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
  function delete_proposed_mfp(random_proposed_mfp_id) {
    $("#remove_proposed_mfp" + random_proposed_mfp_id).click(function() {
      var data_id = $(this).attr("data_id");
      var count = $(".delete_proposed_mfp").length;
      if (count > 1) {
        $("#delete_proposed_mfp" + random_proposed_mfp_id).remove();
        other_proposed_mfp_no_inc();
      }
    });
  }


//enter numeric only
function checkNumeric()
{
  $(".numericOnly").keydown(function(e) {
      // Allow: backspace, delete, tab, escape, enter and .
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
          // Allow: Ctrl+A, Command+A
          (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
          // Allow: home, end, left, right, down, up
          (e.keyCode >= 35 && e.keyCode <= 40)) {
          // let it happen, don't do anything
          return;
      }
      // Ensure that it is a number and stop the keypress
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
          e.preventDefault();
      }
  });
}


//========= Proposed MFP (ADD MORE) =======
function RenderProposedMFPUnassigned(random_proposed_mfp_id, proposed_mfp) {
    var source = $("#proposed_mfp_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_proposed_mfp_id: random_proposed_mfp_id,
      item: proposed_mfp
    });

    $("#other_proposed_mfp").append(rendered);
    checkNumeric();
    initDecimalNumeric();
    var count = $(".delete_proposed_mfp").length;
    $('#mfp_id'+random_proposed_mfp_id).html($('#commodity_options').html());
    $('#months_'+random_proposed_mfp_id).html($('#months_options').html());
    var group_checbox='';
    
    other_proposed_mfp_no_inc();
    if (proposed_mfp) 
    {
        $("#mfp_id" + random_proposed_mfp_id).val(proposed_mfp.mfp_id);
        months=proposed_mfp.months;
          
    
        $.each(months, function(i,e){
          $("#months_"+random_proposed_mfp_id+" option[value='" + e + "']").prop("selected", true);
        });
      
        $("#available_" + random_proposed_mfp_id).val(proposed_mfp.available);
        $("#plan_" + random_proposed_mfp_id).val(proposed_mfp.plan);
        $("#shg_group" + random_proposed_mfp_id).val(proposed_mfp.shg_group);
    } 
    delete_proposed_mfp(random_proposed_mfp_id);
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
