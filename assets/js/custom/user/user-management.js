$(function () {
    fetchUserRole();
    fetchState();
    fetchDistrict();
    fetchIdProofList();
    fetchDesignation();
    fetchDepartment();
    addUser();

});

fetchUserRole = () => {
	var url = conf.getUserManagementRole.url;
    var method = conf.getUserManagementRole.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillUserRole(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillUserRole = (roles) => {
	html = '<option value="0">Select Role</option>';
	$.each(roles, function(i, role) {
		html += '<option value="'+role.id+'">'+utils.generateAbbreviation(role.title)+'</option>';
	});
	$('#user-type').html(html);
}

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
		if(auth.role == 6){
			html = '';
			html += '<option value="'+state.id+'">'+state.title+'</option>';
		}else{
			html += '<option value="'+state.id+'">'+state.title+'</option>';
		}
		
	});
	
	
	
	$('#state,#allowed_states').html(html);
	$('#allowed_states').select2();
}

$('#state').on('change', function (ev) {
	const v = $(this).val();
	fetchDistrict(v);
});
$('#user-type').on('change', function (ev) {
	let v = $(this).val();
	if(v==6)
	{
		$('#allowed_states_div').hide();
	}else{
		$('#allowed_states_div').hide();
	}
	
	if(v==9)
	{
		$('#levels').hide();
		$('#haat_market').hide();
	}
});

fetchDistrict = (id = 0) => {
	var url = conf.getDistricts.url;
	var method = conf.getDistricts.method;
	var data = {
		state_id : id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillDistrict(response.data);
		}
	});
}

