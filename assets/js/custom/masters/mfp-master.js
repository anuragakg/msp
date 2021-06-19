var auth = TRIFED.getLocalStorageItem();
var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(document).ready(function () {
	fetchState();
	var oTable = $('#mfp-list').DataTable({
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
				title: 'MFP Master List',
				exportOptions: {
					columns: [0, 1, 2,3,4,5]
				}
			},
			

			
		  ],
            "ajax":{
                     "url": conf.getMfp.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				         d.state_id=$('#state_id').val();
				         d.mfp_id=$('#mfp_id').val();
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
						        var PageInfo = $('#mfp-list').DataTable().page.info();
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
						       return row.mfp_name;
						    }
						},
						{ "data": "botanical_name" },
						{ "data": "local_name" },
						{ "data": "msp_price" },
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
						       if(row.image!='' && row.image!=null)
						        {
						        	return '<a target="_blank" href="'+row.image+'">View Document</a>';
						        	
						        }else{
						        	return 'No image';
						        }
						    }
						},
						
						{ 
							"render": function(data, type, row) {
								var html='';
						       if(editMaster)
						        {
						        	html += '<a href="../masters/mfp-add.php?id='+row.id+'"><i class="fa fa-edit" title="Edit"></i></a>';
						        }
						        if(viewMaster)
						        {
						        	html += ' | <a href="../masters/mfp-view.php?id='+row.id+'"><i class="fa fa-eye" title="View Detail"></i></a>';		
						        }
						        if(statusMaster){
									html += (row.status == 1) ? ' | <a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : ' | <a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
								}
						        return html;
						    }
						},
					]

      });

	$('#state_id,#mfp_id').on('change',function () {
		oTable.ajax.reload();
	});
	$('#state_id').on('change', function (ev) {
		const v = $(this).val();
		fetchMfp(v);
		
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
$('#state_id').on('change', function (ev) {
	const v = $(this).val();
	fetchMfp(v);
});
fetchMfp = (state_id = 0) => {
	var url = conf.getCommodityStateWiseList.url;
	var method = conf.getCommodityStateWiseList.method;
	var data = {
		state_id : state_id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		
		if (response) {
			fillMfp(response.data);
		}
	});
}

fillMfp = (mpf_data) => {
	html = '<option value="">Select MFP</option>';
	$.each(mpf_data, function(i, mpf) {
		html += '<option value="'+mpf.id+'">'+mpf.title+'</option>';
	});
	$('#mfp_id').html(html);
}

changeActiveStatus = (id) => {

	if(confirm('Are you sure you want to change the status?')){

		const _t = $(this);

		var url = conf.changeMfpMasterStatus.url(id);
	    var method = conf.changeMfpMasterStatus.method;
	    var data = {};
	    data.user_id = id;
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {

			if (response.status) {
				if (response.data.status) {
					//_t.attr('class', 'data-active');
					TRIFED.showMessage('success', 'Account '+response.data.message);
					setTimeout(function () {location.reload()}, 500);

					

				}else{
					_t.attr('class', 'data-inactive');
					TRIFED.showWarning('info', 'Account '+response.data.message);
					setTimeout(function () {location.reload()}, 500);
					return;	
				}
				
			}else{
				TRIFED.showError('error', response.message);	

			}
		});
	}
}
