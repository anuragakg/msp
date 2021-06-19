var auth = TRIFED.getLocalStorageItem();
var editRole = TRIFED.checkPermissions("role_status");
var id = TRIFED.getUrlParameters().id;
$(function () {
    if(id!=undefined && id!='')
    {
        fetchRole();
    }
    
    updateRole();
 
});

fetchRole = () => {
    alert(conf.viewRole.url(id))
    var url = conf.viewRole.url(id);
    var method = conf.viewRole.method;
    var data = {};
    
    console.log(id);
    TRIFED.asyncAjaxHit(url+'/'+id, method, data, function (response, cb) {
       /* if (response) {
            data = response.data;
            fillRole(data);
      
        } else {
            TRIFED.showMessage('error', cb);
        }*/
    });
}

fillRole = (data) => {
    $('#title').val(data.title);
	$('#description').html(data.description);
	
}


updateRole = () => {
	$('#formID').on('submit', function(e) {
		e.preventDefault();
		var title = $('#title').val();
		var description = $('#description').val();
		var status = $('#status').val();
	
		if ($(this).validationEngine('validate')) {
			
			const data = $(this).serialize()+"&title="+title+"&description="+description;
			var url = conf.updateRole.url;
			var method = conf.updateRole.method;
			var id = TRIFED.getUrlParameters().id;

			TRIFED.asyncAjaxHit(url+'/'+id, method, data, function (response) {
				if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function(){window.location ="role-listing.php"},1000);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	    }
	})
}


