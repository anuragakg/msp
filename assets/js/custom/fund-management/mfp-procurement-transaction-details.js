var auth = TRIFED.getLocalStorageItem();
var fund_management_release_fund = TRIFED.checkPermissions("fund_management_release_fund");

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
                title: 'MFP procurement transaction details list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6, 7,8],
					format: {
                     body: function (data, row, column, node ) {
                            return (column === 3 || column === 2) ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getMfpProcurementTransactionDetails.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
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
                "orderable": false,
                "render": function (data, type, row) {
                    // if (!row.consolidated_id) 
                    //  
                        return '<label class="pos-rel"><input type="checkbox" value="'+row.transaction_id+'"  class="transactions" name="transactions[]"/><span class="lbl"> </span></label>';      
                    //  }else{
                    //      return ' ';
                    //  }
                }
            },
            {
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#list').DataTable().page.info();
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "render": function (data, type, row) {
               
                    return row.transaction_id;
                }
            },
            {
                "render": function (data, type, row) {
               
                    return row.proposal_id;
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
                    return parseFloat(row.qty).toFixed(4);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return  parseFloat(row.value).toFixed(4);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html=''; 
                    // html += '<a href="../actual-details/actual_details_mfp_storage.php?id='+row.ref_id+'" class="btn btn-primary">Edit</a>'; 
                    html += '<a href="../actual-details/tribal-details-list.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">View</a>';
                    return html;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html=''; 
                    // html += '<a href="../actual-details/actual_details_mfp_storage.php?id='+row.ref_id+'" class="btn btn-primary">Edit</a>'; 
                    //html += '<a href="../actual-details/view_actual_details_mfp_storage.php?id='+row.ref_id+'" class="btn btn-primary">View</a>';
                    html += '<a href="../fund-management/warehouse-transaction-list.php?proposal_id='+row.mfp_procurement_id+'" class="btn btn-primary">View</a>';
                    return html;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html=''; 
                    //if(row.is_overhead_details_submitted ==  1){
                        // html += '<a href="../actual-details/overhead-details.php?id='+row.proposal_ref_id+'" class="btn btn-primary">Edit</a>'; 
                        html += '<a href="../actual-details/actual-overhead-listing.php?proposal_id='+row.proposal_id+'" class="btn btn-primary">View</a>';
                       
                    //}
                    return html;
                  
                  
                }
            },
           
            
            
        
        ]

    });
  
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

    $(".dataTables_filter").hide();

});



$('#consolidate_submit_btn').on('click',function(){
    
    var checked_transactions = [];
    $('.transactions').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_transactions.push($(this).val());   

        }
    }); 
    if(checked_transactions.length)
    {   
        if(confirm("Do you really want to consolidated & submit?"))
        {        
            var url = conf.consolidate_mfpprocurement_transaction.url;
            var method = conf.consolidate_mfpprocurement_transaction.method;
            var data = $('.transactions:checked').serialize();
            TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully consolidated & submitted');     
                    setTimeout(() => {
                            document.location = "list_of_proposal_consolidated_transaction.php";
                        }, 1000);           
                }else{
                    TRIFED.showError('error', response.message);
                }
            }); 
        }
    }else{
        alert('Please select transactions');
    }
    
});




