var auth = TRIFED.getLocalStorageItem();
var fund_management_received_fund = TRIFED.checkPermissions("fund_management_infrastructure_received_fund");
const proposal_id= TRIFED.getUrlParameters().proposal_id;
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
                title: 'Infrastructure Progress list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5],             
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 2 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getInfrastructureProgressList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
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
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#list').DataTable().page.info();
                    return  PageInfo.start + 1 + meta.row;;
                }
            },            
            {
                "render": function (data, type, row) {
                    return row.txn_id;
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
                    html='';
                    html +='<a href="../actual-details/view_actual_details_infrastructure_haat.php?id='+row.id+'&&ref_id='+row.ref_id+'">'+row.actual_haat[0].fund.length+'</a>';
                    return html;
                    
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) { 
                     html='';
                    html +='<a href="../actual-details/view_actual_details_infrastructure_warehouse.php?id='+row.id+'&&ref_id='+row.ref_id+'">'+row.actual_warehouse[0].fund.length+'</a>';
                    return html;
                }
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {                   
                    return '0';
                }
            },

             {
                "orderable": false,
                "render": function (data, type, row) {
                    html='';
                    html += '<a href="../actual-details/view_actual_details_infrastructure_progress.php?id='+row.id+'&&ref_id='+row.ref_id+'" >View</a>';
                   // html += '<a href="../actual-details/edit_actual_details_infrastructure_progress.php?id='+row.id+'&&ref_id='+row.ref_id+'" >Edit</a> ';
                    return html;
                }
            },
            
            
        
        ]

    });
    $('#state').on('change', function (ev) {
        const v = $(this).val();
        
        fetchDistrict(v);
        oTable.ajax.reload();
    });
    $('#district,#status').on('change',function () {
            oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });
 $(".dataTables_filter input").attr("placeholder", "Search by Proposal Id");
});



getReceivedFundLogs = (procurement_id) => {
    var url = conf.getReceivedFundLogs.url(procurement_id);
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