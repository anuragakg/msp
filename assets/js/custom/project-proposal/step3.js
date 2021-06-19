var auth = TRIFED.getLocalStorageItem();
var district_id = auth.district_id;
var district_name = auth.district;
var mfpmaster_data = {};
var haatmaster_data = {};



var formData = {};
var warehouses = {};
var url_var = getUrlVars();
var form_id = url_var['id'];
var overheadData = [];
var estimatedLosses = [];
var CostOfPackagingMaterial = [];
var MultipurposeProcurementItem_data = [];
var CategoryList = [];


$(document).ready(function () {
    
    //initDecimalNumeric();
    fetchPrimaryLevelAgencyList();
    fetchHaatList();
    fetchProcurementCenterList();
    fetchFormData(url_var['id']);    
    fetchWarehouse();    
    fetchPackingMaterial();
    //fetchCategories();
    fetchCostOfPackagingMaterial(url_var['id']);
    //redirect on listing if already submitted form
    if(formData.submission_status == 1){
        window.location = '../project-proposal/mfp-procurement-listing.php' ;
    
    }
    if (url_var['id'] != undefined) {
        form_id = url_var['id'];
       
        $('#preview').on('click', function () {
            window.location = '../project-proposal/view-mfp-procurement.php?id=' + form_id
        });

        $('#previous').on('click', function () {
            window.location = '../project-proposal/step3.php?id=' + form_id
        });
        $('.mfp-coverage-tab').on('click', function () {
           
            window.location = '../project-proposal/step1.php?id=' + form_id
        });
        $('.procurement-tab').on('click', function () {
            window.location = '../project-proposal/step2.php?id=' + form_id
        });

        if(formData.is_step3_complete){
            $('.summary-tab').on('click',function(){
                window.location = '../project-proposal/step4.php?id='+form_id
            });
            
        }
      
    }
    
   
   

    if(formData.getMfpDisposal && formData.getMfpDisposal!=null && formData.getMfpDisposal!=''){
        var disposaldata=formData.getMfpDisposal;
        random_mfp_disposal_plan_id=0;
        $.each(disposaldata, function(key, itemdata) {
            ++random_mfp_disposal_plan_id;
            RenderDisposalPlan(random_mfp_disposal_plan_id, itemdata);
        });
    }else{
        var disposaldata=[];
        Random_id = Date.now();
        var random_mfp_disposal_plan_id = Random_id;
        RenderDisposalPlan(random_mfp_disposal_plan_id, disposaldata);
    }
    if(formData.mfp_coverage && formData.mfp_coverage!=null && formData.mfp_coverage!='')
    {
        var mfp_coveragedata=formData.mfp_coverage;
        random_estimated_loss_id=0;
        $.each(mfp_coveragedata, function(key, itemdata) {
            ++random_estimated_loss_id;
            RenderEstimatedLoss(random_estimated_loss_id, itemdata);
            
        });
    }
    if(CostOfPackagingMaterial!=null && CostOfPackagingMaterial!='')
    {
        packing_level_row=0;
        $.each(CostOfPackagingMaterial, function(key, itemdata) {
            ++packing_level_row;
            random_packing_material_id = Date.now()+packing_level_row;
        
            RenderCostOfPackagingMaterial(random_packing_material_id, itemdata);
        });
    }
    //============Get estimated lossed =============
    //fetchEstimatedLosses(url_var['id']);
    //==============================================

    $("#formID").submit(function(e) {

           // e.preventDefault();
        }).validate({
        rules: {
          
            
        },
        submitHandler: function(form) { 
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addMfpProcurementPartThree.url;
            var method = conf.addMfpProcurementPartThree.method;
            if (form_id != undefined && form_id != '') 
            {
                data.append('form_id', form_id );
            }
            if(form.submitter=='draft')
            {
                data.append('submit_type', 'draft');   
            }else{
                data.append('submit_type', 'submit');
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    form_id=response.data.ref_id;
                    $('#preview').show();
                    TRIFED.showMessage('success', 'Successfully Added');
                    if(form.submitter=='submit')
                    {
                        setTimeout(function() { window.location = '../project-proposal/step4.php?id='+form_id}, 500);
                    }else{
                        setTimeout(function() { window.location = '../project-proposal/step3.php?id='+form_id}, 500);
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

$('#add_mfp_disposal_plan').click(function () {
    random_mfp_disposal_plan_id = Date.now();
    RenderDisposalPlan(random_mfp_disposal_plan_id);
    mfp_disposal_plan_no_inc();
});

function RenderDisposalPlan(random_mfp_disposal_plan_id, itemsdata) {
    
    var source = $("#mfp_disposal_plan_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_disposal_plan_id: random_mfp_disposal_plan_id,
        itemdata: itemsdata,
    });
    $("#mfp_disposal_plan_container").append(rendered);
    fillFormMfp(formData.mfp_coverage,'#mfp_disposal_'+random_mfp_disposal_plan_id);
    
    mfp_disposal_plan_no_inc();
    
    

    if (itemsdata != '' && itemsdata != null) {
        $('#mfp_disposal_'+random_mfp_disposal_plan_id).val(itemsdata.mfp_id);
        disposalPlanWarehouseData = itemsdata.getWarehouseData;
        $.each(disposalPlanWarehouseData, function (key, itemdata) {
            RenderDisposalWarehouse(random_mfp_disposal_plan_id, itemdata)
        });
    } else {
        disposalWarehouseData = [];
        RenderDisposalWarehouse(random_mfp_disposal_plan_id, disposalWarehouseData)
    }
}
function RenderEstimatedLoss(random_estimated_loss_id, itemsdata)
{
    var source = $("#estimated_loss_template").html();
    Mustache.parse(source);
    previous_year_estimated_qty_readonly='';
    previous_year_estimated_value_readonly='';
    if(itemsdata.previous_year_estimated_qty!='' && parseFloat(itemsdata.previous_year_estimated_qty)>0)
    {
        previous_year_estimated_qty_readonly='readonly';
    }
    if(itemsdata.previous_year_estimated_value!='' && parseFloat(itemsdata.previous_year_estimated_value)>0)
    {
        previous_year_estimated_value_readonly='readonly';
    }
    var rendered = Mustache.render(source, {
        random_estimated_loss_id: random_estimated_loss_id,
        itemdata: itemsdata,
        previous_year_estimated_qty_readonly:previous_year_estimated_qty_readonly,
        previous_year_estimated_value_readonly:previous_year_estimated_value_readonly,
    });
    $("#estimated_loss_container").append(rendered);
     mfp_estimated_no_inc(random_estimated_loss_id);
}

  function mfp_estimated_no_inc() {
         var estimated_mfp_no = 0;
    $(".estimated_mfp_no").each(function() {
      ++estimated_mfp_no;
      $(this).html(estimated_mfp_no);
    });
    }

function RenderCostOfPackagingMaterial(random_packing_material_id, itemsdata)
{
    var source = $("#packing_material_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_packing_material_id: random_packing_material_id,
        itemdata: itemsdata,
    });
    $("#packing_material_container").append(rendered);
    fillFormMfp(formData.mfp_coverage,'#packing_material_mfp_id'+random_packing_material_id);
  
   
    $('#packing_material_mfp_id'+random_packing_material_id).val(itemsdata.mfp_id);
    fillHaatList(haatmaster_data,'#packing_material_haat_id'+random_packing_material_id);
    fillHaatList(haatmaster_data,'#packing_material_haat_id_hidden'+random_packing_material_id);
    
    $.each(itemsdata.haat, function( i, v ){
        $("#packing_material_haat_id"+random_packing_material_id +" option[value='" + v + "']").prop("selected", true);
        $("#packing_material_haat_id_hidden"+random_packing_material_id +" option[value='" + v + "']").prop("selected", true);
    });
    
    $('#packing_material_haat_id'+random_packing_material_id).select2();
    
    fillWarehouses(warehouses,'#packing_material_warehouse'+random_packing_material_id);
    $('#packing_material_warehouse'+random_packing_material_id).val(itemsdata.warehouse);
    fillPackingMaterial(packig_material_types,'#packing_material_type'+random_packing_material_id);
    //fillCategories(CategoryList,'#packing_material_category'+random_packing_material_id);
    if(itemsdata.packing_material_type!=null)
    {
        $('#packing_material_type'+random_packing_material_id).val(itemsdata.packing_material_type).trigger('change');    
    }
    if(itemsdata.category!=null)
    {
        $('#packing_material_category'+random_packing_material_id).val(itemsdata.category);    
    }
    if(itemsdata.size!=null){
        $('#packing_material_size'+random_packing_material_id).val(itemsdata.size);    
    }
}
function fillFormMfp(formdata,item_id)
{
    html = '<option value="">Select MFP</option>';
    $.each(formdata, function(i, mfp) {
        if(mfp.mfp_id != null)
        {
            html += '<option value="'+mfp.mfp_id+'">'+mfp.getMfpData.title+'</option>';
        }   
    });
    $(item_id).html(html);
}
    function RenderDisposalWarehouse(random_mfp_disposal_plan_id, itemsdata) {
        // var labels_no = $(".delete_disposal_plan").length;
        // ++labels_no;
        var source = $("#mfp_disposal_plan_warehouse_template").html();
        Mustache.parse(source);
        var random_mfp_disposal_plan_warehouse_id = Date.now();
        var rendered = Mustache.render(source, {
            random_mfp_disposal_plan_id: random_mfp_disposal_plan_id,
            random_mfp_disposal_plan_warehouse_id: random_mfp_disposal_plan_warehouse_id,
            itemdata: itemsdata,
        });
        $("#mfp_disposal_plan_warehouse_info_" + random_mfp_disposal_plan_id).append(rendered);
        fillWarehouses(warehouses,'#warehouse_dispossal_'+random_mfp_disposal_plan_id+'_'+random_mfp_disposal_plan_warehouse_id);
        if (itemsdata != '' && itemsdata != null) {
			itemsdata.value = parseFloat(itemsdata.value).toFixed(4);
			itemsdata.qty = parseFloat(itemsdata.qty).toFixed(4);
            
            if(itemsdata.value!='' && !isNaN(itemsdata.value))
            {
                $('#disposal_value'+random_mfp_disposal_plan_warehouse_id).val(itemsdata.value).trigger('change');    
            }
            if(itemsdata.qty!='' && !isNaN(itemsdata.qty)){
                $('#disposal_qty'+random_mfp_disposal_plan_warehouse_id).val(itemsdata.qty).trigger('change');    
            }
            
            $.each(itemsdata.months, function( i, v ){
                  $("#quarter"+random_mfp_disposal_plan_warehouse_id +" option[value='" + v.month + "']").prop("selected", true);
            });
        }
        $('#warehouse_dispossal_'+random_mfp_disposal_plan_id+'_'+random_mfp_disposal_plan_warehouse_id).val(itemsdata.warehouse_id)
        $('#quarter'+random_mfp_disposal_plan_warehouse_id).select2();
        mfp_disposal_plan_warehouse_no_inc(random_mfp_disposal_plan_id);
       
    }

   
    function delete_disposal_plan(random_mfp_disposal_plan_id) {
        var count = $(".main-div").length;
        if (count > 1) {
            $("#delete_disposal_plan" + random_mfp_disposal_plan_id).remove();
            mfp_disposal_plan_no_inc();
        }
    }

    function delete_disposal_plan_warehouse(random_mfp_disposal_plan_id,random_mfp_disposal_plan_warehouse_id) {
       
        var count = $(".remove_disposal_plan_warehouse_"+random_mfp_disposal_plan_id).length;
       // alert(count);
        if (count > 1) {
            $("#disposal_plan_warehouse_info" + random_mfp_disposal_plan_warehouse_id).remove();
            mfp_disposal_plan_warehouse_no_inc(random_mfp_disposal_plan_id);
            //change total value on delete
            if (random_mfp_disposal_plan_warehouse_id in data){
                
                warehouse_wise_total_qty[random_mfp_disposal_plan_id] = parseFloat(parseFloat(warehouse_wise_total_qty[random_mfp_disposal_plan_id]) - parseFloat(data[random_mfp_disposal_plan_warehouse_id])).toFixed(4);

                delete data[random_mfp_disposal_plan_warehouse_id];

                $("#warehouse_wise_total_qty_"+random_mfp_disposal_plan_id).val(decimalValues(warehouse_wise_total_qty[random_mfp_disposal_plan_id]));
            }
            if (random_mfp_disposal_plan_warehouse_id in warehouse_value_data){
                warehouse_wise_total_value[random_mfp_disposal_plan_id] = warehouse_wise_total_value[random_mfp_disposal_plan_id] - warehouse_value_data[random_mfp_disposal_plan_warehouse_id];
                delete warehouse_value_data[random_mfp_disposal_plan_warehouse_id];
                $("#warehouse_wise_total_value_"+random_mfp_disposal_plan_id).val(decimalValues(warehouse_wise_total_value[random_mfp_disposal_plan_id]));
            }
        }
    }

    function mfp_disposal_plan_no_inc() {
        var count = $(".remove_disposal_plan").length;
        // alert(count);
        $('.remove_disposal_plan').show();
        $('.remove_disposal_plan').first().hide();   
    }

    function mfp_disposal_plan_warehouse_no_inc(random_mfp_disposal_plan_id) {
        var count = $(".remove_disposal_plan_warehouse_"+random_mfp_disposal_plan_id).length;
        //alert(count+'-'+random_mfp_disposal_plan_id);
        $('.remove_disposal_plan_warehouse_'+random_mfp_disposal_plan_id).show();
        $('.remove_disposal_plan_warehouse_'+random_mfp_disposal_plan_id).first().hide();   
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

    function add_mfp_disposal_plan_warehouse(random_mfp_disposal_plan_id) {
        itemdata = [];
        RenderDisposalWarehouse(random_mfp_disposal_plan_id, itemdata);
    }

    
    // function delete_mfp_disposal_plan_warehouse_server(random_mfp_disposal_plan_id, random_mfp_disposal_plan_warehouse_id, serverid) {
    //     if (confirm('Do you really want to delete this ? After clicking this it will be permanently deleted')) {
    //         var url = conf.deleteMfpCoverageBlockHaat.url;
    //         var method = conf.deleteMfpCoverageBlockHaat.method;
    //         var data = { id: serverid };
    //         TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    //             if (response.status) {
    //                 TRIFED.showMessage('success', 'Deleted Successfully');
    //                 var count = $(".delete_mfp_diposal_plan_warehouse_" + random_mfp_disposal_plan_id).length;
    //                 if (count > 1) {
    //                     $("#delete_mfp_disposal_plan_warehouse_" + random_mfp_disposal_plan_warehouse_id).remove();
                     
    //                 }

    //             }
    //         });
    //     }

    // }
/****start labour charges js here */
/****end labour charges js here */
   
/*** Common js for form*/

fetchFormData=(form_id)=>{
    var url = conf.getProcurementDetail.url(form_id);
    var method = conf.getProcurementDetail.method;
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

fetchWarehouse=()=>{
    var url = conf.getWarehouse.url;
        var method = conf.getWarehouse.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                warehouses = response.data;
            
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
        return data;
}
fillWarehouses = (warehouses,item_id=0) => {
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouses, function(i, warehouse) {
        html += '<option value="'+warehouse.id+'">'+warehouse.warehouse_name+'</option>';
    });
    $(item_id).html(html);
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

fetchPackingMaterial=()=>{
    var url = conf.getPackingMaterial.url;
        var method = conf.getPackingMaterial.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                packig_material_types = response.data;
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
        return data;
}

fillPackingMaterial= (packing_materials,element_id) => {
    let html = '<option value="">Select </option>';
    $.each(packing_materials, function(i, packing_material) {
        html += '<option value="'+packing_material.id+'" data-bag_name="'+packing_material.bag_name+'" data-specifications="'+packing_material.specifications+'" >'+packing_material.bag_type+'</option>';
    });
    $(element_id).html(html);
}
// fetchCategories=()=>{
//     var url = conf.getCategoryList.url;
//         var method = conf.getCategoryList.method;
//         var data = {};
//         TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
//             if (response.status) {
//                 CategoryList = response.data;
//             } else {
//                 TRIFED.showMessage('error', cb);
//             }
//         });
//         return data;
// }
// fillCategories= (CategoryList,element_id) => {
//     let html = '<option value="">Select Category</option>';
//     $.each(CategoryList, function(i, category) {
//         html += '<option value="'+category.id+'" >'+category.title+'</option>';
//     });
//     $(element_id).html(html);
// }
$(document).on('change','.packig_material_types',function(){
    let row_id=$(this).attr('row-id');
    var selected = $(this).find('option:selected');
    var bag_name = selected.data('bag_name'); 
    var specifications = selected.data('specifications'); 
    $('#packing_material_bag_name'+row_id).val(bag_name);
    $('#packing_material_specifications'+row_id).val(specifications);
});

fetchCostOfPackagingMaterial=(id)=>{
    var url = conf.getCostOfPackagingMaterial.url(id);
        var method = conf.getCostOfPackagingMaterial.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                console.log(response.data);
                CostOfPackagingMaterial = response.data;
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
               
}

/*** To calculate total estimated labour cost***/
function calculateTotalPackingCost(random_id) {

    var total_packing_bags = $("#total_packing_bags_" + random_id).val() ? parseFloat($("#total_packing_bags_" + random_id).val()) : '0';
    var unit_cost = $("#unit_cost_" + random_id).val() ? parseFloat($("#unit_cost_" + random_id).val()) : '0';
  
    if (unit_cost != '' && total_packing_bags != '') {
        //calculate value
        total_packing_cost = unit_cost * total_packing_bags;
        //populate in field
        $("#total_cost_of_packaging_material_" + random_id).val(total_packing_cost);
    } else {
        $("#total_cost_of_packaging_material_" + random_id).val('0');
    }



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
    $.each(Haats, function(i, Haat) {
        html += '<option value="'+Haat.id+'">'+Haat.haat_bazaar_name+'</option>';
    });
    $(item_id).html(html);
}
fetchProcurementCenterList = () => {
    var url = conf.getProcurementCenter.url;
    var method = conf.getProcurementCenter.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            MultipurposeProcurementItem_data=response.data;
        }
    });
}

fillProcurementCenterList= (Procurements,item_id) => {
    let html = '<option value="">Select Procurement Center</option>';
    $.each(Procurements, function(i, Procurement) {
        html += '<option value="'+Procurement.id+'">'+Procurement.name+'</option>';
    });
    $(item_id).html(html);
}

fetchPrimaryLevelAgencyList = () => {
    var url = conf.getPrimaryLevelAgency.url;
    var method = conf.getPrimaryLevelAgency.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            primaryLevelAgency=response.data;      
         
        }
    });
}


fillPrimaryLevelAgency= (primaryLevelAgency,item_id) => {
    let html = '<option value="">Select</option>';
    $.each(primaryLevelAgency, function(i, agency) {
      
        html += '<option value="'+agency.id+'">'+agency.name+'</option>';
    });
    $(item_id).html(html);
}


/*** To calculate total warehouse qty in mfp-proposal-form***/
var warehouse_wise_total_qty = []; 
var data = {};
function calculateStorewiseQty(random_mfp_disposal_plan_id,random_mfp_disposal_plan_warehouse_id){
    //check key exist in object then delete previos value 
    if (random_mfp_disposal_plan_warehouse_id in data){
        warehouse_wise_total_qty[random_mfp_disposal_plan_id] = warehouse_wise_total_qty[random_mfp_disposal_plan_id] - data[random_mfp_disposal_plan_warehouse_id];
		
        delete data[random_mfp_disposal_plan_warehouse_id];
       
    }
	
    //add new value in object
    var uiVal =$("input[name='mfp_disposal_form["+random_mfp_disposal_plan_id+"][qty]["+random_mfp_disposal_plan_warehouse_id+"]']").val();
   
    if(uiVal == ''){
        data[random_mfp_disposal_plan_warehouse_id] = 0;
    }else{
        data[random_mfp_disposal_plan_warehouse_id] = uiVal;
    }
    //calculate value
    if(warehouse_wise_total_qty[random_mfp_disposal_plan_id] == NaN || warehouse_wise_total_qty[random_mfp_disposal_plan_id] == undefined){
        total_qty = 0;
    }else{
        total_qty = warehouse_wise_total_qty[random_mfp_disposal_plan_id];
		
    }
    warehouse_wise_total_qty[random_mfp_disposal_plan_id] = parseFloat(total_qty) + parseFloat( data[random_mfp_disposal_plan_warehouse_id]);
    //populate in field
	console.log(warehouse_wise_total_qty[random_mfp_disposal_plan_id]);
    $("#warehouse_wise_total_qty_"+random_mfp_disposal_plan_id).val(decimalValues(warehouse_wise_total_qty[random_mfp_disposal_plan_id]));
    
   
}

/*** To calculate total warehouse wise value in mfp-proposal-form***/
var warehouse_wise_total_value = []; 
var warehouse_value_data = {};
function calculateStorewiseValue(random_mfp_disposal_plan_id,random_mfp_disposal_plan_warehouse_id){
    
     //check key exist in object then delete previous value 
     if (random_mfp_disposal_plan_warehouse_id in warehouse_value_data){
        warehouse_wise_total_value[random_mfp_disposal_plan_id] = warehouse_wise_total_value[random_mfp_disposal_plan_id] - warehouse_value_data[random_mfp_disposal_plan_warehouse_id];
        delete warehouse_value_data[random_mfp_disposal_plan_warehouse_id];
       
    }
    //add new value in object
     //add new value in object
     var uiVal =$("input[name='mfp_disposal_form["+random_mfp_disposal_plan_id+"][value]["+random_mfp_disposal_plan_warehouse_id+"]']").val(); 
     if(uiVal == ''){
        warehouse_value_data[random_mfp_disposal_plan_warehouse_id] = 0;
     }else{
        warehouse_value_data[random_mfp_disposal_plan_warehouse_id] = uiVal;
     }
    
    if(warehouse_wise_total_value[random_mfp_disposal_plan_id] == NaN || warehouse_wise_total_value[random_mfp_disposal_plan_id] == undefined){
        total_qty = 0;
    }else{
        total_qty = warehouse_wise_total_value[random_mfp_disposal_plan_id];
    }
    
    //calculate value
    warehouse_wise_total_value[random_mfp_disposal_plan_id] = total_qty + parseFloat( warehouse_value_data[random_mfp_disposal_plan_warehouse_id]); 

    //populate in field
    $("#warehouse_wise_total_value_"+random_mfp_disposal_plan_id).val(decimalValues(warehouse_wise_total_value[random_mfp_disposal_plan_id]));
  
    
}
function readonly_select2(objs, action) {
    objs.prepend('<div class="disabled-select"></div>');
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
  
  