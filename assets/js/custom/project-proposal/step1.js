var auth = TRIFED.getLocalStorageItem();
var district_id = auth.district_id;
var district_name = auth.district;
var mfpmaster_data = {};
var haats_list = {};

var mfpdata = [];
var seasonalitydata = [];
var url_var = getUrlVars();
var form_id = '';
if (url_var['id'] != undefined) {
    form_id = url_var['id'];
    $('#preview').show();
    $('#preview').on('click', function () {
        window.location = '../project-proposal/view-mfp-procurement.php?id=' + form_id
    });
    $("#show_summary").prop('checked', true);  
}
$(function () {
    if (url_var['id'] != undefined) 
    {
        form_data = fetchFormData(form_id);
    } 
    fetchFinancialYear();
    fetchMfpMaster();
    fetchHaatList();

    if (url_var['id'] != undefined) {

        mfpdata = form_data.mfp_coverage;
        seasonalitydata = form_data.mfp_seasonality;

        if (form_data.is_step3_complete) {
            $('.overheads-tab').on('click', function () {
                window.location = '../project-proposal/step3.php?id=' + form_id
            });
        }

        $('#year_id').val(form_data.year_id)
        random_seasonality_id = 0;
        random_mfp_coverage_id = 0;
        $.each(mfpdata, function (key, itemdata) {
            ++random_mfp_coverage_id;
            RenderMfpCoverage(random_mfp_coverage_id, itemdata);
        });
        $.each(seasonalitydata, function (key, itemdata) {
            ++random_seasonality_id;
            RenderSeasonality(random_seasonality_id, itemdata);

        });
        RenderSeasonalitySummary(form_data);
        getSeasionalityQuarterData(form_id)
        
    }else{
        var Random_id=Date.now();
        var random_mfp_coverage_id = Random_id;
        var random_seasonality_id = Random_id;
        RenderMfpCoverage(random_mfp_coverage_id, mfpdata);
        RenderSeasonality(random_seasonality_id, seasonalitydata);
    }
    
    
    $("#show_summary").click(function(){
        if($(this).is(':checked'))
        {
            $("#formID").submit();
        }else{
            
        }
    });
 


    $("#formID").submit(function (e) {

        // e.preventDefault();
    }).validate({

        rules: {


        },
        submitHandler: function (form) {
            var form = $('#formID')[0];
            var data = new FormData(form);
            var url = conf.addMfpProcurementPartOne.url;
            var method = conf.addMfpProcurementPartOne.method;
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
                        setTimeout(function () { window.location = '../project-proposal/step2.php?id=' + form_id }, 500);
                    } else {
                        setTimeout(function () { window.location = '../project-proposal/step1.php?id=' + form_id }, 500);
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
getSeasionalityQuarterData=(form_id)=>{
    if(form_id!='')
    {
        var url = conf.getSeasionalityQuarterWise.url(form_id);
        var method = conf.getSeasionalityQuarterWise.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                data = response.data;
                RenderSeasonalityQuarterSummary(data);
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
    }
}
fetchFormData=(form_id)=>{
    var url = conf.getProcurementPartOne.url(form_id);
    var method = conf.getProcurementPartOne.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            data = response.data;
            //console.log(data);
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
    var d = new Date();
    currentYear = d.getFullYear()
    nextYear = d.getFullYear() + 1;
    currentFinancialYear = getCurrentFinancialYear();//currentYear + '-' + nextYear;
    html = '<option value="">Select Financial Year</option>';

    $.each(years, function (i, year) {
        if(form_id!='' && form_data.year_id!='')
        {
            if (year.id == form_data.year_id) 
            {
                html += '<option value="' + year.id + '" selected>' + year.title + '</option>';    
            }
            if (currentFinancialYear == year.title) {
                html += '<option value="' + year.id + '" >' + year.title + '</option>';
            }
        }else{
            if (currentFinancialYear == year.title) {
                html += '<option value="' + year.id + '" selected>' + year.title + '</option>';
            }    
        }
        
        //html += '<option value="'+year.id+'">'+year.title+'</option>';

    });
    $('#year_id').html(html);
}
function getCurrentFinancialYear() {
  var fiscalyear = "";
  var today = new Date();
  if ((today.getMonth() + 1) <= 3) {
    fiscalyear = (today.getFullYear() - 1) + "-" + today.getFullYear()
  } else {
    fiscalyear = today.getFullYear() + "-" + (today.getFullYear() + 1)
  }
  return fiscalyear
}
fetchMfpMaster = (random_mfp_coverage_id) => {
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;

        }
    });
}
fillMfpMaster = (mfps, item_id = 0) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
    });
    $(item_id).html(html);
}




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
    fillMfpMaster(mfpmaster_data, '#mfp_coverage_mfp_name_' + random_mfp_coverage_id);
    var district_options = '<option value="' + district_id + '">' + district_name + '</option>';
    $('#mfp_coverage_district_id' + random_mfp_coverage_id).html(district_options);

    if (itemsdata != '' && itemsdata != null) {
        $('#mfp_coverage_mfp_name_' + random_mfp_coverage_id).val(itemsdata.mfp_id)
        MfpCoverageBlocksHaatData = itemsdata.block_haat_data;
        $.each(MfpCoverageBlocksHaatData, function (key, itemdata) {
            RenderMfpCoverageBlockHaat(random_mfp_coverage_id, itemdata)
        });

    } else {
        MfpCoverageBlocksHaatData = [];
        RenderMfpCoverageBlockHaat(random_mfp_coverage_id, MfpCoverageBlocksHaatData)
    }


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
    $("#mfp_coverage_block_haat_info_" + random_mfp_coverage_id).append(rendered);
    fillHaatList(haats_list, '#mfp_coverage_haat_' + random_mfp_coverage_block_haat_id);
    if (itemsdata != '' && itemsdata != null) {
        $('#mfp_coverage_haat_' + random_mfp_coverage_block_haat_id).val(itemsdata.haat_id).trigger('change');
        $('#mfp_coverage_block_' + random_mfp_coverage_block_haat_id).val(itemsdata.block_id);
    }
    mfp_coverage_block_haat_inc(random_mfp_coverage_id);
}
$('#add_mfp_coverage').click(function () {
    random_mfp_coverage_id = Date.now();
    RenderMfpCoverage(random_mfp_coverage_id);
    mfp_coverage_no_inc();
});

