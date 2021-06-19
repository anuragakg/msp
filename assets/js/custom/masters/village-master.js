var paginatedFilter = {};
var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
	  fetchVillageList();
	}
	addVillage();
	editVillage();
	updateData();
	searchEvent();
	importExcelFile();
	utils.addPerPageListing(fetchVillageList, paginatedFilter);
});

fetchVillageList = (data = {}) => {
	var url = conf.getVillageList.url;
    var method = conf.getVillageList.method;
    //var data = {};
    data.pincode = $('#pincode').val();
    data.code = $('#village_code').val();
	 data.q = $('#queryTerm').val();
     data.OrderBy=$('#OrderBy').val();
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillVillageList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillVillageList = (data) => {
	utils.renderSimplePagination(data, "#pagination", fetchVillageList);
	var perPage = parseInt(data.per_page);
    var currentPage = parseInt(data.current_page);
	var html = "";
	var j = ((currentPage-1)*perPage)+1;
	$.each(data.records, function(i, data){ 
		if(data.title!='' && data.pincode!='' && data.code!=''){
		html += '<tr id="' + data.id + '" ><td data-id="'+data.id+'">' + j++ + '</td><td id="row-data">' + data.title + '</td>'+ '<td id="row-data">' + data.code + '</td>'+ '<td id="row-data">' + data.pincode + '</td>'+
		'<td class="action-area">';
		if(editMaster)
		{
			html +='<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		if (data.status == 1) {
			html += `<a class="data-active" onclick="utils.toggleStatus('${data.id}', conf.toggleVillageStatus, this)"> Active</a>`;
		  } else {
			html += `<a class="data-inactive" onclick="utils.toggleStatus('${data.id}', conf.toggleVillageStatus, this)"> Inactive</a>`;
		}
      	html += "</td>";
		}
	});
	$('#village-table tbody').html(html);
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
  let { url, method } = conf.toggleVillageStatus;

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

addVillage = () => {

	$('#formID').on('submit', function(e) {
        $("#submitButton").attr("disabled", true);
		e.preventDefault();
		var data = {};
		if ($(this).validationEngine('validate')) {

			data.title = $('#title').val().trim();
			data.code = $('#code').val().trim();
			data.pincode = $('#pin_code').val().trim();
			var url = conf.addVillage.url;
	    	var method = conf.addVillage.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "village-master.php";}, 500);
		        } else {
					TRIFED.showError('error', response.message);
					$("#submitButton").attr("disabled", false);
		        }
	    	});
		}
	})
}  

editVillage = () => {
	
	$(document).on('click','.data-edit',function(e){

		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getVillageData.url + id;
		var method = conf.getVillageData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				addressData = response.data;
				fillVillageData(addressData);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	
$("#OrderBy").on('change',function(){		 
 	 	var q = $('#queryTerm').val();
		var pincode= $('#pincode').val();
		var OrderBy = $('#OrderBy').val();
	var data = {
		'pincode': isNaN(pincode) ? null : pincode,
		'q': q,
		'OrderBy': OrderBy,
	}; 
	fetchVillageList(data);

});

fillVillageData = (data) =>{
	$('#editModal').modal('show');
	$('#updateTitle').val(data['title']);
	$('#updateCode').val(data['code']);
	$('#updatePincode').val(data['pincode']);
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
			data.pincode = $('#updatePincode').val().trim();
			var url = conf.updateVillageData.url + id;
	    	var method = conf.updateVillageData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "village-master.php";}, 500);
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
function filterdata(){
	fetchVillageList();
}

function importExcelFile() {
  $("#importExcel").on("click", function(e) {
    e.preventDefault();
    var url = conf.importExcelVillage.url;
    var method = conf.importExcelVillage.method;   
    var file = $("#import_file").prop("files")[0];
    var data = new FormData();    
    data.append("import_file", file, file.name);

    TRIFED.fileAjaxHit(url, method, data, function(r) {
      if (r.status == 1) {
        TRIFED.showMessage("success", "Successfully Added");
        setTimeout(function() {
          location.reload();
        }, 500);
      } else {
        $("#file_errors")
          .html(r.message)
          .css("color", "red");
          $(".fa-spinner").hide();
        TRIFED.showError("error", r.message);
      }
    });
  });
}

$('#exportExcel').on('click', function (e) {
	e.preventDefault();
	var url = conf.exportVillageData.url;
	var method = conf.exportVillageData.method;
	var data = {};

	TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
		window.location.href = endpoint+''+response.data.file;
	});	
});

$(document).ready(function() {
      $('#village-table').DataTable({
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
                title: 'Village Master List',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
          ], 
      });
    });