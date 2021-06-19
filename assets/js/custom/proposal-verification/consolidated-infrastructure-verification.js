var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var consolidated_id = '';
var approve_label='recommend'
var approved_label='Recommended'
if (url_var['id'] != undefined) {
    consolidated_id = url_var['id'];

}
$(function () {
    isLastLevelUser(consolidated_id);
    if (url_var['id'] != undefined) {
        $('#approve').on('click', function () {
            if(confirm("Are you sure to "+approve_label+" this?"))
            {
                if ($('#remarks').val() == '') {
                    $('#remarks_err').html('Please enter remarks');
                    document.getElementById("approve").disabled = false;
                } else {
                    $('#remarks_err').html('');
                    var url = conf.approveConsolidatedInfrastructure.url;
                    var method = conf.approveConsolidatedInfrastructure.method;
                    data = { 'remarks': $('#remarks').val(), 'consolidated_id': consolidated_id,'request_type':'1' };
                    TRIFED.asyncAjaxHitLoader(url, method, data, function (response) {
                        if (response.status == 1) {
                            TRIFED.showMessage('success', approved_label +' Successfully');
                           setTimeout(function () { history.go(-1)}, 500);
                        } else {
                            TRIFED.showError('error', response.message);
                        }
                    });
                }
                document.getElementById("approve").disabled = false;
            }
            

        });

        $('#revert').on('click', function () {
            if(confirm("Are you sure to revert this?"))
            {
                if ($('#remarks').val() == '') {
                    $('#remarks_err').html('Please enter remarks');
                    document.getElementById("revert").disabled = false;
                } else {
                    $('#remarks_err').html('');
                    var url = conf.revertConsolidatedInfrastructure.url;
                    var method = conf.revertConsolidatedInfrastructure.method;
                    data = { 'remarks': $('#remarks').val(), 'consolidated_id': consolidated_id ,'request_type':'2'};
                    TRIFED.asyncAjaxHitLoader(url, method, data, function (response) {
                        if (response.status == 1) {
                            TRIFED.showMessage('success', 'Reverted Successfully');
                            setTimeout(function () { history.go(-1)}, 500);
                        } else {
                            TRIFED.showError('error', response.message);
                        }
                    });
                }
            }
            
        });

        $('#reject').on('click', function () {
            if(confirm("Are you sure to reject this?"))
            {
                if ($('#remarks').val() == '') {
                    $('#remarks_err').html('Please enter remarks');                    
                    document.getElementById("reject").disabled = false;
                } else {
                    $('#remarks_err').html('');
                    var url = conf.rejectConsolidatedInfrastructure.url;
                    var method = conf.rejectConsolidatedInfrastructure.method;
                    data = { 'remarks': $('#remarks').val(), 'consolidated_id': consolidated_id, 'request_type':'3'};
                    TRIFED.asyncAjaxHitLoader(url, method, data, function (response) {
                        if (response.status == 1) {
                            TRIFED.showMessage('success', 'Rejected Successfully');
                            setTimeout(function () { history.go(-1)}, 500);
                        } else {
                            TRIFED.showError('error', response.message);
                        }
                    });
                }
            }
            
        });

    }
});

isLastLevelUser=(form_id)=>{
    var url = conf.InfrastructureCheckConsolidatedLastLevelUser.url(form_id);
    var method = conf.InfrastructureCheckConsolidatedLastLevelUser.method;
    data={};
    TRIFED.asyncAjaxHit(url, method, data, function (response) {
        
        if (response.status == 1) {
            if(response.data.is_last_level==1)
            {
                approved_label='Recommended'
                approve_label='Approve';
                $('#approve').html('Approve')
            }
        } 
    });
}