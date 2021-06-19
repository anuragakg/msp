
var formStatus;
const mustacheTemplates = {
  otherHaatBazaar: "#otherHaatBazaarTemplate",
  annualExpenditures: "#annual_expenditure_template",
  procurementAgent: "#procurement_agent_template",
  mfpCommodity: "#mfpCommodityTemplate",
  procCommodity: "#procCommodityTemplate"
};

const queryData = {};

/* Add More at Other haat bazaar */
jQuery(document).delegate("a.add-record", "click", function(e) {
  e.preventDefault();
  var len = $("#haat_bazaar_body tr").length;
  RenderMfpCommodity(Date.now(), {}, len);
});

/* Add More at Other procument commodity haat bazaar */
jQuery(document).delegate("a.add-commodity", "click", function(e) {
  var id = $(this).attr('id');
  var len = '';//$(".haat_bazaar_procument_body tr").length;
  //RenderProcumentCommodity(id, {}, len);
  addProcumentCommodities(id,len)
});

/* add classs on selected class */
$(".custom-file-input").on("change", function() {
  //let fileName = $(this).val().split('\\').pop();
  $(this)
    .next(".custom-file-label")
    .addClass("selected")
    .html(fileName);
});

/* jQuery steps form validation with currentIndex */
$(document).ready(function() {
  var form = $("#formID");
  $("#wizard").steps();
  $("#formID")
    .steps({
      // enableAllSteps: true,
      labels: {
        next: "Save and Next",
        previous: "Previous",
        finish: "Save and Submit"
      },
      bodyTag: "fieldset",
      onInit: function(event, currentIndex) {
        addProcurementAgent();
        addMfpCommoditiesTraded();
        addAnnualExpenditures();
        //addProcumentCommodities();

        const queryParam = window.location.search.substr(1);
        const queryObj = new URLSearchParams(queryParam);
        editId = queryObj.get("id");
        queryData.formID = editId;
        if (editId != null) {
          setTimeout(function() {
            stepManagementView(editId);
          }, 1500);
        }
      },
      onStepChanging: function(event, currentIndex, newIndex) {
        var form = $(this);

        // Always allow going backward even if the current step contains invalid fields!
        if (currentIndex > newIndex) {
          return true;
        }

        // Forbid next action on "Warning" step if the user is to young
        if (true) {
          var data = $("#formID-p-" + currentIndex).serializeArray();

          // data.push({ name: "form_id", value: $("#form_id").val() });
          //createResource(data) ;
          // var z = true;
          //console.log(currentIndex)
          formBackend = stepManagement(currentIndex, editId, data);
          console.log("This is the value of formBackend" + formBackend);
        }

        // Clean up if user went backward before
        if (currentIndex < newIndex) {
          // To remove error styles
          form.find(".body:eq(" + newIndex + ") label.error").remove();
          form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }

        // Disable validation on fields that are disabled or hidden.
        form.validate().settings.ignore = ":disabled,:hidden";

        // Start validation; Prevent going forward if false
        return form.valid() && formBackend;
      },
      onStepChanged: function(event, currentIndex, priorIndex) {
        // Suppress (skip) "Warning" step if the user is old enough.
        if (currentIndex === 2 && Number($("#age").val()) >= 18) {
          $(this).steps("next");
        }

        if (currentIndex == 3) {
          /** add procurement agent now */
          // addProcurementAgent();
          // addMfpCommoditiesTraded();
          // addAnnualExpenditures();
        }

        // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
        if (currentIndex === 2 && priorIndex === 4) {
          $(this).steps("previous");
        }

        // if (editId != null) {
        //   formBackend = stepManagementView(currentIndex, editId);
        //   return true;
        // }
      },
      onFinishing: function(event, currentIndex) {
        var form = $(this);

        // Disable validation on fields that are disabled.
        // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
        form.validate().settings.ignore = ":disabled";
        var data = $("#formID-p-" + currentIndex).serializeArray();

        // data.push({ name: "form_id", value: $("#form_id").val() });
        // Start validation; Prevent form submission if false
        formBackend = stepManagement(currentIndex, editId, data);
        return form.valid();
      },
      onFinished: function(event, currentIndex) {
        var form = $(this);

        // Submit form input
        // form.submit();
      }
    })
    .validate({
      errorPlacement: function errorPlacement(error, element) {
        if (element.attr("type") == "radio") {
           console.log($(this).attr('name'));
          //error.appendTo(element.closest('i-checks radio-inline').siblings('.i-checks radio-inline'));
          element = element.closest(".i-checks").parent();
          //error.insertAfter(element);
          error.appendTo(element);
        }else if (element.attr("type") == "checkbox") {
          //error.appendTo(element.closest('i-checks radio-inline').siblings('.i-checks radio-inline'));
          element = element.closest(".i-checks").parent();
          //error.insertAfter(element);
          error.appendTo(element);
        } else {
          element.after(error);
        }
        //error.appendTo(element.parent().siblings('.new container for errors'));
      },
      rules: {
        rpm_name: {
          required: true,
          maxlength: 50
        },
        rpm_location: {
          required: true,
          maxlength: 50
        },
        address: {
          required: true,
          maxlength: 250
        },
        state: {
          required: true
        },
        district: {
          required: true
        },
        block: {
          required: true
        },
        gram_panchyat: {
          maxlength: 50
        },
        village: {
          required: true
        },
        pin_code: {
          required: true,
          digits: true,
          minlength: 6,
          maxlength: 6
        },
        /* is_on_rent: {
          required: true
        }, */
        rpm_ownership: {
          required: true
        },
        operating_rpm: {
          required: true,
          maxlength: 100
        },
        premises_rpm: {
          required: true
        },
        /* rate_per_annum: {
          maxlength: 20,
          digits: true
        }, */
        market_regulation: {
          required: true
        },
        regulation_type: {
          required: false
        },
        working_days: {
          required: true,
          digits: true,
          maxlength: 20
        },
        working_days1: {
          required: true,
          digits: true,
          maxlength: 20
        },
        sale_start_time: {
          required: false
        },
        sale_end_time: {
          required: false
        },
        staff_size: {
          required: false,
          digits: true,
          maxlength: 5
        },
        nearest_railway_station: {
          required: false,
          maxlength: 50
        },
        railway_distance: {
          required: false,
          digits: false,
          maxlength: 20
        },
        nearest_highway: {
          required: false,
          maxlength: 50
        },
        highway_distance: {
          required: false,
          digits: false,
          maxlength: 20
        },
        nearest_apmc_market: {
          required: false,
          maxlength: 50
        },
        apmc_distance: {
          required: false,
          digits: false,
          maxlength: 20
        },
        other_haat_bazaar: {
          required: false,
          maxlength: 50
        },
        other_haat_bazaar_distance: {
          required: false,
          digits: false,
          maxlength: 20
        },
        nearest_bus_stand: {
          maxlength: 50
        },
        agmarknet_node: {
          required: false
        },
        market_type: {
          required: true
        },
        /* types_markets: {
          required: true
        }, */
        market_fees: {
          required: false,
          digits: false,
          maxlength: 20
        },
        market_charges: {
          required: false,
          digits: false,
          maxlength: 20
        },
        broker_fees: {
          required: false,
          digits: false,
          maxlength: 20
        },
        commission_agency_charges: {
          required: false,
          digits: false,
          maxlength: 20
        },
        weighing_charges: {
          required: false,
          digits: false,
          maxlength: 20
        },
        sitting_charges: {
          required: false,
          digits: false,
          maxlength: 20
        },
        user_charges: {
          required: false,
          digits: false,
          maxlength: 20
        },
        other_charges: {
          required: false,
          digits: false,
          maxlength: 20
        },
        boundary_wall: {
          required: false
        },
        built_up_area: {
          required: false
        },
        access_road: {
          required: true
        },
        internal_road: {
          required: true
        },
        is_godown_secured: {
          required: false
        },
        tonnage: {
          required: false,
          maxlength: 50
        },
        godown_area: {
          required: false,
          digits: false,
          maxlength: 20
        },
        weigbridge: {
          required: true
        },
        electronic_weighing_scale: {
          required: true
        },
        manual_weighing_scale: {
          required: true
        },
        number: {
          required: false,
          digits: true,
        },
        cleaning_area: {
          required: false,
          digits: false,
        },
        is_demarcated_area: {
          required: false,
          maxlength: 50
        },
        /* other_infrastructure: {
          required: true,
          maxlength: 20
        }, */
        transportation: {
          required: true
        },
        office: {
          required: true
        },
        drinking_water: {
          required: true
        },
        notice_board: {
          required: true
        },
        urinal_toilet: {
          required: true
        },
        electricity: {
          required: true
        },
        garbage_system: {
          required: true
        },
        parking: {
          required: true
        },
        input_sundry: {
          required: true
        },
        hygienic: {
          required: true
        },
        bank: {
          required: true
        },
        post_office: {
          required: true
        },
        post_office_name: {
          required: false
        },
        bank_name: {
          required: false
        },
        assaying_lab: {
          required: true
        },
        packaging: {
          required: true
        },
        assaying_lab_remarks: {
          required: false,
          maxlength: 250
        },
        packaging_remarks: {
          required: false,
          maxlength: 250
        },
        drying_yards: {
          required: true
        },
        bagging: {
          required: true
        },
        drying_yards_remarks: {
          required: false,
          maxlength: 250
        },
        bagging_remarks: {
          required: false,
          maxlength: 250
        },
        loading: {
          required: true
        },
        conditioning: {
          required: true
        },
        loading_remarks: {
          required: false,
          maxlength: 250
        },
        conditioning_remarks: {
          required: false,
          maxlength: 250
        },
        /* pack_house: {
          required: true
        }, */
        storage_capacity: {
          required: true
        },
        /* pack_house_remarks: {
          required: true,
          maxlength: 200
        }, */
        storage_capacity_remarks: {
          required: false,
          maxlength: 250
        },
        primary_processing: {
          required: true
        },
        info_display: {
          required: false
        },
        primary_processing_remarks: {
          required: false,
          maxlength: 250
        },
        info_display_remarks: {
          required: false,
          maxlength: 250
        },
        it_infra: {
          required: true
        },
        storage: {
          required: false
        },
        it_infra_remarks: {
          required: false,
          maxlength: 250
        },
        storage_remarks: {
          required: false,
          maxlength: 250
        },
        public_address: {
          required: false
        },
        extension: {
          required: false
        },
        public_address_remarks: {
          required: false,
          maxlength: 250
        },
        extension_remarks: {
          required: false,
          maxlength: 250
        },
        standardisation_remarks: {
          required: false,
          maxlength: 250
        },
        boarding_lodging: {
          required: true
        },
        cleaning_and_sanitation: {
          required: false
        },
        waste_utilization: {
          required: false
        },
        garbage_collection: {
          required: false
        },
        /* other_facility: {
          required: true
        },
        remarks: {
          required: true,
          maxlength: 200
        },
        annual_income: {
          required: true,
          digits: true,
          maxlength: 20
        }, */
        /* head_of_expenditure1: {
          required: true,
          maxlength: 20
        },
        amount1: {
          required: true,
          digits: true,
          maxlength: 20
        },
        head_of_expenditure2: {
          required: true,
          maxlength: 20
        },
        amount2: {
          required: true,
          digits: true,
          maxlength: 20
        },
        head_of_expenditure3: {
          required: true,
          maxlength: 20
        },
        amount3: {
          required: true,
          digits: true,
          maxlength: 20
        },
        head_of_expenditure4: {
          required: true,
          maxlength: 20
        },
        amount4: {
          required: true,
          digits: true,
          maxlength: 20
        },
        head_of_expenditure5: {
          required: true,
          maxlength: 20
        },
        amount5: {
          required: true,
          digits: true,
          maxlength: 20
        },
        latitude: {
          required: false,
          maxlength: 20
        },
        longitude: {
          required: false,
          maxlength: 20
        },
        nearest_apmc_distance: {
          required: false,
          digits: false,
          maxlength: 20
        }, */
        pro_name: {
          required: true,
          maxlength: 50
        },
        pro_mobile_no: {
          required: true,
          digits: true,
          maxlength: 11
        },
        pro_landline_no: {
          required: false,
          digits: true,
          maxlength: 15
        },
        pro_address: {
          required: true,
          maxlength: 250
        },
        category_ids: {
          required: true
        },
        pro_commodity: {
          required: true
        },
        pro_state: {
          required: true
        },
        pro_district: {
          required: true
        },
        pro_block: {
          required: true
        },
        mfp_commodity: {
          required: true
        },
        mfp_commodity1: {
          required: true
        },
        annual_quantity: {
          required: false,
          maxlength: 20
        },
        commodity1: {
          required: true
        },
        annual_quantity1: {
          required: false,
          maxlength: 20
        },
        commodity2: {
          required: true
        },
        annual_quantity2: {
          required: false,
          maxlength: 20
        },
        commodity3: {
          required: true
        },
        annual_quantity3: {
          required: false,
          maxlength: 20
        },
        commodity4: {
          required: true
        },
        annual_quantity4: {
          required: false,
          maxlength: 20
        },
        commodity5: {
          required: true
        },
        annual_quantity5: {
          required: false,
          maxlength: 20
        }
      },
      messages: {
        name: {
          maxlength: "Please enter no more than 50 characters."
        }
      }
    });
});