function delete_mfp_coverage(random_mfp_coverage_id, server_id) {
    if (server_id != undefined) {
        if (confirm('Do you really want to delete this ? After clicking this it will be permanently deleted')) {
            var url = conf.deleteMfpCoverage.url;
            var method = conf.deleteMfpCoverage.method;
            var data = { id: server_id };
            TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
                if (response.status) {
                    TRIFED.showMessage('success', 'Deleted Successfully');
                }
            });
        }
    }

    var count = $(".delete_mfp_coverage").length;
    if (count > 1) {
        $("#delete_mfp_coverage" + random_mfp_coverage_id).remove();
        mfp_coverage_no_inc();
    }
}

function mfp_coverage_no_inc() {
    var item_no = 0;
    $('.mfp_coverage_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    var count = $(".delete_mfp_coverage").length;
    $('.remove_mfp_coverage').show();
    $('.remove_mfp_coverage').first().hide();
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


function add_mfp_coverage_block_haat(random_mfp_coverage_id) {
    itemdata = [];
    RenderMfpCoverageBlockHaat(random_mfp_coverage_id, itemdata);
}
function delete_mfp_coverage_block_haat(random_mfp_coverage_id, random_mfp_coverage_block_haat_id) {
    var count = $(".delete_mfp_coverage_block_haat_" + random_mfp_coverage_id).length;
    if (count > 1) {
        $("#delete_mfp_coverage_block_haat" + random_mfp_coverage_block_haat_id).remove();
        mfp_coverage_block_haat_inc(random_mfp_coverage_id);
    }
}
function delete_mfp_coverage_block_haat_server(random_mfp_coverage_id, random_mfp_coverage_block_haat_id, serverid) {
    if (confirm('Do you really want to delete this ? After clicking this it will be permanently deleted')) {
        var url = conf.deleteMfpCoverageBlockHaat.url;
        var method = conf.deleteMfpCoverageBlockHaat.method;
        var data = { id: serverid };
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                TRIFED.showMessage('success', 'Deleted Successfully');
                var count = $(".delete_mfp_coverage_block_haat_" + random_mfp_coverage_id).length;
                if (count > 1) {
                    $("#delete_mfp_coverage_block_haat" + random_mfp_coverage_block_haat_id).remove();
                    mfp_coverage_block_haat_inc(random_mfp_coverage_id);
                }

            }
        });
    }

}
function mfp_coverage_block_haat_inc(random_mfp_coverage_id) {

    var count = $(".delete_mfp_coverage_block_haat_" + random_mfp_coverage_id).length;
    $('.remove_mfp_coverage_block_haat_' + random_mfp_coverage_id).show();
    $('.remove_mfp_coverage_block_haat_' + random_mfp_coverage_id).first().hide();
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
    selectedHaat();
    fillSelectedHaatInSeasonlity(mfpdata,random_seasonality_id);
   
    //fillHaatList(haats_list, '#seasonality_haat' + random_seasonality_id)
    seasonality_no_inc();
    if (itemsdata != '' && itemsdata != null) {
        $('#seasonality_haat' + random_seasonality_id).val(itemsdata.haat_id);
        commodity_data = itemsdata.commodity_data;
      
        $.each(commodity_data, function (key, itemdata) {
            RenderSeasonalityCommodityHaat(random_seasonality_id, itemdata)
        });
    } else {
        var CommodityBlocksHaatData = [];
        RenderSeasonalityCommodityHaat(random_seasonality_id, CommodityBlocksHaatData)
    }

}
function RenderSeasonalityCommodityHaat(random_seasonality_id, itemsdata) {
    var source = $("#commodity_haat_template").html();
    Mustache.parse(source);
    var random_commodity_haat_id = Date.now();
    var rendered = Mustache.render(source, {
        random_seasonality_id: random_seasonality_id,
        random_commodity_haat_id: random_commodity_haat_id,
        itemdata: itemsdata,
    });
    $("#commodity_info_" + random_seasonality_id).append(rendered);
    fillSelectedMfpInSeasonlity(mfpdata,random_commodity_haat_id);
   
    //fillMfpMaster(mfpmaster_data,'#seasonality_commodity_id'+random_commodity_haat_id);

    if (itemsdata != '' && itemsdata != null) {
        
        
        $('#seasonality_commodity_id' + random_commodity_haat_id).val(itemsdata.mfp_id);
        $('#seasonality_quantity' + random_commodity_haat_id).val(itemsdata.qty);
        $('#seasonality_value' + random_commodity_haat_id).val(itemsdata.value);
        $.each(itemsdata.month, function (i, v) {
            $("#month" + random_commodity_haat_id + " option[value='" + v.month + "']").prop("selected", true);
        });
    }
    $('#month' + random_commodity_haat_id).select2();
    commodity_haat_inc(random_seasonality_id);
    
}
function seasonality_no_inc() {
    var item_no = 0;
    $('.seasonality_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    var count = $(".delete_seasonality").length;
    $('.remove_seasonality').show();
    $('.remove_seasonality').first().hide();
}
$('#add_seasonality').click(function () {
    random_seasonality_id = Date.now();
    RenderSeasonality(random_seasonality_id);
    selectedMfp();
    selectedHaat();
    seasonality_no_inc();
    
});
function add_commodity_haat(random_mfp_coverage_id) {
    itemdata = [];
    RenderSeasonalityCommodityHaat(random_mfp_coverage_id, itemdata);
    selectedMfp();
}

function delete_seasonality(random_seasonality_id, server_id) {
    if (server_id != undefined) {
        if (confirm('Do you really want to delete this ? After clicking this it will be permanently deleted')) {
            var url = conf.deleteSeasonality.url;
            var method = conf.deleteSeasonality.method;
            var data = { id: server_id };
            TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
                if (response.status) {
                    TRIFED.showMessage('success', 'Deleted Successfully');
                }
            });
        }
    }
    var count = $(".delete_seasonality").length;
    if (count > 1) {
        $("#delete_seasonality" + random_seasonality_id).remove();
        seasonality_no_inc(random_seasonality_id);
    }
}
function delete_commodity_haat(random_seasonality_id, random_commodity_haat_id) {
    var count = $(".delete_commodity_haat_" + random_seasonality_id).length;
    if (count > 1) {
        $("#delete_commodity_haat_" + random_commodity_haat_id).remove();
        commodity_haat_inc(random_seasonality_id);
    }
}
function delete_commodity_haat_server(random_seasonality_id, random_commodity_haat_id, serverid) {
    if (confirm('Do you really want to delete this ? After clicking this it will be permanently deleted')) {
        var url = conf.deleteCommodityHaat.url;
        var method = conf.deleteCommodityHaat.method;
        var data = { id: serverid };
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                TRIFED.showMessage('success', 'Deleted Successfully');
                var count = $(".delete_commodity_haat_" + random_seasonality_id).length;
                if (count > 1) {
                    $("#delete_commodity_haat_" + random_commodity_haat_id).remove();
                    commodity_haat_inc(random_seasonality_id);
                }

            }
        });
    }

}
function commodity_haat_inc(random_seasonality_id) {
    $('.remove_commodity_haat_' + random_seasonality_id).show();
    $('.remove_commodity_haat_' + random_seasonality_id).first().hide();
}


