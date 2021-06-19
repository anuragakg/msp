var auth = TRIFED.getLocalStorageItem();
const id= TRIFED.getUrlParameters().id;
var mfp_result={};
var mfp_qty=[];
var mfp_master_value=[];
var balance_amount=0;
$(function () {
   
   getTribalDetail(id);
   
   
});

getTribalDetail=(id)=>{
   var url = conf.getMfpProcurementActualDetailView.url(id);
    var method = conf.getMfpProcurementActualDetailView.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
       
            fillShgDetails(response.data);
        } else {
       
            TRIFED.showMessage('error', cb);
        }
    });
    
}
fillShgDetails=(data)=>{
    $('#id_type').html(data.id_type_name);
    $('#id_value').html(data.id_value);
    $('#name_of_tribal').html(data.name_of_tribal);
    $('#bank_account_no').html(data.bank_account_no);
    $('#village').html(data.village);
    $('#bank_ifsc').html(data.bank_ifsc);
    $('#address').html(data.address);
    $('#type').html(data.type);
    $('#procurement_date').html(data.procurement_date);
    $('#proposal_id').html(data.proposal_id);
    $('#amount_paid').html(data.amount_paid);
    $('#amount_payable').html(data.amount_payable);
    commoditydata=data.commodity;
    commoditydata.forEach(function(row){
        RenderMfp(row)
    });
}

function RenderMfp(itemsdata) {
    var Random_id=Date.now();
    var source = $("#mfp_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_id: Random_id,
        itemdata: itemsdata,
    });
    $("#mfp_container").append(rendered);
    //fillMfp('#mfp_details_mfp_name_'+Random_id);
    inc_mfp_no();
}
function inc_mfp_no()
{
    var item_no = 0;
    $('.mfp_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    //var count = $(".delete_mfp_details").length;
    $('.remove_mfp').show();
    $('.remove_mfp').first().hide();
}