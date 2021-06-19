var paginatedFilter = {};
var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function () {
	// TRIFED.checkToken();
	if(viewMaster){
		fetchBlockList();
	 }
    
    fetchStatesList();
	addBlock();
	editBlock();
	updateData();
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

fetchBlockList = (data = {}) => {
	var url = conf.getBlockMaster.url;
    var method = conf.getBlockMaster.method;
   // var data = {};
    data.q = $('#queryTerm').val();
	data.state = $('#stateMasterHaat').val();
	data.district = $('#districtMasterHaat').val();
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillBlockList(response.data);
            // populateStateList(response.data);
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

fetchUpdatedDistrictList = (state_id,district_id) => {
	console.log(state_id);
	var url = conf.getDistrictData.url+'?state_id=' + state_id;
    var method = conf.getDistrictData.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            populateUpdatedDistrictList(response.data,district_id);
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
	$('#districtMasterHaat').html(html);
}

populateUpdatedDistrictList = (data,district_id) => {
	// console.log(data);
	var html = "";
	$.each(data, function(i, data){ 
		// console.log(data.title);

		if(data.id==district_id){
			html += '<option value="' + data.id + '" selected>' + data.title + '</option>';
		}else{
			html += '<option value="' + data.id + '" >' + data.title + '</option>';
		}
		
	});
	// console.log(html);
	$('#updatedistrict_id').html(html);
}

fetchDistrictList = () => {
	var url = conf.getDistrictList.url;
    var method = conf.getDistrictList.method;
    var data = {};
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

fillBlockList = (data) => {
	utils.renderSimplePagination(data, "#pagination", fetchBlockList);
	var perPage = parseInt(data.per_page);
    var currentPage = parseInt(data.current_page);
	var html = "";
	var j = ((currentPage-1)*perPage)+1;
	$.each(data.records, function(i, data){ 
		html += '<tr id="' + data.id + '" ><td data-id="'+data.id+'">' + j++ + '</td><td id="row-data">' + data.title + '</td><td id="row-data">' + data.code + '</td><td id="row-data">' + data.district.title + '</td>'+
		'<td id="row-data">' + data.district.state.title + '</td><td class="action-area">';
		if(editMaster)
		{
			html +='<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
		}
		if (data.status == 1) {
			html += `<a class="data-active" onclick="utils.toggleStatus('${data.id}',conf.toggleBlockStatus, this)"> Active</a>`;
		  } else {
			html += `<a class="data-inactive" onclick="utils.toggleStatus('${data.id}',conf.toggleBlockStatus, this)"> Inactive</a>`;
		}

      	html += "</td>";

	});
	$('#block-table tbody').html(html);
}

addBlock = () => {

	$('#formID').on('submit', function(e) {
        $("#submitButton").attr("disabled", true);
        e.preventDefault();
        // alert('sss');
		var data = {};
		if ($('#title').val().trim().length != 0) {

			data.title = $('#title').val().trim();
			data.code = $('#code').val().trim();
			data.district_id = $('#district_id').val().trim();
			var url = conf.addBlock.url;
	    	var method = conf.addBlock.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
		        	$('#formID')[0].reset();
		            TRIFED.showMessage('success', 'Successfully Added');
		            setTimeout(function() {document.location = "block-master.php";}, 500);
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

editBlock = () => {
	
	$(document).on('click','.data-edit',function(e){
		e.preventDefault();
		var id = '';
		id = $(this).parents('tr').attr('id');
		var url = conf.getBlockWithStateData.url + id;
		var method = conf.getBlockWithStateData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				 console.log(response.data);
				addressData = response.data;
				fillBlockData(addressData);
                fetchUpdatedStatesList(response.data.district_data.state_id);
                fetchUpdatedDistrictList(response.data.district_data.state_id,response.data.district_id);
                // console.log(response.data);
				// fetchUpdatedDistrictList(response.data.state_id);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
	});
}
	

fillBlockData = (data) =>{
	console.log(data);
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
			data.district_id = $('#updatedistrict_id').val().trim();            
			var url = conf.updateBlockData.url + id;
	    	var method = conf.updateBlockData.method;

			TRIFED.asyncAjaxHit(url, method, data, function (response) {
		        if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Updated');
					setTimeout(function() {document.location = "block-master.php";}, 500);
		        } else {
		            TRIFED.showError('error', response.message);
		        }
	    	});
		} else {
			TRIFED.showError('error', 'Please enter title');
		}
	})
}


$('#state_id').on('change',function(e){
    e.preventDefault();
    var state_id = $('#state_id').val().trim();
    var url = conf.getDistrictData.url+'?state_id=' + state_id;
    // console.log(url);
    var method = conf.getDistrictData.method;
    TRIFED.asyncAjaxHit(url, method, {}, function (response) {
        if (response.status == 1) {
            // $('#district_id').html(response.data);
            populateDistrictList(response.data);
        } else {
            TRIFED.showError('error', response.message);
        }
    });
});

$('#stateMasterHaat').on('change',function(e){
    e.preventDefault();
    var state_id = $('#stateMasterHaat').val().trim();
    var url = conf.getDistrictData.url+'?state_id=' + state_id;
    // console.log(url);
    var method = conf.getDistrictData.method;
    TRIFED.asyncAjaxHit(url, method, {}, function (response) {
        if (response.status == 1) {
            // $('#district_id').html(response.data);
            populateDistrictList(response.data);
        } else {
            TRIFED.showError('error', response.message);
        }
    });
});


$('#updatestate_id').on('change',function(e){
    e.preventDefault();
    var state_id = $('#updatestate_id').val().trim();
    var url = conf.getDistrictData.url+'?state_id=' + state_id;
    // console.log(url);
    var method = conf.getDistrictData.method;
    TRIFED.asyncAjaxHit(url, method, {}, function (response) {
        if (response.status == 1) {
            // $('#district_id').html(response.data);
            populateUpdatedNewDistrictList(response.data);
        } else {
            TRIFED.showError('error', response.message);
        }
    });
});

populateDistrictList = (data) => {
	var html = "";
	html += '<option value="" >Select</option>';
	$.each(data, function(i, data){ 
		html += '<option value="' + data.id + '" >' + data.title + '</option>';
	});
	$('#district_id').html(html);
	$('#districtMasterHaat').html(html);
}

populateUpdatedNewDistrictList = (data) => {
	var html = "";
	html += '<option value="" >Select</option>';
	$.each(data, function(i, data){ 
		html += '<option value="' + data.id + '" >' + data.title + '</option>';
	});
	$('#updatedistrict_id').html(html);
}

var searchEvent = () => {
	$('#search').on('click', function () {
		filterdata();
	})
}
	utils.addPerPageListing(fetchBlockList);
function filterdata(){
	 
	fetchBlockList();
}


$(document).ready(function() {
      $('#block-table').DataTable({
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
                title: 'Block Master List',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
          ], 
      });
    });