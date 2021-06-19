var formStatus;
const mustacheTemplates = {
  otherHaatBazaar: "#otherHaatBazaarTemplate",
  annualExpenditures: "#annual_expenditure_template",
  procurementAgent: "#procurement_agent_template",
  mfpCommodity: "#mfpCommodityTemplate"
};

$(function() {
  getCommodityList();
});

const queryData = {};
/* jQuery steps form validation with currentIndex */
$(document).ready(function() {
  var form = $("#formID");
  $("#wizard").steps();
  $("#formID")
    .steps({
      // enableAllSteps: true,
      enableFinishButton: false,
      labels: {
        next: "Next",
        previous: "Previous",
        finish: "Finish",
      },
      bodyTag: "fieldset",

      onInit: function(event, currentIndex) {
        let editId = 0;
        const queryParam = window.location.search.substr(1);
        const queryObj = new URLSearchParams(queryParam);
        editId = queryObj.get("id");
        populateFormData(editId);
        
      },
     
    })
   
});


/** Processing for any update request */
function populateFormData(editId) {
  var url = conf.getHaatData.url + editId;
  var method = conf.getHaatData.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      addressData = response.data;
      fillHaatMarketPartOne(addressData.HaatMarketPartOne);
      fillHaatMarketPartTwo(addressData.HaatMarketPartTwo);
      fillHaatMarketPartThree(addressData.HaatMarketPartThree);
      fillHaatMarketPartFour(addressData.HaatMarketPartFour);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
}


function fillHaatMarketPartOne(data) {
 
  $('label[for="rpm_name"]').text(data.rpm_name);
	$('label[for="rpm_location"]').text(data.rpm_location);
	$('label[for="address"]').text(data.address);
  $('label[for="state_name"]').text(data.state_name);
  $('label[for="district_name"]').text(data.district_name);
	$('label[for="block_name"]').text(data.block_name);
  $('label[for="gram_panchayat"]').text(data.gram_panchayat);
  $('label[for="village_name"]').text(data.village_name);
	$('label[for="pin_code"]').text(data.pin_code);
  $('label[for="operating_rpm"]').text(data.operating_rpm);
  $('label[for="is_on_rent"]').text(data.is_on_rent == 1 ? 'Yes' : 'No');
  $('label[for="rpm_ownerships"]').text(data.rpm_ownerships);
  $('label[for="premises_rpm"]').text(data.premises_rpm == 1 ? 'Owned' : 'Leased');
	$('label[for="rate_per_annum"]').text(data.rate_per_annum);
  $('label[for="operating_rpm"]').text(data.operating_rpm);
  $('label[for="regulation"]').text(data.regulation);
  $('label[for="regutaionType"]').text(data.regutaionType);
  $('label[for="periodicities"]').text(data.periodicities);
  $('label[for="working_days"]').text(data.working_days);
  $('label[for="sale_start_time"]').text(data.sale_start_time);
  $('label[for="sale_end_time"]').text(data.sale_end_time);
  $('label[for="nearest_railway_station"]').text(data.nearest_railway_station);
  $('label[for="railway_distance"]').text(data.railway_distance);
  $('label[for="nearest_apmc_market"]').text(data.nearest_apmc_market);
  $('label[for="apmc_distance"]').text(data.apmc_distance);
  $('label[for="nearest_bus_stand"]').text(data.nearest_bus_stand);
  $('label[for="agmarknet_node"]').text(data.agmarknet_node  == 1 ? 'Yes' : 'No');
  $('label[for="nearest_highway"]').text(data.nearest_highway);
  $('label[for="highway_distance"]').text(data.highway_distance);
  $('label[for="staff_size"]').text(data.staff_size);

  const otherHaatdata = {};
  otherHaatdata.other_haat_bazaar = data.other_haat_bazaar;
  var template = $("#otherHaatBazaarTemplate").html();
  var html = Mustache.to_html(template, otherHaatdata);
  $('#addOtherHaat').html(html);

}


