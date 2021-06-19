var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
//if logged in user is last upper level of ministry

var consolidated_id = '';
if(auth.is_highest_role_level){
    var approve_label='approve'
    var approved_label='Approved'
    
}else{
    var approve_label='recommend'
    var approved_label='Recommended'
}

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
                } else {
                    $('#remarks_err').html('');
                    var url = conf.approveConsolidatedMfpProcurement.url;
                    var method = conf.approveConsolidatedMfpProcurement.method;
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
            }
            

        });

        $('#revert').on('click', function () {
            if(confirm("Are you sure to revert this?"))
            {
                if ($('#remarks').val() == '') {
                    $('#remarks_err').html('Please enter remarks');
                } else {
                    $('#remarks_err').html('');
                    var url = conf.revertConsolidatedMfpProcurement.url;
                    var method = conf.revertConsolidatedMfpProcurement.method;
                    data = { 'remarks': $('#remarks').val(), 'consolidated_id': consolidated_id ,'request_type':'2'};
                    TRIFED.asyncAjaxHitLoader(url, method, data, function (response) {
                        if (response.status == 1) {
                            TRIFED.showMessage('success', 'Reverted Successfully');
                            setTimeout(function () { history.go(-1) }, 500);
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
                } else {
                    $('#remarks_err').html('');
                    var url = conf.rejectConsolidatedMfpProcurement.url;
                    var method = conf.rejectConsolidatedMfpProcurement.method;
                    data = { 'remarks': $('#remarks').val(), 'consolidated_id': consolidated_id, 'request_type':'3'};
                    TRIFED.asyncAjaxHitLoader(url, method, data, function (response) {
                        if (response.status == 1) {
                            TRIFED.showMessage('success', 'Rejected Successfully');
                            setTimeout(function () { history.go(-1) }, 500);
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
    var url = conf.MfpProcurementCheckConsolidatedLastLevelUser.url(form_id);
    var method = conf.MfpProcurementCheckConsolidatedLastLevelUser.method;
    data={};
    TRIFED.asyncAjaxHit(url, method, data, function (response) {
        
        if (response.status == 1) {
            if(response.data.is_last_level==1)
            {
                approved_label='Approved'
                approve_label='Approve';
                $('#approve').html('Approve')
            }
        } 
    });
}