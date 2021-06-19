var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
		fetchDesignationList();
	  }
    
	addDesignation();
	editDesignation();
	updateData();
});

fetchDesignationList = () => {
	var url = conf.getDesignationList.url;
    var method = conf.getDesignationList.method;
    var data = { status : 1 };
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillDesignationList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillDesignationList = (data) => {
	var html = "";
	$.each(data, function(i, data){ 
		html += '<tr id="' + data.id + '" ><td data-id="'+data.id+'">' + ++i + '</td><td id="row-data">' + data.title + '</td>'+
		'<td class="action-area">';
		if(editMaster){
			html += '<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		if(statusMaster){
			if (data.status == 1) {
				html += `<a class="data-active" onclick="utils.toggleStatus('${data.id}', conf.toggleDesignationStatus, this)"> Active</a>`;
			} else {
				html += `<a class="data-inactive" onclick="utils.toggleStatus('${data.id}', conf.toggleDesignationStatus, this)"> Inactive</a>`;
			}
		}
      	html += "</td>";

	});
	$('#designation-table tbody').html(html);
}

addDesignation = () => {

	$('#formID').on('submit', function(e) {
        $("#submitButton").attr("disabled", true);
		e.preventDefault();
		var data = {};
		if ($('#title').val().trim().length != 0) {

			data.title = $('#title').val().trim();
			var url = conf.addDesignation.url;
	    	var method = conf.addDesignation.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "designation-master.php";}, 500);
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

editDesignation = () => {
	
	$('.data-edit').on('click',function(e){

		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getDesignationData.url + id;
		var method = conf.getDesignationData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				addressData = response.data;
				fillDesignationData(addressData);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillDesignationData = (data) =>{
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
			var url = conf.updateDesignationData.url + id;
	    	var method = conf.updateDesignationData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "designation-master.php";}, 500);
		        } else {
		            TRIFED.showError('error', response.message);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
		}
	})
}



$(document).ready(function() {
      $('#designation-table').DataTable({
        pageLength: 25,
        responsive: true,
        "bFilter": true,    
        "paging":   false,
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'Designation Master List',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
          ], 
      });
    });