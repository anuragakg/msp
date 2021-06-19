var paginatedFilter = {};

$(function () {
	var url_var = getUrlVars();
	var state_val = url_var['state'];

	utils.getStateMaster(function (res) {
		utils.renderOptionElements("#stateMaster", res.data);
		utils.renderOptionElements("#stateMasterHaat", res.data);
	});
	if (state_val != null && state_val != undefined) {
		$('#stateMasterHaat').val(state_val).trigger('change');
	}
	var state = $('#stateMasterHaat').val();
	var district = $('#districtList').val();
	var block = $('#blocksList').val();

	var data = {
		'state': isNaN(state) ? null : state,
		'district': isNaN(district) ? null : district,
		'block': isNaN(block) ? null : block,
	};
	getHaatBazarList(data);
	//getHaatBazarList();
	searchEvent();
	filterHideEvent();

	utils.addPerPageListing(getHaatBazarList, paginatedFilter);
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
    getHaatBazarList(data);
});


var editHaatBazaar = TRIFED.checkPermissions("haat_bazaar_management_edit");
var viewHaatBazaar = TRIFED.checkPermissions("haat_bazaar_management_view");
var statusHaatBazaar = TRIFED.checkPermissions("haat_bazaar_management_status");

function getUrlVars() {
	var vars = [],
		hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for (var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}
/**
 * Hits api and get the necessary records.
 * @param {String} type Type of the list it needs to get
 */
function getHaatBazarList(query = {}) {
	const url = conf.getHaatBazar.url;
	const method = conf.getHaatBazar.method;
	const data = query;
	data.OrderBy=$('#OrderBy').val();					
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		// if (response) {
		//   renderList('#haat-bazar-list', response.data);
		//   TRIFED.showPermissions();
		// }

		if (response.status) {

			if (response.data.records.length) {
				renderList('#haat-bazar-list', response.data);
				return TRIFED.showPermissions();
			}

			$('#haat-bazar-list').html("<tr><td colspan='10' class='text-center'>No Data Found !!</td></tr>");
		}

	});
}

/**
 * Renders the mo list.
 * @param {Number|String} id 
 * @param {Array} records Array of records.
 * @param {String} type Type of list to render.
 */

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

