$(function () {
    fetchUserDetails();
});

fetchUserDetails = () => {
	var url = conf.getUser.url;
    var method = conf.getUser.method;
    var data = {};
    var id = TRIFED.getUrlParameters().user_id;
    TRIFED.asyncAjaxHit(url+'/'+id, method, data, function (response, cb) {
        if (response) {
            addressData = response.data;
            populateViewDetails(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

function populateViewDetails(data) {
	/** User Details */
	$('label[for="user-type"]').text(data.role);
	$('label[for="name"]').text(data.name);
	$('label[for="user_name"]').text(data.user_name);
	$('label[for="mobile_no"]').text(data.mobile);
	$('label[for="email"]').text(data.email);
	$('label[for="middle_name"]').text(data.middle_name);
	$('label[for="last_name"]').text(data.last_name);
	$('label[for="dob"]').text(data.dob);
	$('label[for="mobile"]').text(data.mobile);
	$('label[for="landline"]').text(data.landline_no);

	/** State district block */
	$('label[for="state"]').text(data.state);
	$('label[for="district"]').text(data.district);
	$('label[for="block"]').text(data.block);

	$('label[for="id_proof_type"]').text(data.id_proof_type_name);
	$('label[for="id_proof_value"]').text(data.id_proof_value);
	$('label[for="department"]').text(data.department_name);
	$('label[for="designation"]').text(data.designation_name);
	$('label[for="designation"]').text(data.designation_name);
	$('label[for="official_address"]').text(data.official_address);

	/** Bank Details */
	$('label[for="holder_name"]').text(data.holder_name)
	$('label[for="bank_name"]').text(data.bank_name)
	$('label[for="bank_ac_no"]').text(data.bank_ac_no)
	$('label[for="ifsc_code"]').text(data.ifsc_code)
}