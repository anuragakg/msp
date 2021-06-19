$(document).ready(function () {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    getStates();
    getYearMaster();    
    fetchMasterData();
    renderIdCategoryMasters();
    renderIdProofMasters();
});

var queryData = {};

fetchMasterData = () => {
  var url = conf.getMasterData.url;
  var method = conf.getMasterData.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      queryData.masterData = response.data;
      renderMasters(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

function renderMasters(masterData) {
    utils.renderOptionElements(
      '#education', 
      masterData.education 
    );

    utils.renderOptionElements(
      '#occupation', 
      masterData.occupation 
    );

    utils.renderOptionElements(
      '#vehicle_type', 
      masterData.vehicle 
    );

    renderRadioElements(
      '#phone_type', 
      masterData.phoneType, 
      'phone_type',
      'radio',
      'required'
    );
 

    utils.renderInputElements(
      '#office_bearer_role', 
      masterData.officeBearerRole, 
      'bearer_role',
      'radio'
    );

    renderRepeatedCheckboxes(
        '.memberRelationCB',
        'members',
        'relationship_with_member',
        'members_relationship_with_member',
        0,
        masterData.memberRelation
    );
};

function renderRadioElements(id, records, field = "title", type) {
    const el = $(id);
    el.html("");
    $.each(records, (index, element) => {
      el.append(
        $("<div class='i-checks radio-inline'>").append(
          $("<label>")
            .append(
              $("<input>")
                .attr("type", type)
                .attr("name", field)
                .attr("required", "required")
                .val(element.id)
            )
            .append($("<i>"))
            .append(" " + element.title)
        )
      );
    });

    $(".i-checks").iCheck({
      checkboxClass: "icheckbox_square-green",
      radioClass: "iradio_square-green",
    });
  }

$('.custom-file-input').on('change', function () {
    //let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

var editId=0;
 $(function (){
    var form = $("#form").show();


    $("#wizard").steps();
    form.steps({
        // enableAllSteps: true,
        labels: {
            next: "Save and Next",
            previous: "Previous",
            finish: "Save and Submit"
        },
        saveState:true,
        bodyTag: "fieldset",
        onInit: function(event, currentIndex) {
            householdMembersRenderer();
            householdQtyRenderer();

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
        onStepChanging: function (event, currentIndex, newIndex) {
            var form = $(this);

            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex) {
              return true;
            }

            // Forbid next action on "Warning" step if the user is to young
            if (true) {
              var data = $("#form-p-" + currentIndex).serializeArray();

              if (currentIndex == 0) {
                  data = new FormData(this);
                  if (editId) {
                      data.append('id', editId);
                  }
              }

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
        onStepChanged: function (event, currentIndex, priorIndex) {

            // Suppress (skip) "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                $(this).steps("next");
            }

            // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3) {
                $(this).steps("previous");
            }
        },
        onFinishing: function (event, currentIndex) {
            var form = $(this);

            // Disable validation on fields that are disabled.
            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
            form.validate().settings.ignore = ":disabled";
            var data = $("#form-p-" + currentIndex).serializeArray();

            // data.push({ name: "form_id", value: $("#form_id").val() });
            // Start validation; Prevent form submission if false
            formBackend = stepManagement(currentIndex, editId, data);
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            var form = $(this);

            // Submit form input
            //form.submit();
        }
    }).validate({
        errorPlacement: function errorPlacement(error, element) {

            if (element.attr("type") == "radio") {
                //error.appendTo(element.closest('i-checks radio-inline').siblings('.i-checks radio-inline'));          
                element = element.closest('.i-checks').parent();
                //error.insertAfter(element);
                error.appendTo(element);
            } else {
                element.after(error);
            }
            //error.appendTo(element.parent().siblings('.new container for errors'));
        },
        rules: {
        no_of_members: {
        required: true,
        maxlength: 1
    }
},
    messages: {
        no_of_members: {
            required: 'This field is required.',
            maxlength: 'Please enter no more than 1 digits.'
        }
    }
    });
});

function idProofFiller(clicked_data = "", id_value = "", filled_id = null) 
{
    var id_proof = $('input[name="id_type"]').val();
    var id_title = "";

    if(clicked_data != "")
      id_proof = $(clicked_data).find('input[name="id_type"]').val();
    
    if(filled_id != null)
      id_proof = filled_id;
    
    var id_proofs = queryData.masterData.idProof;
    $.each(id_proofs, (index, element) => {
      if(element.id == id_proof)
      {
        id_title = element.title;
      }
    });

    if(id_title == "Aadhaar ID") {

        $('.dy_label').html('Aadhaar ID');
        $(".common_value_id").show();
        $("#id_value1").attr('class','form-control mdt_feild numericOnly');
        $("#id_value1").attr('value','');
        $("#id_value1").attr('minLength','12');
        $("#id_value1").attr('maxLength','12');
        
    }else if(id_title == "NA") {

      $('.dy_label').html('NA');
      $(".common_value_id").show();
      $("#id_value1").attr('class','form-control');
      $("#id_value1").attr('value','');
      
  }else{
        $('.dy_label').html(id_title);
        $(".common_value_id").show();
        $("#id_value1").attr('class','form-control mdt_feild');
        $("#id_value1").attr('minLength','10');
        $("#id_value1").attr('maxLength','10');
       
    }

    $("#id_value1").val(id_value);
}

function categoryFiller(clicked_data = "", category_value = "", st_name) 
{
    var category = category_value;

    if(clicked_data != "")
        category = $(clicked_data).find('input[name="category"]').val();

    if(category == "1") {
        $("#otherAnswer").show();
        getScheduledTribesMaster(st_name);
    } else {
        $("#otherAnswer").hide();
    }
    
    if (category == "4") {
        $("#otherews").show();
    } else {
        $("#otherews").hide();
    }

    $("#category").val(category_value);
}

$(document).ready(function () {

    $(document).on('ifClicked','.id_proof',function(){
        idProofFiller($(this), "");
    });

    $(document).on('ifClicked','.common_category',function(){
        categoryFiller($(this), "");
    });

    $(document).on('ifClicked','.exist_membership',function(){

        var exist_membership = $(this).find('input[name="existing_membership"]').val();
        if(exist_membership == "1") {
            $(".addExistMembership").show();
        } else {
            $(".addExistMembership").hide();
        }
    });

    $(document).on('ifChanged','.self_or_other',function(){

        var self_or_other = $(this).find('input[name="is_self"]').val();
        if(self_or_other == "2") {
            $(".specify_other").show();
        } else {
            $(".specify_other").hide();
        }
    });

    $("#bank_mobile_no").focusout(function(){
        bankMobileChange();
    });

});

$(document).ready(function () {
    $('#data-calendar .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '-100y',
        endDate: new Date()

    });
});
$(document).ready(function(){
    $('#yearListSelect').on('change', function () {
        var dob = $('#yearListSelect').val();
        if(dob != ''){ 
            var firstdate=new Date(dob);
            var today = new Date();        
            var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
            var age = parseInt(dayDiff);
            //alert(age);
            $('#age').val(age);
        }
    });
});

$(document).ready(function() {   
       $('#bank_mobile_no').keyup(function(e){
      if($(this).val().match(/^0/)){
          $(this).val('');
          return false;
      }
});
          $('#id_value1').keyup(function(e){
      if($(this).val().match(/^0/)){
          $(this).val('');
          return false;
      }
});
     /*$("#yearListSelect").on('change', function() {
        
        var year = $("#yearListSelect").val();
        //alert(year);
       if (year) {
        //   $("#dob").removeAttr('disabled');  
            $("#dob").attr('disabled','disabled');
           $("#yearListSelect").removeAttr('disabled');   
        }
        else { 
           $("#yearListSelect").removeAttr('disabled');
           $("#dob").removeAttr('disabled');
        }

     });*/

      /*$("#dob").on('change', function() {
         
         var dob = $("#dob").val(); 
         var d = new Date(dob);
        var Year=d.getFullYear();
            
         if (dob) {
            $("#yearListSelect").attr('disabled','disabled');
            $("#dob").removeAttr('disabled');
         }
         else {
            $("#yearListSelect").removeAttr('disabled');
            $("#dob").removeAttr('disabled');
         }
 
      });

      $('#yearListSelect').on('change', function () {
        var value = $("#yearListSelect option:selected").val();
        var year = $("#yearListSelect option:selected").text();
        if(value!=''){
            $('#dob').val('');
        } else{ $('#dob').val('');}
    });*/

     $('#dob').on('change', function () {
        if (isDate($('#dob').val())) {
            var age = calculateAge(parseDate($('#dob').val()), new Date());
            //alert(age);
            if (age < 18) { 
             $('#dob').val('');                             
                TRIFED.showError('Error', 'Age must be older than 18 yrs.')
            }
             if (Number.isNaN(age) || age == "" || age === null) {
            $("#age").val(''); 
            }else
            {
                $("#age").val(age); 
            }
        } else {
            $("#age").val('');
        }
    });
     /*$('#yearListSelect').on('change', function () {
        if (this.value && Array.isArray(queryData.yearList)) {
            const selectedYear = queryData.yearList.find(v => {
                return v.id == this.value;
            })
            const year = parseInt(selectedYear.title);
            const dateObj = new Date();
            const age = dateObj.getFullYear() - year;
            if (age < 18) {
                TRIFED.showError('Error', 'You should be old enough.')
            }
            $("#age").val(age);
        }
    });*/
  });

function bankMobileChange() {
  var bank_mobile_no = $("#bank_mobile_no").val().length;
  if (bank_mobile_no >= '10') {
    $("#type_of_phone").show();
    $("#is_self").prop('required',true);
    $("#other").prop('required',true);
  }
  else {
    $("#type_of_phone").hide();
  }
}

//convert the date string in the format of dd/mm/yyyy into a JS date object
function parseDate(dateStr) {
    var dateParts = dateStr.split("/");
    return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
}

//is valid date format
function calculateAge(dateOfBirth, dateToCalculate) {
    var calculateYear = dateToCalculate.getFullYear();
    var calculateMonth = dateToCalculate.getMonth();
    var calculateDay = dateToCalculate.getDate();

    var birthYear = dateOfBirth.getFullYear();
    var birthMonth = dateOfBirth.getMonth();
    var birthDay = dateOfBirth.getDate();

    var age = calculateYear - birthYear;
    var ageMonth = calculateMonth - birthMonth;
    var ageDay = calculateDay - birthDay;

    if (ageMonth < 0 || (ageMonth == 0 && ageDay < 0)) {
        age = parseInt(age) - 1;
    }
    return age;
}

function isDate(txtDate) {
    var currVal = txtDate;
    if (currVal == '')
        return true;

    //Declare Regex
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null)
        return false;

    //Checks for dd/mm/yyyy format.
    var dtDay = dtArray[1];
    var dtMonth = dtArray[3];
    var dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay > 31)
        return false;
    else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
        return false;
    else if (dtMonth == 2) {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay > 29 || (dtDay == 29 && !isleap))
            return false;
    }

    return true;
}
const mastersData = {};


