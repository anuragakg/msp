var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var form_id = '';
mfpmaster_data={};
committe_members={};
members_detail={};
if (url_var['id'] != undefined) {
    form_id = url_var['id'];
    
}
var type=1;
$(function () {
 
    if (url_var['id'] != undefined) {

        form_data = fetchFormData(form_id);
        type=form_data.type;
        if(type==2)
        {
            $('#form_type').html('Value Added Products Details');
        }
        $('#auction_title').html(form_data.auction_title);
        $('#reference_number').html(form_data.reference_number);
        $('#auction_date').html(form_data.auction_date);
        $('#auction_time').html(form_data.hour+':'+form_data.minute);
        $('#state').html(form_data.state);
        $('#venue').html(form_data.venue);

        var Random_id=Date.now();
        committe_details=form_data.committe_detail;
        
        committe_details.forEach(function(committe_detail){
            RenderCommitteDetails(Random_id,committe_detail);    
        });
        mfp_details=form_data.mfp_detail;
       mfp_details.forEach(function(mfp_detail){
            RenderMfpDetails(Random_id,mfp_detail);    
        });
        
        //(random_committe_details_id);
    }


  
  
});
fetchFormData=(form_id)=>{
    var url = conf.getAuctionCommitteDetail.url(form_id);
    var method = conf.getAuctionCommitteDetail.method;
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

function RenderCommitteDetails(random_committe_details_id,itemsdata) {
    var source = $("#committe_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_committe_details_id: random_committe_details_id,
        itemdata: itemsdata,
    });
    $("#committe_details_container").append(rendered);
    committe_details_no_inc();
    
}


function committe_details_no_inc() {
    var item_no = 0;
    $('.committe_details_no').each(function () {
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
    if(type==1){
        $('.type2').hide();
    }else{
        $('.type2').show();
    }
    mfp_details_no_inc();
    
}
function mfp_details_no_inc() {
    var item_no = 0;
    $('.mfp_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    
}
