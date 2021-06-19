var auth = TRIFED.getLocalStorageItem();
var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(document).ready(function () {
	fetchState();
	var oTable = $('#warehouse-list').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [[0, "DESC"]],
		"dom": 'lBfrtip',
		oLanguage: {
			//sProcessing: "<div class='listing-loader'></div>"
			sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"buttons": [
			{
				extend: 'excel',
				text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
				titleAttr: 'EXCEL',
				title: 'Warehouse Master List',
				exportOptions: {
					columns: [0, 1, 2,3,4,5,6,7]
				}
			},
		  ],
            "ajax":{
                     "url": conf.getWarehouse.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				         d.state_id=$('#state_id').val();
				         d.district_id=$('#district_id').val();
				         d.warehouse=$('#warehouse').val();
				         d.corresponding_hats=$('#corresponding_hats').val();
				         d.blocks=$('#blocks').val();
				    },
		            "dataSrc": function(json) {
		            		json.draw = json.data.draw;
							json.recordsTotal = json.data.recordsTotal;
							json.recordsFiltered = json.data.recordsFiltered;			
	       					return json.data.data;
	       						
	    			}
                   },
		            "columns": [
		                { 
		                	"render": function(data, type, full, meta) {
						        var PageInfo = $('#warehouse-list').DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						        
						    }
						},
		                { 
		                	"render": function(data, type, row) {
						       return row.state;
						    }
		                },
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
						       return row.district_name;
						    }
						},
						{ "data": "warehouse_name" },
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.WarehouseBlocksDetails.map(v => v.block_name).join(",")
						       
						    }
						},
						{ "data": "corresponding_hats_name" },
						{ "data": "storage_type" },
						{ "data": "storage_capacity" },
						
			            {
			                "orderable": false,
			                "render": function(data, type, row) {
			                        if(row.status==1)
			                        {
			                            var status='Active';
			                        }else{
			                            var status='In-Active';
			                        }
			                         
			                            subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
			                            return subHtml
			                       
			                }
			            },

						
						{ 
							"render": function(data, type, row) {
								var html='';
						       if(editMaster)
						        {
						        	html += '<a href="../masters/warehouse-add.php?id='+row.id+'" class="data-edit"><i class="fa fa-edit" title="Edit"></i></a>';
						        }
						        if(viewMaster)
						        {
						        	html += ' | <a href="../masters/warehouse-view.php?id='+row.id+'" class="data-edit"><i class="fa fa-eye" title="View Detail"></i></a>';		
						        }
						       /* if(statusMaster){
									html += (row.status == 1) ? ' | <a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : ' | <a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
								}*/
						        return html;
						    }
						},
					]

      });

	$('#state_id,#district_id,#warehouse,#blocks,#corresponding_hats').on('change',function () {
		oTable.ajax.reload();
	});
	
});

fetchState = () => {
	var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillStates(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states) => {
	html = '<option value="">Select State</option>';
	$.each(states, function(i, state) {
		html += '<option value="'+state.id+'">'+state.title+'</option>';
	});
	$('#state_id').html(html);
}
$(document).on('change','#state_id', function (ev) {

	const v = $(this).val();
	var item_id = $(this).attr('state_id');
	fetchDistrict(v,item_id);
});

fetchDistrict = (id = 0) => {
	var url = conf.getDistricts.url;
	var method = conf.getDistricts.method;
	var data = {
		state_id : id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillDistrict(response.data);
		}
	});
}

fillDistrict = (districts) => {
	html = '<option value="">Select District</option>';
	$.each(districts, function(i, district) {
		html += '<option value="'+district.id+'">'+district.title+'</option>';
	});
	$('#district_id').html(html);
}

$(document).on('change','#district_id', function (ev) {
	const v = $(this).val();
	
	fetchWarehouseHaatmarketBlock(v);
});

fetchWarehouseHaatmarketBlock = (id = 0,item_id=0) => {
	var url = conf.getWarehouseHaatmarket.url;
	var method = conf.getWarehouseHaatmarket.method;
	var data = {
		district_id : id,
		state_id : $('#state_id').val()
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
	
		if (response) {
			fillHaatmarket(response.data.haat_data);
			fillWarehouse(response.data.warehouse_data);
			fillBlocklist(response.data.block_data);
		}
	});
}

fillWarehouse = (haats) => {
	
	html = '<option value="">Select Warehouse</option>';
	
	haats.forEach(function(row){
		html += '<option value="'+row.id+'">'+row.get_part_one.name+'</option>';
	});
	$('#warehouse').html(html);
}
fillHaatmarket = (haats) => {
	
	html = '<option value="">Select Warehouse</option>';
	
	haats.forEach(function(row){
		html += '<option value="'+row.id+'">'+row.get_part_one.rpm_name+'</option>';
	});
	$('#corresponding_hats').html(html);
}
fillBlocklist = (blocks) => {
	html = '<option value="">Select Block</option>';
	$.each(blocks, function(i, block) {
		html += '<option value="'+block.id+'">'+block.title+'</option>';
	});
	$('#blocks').html(html);
}

changeActiveStatus = (id) => {

	if(confirm('Are you sure you want to change the status?')){

		const _t = $(this);

		var url = conf.changeWarehouseMasterStatus.url(id);
	    var method = conf.changeWarehouseMasterStatus.method;
	    var data = {};
	    data.user_id = id;
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response.status) {
				if (response.data.status) {
					//_t.attr('class', 'data-active');
					TRIFED.showMessage('success', response.data.message);
					setTimeout(function () {location.reload()}, 500);

					

				}else{
					_t.attr('class', 'data-inactive');
					TRIFED.showWarning('info', response.data.message);
					setTimeout(function () {location.reload()}, 500);
					return;	
				}
				
			}else{
				TRIFED.showError('error', response.message);	
			}
			//
		});
	}
}
