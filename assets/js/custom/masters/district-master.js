var paginatedFilter = {};
var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
	  fetchDistrictList();
	}
	addDistrict();
	editDistrict();
    updateData();
	fetchStatesList();
	searchEvent();
	
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
	// console.log(state_id);
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
	$('#stateMasterHaat').html(html);
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

fetchDistrictList = (data = {}) => {
	var url = conf.getDistrictList.url;
    var method = conf.getDistrictList.method;
   	 data.state = $('#stateMasterHaat').val();
	 data.q = $('#queryTerm').val();
	 
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillDistrictList(response.data);
            // populateStateList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillDistrictList = (data) => {
	utils.renderSimplePagination(data, "#pagination", fetchDistrictList);
	var perPage = parseInt(data.per_page);
    var currentPage = parseInt(data.current_page);
	var html = "";
	var j = ((currentPage-1)*perPage)+1;
	$.each(data.records, function(i, data){ 
	
		html += '<tr id="' + data.id + '" ><td data-id="'+data.id+'">' + j++ + '</td><td id="row-data">' + data.title + '</td><td id="row-data">' + data.code + '</td><td id="row-data">' + data.state[0].title + '</td>'+
		'<td class="action-area">';
		if(editMaster)
	  {
		html +='<a href="#" class="data-edit" data-id="'+data.code+'" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
	  }
	  
		if (data.status == 1) {
			html += `<a class="data-active"  onclick="utils.toggleStatus('${data.id}', conf.toggleDistrictStatus, this)"> Active</a>`;
		  } else {
			html += `<a class="data-inactive"  onclick="utils.toggleStatus('${data.id}', conf.toggleDistrictStatus, this)"> Inactive</a>`;
		}
      	html += "</td>";
	});
	$('#district-table tbody').html(html);
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
  let { url, method } = conf.toggleDistrictStatus;

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



addDistrict = () => {

	$('#formID').on('submit', function(e) {
        $("#submitButton").attr("disabled", true);
		e.preventDefault();
		var data = {};
			if ($('#title').val().trim().length != 0) {

			data.title = $('#title').val().trim();
			data.code = $('#code').val().trim();
			data.state_id = $('#state_id').val().trim();
			var url = conf.addDistrict.url;
	    	var method = conf.addDistrict.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "district-master.php";}, 500);
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

editDistrict = () => {
	
	$(document).on('click','.data-edit',function(e){
		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var id_value = $(this).closest(".data-edit").attr("data-id");
		var url = conf.getDistrictData.url + id;
		var method = conf.getDistrictData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				// console.log(response.data.state_id);
				addressData = response.data;
				fillDistrictData(id_value,addressData);
				fetchUpdatedStatesList(response.data.state_id);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillDistrictData = (id_value,data) =>{
	$('#editModal').modal('show');
	$('#updateTitle').val(data['title']);
	//$('#updateCode').val(data['code']);
	$("#updateCode").val(id_value);
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
            data.code = $('#updateCode').val().trim();
			data.state_id = $('#updatestate_id').val().trim();            
			var url = conf.updateDistrictData.url + id;
	    	var method = conf.updateDistrictData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "district-master.php";}, 500);
		        } else {
		            TRIFED.showError('error', response.message);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
		}
	})
}

var searchEvent = () => {
	$('#search').on('click', function () {
		filterdata();
	})
}
utils.addPerPageListing(fetchDistrictList);
function filterdata(){	 
	fetchDistrictList();
}


$(document).ready(function() {
      $('#district-table').DataTable({
        pageLength: 20,
        responsive: true,
        "bFilter": true,  
        "paging":   false, 
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'District Master List',
                exportOptions: {
                    columns: [0, 1, 2,3]
                }
            },
          ], 
      });
    });