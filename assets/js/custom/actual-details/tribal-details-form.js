var auth = TRIFED.getLocalStorageItem();
const id= TRIFED.getUrlParameters().id;
const proposal_id= TRIFED.getUrlParameters().proposal_id;
var mfp_result={};
var mfp_qty=[];
var mfp_master_value=[];
var id_types=[];
var proposals=[];
var balance_amount=0;
$(function () {
   fetchFundAvailable();
   fetchIdTypes();
   getProposals(id);
   
});

$(document).ready(function() {
    


    RenderTribals();

    /*$('#procurement_date').val(today);
    
   
    $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });

    
*/
   

});


function RenderTribals() {
    var today = new Date();
    var dd = today.getDate();

    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();
    if(dd<10) 
    {
        dd='0'+dd;
    } 

    if(mm<10) 
    {
        mm='0'+mm;
    } 
    today = dd+'/'+mm+'/'+yyyy;



    var Random_tribal_id=Date.now();
    var labels_no = $(".delete_tribal_details").length;
    ++labels_no;
    var source = $("#tribal_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_tribal_id: Random_tribal_id,
        today: today,
    });
    $("#tribal_container").append(rendered);
    fillTypes(id_types,'#id_type'+Random_tribal_id);
    fillProposals(proposals,'#proposal_id'+Random_tribal_id);
    $('#proposal_id'+Random_tribal_id).on('change',function(){
        if($(this).val()!='')
        {

            var id=$(this).val();
           
            var url = conf.getProcurementAgentProposalsMfp.url(id);
            var method = conf.getProcurementAgentProposalsMfp.method;
            var data = {};
            TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
                if (response) {
                    mfp_result[Random_tribal_id]=response.data;
                    //console.log(mfp_result)
                    RenderMfp(Random_tribal_id);
                    //fillMfp(response.data);
                } else {
                    $('#mfp_container').empty();
                    TRIFED.showMessage('error', cb);
                }
            });
            
        }else{
            $('#mfp_container').empty();
        }
    });
    $('input[type=radio][name=search_by'+Random_tribal_id+']').change(function() {
        if (this.value == 'id') {
            $('#search_by_name'+Random_tribal_id).hide();
        }
        else if (this.value == 'name') {
            
            $('#search_by_name'+Random_tribal_id).show();
        }
    });

    $('#id_type'+Random_tribal_id).on('change',function(){
        getTribalDetail(Random_tribal_id);
    });
    $('#id_value'+Random_tribal_id).on('blur',function(){
        getTribalDetail(Random_tribal_id);
    });


    $("#name_search"+Random_tribal_id).easyAutocomplete({
          url: function(phrase) {
            return endpoint+"proposal/getTribalDetailFromName?name_of_tribal="+phrase;
          },

          listLocation: "data",

          getValue: function(element) {
            return element.name_of_tribal;
          },

          ajaxSettings: {
            dataType: "json",
            method: "GET",
            headers: {
                        "Authorization": 'Bearer ' + auth.token
                    },
          },
          list: {
                match: {
                    enabled: true
                }
          },
          list: {
                onSelectItemEvent: function() {
                    var searchdata=$("#name_search"+Random_tribal_id).getSelectedItemData();
                    var id = searchdata.id;
                    var id_type = searchdata.id_type;
                    var id_value = searchdata.id_value;
                    var name_of_tribal = searchdata.name_of_tribal;
                    var bank_account_no = searchdata.bank_account_no;
                    var village_name = searchdata.village_name;
                    var bank_ifsc = searchdata.bank_ifsc;
                    var village_name = searchdata.village_name;
                    var address = searchdata.address;
                    var shg_id = searchdata.shg_id;
                    var tribal_image = searchdata.tribal_image;

                    $('#id_type'+Random_tribal_id).val(id_type);
                    $('#id_value'+Random_tribal_id).val(id_value);
                    $('#name_of_tribal'+Random_tribal_id).val(name_of_tribal);
                    $('#bank_account_no'+Random_tribal_id).val(bank_account_no);
                    
                    $('#bank_ifsc'+Random_tribal_id).val(bank_ifsc);
                    $('#village'+Random_tribal_id).val(village_name);
                    $('#address'+Random_tribal_id).val(address);
                    $('#shg_id'+Random_tribal_id).val(id);
                     if(tribal_image){
                        $('#tribal_image'+Random_tribal_id).html('<img src="'+tribal_image+'" width="50" height="50">');
                    }else{
                        $('#tribal_image'+Random_tribal_id).html('');
                    }
                    
                    
                    

                },
                onHideListEvent: function() {
                    $("#inputTwo").val("").trigger("change");
                }
            },

          /*preparePostData: function(data) {
            data.phrase = $("#name_search").val();
            return data;
          },*/

          requestDelay: 400
        });

    //fillMfp('#mfp_details_mfp_name_'+Random_id);
    inc_tribal_no();
    $('#amount_paid'+Random_tribal_id).on('keyup',function(){
        setTotalPayable(Random_tribal_id);
    });
}
function delete_tribal(random_tribal_id)
{
    $('#delete_tribal_details'+random_tribal_id).remove();
    inc_tribal_no();
}
function inc_tribal_no()
{
    var item_no = 0;
    $('.tribal_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    //var count = $(".delete_mfp_details").length;
    $('.remove_tribal').show();
    $('.remove_tribal').first().hide();
}
/* $('#name_search').on('keyup',function(){
        getTribalDetailByName();
    });*/


/*getTribalDetailByName=()=>{
   var url = conf.getTribalDetailFromName.url;
    var method = conf.getTribalDetailFromName.method;
    var data = {};
    data.name_of_tribal=$('#name_search').val();
    
    if($('#name_search').val() !='' && $('#name_search').val()!='')
    {
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                return response.data;
                //$('#detail_div').show();
                //fillShgDetails(response.data);
            } else {
                //$('#detail_div').hide();
                TRIFED.showError('error', response.message);
            }
        });
    }else{
        //$('#detail_div').hide();
    }
}*/

getTribalDetail=(Random_tribal_id)=>{
   var url = conf.getTribalDetailFromIdProof.url;
    var method = conf.getTribalDetailFromIdProof.method;
    var data = {};
    data.id_value=$('#id_value'+Random_tribal_id).val();
    data.id_type=$('#id_type'+Random_tribal_id).val();
    if($('#id_value'+Random_tribal_id).val() !='' && $('#id_type'+Random_tribal_id).val()!='')
    {
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                //$('#detail_div').show();
                fillShgDetails(response.data,Random_tribal_id);
            } else {
                //$('#detail_div').hide();
                TRIFED.showError('error', response.message);
            }
        });
    }else{
        //$('#detail_div').hide();
    }
}
fetchFundAvailable=()=>{
    var url = conf.getFundAvailable.url;
    var method = conf.getFundAvailable.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            //fillTypes(response.data);
            $('#fund_available').html(utils.formatCurrency(response.data));
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fetchIdTypes = () => {
    var url = conf.getIdProofList.url;
    var method = conf.getIdProofList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            id_types=response.data;
            //fillTypes(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillTypes = (data,element) => {
    html='<option value="">Select Id Proof</option>';
    data.forEach(function(row){
        html +='<option value="'+row.id+'">'+row.title+'</option>';
    });
    $(element).html(html);

}
getProposals=()=>{
    var url = conf.getProcurementAgentProposals.url(id);
    var method = conf.getProcurementAgentProposals.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            proposals=response.data;
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fillProposals = (data,element) => {
    html='<option value="">Select Proposals</option>';
    
        html +='<option value="'+data.ref_id+'">'+data.proposal_id+'</option>';
    
    $(element).html(html);

}


fillShgDetails=(data,Random_tribal_id)=>{
    $('#shg_id'+Random_tribal_id).val(data.id);
    $('#name_of_tribal'+Random_tribal_id).val(data.name_of_tribal).prop('readonly',true);
    $('#bank_account_no'+Random_tribal_id).val(data.bank_account_no);
    $('#village'+Random_tribal_id).val(data.village_name);
    $('#bank_ifsc'+Random_tribal_id).val(data.bank_ifsc);
    $('#address'+Random_tribal_id).val(data.address);
    if(data.tribal_image){
        $('#tribal_image'+Random_tribal_id).html('<img src="'+data.tribal_image+'" width="50" height="50">');
    }else{
        $('#tribal_image'+Random_tribal_id).html('');
    }
}
$("#formID").submit(function(e) {

        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            

            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addMfpProcurementActualDetail.url;
            var method = conf.addMfpProcurementActualDetail.method;
            
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Actual Detail added Successfully');
                    setTimeout(function() { window.location = '../actual-details/tribal-details-list.php?proposal_id='+proposal_id}, 500);
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            return false;  //This doesn't prevent the form from submitting.
        }
    });

function RenderMfp(Random_tribal_id) {
    var Random_id=Date.now();
    var labels_no = $(".delete_mfp_details"+Random_tribal_id).length;
    ++labels_no;
    var source = $("#mfp_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_id: Random_id,
        Random_tribal_id: Random_tribal_id,
    });
    $("#mfp_container"+Random_tribal_id).append(rendered);
    fillMfp('#mfp_details_mfp_name_'+Random_id,Random_tribal_id);
    inc_mfp_no(Random_tribal_id);
}
function inc_mfp_no(Random_tribal_id)
{
    var item_no = 0;
    $('.mfp_details_no'+Random_tribal_id).each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    //var count = $(".delete_mfp_details").length;
    $('.remove_mfp'+Random_tribal_id).show();
    $('.remove_mfp'+Random_tribal_id).first().hide();
}
function fillMfp(element_id,Random_tribal_id)
{
    mfp_options='<option value="">Select MFP</option>';
    var unique_mfp={};
    mfp_results=mfp_result[Random_tribal_id];
    //console.log(mfp_results)
    mfp_results.forEach(function(row){
        mfp_master_value[row.id]=row.msp_price;
        mfp_options +='<option value="'+row.id+'">'+row.mfp_name+'</option>';
    });
    $(element_id).html(mfp_options)
}
function delete_mfp(random_tribal_id,random_id){
    $('#delete_mfp_details_'+random_tribal_id+'_'+random_id).remove();
    inc_mfp_no(random_tribal_id);
    setTotalPayable(random_tribal_id)
}

