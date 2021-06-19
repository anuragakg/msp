var auth = TRIFED.getLocalStorageItem();
var editProposal = TRIFED.checkPermissions("mfp_procurement_plan_edit");
var viewProposal = TRIFED.checkPermissions("mfp_procurement_plan_view");
var addProposal = TRIFED.checkPermissions("mfp_procurement_plan_add");
var statusProposal = TRIFED.checkPermissions("mfp_procurement_plan_status");
//console.log(auth);
//alert(editProposal);
$(document).ready(function () {
	fetchState();
	fetchFinancialYear();
	
	//fetchProposalIds();
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
				title: 'MFP Procurement List',
				exportOptions: {
					columns: [0, 1, 2,3,4,5,6,7,8],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
		                }
		            },
				}
			},
		  ],
            "ajax":{
                     "url": conf.mfpProcurementListing.url,
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
							"orderable": false,
		                	"render": function(data, type, row) {
						       return row.state;
						    }
						},
						
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.district
						       
						    }
						},
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.status_text+'<br><span ><i class="fa fa-line-chart" onclick="getMfpProcurementStatusLogs('+row.id+')")"></i></span>';
						       
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
		                		var html='&nbsp';
		                		//if(row.progress>0){
		                			//return '<a href="../actual-details/tribal-details-list.php?proposal_id='+row.proposal_id+'" class="data-edit">'+row.progress+'</a>';	
									
									return row.progress+'% <br> <a href="javascript:void(0)"><i class="fa fa-line-chart"></i></a>';
									//replace link with   ../actual-details/mfp-procurement-progress-list.php?proposal_id='+row.id+'									
		                		//}else{return 0;}
		                		
						    }
						},
						{ 
							"render": function(data, type, row) {
								var html='';
								if(editProposal)
								{
									if(row.submission_status==0 || row.status==2)
									{
										html += '<a href="../project-proposal/step1.php?id='+row.ref_id+'" class="data-edit"><i class="fa fa-edit" title="Edit"></i></a>';	
									}	
								}
								
						       
						        if(viewProposal)
						        {
						        	html += ' | <a href="../project-proposal/view-mfp-procurement.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'" class="data-edit"><i class="fa fa-eye" title="View Detail"></i></a>';		
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

	$(".dataTables_filter").css('display','none');
	//if logged in user DIA
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
		if(auth.role == 6)
		{
			if(auth.district_id == district.id){
				html += '<option value="'+district.id+'" selected>'+district.title+'</option>';	
			}
		}else{
			html += '<option value="'+district.id+'">'+district.title+'</option>';
		}
		/*if(auth.district_id == district.id && auth.role == 6){
			html += '<option value="'+district.id+'" selected>'+district.title+'</option>';
		}else{
			html += '<option value="'+district.id+'">'+district.title+'</option>';
		}*/
		
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

fetchProposalIds = () => {
    var url = conf.getAllProposalIds.url;
    var method = conf.getAllProposalIds.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillProposalIds(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillProposalIds = (states) => {
    html = '<option value="">Select Proposal</option>';
    $.each(states, function(i, state) {
        html += '<option value="'+state.proposal_id+'">'+state.proposal_id+'</option>';
    });
    $('#proposal_id').html(html);
}