getStates = () => {
    var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            renderOptionElements('#state', response.data);
        }
    });
}
getDistricts = (id = 0) => {
    var url = conf.getDistricts.url;
    var method = conf.getDistricts.method;
    var data = {
        state_id: id
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            renderOptionElements('#district', response.data);
        }
    });
}

getBlocks = (id = 0) => {
    var url = conf.getBlocks.url;
    var method = conf.getBlocks.method;
    var data = {
        district_id: id,
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            renderOptionElements('#block', response.data);
        }
    });
}

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

function getYearMaster() {
    var url = conf.getYearList.url;
    var method = conf.getYearList.method;
    var data = {

    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            queryData.yearList = response.data;
            renderOptionElements('#yearListSelect', response.data);
        }
    });
}

function getScheduledTribesMaster(st_id = null) {
    var url = conf.getScheduledTribesList.url;
    var method = conf.getScheduledTribesList.method;
    var data = {
        state_id : $('#state').val()
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            renderOptionElements('#st_name', response.data, st_id);
        }
    });
}


/**
 * Renders option element
 * @param {string} id ID
 * @param {Array} records 
 */
function renderOptionElements(id, records, selected_id = null) {
    const el = $('select' + id);
    _renderOptions(el, records, selected_id);
}

function _renderOptions(el, records, selected_id = null) {
    el.html('');
    el.append($('<option value="">').text('Please Select'));
    records.forEach(element => {
        if(element.id == selected_id)
        {
          el.append($('<option selected>').val(element.id).text(element.title));
        }
        else
        {
          el.append($('<option>').val(element.id).text(element.title));
        }
    });
}

