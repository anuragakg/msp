var editUser = TRIFED.checkPermissions("user_management_edit");
var statusUser = TRIFED.checkPermissions("user_management_status");
var set_user_wise_permission = TRIFED.checkPermissions("user_management_set_user_wise_permission");
$(function() {
	//fetchUserList();
	fetchUserRole();
	fetchState();
});
$(document).ready(function() {
	var auth = TRIFED.getLocalStorageItem();
	//if logged in user is DIA then do not show level column
	if(auth.role == 6){
		visibilty = false;
	}else{
		visibilty = true;
	}
      var oTable =$('#user-list').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [[0, "DESC"]],
		  "dom": 'lBfrtip',
		   oLanguage: {
				//sProcessing: "<div class='listing-loader'></div>"
				sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
			},
				
			"buttons": [

				{
					extend: 'excel',
					text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
					titleAttr: 'EXCEL',
					title: 'Users List',
					exportOptions: {
						columns: [0, 1, 2,3,4,5,6,7,8]
					}
				},
				

				
			  ],
			  "columnDefs": [
				{ "visible": visibilty, "targets": 6 }
			  ],
            "ajax":{
                     "url": conf.getUser.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				         d.state=$('#state_id').val();
				         d.district=$('#district_id').val();
				         d.role=$('#user-type').val();
				      },
		            "dataSrc": function(json) {
		            		json.draw = json.data.draw;
							json.recordsTotal = json.data.recordsTotal;
							json.recordsFiltered = json.data.recordsFiltered;			
	       					return json.data.data;
	       						
	    			}
                   },
		            "columns": [
		                { 
		                	"render": function(data, type, full, meta) {
						        var PageInfo = $('#user-list').DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						        
						    }
						},
						{ "data": "user_name" },
		                { "data": "name" },
		                { "data": "email" },
		                //{ "data": "mobile" },
						{
							"orderable": false,
							"render": function(data, type, row) {
									if(row.mobile!='')
									return "+91"+row.mobile;
									else 
									return "";
									
							}
						},
		                //{ "data": "official_address" },
						{
							"orderable": false,
							"render": function(data, type, row) {
									return row.role;
									
							}
						},
						{
							"orderable": false,
							"render": function(data, type, row) {
									return row.level_id;
									
							}
						},
						{
							"orderable": false,
							"render": function(data, type, row) {
									return row.designation_name;
									
							}
						},
						{
							"orderable": false,
							"render": function(data, type, row) {
									return row.department_name;
									
							}
						},
						{
							"orderable": false,
							"render": function(data, type, row) {
									var html='';
									if(statusUser){
												subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')"><i class="fa fa-check" aria-hidden="true"></i></a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')"><i class="fa fa-times" aria-hidden="true"></i></a>';
									}
									if(editUser){
					                	html += '<a href="user-edit.php?user_id=' + row.id + '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
									}
									if(statusUser && auth.role != row.role_value){
										html += ' | '+subHtml+'';
									}
									if(set_user_wise_permission){
										html += ' | '+'<a href="user-permission.php?user_id=' + row.id + '" data-toggle="tooltip" data-placement="top" title="" data-original-title="User Permission"><i class="fa fa-lock" aria-hidden="true"></i></a>'+'';
									}
									return html;
									
							}
						},
		               
		                
		            ]

      });
      	$('#state_id,#district_id,#user-type').on('change',function () {
			oTable.ajax.reload();
		});
		$('#reset_filter').on('click',function(){
				$('.filter').val('');
				$('#district_id').html('<option value="">Select District</option>');
				oTable.ajax.reload();
		});
    });


