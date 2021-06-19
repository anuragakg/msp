
  var url_var = getUrlVars();
  var mfpmaster_data={};
  var warehousemaster_data={};
  var haatmaster_data={};
  var blockmaster_data={};
  var formData='';
  var mfp_storage_Data='';
  var result_data='';
  var mfpProcurementData='';
  var formProducrementData='';
   $(document).ready(function() {
    if(url_var['id']!=undefined)
    {
      fetchFormData(url_var['id']); 
    }
    fetchFinancialYear();
    fetchMfpMaster();
    fetchWarehouseMaster();
    fetchHaatList();
    fetchBlockList();
    if(url_var['id']!=undefined)
    {
      fetchFormData(url_var['id']); 
        form_id = url_var['id'];  
        $('#preview').on('click',function(){
            window.location = '../project-proposal/view-mfp-procurement.php?id='+form_id
        });
        $('#previous').on('click',function(){
           window.location = '../project-proposal/step1.php?id='+form_id
        });
        $('.mfp-coverage-tab').on('click', function () {
          window.location = '../project-proposal/step1.php?id=' + form_id
        });
     
        form_data=fetchCommodityData(form_id);
      }
  });

 $(document).ready(function() {
   
  var other_proposed_mfp = "";
  var random_proposed_mfp_id = Date.now();
  $("#addproposed_mfp").click(function() {
    random_proposed_mfp_id = Date.now();
    RenderProposedMFPUnassigned(random_proposed_mfp_id);
  }); 
  
  other_proposed_mfp=mfp_storage_Data.mfp_storage; 
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

fetchFormData=(form_id)=>{
  var url = conf.getProcurementDetail.url(form_id);
  var method = conf.getProcurementDetail.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response.status) {
          formData = response.data;
         // console.log(formData)
      } else {
          TRIFED.showMessage('error', cb);
      }
  });
  return data;
}
    
        
fetchCommodityData=(form_id)=>{
    var url = conf.getMfpProcurementCommodity.url(form_id);
        var method = conf.getMfpProcurementCommodity.method;
        var data = {}; 
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
            result_data = response.data;  
             $('#year_id').val(result_data.year_id).trigger('change');
            $('#form_id').val(result_data.id);
            fetchSecondFormData(result_data.id);
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
        return data;
}
fetchSecondFormData=(form_id)=>{
    var url = conf.getMfpProcurementPartTwo.url(form_id);
        var method = conf.getMfpProcurementPartTwo.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
              if (response.data) {
            mfp_storage_Data = response.data;  
            //console.log(formData.id);
            mfpProcurementData=response.data.mfp_commodity;             
            $('#step2_id').val(formData.id);
          }
            }  
        });
        return data;
}


