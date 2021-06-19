var auth = TRIFED.getLocalStorageItem();
var editProposal = TRIFED.checkPermissions("mfp_procurement_plan_edit");
var viewProposal = TRIFED.checkPermissions("mfp_procurement_plan_view");
var addProposal = TRIFED.checkPermissions("mfp_procurement_plan_add");
var statusProposal = TRIFED.checkPermissions("mfp_procurement_plan_status");

$(document).ready(function () {
	fetchState();
	fetchFinancialYear();
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
					columns: [0, 1, 2]
				}
			},
		  ],
            "ajax":{
                     "url": conf.mfpDetails.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         d.page = api.page()+1;
				    },
		            "dataSrc": function(json) {
                        //alert(json.data);
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
                               return row.mfp_id;
						    }
		                },
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
                               var html='';
                              html +='<table class="table table-striped table-bordered table-hover ">';
                               row.year_data.forEach((row)=>{
                                html +='<tr>';
                                html +='<td >'+row.year+'</td>';
                                // html +='<td>'+row.procurement_qty+'</td>';
                                // html +='<td>'+row.procurement_value+'</td>';
                                // html +='<td>'+row.disposal_qty+'</td>';
                                // html +='<td>'+row.disposal_value+'</td>';
                                // html +='<td>'+row.losses_qty+'</td>';
                                // html +='<td>'+row.losses_value+'</td>';
                                // html +='<td>'+(row.procurement_qty - row.disposal_qty + row.losses_qty)+'</td>';
                                // html +='<td>'+(row.procurement_value - row.disposal_value + row.losses_value)+'</td>';
                                html +='</tr>';
                               })

                               
                               html +='</table>';
                            
                               return html;
                            }
                           
						},
						
						// { 
						// 	"orderable": false,
		                // 	"render": function(data, type, row) {
		                // 		return row.procurement_qty;
						       
						//     }
						// },
						// { 
						// 	"orderable": false,
		                // 	"render": function(data, type, row) {
                        //         return row.procurement_value;
						       
						//     }
						// },
						// { 
						// 	"orderable": false,
		                // 	"render": function(data, type, row) {
		                // 		return row.disposal_qty;
						       
						//     }
						// },
						// { 
						// 	"orderable": false,
		                // 	"render": function(data, type, row) {
		                // 		return  row.disposal_value;
						       
						//     }
						// },
						// { 
						// 	"orderable": false,
		                // 	"render": function(data, type, row) {
		                // 		return row.losses_qty;
						       
						//     }
						// },
						// { 
                        //     "orderable": false,
						// 	"render": function(data, type, row) {
						// 	   	return row.losses_value;
						//     }
                        // },
                        // { 
						// 	"orderable": false,
		                // 	"render": function(data, type, row) {
		                // 		return row.procurement_qty - row.disposal_qty +row.losses_qty;
						       
						//     }
						// },
						// { 
                        //     "orderable": false,
						// 	"render": function(data, type, row) {
                        //         return row.procurement_value - row.disposal_value +row.losses_value;
						//     }
						// },
						
					]

      });

	$('#state_id,#district_id,#year_id,#submission_status').on('change',function () {
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