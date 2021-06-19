var auth = TRIFED.getLocalStorageItem();
const id= TRIFED.getUrlParameters().id;
$(function () {
   fetchSanctionDetails(id);
});

$(document).ready(function() {
    $('.date').datepicker({
         todayBtn: "linked",        
        format: 'dd/mm/yyyy', 
        endDate: new Date()

    });
});
fetchSanctionDetails = (id) => {
    var url = conf.getInfraSanctionDetails.url(id);
    var method = conf.getInfraSanctionDetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url,method, data, function (response, cb) {
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
        $('#file_number').html(data.file_number);
        $('#sanction_date').html(data.sanction_date); 
    }
    $('#total_sanctioned_amount').html(data.total_sanctioned_amount);
    $('#total_balance_amount').html(data.total_balance_amount);
    $('#total_sanctioned_amount').html(data.total_sanctioned_amount);
    var approved_amount=parseFloat(data.approved_amount);
    var maximum_sanction_percent=parseFloat(data.maximum_sanction_percent);
    $('#maximum_sanction_percent').html(maximum_sanction_percent);
    var maximum_can_sanctioned=(approved_amount*maximum_sanction_percent)/100;
    var balance_can_sanctioned=maximum_can_sanctioned-data.sanctioned_amount;
    $('#sanctioned_amount').val(balance_can_sanctioned);
    $('#reference_number').html(data.reference_number);
    $('#state').html(data.state_name);
    $('#financial_year').html(data.year_name);
    $('#approved_amount').html(data.approved_amount);
    $('#balance_amount').html(data.balance_amount);
    $('#transaction_id').html(data.transaction_id);
    $('#transaction_date').html(data.transaction_date);
}