/*======== Procurement Plan =====*/
$(document).ready(function() { 
  
  var random_procurement_id = Date.now();    
     other_procurement_data=result_data.result;         
  if (other_procurement_data != null && other_procurement_data.length) { 
    var procurement_no = 0;
    // 0,1
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
 //   console.log(procurement_plan);
    $("#procurement_plan").append(rendered);
   // fillMfpMaster(mfpmaster_data,'#commodity_'+random_procurement_id);    
    //fillHaatList(haatmaster_data,'#haatitem_'+random_procurement_id); 
   // fillBlockList(blockmaster_data,'#blocks_'+rando m_procurement_id); 
    var count = $(".delete_proposed_mfp").length;     
    other_procuremnt_no_inc();
    if (procurement_plan) 
    {   
      $("#mfp_seasonality_id_" + random_procurement_id).val(procurement_plan.id); 
        if(procurement_plan.mfp_id != null)
        {
          $("#commodity_" + random_procurement_id).append(new Option(procurement_plan.mfp_name, procurement_plan.mfp_id));  
        }
        if(procurement_plan.haat_id != null){
          $("#haatitem_" + random_procurement_id).append(new Option(procurement_plan.haat_name, procurement_plan.haat_id)); 
        }
        if(procurement_plan.block_id!= null){
          $("#blocks_" + random_procurement_id).append(new Option(procurement_plan.block_name, procurement_plan.block_id));
        }
      
       
        $("#lastqty" + random_procurement_id).val(procurement_plan.lastqty.toFixed(4)); 
        $("#lastval_" + random_procurement_id).val(procurement_plan.lastval.toFixed(4)); 
        if(procurement_plan.lastqty!=0 && procurement_plan.lastval!=0)
        {  
          $("#lastqty" + random_procurement_id).prop('readonly', true); 
          $("#lastval_" + random_procurement_id).prop('readonly', true);  
        }
        $("#currentqty_" + random_procurement_id).val(procurement_plan.qty); 
        $("#currentval_" + random_procurement_id).val(procurement_plan.val); 
         if(procurement_plan.qty!=null && procurement_plan.val!=null)
        {          
        $("#currentqty_" + random_procurement_id).prop('readonly', true); 
        $("#currentval_" + random_procurement_id).prop('readonly', true); 
        }
    }  
  } 


 $('.nextStep').on('click',function(){
    $("#submit").trigger("click");
 });
    $("#formID").submit(function(e) {
            e.preventDefault();
        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addMfpProcurementPartTwo.url;
            var method = conf.addMfpProcurementPartTwo.method; 
              if(form.submitter=='draft')
            {
                data.append('submit_type', 'draft');   
            }else{
                data.append('submit_type', 'submit');
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Successfully Added');
                     if(form.submitter=='submit')
                    {
                        setTimeout(function() { window.location = '../project-proposal/step3.php?id='+form_id}, 500);
                    }else{
                        setTimeout(function() { window.location = '../project-proposal/step2.php?id='+form_id}, 500);
                    }
                      } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    }); 

function RenderProposedMFP(random_proposed_mfp_id, proposed_mfp) {
    var source = $("#proposed_mfp_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_proposed_mfp_id: random_proposed_mfp_id,
      item: proposed_mfp
    });

    $("#other_proposed_mfp").append(rendered);
    checkNumeric();
    //initDecimalNumeric();
    var count = $(".delete_proposed_mfp").length; 
    fillFormMfp(formData.mfp_coverage,'#mfp_coverage_mfp_name_'+random_proposed_mfp_id);
    fillWarehouseMaster(warehousemaster_data,'#warehouse_'+random_proposed_mfp_id);
    fillHaatList(haatmaster_data,'#haat_'+random_proposed_mfp_id); 
    other_proposed_mfp_no_inc();

    if (proposed_mfp) 
    {   
      //console.log(proposed_mfp);
      $('#mfp_coverage_mfp_name_'+random_proposed_mfp_id).val(proposed_mfp.mfp_name).trigger('change');
      $('#warehouse_'+random_proposed_mfp_id).val(proposed_mfp.warehouse).trigger('change');
      $('#storage_type'+random_proposed_mfp_id).val(proposed_mfp.storage_type);
      $('#warehouse_type_'+random_proposed_mfp_id).val(proposed_mfp.warehouse_type);  
		
	  //if(proposed_mfp.storage_capacity != undefined){
		//proposed_mfp.storage_capacity = parseFloat(proposed_mfp.storage_capacity).toFixed(4);
	  //}
	  
	  
      $("#storage_capacity_" + random_proposed_mfp_id).val(decimalValues(proposed_mfp.storage_capacity));  
      $.each(proposed_mfp.storage_haat, function( i, v ){ 
              $("#haat_"+random_proposed_mfp_id +" option[value='" +v.haat + "']").prop("selected", true);
        });  
		//if(proposed_mfp.estimated_storage != undefined){
		//proposed_mfp.estimated_storage = parseFloat(proposed_mfp.estimated_storage).toFixed(4);
		//}
      $("#estimated_" + random_proposed_mfp_id).val(decimalValues(proposed_mfp.estimated_storage)); 
    }
     
    delete_proposed_mfp(random_proposed_mfp_id);
    $('#haat_'+random_proposed_mfp_id).select2();
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
    //initDecimalNumeric();
    var count = $(".delete_proposed_mfp").length;
    fillFormMfp(formData.mfp_coverage,'#mfp_coverage_mfp_name_'+random_proposed_mfp_id);   
    fillWarehouseMaster(warehousemaster_data,'#warehouse_'+random_proposed_mfp_id);    
    fillHaatList(haatmaster_data,'#haat_'+random_proposed_mfp_id); 
    
    other_proposed_mfp_no_inc();
    if (proposed_mfp) 
    {
        $("#mfp_id" + random_proposed_mfp_id).val(proposed_mfp.mfp_id);
        months=proposed_mfp.months;           
        $("#available_" + random_proposed_mfp_id).val(proposed_mfp.available);
        $("#plan_" + random_proposed_mfp_id).val(proposed_mfp.plan);
        $("#shg_group" + random_proposed_mfp_id).val(proposed_mfp.shg_group);
    } 
    delete_proposed_mfp(random_proposed_mfp_id);
    $('#haat_'+random_proposed_mfp_id).select2();
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

/*** Common js for form*/



fetchFinancialYear=()=>{
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
    currentFinancialYear = getCurrentFinancialYear();
    html = '<option value="">Select Financial Year</option>';
    $.each(years, function(i, year) {
      if(form_id!='' && formData.year_id!='')
        {
            if (year.id == formData.year_id) 
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

fetchMfpMaster=(random_mfp_coverage_id)=>{
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data=response.data;
           
        }
    });
}
fillMfpMaster = (mfps,item_id=0) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function(i, mfp) {
        html += '<option value="'+mfp.id+'">'+mfp.mfp_name+'</option>';
    });
    $(item_id).html(html);
}

function fillFormMfp(formdata,item_id)
{
   
    html = '<option value="">Select MFP</option>';
    $.each(formdata, function(i, mfp) {
      if(mfp.mfp_id != null){
        html += '<option value="'+mfp.mfp_id+'">'+mfp.getMfpData.title+'</option>';
      }
    });
    $(item_id).html(html);
}


fetchBlockList = () => {
    var url = conf.getHaatMasterList.url;
    var method = conf.getHaatMasterList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            blockmaster_data=response.data;
        }
    });
}

