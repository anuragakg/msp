var auth = TRIFED.getLocalStorageItem();
const id= TRIFED.getUrlParameters().id;
var balance_amount=0;
$(function () {
   
   fetchReleaseDetails(id);
   fetchBankList();

});

$(document).ready(function() {
    $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });
});
fetchReleaseDetails = (id) => {
    var url = conf.getReleaseDetails.url(id);
    var method = conf.getReleaseDetails.method;
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
    if(data.file_number!='' && data.file_number!=null)
    {
        $('#file_number').val(data.file_number).prop('readonly',true);
        $('#sanction_date').val(data.sanction_date).prop('readonly',true);
        /*$('#transaction_id').val(data.transaction_id).prop('readonly',true);
        $('#transaction_date').val(data.transaction_date).prop('readonly',true);*/
    }
    $('#reference_number').html(data.reference_number);
    $('#approved_amount').html(utils.formatAmount(data.approved_amount));
    $('#sanctioned_amount').html(utils.formatAmount(data.sanctioned_amount));
    $('#balance_amount').html(utils.formatAmount(data.balance_amount));
    balance_amount=data.balance_amount;
    $('#release_percent').on('keyup',function(){
        var release_percent=$(this).val();
        if(release_percent!='')
        {
            release_percent=parseFloat(release_percent);
            balance_amount=parseFloat(balance_amount);
            var release_amount=(release_percent*balance_amount)/100;
            $('#release_amount').val(release_amount.toFixed(4));    
        }else{
            $('#release_amount').val(0);    
        }
        
    });
}

fetchBankList = () => {
    var url = conf.getBankList.url;
    var method = conf.getBankList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            bank_data=response.data;
            var html='<option value="">Select Bank</option>';
            bank_data.forEach(function(row){
                html +='<option value="'+row.id+'">'+row.title+'</option>';
            });
            $('#bank_name').html(html);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

$("#formID").submit(function(e) {

        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            

            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addReleaseFund.url;
            var method = conf.addReleaseFund.method;
            if (id != undefined && id != '') 
            {
                data.append('id', id );
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Fund Released Successfully');
                    setTimeout(function() { window.location = '../fund-management/mfp_procurement_release_fund.php'}, 500);
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            return false;  //This doesn't prevent the form from submitting.
        }
    });

    fetchSecondlastRole = (id) =>{
        var url = conf.getSecondLastRoleAppovedDetails.url(id);
        var method = conf.getSecondLastRoleAppovedDetails.method;
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
