var auth = TRIFED.getLocalStorageItem();
//var editRole = TRIFED.checkPermissions("role_status");
//var statusRole = TRIFED.checkPermissions("role_edit");

var packing_id = TRIFED.getUrlParameters().id;

// $("#formID").validationEngine();  
$('#form_submit').on('click', function (e) {
	if($("#formID").validationEngine('validate')){
		if (packing_id != undefined && packing_id != null) {
			var url = conf.updatePackingMaster.url(packing_id);
			var method = conf.updatePackingMaster.method;
		} else {

			var url = conf.addPackingMaster.url;
			var method = conf.addPackingMaster.method;
		}

		const data = $('#formID').serialize();
		//console.log(data);
		TRIFED.asyncAjaxHit(url, method, data, function (response) {
			if (response.status == 1) {
				$('#formID')[0].reset();
				TRIFED.showMessage('success', 'Successfully Added');
				setTimeout(function () { window.location = 'packing-master-list.php' }, 500);
			} else {
				TRIFED.showError('error', response.message);
			}
		});

	}
});