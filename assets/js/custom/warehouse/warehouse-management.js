var paginatedFilter = {};
$(function () {  
  var url_var=getUrlVars(); 
  var state_val=url_var['state'];

  
  
  
  utils.getStateMaster(function(res) {
    utils.renderOptionElements("#stateMaster", res.data);
    utils.renderOptionElements("#stateMasterWarehouse", res.data);
    });
  if(state_val!=null && state_val!=undefined)
  {
    $('#stateMasterWarehouse').val(state_val).trigger('change')
  }
    var state = $('#stateMasterWarehouse').val();
    var district = $('#districtList').val();
    var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
      var OrderBy = $('#OrderBy').val();
    var data = {
      'state'   : isNaN(state) ? null : state,
      'district'   : isNaN(district) ? null : district,
      'block'   : isNaN(block) ? null : block,
      'q': q,
    };

  fetchWareHouseList(data);
  
  searchEvent();
  filterHideEvent();
    utils.addPerPageListing(fetchWareHouseList, paginatedFilter);
});


$("#OrderBy").on('change',function(){
  var state = $('#stateMasterWarehouse').val();
    var district = $('#districtList').val();
    var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
  var OrderBy = $('#OrderBy').val();
  var data = {
      state: isNaN(state) ? null : state,
      district: isNaN(district) ? null : district,
      block: isNaN(block) ? null : block,
      'q': q,
     // 'OrderBy': OrderBy,
    };
    fetchWareHouseList(data);
});

var editWarehouse = TRIFED.checkPermissions("warehouse_management_edit");
var viewWarehouse = TRIFED.checkPermissions("warehouse_management_view");
var statusWarehouse = TRIFED.checkPermissions("warehouse_management_status");
/**
 * Fetches warehouse list
 */
 function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
function fetchWareHouseList(query = {}) {
  const url = conf.getWarehousesWebList.url;
  const method = conf.getWarehousesWebList.method;
  const data = query;
  var state = $('#stateMasterWarehouse').val();
    var district = $('#districtList').val();
    var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
    var per_page = $('#pagination-amount').val();
   
  var url_var=getUrlVars(); 
  var status_val=url_var['status'];
  if(status_val!=null && status_val!=undefined)
  {
    data.status = status_val;
  }
  data.state=isNaN(state) ? null : state;
  data.district=isNaN(district) ? null : district;
  data.block=isNaN(block) ? null : block;
  data.q=q;
  data.OrderBy=$('#OrderBy').val();
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response.status) {
      if (response.data.records.length) {
          renderWarehouseList("#userLists", response.data);
           return TRIFED.showPermissions();
      }else{
        $('#pagination').html('');
        return $('#userLists').html("<tr><td colspan='10' class='text-center'>No Data Found !!</td></tr>");
      }
      
    }

  });
}


 function check_download(isChecked) {
  if(isChecked) {
    $('.select_ids').each(function() { 
      //this.checked = true;
      if (!this.disabled) 
      this.checked = true; 
    });
  } else {
    $('.select_ids').each(function() {
      this.checked = false;
    });
  }
}


function renderWarehouseList(id, records) {
  const el = $("tbody" + id);
  el.html("");
  utils.renderSimplePagination(records, "#pagination", fetchWareHouseList);
  utils.renderSimplePagination(records, "#pagination-top", fetchWareHouseList);
  var perPage = parseInt(records.per_page);
  var currentPage = parseInt(records.current_page);
  var i = (currentPage - 1) * perPage + 1;
 
  records.records.forEach(element => {
    const row = $("<tr>");
    
    const downloadOptions = {
      type: "checkbox",
      name: "select_ids[]",
      class: "select_ids"
    };
    const checkboxdownload = $("<input>")
      .attr(downloadOptions)
      .val(element.id);

    row.append($("<td>").html(checkboxdownload));
    row.append($("<td>").text(i));
    row.append($("<td>").text(element.name));
    row.append($("<td>").text(element.address));
    row.append($("<td>").text(element.state_name));
    row.append($("<td>").text(element.district_name));
    row.append($("<td>").text(element.block_name));
    row.append($("<td>").text(element.village_name));
    row.append($("<td>").html('<a href="javascript:void(0)" onclick="getLinkage('+element.id+')">'+element.linkageWarehouse+'</a>'));
    row.append($("<td>").text(element.surveyor));
    const $td = $('<td>').addClass('action-area');
    if(editWarehouse){
      var action = '../survey-forms/warehouse-survey-form.php';
      var editLink = generateEditButton(action + '?id=' + element.id);
      $td.append(editLink);
    }
    if(viewWarehouse){
      var action2 = '../survey-forms/warehouse-survey-view.php';
      var viewLink = generateViewButton(action2 + '?id=' + element.id);
      $td.append(viewLink);
    }
    if(statusWarehouse){
      var deleteLink = generateDeleteButton( element.id);
      $td.append(deleteLink);
    }
    row.append($td);

    el.append(row);
    i++;
  });
  if (records == '') {
    const row = $('<tr>');
    row.append($('<td colspan="10" class="dataTables_empty" valign="top">').text('No data found'));
    el.append(row);
  }
}
function getLinkage(id){
  $('#vdvk_data').empty();
  var url = conf.getlinkageWarehouse.url + id;
  //alert(url);
  var method = conf.getlinkageWarehouse.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    if (response.status) {
      if (response.status) {
        var tr='';
        var sr_no=0;
        $.each(response.data,function(i,v){
          ++sr_no;
          tr +='<tr>';
          tr +='<td>'+sr_no+'</td>';
          tr +='<td>'+v.kendra_name+'</td>';
          tr +='</tr>';
        });

        if(tr!=''){
          $('#vdvk_data').append(tr);
          $('#linkage_data').modal('show');
        }
      }
      
    }
    
  });
}