function fillHaatMarketPartTwo(data) {

  $('label[for="market_name"]').text(data.market_name);
  $('label[for="market_charges"]').text(data.market_charges);
	$('label[for="market_fees"]').text(data.market_fees);
	$('label[for="broker_fees"]').text(data.broker_fees);
  $('label[for="weighing_charges"]').text(data.weighing_charges);
  $('label[for="sitting_charges"]').text(data.sitting_charges);
	$('label[for="commission_agency_charges"]').text(data.commission_agency_charges);
  $('label[for="user_charges"]').text(data.user_charges);
  $('label[for="other_charges"]').text(data.other_charges);
  $('label[for="boundary_title"]').text(data.boundary_wall_name);
	$('label[for="built_up_area_name"]').text(data.built_up_area_name);
  $('label[for="road_access"]').text(data.road_access);
  $('label[for="internal_access"]').text(data.internal_access);
  $('label[for="godown_area"]').text(data.godown_area);
	$('label[for="is_godown_secured"]').text(data.is_godown_secured == 1 ? 'Yes' : 'No');
  $('label[for="tonnage"]').text(data.tonnage);
  $('label[for="electronic_weighing_scale"]').text(data.electronic_weighing_scale == 1 ? 'Yes' : 'No');
  $('label[for="manual_weighing_scale"]').text(data.manual_weighing_scale == 1 ? 'Yes' : 'No');
  $('label[for="is_demarcated_area"]').text(data.is_demarcated_area == 1 ? 'Yes' : 'No');
  $('label[for="cleaning_area"]').text(data.cleaning_area);
  $('label[for="other_infrastructure"]').text(data.other_infrastructure);
  $('label[for="number"]').text(data.number);
  $('label[for="weigbridge"]').text(data.weigbridge == 1 ? 'Yes' : 'No');
  $('label[for="transportation_name"]').text(data.transportation_details);

}


function fillHaatMarketPartThree(data){
  $('label[for="office"]').text(data.office == 1 ? 'Yes' : 'No');
  $('label[for="drinking_water"]').text(data.drinking_water == 1 ? 'Yes' : 'No');
  $('label[for="notice_board"]').text(data.notice_board == 1 ? 'Yes' : 'No');
  $('label[for="urinal_toilet"]').text(data.urinal_toilet == 1 ? 'Yes' : 'No');
  $('label[for="electricity"]').text(data.electricity == 1 ? 'Yes' : 'No');
  $('label[for="garbage_system"]').text(data.garbage_system == 1 ? 'Yes' : 'No');
  $('label[for="parking"]').text(data.parking == 1 ? 'Yes' : 'No');
  $('label[for="input_sundry"]').text(data.input_sundry == 1 ? 'Yes' : 'No');
  $('label[for="hygienic"]').text(data.hygienic == 1 ? 'Yes' : 'No');
  $('label[for="bank"]').text(data.bank == 1 ? 'Yes' : 'No');
  $('label[for="bank_branch_name"]').text(data.bank_branch_name_title);
  $('label[for="bank_name"]').text(data.bank_name);
  $('label[for="post_office"]').text(data.post_office == 1 ? 'Yes' : 'No');
  $('label[for="post_office_name"]').text(data.post_office_name);
  $('label[for="assaying_lab"]').text(data.assaying_lab == 1 ? 'Yes' : 'No');
  $('label[for="assaying_lab_remarks"]').text(data.assaying_lab_remarks);
  $('label[for="packaging"]').text(data.packaging == 1 ? 'Yes' : 'No');
  $('label[for="packaging_remarks"]').text(data.packaging_remarks);
  $('label[for="drying_yards"]').text(data.drying_yards == 1 ? 'Yes' : 'No');
  $('label[for="drying_yards_remarks"]').text(data.drying_yards_remarks);
  $('label[for="bagging"]').text(data.bagging == 1 ? 'Yes' : 'No');
  $('label[for="bagging_remarks"]').text(data.bagging_remarks);
  $('label[for="loading"]').text(data.loading == 1 ? 'Yes' : 'No');
  $('label[for="loading_remarks"]').text(data.loading_remarks);
  $('label[for="conditioning"]').text(data.conditioning == 1 ? 'Yes' : 'No');
  $('label[for="conditioning_remarks"]').text(data.conditioning_remarks);
  $('label[for="pack_house"]').text(data.pack_house == 1 ? 'Yes' : 'No');
  $('label[for="pack_house_remarks"]').text(data.pack_house_remarks);
  $('label[for="storage_capacity"]').text(data.storage_capacity == 1 ? 'Yes' : 'No');
  $('label[for="storage_capacity_remarks"]').text(data.storage_capacity_remarks);
  $('label[for="standardisation"]').text(data.standardisation == 1 ? 'Yes' : 'No');
  $('label[for="primary_processing"]').text(data.primary_processing == 1 ? 'Yes' : 'No');
  $('label[for="primary_processing_remarks"]').text(data.primary_processing_remarks);
  $('label[for="info_display"]').text(data.info_display == 1 ? 'Yes' : 'No');
  $('label[for="info_display_remarks"]').text(data.info_display_remarks);
  $('label[for="it_infra"]').text(data.it_infra == 1 ? 'Yes' : 'No');
  $('label[for="it_infra_remarks"]').text(data.it_infra_remarks);
  $('label[for="storage"]').text(data.storage == 1 ? 'Yes' : 'No');
  $('label[for="storage_remarks"]').text(data.storage_remarks);
  $('label[for="public_address"]').text(data.public_address == 1 ? 'Yes' : 'No');
  $('label[for="public_address_remarks"]').text(data.public_address_remarks);
  $('label[for="extension"]').text(data.extension == 1 ? 'Yes' : 'No');
  $('label[for="extension_remarks"]').text(data.extension_remarks);
  $('label[for="boarding_lodging"]').text(data.boarding_lodging == 1 ? 'Yes' : 'No');
  $('label[for="standardisation_remarks"]').text(data.standardisation_remarks);
}

