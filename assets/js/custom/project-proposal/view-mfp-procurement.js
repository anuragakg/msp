var url_var=getUrlVars();
$(function(){
result_data='';
    
    
    if(url_var['id']!=undefined)
    {
        form_id=url_var['id'];
        form_data=fetchFormData(form_id);
        if(form_data.consolidated_id !=null){
            $('#approve').hide();
        }else{
            $('#approve').show();
        }
        $('#proposal_id').html(form_data.proposal_id)
        fetchCommodityData(form_id); 
        mfpdata=form_data.mfp_coverage;
        seasonalitydata=form_data.mfp_seasonality;
        mfpDisposalData = form_data.getMfpDisposal;
        labourChargesData = form_data.getMfpLabourCharges;
        MfpCollectionLevel = form_data.getMfpCollectionLevel;
        MfpWeightmentCharges = form_data.getMfpWeightmentCharges;
        transportationChargesData = form_data.getMfpTransportationCharges;
        serviceChargesData = form_data.getMfpServiceCharges;
        serviceChargesDiaData = form_data.getMfpServiceChargesDIA;
        otherCostData = form_data.getMfpOtherCosts,
        $('#year_id').html(form_data.financialYear)
        random_seasonality_id=0;
        random_mfp_coverage_id=0;
        random_collection_level_id=0;
        random_weightment_charges_id=0;
        random_disposal_id = 0 ;
        random_labour_charges_id = 0 ;
        random_transportation_charges_id = 0 ;
        random_service_charges_id = 0 ;
        random_service_charges_dia_id = 0 ;
        random_other_cost_id = 0 ;

        $.each(mfpdata, function(key, itemdata) {
            ++random_mfp_coverage_id;
            RenderMfpCoverage(random_mfp_coverage_id, itemdata);
        });
        $.each(seasonalitydata, function(key, itemdata) {
            ++random_seasonality_id;
            RenderSeasonality(random_seasonality_id, itemdata);
        });
        $.each(mfpDisposalData, function(key, itemdata) {
          ++random_disposal_id;
          RenderMfpDisposalData(random_disposal_id, itemdata);
        });
        $.each(labourChargesData, function(key, itemdata) {
          ++random_labour_charges_id;
          RenderLabourCharges(random_labour_charges_id, itemdata);
        });
        $.each(MfpCollectionLevel, function(key, itemdata) {
          ++random_collection_level_id;
          RenderPackingMaterial(random_collection_level_id, itemdata);
        });
        $.each(MfpWeightmentCharges, function(key, itemdata) {
          ++random_weightment_charges_id;
          RenderWeightmentCharges(random_weightment_charges_id, itemdata);
        });
        $.each(transportationChargesData, function(key, itemdata) {
          ++random_transportation_charges_id;
          RenderTransportationCharges(random_transportation_charges_id, itemdata);
        });
        $.each(serviceChargesData, function(key, itemdata) {
          ++random_service_charges_id;
          RenderServiceCharges(random_service_charges_id, itemdata);
        });
        //warehouse level
        $.each(form_data.getMfpWarhouseLabourCharges, function(key, itemdata) {
          ++random_service_charges_dia_id;
          RenderWarehouseLabourCharges(random_service_charges_dia_id, itemdata);
        });
        $.each(form_data.getMfpWarhouseCharges, function(key, itemdata) {
          ++random_service_charges_dia_id;
          RenderWarehouseCharges(random_service_charges_dia_id, itemdata);
        });
        $.each(form_data.getMfpEstimatedWastages, function(key, itemdata) {
          ++random_service_charges_dia_id;
          RenderEstimatedWastage(random_service_charges_dia_id, itemdata);
        });
        $.each(serviceChargesDiaData, function(key, itemdata) {
          ++random_service_charges_dia_id;
          RenderServiceChargesDia(random_service_charges_dia_id, itemdata);
        });
        $.each(otherCostData, function(key, itemdata) {
          ++random_other_cost_id;
          RenderOtherCosts(random_other_cost_id, itemdata);
        });
//for step 4 preview
fetchCostOfPackagingMaterial(url_var['id']);
fetchEstimatedProcurement(url_var['id'])
getEstimatedQuarterlyRequirement(url_var['id']);


//To populate Mfp Name from step 1
$(".row-1-column-2").html('Estimated Procurement <b>' + form_data.financialYear + '</b>');
if (form_data.mfp_coverage && form_data.mfp_coverage != null && form_data.mfp_coverage != '') {
    var mfp_coveragedata = form_data.mfp_coverage;
    var index = 3;
    var html = '';
	var html1 = '';
    $.each(mfp_coveragedata, function (key, itemdata) {
        html += '<th scope="col" mfp_id="' + itemdata.mfp_id + '" >' + itemdata.getMfpData.title + '</th>';
        $(".estimated-procurement").append('<td style="text-align:right;">NA</td>');
        $(".cost-of-packing-material").append('<td style="text-align:right;"></td>');
        $(".weighment-charges").append('<td style="text-align:right;"></td>');
        $(".labour-charges").append('<td style="text-align:right;"></td>');
        $(".transportation-charges").append('<td style="text-align:right;"></td>');
        $(".service-charges").append('<td style="text-align:right;"></td>');
        $(".warehouse-labour-charges").append('<td style="text-align:right;"></td>');
        $(".warehouse-charges").append('<td style="text-align:right;"></td>');
        $(".estimated-wastages").append('<td style="text-align:right;"></td>');
        $(".service-charges-dia").append('<td style="text-align:right;"></td>');
        $(".other-costs").append('<td style="text-align:right;"></td>');
        $(".auto-sum").append('<td style="text-align:right;"></td>');
        $(".fund-requirement tr td:nth-child(" + index + ")").attr('mfp_id', itemdata.mfp_id);
        $(".quarter-1").append('<td style="text-align:right;"></td>');
        $(".quarter-2").append('<td style="text-align:right;"></td>');
        $(".quarter-3").append('<td style="text-align:right;"></td>');
        $(".quarter-4").append('<td style="text-align:right;"></td>');
        $(".auto-sum-estimated-quarterly").append('<td style="text-align:right;"></td>');
        $(".estimated-quarterly-requirement tr td:nth-child(" + index + ")").attr('mfp_id', itemdata.mfp_id);
		
		html1 += '<th scope="col" mfp_id="' + itemdata.mfp_id + '" ></th>';
        index++;
    });
    $(html).insertAfter(".activity");
	  $(html1).insertAfter(".activity1");
    $(html).insertAfter(".quarter");
	  $(html1).insertAfter(".quarter1");


}

//auto fill mfp procurement
if (estimatedProcurement != null && estimatedProcurement != '') {
    $.each(estimatedProcurement, function (key, itemdata) {
      estimated_procurement = parseFloat(itemdata.estimated_procurement)
        $(".estimated-procurement td[mfp_id=" + itemdata.commodity_id + "]").html(estimated_procurement.toFixed(4));
    });
}

//auto fill cost of packaging material
if (CostOfPackagingMaterial != null && CostOfPackagingMaterial != '') {
  total_cost_of_packaging_material = {};
    $.each(CostOfPackagingMaterial, function (key, itemdata) {
     
      if(itemdata.mfp_id in total_cost_of_packaging_material){
        total_cost_of_packaging_material[itemdata.mfp_id ] =   total_cost_of_packaging_material[itemdata.mfp_id ]  + itemdata.total_cost_of_packaging_material;
      }else{
        total_cost_of_packaging_material[itemdata.mfp_id ] = itemdata.total_cost_of_packaging_material;
      }
        total_cost_of_packaging_materials = parseFloat(total_cost_of_packaging_material[itemdata.mfp_id]);
        $(".cost-of-packing-material td[mfp_id=" + itemdata.mfp_id + "]").html( total_cost_of_packaging_materials.toFixed(4));
    });
}

//auto fill weighment charges
if (form_data.getMfpWeightmentCharges && form_data.getMfpWeightmentCharges != null && form_data.getMfpWeightmentCharges != '') {
   
    $.each(form_data.getMfpWeightmentCharges, function (key, itemdata) {
      total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
        $(".weighment-charges td[mfp_id=" + itemdata.mfp + "]").html(total_estimated_cost.toFixed(4));

    });
}

//auto fill labour charge cost by mfp id
if (form_data.getMfpSummary && form_data.getMfpSummary != null && form_data.getMfpSummary != '') {
     total_fund_require = parseFloat(form_data.getMfpSummary.total_fund_require);
    $("#any_other_available").val(form_data.getMfpSummary.any_other_available);
    $("#old_fund_require").val(form_data.getMfpSummary.old_fund_require);
    $("#total_fund_require").val(total_fund_require.toFixed(4));
}
//auto fill labour charge cost by mfp id
if (form_data.getMfpLabourCharges && form_data.getMfpLabourCharges != null && form_data.getMfpLabourCharges != '') {
    $.each(form_data.getMfpLabourCharges, function (key, itemdata) {
       total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
        $(".labour-charges td[mfp_id=" + itemdata.mfp + "]").html(total_estimated_cost.toFixed(4));
    });
}
//auto fill tranportation charge cost by mfp id
if (form_data.getMfpTransportationCharges && form_data.getMfpTransportationCharges != null && form_data.getMfpTransportationCharges != '') {
    $.each(form_data.getMfpTransportationCharges, function (key, itemdata) {
        $(".transportation-charges td[mfp_id=" + itemdata.mfp + "]").html(parseFloat(itemdata.estimated_total_cost_of_transportation).toFixed(4));
    });
}
//auto fill service charge cost by mfp id
if (form_data.getMfpServiceCharges && form_data.getMfpServiceCharges != null && form_data.getMfpServiceCharges != '') {
    $.each(form_data.getMfpServiceCharges, function (key, itemdata) {
      service_charge_in_total_value_of_procurement = parseFloat(itemdata.service_charge_in_total_value_of_procurement);
        $(".service-charges td[mfp_id=" + itemdata.mfp + "]").html(service_charge_in_total_value_of_procurement.toFixed(4));
    });
}
//auto fill warehouse labour charge cost by mfp id
if (form_data.getMfpWarhouseLabourCharges && form_data.getMfpWarhouseLabourCharges != null && form_data.getMfpWarhouseLabourCharges != '') {
    $.each(form_data.getMfpWarhouseLabourCharges, function (key, itemdata) {
      itemdata.total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
        $(".warehouse-labour-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost.toFixed(4));
    });
}
//auto fill warehouse charge cost by mfp id
if (form_data.getMfpWarhouseCharges && form_data.getMfpWarhouseCharges != null && form_data.getMfpWarhouseCharges != '') {
    $.each(form_data.getMfpWarhouseCharges, function (key, itemdata) {
      total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
        $(".warehouse-charges td[mfp_id=" + itemdata.mfp + "]").html(total_estimated_cost.toFixed(4));
    });
}
//auto fill estimated wastages cost by mfp id
if (form_data.getMfpEstimatedWastages && form_data.getMfpEstimatedWastages != null && form_data.getMfpEstimatedWastages != '') {
    $.each(form_data.getMfpEstimatedWastages, function (key, itemdata) {
      estimated_driage_rs = parseFloat(itemdata.estimated_driage_rs);
        $(".estimated-wastages td[mfp_id=" + itemdata.mfp + "]").html(estimated_driage_rs.toFixed(4));
    });
}

//auto fill service charge by mfp id
if (form_data.getMfpServiceChargesDIA && form_data.getMfpServiceChargesDIA != null && form_data.getMfpServiceChargesDIA != '') {
    $.each(form_data.getMfpServiceChargesDIA, function (key, itemdata) {
        $(".service-charges-dia td[mfp_id=" + itemdata.mfp_id + "]").html(parseFloat(itemdata.service_charge_value).toFixed(4));
    });
}

//auto fill other cost by mfp id
if (form_data.getMfpOtherCosts && form_data.getMfpOtherCosts != null && form_data.getMfpOtherCosts != '') {
    $.each(form_data.getMfpOtherCosts, function (key, itemdata) {
        $(".other-costs td[mfp_id=" + itemdata.mfp_id + "]").html(parseFloat(itemdata.other_cost).toFixed(4));
    });
}

if (form_data.mfp_coverage && form_data.mfp_coverage != null && form_data.mfp_coverage != '') {
    var mfp_coveragedata = form_data.mfp_coverage;
    $.each(mfp_coveragedata, function (key, itemdata) {
        calculateAutoSum(itemdata.mfp_id)
    });
    totalFundRequire();

}


 if ( !estimatedQuarterlyRequirement!= null && estimatedQuarterlyRequirement != '') {
    total = {};
    mfps = [];
    $.each(estimatedQuarterlyRequirement, function (key, itemdata) {
        $.each(itemdata, function (key1, itemdata1) {
            if(key == 'Quarter 1'){
                $(".quarter-1 td[mfp_id=" + key1+ "]").html(itemdata1);
            }
            if(key == 'Quarter 2'){
                $(".quarter-2 td[mfp_id=" + key1+ "]").html(itemdata1);
            }
            if(key == 'Quarter 3'){
                $(".quarter-3 td[mfp_id=" + key1+ "]").html(itemdata1);
            }
            if(key == 'Quarter 4'){
                $(".quarter-4 td[mfp_id=" + key1+ "]").html(itemdata1);
            }
            if (total[key1] == undefined || total[key1] == NaN) {
                total[key1] = 0;
            }
            if (!isNaN(itemdata1)) {
                total[key1] = total[key1] + parseFloat(itemdata1);
            }
        
            $(".auto-sum-estimated-quarterly td[mfp_id=" + key1 + "]").html('<b>'+total[key1].toFixed(4)+'</b>');
        });
      
    });


}

        
    }
});

fetchFormData=(form_id)=>{
    var url = conf.getProcurementDetail.url(form_id);
        var method = conf.getProcurementDetail.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) 
            {
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

fetchCommodityData=(form_id)=>{
    var url = conf.getMfpProcurementPlanDetail.url(form_id);
        var method = conf.getMfpProcurementPlanDetail.method;
        var data = {}; 
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
            result_data = response.data;   
            //fetchSecondFormData(result_data.id);
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
        return data;
}
/*
fetchSecondFormData=(form_id)=>{
    var url = conf.getMfpProcurementPartTwo.url(form_id);
        var method = conf.getMfpProcurementPartTwo.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
            formData = response.data; 
            mfpProcurementData=response.data.mfp_commodity;     
            }  
        });
        return data;
}*/
function RenderMfpCoverage(random_mfp_coverage_id, itemsdata) {
    var labels_no = $(".delete_mfp_coverage").length;
    ++labels_no;
    var source = $("#mfp_coverage_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_coverage_id: random_mfp_coverage_id,
        itemdata: itemsdata,
    });
    $("#mfp_coverage_container").append(rendered);
    
    mfp_coverage_no_inc();
    
    if(itemsdata!='' && itemsdata!=null)
    {
        $('#mfp_coverage_mfp_name_'+random_mfp_coverage_id).val(itemsdata.mfp_id)
        MfpCoverageBlocksHaatData=itemsdata.block_haat_data;
        $.each(MfpCoverageBlocksHaatData, function(key, itemdata) {
            
            RenderMfpCoverageBlockHaat(random_mfp_coverage_id,itemdata) 
        });
           
    }else{
        MfpCoverageBlocksHaatData=[];
        RenderMfpCoverageBlockHaat(random_mfp_coverage_id,MfpCoverageBlocksHaatData)    
    }

    RenderMfpEstimatedLosses(random_mfp_coverage_id, itemsdata)
}
function RenderMfpCoverageBlockHaat(random_mfp_coverage_id, itemsdata) {
    var labels_no = $(".delete_mfp_coverage").length;
    ++labels_no;
    var source = $("#mfp_coverage_block_haat_template").html();
    Mustache.parse(source);
    var random_mfp_coverage_block_haat_id = Date.now();
    var rendered = Mustache.render(source, {
        random_mfp_coverage_id: random_mfp_coverage_id,
        random_mfp_coverage_block_haat_id: random_mfp_coverage_block_haat_id,
        itemdata: itemsdata,
    });
    $("#mfp_coverage_block_haat_info_"+random_mfp_coverage_id).append(rendered);
}

function RenderMfpEstimatedLosses(random_mfp_coverage_id, itemsdata) {
    
    var source = $("#estimated_loss_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_coverage_id: random_mfp_coverage_id,
        itemdata: itemsdata,
    });
    $("#estimated_loss_container").append(rendered);
    var estimated_losses_no = 0;
    $(".estimated_losses_no").each(function() {
      ++estimated_losses_no;
      $(this).html(estimated_losses_no);
    });

}
function mfp_coverage_no_inc() {
    var item_no = 0;
    $('.mfp_coverage_no').each(function() {
        ++item_no;
        $(this).html(item_no);
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
function RenderMfpDisposalData(random_disposal_id, itemsdata)
{
    var source = $("#mfp_disposal_plan_template").html(); 
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_disposal_id: random_disposal_id,
        itemdata: itemsdata,
    });
    $("#mfp-disposal-plan").append(rendered);
    if(itemsdata!='' && itemsdata!=null)
    {
        $('#mfp_coverage_mfp_name_'+random_mfp_coverage_id).val(itemsdata.mfp_id)
        WarehouseData=itemsdata.getWarehouseData;
        let total_qty=0;
        let total_value=0;
        
        $.each(WarehouseData, function(key, itemdata) {
            total_qty +=parseFloat(itemdata.qty);
            total_value +=parseFloat(itemdata.value);
        });
        total_qty=decimalValues(total_qty);
        total_value=decimalValues(total_value);
        $('#disposal_total_qty'+random_disposal_id).html(total_qty);
        $('#disposal_total_value'+random_disposal_id).html(total_value);
        $.each(WarehouseData, function(key, itemdata) {
            
            RenderMfpDisposalWarehouse(random_disposal_id,itemdata) 
        });
           
    }else{
        WarehouseData=[];
        RenderMfpDisposalWarehouse(random_disposal_id,WarehouseData)    
    }
    var mfp_disposal_no = 0;
    $(".mfp_disposal_no").each(function() {
      ++mfp_disposal_no;
      $(this).html(mfp_disposal_no);
    });
}
function RenderMfpDisposalWarehouse(random_disposal_id, itemsdata)
{
    var source = $("#mfp_disposal_plan_warehouse_template").html(); 
    Mustache.parse(source);
    var random_disposal_warehouse_id = Date.now();
    var rendered = Mustache.render(source, {
        random_disposal_id: random_disposal_id,
        random_disposal_warehouse_id: random_disposal_warehouse_id,
        itemdata: itemsdata,
    });
    $("#mfp_disposal_plan_warehouse_info_"+random_disposal_id).append(rendered);
    if(itemsdata.months!='' && itemsdata.months!=null)
    {
       $("#disposal_months"+random_disposal_warehouse_id).html(itemsdata.months.map(v => GetMonthName(v.month)).join(", "));
    }
}


//=======================Seasonality===============
function RenderSeasonality(random_seasonality_id, itemsdata) {
    var labels_no = $(".delete_mfp_coverage").length;
    ++labels_no;
    var source = $("#seasonality_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_seasonality_id: random_seasonality_id,
        itemdata: itemsdata,
    });
    $("#seasonality_container").append(rendered);
    
    seasonality_no_inc();
    if(itemsdata!='' && itemsdata!=null){
        $('#seasonality_haat'+random_seasonality_id).val(itemsdata.haat_id);
        commodity_data=itemsdata.commodity_data;
        $.each(commodity_data, function(key, itemdata) {
            
            RenderSeasonalityCommodityHaat(random_seasonality_id,itemdata)    
        });
    }
    
}
function RenderSeasonalityCommodityHaat(random_seasonality_id, itemsdata) {
    var source = $("#commodity_haat_template").html();
    Mustache.parse(source);
    var random_commodity_haat_id = Math.floor(Math.random() * 1000000000);
    var rendered = Mustache.render(source, {
        random_seasonality_id: random_seasonality_id,
        random_commodity_haat_id: random_commodity_haat_id,
        itemdata: itemsdata,
    });
    $("#commodity_info_"+random_seasonality_id).append(rendered);
    
    
    if(itemsdata!='' && itemsdata!=null)
    {
       
        $("#month"+random_commodity_haat_id).html(itemsdata.month.map(v => GetMonthName(v.month)).join(","));
    }
    
    commodity_haat_inc(random_seasonality_id);
}
function GetMonthName(monthNumber) {
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      return months[monthNumber - 1];
}
function seasonality_no_inc() {
    var item_no = 0;
    $('.seasonality_no').each(function() {
        ++item_no;
        $(this).html(item_no);
    });
    var count = $(".delete_seasonality").length;
    $('.remove_seasonality').show();
    $('.remove_seasonality').first().hide();   
}

