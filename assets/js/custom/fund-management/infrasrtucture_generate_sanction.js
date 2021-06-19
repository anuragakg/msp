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
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillFields(response.data);
            id = response.data.reference_number.substr(3,4);
            fetchSecondlastRole(id);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillFields = (data) => {
    if (data.file_number != '' && data.file_number != null) {
        $('#file_number').val(data.file_number).prop('readonly', true);
        $('#sanction_date').val(data.sanction_date).prop('readonly', true);
    }
    $('#total_sanctioned_amount').html(utils.formatCurrency(data.total_sanctioned_amount));
    $('#total_balance_amount').html(utils.formatCurrency(data.total_balance_amount));
    var approved_amount = parseFloat(data.approved_amount);
    var maximum_sanction_percent = parseFloat(data.maximum_sanction_percent);
    $('#maximum_sanction_percent').html(maximum_sanction_percent);
    var maximum_can_sanctioned = (approved_amount * maximum_sanction_percent) / 100;
    var balance_can_sanctioned = maximum_can_sanctioned.toFixed(4) - data.sanctioned_amount;
    $('#sanctioned_amount').val(balance_can_sanctioned);
    $('#reference_number').html(data.reference_number);
    $('#state').html(data.state_name);
    $('#financial_year').html(data.year_name);
    $('#approved_amount').html(utils.formatCurrency(data.approved_amount));
    $('#balance_amount').html(utils.formatCurrency(data.balance_amount));
}

$("#formID").submit(function(e) {

        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            

            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addInfraSanctionLetter.url;
            var method = conf.addInfraSanctionLetter.method;
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


fetchSecondlastRole = (id) =>{
    var url = conf.getInfraSecondLastRoleAppovedDetails.url(id);
    var method = conf.getInfraSecondLastRoleAppovedDetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            console.log(response);
            $('.date').datepicker({
                todayBtn: "linked",
                
                format: 'dd/mm/yyyy',
                startDate: new Date(response.data),
                endDate: new Date()
        
            });
        } else {
            TRIFED.showMessage('error', cb);
        }
    });

}