/**
 * Renders checkbox element
 * @param {string} id ID
 * @param {Array} records
 */
function renderCheckboxElements(id, name, records) {
    const el = $(id);
    _renderCheckboxes(el, records, name);
}

function _renderCheckboxes(el, records, name) {
    el.html('');
    records.forEach(element => {
        let $div = $('<div>').attr('class', 'i-checks radio-inline');
        let $label = $('<label>');
        let $input = $('<input>').attr({
            type: 'radio',
            name: name
        }).val(element.id);
        let $span = $('<span>').text(element.title);
        $div.html($label.html($input).append($span));
        el.append($div);
        // Render Checkbox
        $div.iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
}

/**
 * Render Repeated checkbox elements
 * @param {string|number} id 
 * @param {string} group 
 * @param {string} name 
 * @param {string} className 
 * @param {number} iteration 
 * @param {Array} records 
 */
function renderRepeatedCheckboxes(id, group, name, className, iteration, records) {
    const el = $(id);
    _renderMultipleCBoxes(el, records, group, iteration, name, className);
}

$(document).ready(function () {
    $('#state').on('change', function (ev) {
        const v = $(this).val();
        getDistricts(v);
    })
    $('#district').on('change', function (ev) {
        const v = $(this).val();
        getBlocks(v);
    })

    $('#pin_code').keyup(function (ev) {
      const v = $(this).val();
      utils.fetchVillage(v);
    })
})

function _renderMultipleCBoxes(el, records, group, iteration, name, className) {
    el.html('');
    records.forEach(element => {
        let $div = $('<div>').attr('class', 'i-checks radio-inline');
        let $label = $('<label>');
        let $input = $('<input>').attr({
            type: 'radio',
            name: `${group}[${iteration}][${name}]`,
            class: className
        }).val(element.id);
        let $span = $('<span>').text(element.title);
        $div.html($label.html($input).append($span));
        el.append($div);
        // Render Checkbox
        $div.iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
}

function stepManagement(currentIndex, formID, formData) {
  const formDetails = ["One", "Two"],
    formName = "ShgPart";

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

  if(currentIndex != 0) {
    request.data.push({ name : "shg_id", value : queryData.formID ? queryData.formID : "" });
    
    TRIFED.asyncAjaxHit(request.url, request.method, request.data, function(response) {

        if (response.status == 1) {
          // queryData.formID = response.data.id;
          TRIFED.showMessage("success", "Successfully Added");
          if (currentIndex == 1) {
            setTimeout(() => {
              document.location = "../fund-management/mfp_procurement_pa_received_fund.php";
            }, 1000);
          }
        } else {
          TRIFED.showError("error", response.message);
          status = false;
        }

    });
  }
  else {
    console.log(request.data);
        request.data.set("id", queryData.formID);
        TRIFED.fileAjaxHit(request.url, request.method, request.data, function(response) {

            if (response.status == 1) {
              setTimeout(() => {
                queryData.formID = response.data.id;
                if(editId != null)
                {
                  TRIFED.showMessage("success", "Successfully Updated");
                }
                else{
                  TRIFED.showMessage("success", "Successfully Added");
                }
              }, 1000);
            } else {
              TRIFED.showError("error", response.message);
              status = false;
            }
        });
    }

    return status;
}

function responseHandler(response) {
    let status = true;

    if (response.status == 1) {
      setTimeout(() => {
        queryData.formID = response.data.id;
        if(editId != null)
        {
          TRIFED.showMessage("success", "Successfully Updated");
        }
        else{
          TRIFED.showMessage("success", "Successfully Added");
        }
      }, 1000);
    } else {
      TRIFED.showError("error", response.message);
      status = false;
    }

    return status;
}

function stepManagementView(currentIndex, formID) {

  let request = {
    apiName: "getShg",
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

queryData.gender = [
  { code: "M", title: "Male" },
  { code: "F", title: "Female" },
  { code: "O", title: "Other" }
];

queryData.isGatheringMfp = [
  { code: "1", title: "Yes" },
  { code: "0", title: "No" }
];


function fillShgPartOne(apiData) {
  getDistricts(apiData.state);
  getBlocks(apiData.district);
  getVillageMaster(apiData.pin_code, apiData.village);

    $('#no_of_proposed').val(apiData.name_of_proposed);
    $('#financial_year').val(apiData.financial_year).trigger('change');
  let types = { radio: "radio", textbox: "textbox", select: "select" };
  let data = {
    name_of_tribal: types.textbox,
    dob: types.textbox,
    birth_year: types.select,
    age: types.textbox,
    id_type: types.radio,
    father: types.textbox,
    mother: types.textbox,
    address: types.textbox,
    pin_code: types.textbox,
    gram_panchayat: types.textbox,
    shg_name: types.textbox,
    shg_nrlm_id: types.textbox,
    shg_other_id: types.textbox,
    st_name: types.select,
    bank_name: types.textbox,
    bank_account_no: types.textbox,
    branch_name: types.textbox,
    bank_ifsc: types.textbox,
    bank_mobile_no: types.textbox,
    landline_no: types.textbox,
    specify_other: types.textbox,
    state: types.select,
    district: types.select,
    block: types.select,
    village: types.select,
    education: types.select,
    occupation: types.select,
    vehicle_type: types.select,
    existing_membership: types.radio,
    bearer_role: types.radio,
    category: types.radio,
    is_ews: types.radio,
    is_married: types.radio,
    is_gathering_mfp: types.radio,
    phone_type: types.radio,
    is_self: types.radio,
    gender: types.radio
  };

  if (apiData.image && apiData.image.length) {
      $("#imagePreview").show();
      $("#img-preview-src").attr('src', apiData.image);
  }


  if (apiData.tribal_image && apiData.tribal_image.length) {
    $("#tribalimagePreview").show();
    $("#img-preview-src-tribal").attr('src', apiData.tribal_image);
  }


  $("#yearListSelect")
  .find('option[value="' + apiData.birth_year + '"]')
  .attr('selected', 'selected')
  .trigger('change');

  if(apiData.existing_membership == 1)
    $(".addExistMembership").show();

  idProofFiller("", apiData.id_value, apiData.id_type);
  inputFieldHandler(data, apiData);
  categoryFiller("", apiData.category, apiData.st_name);
  bankMobileChange();

}

function fillShgPartTwo(apiData) { 
    $('#no_of_members').val(apiData.no_of_members);
    $('#latitude').val(apiData.latitude);
    $('#longitude').val(apiData.longitude);
    populateShgHouseholdMember(apiData.members);
    populateShgMfpYearlyGathering(apiData.yearly_usage);
}

function populateShgHouseholdMember(data) {
  if (data && Array.isArray(data)) {
    $("#other_household_members_container").html("");
    data.forEach((members, index) => {
      RenderHouseholdMembers(Date.now(), members);
    });
  }
}

function populateShgMfpYearlyGathering(data) {
  if (data && Array.isArray(data)) {
    $("#other_household_qty_container").html("");
    data.forEach((qty, index) => {
      RenderHouseholdQty(Date.now(), qty);
    });
  }
}

function inputFieldHandler(data, apiData) {
  $.each(data, function(key, value) {
    if (value === "radio") {
      $('input[name="' + key + '"][value="' + apiData[key] + '"]').iCheck(
        "check"
      );
    } else if (value === "textbox") {
      $("#" + key).val(apiData[key]);
    } else if (value === "select") {
      $("#" + key).val(apiData[key]).trigger('change');
    } else if (value === "checkbox") {
      $('input[name="' + key + '"][value="' + apiData[key] + '"]').iCheck(
        "check"
      );
    }
  });
}

//========= SHG Gatherer's Household Members ADD MORE =======

function householdMembersRenderer(other_household_members = "") {
  var arr = [];
  var random_household_members_id = Date.now();
  $('#no_of_members').keyup(function (){
    var total = $(this).val(); 
    const alreadyPresent = $('.delete_household_members').length; 
    let iterateTo = parseInt(total);

 
    
    if (total > alreadyPresent) {
      iterateTo = total - alreadyPresent;
    }else{ 
        for(var i=0; i < parseInt(arr.length);i++){
            $("#delete_household_members"+arr[i]).remove();
        }  
        }   

    if(total!="" && total< 10){   
        for(var i=0; i < iterateTo; i++){
            random_household_members_id = Date.now();
             RenderHouseholdMembers(random_household_members_id);
             arr.push(random_household_members_id);
        }
    }else{ 
        for(var i=0; i < parseInt(arr.length);i++){
            $("#delete_household_members"+arr[i]).remove();
        }       

    }

       if (
      (total == alreadyPresent) ||
      (alreadyPresent >= 9) || 
      (alreadyPresent >= total)
    ) {
      return;
    }
  });

  if(other_household_members!=null &&  other_household_members.length)
  {  
    var household_members_row=0;
    $.each(other_household_members,function(key,HouseholdMembersData){
      ++household_members_row;
      random_household_members_id = household_members_row;
      RenderHouseholdMembers(random_household_members_id,HouseholdMembersData);
    });
  }else
  {
    HouseholdMembersData={}; 
  }
} 
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    /* calendar using datepicker */
    $(document).ready(function(){
    $('#data-calendar .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        startDate: '-100y',
        endDate: new Date()
     });    
    });
    
    $(".numericOnly").keydown(function (e) {
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

function RenderHouseholdMembers(random_household_members_id,HouseholdMembersData) 
  {
    if (HouseholdMembersData == "") {
        return;
    }
    const education = queryData.masterData.education;
    const occupation = queryData.masterData.occupation;
    const gender = queryData.gender;
    const memberRelation = queryData.masterData.memberRelation;
    const isGatheringMfp = queryData.isGatheringMfp;


    if(HouseholdMembersData) {

        education.forEach(v => {
          v.sel = false;
          if (v.id == HouseholdMembersData.education) {
            v.sel = true;
          }
        });

        occupation.forEach(v => {
          v.sel = false;
          if (v.id == HouseholdMembersData.occupation) {
            v.sel = true;
          }
        });

        gender.forEach(v => {
          v.sel = false;
          if (v.code == HouseholdMembersData.gender) {
            v.sel = true;
          }
        });

        memberRelation.forEach(v => {
          v.sel = false;
          if (v.id == HouseholdMembersData.relationship_with_member) {
            v.sel = true;
          }
        });

        isGatheringMfp.forEach(v => {
          v.sel = false;
          if (v.id == HouseholdMembersData.is_gathering_mfp) {
            v.sel = true;
          }
        });

    }

    var source = $("#household_members_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_household_members_id: random_household_members_id,
      item: HouseholdMembersData,
      education: education,
      occupation: occupation,
      gender: gender,
      memberRelation: memberRelation,
      isGatheringMfp: isGatheringMfp
    });

    $("#other_household_members_container").append(rendered);
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $('#data-calendar .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        startDate: '-100y',
        endDate: new Date()
     });

    handleDOBChanged(random_household_members_id);

    var count = $(".delete_household_members").length;
    other_household_members_no_inc();
    delete_household_members(random_household_members_id);
 }

//listener on date of birth field
function handleDOBChanged(random_household_members_id) {
    $("#dob_"+ random_household_members_id).on('change', function () {
        if (isDate($("#dob_"+ random_household_members_id).val())) {
            var age1 = calculateAge(parseDate($("#dob_"+ random_household_members_id).val()), new Date());
            $("#age_"+ random_household_members_id).val(age1);
        } else {
            $("#age_"+ random_household_members_id).val('');
        }
    });
}

//convert the date string in the format of dd/mm/yyyy into a JS date object
function parseDate(dateStr) {
    var dateParts = dateStr.split("/");
    return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
}

//is valid date format
function calculateAge(dateOfBirth, dateToCalculate) {
    var calculateYear = dateToCalculate.getFullYear();
    var calculateMonth = dateToCalculate.getMonth();
    var calculateDay = dateToCalculate.getDate();

    var birthYear = dateOfBirth.getFullYear();
    var birthMonth = dateOfBirth.getMonth();
    var birthDay = dateOfBirth.getDate();

    var age1 = calculateYear - birthYear;
    var ageMonth = calculateMonth - birthMonth;
    var ageDay = calculateDay - birthDay;

    if (ageMonth < 0 || (ageMonth == 0 && ageDay < 0)) {
        age1 = parseInt(age1) - 1;
    }
    return age1;
}

function isDate(txtDate) {
    var currVal = txtDate;
    if (currVal == '')
        return true;

    //Declare Regex
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null)
        return false;

    //Checks for dd/mm/yyyy format.
    var dtDay = dtArray[1];
    var dtMonth = dtArray[3];
    var dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay > 31)
        return false;
    else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
        return false;
    else if (dtMonth == 2) {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay > 29 || (dtDay == 29 && !isleap))
            return false;
    }

    return true;
}
  function other_household_members_no_inc(){
    var other_proposed_shgs_no=0;
    $('.other_proposed_shgs_no').each(function(){
      ++other_proposed_shgs_no;
      $(this).html(other_proposed_shgs_no);
    });
    var count = $(".delete_household_members").length;
    
    if(count>1){
      $('.remove_household_members').show();
    }else{
      $('.remove_household_members').first().hide();   
    }
  
  }
  
  function delete_household_members(random_household_members_id) 
  {
    $("#remove_household_members"+random_household_members_id).click(function (){
    var data_id=$(this).attr('data_id');
    var count = $(".delete_household_members").length;
      if (count > 1) {
    
        $("#delete_household_members" + random_household_members_id).remove();
        $("#no_of_members").val(count - 1); // update field value to new members count.
        other_household_members_no_inc(); 
      } 
    }); 
  }


//========= SHG Gatherer's Approximate Quantity of MFPs Currently Gathering ADD MORE =======

function householdQtyRenderer(other_household_qty = "") {
  var random_household_qty_id = Date.now();

  $('#add_household_qty').unbind().click(function (){
    random_household_qty_id = Date.now();
    RenderHouseholdQty(random_household_qty_id);             
  });

  if(other_household_qty!=null &&  other_household_qty.length)
  {  
    var household_members_qty_row=0;
    $.each(other_household_qty,function(key,HouseholdQtyData){
      ++household_members_qty_row;
      random_household_qty_id = household_members_qty_row;
      RenderHouseholdQty(random_household_qty_id,HouseholdQtyData);
    });
  }else
  {
    HouseholdQtyData={};
    RenderHouseholdQty(random_household_qty_id,HouseholdQtyData);
  }
}

  function RenderHouseholdQty(random_household_qty_id,HouseholdQtyData) 
  {
    if ($(".other_household_qty_no").length > 0 && HouseholdQtyData == "") {
        return;
    }

    const commodity = queryData.masterData.commodity;
    const mfpUse = queryData.masterData.mfpUse;

    

    if(HouseholdQtyData) {

        commodity.forEach(v => {
          v.sel = false;
          if (v.id == HouseholdQtyData.commodity) {
            v.sel = true;
          }
        });

        mfpUse.forEach(v => {
          v.sel = false;
          if ($.inArray(String(v.id), HouseholdQtyData.mfp_use) > -1) {
            v.sel = true;
          }
        });
    }

    var source = $("#household_qty_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_household_qty_id: random_household_qty_id,
      item: HouseholdQtyData,
      mfpUse: mfpUse,
      commodity: commodity
    });
      
    $("#other_household_qty_container").append(rendered);
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    var count = $(".delete_household_qty").length;
    other_household_qty_no_inc();
    delete_household_qty(random_household_qty_id);
  }
    
   $(".numericOnly").keydown(function (e) {
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
  
  function other_household_qty_no_inc(){
    var other_household_qty_no=0;
    $('.other_household_qty_no').each(function(){
      ++other_household_qty_no;
      $(this).html(other_household_qty_no);
    });
    var count = $(".delete_household_qty").length;
    
    if(count>1){
      $('.remove_household_qty').show();
    }else{
      $('.remove_household_qty').first().hide();   
    }
  
  }
  
  function delete_household_qty(random_household_qty_id) 
  {
    $("#remove_household_qty"+random_household_qty_id).click(function (){
    var data_id=$(this).attr('data_id');
    var count = $(".delete_household_qty").length;
      if (count > 1) {
    
        $("#delete_household_qty" + random_household_qty_id).remove();
        other_household_qty_no_inc();  
      } 
    }); 
  }


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

/* Check for file size and file format */
  checkFile = id => {
  var files = document.getElementById(id).value;
  var idxDot = files.lastIndexOf(".") + 1;
  var extFile = files.substr(idxDot, files.length).toLowerCase();
  if (extFile == "jpg" || extFile == "jpeg") {
    var fi = document.getElementById(id);
    // Check if any file is selected.
    if (fi.files.length > 0) {
      for (var i = 0; i <= fi.files.length - 1; i++) {
        var fsize = fi.files.item(i).size;
        var file = Math.round(fsize / 1024);
        // The size of the file.

        if (file >= 5120) {
          alert("File too big, please select a file less than 5mb");
          $("#" + id).val("");
        } else {
          // document.getElementById('size').innerHTML = '<b>' + file + '</b> KB';
        }
      }
    }
  } else {
    alert("Only jpg file is allowed!");
    $("#" + id).val("");
  }
};

function renderIdProofMasters() {
  var data = queryData.masterData.idProof;
  var html ="";
  $.each(data, (index, element) => {
    html += '<div class="i-checks radio-inline id_proof"><label><input type="radio" value="' + element.id + '" " name="id_type" class="mdt_feild" required><i></i> ' + element.title +  '</label></div>';
    
  });
  $("#id_proof_type").html(html);
}

function renderIdCategoryMasters() {
  var data = queryData.masterData.category;
  var html ="";
  $.each(data, (index, element) => {
    html += '<div class="i-checks radio-inline common_category"><label><input type="radio" value="' + element.id + '" " name="category" required><i></i> ' + element.title +  '</label></div>';
    
  });
  $("#category").html(html);
} 