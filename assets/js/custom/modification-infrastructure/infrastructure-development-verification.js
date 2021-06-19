var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var form_id='';
var approve_label='recommend'
var approved_label='Recommended'
if(url_var['id']!=undefined){
    form_id = url_var['id'];  
    
}
$(function(){

    isLastLevelUser(form_id);
    
    
    if(url_var['id']!=undefined)
    {
        $('#approve').on('click',function(){
             if(confirm("Are you sure to "+approve_label+" this?"))
            {
            if($('#remarks').val()=='')
            {
                $('#remarks_err').html('Please enter remarks');
            }else{
                $('#remarks_err').html('');
                var url = conf.approveInfrastructure.url;
                var method = conf.approveInfrastructure.method;
                data={'remarks':$('#remarks').val(),'form_id':form_id};
                TRIFED.asyncAjaxHit(url, method, data, function (response) {
					//document.getElementById("approve").disabled = true;
                    $('#loader-div').html('<i class="fa fa-spinner fa-spin" style="font-size:100px"></i>');
                    $('#loader-div').show();
                    if (response.status == 1) {
                        $('#loader-div').html('');
                        $('#loader-div').hide();
                        TRIFED.showMessage('success', approved_label+' Successfully');
                      setTimeout(function() { history.go(-1)}, 500);
                    } else {
                        TRIFED.showError('error', response.message);
                    }
                });
            }
}
        });

        $('#revert').on('click',function(){
             if(confirm("Are you sure to revert this?"))
            {
            if($('#remarks').val()=='')
            {
                $('#remarks_err').html('Please enter remarks');
            }else{
                $('#remarks_err').html('');
                var url = conf.revertInfrastructure.url;
                var method = conf.revertInfrastructure.method;
                data={'remarks':$('#remarks').val(),'form_id':form_id};
                TRIFED.asyncAjaxHit(url, method, data, function (response) {
					document.getElementById("revert").disabled = true;
                    if (response.status == 1) {
                        TRIFED.showMessage('success', 'Reverted Successfully');
                        setTimeout(function() { history.go(-1)}, 500);
                    } else {
                        TRIFED.showError('error', response.message);
                    }
                });
            }
        }
        });

        $('#reject').on('click',function(){
            if(confirm("Are you sure to reject this?"))
            {
            if($('#remarks').val()=='')
            {
                $('#remarks_err').html('Please enter remarks');
            }else{
                $('#remarks_err').html('');
                var url = conf.rejectInfrastructure.url;
                var method = conf.rejectInfrastructure.method;
                data={'remarks':$('#remarks').val(),'form_id':form_id};
                TRIFED.asyncAjaxHit(url, method, data, function (response) {
					document.getElementById("reject").disabled = true;
                    if (response.status == 1) {
                        TRIFED.showMessage('success', 'Rejected Successfully');
                       setTimeout(function() { history.go(-1)}, 500);
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
    var url = conf.InfrastructureCheckLastLevelUser.url(form_id);
    var method = conf.InfrastructureCheckLastLevelUser.method;
    data={};
    TRIFED.asyncAjaxHit(url, method, data, function (response) {
        
        if (response.status == 1) {
            if(response.data.is_last_level==1)
            {
                approve_label='Approve';
                approved_label='Approved';
                $('#approve').html('Approve')
            }
        } 
    });
}