function commodity_haat_inc(random_seasonality_id) {
    $('.remove_commodity_haat_'+random_seasonality_id).show();
    $('.remove_commodity_haat_'+random_seasonality_id).first().hide();   
}


$(document).ready(function() { 
  var random_procurement_id = Date.now();    
     other_procurement_data=result_data.mfp_commodity;        
  
  if (other_procurement_data != null && other_procurement_data.length) { 

    var procurement_no = 0;
 
    $.each(other_procurement_data, function(key, procurement_plan) {       
      ++procurement_no;
      random_procurement_id = procurement_no;
         RenderProcurementPlan(random_procurement_id,procurement_plan)    
    });
  } else {
    procurement_plan = {};
    RenderProcurementPlan(random_procurement_id, procurement_plan);
  } 
});

function RenderProcurementPlan(random_procurement_id, procurement_plan) {
    var source = $("#procurement_plan_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_procurement_id: random_procurement_id,
      item: procurement_plan
    }); 
    $("#procurement_plan").append(rendered); 
    other_procuremnt_no_inc();
  } 

  function other_procuremnt_no_inc() {
    var other_procuremnt_no_inc = 0;
    $(".other_procuremnt_no_inc").each(function() {
      ++other_procuremnt_no_inc;
      $(this).html(other_procuremnt_no_inc);
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
$(document).ready(function() { 
  other_proposed_mfp=result_data.mfp_storage;  
 
  if (other_proposed_mfp != null && other_proposed_mfp.length) { 
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


  function RenderProposedMFP(random_proposed_mfp_id, proposed_mfp) {
    var source = $("#proposed_mfp_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_proposed_mfp_id: random_proposed_mfp_id,
      proposed_mfp: proposed_mfp
    }); 
    $("#other_proposed_mfp").append(rendered_data);       
    $.each(proposed_mfp.storage_haat, function( i, v ){ 
        $.each(v.haat_item, function( i, t ){ 
              $("#haat_"+random_proposed_mfp_id).html(t.get_haat_bazaar_detail.get_part_one.rpm_name);
             
        });  
    });
   other_proposed_mfp_no_inc();
  }
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

  function RenderLabourCharges(random_labour_charges_id, itemdata){
 
    var source = $("#labour_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_labour_charges_id: random_labour_charges_id,
      itemdata: itemdata
    });
    $("#labour_charges_container").append(rendered_data);
    var labour_charges_no = 0;
    $(".other_labour_charges_no").each(function() {
      ++labour_charges_no;
      $(this).html(labour_charges_no);
    });
  }
function RenderPackingMaterial(random_collection_level_id, itemdata)
{
    var source = $("#packing_material_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_packing_material_id: random_collection_level_id,
      itemdata: itemdata
    });
    $("#packing_material_container").append(rendered_data);
    if(itemdata.haats!='' && itemdata.haats!=null)
    {
       $("#packing_material_haat_id"+random_collection_level_id).html(itemdata.haats.map(v => v.HaatName).join(","));
    }
    //$('#packing_material_category'+random_collection_level_id).val(itemdata.category)
    $('#packing_material_size'+random_collection_level_id).val(itemdata.size)
}
function RenderWeightmentCharges(random_weightment_charges_id, itemdata)
{
    var source = $("#weightment_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_weightment_charge_id: random_weightment_charges_id,
      itemdata: itemdata
    });

    $("#weightment_charges_container").append(rendered_data);
    var weightment_charges_no = 0;
    $(".weightment_charges_no").each(function() {
      ++weightment_charges_no;
      $(this).html(weightment_charges_no);
    });
}
  function RenderTransportationCharges(random_transportation_charges_id, itemdata){
 
    var source = $("#transportation_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_transportation_charges_id: random_transportation_charges_id,
      itemdata: itemdata
    });
    $("#transportation_charges_container").append(rendered_data);
    var transportation_charges_no = 0;
    $(".other_transportation_charges_no").each(function() {
      ++transportation_charges_no;
      $(this).html(transportation_charges_no);
    });
  }

  function RenderServiceCharges(random_service_charges_id, itemdata){
    var source = $("#service_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_service_charges_id: random_service_charges_id,
      itemdata: itemdata
    });
    $("#service_charges_container").append(rendered_data);
    var service_charges_no = 0;
    $(".other_service_charges_no").each(function() {
      ++service_charges_no;
      $(this).html(service_charges_no);
    });
  }
  //warehouse level 
  
  function RenderWarehouseLabourCharges(random_id, itemdata){
 
    var source = $("#warehouse_labour_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_id: random_id,
      itemdata: itemdata
    });
    $("#warehouse_labour_charges_container").append(rendered_data);
    var warehouse_labour_charges_no = 0;
    $(".warehouse_labour_charges_no").each(function() {
      ++warehouse_labour_charges_no;
      $(this).html(warehouse_labour_charges_no);
    });
  }

  function RenderWarehouseCharges(random_id, itemdata){
 
    var source = $("#warehouse_charges_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_id: random_id,
      itemdata: itemdata
    });
    $("#warehouse_charges_container").append(rendered_data);
    var warehouse_charges_no = 0;
    $(".warehouse_charges_no").each(function() {
      ++warehouse_charges_no;
      $(this).html(warehouse_charges_no);
    });
  }
  function RenderEstimatedWastage(random_id, itemdata){
 
    var source = $("#estimated_wastages_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_id: random_id,
      itemdata: itemdata
    });
    $("#estimated_wastages_container").append(rendered_data);
    var estimated_wastages_template_no = 0;
    $(".estimated_wastages_no").each(function() {
      ++estimated_wastages_template_no;
      $(this).html(estimated_wastages_template_no);
    });
  }

  function RenderServiceChargesDia(random_service_charges_dia_id, itemdata){
 
    var source = $("#service_charges_at_dia_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_service_charges_dia_id: random_service_charges_dia_id,
      itemdata: itemdata
    });
    $("#service_charges_at_dia_container").append(rendered_data);
    var service_charges_dia_no = 0;
    $(".service_charges_dia_no").each(function() {
      ++service_charges_dia_no;
      $(this).html(service_charges_dia_no);
    });
  }

  function RenderOtherCosts(random_other_cost_id, itemdata){
 
    var source = $("#other_costs_template").html();
    Mustache.parse(source);
    var rendered_data = Mustache.render(source, {
      random_other_cost_id: random_other_cost_id,
      itemdata: itemdata
    });
    $("#other_costs_container").append(rendered_data);
    var other_cost_no = 0;
    $(".other_cost_no").each(function() {
      ++other_cost_no;
      $(this).html(other_cost_no);
    });
  }

  // for step 4
  /***Calculate Auto Sum Mfp wise */
