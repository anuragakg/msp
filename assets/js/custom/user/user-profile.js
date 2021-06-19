$(function () {
    updateProfile();
    getProfile();
	updateMoProfileCertificate();
});


var profileIds = [
	'name',
	'middle_name',
	'last_name',
	'email',
	'mobile_no',
];

var bankDetailsIds = [
	'bank_name',
	//'branch_name',
	'ifsc_code',
	'bank_ac_no',
	'ac_holder_name',
	'bank_ac_no',
	'ifsc_code'
];

var moIds = [
	'registration_date',
	'registration_expiry',
	'chairman_name',
	'chairman_mobile',
	'chairman_email',
	'secretary_name',
	'secretary_mobile',
	'secretary_email',
	'gst_or_tan'
];

/*Comes When the user*/
addressTemplate = () => {
	var template = `<label class="col-md-2 control-label">Official Address</label>
                    <div class="col-md-4">
                      <textarea class="form-control mdt_feild validate[required]" rows="3" id="official_address"></textarea>
                    </div>
                    <label class="col-md-2 control-label">Landline Number</label>
                    <div class="col-md-4">
                      <input class="form-control validate[minSize[10], maxSize[10]] numericOnly" type="text" id="landline_no" maxlength="10">
                    </div>
                    `;
    $('#address').html(template);
} 

/*Comes When the Supervisor or Surveyor*/
supervisorSurveyorTemplate = () => {
	var template = `<label class="col-md-2 control-label">Alternate Mobile No.</label>
                    <div class="col-md-4">
                      <input class="form-control mdt_feild validate[required,minSize[10], maxSize[10]] numericOnly alternate_no" type="text" id="alternate_no">
                    </div>`;
    $('#supervisor_surveyor').html(template);
} 


resgistrationCertificateTemplate = () => {
	$('.registration-certificate').css('display','block');
	$('#bank_details').css('display','none');
	var template = `
        <!--Group Change-->
        <div class="form-group">
            <label class="col-md-2 control-label">Registration Certificate</label>
            <div class="col-md-4">
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" id="certificate"></span>
                </div>
            </div>
        </div>`;
      $('#registration-certificate').html(template);
}

getProfile = () =>{
	var url = conf.getUserProfile.url;
	var method = conf.getUserProfile.method;
	var data = {};
	var localStorage = TRIFED.getLocalStorageItem();
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response.status) {

			profileIds.forEach(id =>{
				$('#'+id).val(response.data[id]);				
			})

			/*users*/
			if(localStorage.role!==12 && localStorage.role!==8 && localStorage.role!==11){
				addressTemplate();

				if(response.data['official_address']){
					$('#official_address').val(response.data['official_address']);
				}
				if(response.data['landline_no']){
					$('#landline_no').val(response.data['landline_no']);
				}
			}
			/**/

			/*Mo 8*/
			if(localStorage.role===8){
				resgistrationCertificateTemplate();

				var template = $('#mentoring-org-tmplate').html();
			    var html = Mustache.to_html(template, response.data.mo_details);
			    $('#mentoring-org-template-binding').html(html);
			}
			/**/

			/*supervisor and surveyeor 11 12*/
			if(localStorage.role===11 || localStorage.role===12){
				supervisorSurveyorTemplate();

				if(response.data['alternate_no']){
					$('#alternate_no').val(response.data['alternate_no']);
				}
			}
			/**/

			/*Bank Details will not present in  case of mo*/
			if(localStorage.role!==8 && response.data.user_bank_details){
				//$('.mobile_no').val(response.data.user_bank_details['mobile_no']);
				bankDetailsIds.forEach(id =>{
					$('#'+id).val(response.data.user_bank_details[id]);					
					/*if (response.data.user_bank_details['branch_name']) {
						$('#branch_name').attr('readonly', true);
					}
					if (response.data.user_bank_details['mobile_no']) {
						$('.mobile_no').attr('readonly', true);
					}*/
				})
			}
			/**/

		}
	});
}


updateProfile = () => {
	$('#formID').on('submit',function(e) {
		e.preventDefault();

		var data = {};
		data.user_bank_details={};
		data.mo_details={};

		profileIds.forEach( (id)=>{
			if($('#'+id).val()){
				data[id] = $('#'+id).val().trim();
			}
		})

		if(localStorage.role!==8){
			//data.user_bank_details['mobile_no'] = $('.mobile_no').val().trim();
			
			bankDetailsIds.forEach( (id)=>{
				data.user_bank_details[id] = $('#'+id).val().trim();
			})
		}


		/*User */
		if(localStorage.role!==12 && localStorage.role!==8 && localStorage.role!==11){
			if($('#official_address').val()){
				data['official_address'] = $('#official_address').val().trim();
			}

			if($('#landline_no').val()){
				data['landline_no'] = $('#landline_no').val();
			}else
			{
				data['landline_no'] = $('#landline_no').val();
			}
			
		}
		/**/

		/*MO*/
		moIds.forEach( (id)=>{
			if($('#'+id).val()){
				data.mo_details[id] = $('#'+id).val().trim();
			}
		})
		/**/

		/*Surveyor  and Supervisor*/
		var itwm = $('#alternate_no').val();
		
		var auth = TRIFED.getLocalStorageItem();
		if(auth.role == 11 || auth.role == 12){
			if($('#alternate_no').val()){
				
				data['alternate_no'] = $('#alternate_no').val().trim();
				
			}
		}
		/**/


		var url = conf.updateUserProfile.url;
    	var method = conf.updateUserProfile.method;

		TRIFED.asyncAjaxHit(url, method, data, function (response) {
	        if (response.status == 1) {
	        	$('#formID')[0].reset();
	            TRIFED.showMessage('success', 'Successfully updated');
	            setTimeout(function() { window.location = '../auth/dashboard.php'}, 500);
	        } else {
	            TRIFED.showError('error', response.message);
	        }
    	});
	})
}


updateMoProfileCertificate = () => {
		$('#certificate').on('change',function(e){
			if($('#certificate').prop('files')[0]){
				var formData = new FormData();
				var file = $('#certificate').prop('files')[0];
		        formData.append('registration_certificate', file );
			}

			var url = conf.updateMoProfileCertificate.url;
	    	var method = conf.updateMoProfileCertificate.method;

			TRIFED.fileAjaxHit(url, method, formData, function (response) {
		        if (response.status == 1) {
		            TRIFED.showMessage('success', 'Registration Certification Changed Successfully');
		        } else {
		            TRIFED.showError('error', response.message);
		        }
	    	});
		})

}

/* Bank Dept Details Hide and Show */
$(document).ready(function(){
  $("#BankDept").click(function(){
    $("div#BankDeptArea").toggle();
  });
});