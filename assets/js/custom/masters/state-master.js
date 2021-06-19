var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	if(viewMaster){
	   fetchStateList();
	}
	addState();
	editState();
	updateData();
});

fetchStateList = () => {
	var url = conf.getStateList.url;
    var method = conf.getStateList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillStateList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStateList = (data) => {
	var html = "";
	$.each(data, function(i, data){ 
		
			html +=
        '<tr id="' +
        xssClean(data.id) +
        '" ><td data-id="' +
        xssClean(data.id) +
        '">' +
        ++i +
        '</td><td id="row-data">' +
        xssClean(data.title) +
        "</td>" +
        '<td id="row-data">' +
        xssClean(data.code) +
        "</td>" +
        '<td class="action-area">';
		if(editMaster)
		{
			html +='<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		if (data.status == 1) {
			html += `<a class="data-active"  onclick="utils.toggleStatus('${data.id}', conf.toggleStateStatus, this)"> Active</a>`;
		  } else {
			html += `<a class="data-inactive"  onclick="utils.toggleStatus('${data.id}', conf.toggleStateStatus, this)"> Inactive</a>`;
		}
      	html += "</td>";
	});
	$('#state-table tbody').html(html);
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
  let { url, method } = conf.toggleStateStatus;

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


addState = () => {

	$('#formID').on('submit', function(e) {
        $("#submitButton").attr("disabled", true);
		e.preventDefault();
		var data = {};
		if ($('#title').val().trim().length != 0) {
			
			data.title = $('#title').val().trim();
			data.code = $('#code').val().trim();
			var url = conf.addState.url;
	    	var method = conf.addState.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "state-master.php";}, 500);
		        } else {
					TRIFED.showError('error', response.message);
					$("#submitButton").attr("disabled", false);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter state name');
			$("#submitButton").attr("disabled", false);
		}
	})
}  

editState = () => {
	
	$('.data-edit').on('click',function(e){

		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getStateData.url + id;
		var method = conf.getStateData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				addressData = response.data;
				fillStateData(addressData);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillStateData = (data) =>{
	$('#editModal').modal('show');
	$('#updateTitle').val(data['title']);
	$('#updateCode').val(data['code']);
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
			var url = conf.updateStateData.url + id;
	    	var method = conf.updateStateData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "state-master.php";}, 500);
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
      $('#state-table').DataTable({
        pageLength: 25,
        responsive: true,
        "bFilter": true,    
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'State Master List',
                exportOptions: {
                    columns: [0, 1, 2,3]
                }
            },
          ],
      });

      $( "#code" ).keyup(function() {
	  	var s=$('#code').val().trim(); 
			code = s.replace(/\b0+/g, "");
			//alert(code);
			$('#code').val(code);
	});
    });