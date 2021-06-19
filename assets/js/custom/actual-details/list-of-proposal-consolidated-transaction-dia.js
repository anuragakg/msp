var auth = TRIFED.getLocalStorageItem();
const proposal_id= TRIFED.getUrlParameters().proposal_id;

var mfp_procurement_actual_details_view = TRIFED.checkPermissions("mfp_procurement_actual_details_view");

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
                    columns: [0,1, 2, 3, 4, 5, 6,7,8,9,10,11,12,13,14,15,16],
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
                d.proposal_id=$('#proposal_id').val();
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
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return row.qty;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.fund_received);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.total_fund_utilized);
                },
                "className": "text-right"
            },
            /*{
                "orderable": false,
                "render": function (data, type, row) {
                    balance = row.fund_received - row.total_fund_utilized;
                    return utils.formatAmount(balance);
                },
                "className": "text-right"
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
                    return row.submitted_by;
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
                    if(mfp_procurement_actual_details_view){
                            return '<a href="../actual-details/tribal-details-list.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">View</a>';        
                    }else{
                        return '-';
                    }
                    
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    if(mfp_procurement_actual_details_view){
                           return '<a href="../fund-management/warehouse-transaction-list.php?proposal_id='+row.mfp_procurement_id+'" class="btn btn-primary">View</a>';         
                    }else{
                        return '-';
                    }
                    
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    if(mfp_procurement_actual_details_view){
                           return '<a href="../actual-details/actual-overhead-listing.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">View</a>';         
                    }else{
                        return '-';
                    }
                    
                    
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
            {
                "orderable": false,
                "render": function (data, type, row) {
                    if(row.status_value == 0){
                        return '<a class="btn btn-success" onclick="action('+row.consolidated_ref_prim_id+',1)">Approve</a><a class="btn btn-warning" onclick="action('+row.consolidated_ref_prim_id+',2)">Revert</a><a class="btn btn-danger" onclick="action('+row.consolidated_ref_prim_id+',3)">Reject</a>';
                    }else{
                        return '';
                    }
                   
                }
            },     
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.remarks;    
                    
                }
            },
             
        
        ]

    });
    $('#proposal_id,#status').on('keyup',function () {
		oTable.ajax.reload();
    });
    
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

    $(".dataTables_filter").hide();

    $("#submitremarksClose").click(function(){
        $("textarea[name=remarks]").val('');
        $("#transaction_id").val('');
        $("#transaction_status").val('');
        $("#remarks_error").html("");
        $("#remarksModal").hide();
    })

    $(".remarks_save").click(function(){
        var remarks = $("textarea[name=remarks]").val();
        var status = $("#remarksModal").find('#status').val();
        
        if(remarks==''){
            return $("#remarks_error").html("Please enter remarks");
        }
        if(remarks.length > 300 && status =="3"){
            return $("#remarks_error").html("Remarks legth must be 300 maximum");
        }else{
            $("#remarks_error").html('');
        }
    
        var transaction_id = $("#remarksModal").find("#transaction_id").val();
        var transaction_status = $("#remarksModal").find("#transaction_status").val();
       
        if (transaction_status && transaction_id) {
            if (transaction_status == 3) {
                text = 'reject';
            } else if (transaction_status == 2) {
                text = 'revert';
            } else if (transaction_status == 1) {
                text = 'approve';
            }else {
                return false;
            }
    
            if(confirm('Are you sure ,you want to '+text )){
                var url = conf.approveRevertRejectTransaction.url;
                var method = conf.approveRevertRejectTransaction.method;
                var data = {transaction_id:transaction_id,transaction_status:transaction_status,remarks:remarks};
                TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
                    if (response) {
                        haatmaster_data = response.data;
                        $("textarea[name=remarks]").val('');
                        $("#transaction_id").val('');
                        $("#transaction_status").val('');
                        $("#remarksModal").hide();
                        oTable.ajax.reload();
                    }
                });
                
            }
          
           
    
    
        }
        
    });

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
	if(auth.role == 6){
		html += '<option value="'+auth.district_id+'">'+auth.district+'</option>';
	}else{
        html = '<option value="">Select District</option>';
		$.each(districts, function(i, district) {
			html += '<option value="'+district.id+'">'+district.title+'</option>';
		});
	}
	
	$('#district').html(html);
}


function action(transaction_id,status){
    if(status == 1){
        label = 'Approve';
    }
    if(status == 2){
        label = 'Revert';
    }
    if(status == 3){
        label = 'Reject';
    }
    $("#transaction_id").val(transaction_id);
    $("#transaction_status").val(status);
    $("#modalTitle").html(label +' Remarks');
    $("#remarksModal").show();

    if($('#remarks').val()=='')
    {
        $('#remarks_err').html('Please enter remarks');
    } else {
        $('#remarks_err').html('');
    }    

}





