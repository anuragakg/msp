var auth = TRIFED.getLocalStorageItem();
var district_id = auth.district_id;
var district_name = auth.district;

var formData = {};
var url_var = getUrlVars();
var form_id = url_var['id'];

$(document).ready(function () {

    fetchFormData(url_var['id']);
    fetchFinancialYear();


    $("#year_id").val(formData.financialYear);
    $(".row-1-column-2").html('Estimated Procurement');
    if (formData.mfp_coverage && formData.mfp_coverage != null && formData.mfp_coverage != '') {
        var mfp_coveragedata = formData.mfp_coverage;
        var index = 3;
        var html = '';
        
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
            index++;
        });
        $(html).insertAfter(".activity");
        $(html).insertAfter(".quarter");


    }

    //auto fill estimated procurement and mfp commodity
    // if (formData.getMfpCommodity && formData.getMfpCommodity != null && formData.getMfpCommodity != '') {
    //     var procurement_no = 0;
    //     $.each(formData.getMfpCommodity, function (key, itemdata) {
    //         $(".estimated-procurement td[mfp_id=" + itemdata.commodity_id + "]").html(itemdata.currentval);
          
    //     });
    // }

     //auto fill commodity, haat,corresponding haats
     if (formData.commodityData && formData.commodityData != null && formData.commodityData != '') {
        var procurement_no = 0;
        $.each(formData.commodityData, function (key, itemdata) {
            console.log(itemdata);
            //$(".estimated-procurement td[mfp_id=" + itemdata.commodity_id + "]").html(itemdata.currentval);
            ++procurement_no;
                random_procurement_id = procurement_no;
                //console.log(itemdata);
                RenderProcurementPlan(random_procurement_id,itemdata);
          
          
        });
    }
    if (formData.estimatedProurement && formData.estimatedProurement != null && formData.estimatedProurement != '') {
        var procurement_no = 0;
        $.each(formData.estimatedProurement, function (key, itemdata) {

            $(".estimated-procurement td[mfp_id=" + itemdata.commodity_id + "]").html(parseFloat(itemdata.currentval).toFixed(4));
                ++procurement_no;
                random_procurement_id = procurement_no;
        });    
    }
    

      //auto fill cost of packaging material
      if (formData.CostOfPackagingMaterial != null &&formData. CostOfPackagingMaterial != '') {
        $.each(formData.CostOfPackagingMaterial, function (key, itemdata) {
            itemdata.total_cost_of_packaging_material = parseFloat(itemdata.total_cost_of_packaging_material);
            $(".cost-of-packing-material td[mfp_id=" + itemdata.mfp_id + "]").html(itemdata.total_cost_of_packaging_material.toFixed(4));
        });
    }

    //auto fill weighment charges
    if (formData.getMfpWeightmentCharges && formData.getMfpWeightmentCharges != null && formData.getMfpWeightmentCharges != '') {
       
        $.each(formData.getMfpWeightmentCharges, function (key, itemdata) {
            itemdata.total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
            $(".weighment-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost.toFixed(4));
    
        });
    }

    //auto fill labour charge cost by mfp id
    if (formData.getMfpLabourCharges && formData.getMfpLabourCharges != null && formData.getMfpLabourCharges != '') {
        $.each(formData.getMfpLabourCharges, function (key, itemdata) {
            itemdata.total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
            $(".labour-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost.toFixed(4));
        });
    }
    //auto fill tranportation charge cost by mfp id
    if (formData.getMfpTransportationCharges && formData.getMfpTransportationCharges != null && formData.getMfpTransportationCharges != '') {
        $.each(formData.getMfpTransportationCharges, function (key, itemdata) {
            itemdata.estimated_total_cost_of_transportation = parseFloat(itemdata.estimated_total_cost_of_transportation);
            $(".transportation-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.estimated_total_cost_of_transportation.toFixed(4));
        });
    }
    //auto fill service charge cost by mfp id
    if (formData.getMfpServiceCharges && formData.getMfpServiceCharges != null && formData.getMfpServiceCharges != '') {
        $.each(formData.getMfpServiceCharges, function (key, itemdata) {
            itemdata.service_charge_in_total_value_of_procurement = parseFloat(itemdata.service_charge_in_total_value_of_procurement);
            $(".service-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.service_charge_in_total_value_of_procurement.toFixed(4));
        });
    }
    //auto fill warehouse labour charge cost by mfp id
    if (formData.getMfpWarhouseLabourCharges && formData.getMfpWarhouseLabourCharges != null && formData.getMfpWarhouseLabourCharges != '') {
        $.each(formData.getMfpWarhouseLabourCharges, function (key, itemdata) {
            itemdata.total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
            $(".warehouse-labour-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost.toFixed(4));
        });
    }
    //auto fill warehouse charge cost by mfp id
    if (formData.getMfpWarhouseCharges && formData.getMfpWarhouseCharges != null && formData.getMfpWarhouseCharges != '') {
        $.each(formData.getMfpWarhouseCharges, function (key, itemdata) {
            itemdata.total_estimated_cost = parseFloat(itemdata.total_estimated_cost);
            $(".warehouse-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost.toFixed(4));
        });
    }
    //auto fill estimated wastages cost by mfp id
    if (formData.getMfpEstimatedWastages && formData.getMfpEstimatedWastages != null && formData.getMfpEstimatedWastages != '') {
        $.each(formData.getMfpEstimatedWastages, function (key, itemdata) {
            itemdata.estimated_driage_rs = parseFloat(itemdata.estimated_driage_rs);
            $(".estimated-wastages td[mfp_id=" + itemdata.mfp + "]").html(itemdata.estimated_driage_rs.toFixed(4));
        });
    }

    //auto fill service charge by mfp id
    if (formData.getMfpServiceChargesDIA && formData.getMfpServiceChargesDIA != null && formData.getMfpServiceChargesDIA != '') {
        $.each(formData.getMfpServiceChargesDIA, function (key, itemdata) {
            $(".service-charges-dia td[mfp_id=" + itemdata.mfp_id + "]").html(parseFloat(itemdata.service_charge_value).toFixed(4));
        });
    }

    //auto fill other cost by mfp id
    if (formData.getMfpOtherCosts && formData.getMfpOtherCosts != null && formData.getMfpOtherCosts != '') {
        $.each(formData.getMfpOtherCosts, function (key, itemdata) {
            $(".other-costs td[mfp_id=" + itemdata.mfp_id + "]").html(parseFloat(itemdata.other_cost).toFixed(4));
        });
    }
    //auto fill labour charge cost by mfp id
    if (formData.getMfpSummary && formData.getMfpSummary != null && formData.getMfpSummary != '') {
        var old_fund_require = 0;
        $.each(formData.getMfpSummary, function (key, itemdata) {
            old_fund_require += parseFloat(itemdata.old_fund_require);
        });
        $("#old_fund_require").val(old_fund_require);
       
    }

    if (formData.mfp_coverage && formData.mfp_coverage != null && formData.mfp_coverage != '') {
        var mfp_coveragedata = formData.mfp_coverage;
        $.each(mfp_coveragedata, function (key, itemdata) {
            calculateAutoSum(itemdata.mfp_id)
        });
        totalFundRequire();

    }

    



    if (formData.QuarterData!= null &&formData.QuarterData != '') {
        total = {};
        mfps = [];
        $.each(formData.QuarterData, function (key, itemdata) {
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


});

// $(document).ready(function() { 
//     var random_procurement_id = Date.now();    
//        other_procurement_data=formData.getMfpCommodity;        
//      //  console.log(other_procurement_data);    
//     if (other_procurement_data != null && other_procurement_data.length) { 
//       var procurement_no = 0;
//      // console.log(other_procurement_data); // 0,1
//       $.each(other_procurement_data, function(key, procurement_plan) {       
//         ++procurement_no;
//         random_procurement_id = procurement_no;
//            RenderProcurementPlan(random_procurement_id,procurement_plan)    
//       });
//     } else {
//       procurement_plan = {};
//       RenderProcurementPlan(random_procurement_id, procurement_plan);
//     } 
//   });

/*** Common js for form*/

fetchFormData = (form_id) => {
    var url = conf.getConsolidatedDetail.url(form_id);
    var method = conf.getConsolidatedDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            formData = response.data;
           
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}



/***Calculate Auto Sum Mfp wise */
var sum = 0;
function calculateAutoSum(mfp_id) {
    sum = 0;
    $("#mfp_coverage_container td[mfp_id=" + mfp_id + "] ").each(function () {
        var value = $(this).text();
        // add only if the value is number
        if (!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
        }
    });
    $(".auto-sum td[mfp_id=" + mfp_id + "]").html('<b>' + sum.toFixed(4) + '</b>');

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
    } else {
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



fetchCommodityData = (form_id) => {
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

function RenderProcurementPlan(random_procurement_id, procurement_plan) {
    procurement_plan.currentqty=parseFloat(procurement_plan.currentqty).toFixed(4);
    procurement_plan.currentval=parseFloat(procurement_plan.currentval).toFixed(4);
	if(procurement_plan.lastqty==''){
		procurement_plan.lastqty='0.0000';
	}
	if(procurement_plan.lastval==''){
		procurement_plan.lastval='0.0000';
	}
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
    $(".other_procuremnt_no_inc").each(function () {
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





