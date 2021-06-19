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
   var url = conf.getMfpProcurementReceiptDetailView.url(id);
    var method = conf.getMfpProcurementReceiptDetailView.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
       
            getReceiptDetail(response.data);
        } else {
       
            TRIFED.showMessage('error', cb);
        }
    });
    
}
getReceiptDetail=(data)=>{
    
    $('#name_of_tribal').html(data.name_of_tribal);
    $('#amount_of_rupees').html(data.amount_of_rupees);
    $('#receipt_id').html(data.receipt_id);
    $('#dated').html(data.dated);
    $('#amount').html(utils.formatCurrency(data.amount));
    $('#rest_amount').html(utils.formatCurrency(data.rest_amount));
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