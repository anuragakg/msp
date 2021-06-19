var url_var = getUrlVars();
var haatmaster_data = {};
$(document).ready(function () {
  //   fetchFinancialYear(); 
  fetchHaatList();
});
var url_var = getUrlVars();
var form_id = '';
var form_data = '';
if (url_var['id'] != undefined) {
  form_id = url_var['id'];
  $(document).ready(function () {
    form_data = fetchFormData(form_id);    
     $('#proposal_id').html(form_data.proposal_id)
    $('#year_id').val(form_data.year_id);
    mfpdata = form_data.infra_haat;

    other_warehouse = form_data.warehouse_facilities;
    $('#year_id').html(form_data.financialYear)
    random_haat_id = 0;
    $.each(mfpdata, function (key, itemdata) {
      ++random_haat_id;
      RenderGeneralInformation(random_haat_id, itemdata);
    });
    var warehouse_no = 0;
    $.each(other_warehouse, function (key, warehouse) {
      ++warehouse_no;
      random_warehouse_id = warehouse_no;
      RenderWarehouse(random_warehouse_id, warehouse);
    });

    haatdata = form_data.totalfund;
    warehouse_fund = form_data.warehouse_facilities;
    modernized_id = 0;
    $.each(haatdata, function (key, itemdata) {
      ++modernized_id;
      RenderWarehouseInformation(modernized_id, itemdata);
    });
    if (!warehouse_fund != null && warehouse_fund != '') {
      total = 0;
      $.each(warehouse_fund, function (key, warehouse) {
        if (!isNaN(warehouse.estimated_fund)) {
          total += parseFloat(warehouse.estimated_fund);
        }
      });
      $("#total_fund_warehouse").val(decimalValues(total));

      $.each(form_data.summary, function (key, data) {
        $("#other_info").val(data.other_information);
        $("#old_fund").val(decimalValues(data.old_fund_available));
        $("#total").html(decimalValues(data.estimated_requirement_funds));
      });

      calculateAutoSum();
    }
  });
}
/*======== Procurement Plan =====*/
fetchFormData = (form_id) => {
  var url = conf.getInfrastructureDetail.url(form_id);
  var method = conf.getInfrastructureDetail.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    if (response.status) {
      data = response.data;
       if(data.can_update_status==0)
                {
                    $('.update_status').prop('disabled',true)
                }
    } else {
      TRIFED.showMessage('error', cb);
    }
  });
  return data;
}

function calculateAutoSum() {

  var sum = 0;
  $(".auto-sum").each(function () {
    sum += +$(this).val();
  });
  var total_require_fund=sum.toFixed(4);
  $("#total_fund").val(total_require_fund);

  var haat = 0;
  $(".mdt_feild").each(function () {
    haat += +$(this).val();
  });
  //$("#total").html(haat);
  $("#total_estimated_fund").val(haat);
}
function RenderGeneralInformation(random_haat_id, itemsdata) {
  var source = $("#modernized_template").html();
  Mustache.parse(source);
  var rendered = Mustache.render(source, {
    random_haat_id: random_haat_id,
    itemsdata: itemsdata
  });
  $("#haat_bazaar_proposed").append(rendered);
  fillHaatList(haatmaster_data, '#haat_' + random_haat_id);
  if (itemsdata != '' && itemsdata != null) {
    $('#haat_' + random_haat_id).val(itemsdata.haat_id).trigger('change');
    local_name = '';
    $.each(itemsdata.mfp_data, function (i, t) {
      if (itemsdata.mfp_data.length && i != 0) {
        local_name += ','
      }
      local_name = local_name + t.mfp_name;
    });
    $("#mfp_" + random_haat_id).html(local_name);
     block= '';
    $.each(itemsdata.block_data, function (i, t) {
      if (itemsdata.block_data.length && i != 0) {
        block += ','
      }
      block = block + t.block_name;
    });
    
     $("#blockN_" + random_haat_id).html(block);
  }
  var count = $(".delete_proposed_mfp").length;
  modernized_no();
}


