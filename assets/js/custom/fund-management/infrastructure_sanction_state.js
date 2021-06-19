var auth = TRIFED.getLocalStorageItem();
var balance_amount=0;
const id= TRIFED.getUrlParameters().id;
$(function () {
   
   fetchSanctionDetails(id);
});

$(document).ready(function() {
    $('.date').datepicker({
        todayBtn: "linked", 
        format: 'dd/mm/yyyy',
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });
    $('#sanctioned_amount').on('keyup',function(){
        var sanction_amount=$(this).val();
        var remaining_balance_amount=parseFloat(balance_amount)-parseFloat(sanction_amount);
        $('#remaining_balance_amount').html(remaining_balance_amount)
    })
});
fetchSanctionDetails = (id) => {
    var url = conf.getInfraSanctionDetails.url(id);
    var method = conf.getInfraSanctionDetails.method;
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
        $('#file_number').html(data.file_number);
        $('#sanction_date').html(data.sanction_date);
        /*$('#transaction_date_ministry').html(data.consolidation.get_ministry_share.transaction_date);
        $('#transaction_id_ministry').html(data.consolidation.get_ministry_share.transaction_id);*/
    }
    $('#total_sanctioned_amount').html(data.total_sanctioned_amount);
    $('#total_balance_amount').html(data.total_balance_amount);
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
    balance_amount=data.balance_amount;
    $('#balance_amount').html(data.balance_amount);
}

$("#formID").submit(function(e) {

        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            

            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addInfraSanctionLetterState.url;
            var method = conf.addInfraSanctionLetterState.method;
            if (id != undefined && id != '') 
            {
                data.append('id', id );
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    form_id=response.data.ref_id;
                    $('#preview').show();
                    TRIFED.showMessage('success', 'Sanction Generated Successfully');
                    setTimeout(function() { window.location = '../fund-management/infrastructure-consolidated-list.php'}, 500);
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            return false;  //This doesn't prevent the form from submitting.
        }
    });

