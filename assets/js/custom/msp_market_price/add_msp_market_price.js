var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var form_id = '';
mfpmaster_data={};
haatmaster_data={};
mfp_price_data={};
if (url_var['id'] != undefined) {
    form_id = url_var['id'];
}
$(function () {
    $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        startDate: new Date(),
        //endDate: new Date()
    });
    fetchMfpMaster();
    getUserHaatBazaar();
    if (url_var['id'] != undefined) {

        form_data = fetchFormData(form_id);
        
        
        
    }
    
    


    $("#formID").submit(function (e) {

        // e.preventDefault();
    }).validate({

        rules: {


        },
        submitHandler: function (form) {
            var form = $('#formID')[0];
            var data = new FormData(form);
            var url = conf.addMspMarketPrice.url;
            var method = conf.addMspMarketPrice.method;
            if (form_id != undefined && form_id != '') {
                data.append('form_id', form_id);
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Successfully Added');
                    setTimeout(function () { window.location = '../msp_market_price/msp_market_price_listing.php'}, 500);
                    
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    });
  
});
fetchFormData=(form_id)=>{
    var url = conf.getMspMarketPriceetails.url(form_id);
    var method = conf.getMspMarketPriceetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            data = response.data;
            $('#haat_master_id').val(data.haat_master_id);
            $('#mfp_id').val(data.mfp_id).trigger('change');
            $('#market_price').val(data.market_price);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
fetchMfpMaster = () => {
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;
            fillMfpMaster(mfpmaster_data,mfp_id)
        }
    });
}
fillMfpMaster = (mfps, item_id = 0) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        mfp_price_data[mfp.id]=mfp.msp_price;
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
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
getUserHaatBazaar = () => {
    var url = conf.getCurrentUserHaatInfo.url;
    var method = conf.getCurrentUserHaatInfo.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            haatdata = response.data;
            fillHaatMaster(haatdata,'#haat_master_id')
        }
    });
}
fillHaatMaster = (haats, item_id = 0) => {
    html = '<option value="">Select haat</option>';
    $.each(haats, function (i, haat) {
        html += '<option value="' + haat.id + '">' + haat.haat_bazaar_name + '</option>';
    });
    $(item_id).html(html);
}
$('#mfp_id').on('change',function(){
    if($(this).val()=='')
    {
        $('#msp_price').val(0);
    }else{
        var mfp_id=$(this).val();
        var msp_price=mfp_price_data[mfp_id];
        $('#msp_price').val(msp_price);
    }
});