/* datepicker for calendar */
$(document).ready(function() {
  $("#data-calendar .input-group.date").datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format: "dd/mm/yyyy"
  });
});
/* icheck */
$(document).ready(function() {
  $(".i-checks").iCheck({
    checkboxClass: "icheckbox_square-green",
    radioClass: "iradio_square-green"
  });

  /* clockpicker using clockpicker plugin */
  $(".clockpicker").clockpicker({
    donetext: "Done"
  });
});

$(function() {
  fetchMasterData();
  fetchHaatList();
  
  //fetchVillageList();
  addHaatPartOne();
  fetchPeriodicityMaster();
  fetchTranspotationData();
});
/** Processing for any update request */
let editId = 0;
const queryParam = window.location.search.substr(1);
const queryObj = new URLSearchParams(queryParam);
editId = queryObj.get("id");

fetchMasterData = () => {
  var url = conf.getMasterData.url;
  var method = conf.getMasterData.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      addressData = response.data;
      renderMasters(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

renderMasters = (masterData) => {
    utils.renderInputElements(
      '.market-regulation-data', 
      masterData.marketRegulation, 
      'market_regulation',
      'radio'
    );

    utils.renderInputElements(
      '.regulation-data', 
      masterData.regulation, 
      'regulation_type',
      'radio'
    );

    utils.renderInputElements(
      '.market-type-data', 
      masterData.marketType, 
      'market_type',
      'radio'
    );

    utils.renderInputElements(
      '.access-road-data', 
      masterData.accessRoad, 
      'access_road',
      'radio'
    );

    utils.renderInputElements(
      '.internal-road-data', 
      masterData.accessRoad, 
      'internal_road',
      'radio'
    );

    utils.renderInputElements(
      '.boundary-wall-data', 
      masterData.boundaryWall, 
      'boundary_wall',
      'radio'
    );

    utils.renderInputElements(
      '.built-up-area-data', 
      masterData.builtUpArea, 
      'built_up_area',
      'radio'
    );

    utils.renderOptionElements(
      '#rpm_ownership',
      masterData.rpmOwnership,
    );
    /*utils.renderOptionElements(
      '#bank_branch_name',
      masterData.bank,
    );*/
    renderBankData('#bank_branch_name',masterData.bank);
};
$(document).ready(function(){
    $('#bank_branch_name').on('change',function(){
      if($(this).val()=='0')
      {
        $('#other_bank_div').show();  
      }else{
        $('#other_bank_div').hide();
      }
      
  });  
});

fetchHaatList = () => {
  var url = conf.getHaatList.url;
  var method = conf.getHaatList.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      addressData = response.data;
      fillHaatList(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

fillHaatList = data => {
  var html = "";
  $.each(data, function(i, data) {
    html +=
      '<tr id="' +
      data.id +
      '" ><td data-id="' +
      data.id +
      '">' +
      ++i +
      '</td><td id="row-data">' +
      data.rpm_name +
      '</td></td><td id="row-data">' +
      data.rpm_location +
      '</td></td><td id="row-data">' +
      data.state_name +
      '</td></td><td id="row-data">' +
      data.district_name +
      '</td></td><td id="row-data">' +
      data.block_name +
      '</td></td><td id="row-data">' +
      data.village_name +
      "</td>" +
      '<td class="action-area"><a href="../survey-forms/haat-bazar-survey-form.php?id=' +
      data.id +
      '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>' +
      "</td>";
  });
  $("#haat-market-table tbody").html(html);
};

//fetch periodicity master
fetchPeriodicityMaster = () => {
  var url = conf.getPeriodicityList.url;
  var method = conf.getPeriodicityList.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      addressData = response.data;
      fillPeriodicityList(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

fillPeriodicityList = data => {
  var html = "";
  html += '<option value="">Please Select</option>';
  $.each(data, function(i, data) {
    html += '<option value="' + data.id + '" >' + data.title + "</option>";
  });
  $("#periodicity").html(html);
};

//fetching state list
fetchStateList = (callback) => {
  var url = conf.getStates.url;
  var method = conf.getStates.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      addressData = response.data;
      queryData.states = response.data;
      fillStateList(response.data);
      if (typeof callback == 'function') {
        cb(response.data);
      }
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

fillStateList = data => {
  var html = "";
  html += '<option value="">Please Select</option>';
  $.each(data, function(i, data) {
    html += '<option value="' + data.id + '" >' + data.title + "</option>";
  });
  $("#state").html(html);
};
fetchStateList();

//fetching village list
// fetchVillageList = () => {
//   var url = conf.getVillageList.url;
//   var method = conf.getVillageList.method;
//   var data = {};
//   TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
//     if (response) {
//       addressData = response.data;
//       fillVillageList(response.data);
//     } else {
//       TRIFED.showMessage("error", cb);
//     }
//   });
// };

function getVillageMaster(value) {
  var url = conf.getVillage.url + value;
  var method = conf.getVillageList.method;
  var data = {

  };
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        renderVillageElements('.village', response.data);
      }
  });
}

function renderVillageElements(id, records, villageId) {
  const el = $('select' + id);
  el.html('');
  el.append($('<option value="">').text('Please Select'));
  records.forEach(element => {
    if(villageId == element.id)
      el.append($('<option selected>').val(element.id).text(element.title));
      else 
      el.append($('<option>').val(element.id).text(element.title));
  });
}


function renderBankData(id, records) {
  const el = $('select' + id);
  el.html('');
  el.append($('<option value="">').text('Please Select'));
  records.forEach(element => {
      el.append($('<option>').val(element.id).text(element.title));
  });
  el.append($('<option>').val('0').text('Other Bank'));
}


$(document).ready(function(){
  $('#pin_code').keyup(function (ev) {
    const v = $(this).val();
    utils.fetchVillage(v);
  })
})

//get district list on change of state
function getDistrict() {
  var state_id = $("#state")
    .val()
    .trim();
  var url = conf.getDistrictData.url + "?state_id=" + state_id;
  // console.log(url);
  var method = conf.getDistrictData.method;
  TRIFED.asyncAjaxHit(url, method, {}, function(response) {
    if (response.status == 1) {
      // $('#district_id').html(response.data);
      renderOptionElements("#district", response.data);
    } else {
      TRIFED.showError("error", response.message);
    }
  });
}

//get update district list on change of state
function getUpdatedDistrict(state_id) {
  var url = conf.getDistrictData.url + "?state_id=" + state_id;
  // console.log(url);
  var method = conf.getDistrictData.method;
  TRIFED.asyncAjaxHit(url, method, {}, function(response) {
    if (response.status == 1) {
      // $('#district_id').html(response.data);
      populateDistrictList(response.data);
    } else {
      TRIFED.showError("error", response.message);
    }
  });
}
/**
 * Renders option element
 * @param {string} id ID
 * @param {Array} records
 */
function renderOptionElements(id, records) {
  const el = $("select" + id);
  el.html("");
  el.append($("<option>").text("Please Select"));
  records.forEach(element => {
    el.append(
      $("<option>")
        .val(element.id)
        .text(element.title)
    );
  });
}
//populate district
populateDistrictList = data => {
  $("#block").html('<option value="" >Select Block</option>');
  var html = "";
  html += '<option value="" >Select District</option>';
  $.each(data, function(i, data) {
    html += '<option value="' + data.id + '" >' + data.title + "</option>";
  });
  $("#district").html(html);
};

//get block list on change of district
function getBlock(value) {
  var url = conf.getBlocks.url;
  var method = conf.getBlocks.method;
  var data = {
    district_id: value
  };
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      renderOptionElements("#block", response.data);
    }
  });
}

//get rpm ownership
fetchRpmOwnership = () => {
  var url = conf.getRpmOwnershipList.url;
  var method = conf.getRpmOwnershipList.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      renderOptionElements("#rpm_ownership", response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

//Add dynamic other haat field
const maxOtherFields = 10;
function addField() {
  const len = $(".ohb-field").length;
  if (len + 1 > 10) {
    return;
  }
  return renderOtherHaatBazaarField(len);
}

function renderOtherHaatBazaarField(len = 1) {
  const data = {
    eqIndex: len
  };
  const renderedHtml = Mustache.render(mustacheTemplates.otherHaatBazaar, data);
  $("#addOtherHaat").append(renderedHtml);
}

function removeField(id) {
  $("#oh-" + id).remove();
}
// get form data
function getFormData(data) {
  data.rpm_name = $("#rpm_name")
    .val()
    .trim();
  data.rpm_location = $("#rpm_location")
    .val()
    .trim();
  data.state = $("#state")
    .val()
    .trim();
  data.address = $("#address")
    .val()
    .trim();
  data.district = $("#district")
    .val()
    .trim();
  data.block = $("#block")
    .val()
    .trim();
  data.gram_panchayat = $("#gram_panchayat")
    .val()
    .trim();
  data.village = $("#village")
    .val()
    .trim();
  data.pin_code = $("#pin_code")
    .val()
    .trim();
  data.rpm_ownership = $("#rpm_ownership")
    .val()
    .trim();
  data.operating_rpm = $("#operating_rpm")
    .val()
    .trim();
  data.rate_per_annum = $("#rate_per_annum")
    .val()
    .trim();
  // if($('#rate_per_annum').val().trim().length != 0){
  //     data.is_on_rent = 1;
  // }else{
  //     data.is_on_rent = 0;
  // }
  data.is_on_rent = $('input[name="is_on_rent"]:checked')
    .val()
    .trim();
  data.sale_start_time = $("#sale_start_time")
    .val()
    .trim();
  data.sale_end_time = $("#sale_end_time")
    .val()
    .trim();
  data.staff_size = $("#staff_size")
    .val()
    .trim();
  data.nearest_railway_station = $("#nearest_railway_station")
    .val()
    .trim();
  data.railway_distance = $("#railway_distance")
    .val()
    .trim();
  data.nearest_highway = $("#nearest_highway")
    .val()
    .trim();
  data.highway_distance = $("#highway_distance")
    .val()
    .trim();
  data.nearest_apmc_market = $("#nearest_apmc_market")
    .val()
    .trim();
  data.apmc_distance = $("#apmc_distance").val().trim();
  data.working_days = $("#working_days")
    .val()
    .trim();
  data.periodicity = 1; //set as default
  data.nearest_bus_stand = $("#nearest_bus_stand")
    .val()
    .trim();
  data.premises_rpm = $('input[name="agmarknet_node"]:checked')
    .val()
    .trim();
  data.agmarknet_node = $('input[name="agmarknet_node"]:checked')
    .val()
    .trim();
  data.market_regulation = $('input[name="market_regulation"]:checked')
    .val()
    .trim();
  data.regulation_type = $('input[name="regulation_type"]:checked')
    .val()
    .trim();
  var arrOtherName = [];
  var arrOtherDistance = [];
  var total = [];
  // let jsonHaat = {"haat_data" : [{"name":"ohb1","distance":"10"},{"name":"ohb2","distance":"11"}]};
  let myJson = { haat_data: {} };
  // data.other_haat_bazaar = JSON.stringify(jsonHaat);
  var arr = $('input[name="other_haat_bazaar[]"]')
    .map(function() {
      // return this.value; // $(this).val()
      arrOtherName.push(this.value);
    })
    .get();
  var arr = $('input[name="other_haat_bazaar_distance[]"]')
    .map(function() {
      // return this.value; // $(this).val()
      arrOtherDistance.push(this.value);
    })
    .get();

  for (var k = 0; k < arrOtherName.length; k++) {
    var item = {};
    var objValue = arrOtherName[k];
    var objValued = arrOtherDistance[k];
    item["name"] = objValue;
    item["distance"] = objValued;
    if (objValue != "" && objValued != "") {
      total.push(item);
    }
  }
  myJson.haat_data = total;
  data.other_haat_bazaar = JSON.stringify(myJson);
}
//submit haat part one form
addHaatPartOne = () => {
  $("#formID").on("submit", function(e) {
    e.preventDefault();
    var data = {};
    getFormData(data);
    // console.log(JSON.stringify(myJson));
    if (editId == null) {
      var url = conf.addHaatList.url;
      var method = conf.addHaatList.method;
      TRIFED.asyncAjaxHit(url, method, data, function(response) {
        if (response.status == 1) {
          $("#formID")[0].reset();
          if(editId != null)
        {
          TRIFED.showMessage("success", "Successfully Updated");
        }
        else{
          TRIFED.showMessage("success", "Successfully Added");
        }
          setTimeout(function() {
            document.location = "haat-bazar-survey-form.php";
          }, 500);
        } else {
          TRIFED.showError("error", response.message);
        }
      });
    } else {
      var url = conf.updateHaatList.url + editId;
      var method = conf.updateHaatList.method;
      // var updatedata = {};
      TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response.status == 1) {
          // $('#formID')[0].reset();
          TRIFED.showMessage("success", "Successfully Updated");
          setTimeout(function() {
            document.location = "haat-bazar-survey-form.php?id=" + editId;
          }, 500);
        } else {
          TRIFED.showError("error", response.message);
        }
      });
    }
  });
};

