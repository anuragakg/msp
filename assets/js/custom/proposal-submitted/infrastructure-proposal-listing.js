var auth = TRIFED.getLocalStorageItem();
var editInfra = TRIFED.checkPermissions("infrastructure_development_edit");
var viewInfra = TRIFED.checkPermissions("infrastructure_development_view");
var addInfra = TRIFED.checkPermissions("infrastructure_development_add");
var statusInfra = TRIFED.checkPermissions("infrastructure_development_status");
var approval_management_consolidate_proposals = TRIFED.checkPermissions("approval_management_consolidate_proposals");

$(document).ready(function () {  
	 fetchStatesList();
	var oTable = $('#list').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [[0, "DESC"]],
		"dom": 'lBfrtip',
		oLanguage: { 
			sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"buttons": [
			{
				extend: 'excel',
				text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
				titleAttr: 'EXCEL',
				title: ' Infrastructure Development List',
				exportOptions: {
					columns: [0, 1, 2,3,4,5,6,7],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
				}
			},
		  ],
            "ajax":{
                     "url": conf.InfrastructureProposalSubmittedListing.url,
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
				         d.block_id=$('#block_id').val();
				         d.status=$('#status').val(); 
				         
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
						        var PageInfo = $('#list').DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						        
						    }
						},
		                { 
		                	"render": function(data, type, row) {
						       return row.proposal_id;
						    }
		                }, 
		                 { 
		                	"render": function(data, type, row) {
						      return row.summary[0].estimated_requirement_funds;
						    }
		                }, 
		                 { 
		                	"render": function(data, type, row) {
						       return row.summary[0].total_warehouse_facilities;
						    }
		                }, 
		                 { 
		                	"render": function(data, type, row) {
						       return '';
						    }
		                }, 
		                 { 
		                	"render": function(data, type, row) {
						       return row.summary[0].total_fund_require;
						    }
		                },
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.created_at
						       
						    }
						},
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.added_by
						       
						    }
						}, 
		                 { 
		                	"render": function(data, type, row) {
						       return row.submission_status_text;
						    }
		                }, 
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.state
						       
						    }
						},
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.district
						       
						    }
						}, 
						{ 
							"render": function(data, type, row) {
								var html=''; 
						       
						        if(viewInfra)
						        {
						        	html += ' <a href="../proposal-submitted/view-infra-proposal_detail.php?id='+row.ref_id+'" class="data-edit"><i class="fa fa-eye" title="View Detail"></i></a>';		
						        }
						       	return html;
						    }
						},
						
					]

      });

		$('#state_id,#district_id,#block_id,#status').on('change',function () {
		oTable.ajax.reload();
	});
	
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
populateStateList = (data) => {
	var html = "";
	html += '<option value="" >Select</option>';
	$.each(data, function(i, data){ 
		html += '<option value="' + data.id + '" >' + data.title + '</option>';
	});
	$('#state_id').html(html); 
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
populateDistrictList = (data) => {
	var html = "";
	html += '<option value="" >Select</option>';
	$.each(data, function(i, data){ 
		html += '<option value="' + data.id + '" >' + data.title + '</option>';
	});
	$('#district_id').html(html); 
}
$('#district_id').on('change',function(e){
    e.preventDefault();
    var state_id = $('#district_id').val().trim();
    var url = conf.getBlockData.url+'?district_id=' + state_id;
    // console.log(url);
    var method = conf.getBlockData.method;
    TRIFED.asyncAjaxHit(url, method, {}, function (response) {
        if (response.status == 1) {
            // $('#district_id').html(response.data);
            populateBlockList(response.data);
        } else {
            TRIFED.showError('error', response.message);
        }
    });
});
populateBlockList = (data) => {
	var html = "";
	html += '<option value="" >Select</option>';
	$.each(data, function(i, data){ 
		html += '<option value="' + data.id + '" >' + data.title + '</option>';
	});
	$('#block_id').html(html); 
} 