var sum = 0;
function calculateAutoSum(mfp_id) {
    sum = 0;
    $("#summary td[mfp_id=" + mfp_id + "] ").each(function () {
        var value = $(this).text();
        // add only if the value is number
        if (!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
        }
    });
    $(".auto-sum td[mfp_id=" + mfp_id + "]").html('<b>'+sum.toFixed(4)+'</b>');

}


/***Calculate Total fund Require****/
var totalFundRequired = 0;
var finalTotalFundRequired = 0;
totalFundRequire = () => {
    $(".auto-sum td").each(function () {
        var value = $(this).text();
        // add only if the value is number
        if (!isNaN(value) && value.length != 0) {
            totalFundRequired += parseFloat(value);
        }

    });
    //if old fund require is already available
    if ($("#old_fund_require").val() != 0) {
        finalTotalFundRequired = totalFundRequired + parseFloat($("#old_fund_require").val());
        $("#total_fund_require").val(finalTotalFundRequired.toFixed(4));
    }else{
        $("#total_fund_require").val(totalFundRequired.toFixed(4));
    }
    

}

//old fund require is filling after total fund require
function sumOldFundRequire() {
    if ($("#old_fund_require").val() != 0) {
        updatedFund = totalFundRequired + parseFloat($("#old_fund_require").val());
    }
    $("#total_fund_require").val(updatedFund);
}