function fillHaatMarketPartFour(data){

  $('label[for="cleaning_and_sanitation"]').text(data.cleaning_and_sanitation == 1 ? 'Yes' : 'No');
  $('label[for="garbage_collection"]').text(data.garbage_collection == 1 ? 'Yes' : 'No');
  $('label[for="waste_utilization"]').text(data.waste_utilization == 1 ? 'Yes' : 'No');
  $('label[for="other_facility"]').text(data.other_facility == 1 ? 'Yes' : 'No');
  $('label[for="remarks"]').text(data.remarks);
  $('label[for="annual_income"]').text(data.annual_income);
  $('label[for="latitude"]').text(data.latitude);
  $('label[for="longitude"]').text(data.longitude);
  //$('label[for="nearest_apmc_distance"]').text(data.nearest_apmc_distance);


  const querydata = {};
  querydata.haat_bazaar_annual_expenditure = data.haat_bazaar_annual_expenditure;
  var template = $("#annual_expenditure_template").html();
  var html = Mustache.to_html(template, querydata);
  $('#annual_expenditures_data').html(html);

  const agentdata = {};
  var procurmentData = data.haat_bazaar_procurement_agent.haat_data;
  $.each(procurmentData, function(i, procurment) {
    var categorys = procurment.category_ids;
    let category = categorys.map(v => {
      return formType(v);
    });
    procurmentData[i].category = category;

    var commodityArray = procurment.commodity;
    var agentCommodity = '';
  
    $.each(commodities, function(i, commodity) {
      
      if(commodityArray.includes(String(commodity.id)))
      {
        agentCommodity += commodity.title+', ';
      }
    });
    procurmentData[i].commodities = agentCommodity;
  });
  agentdata.procurmentData = procurmentData;
  var template = $("#procurement_agent_template").html();
  var html = Mustache.to_html(template, agentdata);
  $('#procurement_agent_data').html(html);


  const haatMfpdata = {};
  haatMfpdata.haat_bazaar_mfp_commodities = data.haat_bazaar_mfp_commodities;
  var template = $("#mfpCommodityTemplate").html();
  var html = Mustache.to_html(template, haatMfpdata);
  $('#haat_bazaar_body').html(html);
  
}

function formType(type) {
	let types = {
		1: 'Buyer',
		2: 'Retailer',
		3: 'Wholesaler'
	}
	return types[type];
}

function getCommodityList() {
  var url = conf.getCommodityList.url;
  var method = conf.getCommodityList.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      commodities = response.data;
     
    }

  });
}

