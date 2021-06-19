var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");


$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
	   fetchScheduledTribesList();
	}
	addScheduledTribes();
	editScheduledTribes();
    updateData();
    fetchStatesList();
});

fetchStatesList = () => {
	var url = conf.getStateList.url;
    var method = conf.getStateList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            populateStateList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fetchUpdatedStatesList = (state_id) => {
	var url = conf.getStateList.url;
    var method = conf.getStateList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            populateUpdatedStateList(response.data,state_id);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

populateStateList = (data) => {
	var html = "";
	html += '<option value="" >Select</option>';
	$.each(data, function(i, data){ 
		html += '<option value="' + data.id + '" >' + data.title + '</option>';
	});
	$('#state_id').html(html);
}

populateUpdatedStateList = (data,state_id) => {
	// console.log(data);
	var html = "";
	$.each(data, function(i, data){ 
		// console.log(data.title);

		if(data.id==state_id){
			html += '<option value="' + data.id + '" selected>' + data.title + '</option>';
		}else{
			html += '<option value="' + data.id + '" >' + data.title + '</option>';
		}
		
	});
	// console.log(html);
	$('#updatestate_id').html(html);
}

fetchScheduledTribesList = () => {
	var url = conf.getScheduledTribesList.url;
    var method = conf.getScheduledTribesList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillScheduledTribesList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillScheduledTribesList = (data) => {
	var html = "";

	$.each(data, function(i, item){ 
		html += '<tr id="' + item.id + '" ><td data-id="'+item.id+'">' + ++i + '</td><td id="row-data">' + item.title + '</td><td id="row-data">' + item.state.title + '</td>'+
		'<td class="action-area">';
		if(editMaster){
		   html += '<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		
		   html += '<a href="#" class="data-delete delete_shg_gatherers" id="'+item.id+'" data-toggle="tooltip" data-role="Delete" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>';
		
		if(statusMaster){
			if (item.status == 1) {
				html += `<a class="data-active" onclick="utils.toggleStatus('${item.id}', conf.toggleScheduledTribesStatus,this)"> Active</a>`;
			} else {
				html += `<a class="data-inactive" onclick="utils.toggleStatus('${item.id}', conf.toggleScheduledTribesStatus,this)"> Inactive</a>`;
			}
		}
      	html += "</td>";
	});
	$('#scheduled-tribes-table tbody').html(html);
}

/*
Status Function Open 
*/

$(document).ready(function(){
	$(".delete_shg_gatherers").click(function(){
		var id = this.id;
		if (!confirm('Are you sure you want to delete.')) {
			return;
		}

        var url = conf.deleteScheduledTribesData.url + id;
        var method = conf.deleteScheduledTribesData.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
          if (response.status) {
            if (response.status) {
              setTimeout(function(){ location.reload(); }, 1000);  //Refresh page
              return TRIFED.showMessage("success", "Scheduled Tribes Master successfully Removed");
              //return TRIFED.showMessage('success', response.data.message);
            }
            return TRIFED.showWarning('info', response.data.message);
          }
          TRIFED.showError('error', response.message);
        });
   	});
  });




function toggleStatus(id, element) {
  const el = $(element);
  changeStatusApi(id, function(r) {
    toggleElementState(r,el);
  });
}

function changeStatusApi(id, callback) {
  let { url, method } = conf.toggleScheduledTribesStatus;

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



addScheduledTribes = () => {

	$('#formID').on('submit', function(e) {
        $("#submitButton").attr("disabled", true);
		e.preventDefault();
		var data = {};
		if ($(this).validationEngine('validate')) {

			data.title = $('#title').val().trim();
			data.state_id = $('#state_id').val().trim();
			var url = conf.addScheduledTribes.url;
	    	var method = conf.addScheduledTribes.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "scheduled-tribes-master.php";}, 500);
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

editScheduledTribes = () => {
	
	$('.data-edit').on('click',function(e){
		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getScheduledTribesData.url + id;
		var method = conf.getScheduledTribesData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				addressData = response.data;
				fillScheduledTribesData(addressData);
				fetchUpdatedStatesList(response.data.state.id);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillScheduledTribesData = (data) =>{
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
			data.state_id = $('#updatestate_id').val().trim();
			var url = conf.updateScheduledTribesData.url + id;
	    	var method = conf.updateScheduledTribesData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "scheduled-tribes-master.php";}, 500);
		        } else {
		            TRIFED.showError('error', response.message);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
		}
	})
}
