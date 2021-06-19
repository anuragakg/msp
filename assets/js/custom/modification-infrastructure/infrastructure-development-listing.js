var auth = TRIFED.getLocalStorageItem();
var editInfra = TRIFED.checkPermissions("infrastructure_development_edit");
var viewInfra = TRIFED.checkPermissions("infrastructure_development_view");
var addInfra = TRIFED.checkPermissions("infrastructure_development_add");
var statusInfra = TRIFED.checkPermissions("infrastructure_development_status");

$(document).ready(function () { 

	fetchState();
	fetchFinancialYear();
	var oTable = $('#list').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [[0, "DESC"]],
		"dom": 'lBfrtip',
		bFilter: false,
		 bInfo: false,
		oLanguage: { 
			sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"buttons": [
			{
				extend: 'excel',
				text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
				titleAttr: 'EXCEL',
				title: 'Infrastructure Development List',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9],					
					format: {
                     body: function (data, row, column, node ) {
                              return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
		                }
		            },
				}
			},
		  ],
            "ajax":{
                     "url": conf.InfrastructuredevelopmentListing.url,
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
						 d.year_id=$('#year_id').val();
						 d.status=$('#status').val();
				         d.proposal_id=$('#proposal_id').val();
				         
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
						       return row.financialYear;
						    }
		                }, 
		                { 
		                	"render": function(data, type, row) {
						       return row.state;
						    }
		                }, 
		                { 
		                	"render": function(data, type, row) {
						       return row.district;
						    }
		                }, 
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.status_text+'<br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+row.id+')")"></i></span>';
						       
						       
						    }
						},
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.added_by
						       
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
		                		return row.submission_status_text
						       
						    }
						},
						{ 
							"orderable": false,
		                	"render": function(data, type, row) { 
		                		return row.progress+'% <br><a href="../fund-management/infrastructure_progress_list.php?proposal_id='+row.proposal_id+'"><i class="fa fa-line-chart"></i></a>';
						    }
						},
						{ 
							"render": function(data, type, row) {
								var html='';
								if(row.submission_status==0)
								{
									if(editInfra)
							        {
							        	html += '<a href="../modification-infrastructure/step1.php?id='+row.ref_id+'" class="data-edit"><i class="fa fa-edit" title="Edit"></i></a> | ';
							        }	
								}
						       
						        if(viewInfra)
						        {
						        	html += '<a href="../modification-infrastructure/view-infrastructure.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'" class="data-edit"><i class="fa fa-eye" title="View Detail"></i></a>';		
						        }
						       	return html;
						    }
						},
						
					]

      });

	$('#state_id,#district_id,#year_id,#submission_status,#status').on('change',function () {
		oTable.ajax.reload();
	});
	$('#proposal_id').on('keyup',function () {
		oTable.ajax.reload();
	});
		if(auth.role == 6){
		$('#reset_filter').on('click',function(){
			$('.dia').val('');
			oTable.ajax.reload();
		});
	}else if(auth.role == 5 || auth.role == 4){
		$('#reset_filter').on('click',function(){
			$('.sia').val('');
			oTable.ajax.reload();
		});
	}else{
		$('#reset_filter').on('click',function(){
			$('.filter').val('');
			oTable.ajax.reload();
		});
	}
});


fetchState = () => {
	var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillStates(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states) => {
	html='';
	html = '<option value="">Select State</option>';
	if(auth.role != 6){
		html = '<option value="">Select State</option>';
	}

	$.each(states, function(i, state) {
		if(auth.role == 6 && auth.state_id == state.id){
			html += '<option value="'+state.id+'" selected>'+state.title+'</option>';
		}else{
			html += '<option value="'+state.id+'">'+state.title+'</option>';
		}
		
	});
	$('#state_id').html(html);
	
}
$(document).on('change','#state_id', function (ev) {

	const v = $(this).val();
	var item_id = $(this).attr('state_id');
	fetchDistrict(v,item_id);
});

setTimeout(function(){
	if(auth.role == 6){
		var state = $("#state_id").val();
		fetchDistrict(state);
	}
},3000)


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
	html = '';
	html = '<option value="">Select District</option>';
	if(auth.role != 6){
		html = '<option value="">Select District</option>';
	}
	
	$.each(districts, function(i, district) {
		if(auth.district_id == district.id && auth.role == 6){
			html += '<option value="'+district.id+'" selected>'+district.title+'</option>';
		}else{
			html += '<option value="'+district.id+'">'+district.title+'</option>';
		}
		
	});
	$('#district_id').html(html);
}

 
fetchFinancialYear=()=>{
    var url = conf.getFinancialYearList.url;
    var method = conf.getFinancialYearList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            fillFinancialYear(response.data);
        }
    });
}
fillFinancialYear = (years) => {
    html = '<option value="">Select Financial Year</option>';
    $.each(years, function(i, year) {
        html += '<option value="'+year.id+'">'+year.title+'</option>';
    });
    $('#year_id').html(html);
}