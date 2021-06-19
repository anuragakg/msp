var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var form_id = '';
districtsmaster_data={};
mfpmaster_data={};
valueaddedmaster_data={};
var mfp_price_arr=[];
var type=1;
if (url_var['ref_id'] != undefined) {
    form_id = url_var['ref_id'];
    
}
if (url_var['type'] != undefined) {
    type = url_var['type'];
    
}
$(function () {
    fetchDistrictMaster();
    if(type==1)
    {
        fetchMfpMaster();    
    }else{
        fetchValueAddedProducts();
    }
    
    $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        startDate: new Date(),
        //endDate: new Date()

    });
    if (url_var['ref_id'] != undefined) {

        form_data = fetchFormData(form_id);
        $('#auction_title').val(form_data.auction_title);
        $('#reference_number').val(form_data.reference_number);
        $('#auction_date').val(form_data.auction_date_form_format);
        $('#hour').val(form_data.hour);
        $('#minute').val(form_data.minute);
        $('#state_id').val(form_data.state_id);
        $('#venue').val(form_data.venue);
        
        details_data=form_data.detail_data;
        var random_id=0;
        details_data.forEach(function(detail_data){
            ++random_id;
            //var Random_id=Date.now();
            RenderAuctionDetails(random_id,detail_data);    
        });
        
        
    }else{
        var Random_id=Date.now();
        var random_auction_detail_id = Random_id;
        var itemdata={};
        RenderAuctionDetails(random_auction_detail_id,itemdata);
    }
    
    


    $("#formID").submit(function (e) {

        // e.preventDefault();
    }).validate({

        rules: {


        },
        submitHandler: function (form) {
            var form = $('#formID')[0];
            var data = new FormData(form);
            var url = conf.addAuctionTransaction.url;
            var method = conf.addAuctionTransaction.method;
            if (form_id != undefined && form_id != '') {
                data.append('form_id', form_id);
            }
            data.append('type',type);
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    form_id = response.data.ref_id;
                    
                    TRIFED.showMessage('success', 'Successfully Added');
                    
                    setTimeout(function () { window.location = '../auction/auction-transaction-list.php?type='+type}, 500);
                    
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
    var url = conf.getAuctionTransactionDetail.url(form_id);
    var method = conf.getAuctionTransactionDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            data = response.data;
            console.log(data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
fetchDistrictMaster = (random_auction_detail_id) => {
    var url = conf.getUserDistrict.url;
    var method = conf.getUserDistrict.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            districtsmaster_data = response.data;

        }
    });
}
fillDistrictMaster = (districts, item_id = 0) => {
    html = '<option value="">Select District</option>';
    $.each(districts, function (i, district) {
        html += '<option value="' + district.id + '">' + district.title + '</option>';
    });
    $(item_id).html(html);
}

function RenderAuctionDetails(random_auction_detail_id,itemsdata) {
    var labels_no = $(".auction_detail").length;
    ++labels_no;
    var source = $("#auction_detail_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_auction_detail_id: random_auction_detail_id,
        itemdata: itemsdata,
    });
    $("#details_container").append(rendered);
    details_no_inc();
    if(type==1)
    {
        $('#msp_type_'+random_auction_detail_id).show();
        $('#value_added_type_'+random_auction_detail_id).hide();
        fillMfpMaster(mfpmaster_data,'#mfp_'+random_auction_detail_id);
    }else{
        $('#msp_type_'+random_auction_detail_id).hide();
        $('#value_added_type_'+random_auction_detail_id).show();
        fillValueAddedProducts(valueaddedmaster_data,'#value_added_product_'+random_auction_detail_id);
    }
    
    fillDistrictMaster(districtsmaster_data, '#district_' + random_auction_detail_id);
    $('#delivery_date_'+random_auction_detail_id).datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        startDate: new Date(),
        //endDate: new Date()

    });
    if (itemsdata != '' && itemsdata != null) {
        $('#district_' + random_auction_detail_id).val(itemsdata.district_id).trigger('change');
        $('#warehouse_' + random_auction_detail_id).val(itemsdata.warehouse_id)
        $('#mfp_' + random_auction_detail_id).val(itemsdata.mfp_id)
        $('#value_added_product_' + random_auction_detail_id).val(itemsdata.value_added_product)
        
    } 
}

$('#add_committe_details').click(function () {
    random_auction_detail_id = Date.now();
    itemdata={};
    RenderAuctionDetails(random_auction_detail_id,itemdata);
    details_no_inc();
});
function add_auction_detail()
{
    random_auction_detail_id = Date.now();
    itemdata={};
    RenderAuctionDetails(random_auction_detail_id,itemdata);
    details_no_inc();
}
function delete_auction_detail(random_auction_detail_id) {
    var count = $(".auction_detail").length;
    if (count > 1) {
        $("#delete_auction_detail" + random_auction_detail_id).remove();
        details_no_inc();
    }
}

function details_no_inc() {
    var item_no = 0;
    $('.auction_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    var count = $(".auction_detail").length;
    $('.remove_auction_detail').show();
    $('.remove_auction_detail').first().hide();
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
function getDistrictWarehouse(district_id,rendom_id)
{
    var url = conf.getDistrictWarehouse.url;
    var method = conf.getDistrictWarehouse.method;
    var data = {district_id:district_id};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            
            fillDistrictWarehouse(response.data,'#warehouse_'+rendom_id)
        }
    });
}

fillDistrictWarehouse = (warehouses, item_id = 0) => {
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouses, function (i, warehouse) {
        html += '<option value="' + warehouse.id + '">' + warehouse.warehouse_name + '</option>';
    });
    $(item_id).html(html);
}
fetchMfpMaster = (random_committe_details_id) => {
    var url = conf.getAuctionCommitteMfp.url;
    var method = conf.getAuctionCommitteMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;

        }
    });
}
fillMfpMaster = (mfps, item_id = 0) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        mfp_price_arr[mfp.id]=mfp.msp_price;
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
    });
    $(item_id).html(html);
}
getMfpValue=(random_id)=>{
    if(type==2){
        return false;
    }
    let qty=$('#qty_'+random_id).val();
    
    let mfp_id=$('#mfp_'+random_id).val();  
    if(mfp_id!='')
    {
         
        price=mfp_price_arr[mfp_id];
        price=parseFloat(price)*1000;//multiply by 100 for changing mt into KG
        value=parseFloat(price)*parseFloat(qty); 
        $('#value_'+random_id).val(value);
    }else{
        $('#value_'+random_id).val(0);
    }
    if(qty=='')
    {
        $('#value_'+random_id).val(0);
    }
}
getBalanceAmount=(random_id)=>{
    var advance_amount=$('#advance_amount_'+random_id).val();
    var value=$('#value_'+random_id).val();
    balance=parseFloat(value)-parseFloat(advance_amount); 
    if(advance_amount=='')
    {
        $('#balance_amount_'+random_id).val(0);    
    }else{
        if(balance >= 0)
        {
            $('#balance_amount_'+random_id).val(balance);    
        }else{
            alert('Balance amount should not be less than 0');
            $('#balance_amount_'+random_id).val(0);    
        }
        
    }
    
}
fetchValueAddedProducts=()=>{
    var url = conf.getValueAddedProducts.url;
    var method = conf.getValueAddedProducts.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            valueaddedmaster_data = response.data;

        }
    });
}
fillValueAddedProducts = (products, item_id = 0) => {
    html = '<option value="">Select value added products</option>';
    $.each(products, function (i, product) {
        html += '<option value="' + product.id + '">' + product.product_name + '</option>';
    });
    $(item_id).html(html);
}