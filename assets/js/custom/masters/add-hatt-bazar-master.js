var auth = TRIFED.getLocalStorageItem();

fetchState = (item_id=0) => {
	var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
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
}

$(document).on('change','.states', function (ev) {

	const v = $(this).val();
	var item_id = $(this).attr('state_id');
	fetchDistrict(v,item_id);
});

fetchDistrict = (id = 0,item_id=0) => {
	var url = conf.getDistricts.url;
	var method = conf.getDistricts.method;
	var data = {
		state_id : id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillDistrict(response.data,item_id);
		}
	});
}

fillDistrict = (districts,item_id=0) => {
	html = '<option value="">Select District</option>';
	$.each(districts, function(i, district) {
		html += '<option value="'+district.id+'">'+district.title+'</option>';
	});
	$('#district'+item_id).html(html);
}

$(document).on('change','.district', function (ev) {
	const v = $(this).val();
	var item_id = $(this).attr('district_id');
	fetchHaatList(v,item_id);
	fetchBlockList(v,item_id);

});

fetchHaatList = (id = 0,item_id=0) => {
	
	var url = conf.getHaatMarket.url(id);
	var method = conf.getHaatMarket.method;
	var data = {
		//district_id : id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
	
		if (response) {
			fillHaatlist(response.data,item_id);
		}
	});
}

fillHaatlist = (haats,item_id=0) => {
	html = '<option value="0">Select Haat</option>';
	$.each(haats, function(i, row) {
		html += '<option value="'+row.id+'">'+row.get_part_one.rpm_name+'</option>';
	});
	$('#hatts'+item_id).html(html);
}



fetchBlockList = (id = 0,item_id=0) => {
	var url = conf.getBlockByDistrict.url(id);
	var method = conf.getBlockByDistrict.method;
	var data = {
		district_id : id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillBlocklist(response.data,item_id);
		}
	});
}

fillBlocklist = (blocks,item_id) => {
	html = '<option value="0">Select Block</option>';
	$.each(blocks, function(i, block) {
		html += '<option value="'+block.id+'">'+block.title+'</option>';
	});
	$('#blocks'+item_id).html(html);
}




var haat_detail_id = TRIFED.getUrlParameters().id;
$('#form_submit').on('click', function (e) {
	
	if ($("#formID").validationEngine('validate')) {
		if (haat_detail_id != undefined && haat_detail_id != null) {
			var url = conf.updateHaatBazaarMaster.url(haat_detail_id);
			var method = conf.updateHaatBazaarMaster.method;
		} else {
			var url = conf.addHaatBazaarMaster.url;
			var method = conf.addHaatBazaarMaster.method;
		}
		const data = $('#formID').serialize();
		TRIFED.asyncAjaxHit(url, method, data, function (response) {
			if (response.status == 1) {
				$('#formID')[0].reset();
				
				TRIFED.showMessage('success', 'Successfully Added');
				setTimeout(function () { window.location = 'haat-bazaar-list.php' }, 500);
			} else {
				TRIFED.showError('error', response.message);
			}
		});
	} 
	
});