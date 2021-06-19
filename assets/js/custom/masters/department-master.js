var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
		fetchDepartmentList();
	  }
    
	addDepartment();
	editDepartment();
	updateData();
});

fetchDepartmentList = () => {
	var url = conf.getDepartmentList.url;
    var method = conf.getDepartmentList.method;
    var data = { status : 1 };
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillDepartmentList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillDepartmentList = (data) => {
	var html = "";
	$.each(data, function(i, data){ 
		html += '<tr id="' + data.id + '" >'+
		'<td data-id="'+data.id+'">' + ++i + '</td>'+
		'<td id="row-data">' + data.title + '</td>'+
		'<td class="action-area">';
		if(editMaster){
		   html += '<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		if(statusMaster){
			if (data.status == 1) {
				html += `<a class="data-active" onclick="utils.toggleStatus('${data.id}', conf.toggleDepartmentStatus, this)"> Active</a>`;
			} else {
				html += `<a class="data-inactive" onclick="utils.toggleStatus('${data.id}', conf.toggleDepartmentStatus, this)"> Inactive</a>`;
			}
		}
      	html += "</td></tr>";
	});
	$('#department-table tbody').html(html);
}

addDepartment = () => {

	$('#formID').on('submit', function(e) {
		$("#submitButton").attr("disabled", true);
		e.preventDefault();
		var data = {};
		if ($('#title').val().trim().length != 0) {

			data.title = $('#title').val().trim();
			var url = conf.addDepartment.url;
	    	var method = conf.addDepartment.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "department-master.php";}, 500);
		        } else {
					TRIFED.showError('error', response.message);
					$("#submitButton").attr("disabled", false);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
			$("#submitButton").attr("disabled", false);
		}
	})
}  

editDepartment = () => {
	
	$('.data-edit').on('click',function(e){
		
		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getDepartmentData.url + id;
		var method = conf.getDepartmentData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				addressData = response.data;
				fillDepartmentData(addressData);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillDepartmentData = (data) =>{
	$('#editModal').modal('show');
	$('#updateTitle').val(data['title']);
	$('#updateID').val(data['id']);
	
}

updateData = () =>{
	$('#updateButton').off('click');
	$('#updateButton').on('click', function(e) {
		var id = '';
		id = $('#updateID').val();
		e.preventDefault();
		var data = {};
		if ($('#updateTitle').val().trim().length != 0) {
			data.title = $('#updateTitle').val().trim();
			var url = conf.updateDepartmentData.url + id;
	    	var method = conf.updateDepartmentData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "department-master.php";}, 500);
		        } else {
		            TRIFED.showError('error', response.message);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
		}
	})
}
