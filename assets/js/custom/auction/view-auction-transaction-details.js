var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var form_id = '';
mfpmaster_data={};
committe_members={};
members_detail={};
if (url_var['ref_id'] != undefined) {
    form_id = url_var['ref_id'];
    
}
$(function () {
 
    if (url_var['ref_id'] != undefined) {

        form_data = fetchFormData(form_id);
        $('#auction_date').html(form_data.auction_date);
        
        transaction_details=form_data.detail_data;
        
        transaction_details.forEach(function(transaction_detail){
            RenderTransactionDetails(transaction_detail);    
        });
        if(form_data.type==1)
        {
            $('.mfp').show();
            $('.value_added').hide();
        }else{
            $('.mfp').hide();
            $('.value_added').show();
        }
    }


  
  
});
fetchFormData=(form_id)=>{
    var url = conf.getAuctionTransactionDetail.url(form_id);
    var method = conf.getAuctionTransactionDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            data = response.data;
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}

function RenderTransactionDetails(itemsdata) {
    var Random_id=Date.now();
    var source = $("#auction_detail_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        
        itemdata: itemsdata,
    });
    $("#details_container").append(rendered);
    transaction_details_no_inc();
    
}


function transaction_details_no_inc() {
    var item_no = 0;
    $('.auction_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
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

function RenderMfpDetails(random_mfp_details_id,itemsdata) {
    var labels_no = $(".delete_mfp_details").length;
    ++labels_no;
    var source = $("#mfp_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_details_id: random_mfp_details_id,
        itemdata: itemsdata,
    });
    $("#mfp_details_container").append(rendered);
    mfp_details_no_inc();
    
}
function mfp_details_no_inc() {
    var item_no = 0;
    $('.mfp_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    
}