fetchCostOfPackagingMaterial = (id) => {
    var url = conf.getCostOfPackagingMaterial.url(id);
    var method = conf.getCostOfPackagingMaterial.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            CostOfPackagingMaterial = response.data;
          
        } else {
            TRIFED.showMessage('error', cb);
        }
    });

}

fetchEstimatedProcurement = (id) => {
    var url = conf.getEstimatedProcurementOfMFP.url(id);
    var method = conf.getEstimatedProcurementOfMFP.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            estimatedProcurement = response.data;
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

getEstimatedQuarterlyRequirement = (id) => {
    var url = conf.getEstimatedQuarterlyRequirement.url(id);
    var method = conf.getEstimatedQuarterlyRequirement.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            estimatedQuarterlyRequirement = response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}


$(function(){
	var proposal_id = $("#proposal_id").html();
	$('#data-table').DataTable({
        dom: 'Bfrtip',
		paging: false,
		"lengthMenu": [ [5, 10, 25, 50,-1], [5, 10, 25, 50, "All"] ],
		searching: false,
		"ordering": false,
		info: false,
        buttons: [
			{ 
				extend: 'excelHtml5', 
				text: 'Download Excel', 
				title: 'Total Annual Fund Requierement (Proposal id = '+proposal_id+')'
			}
        ]
    });
	
	$('#data-table2').DataTable({
        dom: 'Bfrtip',
		paging: false,
		"lengthMenu": [ [5, 10, 25, 50,-1], [5, 10, 25, 50, "All"] ],
		searching: false,
		"ordering": false,
		info: false,
        buttons: [
			{ 
				extend: 'excelHtml5', 
				text: 'Download Excel', 
				title: 'Estimated Quarterly Requirement of Funds (Proposal id = '+proposal_id+')', 
				/* customize: function(xlsx) {
					var sheet = xlsx.xl.worksheets['sheet1.xml'];
					var col = $('row', sheet);
					$(col[2]).attr('width',400);
				} */
			}
        ],
    });
})

