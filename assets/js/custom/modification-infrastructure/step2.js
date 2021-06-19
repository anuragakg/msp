
    var url_var = getUrlVars();
    var mfpmaster_data={};
  var warehousemaster_data={};
  var haatmaster_data={}; 
  var form_id='';
    var form_data='';
  $(document).ready(function() {
    fetchFinancialYear();
    fetchWarehouseMaster();
    // fetchMfpMaster();
    //
     
  });
    if(url_var['id']!=undefined){  
        form_id = url_var['id'];  
        $(document).ready(function() {
        form_data=fetchFormData(form_id);
         $('#year_id').val(form_data.year_id)
      });
        $('#preview').show();
        $('#preview').on('click',function(){
        window.location = '../modification-infrastructure/view-infrastructure.php?id='+form_id
        });
         $('#previous').on('click',function(){
        window.location = '../modification-infrastructure/step1.php?id='+form_id
    });
    }


function getAllSelectedMfps(form_id,item_id){

    var url = conf.getAllSelectedMfps.url(form_id);
    var method = conf.getAllSelectedMfps.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
        data = response.data;   
        fillFormMfp(data,item_id);
       // console.log(data);         
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}

function fillFormMfp(formdata,item_id)
{
    html = '<option value="" disabled>Select MFP</option>';
    
    $.each(formdata, function(i, mfp) { 
            html += '<option value="'+i+'">'+mfp+'</option>';
    });
    // /alert(html);
    //$(".corresponding-mfps").html(html);
    $("#mfp_"+item_id).html(html);
}
fetchFormData=(form_id)=>{
    var url = conf.getInfrastructurePartOne.url(form_id);
        var method = conf.getInfrastructurePartOne.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
            data = response.data;   
            // console.log(data);
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
        return data;
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
            var url = conf.addInfrastructurePartTwo.url;
            var method = conf.addInfrastructurePartTwo.method; 
            if (form_data != undefined && form_data != '') 
            {
                data.append('form_id', form_data.id );
            }
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
                        setTimeout(function() { window.location = '../modification-infrastructure/step3.php?id='+form_id}, 500);
                    }else{
                        setTimeout(function() { window.location = '../modification-infrastructure/step2.php?id='+form_id}, 500);
                    } 
                        } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    }); 

 
$(document).ready(function() {
  var other_proposed_mfp = "";
  var random_proposed_mfp_id = Date.now();
  $("#addproposed_mfp").click(function() {
    random_proposed_mfp_id = Date.now();
    RenderProposedMFP(random_proposed_mfp_id,other_proposed_mfp);
    getAllSelectedMfps(url_var['id'],random_proposed_mfp_id);
  }); 
  other_proposed_mfp=form_data.warehouse_facilities; 
  if (other_proposed_mfp != null && other_proposed_mfp.length) { 
    var proposed_mfp_no = 0;
    $.each(other_proposed_mfp, function(key, proposed_mfp) {
      ++proposed_mfp_no;
      random_proposed_mfp_id = proposed_mfp_no;
      RenderProposedMFP(random_proposed_mfp_id, proposed_mfp);
     //getAllSelectedMfps(url_var['id'],random_proposed_mfp_id);
    });
  } else {
    proposed_mfp = {};
    RenderProposedMFP(random_proposed_mfp_id, proposed_mfp);
    getAllSelectedMfps(url_var['id'],random_proposed_mfp_id);
  }
}); 