function modernized_no() {
  var other_proposed_mfp_no = 0;
  $(".modernized_no").each(function () {
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

function haat_no_inc() {
  var other_proposed_mfp_no = 0;
  $(".other_proposed_mfp_no").each(function () {
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

fetchHaatList = () => {
  var url = conf.getHaatMasterList.url;
  var method = conf.getHaatMasterList.method;
  var data = {};
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
$(document).on('change', '.mfp_coverage_haat', function (ev) {
  const v = $(this).val();
  var item_id = $(this).attr('data-id');
  if ($(this).val() != '') {
    if (form_id != '') {
      form_data = fetchFormData(form_id);
    }
    getAssesments(v, form_data);
  }

});
function getAssesments(id, form_data) {
  var count = $('.mfp_coverage_haat  option:selected').length;
  var selectedValues = {};
  $('.mfp_coverage_haat').each(function () {
    var text = $(this).children("option").filter(":selected").text();
    var value = $(this).val();
    selectedValues[value] = text;

  });
  formData = form_data.assessment_data;
  var textValue = JSON.stringify(selectedValues, null, 4);
  $.ajax({
    type: "POST",
    url: '../modification-infrastructure/assessment_preview.php',
    data: { total: count, option: textValue, formData: formData }, // serializes the form's elements.
    success: function (data) {
      $('#assessment').html(data); // show response from the php script.

    }
  });
  getProposed(textValue, form_data.proposed_plan);
}

function getProposed(data, formdata) {
  $.ajax({
    type: "POST",
    url: '../modification-infrastructure/proposed_plan_preview.php',
    data: { option: data, formData: formdata }, // serializes the form's elements.
    success: function (data) {
      $('#proposed').html(data); // show response from the php script. 
      if (formdata != null && formdata.length) {
        k = 0;
        var haat_no = 0;
        $.each(formdata, function (key, proposed_plan) {
          ++haat_no;
          ++k;
          random_proposed_mfp_id = haat_no;
          RenderProposedPlan(random_proposed_mfp_id, proposed_plan, k)
        });
      } else {
        var proposed_plan = "";
        random_proposed_mfp_id = Date.now();
        k = '';
        RenderProposedPlan(random_proposed_mfp_id, proposed_plan, k);
      }
    }
  });
}


function RenderProposedPlan(random_proposed_mfp_id, proposed_plan, k) {
  //console.log(proposed_plan);
  var source = $("#proposed_plan_template").html();
  Mustache.parse(source);
  var rendered = Mustache.render(source, {
    random_proposed_mfp_id: random_proposed_mfp_id,
    proposed_plan: proposed_plan
  });

  $("#proposed_plan_table").append(rendered);
  if (proposed_plan != '' && proposed_plan != null) {
    $('#plan_' + random_proposed_mfp_id).val(proposed_plan.proposed_plan);
    var haat_no = 0;
    $.each(proposed_plan.haat_data, function (key, response) {
      ++haat_no;
      $('#estimated_funds_' + k + '_' + haat_no).val(response.estimated_funds);   //12  //12 == 1.1, 2.2

    });

  }

  count_proposed_plan_no_inc();
}

function count_proposed_plan_no_inc() {
  var count_proposed_no_inc = 0;
  $(".proposed_no_inc").each(function () {
    ++count_proposed_no_inc;
    $(this).html(count_proposed_no_inc);
  });
  var count = $(".delete_proposed_plan").length;

  if (count > 1) {
    $(".remove_proposed_plan").show();
  } else {
    $(".remove_proposed_plan")
      .first()
      .hide();
  }
}

function RenderWarehouse(random_warehouse_id, warehouse) {
  var source = $("#warehouse_template").html();
  Mustache.parse(source);
  var rendered = Mustache.render(source, {
    random_warehouse_id: random_warehouse_id,
    warehouse: warehouse
  });

  $("#other_warehouse").append(rendered);
  if (warehouse != '' && warehouse != null) { 
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
  //fillHaatList(haatmaster_data,'#haat_'+modernized_id); 
  if (itemsdata != '' && itemsdata != null) { 
    $('#haat_' + modernized_id).val(itemsdata.haat_id).trigger('change');
    $('#haatFund_'+modernized_id).html(itemsdata.estimated_funds);
    $('#fund_'+modernized_id).val(itemsdata.estimated_funds);
  }
  var count = $(".delete_modernized_mfp").length;
  haat_no_inc();
}

function haat_no_inc() {
  var other_modernized = 0;
  $(".other_modernized").each(function () {
    ++other_modernized;
    $(this).html(other_modernized);
  });
  var count = $(".delete_modernized_mfp").length;
  if (count > 1) {
    $(".remove_modernized").show();
  } else {
    $(".remove_modernized")
      .first()
      .hide();
  }
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
