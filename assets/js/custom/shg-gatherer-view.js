var queryFormData = {};
var editId=0;
 $(function (){
    var form = $("#form").show();
    $("#wizard").steps();
    form.steps({
        labels: {
            next: "Next",
            previous: "Previous",
            finish: "Finish"
        },
        //saveState:true,
        enableFinishButton: false,
        bodyTag: "fieldset",
        onInit: function(event, currentIndex) {
            const queryParam = window.location.search.substr(1);
            const queryObj = new URLSearchParams(queryParam);
            editId = queryObj.get("id");
            
        },
   
    });
});


    /** Processing for any  request view */
    const queryParam = window.location.search.substr(1);
    const queryObj = new URLSearchParams(queryParam);
    editId = queryObj.get('id');
    if (editId) {
        getViewOneDetails(editId);
    }

function getViewOneDetails(id) {
    var url = conf.getShgData.url + id;
    var method = conf.getShgData.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            addressData = response.data;
            populateFormFields(addressData.ShgPartOne);
          } else {
            TRIFED.showMessage("error", cb);
          }
    });
}


function populateFormFields(data) {
    $('label[for="Specify"]').hide();
    $('label[for="specify_other"]').hide();
   
     var existing_membership=  data.existing_membership;

    var d=new Date(data.dob.split("/").reverse().join("-"));
    var dd=d.getDate();
    var mm=d.getMonth()+1;
    var yyyy=d.getFullYear();
    var date = (dd+"/"+mm+"/"+yyyy);

    if(existing_membership ==  1){
        $("#shgDiv").show();
        $("#nrlm").show();
    } else {
        $("#shgDiv").hide();
        $("#nrlm").hide();
    } 

    if(data.is_self != 1){
        $('label[for="specify_other"]').show();
        $('label[for="Specify"]').show();
    }

    if(data.category ==1){
        $('label[for="st_title"]').show();
        $('label[for="schedule"]').show();
    } else if(data.category ==4){
        data.st_title = "EWS";
        $('label[for="st_title"]').show();
        $('label[for="schedule"]').show();
    }else{
        $('label[for="st_title"]').hide();
        $('label[for="schedule"]').hide();
    }


    $('label[for="financial_year"]').text(data.financial_name);
    $('label[for="name_of_tribal"]').text(data.name_of_tribal);
     $('label[for="dob"]').text(data.dob);
    $('label[for="age"]').text(data.age);
    $('label[for="id_proof"]').text(data.id_proof);
    $('label[for="yob"]').text(data.year_birth);
    $('label[for="address"]').text(data.address);
    $('label[for="id_value"]').text(data.id_value);
    $('label[for="state"]').text(data.state_name);
    $('label[for="district"]').text(data.district_name);
    $('label[for="block_name"]').text(data.block_name);
    $('label[for="gram_panchayat"]').text(data.gram_panchayat);
    $('label[for="village"]').text(data.village_name);
    $('label[for="name_of_proposal"]').text(data.name_of_proposed);
    $('label[for="pincode"]').text(data.pin_code);
    $('label[for="mother"]').text(data.mother);
    $('label[for="father"]').text(data.father);
    $('label[for="education"]').text(data.education_data);
    $('label[for="occupation"]').text(data.occupation_data);
    $('label[for="category"]').text(data.category_data);
    $('label[for="bank_name"]').text(data.bank_name);
    $('label[for="branch_name"]').text(data.branch_name);
    $('label[for="bank_ifsc"]').text(data.bank_ifsc);
    $('label[for="bank_account_no"]').text(data.bank_account_no);
    $('label[for="bank_mobile_no"]').text(data.bank_mobile_no);
    $('label[for="landline_no"]').text(data.landline_no);
    $('label[for="is_self"]').text(data.is_self == 1 ? 'Self' : 'Other');
    $('label[for="phone_type"]').text(data.phone_data);
    $('label[for="gathering_mfp"]').text(data.is_gathering_mfp == 1 ? 'Yes' : 'No');
    $('label[for="existing_membership"]').text(data.existing_membership == 1 ? 'Yes' : 'No');
    $('label[for="no_of_members"]').text(data.no_of_members);
    $('label[for="longitude"]').text(data.longitude);
    $('label[for="latitude"]').text(data.latitude);
    $('label[for="gender_name"]').text(data.gender == 'M' ? 'Male' : (data.gender == 'F' ? 'Female' : 'Other'));
    $('label[for="vehicle_type"]').text(data.vehicle_data);
    $('label[for="shg_name"]').text(data.shg_name);
    $('label[for="shg_nrlm_id"]').text(data.shg_nrlm_id);
    $('label[for="shg_other_id"]').text(data.shg_other_id);
    $('label[for="bearer_role"]').text(data.bearer_title);
    $('label[for="specify_other"]').text(data.specify_other);
    $('label[for="st_title"]').text(data.st_title);


    if (data.tribal_image && data.tribal_image.length) {
        $("#tribalimagePreview").show();
        $("#img-preview-src-tribal").attr('src', data.tribal_image);
      }

    if (data.image && data.image.length) {
        $("#id_proofPreview").show();
        $("#id_proof_image").attr('src', data.image);
      }  
      
    
    const querydata = {};
    querydata.houseHold = data.houseHold;
    var template = $("#household_members_data_template").html();
    var html = Mustache.to_html(template, querydata);
    $('#houseHoldData').html(html);

     const querydataone = {};
    querydataone.yearlyUsage = data.yearlyUsage;
    var template = $("#yearlyUsage_members_data_template").html();
    var html = Mustache.to_html(template, querydataone);
    $('#yearlyUsage').html(html);
}