function RenderProposedMFP(random_proposed_mfp_id, proposed_mfp) {
    var source = $("#proposed_mfp_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_proposed_mfp_id: random_proposed_mfp_id,
      proposed_mfp: proposed_mfp
    });

    $("#other_proposed_mfp").append(rendered);     
    fillWarehouseMaster(warehousemaster_data,'#warehouse_'+random_proposed_mfp_id,random_proposed_mfp_id);     
    //fillMfpMaster(mfpmaster_data,'#mfp_'+random_proposed_mfp_id);     
    getAllSelectedMfps(url_var['id'],random_proposed_mfp_id);
    if(proposed_mfp!='' && proposed_mfp!=null)
    {   // console.log(proposed_mfp.mfp_id);
       $('#warehouse_'+random_proposed_mfp_id).val(proposed_mfp.warehouse).trigger('change');
       //$('#block_'+random_proposed_mfp_id).val(proposed_mfp.block).trigger('change');
       //$('#mfp_'+random_proposed_mfp_id).val(proposed_mfp.mfp_id).trigger('change');
       $.each(proposed_mfp.block_data, function( i, v ){ 
              $("#block_"+random_proposed_mfp_id +" option[value='" +v.block_id + "']").prop("selected", true);
        });
       $.each(proposed_mfp.mfp_data, function( i, v ){ 
              $("#mfp_"+random_proposed_mfp_id +" option[value='" +v.mfp_id + "']").prop("selected", true);
        });
       $('#storage_'+random_proposed_mfp_id).val(proposed_mfp.storage_type).trigger('change');
       $('#storage_capacity_'+random_proposed_mfp_id).val(proposed_mfp.storage_capacity);
       $('#estimated_fund_'+random_proposed_mfp_id).val(proposed_mfp.estimated_fund);
    }
    var count = $(".delete_proposed_mfp").length;  
    other_proposed_mfp_no_inc(); 
    delete_proposed_mfp(random_proposed_mfp_id); 
      $('#block_'+random_proposed_mfp_id).select2();
    $('#mfp_'+random_proposed_mfp_id).select2();
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
    html = '<option value="">Select Financial Year</option>';
    $.each(years, function(i, year) {
        html += '<option value="'+year.id+'">'+year.title+'</option>';
    });
    $('#year_id').html(html);
}
// fetchMfpMaster=(random_mfp_coverage_id)=>{
//     var url = conf.getMfp.url;
//     var method = conf.getMfp.method;
//     var data = {};
//     TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
//         if (response) {
//             mfpmaster_data=response.data;
           
//         }
//     });
// }
// fillMfpMaster = (mfps,item_id=0) => {
//     html = '<option value="">Select MFP</option>';
//     $.each(mfps, function(i, mfp) {
//         html += '<option value="'+mfp.id+'">'+mfp.mfp_name+'</option>';
//     });
//     $(item_id).html(html);
// }


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

            
    html = '<option value="" disabled>Select Block</option>';
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
fillWarehouseMaster = (warehouseMaster,item_id=0,tblId) => {  
    html = '<option value="" disabled>Select Warehouse</option>';
    $.each(warehouseMaster, function(i, warehouse) { 
        html += '<option value="'+warehouse.id+'" warehouse="'+warehouse.warehouse_id+'">'+warehouse.warehouse_name+'</option>';
    });
    $(item_id).html(html);
    
}
 $(document).on('change','.warehouse_change', function (ev) {
    //const v = $(this).val();
  var item_id = $(this).attr('data-id');
    var v = $('option:selected', this).attr('warehouse');
    
    if($(this).val()!='')
    {
        fetchWarehouseBlock(v,item_id);   
    }
    
}); 
fetchWarehouseBlock = (id = 0,item_id=0) => {
     var url = conf.getWarehouse.url;
    var method = conf.getWarehouse.method;
    var data = {};
        data.warehouse=id;
    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response.status) {
            data = response.data;
            fillBlocks(data,item_id)
        }  
    }); 
}
fillBlocks = (result,tblId) => {          
    html = '<option value="" disabled>Select Block</option>';
    storage = '<option value="" disabled>Select Storage</option>';
	storage = '';
    $.each(result, function(i, warehouse) {  
        storage += '<option value="'+warehouse.storage_type+'">'+warehouse.storage_type+'</option>';
         $.each(warehouse.WarehouseBlocksDetails, function(i, block) {  
        html += '<option value="'+block.block_id+'">'+block.block_name+'</option>';
    });
    }); 
    $('#block_'+tblId).html(html);
    $('#storage_'+tblId).html(storage);
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
    html = '<option value="" disabled>Select Haat</option>';
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
    html = '<option value="" disabled >Select Block</option>';
    $.each(blocks, function(i, block) {
        html += '<option value="'+block.block_id+'">'+block.block_name+'</option>';
    });
    $(item_id).html(html);
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

function isNumber(ev) {
    if (ev.type === "paste" || ev.type === "drop") {
        var textContent = (ev.type === "paste" ? ev.clipboardData : ev.dataTransfer).getData('text');
        return !isNaN(textContent) && textContent.indexOf(".") === -1;
    } else if (ev.type === "keydown") {
        if (ev.ctrlKey || ev.metaKey) {
            return true
        };
        var keysToAllow = [8, 46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
        return keysToAllow.indexOf(ev.keyCode) > -1;
    } else {
        return true
    }
}