function renderList(id, records) {
	const el = $('tbody' + id);
	el.html('');
	utils.renderSimplePagination(records, "#pagination", getHaatBazarList);
	utils.renderSimplePagination(records, "#pagination-top", getHaatBazarList);
	var perPage = parseInt(records.per_page);
  	var currentPage = parseInt(records.current_page);
	var i = (currentPage - 1) * perPage + 1;
	records.records.forEach(element => {
		const row = $('<tr>');

const downloadOptions = {
      type: "checkbox",
      name: "select_ids[]",
      class: "select_ids"
    };
 const checkboxdownload = $("<input>")
      .attr(downloadOptions)
      .val(element.id);
          row.append($("<td>").html(checkboxdownload));
		row.append($('<td>').text(i));
		row.append($('<td>').text(element.rpm_name));
		row.append($('<td>').text(element.address));
		row.append($('<td>').text(element.state_name));
		row.append($('<td>').text(element.district_name));
		row.append($('<td>').text(element.block_name));
		row.append($('<td>').text(element.village_name));
		row.append($('<td>').html('<a href="javascript:void(0)" onclick="getlinkageHaatBazaar('+element.id+')">'+element.linkageHaatBazaar+'</a>'));
		row.append($('<td>').text(element.surveyor));
		const $td = $('<td>').addClass('action-area');
		if (editHaatBazaar) {
			var action = '../survey-forms/haat-bazar-survey-form.php';
			var editLink = generateEditButton(action + '?id=' + element.id);
			$td.append(editLink);
		}
		if (viewHaatBazaar) {
			var action2 = '../survey-forms/haat-bazar-survey-view.php';
			var viewLink = generateViewButton(action2 + '?id=' + element.id);
			$td.append(viewLink);
		}
		if (statusHaatBazaar) {
			var deleteLink = generateDeleteButton(element.id);
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


function generateEditButton(href) {
	return $('<a>')
		.attr({
			'data-toggle': 'tooltip',
			'data-placement': 'top',
			'title': 'View',
			'data-original-title': 'Edit',
			'class': 'data-view',
			'href': href
		})
		.html($('<i>').addClass('fa fa-edit'));
}

function generateViewButton(href) {
	return $('<a>')
		.attr({
			'data-toggle': 'tooltip',
			'data-placement': 'top',
			'title': 'View',
			'data-original-title': 'View',
			'class': 'data-view',
			'href': href
		})
		.html($('<i>').addClass('fa fa-eye'));
}

function generateDeleteButton(id) {
	return $('<a>')
		.attr({
			'data-toggle': 'tooltip',
			'data-placement': 'top',
		'title' : 'Delete',
		'data-original-title': 'Delete',
			'class': 'data-view delete_shg_gatherers',
			'id': id
		})
		.html($('<i>').addClass('fa fa-trash'));
}

$(document).ready(function () {
	$(document).on('click',".delete_shg_gatherers",function () {
		var id = this.id;
		if (!confirm('Are you sure you want to delete.')) {
			return;
		}

		var url = conf.deleteHaatBazarData.url + id;
		//alert(url);
		var method = conf.deleteHaatBazarData.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response.status) {
				if (response.status) {
					setTimeout(function () {
						location.reload();
					}, 1000); //Refresh page
					return TRIFED.showMessage("success", "Haat Market successfully Removed");
					//return TRIFED.showMessage('success', response.data.message);
				}
				return TRIFED.showWarning('info', response.data.message);
			}
			TRIFED.showError('error', response.message);
		});
	});

	$("#OrderBy").click(function(){
  id=$(this).attr("data-order");
  if(id=='ASC')
  { 
    $('#OrderBy').attr( 'data-order','DESC');
    var state = $('#stateMasterHaat').val();
	var district = $('#districtList').val();
	var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
	var data = {
		'state': isNaN(state) ? null : state,
		'district': isNaN(district) ? null : district,
		'block': isNaN(block) ? null : block,
		'q': q,
		'OrderBy': id,
	};
	getHaatBazarList(data);

  }else{ 
    $('#OrderBy').attr( 'data-order','ASC');
    var state = $('#stateMasterHaat').val();
	var district = $('#districtList').val();
	var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
	var data = {
		'state': isNaN(state) ? null : state,
		'district': isNaN(district) ? null : district,
		'block': isNaN(block) ? null : block,
		'q': q,
		'OrderBy': id,
	};
	getHaatBazarList(data);
  }
});
});


function getlinkageHaatBazaar(id){
	$('#vdvk_data').empty();
	var url = conf.getlinkageHaatBazaar.url + id;
	//alert(url);
	var method = conf.getlinkageHaatBazaar.method;
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
// utils.getDistricts(1, function(records) {
//   utils.renderOptionElements("#districtList", records.data);
// });

// $("#districtList").on("change", function() {
//   utils.getBlocks(this.value, function(records) {
//     utils.renderOptionElements("#blocksList", records.data);
//   });
// });

$("#stateMasterHaat").on("change", function () {
	utils.getDistricts(this.value, function (records) {
		utils.renderOptionElements("#districtList", records.data);
	});
});

$("#districtList").on("change", function () {
	utils.getBlocks(this.value, function (records) {
		utils.renderOptionElements("#blocksList", records.data);
	});
});


var searchEvent = () => {
	$('#search').on('click', function () {
		filterdata();
	})
}
function filterdata(){
	var state = $('#stateMasterHaat').val();
	var district = $('#districtList').val();
	var block = $('#blocksList').val();
	var q = $('#queryTerm').val();

	var data = {
		'state': isNaN(state) ? null : state,
		'district': isNaN(district) ? null : district,
		'block': isNaN(block) ? null : block,
		'q': q,
	};
	paginatedFilter = data;
	getHaatBazarList(data);
}
// $("#filterRecords").on("submit", function(e) {
//   e.preventDefault();
//   const data = $(this).serialize();
//   getHaatBazarList(data);
// });


function importExcelFile() {
	$("#importExcel").on("click", function (e) {
		e.preventDefault();
		var url = conf.importHaatBazaarExcel.url;
		var method = conf.importHaatBazaarExcel.method;
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

		TRIFED.fileAjaxHit(url, method, data, function (r) {
			if (r.status == 1) {
				TRIFED.showMessage("success", "Successfully Added");
				setTimeout(function () {
					location.reload();
				}, 500);
			} else {
				$('#file_errors').html(r.message).css('color', 'red');
				$(".fa-spinner").hide();
				TRIFED.showError('error', r.message);
			}
		});
	});
}

filterHideEvent = () => {
	var authUser = TRIFED.getLocalStorageItem();

	if (authUser && authUser.role === 7) {
		/*SIO*/
		$("#stateMasterHaat").val(authUser.state_id).trigger('change');
		$("#stateMasterHaat").prop("disabled", true);
	}

	if (authUser && authUser.role === 13) {
		/*DIO*/
		$("#stateMasterHaat").val(authUser.state_id).trigger('change');
		$("#stateMasterHaat").prop("disabled", true);

		$("#districtList").val(authUser.district_id).trigger('change');
		$("#districtList").prop("disabled", true);
	}
}

$('#exportExcel').on('click', function (e) {
	e.preventDefault();
	var url = conf.exportHaatMarketData.url;
	var method = conf.exportHaatMarketData.method;
	var myCheckboxes = new Array();
        $('.select_ids:checked').each(function() {
          if ($(this).val()!='') {
           myCheckboxes.push($(this).val());
         }
        });
       // alert(myCheckboxes); return false;
if(myCheckboxes !=''){
	 var data = {'myCheckboxes':myCheckboxes};
	downloadFile(url, method,data);
}
else
{
	 alert('Please Select Haat Bazaar List');
}
});

// $('#exportMasterExcel').on('click', function (e) {
// 	e.preventDefault();
// 	var url = conf.exportHaatMasterData.url;
// 	var method = conf.exportHaatMasterData.method;
// 	downloadFile(url,method);
// });

function downloadFile(url, method, data) {
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		window.location.href = endpoint + '' + response.data.file;
	});
}

function searchItems() {
  let term = $("#queryTerm").val();
  paginatedFilter.q = term;
  getShgGatherersList();
}