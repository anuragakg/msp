var auth = TRIFED.getLocalStorageItem();

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
                title: 'MFP Procurement commission received list',
                exportOptions: {
                    columns: [0,1,2,3,4,5],
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getInfrastructureDiaCommissionReceivedList.url,
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
                    return utils.formatAmount(row.release_amount);
                    
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.commission_amount);
                    
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.commission_rate;
                    
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.transaction_date;
                    
                },
                "className": "text-right"
            },
            
            
            
        
        ]

    });
      $('.dataTables_filter input').attr("placeholder", "Search by Proposal Id"); 
  
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });
    
});


