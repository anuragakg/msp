var auth = TRIFED.getLocalStorageItem();
var mfp_procurement_actual_details_view_generated_receipt = TRIFED.checkPermissions("mfp_procurement_actual_details_view_generated_receipt");
const actual_detail_ref_id= TRIFED.getUrlParameters().id;
 $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });
$('.from_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('.to_date').datepicker('setStartDate', minDate);
    });
    $('.to_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });
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
                title: 'Receipt List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5]
                }
            },
        ],

        "ajax": {
            "url": conf.getProcurementActualDetailReceipt.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page()+1;
                d.actual_detail_ref_id=actual_detail_ref_id;
                d.from_date=$('#from_date').val();
                d.to_date=$('#to_date').val();
            },
            'error': function(error) {
                            if (error && error.status == 403) {
                                TRIFED.showError('error', 'You are not authorised');
                                
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
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#list').DataTable().page.info();
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.receipt_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
               
                     return row.dated;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.amount);
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.rest_amount);
                }
            },
            {
                "orderable": false,
                "render": function(data, type, row) {
                        
                    var html='&nbsp';
                    if(mfp_procurement_actual_details_view_generated_receipt)
                    {
                        html += '<a href="../actual-details/view-generated-receipts-detail.php?id='+row.ref_id+'" class="btn btn-primary">View Detail</a>';      

                    }
                    return html;  
                        
                        
                }
            },
           
        
        ]

    });
    
    $('#search').on('click',function(){
            
            oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });
    //$(".dataTables_filter").hide();

});