function populateFormData(editId) {
  var url = conf.getHaatData.url + editId;
  var method = conf.getHaatData.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    // console.log("data="+response.data['rpm_name']);
    if (response) {
      addressData = response.data;
      fillHaatMarketPartOne(addressData);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
}

function fillHaatMarketPartOne(apiData) {
  getUpdatedDistrict(apiData.state);
  getBlock(apiData.district);
  getVillageMaster(apiData.pin_code)

  let types = { radio: "radio", textbox: "textbox", select: "select" };
  let data = {
    rpm_name: types.textbox,
    address: types.textbox,
    rpm_location: types.textbox,
    gram_panchayat: types.textbox,
    pin_code: types.textbox,
    operating_rpm: types.textbox,
    rate_per_annum: types.textbox,
    working_days: types.textbox,
    staff_size: types.textbox,
    nearest_railway_station: types.textbox,
    railway_distance: types.textbox,
    nearest_highway: types.textbox,
    highway_distance: types.textbox,
    nearest_apmc_market: types.textbox,
    apmc_distance: types.textbox,
    nearest_bus_stand: types.textbox,
    agmarknet_node: types.radio,
    market_regulation: types.radio,
    premises_rpm: types.radio,
    regulation_type: types.radio,
    is_on_rent: types.radio,
    state: types.select,
    district: types.select,
    block: types.select,
    village: types.select,
    rpm_ownership: types.select,
    periodicity: types.select,
    sale_start_time: types.textbox,
    sale_end_time: types.textbox,
    agmarknet_node: types.radio
  };

  inputFieldHandler(data, apiData);
  
  if (
    apiData.other_haat_bazaar &&
    Array.isArray(apiData.other_haat_bazaar.haat_data)
  ) {
    const haatData = apiData.other_haat_bazaar.haat_data;
    haatData.forEach((v,i) => {
      if ((i + 1) != haatData.length) {
        renderOtherHaatBazaarField(i + 1, apiData);
      }
      $('#ohb-name-'+ i).val(v.name);
      $('#ohb-distance-'+ i).val(v.distance);
    })
  }
}

function fillHaatMarketPartTwo(apiData) {
  let types = { radio: "radio", textbox: "textbox", checkbox: "checkbox", checkboxMultiple : 'checkbox_multiple' };
  let data = {
    market_type: types.radio,
    market_fees: types.textbox,
    market_charges: types.textbox,
    broker_fees: types.textbox,
    weighing_charges: types.textbox,
    sitting_charges: types.textbox,
    commission_agency_charges: types.textbox,
    user_charges: types.textbox,
    other_charges: types.textbox,
    boundary_wall: types.radio,
    built_up_area: types.radio,
    access_road: types.radio,
    internal_road: types.radio,
    is_godown_secured: types.radio,
    tonnage: types.textbox,
    godown_area: types.textbox,
    weigbridge: types.radio,
    electronic_weighing_scale: types.radio,
    manual_weighing_scale: types.radio,
    number: types.textbox,
    is_demarcated_area: types.radio,
    cleaning_area: types.textbox,
    other_infrastructure: types.textbox,
    transportation: types.checkboxMultiple
  };

  inputFieldHandler(data, apiData);
}

function fillHaatMarketPartThree(apiData) {
  let types = { radio: "radio", textbox: "textbox" ,select: "select"};
  let data = {
    office: types.radio,
    drinking_water: types.radio,
    notice_board: types.radio,
    urinal_toilet: types.radio,
    electricity: types.radio,
    garbage_system: types.radio,
    parking: types.radio,
    input_sundry: types.radio,
    hygienic: types.radio,
    bank: types.radio,
    post_office: types.radio,
    bank_name: types.textbox,
    bank_branch_name: types.select,
    other_bank: types.textbox,
    post_office_name: types.textbox,
    assaying_lab: types.radio,
    packaging: types.radio,
    assaying_lab_remarks: types.textbox,
    packaging_remarks: types.textbox,
    drying_yards: types.radio,
    bagging: types.radio,
    drying_yards_remarks: types.textbox,
    bagging_remarks: types.textbox,
    loading: types.radio,
    conditioning: types.radio,
    loading_remarks: types.textbox,
    conditioning_remarks: types.textbox,
    pack_house: types.radio,
    storage_capacity: types.radio,
    pack_house_remarks: types.textbox,
    storage_capacity_remarks: types.textbox,
    primary_processing: types.radio,
    info_display: types.radio,
    primary_processing_remarks: types.textbox,
    info_display_remarks: types.textbox,
    it_infra: types.radio,
    storage: types.radio,
    it_infra_remarks: types.textbox,
    storage_remarks: types.textbox,
    public_address: types.radio,
    public_address_remarks: types.textbox,
    extension: types.radio,
    extension_remarks: types.textbox,
    info_display_remarks: types.textbox,
    boarding_lodging: types.radio,
    standardisation: types.radio,
    standardisation_remarks : types.textbox,
  };

  inputFieldHandler(data, apiData);
}

function fillHaatMarketPartFour(apiData) {
  let types = { radio: "radio", textbox: "textbox" };
  let data = {
    cleaning_and_sanitation: types.radio,
    waste_utilization: types.radio,
    garbage_collection: types.radio,
    other_facility: types.radio,
    remarks: types.textbox,
    annual_income: types.textbox,
    latitude: types.textbox,
    longitude: types.textbox,
    nearest_apmc_distance: types.textbox
  };

  inputFieldHandler(data, apiData);

  let expenditure = apiData.haat_bazaar_annual_expenditure.haat_data;
  $.each(expenditure, function(index, data) {
    $("#head_of_expenditure" + (index + 1)).val(data.head_of_expenditure);
    $("#amount" + (index + 1)).val(data.amount);
  });

  // let procurement_agent = apiData.haat_bazaar_procurement_agent.haat_data;
  // $.each(procurement_agent,function(index, data){
  //   $('#pro_name').val(data.name);
  //   $('#pro_mobile_no').val(data.mobile_no);
  //   $('#pro_landline_no').val(data.landline_no);
  //   $('#pro_address').val(data.address);
  //   $('#category_ids').val(data.category_ids);
  //   $('#pro_commodity').val(data.amount);
  //   $('#pro_state').val(data.state);
  //   $('#pro_district').val(data.district);
  //   $('#pro_block').val(data.block);
  // })

  populateAnnualExpenditures(apiData.haat_bazaar_annual_expenditure.haat_data);
  populateProcurementAgents(apiData.haat_bazaar_procurement_agent.haat_data);
  populateMfpCommodities(apiData.haat_bazaar_mfp_commodities.haat_data);
  //populateProcumentCommodities(apiData.haat_bazaar_procurement_agent.haat_data);
}

function inputFieldHandler(data, apiData) {
  $.each(data, function(key, value) { //console.log(key)
    if (value === "radio") {
      //if(apiData != null && apiData[key]==undefined){
        if( apiData != null && apiData[key] != null ) {
      $('input[name="' + key + '"][value="' + apiData[key] + '"]').iCheck(
        "check"
      );
    }
    } else if (value === "textbox" || value === "select") 
    {
        if(key=='bank_branch_name')
        {
          $("#" + key).val(apiData[key]).trigger('change');    
        }else{
          $("#" + key).val(apiData[key]);
        }
      
    } else if (value === "checkbox") {
      $('input[name="' + key + '"][value="' + apiData[key] + '"]').iCheck(
        "check"
      );
    } else if (value === "checkbox_multiple") {
      if (Array.isArray(apiData[key])) {
        apiData[key].forEach((v) => {
          $('input[name="' + key + '[]"][value="' + v + '"]').iCheck(
            "check"
          );
        })
      } 
    }
    
  });
}

function addOtherHaatBazaarField(other_haat_bazaar_length, newdata) {
  var x = 1;
  var y = 0;
  while (x <= other_haat_bazaar_length) {
    $("#addOtherHaat").append(
      '<div id="f' +
        x +
        '"><div class="form-group">' +
        '<label class="col-md-2 control-label p-r-None">Other haat bazaar</label>' +
        '<div class="col-md-3 p-r-None">' +
        '<input type="text" value="' +
        newdata.other_haat_bazaar[y]["haat_bazaar_name"] +
        '" name="other_haat_bazaar[]" class="form-control validate[maxSize[20]] other_haat_bazaar">' +
        "</div>" +
        '<div class="col-md-1 text-right">' +
        '<a onclick="removeField(' +
        x +
        ')" class="remove_field" style="color:red"><i class="fa fa-times-circle fa-2x"></i></a>' +
        "</div>" +
        '<label class="col-md-2 control-label">Distance</label>' +
        '<div class="col-md-4">' +
        '<input type="text" value="' +
        newdata.other_haat_bazaar[y]["haat_bazaar_distance"] +
        '" name="other_haat_bazaar_distance[]" class="form-control validate[custom[onlyNumberSp], maxSize[20]]">' +
        "</div>" +
        "</div></div>"
    );
    x++;
    y++;
  }
}

function stepManagement(currentIndex, formID, formData) {
  const formDetails = ["One", "Two", "Three", "Four"],
    formName = "HaatMarketPart";

  let status = true;

  let request = {
    apiName: "",
    method: "",
    url: "",
    data: formData
  };

  request.apiName = "add" + formName + formDetails[currentIndex];
  request.url = conf[request.apiName].url;
  request.method = conf[request.apiName].method;

  request.data.push({ name : "part_one_id", value : queryData.formID ? queryData.formID : "" });

  TRIFED.asyncAjaxHit(request.url, request.method, request.data, function(
    response
  ) {
    if (response.status == 1) {
      if (response.data.part_one_id) {
        queryData.formID = response.data.part_one_id;
      }      
      if(editId != null)
        {
          TRIFED.showMessage("success", "Successfully Updated");
        }
        else{
          TRIFED.showMessage("success", "Successfully Added");
        }
      if (currentIndex == 3) {
        setTimeout(() => {
          document.location = "../haat-market/haat-market-management.php";
        }, 1000);
      }
    } else {
      TRIFED.showError("error", response.message);
      status = false;
    }
  });

  return status;
}

function stepManagementView(currentIndex, formID) {

  let request = {
    apiName: "getHaatMarket",
    method: "",
    url: "",
    data: {}
  };

  request.url = conf[request.apiName].url(queryData.formID);
  request.method = conf[request.apiName].method;

  formStatus = true;

  TRIFED.asyncAjaxHit(request.url, request.method, request.data, function(
    response
  ) {
    if (response.status == 1) {
      $.each(response.data, function(index, details){
            let data = 'fill' + index;
            if (details && details.part_one_id) {
              queryData.formID = details.part_one_id;
            }
            window[data](details);
      });
    } else {
      TRIFED.showError("error", response.message);
       if(response.message === 'Not found!')
        formStatus = false;

      status = false;
    }
  });
}

function RenderProcurementAgent(random_link_pa_id, linkagedata) {
  const len = $(".paGroup").length;
  if ($(".paGroup").length > 0 && linkagedata == "") {
    return;
  }
  const catIds = queryData.categoryIds;
  const commodities = queryData.commodityLists;

  if (linkagedata && linkagedata.category_ids) {
    if (Array.isArray(catIds) && Array.isArray(linkagedata.category_ids)) {
      catIds.forEach(v => {
        v.sel = false;
        if (linkagedata.category_ids.indexOf(String(v.id)) != -1) {
          v.sel = true;
        }
      });
    }
  }  
  if (linkagedata && linkagedata.commodity) {
    var commodityArray = linkagedata.commodity;
    if (Array.isArray(commodities)) {
      commodities.forEach(v => {
        v.sel = false;
        //if (String(v.id) == String(linkagedata.commodity)) {
        if (commodityArray.includes(String(v.id))) {
          v.sel = true;
        }
      });
    }
  }  

  var rendered = Mustache.render(mustacheTemplates.procurementAgent, {
    random_link_pa_id: random_link_pa_id,
    agent: linkagedata,
    states: queryData.states,
    eqIndex: len,
    commodities: commodities,
    categoryIds : catIds
  });
  $("#procurement_agent_data").append(rendered);
  addProcumentCommodities(random_link_pa_id,linkagedata);
  //enter numeric only
  $(".numericOnly").keydown(function(a) {
    if ($.inArray(a.keyCode, [ 46, 8, 9, 27, 13, 110 ]) !== -1 || 65 === a.keyCode && (true === a.ctrlKey || true === a.metaKey) || a.keyCode >= 35 && a.keyCode <= 40) return;
    if ((a.shiftKey || a.keyCode < 48 || a.keyCode > 57) && (a.keyCode < 96 || a.keyCode > 105)) a.preventDefault();
  });
  $(".remove-p-agent-btn")
    .first()
    .hide();

  afterPaAppend("#pa-" + random_link_pa_id, random_link_pa_id);
  if (linkagedata && linkagedata.form_id) {
    $("#pro_state-" + random_link_pa_id)
      .val(linkagedata.state)
      .trigger("change");
    $("#pro_district-" + random_link_pa_id)
      .val(linkagedata.district)
      .trigger("change");
    $("#pro_block-" + random_link_pa_id)
      .val(linkagedata.block)
      .trigger("change");
  }
}

/**
 * Executes after procurement agent is appended.
 */
function afterPaAppend(id, randNumber) {
  $(id)
    .find(".i-checks")
    .iCheck({
      checkboxClass: "icheckbox_square-green",
      radioClass: "iradio_square-green"
    });
  $("#pro_state-" + randNumber).on("change", function() {
    utils.getDistricts(this.value, function(districts) {
      utils.renderOptionElements("#pro_district-" + randNumber, districts.data);
    });
  });
  $("#pro_district-" + randNumber).on("change", function() {
    utils.getBlocks(this.value, function(blocks) {
      utils.renderOptionElements("#pro_block-" + randNumber, blocks.data);
    });
  });
}

function addProcurementAgent(procurement_agents = "") {
  
  var random_link_pa_id = Date.now();
  $("#addlink_procurement")
  .unbind()
  .click(function() {
    random_link_pa_id = Date.now();
    RenderProcurementAgent(random_link_pa_id);
  });

  if (procurement_agents != null && procurement_agents.length) {
    var link_procurement = 0;
    $('#procurement_agent_data').html("");
    $.each(procurement_agents, function(key, linkagedata) {
      ++link_procurement;
      random_link_pa_id = link_procurement;
      RenderProcurementAgent(random_link_pa_id, linkagedata);
    });
  } else {
    linkagedata = {};
    RenderProcurementAgent(random_link_pa_id, linkagedata);
  }
}

function addMfpCommoditiesTraded() {
  const random_link_pa_id = Date.now();
  //var len = $("#haat_bazaar_body tr").length;
  var len = 0;
  RenderMfpCommodity(random_link_pa_id, {}, len);
}

function addProcumentCommodities(random_link_pac_id,commodotyData) {
  //const random_link_pac_id = Date.now();
  //var len = $("#haat_bazaar_body tr").length;
  var len = 0;
  if(commodotyData.commodities_data!=undefined && commodotyData.commodities_data!=null)
  {
    $.each(commodotyData.commodities_data,function(i,v){
     // console.log(v)
      RenderProcumentCommodity(random_link_pac_id, v);
    })
  }else{
    RenderProcumentCommodity(random_link_pac_id, {});
  }
  
}

function addAnnualExpenditures() {
  const random_link_pa_id = Date.now();
  for(let counter = 0; counter < 5; counter++) {
    RenderAnnualExpenditures(Date.now(), {}, counter);
  }
}

function processMustacheTemplates() {
  for (template in mustacheTemplates) {
    const source = $(mustacheTemplates[template]).html();
    mustacheTemplates[template] = source;
    Mustache.parse(source);
  }
}

function RenderMfpCommodity(randId, mfpCommodity, len) {
  //const len = $(".paGroup").length;
  
  const _commodities = queryData.commodityLists;
  
  utils.resetSelected(_commodities);
  utils.setSelected(_commodities, "id", mfpCommodity.commodity);

  var rendered = Mustache.render(mustacheTemplates.mfpCommodity, {
    randId: randId,
    commodity: mfpCommodity,
    eqIndex: len,
    commodities: _commodities
  });
  $("#haat_bazaar_body").append(rendered);
  //enter numeric only
  $(".numericOnly").keydown(function(a) {
    if ($.inArray(a.keyCode, [ 46, 8, 9, 27, 13, 110 ]) !== -1 || 65 === a.keyCode && (true === a.ctrlKey || true === a.metaKey) || a.keyCode >= 35 && a.keyCode <= 40) return;
    if ((a.shiftKey || a.keyCode < 48 || a.keyCode > 57) && (a.keyCode < 96 || a.keyCode > 105)) a.preventDefault();
});
}


function RenderProcumentCommodity(randId, procCommodity) {
  //const len = $(".paGroup").length;  
  //console.log(procCommodity);
  const _commodities = queryData.commodityLists;
  
  utils.resetSelected(_commodities);
  utils.setSelected(_commodities, "id", procCommodity.commodity);
  len=Date.now();
  var rendered = Mustache.render(mustacheTemplates.procCommodity, {
    randId: randId,
    commodity: procCommodity,
    eqIndex: len,
    commodities: _commodities
  });
  //console.log(len1234  //$("#haat_bazaar_procument_body").append(rendered);
  $("#tr_"+randId).append(rendered);
  /*if(randId >= 0){
    $("#tr_"+randId).append(rendered);
  }*/
  //enter numeric only
  $(".numericOnly").keydown(function(a) {
    if ($.inArray(a.keyCode, [ 46, 8, 9, 27, 13, 110 ]) !== -1 || 65 === a.keyCode && (true === a.ctrlKey || true === a.metaKey) || a.keyCode >= 35 && a.keyCode <= 40) return;
    if ((a.shiftKey || a.keyCode < 48 || a.keyCode > 57) && (a.keyCode < 96 || a.keyCode > 105)) a.preventDefault();
});
}

function RenderAnnualExpenditures(randId, expenditures, index) {

  var rendered = Mustache.render(mustacheTemplates.annualExpenditures, {
    randId: randId,
    eqIndex: index,
    expenditureNo : index + 1,
    expenditures : expenditures
  });
  $("#annual_expenditures_data").append(rendered);
}

processMustacheTemplates();

function getCommodityList(callback) {
  var url = conf.getCommodityList.url;
  var method = conf.getCommodityList.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      return callback(response);
    }
    callback(null);
  });
}

