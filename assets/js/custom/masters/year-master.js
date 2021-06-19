var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
	  fetchYearList();
	}
	addYear(); 
	editYear();
	updateData();
});

fetchYearList = () => {
	var url = conf.getYearList.url;
    var method = conf.getYearList.method;
    var data = { status : 1};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillYearList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillYearList = (data) => {
	var html = "";
	$.each(data, function(i, data){ 
		
		html += '<tr id="' + data.id + '" ><td data-id="'+data.id+'">' + ++i + '</td><td id="row-data">' + data.title + '</td>'+
		'<td class="action-area">';
		if(editMaster)
		{
		html += '<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		if(statusMaster){
			if (data.status == 1) {
				html += `<a class="data-active" onclick="utils.toggleStatus('${data.id}', conf.toggleYearStatus, this)"> Active</a>`;
			} else {
				html += `<a class="data-inactive" onclick="utils.toggleStatus('${data.id}', conf.toggleYearStatus, this)"> Inactive</a>`;
			}
		}
      	html += "</td>";
	});
	$('#year-table tbody').html(html);
}


/*
Status Function Open 
*/

function toggleStatus(id, element) {
  const el = $(element);
  changeStatusApi(id, function(r) {
    toggleElementState(r,el);
  });
}

function changeStatusApi(id, callback) {
  let { url, method } = conf.toggleYearStatus;

  TRIFED.asyncAjaxHit(url(id), method, {}, function(response, cb) {
    if (response.status) {
      callback(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
}

function toggleElementState(r,element){
	if (r.status == 1) {
    element
      .attr({
        class: "data-active"
      })
      .text(" Active");
    return TRIFED.showMessage("success", r.message);
  }
  element
    .attr({
      class: "data-inactive"
    })
    .text(" Inactive");
  return TRIFED.showWarning("info", r.message);
}

/*
Status Function Close
*/

addYear = () => {

	$('#submit_button').on('click',function(e) {
		$("#submit_button").attr("disabled", true);
		e.preventDefault();
		var data = {};
		if ($('#title').val().trim().length != 0) {

			data.title = $('#title').val().trim();
			var url = conf.addYear.url;
	    	var method = conf.addYear.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "year-master.php";}, 500);
		        } else {
					TRIFED.showError('error', response.message);
					$("#submit_button").attr("disabled", false);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
			$("#submit_button").attr("disabled", false);
		}
	})
}  

editYear = () => {
	
	$('.data-edit').on('click',function(e){

		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getYearData.url + id;
		var method = conf.getYearData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				addressData = response.data;
				fillYearData(addressData);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillYearData = (data) =>{
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
			var url = conf.updateYearData.url + '/' + id;
	    	var method = conf.updateYearData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "year-master.php";}, 500);
		        } else {
		            TRIFED.showError('error', response.message);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
		}
	})
}
