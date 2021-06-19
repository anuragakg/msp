var auth = TRIFED.getLocalStorageItem();
var viewActualDetails = TRIFED.checkPermissions("mfp_procurement_actual_details_view");
var addActualDetails =  TRIFED.checkPermissions("mfp_procurement_actual_details_add");


$(document).ready(function () {
    
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
                title: 'MFP Procurement received fund list',
                exportOptions: {
                    columns: [0,1,2,3],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getMfpProcurementPaFundReceivedList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.proposal_id = $('#proposal_id').val();
                //d.state=$('#state').val();
                //d.district=$('#district').val();
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
                "render": function (data, type, row) {
                    return row.proposal_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.total_released_to_procurement_agent);
                    
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='<span>'+ row.released_on+'</span><br>';
                    return html;
                }
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='&nbsp'; 
                    if(addActualDetails && row.fund_utilized <  row.total_released_to_procurement_agent){
                        html += '<a href="../actual-details/tribal-details-form.php?id='+row.proposal_ref_id+'&proposal_id='+row.proposal_id+'" class="btn btn-primary">Add</a>'; 
                    }
                
                    if(viewActualDetails && row.actual_detail_tribal_count)
                    {
                        html += '<a href="../actual-details/tribal-details-list.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">'+row.actual_tribal_amount_paid+'</a>';      
                    }
                    
                    return html;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='';
                    // if(addActualDetails){
                    //     html += '<a href="../actual-details/actual_details_mfp_storage.php?id='+row.proposal_ref_id+'" class="btn btn-primary">Add</a>';
                    // }
                    if(viewActualDetails && row.is_procurement_details_submitted ==1){
                        html += '<a href="../fund-management/warehouse-transaction-list.php?proposal_id='+row.mfp_procurement_id+'" class="btn btn-primary">'+row.total_mfp_storage_value+'</a>';
                        // html += '<a href="../actual-details/view_actual_details_mfp_storage.php?id='+row.proposal_ref_id+'" class="btn btn-primary">View</a>';
                      
                    } 
                    return html;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html=''; 
                    // if(addActualDetails){
                    //     html += '<a href="../actual-details/overhead-details.php?id='+row.proposal_ref_id+'" class="btn btn-primary">Add</a>'; 
                    // }
                   
                    if(viewActualDetails && row.is_overhead_details_submitted == 1){
                        //html += '<a href="../actual-details/view-actual-overhead-details.php?id='+row.proposal_ref_id+'" class="btn btn-primary">View</a>';
                        html += '<a href="../actual-details/actual-overhead-listing.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">'+row.total_overhead_paid_value+'</a>'
                    }
                    return html;
                }
            },
            
        
        ]

    });
   
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });
    
});



getMfpProcurementReceivedFundLogs = (procurement_id) => {
    var url = conf.getMfpProcurementReceivedFundLogs.url(procurement_id);
    var method = conf.getMfpProcurementReceivedFundLogs.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillDetails(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillDetails = (data) => {
    html ='';var sr_no=0;
    data.forEach(function(row){
        ++sr_no;
        html +='<tr>';
            html +='<td>' + sr_no + '</td>';
            html +='<td>' + row.released_amount + '</td>';
            html +='<td>' + row.bank_details.title + '</td>';
            html +='<td>' + row.account_number + '</td>';
            html +='<td>' + row.transaction_date + '</td>';
            html +='<td>' + row.created_by.user_name + '</td>';
        html +='</tr>';
    });
    $('#fund_received_detail').html(html);
    $('#detailModal').modal('show');
    
}


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
    $('#district').html(html);
}