fetchHaatList = () => {
    var url = conf.getHaatMasterList.url;
    var method = conf.getHaatMasterList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            haats_list = response.data;
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
        fetchHaatBlock(v, '#mfp_coverage_block_' + item_id);
        //fetchBlockList(v,item_id,'class');
    }

});
fetchHaatBlock = (id = 0, item_id = 0) => {
    var url = conf.viewHaatMaster.url(id);
    var method = conf.viewHaatMaster.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            blocks = response.data.block_ids;
            fillHaatBlocks(blocks, item_id);
        }
    });
}
fillHaatBlocks = (blocks, item_id) => {
    html = '<option value="">Select Block</option>';
    $.each(blocks, function (i, block) {
        html += '<option value="' + block.block_id + '">' + block.block_name + '</option>';
    });
    $(item_id).html(html);
}
fetchBlockList = (id = 0, item_id = 0, element_type = 'id') => {
    var url = conf.getBlocks.url;
    var method = conf.getBlocks.method;
    var data = {
        district_id: id
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            blocks = response.data;
            if (element_type == 'id') {
                fillBlocklist(blocks, '#mfp_coverage_block_' + item_id);
            } else {
                fillBlocklist(blocks, '.mfp_coverage_block_' + item_id);
            }

        }
    });
}

fillBlocklist = (blocks, item_id) => {
    html = '<option value="">Select Block</option>';
    $.each(blocks, function (i, block) {
        html += '<option value="' + block.id + '">' + block.title + '</option>';
    });
    $(item_id).html(html);
}
function RenderSeasonalitySummary(form_data) {
    var total_qty = 0;
    var total_value = 0;
    seasonalitydata = form_data.mfp_seasonality;
    $.each(seasonalitydata, function (key, itemsdata) {
        html = '';
        commodity_data = itemsdata.commodities_mfpwise;
        var source = $("#seasonality_template_summary").html();
        Mustache.parse(source);

        $.each(commodity_data, function (key, itemdata) {
            total_value += parseFloat(itemdata.value) || 0;
            total_qty += parseFloat(itemdata.qty) || 0;
            var rendered = Mustache.render(source, {
                //itemsdata: itemsdata,
                commodity: itemdata,
            });
            $("#seasonality_summary_container").append(rendered);
        });
    });
    $("#seasonality_summary_container").append('<tr><th ></th><th>Total</th><th style="text-align: right;">' + total_qty.toFixed(4) + '</th><th style="text-align: right;">' + total_value.toFixed(4) + '</th></tr>');
}
function RenderSeasonalityQuarterSummary(data) {
    var total_qty = 0;
    var total_value = 0;
    $("#seasonality_quarter_summary_container").html('');
    $.each(data, function (key, itemdata) {
        html = '';
        var source = $("#seasonality_quarter_template_summary").html();
        Mustache.parse(source);
		itemdata.value = parseFloat(itemdata.value).toFixed(4);
		itemdata.qty = parseFloat(itemdata.qty).toFixed(4);
        total_value += parseFloat(itemdata.value).toFixed(4);
        total_qty += parseFloat(itemdata.qty).toFixed(4);
        var rendered = Mustache.render(source, {
            itemsdata: itemdata,

        });
        $("#seasonality_quarter_summary_container").append(rendered);

    });
    //$("#seasonality_summary_container").append('<tr><th ></th><th>Total</th><th>'+total_qty+'</th><th>'+total_value+'</th></tr>');
}

