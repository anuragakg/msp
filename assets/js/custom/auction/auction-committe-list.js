var auth = TRIFED.getLocalStorageItem();
var auction_view_committe = TRIFED.checkPermissions("auction_view_committe");
var auction_create_committe = TRIFED.checkPermissions("auction_create_committe");
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
                title: 'auction-committe-list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6]
                }
            },
        ],

        "ajax": {
            "url": conf.getAuctionCommitteList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.type=$('#type').val()
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
                    return row.auction_title;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.mfp_count;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.qty_sum;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.auction_date;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.venue;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.created_at;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='&nbsp;';
                    if(auction_create_committe && row.can_edit)
                    {
                        html += '<a href="../auction/create_committe.php?id='+row.id+'&type='+row.type+'" class="data-edit"><i class="fa fa-edit" title="Edit"></i></a>';       
                    }
                    
                    if(auction_view_committe)
                    {
                        html += ' |<a href="../auction/view-auction-committe-details.php?id='+row.id+'" class="btn btn-primary">View Details</a>';      
                    }
                    
                    return html;
                }
            },
            
            
        
        ]

    });
   $('#type').on('change',function(){
        oTable.ajax.reload();
   });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

});


