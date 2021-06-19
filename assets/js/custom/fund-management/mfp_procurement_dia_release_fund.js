var auth = TRIFED.getLocalStorageItem();
const id= TRIFED.getUrlParameters().id;
var balance_amount=0;
var agent_list={};
var mfp_result={};
var bank_list={};
var mfp_qty=[];
var mfp_master_value=[];
$(function () {
   fetchBankList();
   fetchDiaReleaseDetails(id);
   fetchSeasonalityDetails(id);
   fetchProcurementAgent();
   RenderProcurementAgentBlock();
   //RenderMfp();
   //RenderFundDetails();
   
});

$(document).ready(function() {
   
});
fetchDiaReleaseDetails = (id) => {
    var url = conf.getProcurementReceivedFundData.url(id);
    var method = conf.getProcurementReceivedFundData.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillFields(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillFields = (data) => {
    if(data.file_number!='' && data.file_number!=null)
    {
        $('#file_number').val(data.file_number).prop('readonly',true);
        $('#sanction_date').val(data.sanction_date).prop('readonly',true);
        /*$('#transaction_id').val(data.transaction_id).prop('readonly',true);
        $('#transaction_date').val(data.transaction_date).prop('readonly',true);*/
    }
    $('#proposal_id').html(data.proposal_id);
    $('#reference_number').html(data.reference_number);
    $('#approved_amount').html(utils.formatCurrency(data.total_fund_require));
    $('#released_amount').html(utils.formatCurrency(data.total_released_to_procurement_agent));
    
    $('#balance_amount').html(utils.formatCurrency(data.total_can_released_to_procurement_agent));
    balance_amount=data.balance_amount;
    $('#release_percent').on('keyup',function(){
        var release_percent=$(this).val();
        if(release_percent!='')
        {
            release_percent=parseFloat(release_percent);
            balance_amount=parseFloat(balance_amount);
            var release_amount=(release_percent*balance_amount)/100;
            release_amount=release_amount.toFixed(4);
            $('#release_amount').val(utils.formatCurrency(release_amount));    
        }else{
            $('#release_amount').val(0);    
        }
        
    });
}
fetchSeasonalityDetails = (id) => {
    var url = conf.getMfpProcurementSeasonalityDetails.url(id);
    var method = conf.getMfpProcurementSeasonalityDetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillMfpDetails(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fillMfpDetails = (data) => {
    mfp_result=data;console.log(mfp_result)
    html='';var i=0;
    
    mfp_result.forEach(function(row){
        mfp_qty[row.mfp_id]=row.qty;
        mfp_master_value[row.mfp_id]=row.master_value;
        ++i;
        html +='<tr>';
            html +='<td>'+ i +'</td>';
            html +='<td>'+ row.mfp_name +'</td>';
            html +='<td class="textval-right">'+ row.qty +'</td>';
        html +='</tr>';
    });
    $('#mfp_list').html(html);
    
}
fetchBankList = () => {
    var url = conf.getBankList.url;
    var method = conf.getBankList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            bank_list=response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fetchProcurementAgent = () => {
    var url = conf.getProcurementAgentList.url;
    var method = conf.getProcurementAgentList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            //fill_agent_list(response.data);
            agent_list=response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fill_agent_list = (element_id) => {
    html='';
    agent_options='<option value="">Select Procurement Agent</option>';
    agent_list.forEach(function(row){
        
        agent_options +='<option value="'+row.id+'">'+row.user_name+'</option>';
    });
    $(element_id).html(agent_options);
    
}
$("#formID").submit(function(e) {

        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            

            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addDiaReleaseFundToProcurementAgent.url;
            var method = conf.addDiaReleaseFundToProcurementAgent.method;
            if (id != undefined && id != '') 
            {
                data.append('id', id );
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Fund Released Successfully');
                    setTimeout(function() { window.location = '../fund-management/mfp_procurement_received_fund.php'}, 500);
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            return false;  //This doesn't prevent the form from submitting.
        }
    });

function RenderProcurementAgentBlock()
{
    var Random_id=Date.now();
    var labels_no = $(".delete_procurement_agent").length;
    ++labels_no;
    var source = $("#procurement_agent_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_procurement_agent_id: Random_id,
        //itemdata: itemsdata,
    });
    $("#procurement_agent_container").append(rendered);
    fill_agent_list('#procurement_agent_'+Random_id);
    $('.remove_procurement_agent').show();
    $('.remove_procurement_agent').first().hide();

    RenderMfp(Random_id)
    RenderFundDetails(Random_id)
}
function delete_procurement_agent(random_id){
    count=$('.delete_procurement_agent').length;
    if(count>1)
    {
        $('#delete_procurement_agent'+random_id).remove();    
    }
    
    //inc_mfp_no();
}
function RenderMfp(random_procurement_agent_id) {
    var Random_id=Date.now();
    var labels_no = $(".delete_mfp_details").length;
    ++labels_no;
    var source = $("#mfp_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_id: Random_id,
        random_procurement_agent_id:random_procurement_agent_id,
        //itemdata: itemsdata,
    });
    $("#mfp_container_"+random_procurement_agent_id).append(rendered);
    fillMfp('#mfp_details_mfp_name_'+Random_id);
    inc_mfp_no(random_procurement_agent_id);
}
function inc_mfp_no(random_procurement_agent_id)
{
    var item_no = 0;
    $('.mfp_details_no_'+random_procurement_agent_id).each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    //var count = $(".delete_mfp_details").length;
    $('.remove_mfp_'+random_procurement_agent_id).show();
    $('.remove_mfp_'+random_procurement_agent_id).first().hide();
}
function fillMfp(element_id)
{
    mfp_options='<option value="">Select MFP</option>';
    var unique_mfp={};
    mfp_result.forEach(function(row){
        mfp_options +='<option value="'+row.mfp_id+'">'+row.mfp_name+'</option>';
    });
    $(element_id).html(mfp_options)
}
function delete_mfp(random_procurement_agent_id,random_mfp_id){
    $('#delete_mfp_details_'+random_procurement_agent_id+'_'+random_mfp_id).remove();
    inc_mfp_no(random_procurement_agent_id);
    setTotalValues(random_procurement_agent_id);
}

//=======================
function RenderFundDetails(random_procurement_agent_id) {
    var Random_id=Date.now();
    var labels_no = $(".delete_fund_release").length;
    ++labels_no;
    var source = $("#fund_release_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_fund_id: Random_id,
        random_procurement_agent_id:random_procurement_agent_id,
        //itemdata: itemsdata,
    });
    $("#fund_transfer_container_"+random_procurement_agent_id).append(rendered);
    fillBank('#fund_release_bank'+Random_id);
     $('#fund_release_transaction_date'+Random_id).datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });
    inc_fundtransfer_no(random_procurement_agent_id);
}
function inc_fundtransfer_no(random_procurement_agent_id)
{
    var item_no = 0;
    $('.fund_release_no_'+random_procurement_agent_id).each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    //var count = $(".delete_mfp_details").length;
    $('.remove_fund_release_'+random_procurement_agent_id).show();
    $('.remove_fund_release_'+random_procurement_agent_id).first().hide();
}
function fillBank(element_id)
{
    mfp_options='<option value="">Select Bank</option>';

    bank_list.forEach(function(row){
        mfp_options +='<option value="'+row.id+'">'+row.title+'</option>';
    });
    $(element_id).html(mfp_options)
}
function delete_fund_release(random_procurement_agent_id,random_fund_id){
    $('#delete_fund_release_'+random_procurement_agent_id+'_'+random_fund_id).remove();
    inc_fundtransfer_no(random_procurement_agent_id);
}
$(document).on('change','.mfp_name',function(){
    var mfp_id=$(this).val();
    var data_id=$(this).attr('data-id');
    var procurement_data_id=$(this).attr('procurement-data-id');
    qty=mfp_qty[mfp_id];
    value=mfp_master_value[mfp_id];
    total_value=parseFloat(qty)*parseFloat(value);
    total_value=total_value*1000;
    $('#mfp_details_qty_'+data_id).val(qty);
    $('#mfp_details_value_'+data_id).val(total_value.toFixed(4));
    setTotalValues(procurement_data_id);

});
$(document).on('keyup mouseup','.mfp_qty',function(){
    
    var data_id=$(this).attr('data-id');
    var procurement_data_id=$(this).attr('procurement-data-id');
    var mfp_id=$('#mfp_details_mfp_name_'+data_id).val();
    var qty=$(this).val();
    maximum_qty_limit=mfp_qty[mfp_id];
    
    value=mfp_master_value[mfp_id];
    total_value=parseFloat(qty)*parseFloat(value);
    total_value=total_value*1000;
    $('#mfp_details_value_'+data_id).val(total_value.toFixed(4));
    /*if(parseFloat(maximum_qty_limit)<parseFloat(qty))
    {
        //$(this).val(0);
        //$('#mfp_details_value_'+data_id).val(0);
        //alert('You can not enter quantity more than '+maximum_qty_limit);
    }else{
        value=mfp_master_value[mfp_id];
        total_value=parseFloat(qty)*parseFloat(value);
        $('#mfp_details_value_'+data_id).val(total_value);
    }*/
    setTotalValues(procurement_data_id);
});
function setTotalValues(procurement_data_id)
{
    var mfp_no=0;
    var mfp_qty=0;
    var mfp_value=0;

    $('.mfp_name_'+procurement_data_id).each(function () {
        ++mfp_no;
        $('#total_msp_count_'+procurement_data_id).val(mfp_no);
    });
    $('.mfp_qty_'+procurement_data_id).each(function () {
        mfp_qty +=parseFloat($(this).val());
        $('#total_quantity_'+procurement_data_id).val(mfp_qty);
    });
    $('.mfp_value_'+procurement_data_id).each(function () {
        mfp_value +=parseFloat($(this).val());
        $('#total_value_'+procurement_data_id).val(mfp_value.toFixed(4));
    });
}