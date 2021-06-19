var auth = TRIFED.getLocalStorageItem();
//var editRole = TRIFED.checkPermissions("role_status");
//var statusRole = TRIFED.checkPermissions("role_edit");
$(function () {
	
	fetchState();
	fetchCommissionMasterRoles();
	

});
fetchState = (item_id=0) => {
	var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
           
            fillStates(response.data,item_id);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states,item_id=0) => {
	html = '<option value="">Select State</option>';
	$.each(states, function(i, state) {
		html += '<option value="'+state.id+'">'+state.title+'</option>';
	});
    $('#states'+item_id).html(html);
    $('.states').html(html);
}

fetchCommissionMasterRoles = () => {
	var url = conf.commissionRoleList.url;
    var method = conf.commissionRoleList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillCommissionMaster(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillCommissionMaster = (roles) => {
	html = '<option value="">Select Role</option>';
	$.each(roles, function(i, role) {
		html += '<option value="'+role.id+'">'+role.title+'</option>';
	});
    $('#role').html(html);
   
}





