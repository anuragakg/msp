var auth = TRIFED.getLocalStorageItem();
var mfp_procurement_actual_details_view_generated_receipt = TRIFED.checkPermissions("mfp_procurement_actual_details_view_generated_receipt");
var mfp_procurement_actual_details_generate_receipt = TRIFED.checkPermissions("mfp_procurement_actual_details_generate_receipt");
const proposal_id= TRIFED.getUrlParameters().proposal_id;

$(function () {
    $('.date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });

    $('#from').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#to').datepicker('setStartDate', minDate);
    });

    $('#to').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });
   fetchIdTypes();
    
});
$(document).ready(function () {
    
    var oTable = $('#list').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0, "DESC"]],
        "dom": 'lBfrtip',
        "scrollX": true,
        oLanguage: {
            sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'MFP Procurement View Transaction Details',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6, 7,8],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 2 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getMfpProcurementActualDetail.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.id_type=$('#id_type').val();
                d.id_value=$('#id_value').val();
                d.name_of_tribal=$('#name_of_tribal').val();
                d.from=$('#from').val();
                d.to=$('#to').val();
                if(proposal_id!=undefined)
                {
                    d.proposal_id=proposal_id;
                }
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
                "render": function (data, type, row) {
                    html = '';
                  
                    if (row.has_receipt_generated == 1 &&row.consolidated_id == 0) 
                     {
                        html = '<label class="pos-rel"><input type="checkbox" value="'+row.id+'" class="transactions" name="tribal_transaction[]"/><span class="lbl"></span></label>';   
                    } 
                    if (row.has_receipt_generated == 1 &&row.consolidated_id != 0) {
                        html = '<label class="pos-rel"><input type="checkbox" value="'+row.id+'" class="transactions" name="tribal_transaction[]"/ disabled="disabled" title="This transaction already consolidated"><span class="lbl"></span></label>';
                    }
                    return html;
                }
            },
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
               
                    return row.consolidated_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.name_of_tribal;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.procurement_date;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.mfp_id_count;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.qty.toFixed(4);
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
                    return utils.formatAmount(row.amount_paid);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.amount_payable);
                },
                "className": "text-right"
            },
            /*{
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.sum_of_receipt_generated);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.balance_for_receipt_generated);
                },
                "className": "text-right"
            },*/
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    return '<a href="../actual-details/tribal-details-view.php?id='+row.ref_id+'" class="btn btn-sm pull-right"><i class="fa fa-eye" aria-hidden="true"></i></a>';    
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    var html='';
                    if(mfp_procurement_actual_details_view_generated_receipt)
                    {
                        html+= '<div class="col-md-12 row"><a class="btn btn-primary " href="../actual-details/view-generated-receipts.php?id='+row.ref_id+'" class="btn btn-sm pull-left">View Receipts</a></div>';              
                    }  
                    
                    
                    if(mfp_procurement_actual_details_generate_receipt)
                    {
                        if(row.has_receipt_generated!=1)
                        {
                            html+= '<div class="col-md-12 row"><a href="../actual-details/generate-receipt.php?id='+row.ref_id+'" class="col-md-12 btn btn-success btn-sm pull-right">Generate Receipt</a></div>';        
                        }else{
                            html+= '<b>Receipts Generated</b>';
                        }
                    }else{
                        html+= '-';
                    }
                    
                    
                    return html;
                } 
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html = '';   
                    if(row.is_procurement_details_submitted == 0 && row.has_receipt_generated == 1 && row.consolidated_id != 0){
                        html+= '<a href="../actual-details/actual_details_mfp_storage.php?id='+row.proposal_ref_id+'&&cons_id='+row.consolidated_id+'&&trible_id='+row.ref_id+'" class="btn btn-success btn-sm pull-right">Add Procurement Details</a>';     
                    }
                    if(row.is_procurement_details_submitted == 1 && row.is_overhead_details_submitted==0 && row.has_receipt_generated == 1 && row.consolidated_id != 0){
                        html+= '<a href="../actual-details/overhead-details.php?id='+row.proposal_ref_id+'&&cons_id='+row.consolidated_id+'" class="btn btn-success btn-sm pull-right">Add Overhead Details</a>';    
                    }
                    return html;
                }
            },

            
        
        ]

    });
    
    $('#search').on('click',function () {
            oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

});

fetchIdTypes = () => {
    var url = conf.getIdProofList.url;
    var method = conf.getIdProofList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillTypes(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillTypes = (data) => {
    html='<option value="">Select Id Proof</option>';
    data.forEach(function(row){
        html +='<option value="'+row.id+'">'+row.title+'</option>';
    });
    $('#id_type').html(html);

}

$('#consolidate_submit_btn').on('click',function(){
    var checked_transactions = [];
    $('.transactions').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_transactions.push($(this).val());   

        }
    }); 
    //alert(checked_transactions);return;
    if(checked_transactions.length)
    {   
        if(confirm("Do you really want to consolidated & submit?"))
        {        
            var url = conf.consolidate_tribal_transaction.url;
            var method = conf.consolidate_tribal_transaction.method;
            var data = $('.transactions:checked').serialize();
            TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully consolidated & submitted');      
                    setTimeout(() => {
                            document.location = "actual_details_mfp_storage.php?id="+response.data.proposal_ref_id+"&&cons_id="+response.data.consolidated_id+"&trible_id="+response.data.ref_id; 
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