selectedSeasonalities = [];
function selectedMfp() {
    
    selected_mfps = $(".mfp_name");
    html = '<option value="">Select</option>';
    mfpsAdded = [];
    $.each(selected_mfps, function (k, mfp) {
        if (mfp.value != "" && mfpsAdded.indexOf(mfp.value) == -1) {
            mfpsAdded[mfp.value] = mfp.value;
            html += '<option value="' + mfp.value + '">' + mfp.options[mfp.selectedIndex].text + '</option>';
        }
    });
    $(".seasonality_mfp option:selected").each(function () {
        key = $(this).parent().attr('id');
        selectedSeasonality = $(this).val();
        selectedSeasonalities[key] = selectedSeasonality;
       
    });
  
    $(".seasonality_mfp").html(html);
  
    selectedSeasonalities = Object.assign({},selectedSeasonalities);
    $.each(selectedSeasonalities, function (k, seasonality) {
        if(mfpsAdded.indexOf(seasonality) != -1)
        {
            $("#"+k).val(seasonality);
        } 
     });
   
    
   
    
}

selectedCommodityHaats = [];
function selectedHaat() {
    selected_haats = $(".mfp_coverage_haat");
    html = '<option value="">Select</option>';
    haatsAdded = [];
   
    $.each(selected_haats, function (k, haat) {
        if (haat.value != "" && haatsAdded.indexOf(haat.value) == -1) {
            haatsAdded[haat.value] = haat.value;
            html += '<option value="' + haat.value + '">' + haat.options[haat.selectedIndex].text + '</option>';
        }
    });
    
    $(".commodity_haat option:selected").each(function () {
        key = $(this).parent().attr('id');
        selectedCommodityHaat = $(this).val();
        selectedCommodityHaats[key] = selectedCommodityHaat;
       
    });
  
    $(".commodity_haat").html(html);
  
    selectedCommodityHaats = Object.assign({},selectedCommodityHaats);
    $.each(selectedCommodityHaats, function (k, haat) {
        if(haatsAdded.indexOf(haat) != -1)
        {
            $("#"+k).val(haat);
        }
     });
   
}