getCommodityList(function(res) {
  queryData.commodityLists = res.data;
});

function deleteCommodityItem(id) {
  if ($(".mfp-rows").length == 1) {
    return;
  }
  $("#mfpRow-" + id).remove();
}

function deleteProcCommodityItem(rand_id,id) {
  if ($(".proc-rows_"+rand_id).length == 1) {
    return;
  }
  $("#procRow-" + id).remove();
}

function populateAnnualExpenditures(data) {
  if (data && Array.isArray(data)) {
    $("#annual_expenditures_data").html('');
    for(let counter = 0; counter < 5; counter++) {
      RenderAnnualExpenditures(Date.now(), data[counter], counter);
    }
  }
}
function populateProcurementAgents(data) {
  if (data && Array.isArray(data)) {
    $("#procurement_agent_data").html('');
    data.forEach((agent, index) => {
      RenderProcurementAgent(Date.now(), agent, index);
    });
  }
}
function populateProcumentCommodities(data) {
  console.log(data);
  if (data && Array.isArray(data)) {
    $(".haat_bazaar_procument_body").html("");
    data.forEach((proc, index) => {
     // RenderProcumentCommodity(Date.now(), proc, index);
    });
  }
}

function populateMfpCommodities(data) {
  if (data && Array.isArray(data)) {
    $("#haat_bazaar_body").html("");
    data.forEach((mfp, index) => {
      RenderMfpCommodity(Date.now(), mfp, index);
    });
  }
}



