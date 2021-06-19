function getUrlVars() {
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for (var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}

$(function () {
    fetchState();
    var mfp_id = TRIFED.getUrlParameters().id;
    if (mfp_id != undefined && mfp_id != '') 
	{
		getMfpFormData(mfp_id);
	}
	$("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
            state_id:{
            	'required':true
            },
            mfp_id: {
            	'required':true
            },
            botanical_name:  {
            	'required':true
            },
            local_name:  {
            	'required':true
            },
            msp_price:  {
            	'required':true
            },
            
        },
        messages: {
            state_id:{
            	'required':'Please select state',
            },
            mfp_id: {
            	'required':'Please select mfp',
            },
            botanical_name:  {
            	'required':'Please enter Botanical Name',
            },
            local_name:  {
            	'required':'Please enter Local Name',
            },
            msp_price:  {
            	'required':'Please enter MSP Price',
            },
		},
	    submitHandler: function(form) { 
	        if (mfp_id != undefined && mfp_id != '') 
			{
				var url = conf.updateMfp.url(mfp_id);
				var method = conf.updateMfp.method;
			}else{
				
			}
			//const data=$('#formID').serializeArray();
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		var url = conf.addMfp.url;
			var method = conf.addMfp.method;
			if (mfp_id != undefined && mfp_id != '') 
			{
				data.append('form_id', mfp_id );
			}
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Successfully Added');
					setTimeout(function() { window.location = 'mfp-master.php'}, 500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        //submit via ajax
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});
fetchState = () => {
	var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillStates(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states) => {
	html = '<option value="">Select State</option>';
	$.each(states, function(i, state) {
		html += '<option value="'+state.id+'">'+state.title+'</option>';
	});
	$('#state_id').html(html);
}
$('#state_id').on('change', function (ev) {
	const v = $(this).val();
	fetchMfp(v);
});
fetchMfp = (state_id = 0) => {
	var url = conf.getCommodityStateWiseList.url;
	var method = conf.getCommodityStateWiseList.method;
	var data = {
		state_id : state_id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillMfp(response.data);
		}
	});
}

fillMfp = (mpf_data) => {
	html = '<option value="">Select MFP</option>';
	$.each(mpf_data, function(i, mpf) {
		html += '<option value="'+mpf.id+'">'+mpf.title+'</option>';
	});
	$('#mfp_id').html(html);
}
getMfpFormData=(mfp_id)=>{
	var url = conf.getMfpFormDetail.url(mfp_id);
	var method = conf.getMfpFormDetail.method;
	data={};

	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillMfpFormData(response.data);
		}
	});	
}
fillMfpFormData=(data)=>{
	$('#state_id').val(data.state_id).trigger('change');
	$('#mfp_id').val(data.mfp_id);
	$('#msp_price').val(data.msp_price);
	$('#botanical_name').val(data.botanical_name);
	$('#local_name').val(data.local_name);
	if(data.image!='' && data.image!=null)
	{
		$('#image_display').html('<a target="_blank" href="'+data.image+'">View Document</a>');
	}
}