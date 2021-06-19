var auth = TRIFED.getLocalStorageItem();
const id = TRIFED.getUrlParameters().id;
var mfp_result = {};
var mfp_qty = [];
var mfp_master_value = [];
var balance_amount = 0;
$(function () {

    getTribalDetail(id);
    $('#amount').on('change', function () {
        var amount_of_rupees = $('#amount_of_rupees').val();
        var amount = $('#amount').val();
        if (amount == '') {
            amount = 0;
        }
        var rest_amount = parseFloat(amount_of_rupees) - parseFloat(amount);
        if (rest_amount < 0) {
            alert('You can not generate receipt more than ' + 'Rs.' + amount_of_rupees)
            $('#rest_amount').val('');
        } else {
            $('#rest_amount').val(rest_amount);
        }
    })

});

getTribalDetail = (id) => {
    var url = conf.getMfpProcurementActualDetailView.url(id);
    var method = conf.getMfpProcurementActualDetailView.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            //console.log(response);
            fillShgDetails(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });

}
fillShgDetails = (data) => {
    var d = new Date();

    var d = new Date();

    var month = d.getMonth() + 1;
    var day = d.getDate();

    var n = d.getTime();
    var current_date = (('' + day).length < 2 ? '0' : '') + day + '/' + (('' + month).length < 2 ? '0' : '') + month + '/' + d.getFullYear()
        ;

    $('#receipt_id').val(n);
    $('#shg_id').val(data.shg_id);
    $('#dated').val(current_date);
   
    $('#name_of_tribal').val(data.name_of_tribal);
    $('#amount').val(data.amount_paid);
    $('#rest_amount').val(data.amount_payable);
    amount_in_rs = convert_number(data.amount_paid);
    $('#amount_of_rupees').val(amount_in_rs);
    commoditydata = data.commodity;
    commoditydata.forEach(function (row) {
        RenderMfp(row)
        
    });
}
$("#formID").submit(function (e) {

}).validate({
    rules: {


    },
    submitHandler: function (form) {


        var form = $('#formID')[0];
        var data = new FormData(form);
        var url = conf.addMfpProcurementGenerateReceipt.url;
        var method = conf.addMfpProcurementGenerateReceipt.method;
        data.append('actual_detail_id', id);
        TRIFED.fileAjaxHit(url, method, data, function (response) {
            if (response.status == 1) {
                TRIFED.showMessage('success', 'Receipt Generated Successfully');
                setTimeout(function () { window.location = '../actual-details/tribal-details-list.php?proposal_id='+response.data.proposal_id }, 500);
            } else {
                TRIFED.showError('error', response.message);
            }
        });
        return false;  //This doesn't prevent the form from submitting.
    }
});
function RenderMfp(itemsdata) {
    var Random_id = Date.now();
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
function inc_mfp_no() {
    var item_no = 0;
    $('.mfp_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    //var count = $(".delete_mfp_details").length;
    $('.remove_mfp').show();
    $('.remove_mfp').first().hide();
}



function convert_number(number)
{
    if ((number < 0) || (number > 999999999)) 
    { 
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */ 
    number -= Gn * 10000000; 
    var kn = Math.floor(number / 100000);     /* lakhs */ 
    number -= kn * 100000; 
    var Hn = Math.floor(number / 1000);      /* thousand */ 
    number -= Hn * 1000; 
    var Dn = Math.floor(number / 100);       /* Tens (deca) */ 
    number = number % 100;               /* Ones */ 
    var tn= Math.floor(number / 10); 
    var one=Math.floor(number % 10); 
    var res = ""; 

    if (Gn>0) 
    { 
        res += (convert_number(Gn) + " CRORE"); 
    } 
    if (kn>0) 
    { 
            res += (((res=="") ? "" : " ") + 
            convert_number(kn) + " LAKH"); 
    } 
    if (Hn>0) 
    { 
        res += (((res=="") ? "" : " ") +
            convert_number(Hn) + " THOUSAND"); 
    } 

    if (Dn) 
    { 
        res += (((res=="") ? "" : " ") + 
            convert_number(Dn) + " HUNDRED"); 
    } 


    var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX","SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN","FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN","NINETEEN"); 
var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY","SEVENTY", "EIGHTY", "NINETY"); 

    if (tn>0 || one>0) 
    { 
        if (!(res=="")) 
        { 
            res += " AND "; 
        } 
        if (tn < 2) 
        { 
            res += ones[tn * 10 + one]; 
        } 
        else 
        { 

            res += tens[tn];
            if (one>0) 
            { 
                res += ("-" + ones[one]); 
            } 
        } 
    }

    if (res=="")
    { 
        res = "zero"; 
    } 
    return res;
}