// var auth = TRIFED.getLocalStorageItem();
// var district_id = auth.district_id;
// var district_name = auth.district;

// var formData = {};
// var url_var = getUrlVars();
// var form_id = url_var['id'];

$(document).ready(function () {
    
    //fetchFormData(url_var['id']);
    fetchCostOfPackagingMaterial(url_var['id']);
    fetchEstimatedProcurement(url_var['id'])
    getEstimatedQuarterlyRequirement(url_var['id']);


    //To populate Mfp Name from step 1
    $(".row-1-column-2").html('Estimated Procurement <b>' + formData.financialYear + '</b>');
    if (formData.mfp_coverage && formData.mfp_coverage != null && formData.mfp_coverage != '') {
        var mfp_coveragedata = formData.mfp_coverage;
        var index = 3;
        var html = '';
        $.each(mfp_coveragedata, function (key, itemdata) {
            html += '<th scope="col" mfp_id="' + itemdata.mfp_id + '" >' + itemdata.getMfpData.title + '</th>';
            $(".estimated-procurement").append('<td>NA</td>');
            $(".cost-of-packing-material").append('<td></td>');
            $(".weighment-charges").append('<td></td>');
            $(".labour-charges").append('<td></td>');
            $(".transportation-charges").append('<td></td>');
            $(".service-charges").append('<td></td>');
            $(".warehouse-labour-charges").append('<td></td>');
            $(".warehouse-charges").append('<td></td>');
            $(".estimated-wastages").append('<td></td>');
            $(".service-charges-dia").append('<td></td>');
            $(".other-costs").append('<td></td>');
            $(".auto-sum").append('<td></td>');
            $(".fund-requirement tr td:nth-child(" + index + ")").attr('mfp_id', itemdata.mfp_id);
            $(".quarter-1").append('<td></td>');
            $(".quarter-2").append('<td></td>');
            $(".quarter-3").append('<td></td>');
            $(".quarter-4").append('<td></td>');
            $(".auto-sum-estimated-quarterly").append('<td></td>');
            $(".estimated-quarterly-requirement tr td:nth-child(" + index + ")").attr('mfp_id', itemdata.mfp_id);
            index++;
        });
        $(html).insertAfter(".activity");
        $(html).insertAfter(".quarter");


    }

    //auto fill mfp procurement
    if (estimatedProcurement != null && estimatedProcurement != '') {

        $.each(estimatedProcurement, function (key, itemdata) {
            $(".estimated-procurement td[mfp_id=" + itemdata.commodity_id + "]").html(itemdata.estimated_procurement);
        });
    }

    //auto fill cost of packaging material
    if (CostOfPackagingMaterial != null && CostOfPackagingMaterial != '') {
        $.each(CostOfPackagingMaterial, function (key, itemdata) {
            $(".cost-of-packing-material td[mfp_id=" + itemdata.mfp_id + "]").html(itemdata.total_cost_of_packaging_material);
        });
    }

    //auto fill weighment charges
    if (formData.getMfpWeightmentCharges && formData.getMfpWeightmentCharges != null && formData.getMfpWeightmentCharges != '') {
       
        $.each(formData.getMfpWeightmentCharges, function (key, itemdata) {
            $(".weighment-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);
    
        });
    }

    //auto fill labour charge cost by mfp id
    if (formData.getMfpSummary && formData.getMfpSummary != null && formData.getMfpSummary != '') {
        $("#any_other_available").val(formData.getMfpSummary.any_other_available);
        $("#old_fund_require").val(formData.getMfpSummary.old_fund_require);
        $("#total_fund_require").val(formData.getMfpSummary.total_fund_require);
    }
    //auto fill labour charge cost by mfp id
    if (formData.getMfpLabourCharges && formData.getMfpLabourCharges != null && formData.getMfpLabourCharges != '') {
        $.each(formData.getMfpLabourCharges, function (key, itemdata) {
            $(".labour-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);
        });
    }
    //auto fill tranportation charge cost by mfp id
    if (formData.getMfpTransportationCharges && formData.getMfpTransportationCharges != null && formData.getMfpTransportationCharges != '') {
        $.each(formData.getMfpTransportationCharges, function (key, itemdata) {
            $(".transportation-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.estimated_total_cost_of_transportation);
        });
    }
    //auto fill service charge cost by mfp id
    if (formData.getMfpServiceCharges && formData.getMfpServiceCharges != null && formData.getMfpServiceCharges != '') {
        $.each(formData.getMfpServiceCharges, function (key, itemdata) {
            $(".service-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.service_charge_in_total_value_of_procurement);
        });
    }
    //auto fill warehouse labour charge cost by mfp id
    if (formData.getMfpWarhouseLabourCharges && formData.getMfpWarhouseLabourCharges != null && formData.getMfpWarhouseLabourCharges != '') {
        $.each(formData.getMfpWarhouseLabourCharges, function (key, itemdata) {
            $(".warehouse-labour-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);
        });
    }
    //auto fill warehouse charge cost by mfp id
    if (formData.getMfpWarhouseCharges && formData.getMfpWarhouseCharges != null && formData.getMfpWarhouseCharges != '') {
        $.each(formData.getMfpWarhouseCharges, function (key, itemdata) {
            $(".warehouse-charges td[mfp_id=" + itemdata.mfp + "]").html(itemdata.total_estimated_cost);
        });
    }
    //auto fill estimated wastages cost by mfp id
    if (formData.getMfpEstimatedWastages && formData.getMfpEstimatedWastages != null && formData.getMfpEstimatedWastages != '') {
        $.each(formData.getMfpEstimatedWastages, function (key, itemdata) {
            $(".estimated-wastages td[mfp_id=" + itemdata.mfp + "]").html(itemdata.estimated_driage_rs);
        });
    }

    //auto fill service charge by mfp id
    if (formData.getMfpServiceChargesDIA && formData.getMfpServiceChargesDIA != null && formData.getMfpServiceChargesDIA != '') {
        $.each(formData.getMfpServiceChargesDIA, function (key, itemdata) {
            $(".service-charges-dia td[mfp_id=" + itemdata.mfp_id + "]").html(itemdata.service_charge_value);
        });
    }

    //auto fill other cost by mfp id
    if (formData.getMfpOtherCosts && formData.getMfpOtherCosts != null && formData.getMfpOtherCosts != '') {
        $.each(formData.getMfpOtherCosts, function (key, itemdata) {
            $(".other-costs td[mfp_id=" + itemdata.mfp_id + "]").html(itemdata.other_cost);
        });
    }

    if (formData.mfp_coverage && formData.mfp_coverage != null && formData.mfp_coverage != '') {
        var mfp_coveragedata = formData.mfp_coverage;
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
            
                $(".auto-sum-estimated-quarterly td[mfp_id=" + key1 + "]").html('<b>'+total[key1]+'</b>');
            });
          
        });

    
    }

    $("#formID").submit(function (e) {
    }).validate({
        rules: {


        },
        submitHandler: function (form) {


            var form = $('#formID')[0];
            var data = new FormData(form);
            var url = conf.addMfpProcurementPartFour.url;
            var method = conf.addMfpProcurementPartFour.method;
            if (form_id != undefined && form_id != '') {
                data.append('form_id', form_id);
            }
            if (form.submitter == 'draft') {
                data.append('submit_type', 'draft');
            } else {
                data.append('submit_type', 'submit');
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    form_id = response.data.ref_id;
                    $('#preview').show();
                    TRIFED.showMessage('success', 'Successfully Added');
                    if (form.submitter == 'submit') {
                        setTimeout(function () { window.location = '../project-proposal/mfp-procurement-listing.php' }, 500);
                    } else {
                        setTimeout(function () { window.location = '../project-proposal/step4.php?id=' + form_id }, 500);
                    }

                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    });
});

/*** Common js for form*/

fetchFormData = (form_id) => {
    var url = conf.getProcurementDetail.url(form_id);
    var method = conf.getProcurementDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            formData = response.data;
            //console.log(formData)
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
        //console.log('value'+mfp_id+'-'+value);
        // add only if the value is number
        if (!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
        }
    });
    $(".auto-sum td[mfp_id=" + mfp_id + "]").html('<b>'+sum+'</b>');

}


/***Calculate Total fund Require****/
var totalFundRequired = 0;
var finalTotalFundRequired = 0;
totalFundRequire = () => {
    $(".auto-sum td").each(function () {
        var value = $(this).text();
        // console.log('value-'+value);
        // add only if the value is number
        if (!isNaN(value) && value.length != 0) {
            totalFundRequired += parseFloat(value);
        }

    });
    //if old fund require is already available
    if ($("#old_fund_require").val() != 0) {
        finalTotalFundRequired = totalFundRequired + parseFloat($("#old_fund_require").val());
        $("#total_fund_require").val(finalTotalFundRequired);
    }else{
        $("#total_fund_require").val(totalFundRequired);
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
            //console.log(estimatedProcurement);
        } else {
            TRIFED.showMessage('error', cb);
        }
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

  