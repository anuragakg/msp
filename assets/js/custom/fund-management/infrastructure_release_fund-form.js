var auth = TRIFED.getLocalStorageItem();
const id = TRIFED.getUrlParameters().id;
var balance_amount = 0;
$(function () {

    fetchDetails(id);
    fetchBankList();
});

$(document).ready(function () {
    $('.date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });
});

fetchDetails = (id) => {
    var url = conf.getInfrastructureReleaseDetails.url(id);
    var method = conf.getInfrastructureReleaseDetails.method;
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
    $('#reference_number').html(data.reference_number);    
    $('#approved_amount').html(utils.formatAmount(data.approved_amount));
    $('#sanctioned_amount').html(utils.formatAmount(data.sanctioned_amount));
    $('#balance_amount').html(utils.formatAmount(data.balance_amount));
    balance_amount = data.balance_amount;
    $('#release_percent').on('keyup', function () {
        var release_percent = $(this).val();
        if (release_percent != '') {
            release_percent = parseFloat(release_percent);
            balance_amount = parseFloat(data.balance_amount);
            var release_amount = (release_percent * data.balance_amount) / 100;
            $('#release_amount').val(release_amount.toFixed(4));
        } else {
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
            bank_data = response.data;
            var html = '<option value="">Select Bank</option>';
            bank_data.forEach(function (row) {
                html += '<option value="' + row.id + '">' + row.title + '</option>';
            });
            $('#bank_name').html(html);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

$("#formID").submit(function (e) {

}).validate({
    rules: {


    },
    submitHandler: function (form) {
        var form = $('#formID')[0];
        var data = new FormData(form);
        var url = conf.addInfrastructureReleaseFund.url;
        var method = conf.addInfrastructureReleaseFund.method;
        if (id != undefined && id != '') {
            data.append('id', id);
        }
        TRIFED.fileAjaxHit(url, method, data, function (response) {
            if (response.status == 1) {
                TRIFED.showMessage('success', 'Fund Released Successfully');
                setTimeout(function () { window.location = '../fund-management/infrastructure_release_fund.php' }, 500);
            } else {
                TRIFED.showError('error', response.message);
            }
        });
        return false;  //This doesn't prevent the form from submitting.
    }
});

$("#account_number").change(function(){
    var restict =+ $(this).val();    
    if(restict==0){
        alert("Please enter valid account number");
    }
});

function initDecimalNumeric() {
    $(".decimalNumeric").keyup(decimalNumericKeyUp);
}
  
function decimalNumericKeyUp(e) {
    
    $(this).val(
      $(this)
        .val()
        .replace(/[^0-9\.]/g, "")
    );
    var x = $(this).val();
    var t = x;
    y =
      t.indexOf(".") >= 0
        ? t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)
        : t;
    $(this).val(y);
  }




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