fetchUserList = () => {
	var url = conf.getUser.url;
    var method = conf.getUser.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillUserList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillUserList = (users) => {
	var html = "";
	$.each(users, function(i, user){
		var mobile = (user.mobile != null) ? user.mobile : " "; 
		if(statusUser){
			subHtml = (user.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
		}
		id_proofvalue=user.id_proof_value;
		id_proofvalue = id_proofvalue.replace(/\d(?=\d{4})/g, "*");
		html += '<tr id="' + user.id + '" >'+
				'<td id="row-data">' + ++i + '</td>'+
				'<td id="row-data">' + user.role + '</td>'+
				'<td id="row-data">' + user.user_name + '</td>'+
				'<td id="row-data">' + user.name + '</td>'+
				'<td id="row-data">' + mobile + '</td>'+
				'<td id="row-data">' + id_proofvalue + '</td>'+
				'<td id="row-data">' + user.official_address + '</td>'+
				'<td id="row-data">' + user.designation_name + '</td>'+
				'<td id="row-data">' + user.department_name + '</td>'+
				'<td class="action-area">';

				if(editUser){
                	html += '<a href="user-edit.php?user_id=' + user.id + '" class="data-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
				}
				if(statusUser){
					html += ' | '+subHtml+'';
				}
                html += '</td>';
	});
	$('#user-list tbody').html(html);
}

changeActiveStatus = (id) => {

	if(confirm('Are you sure you want to change the status?')){

		const _t = $(this);

		var url = conf.changeUserStatus.url(id);
	    var method = conf.changeUserStatus.method;
	    var data = {};
	    data.user_id = id;
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response.status) {
				if (response.data.status=='1') {
					_t.attr('class', 'data-active');
					TRIFED.showMessage('success', response.data.message);
						/*setTimeout(function () {
						location.reload();
					}, 500);*/
					$('#user-list').DataTable().ajax.reload();
				}
				if (response.data.status=='0') {
				_t.attr('class', 'data-inactive');
				TRIFED.showWarning('info', response.data.message);
				$('#user-list').DataTable().ajax.reload();
			}
				
				return;
			}
			TRIFED.showError('error', response.message);
		});
	}
}

function importExcelFile() {
	$('#importExcel').on('click', function (e) {
		e.preventDefault();
		var url = conf.importUserExcel.url;
		var method = conf.importUserExcel.method;
		var file = $('#import_file').prop('files')[0];
		var data = new FormData();
		data.append('import_file', file, file.name);

		TRIFED.fileAjaxHit(url, method, data, function(r) {
			if (r.status == 1) {
				TRIFED.showMessage("success", "Successfully Added");
				setTimeout(function() {
					location.reload();
				}, 500);
			}else{
				$('#file_errors').html(r.message).css('color','red');
				$(".fa-spinner").hide();
				TRIFED.showError('error', r.message);
			}
		});
	});
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
		if(auth.role == 6 && auth.state_id == state.id){
			html += '<option value="'+state.id+'" selected>'+state.title+'</option>';
		}else{
			html += '<option value="'+state.id+'">'+state.title+'</option>';
		}
	});
	$('#state_id').html(html);
}
$(document).on('change','#state_id', function (ev) {

	const v = $(this).val();
	var item_id = $(this).attr('state_id');
	
	fetchDistrict(v,item_id);
});


setTimeout(function(){
	if(auth.role == 6){
		var state = $("#state_id").val();
		fetchDistrict(state);
	}
},2000)

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
	$.each(districts, function(i, district) {
	
		if(auth.district_id == district.id && auth.role == 6){
		
			html += '<option value="'+district.id+'" selected >'+district.title+'</option>';
		}else{
			html += '<option value="'+district.id+'">'+district.title+'</option>';
		}
	});
	if(auth.role == 6){
		$('#district_id').attr('readonly','readonly');
		$('#state_id').attr('readonly','readonly');
		$('#district_id').attr("style","pointer-events: none; cursor: default;");
	}
	$('#district_id').html(html);
}


fillDesignation = (designations) => {
	html = '<option value="">Select Designation</option>';
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
	html = '<option value="">Select Department</option>';
	$.each(departments, function(i, department) {
		html += '<option value="'+department.id+'">'+department.title+'</option>';
	});
	$('#department').html(html);
}
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
	html = '<option value="">Select Role</option>';
	$.each(roles, function(i, role) {
		html += '<option value="'+role.id+'">'+utils.generateAbbreviation(role.title)+'</option>';
	});
	$('#user-type').html(html);
}