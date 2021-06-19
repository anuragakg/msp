var auth = TRIFED.getLocalStorageItem();

var state_id = auth.state_id;
$(function () {

    fetchMfp(state_id);
    initDecimalNumeric();

    $("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
            mfp:{
            	'required':true
            },
            year: {
            	'required':true
            },
            procurement_qty:  {
            	'required':true
            },
            procurement_value:  {
            	'required':true
            },
            disposal_qty:  {
            	'required':true
            },
            disposal_value:  {
            	'required':true
            },
            losses_qty:  {
            	'required':true
            },
            losses_value:  {
            	'required':true
            },

            
        },
        messages: {
            mfp:{
            	'required':'Please select state',
            },
            year: {
            	'required':'Please select year',
            },
            procurement_qty:  {
            	'required':'Please enter procurement quantity',
            },
            procurement_value:  {
            	'required':'Please enter procurement value',
            },
            disposal_qty:  {
            	'required':'Please enter disposal quantity',
            },
            disposal_value:{
                'required':'Please enter disposal value',
            },
            losses_qty:  {
            	'required':'Please enter losses quantity',
            },
            losses_value:{
                'required':'Please enter losses value',
            },

		},
	    submitHandler: function(form) { 
	     	var form = $('#formID')[0];   
    		var data = new FormData(form);	
            var url = conf.addMfpProcurement.url;
            var method = conf.addMfpProcurement.method;
            //const data = $('#formID').serialize();
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Added');
					setTimeout(function() { window.location = 'last_five_years_mfp_details.php'}, 500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        //submit via ajax
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});


fetchMfp = (state_id = 0) => {
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;
            fillMfp(mfpmaster_data);
        }
    });

}

fillMfp = (mfps) => {
	html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
    });
    $('#mfp').html(html);
}


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
  
  