/*$(document).on('keyup','.mfp_qty',function(){
    
    var data_id=$(this).attr('data-id');
    var mfp_id=$('#mfp_details_mfp_name_'+data_id).val();
    var qty=$(this).val();
   
    value=mfp_master_value[mfp_id];

    total_value=parseInt(qty)*parseFloat(value)*1000;
    $('#mfp_details_value_'+data_id).val(total_value);
    

    setTotalPayable();    
});*/


function getMfpValue(random_tribal_id,random_mfp_id)
{
    var mfp_id=$('#mfp_details_mfp_name_'+random_mfp_id).val();
    var qty=$('#mfp_details_qty_'+random_mfp_id).val();
    value=mfp_master_value[mfp_id];
    
    if(qty !='' && value!='' && !isNaN(qty) && !isNaN(value))
    {
        total_value=parseInt(qty)*parseFloat(value)*1000;
        $('#mfp_details_value_'+random_mfp_id).val(total_value);    
    }
    
    setTotalPayable(random_tribal_id);    
}

function setTotalPayable(random_tribal_id){
    var getTotalPayable=0;
    $('.mfp_value'+random_tribal_id).each(function () {
        var val=$(this).val();
        getTotalPayable +=parseFloat(val);
    });
    var amount_paid=$('#amount_paid'+random_tribal_id).val();
    if(amount_paid==''){
        amount_paid=0;
    }
    amount_payable=parseFloat(getTotalPayable)-parseFloat(amount_paid);
    if(parseFloat(amount_paid) > parseFloat(getTotalPayable))
    {
        alert('Advance Amount should not be greater than amount payable');
        $('#amount_paid'+random_tribal_id).val(0);
        setTotalPayable();
    }
    if(!isNaN(amount_payable))
    {
        $('#amount_payable'+random_tribal_id).val(amount_payable).prop('readonly',true);    
    }
    
}
