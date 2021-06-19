var auth = TRIFED.getLocalStorageItem();
const proposal_id= TRIFED.getUrlParameters().proposal_id;
//transaction_view = TRIFED.checkPermissions("mfp_procurement_transaction_details_view_pa");
if(auth.role == 1 ||auth.role == 2 ||auth.role == 3 ||auth.role == 4 ||auth.role == 5 ){
    $(".status").hide();
}

$(document).ready(function () {
    fetchDistrict(auth.state_id);
    var oTable = $('#list').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
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
                title: 'Consolidated Transaction List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6,7,8,9,10,11,12,13,14],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getProcurementConsolidatedTransaction.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page()+1;
                d.district = $('#district').val();
                d.status =  $("#status").val();
            
            },
            "dataSrc": function (json) {
                json.draw = json.data.draw;
                json.recordsTotal = json.data.recordsTotal;
                json.recordsFiltered = json.data.recordsFiltered;
                return json.data.data;

            }
        },
        "columns": [
            {
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#list').DataTable().page.info();
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
               
                    return row.proposal_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
               
                    return row.consolidated_transaction_id;
                }
            },
            {
                "render": function (data, type, row) {
               
                    return row.mfp_id_count;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.qty;
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value);
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.fund_received);
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.total_fund_utilized);
                }
            },
            /*{
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    balance = row.fund_received - row.total_fund_utilized;
                    return utils.formatAmount(balance);
                }
            },*/
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.submitted_on;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.status;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.district_name;
                }
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    //if(transaction_view){
                        return '<a href="../actual-details/tribal-details-list.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">View</a>';  
                    //}
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    //if(transaction_view){
                        return '<a href="../fund-management/warehouse-transaction-list.php?proposal_id='+row.mfp_procurement_id+'" class="btn btn-primary">View</a>';    
                    //}
                   
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    //if(transaction_view){
                        return '<a href="../actual-details/actual-overhead-listing.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">View</a>'; 
                    //}
                       
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.remarks;    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    return row.commission_amount;         
                    
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    return row.commission_rate;         
                    
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    return row.remaining_amount;         
                    
                    
                }
            },
             
        
        ]

    });

    $('#district,#status').on('change',function () {
       oTable.ajax.reload();
    });
 
    
    $('#reset_filter').on('click',function(){
        if(auth.role == 7 || auth.role == 6){
            $('#status').val('');
        }else{
            $(".filter").val('');
        }
       
        oTable.ajax.reload();
    });

    $(".dataTables_filter").hide();

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
    html = '';
	if(auth.role == 7){
		html += '<option value="'+auth.district_id+'">'+auth.district+'</option>';
	}else{
        html = '<option value="">Select District</option>';
		$.each(districts, function(i, district) {
			html += '<option value="'+district.id+'">'+district.title+'</option>';
		});
	}
	
	$('#district').html(html);
}