function removeProcurementAgent (id) {
  if (
      $('.paGroup').length > 1 &&
      confirm('Are you sure you want to remove ?')
    ) {
    $("#pa-" + id).remove();
  }
}

function removeProcurementAgentCommodity (id) {
  if (
      $('.pacGroup').length > 1 &&
      confirm('Are you sure you want to remove ?')
    ) {
    $("#pac-" + id).remove();
  }
}


queryData.categoryIds = [
  { id: 1, title: "Buyer" },
  { id: 2, title: "Retailer" },
  { id: 3, title: "Wholesaler" }
];

$(document).on('change','.latitude',function () {
    var latitude = $(this).val();
    var decimalNumericReg = /^(-)|(\d*\.)?\d+$/;
    if(decimalNumericReg.test(latitude) == false ) {
        alert('Enter valid latitude');
        $(this).val('');
        return false;
    }
});

$(document).on('change','.longitude',function () {
    var longitude = $(this).val();
    var decimalNumericReg = /^(-)|(\d*\.)?\d+$/;
    if(decimalNumericReg.test(longitude) == false ) {
        alert('Enter valid longitude');
        $(this).val('');
        return false;
    }
});

fetchTranspotationData = () => {
  var url = conf.getTransportationList.url;
  var method = conf.getTransportationList.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      addressData = response.data;
      renderTransportaionMasters(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

function renderTransportaionMasters(data) {
  var html ="";
  $.each(data, (index, element) => {
    html += '<div class="i-checks"><label> <input type="checkbox" class="mdt_feild" value="' + element.id + '" name="transportation[]" required> <i></i>' + element.title +  "</label></div>";
    
  });
  $("#transportaion").html(html);
}