fillDistrict = (districts) => {
	html = '<option value="">Select District</option>';
	if(auth.role == 6){
		html = '';
		html += '<option value="'+auth.district_id+'">'+auth.district+'</option>';
	}else{
		$.each(districts, function(i, district) {
			html += '<option value="'+district.id+'">'+district.title+'</option>';
		});
	}
	
	$('#district').html(html);
}
$('#district').on('change', function (ev) {
	const v = $(this).val();
	if($('#user-type').val()==11)
	{
		fetchHaatBazaar(v);	
	}
	
});
fetchIdProofList = () => {
	var url = conf.getIdProofList.url;
    var method = conf.getIdProofList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillIdProof(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillIdProof = (idProofs) => {
	//html = '<option value="0">Select ID Proof</option>';
	html = '';
	$.each(idProofs, function(i, idProof) {
		html += '<option value="'+idProof.id+'">'+idProof.title+'</option>';
	});
	$('#id_proof_type').html(html);
}

fetchDesignation = () => {
	var url = conf.getDesignationList.url;
    var method = conf.getDesignationList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillDesignation(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillDesignation = (designations) => {
	html = '<option value="0">Select Designation</option>';
	$.each(designations, function(i, designation) {
		html += '<option value="'+designation.id+'">'+designation.title+'</option>';
	});
	$('#designation').html(html);
}

fetchDepartment = () => {
	var url = conf.getDepartmentList.url;
    var method = conf.getDepartmentList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillDepartment(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillDepartment = (departments) => {
	html = '<option value="0">Select Department</option>';
	$.each(departments, function(i, department) {
		html += '<option value="'+department.id+'">'+department.title+'</option>';
	});
	$('#department').html(html);
}

addUser = () => {
	$('#formID').on('submit', function(e) {		
		e.preventDefault();

		id_proof_type = $('#id_proof_type').val();
		id_value=$('#id_proof_value').val();
		if(id_proof_type==1)
		{	var aadhar_no = /^\d{12}$/;
			  if(!id_value.match(aadhar_no))
			  {
			     $("#errorProof").html("Please enter valid Aadhaar number");
			     return false;
			  }else
			  {
			  	$("#errorProof").html("");
			  }
		}
		if(id_proof_type==2)
		{	var voter_no = /^([a-zA-Z]){3}([0-9]){7}?$/;
			  if(!id_value.match(voter_no))
			  {
			     $("#errorProof").html("Please enter valid Voter ID");
			     return false;
			  }else
			  {
			  	$("#errorProof").html("");
			  }
		}
		if(id_proof_type==3)
		{	var pan_no = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
			  if(!id_value.match(pan_no))
			  {
			     $("#errorProof").html("Please enter valid PAN number");
			     return false;
			  }else
			  {
			  	$("#errorProof").html("");
			  }
		}
		if(id_proof_type==4)
		{	var gov_no = /^[ A-Za-z0-9_@./#&+-]*$/;
			  if(!id_value.match(gov_no))
			  {
			     $("#errorProof").html("Please enter valid Govt ID");
			     return false;
			  }else
			  {
			  	$("#errorProof").html("");
			  }
		}

		if ($(this).validationEngine('validate')) {
			const data = $(this).serialize();
			//console.log(data);
			// const qObj = new URLSearchParams(data);
			
			// const state = qObj.get('state');
			// const district = qObj.get('district')
		    //	console.log(data);
			// var data = {};

			// data.role = $('#user-type').val();
			// data.state = $('#state').val();
			// data.district = $('#district').val();
			// data.block = 0;

			// data.user_name = $('#user_name').val().trim();
			// data.name = $('#name').val().trim();
			// data.middle_name = $('#middle_name').val().trim();
			// data.last_name = $('#last_name').val().trim();

			// data.dob = $('#dob').val().trim();
			// data.email = $('#email').val().trim();
			// data.mobile = $('#mobile').val().trim();
			// data.landline_no = $('#landline').val().trim();
			// data.official_address = $('#official_address').val().trim();

			// data.id_proof_type = $('#id_proof_type').val();
			// data.id_proof_value = $('#id_proof_value').val().trim();

			// data.department = $('#department').val();
			// data.designation = $('#designation').val();

			// data.holder_name = $('#holder_name').val();
			// data.bank_name = $('#bank_name').val();
			// data.bank_ac_no = $('#bank_ac_no').val();
			// data.ifsc_code = $('#ifsc_code').val();

			var url = conf.addUser.url;
			var method = conf.addUser.method;

			TRIFED.asyncAjaxHitLoader(url, method, data, function (response) {
				if (response.status == 1) {
					$('#formID')[0].reset();
					TRIFED.showMessage('success', 'Successfully Added');
					setTimeout(function() { window.location = 'user-listing.php'}, 500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	    }
	})
}

$('#user-type').on('change', function (ev) {
	$('#state-div').hide();
	$('#district-div').hide();
	let roleType = parseInt($(this).val());
	if($.inArray(roleType, [4,5,6,7,8,9,10,11]) != -1) {
		$('#state-div').show();
		if($.inArray(roleType, [6,7,8,9,10,11]) != -1) {
			$('#district-div').show();
		}
	}
	if($(this).val()==11)
	{
		$('#levels').hide();
		$('#haat_market').show();
	}
	if($(this).val()==9)
	{
		$('#levels').hide();
		$('#haat_market').hide();
	}
});

/* Bank Dept Details Hide and Show */
$(document).ready(function(){
  $("#BankDept").click(function(){
    $("div#BankDeptArea").toggle();
  });
});

/* Datepicker */
$(document).ready(function() {
    $('#data-calendar1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: new Date('1920-01-01'),
        endDate: new Date()

    });
});
if(auth.role==6){
	$('#levels').hide();
}

fetchHaatBazaar = (id = 0) => {
	var url = conf.getHaatMasterList.url;
	var method = conf.getHaatMasterList.method;
	var data = {
		state_id : $('#state').val(),
		district : $('#district').val()
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillHaatBazaar(response.data);
		}
	});
}

fillHaatBazaar = (haats) => {
	html = '<option value="">Select Haat Bazaar</option>';
	
		$.each(haats, function(i, haat) {
			html += '<option value="'+haat.id+'">'+haat.haat_bazaar_name+'</option>';
		});
	
	
	$('#haat_bazaar').html(html);
	$('#haat_bazaar').select2();
}

$(document).on('change','#district', function (ev) {
	const v = $(this).val();
	var role = $("#user-type").val();
	//if selected user type is warehouse user
	if(role == 9){ 
		fetchWarehouseMaster(v);
	}
	
});
fetchWarehouseMaster=(id=0,role)=>{
    var url = conf.getWarehouse.url;
    var method = conf.getWarehouse.method;
    var data = {
		district_id : id,
		state_id : $('#state').val()
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            warehousemaster_data=response.data; 
            fillWarehouseMaster(warehousemaster_data);
        }
    });
}
fillWarehouseMaster = (warehouseMaster) => {  
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouseMaster, function(i, warehouse) { 
        html += '<option value="'+warehouse.id+'" warehouse="'+warehouse.warehouse_id+'">'+warehouse.warehouse_name+'</option>';
    });
    $('#warehouse').html(html);
    $("#warehouse-master").show();
       if(auth.role == 9){
            $("#warehouse").val(auth.warehouse);
        }
    
}

// fetchWarehouseHaatmarketBlock = (id = 0) => {
// 	var url = conf.getWarehouseHaatmarket.url;
// 	var method = conf.getWarehouseHaatmarket.method;
// 	var data = {
// 		district_id : id,
// 		state_id : $('#state').val()
// 	};
// 	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
	
// 		if (response) {
// 			fillWarehouse(response.data.warehouse_data);
// 		}
// 	});
// }

// fillWarehouse = (haats) => {
	
// 	html = '<option value="">Select Warehouse</option>';
	
// 	haats.forEach(function(row){
// 		html += '<option value="'+row.id+'">'+row.get_part_one.name+'</option>';
// 	});
// 	$('#warehouse').html(html);
// 	$("#warehouse-master").show();
// }
