var auth = TRIFED.getLocalStorageItem();
//var editRole = TRIFED.checkPermissions("role_status");
//var statusRole = TRIFED.checkPermissions("role_edit");
var commission_master_id = TRIFED.getUrlParameters().id;
if(commission_master_id){
    setTimeout(function () { 
        fetchCommissionMaster(commission_master_id)
     }, 500);
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

$(function(){
	$('#formID').on('submit', function (e) {
		e.preventDefault();
		if ($(this).validationEngine('validate')) {
			if($("#state").val()!='' && $("#role").val()!='' && $("#commission").val()!='' && $("#max_aggregate_commission").val()!=''){
				checkUniqueRecord();
			}
		}	
	});
});



function checkUniqueRecord(){
    var url = conf.checkUniqueCommission.url;
    var method = conf.checkUniqueCommission.method;
    // alert(conf.checkUniqueCommission.url+'-'+conf.checkUniqueCommission.method);return false;
    var data ={};
    data.state = $("#states0").val();
    data.role = $("#role").val();
    data.commission = $("#commission").val();
    data.max_aggregate_commission = $("#max_aggregate_commission").val();
    if(commission_master_id){
        data.commission_master_id =commission_master_id;
    }
   
    TRIFED.asyncAjaxHit(url, method, data, function (response) {
        if (response.status == 1) {
            $("#states0").val('');
            $("#role").val('');  
            $("#commission").val('');    
            $("#max_aggregate_commission").val('');      
            $("#status").val('');    
            $("#error").html('This state and role name already exist');     
           return false;         
        } else{
            if (commission_master_id != undefined && commission_master_id != null) {
                var url = conf.updateCommissionMaster.url(commission_master_id);
                var method = conf.updateCommissionMaster.method;
            } else {
                var url = conf.addCommissionMaster.url;
                var method = conf.addCommissionMaster.method;
            }
            const data = $('#formID').serialize();
            TRIFED.asyncAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    $('#formID')[0].reset();
                    
                    TRIFED.showMessage('success', 'Successfully Added');
                    setTimeout(function () { window.location = 'commission-master-list.php' }, 300);
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
			return false;
        }
    });

}

function fetchCommissionMaster(com_master_id) {
   
    var url = conf.viewCommissionMaster.url(com_master_id);
    var method = conf.viewCommissionMaster.method;
    var data = {};

    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response) {
            console.log(response.data);
            //fetchCommissionListStateWise(response.data.state_id);
            $('#states0').val(response.data.state_id);
            $('#role').val(response.data.role_id);
            $('#commission').val(response.data.commission);
            $('#status').val(response.data.status);
            $("#max_aggregate_commission").val(response.data.max_aggregate_commission);  
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}

// $('#states0').on('change',function (ev) {
    
// 	state_id = $(this).val();
// 	fetchCommissionListStateWise(state_id);
	

// });
// function fetchCommissionListStateWise(state_id) {
   
//     var url = conf.commissionListStatewise.url(state_id);
//     var method = conf.commissionListStatewise.method;
//     var data = {};

//     TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
//         if (response) {
//             fillCommissionList(response.data);
//         } else {
//             TRIFED.showMessage('error', cb);
//         }
//     });
//     return data;
// }

// fillCommissionList = (commissions) => {
// 	html = '<option value="">Select Commission</option>';
// 	$.each(commissions, function(i, commission) {
// 		html += '<option value="'+commission.commission+'">'+commission.commission+'</option>';
// 	});
//     $('#commission').html(html);
   
// }