function generateEditButton (href) {
  return $('<a>')
  .attr({
    'data-toggle' : 'tooltip',
    'data-placement': 'top',
    'title' : 'View',
    'data-original-title': 'Edit',
    'class' : 'data-view',
    'href' : href
  })
  .html($('<i>').addClass('fa fa-edit'));
}

function generateViewButton (href) {
	return $('<a>')
	.attr({
		'data-toggle' : 'tooltip',
		'data-placement': 'top',
		'title' : 'View',
		'data-original-title': 'View',
		'class' : 'data-view',
		'href' : href
	})
  .html($('<i>').addClass('fa fa-eye'));
}

function generateDeleteButton (id) {
	return $('<a>')
	.attr({
		'data-toggle' : 'tooltip',
		'data-placement': 'top',
		'title' : 'Delete',
		'data-original-title': 'Delete',
		'class' : 'data-view delete_shg_gatherers',
		'id' : id
	})
	.html($('<i>').addClass('fa fa-trash'));
}

$(document).ready(function(){
	$(".delete_shg_gatherers").click(function(){
		var id = this.id;
		if (!confirm('Are you sure you want to delete.')) {
			return;
		}

        var url = conf.deleteWarehouseData.url + id;
        //alert(url);
        var method = conf.deleteWarehouseData.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
          if (response.status) {
            if (response.status) {
              setTimeout(function(){ location.reload(); }, 1000);  //Refresh page
              return TRIFED.showMessage("success", "Ware House successfully Removed");
              //return TRIFED.showMessage('success', response.data.message);
            }
            return TRIFED.showWarning('info', response.data.message);
          }
          TRIFED.showError('error', response.message);
        });
   	});

  });

// utils.getDistricts(1, function(records) {
//   utils.renderOptionElements("#districtList", records.data);
// });

$("#stateMasterWarehouse").on("change", function() {
  $("#blocksList").val('');
  utils.getDistricts(this.value, function(records) {
    utils.renderOptionElements("#districtList", records.data);
    });
});

$("#districtList").on("change", function() {
  utils.getBlocks(this.value, function(records) {
    utils.renderOptionElements("#blocksList", records.data);
  });
});

// $("#districtList").on("change", function() {
//   utils.getBlocks(this.value, function(records) {
//     utils.renderOptionElements("#blocksList", records.data);
//   });
// });

// $("#filterRecords").on("submit", function(e) {
//   e.preventDefault();
//   const data = $(this).serialize();
//   fetchWareHouseList(data);
// });

  $("#importExcel").on("click", function(e) {
	  $('#file_errors').html('');
    e.preventDefault();
    var url = conf.importWarehouseExcel.url;
    var method = conf.importWarehouseExcel.method;
    const state = $("#stateMaster").val();
    var file = $("#import_file").prop("files")[0];
    var data = new FormData();
    if (isNaN(state) == false && state.length) {
      data.append("state", state);
    } else {
      alert("Please select State.");
      return;
    }
    data.append("import_file", file, file.name);

    TRIFED.fileAjaxHit(url, method, data, function(response) {
		if (response.status == 1) {
			      TRIFED.showMessage("success", "Successfully Added");
				  setTimeout(function() {
					location.reload();
				  }, 500);
		}else{
      $('#file_errors').html(response.message).css('color','red');
      $(".fa-spinner").hide();
			TRIFED.showError('error', response.message);	
		}
    });
  });

  var searchEvent = () => {
  $('#search').on('click',function(){
    filterdata();
    
  })
}

function filterdata(){
  var state = $('#stateMasterWarehouse').val();
    var district = $('#districtList').val();
    var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
    var data = {
      'state'   : isNaN(state) ? null : state,
      'district'   : isNaN(district) ? null : district,
      'block'   : isNaN(block) ? null : block,
      'q': q,
    };

    fetchWareHouseList(data);
}

filterHideEvent = () => {

  var authUser = TRIFED.getLocalStorageItem();

  if(authUser && authUser.role === 7){ /*SIO*/
    $("#stateMasterWarehouse").val(authUser.state_id).trigger('change');
    $("#stateMasterWarehouse").prop("disabled", true);
  }

  if(authUser && authUser.role === 13){ /*DIO*/
    $("#stateMasterWarehouse").val(authUser.state_id).trigger('change');
    $("#stateMasterWarehouse").prop("disabled", true);

    $("#districtList").val(authUser.district_id).trigger('change');
    $("#districtList").prop("disabled", true);
  }

}

$('#exportExcel').on('click', function (e) {
	e.preventDefault();
	var url = conf.exportWarehouseData.url;
	var method = conf.exportWarehouseData.method;
  var myCheckboxes = new Array();
        $('.select_ids:checked').each(function() {
          if ($(this).val()!='') {
           myCheckboxes.push($(this).val());
         }
        });
    if(myCheckboxes !=''){
    	var data = {'myCheckboxes':myCheckboxes};
      downloadFile(url, method,data);
    }
    else{
      alert('Please Select Warehouse List');
    }
	//TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
		//window.location.href = endpoint+''+response.data.file;
	//});	
});
$('#download-sop').on('click',function(){
    const url = conf.downloadWarehousesSop.url;
    const method = conf.downloadWarehousesSop.method;
    const data = [];
    
    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {

          

    });
});
function downloadFile(url, method, data) {
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    window.location.href = endpoint + '' + response.data.file;
  });
}