fillSelectedMfpInSeasonlity = (mfps,item_id) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        if (mfp.mfp_id != null) {
            html += '<option value="' + mfp.mfp_id + '">' + mfp.getMfpData.title + '</option>';
        }

    });
  
    $("#seasonality_commodity_id"+item_id).html(html);
}
coverageHaats = [] ;
fillSelectedHaatInSeasonlity = (haats, item_id = 0) => {
    html = '<option value="">Select Haat</option>';
    coverageHaats = [] ;
    $.each(haats, function(i, haats_list) {
      // console.log(haats);
      // console.log(coverageHaats);
        $.each(haats_list.block_haat_data, function(i, haat) {
           
        if (haat.haat_id != null) {
            if(coverageHaats.indexOf(haat.haat_id) == -1){
                coverageHaats.push(haat.haat_id);
                html += '<option value="'+haat.haat_id+'">'+haat.haat_data.get_haat_bazaar_detail.get_part_one.rpm_name+'</option>';
            }
            
           
        }
      
        });
    });
  
    $("#seasonality_haat"+item_id).html(html);
}
function getMfpValue(item_id){
    var mfp_id = $("#seasonality_commodity_id"+item_id).val();
    var mfp_qty =  $("#seasonality_quantity"+item_id).val();
   
    if(!mfp_id){
        alert("Please select commodity");
        $("#seasonality_quantity"+item_id).val('');
        return false;
    }
   
    var url = conf.getMfpValue.url(mfp_id);
    var method = conf.getMfpValue.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        //console.log(response.data);
        if (response.status) {
			if(mfp_qty==''){
				mfp_qty=0;
			}
            total_value = parseFloat(mfp_qty) * parseFloat(response.data.value);
            total_value=decimalValues(total_value);
            $("#seasonality_value"+item_id).val(total_value);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}



