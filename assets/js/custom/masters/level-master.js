var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
	  fetchLevelList();
	}
	addLevel();
	editLevel();
	updateData();
});

fetchLevelList = () => {
	var url = conf.getLevelList.url;
    var method = conf.getLevelList.method;
    var data = {status : 1};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillLevelList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillLevelList = (data) => {
	var html = "";
	$.each(data, function(i, data){ 
		html += '<tr id="' + data.id + '" ><td data-id="'+data.id+'">' + ++i + '</td><td id="row-data">' + data.title + '</td><td id="row-data">' + data.slug + '</td><td id="row-data">' + data.description + '</td>'+
		'<td class="action-area">';
		if(editMaster){
		html += '<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		html += '</td>';
	});
	$('#level-table tbody').html(html);
}

addLevel = () => {

	$('#formID').on('submit', function(e) {
        $("#submitButton").attr("disabled", true);
		e.preventDefault();
		var data = {};
		if ($('#title').val().trim().length != 0 && $('#slug').val().trim().length != 0 && $('#description').val().trim().length != 0) {

			data.title = $('#title').val().trim();
			data.slug = $('#slug').val().trim();
			data.description = $('#description').val().trim();
			var url = conf.addLevel.url;
	    	var method = conf.addLevel.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "level-master.php";}, 500);
		        } else {
					TRIFED.showError('error', response.message);
					$("#submitButton").attr("disabled", false);
		        }
	    	});
		} else {
			if ($('#title').val().trim().length == 0){
				TRIFED.showError('error', 'Please enter title');
			}
			if ($('#slug').val().trim().length == 0){
				TRIFED.showError('error', 'Please enter slug');
			}
			if ($('#description').val().trim().length == 0){
				TRIFED.showError('error', 'Please enter description');
			}
			$("#submitButton").attr("disabled", false);
		}
	})
}  

editLevel = () => {
	
	$('.data-edit').on('click',function(e){

		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getLevelData.url + id;
		var method = conf.getLevelData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				addressData = response.data;
				// console.log(addressData);
				fillLevelData(addressData);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillLevelData = (data) =>{
	$('#editModal').modal('show');
	$('#updateTitle').val(data['title']);
	$('#updateSlug').val(data['slug']);
	$('#updateDescription').val(data['description']);
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
            data.slug = $('#updateSlug').val().trim();
			data.description = $('#updateDescription').val().trim();
			var url = conf.updateLevelData.url + id;
	    	var method = conf.updateLevelData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "level-master.php";}, 500);
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
      $('#level-table').DataTable({
        pageLength: 20,
        responsive: true,        
        "paging":   false,
        "bFilter": true,    
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'Level Master List',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
          ], 
      });
    });