fillBlockList= (Blocks,item_id) => {

            
    html = '<option value="">Select Block</option>';
    $.each(Blocks, function(i, Block) {  //console.log(Block['block_ids']);
      $.each(Block['block_ids'], function(i, Blockdata) { //console.log(Blockdata);
        html += '<option value="'+Blockdata.block_id+'">'+Blockdata.block_name+'</option>';
    });
      });
    $(item_id).html(html);
}

fetchWarehouseMaster=(random_warehouse_id)=>{
    var url = conf.getWarehouse.url;
    var method = conf.getWarehouse.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            warehousemaster_data=response.data;
           
        }
    });
}
fillWarehouseMaster = (warehouseMaster,item_id=0) => {  
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouseMaster, function(i, warehouse) { 
        html += '<option value="'+warehouse.id+'">'+warehouse.warehouse_name+'</option>';
    });
    $(item_id).html(html);
}


fetchHaatList = () => {
    var url = conf.getHaatMasterList.url;
    var method = conf.getHaatMasterList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            haatmaster_data=response.data;
        }
    });
}

fillHaatList= (Haats,item_id) => {
    html = '<option value="">Select Haat</option>';
	html = '';
    $.each(Haats, function(i, Haat) {
        html += '<option value="'+Haat.id+'">'+Haat.haat_bazaar_name+'</option>';
    });
    $(item_id).html(html);
}
$(document).on('change','.mfp_coverage_haat', function (ev) {
    const v = $(this).val();
    var item_id = $(this).attr('data-id');
    if($(this).val()!='')
    {
        fetchHaatBlock(v,'#blocks_'+item_id);    
    }
    
});

fetchHaatBlock = (id = 0,item_id=0) => {
    var url = conf.viewHaatMaster.url(id);
    var method = conf.viewHaatMaster.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            blocks=response.data.block_ids;
            fillHaatBlocks(blocks,item_id);
        }
    });
}
fillHaatBlocks = (blocks,item_id) => {
    html = '<option value="">Select Block</option>';
    $.each(blocks, function(i, block) {
        html += '<option value="'+block.block_id+'">'+block.block_name+'</option>';
    });
    $(item_id).html(html);
}

function getWarehouseDetail(item_id){
  var warehouse_id = $("#warehouse_"+item_id).val();
  var url = conf.getWarehouseFormDetail.url(warehouse_id);
  var method = conf.getWarehouseFormDetail.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
          warehouseData = response.data;
          if(warehouseData.storage_type){
            var html = '';
            html+=  '"<option value="'+warehouseData.storage_type+'" data-capacity="'+warehouseData.storage_capacity+'">'+warehouseData.storage_type+'</option>"';
           $('#storage_capacity_' + item_id).addClass('ware'+warehouse_id);
            $("#storage_type"+item_id).html(html);
          }
        
         
          //$("#storage_type"+item_id).val(warehouseData.storage_type);
        //  console.log(warehouseData);
         
      }
  });
}
  
function maxQty(id) { 
    var ware_Id = $("#warehouse_" + id + " option:selected").val();
    var total_avality = $("#storage_type" + id + " option:selected").attr('data-capacity'); 
    var total_qty = 0; 
    $('.ware'+ware_Id).each(function () {
        total_qty += parseFloat($(this).val());
    });
    console.log(total_qty);
    if (total_qty > total_avality) {
        alert('Available Storage Capacity Qty Should not be greater than ' + total_avality);
        $("#storage_capacity_" + id).val(''); 
        return false;
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
