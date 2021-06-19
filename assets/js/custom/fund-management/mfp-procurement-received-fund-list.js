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
                title: 'MFP Procurement received fund list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6],             
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getMfpProcurementFundReceivedList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.status=$('#status').val();
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
                    return '<a href="../project-proposal/view-mfp-procurement.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'">'+row.proposal_id+'</a>';
                }
            },
            {
                "render": function (data, type, row) {
                    return row.consolidated_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.total_fund_require);
                    
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                  
                    html='<span>'+ utils.formatAmount(row.released_amount)+'</span><br>';
                    html +='<i class="fa fa-line-chart" title="View Details" onclick="getMfpProcurementReceivedFundLogs('+row.id+')" )"=""></i>';
                    return html;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                  
                    html='<span>'+ utils.formatAmount(row.total_released_to_procurement_agent)+'</span><br>';
                    
                    return html;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                  
                    html='<span>'+ utils.formatAmount(row.commission_amount)+'</span><br>';
                    html +='<i class="fa fa-line-chart" title="View Commission Details" onclick="getMfpProcurementReceivedCommission('+row.id+')" )"=""></i>';
                    return html;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                  
                    html='<span>'+ utils.formatAmount(row.total_can_released_to_procurement_agent)+'</span><br>';
                    
                    return html;
                },
                "className": "text-right"
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='';
                    if(parseFloat(row.has_released_to_procurement_agent)!=1)
                    {
                        if(fund_management_release_fund)
                        {
                            html += '<a href="../fund-management/mfp_procurement_dia_release_fund.php?id='+row.ref_id+'" class="btn btn-primary">Release Fund</a>';
                        }
                    }else{
						html += 'Released';
					}
                    //html += '<a href="../fund-management/mfp_procurement_release_fund_details.php?id='+row.id+'" class="btn btn-primary">View Details</a>';
                    return html;
                }
            },
            
            
        
        ]

    });
    $('#status').on('change', function (ev) {
        
        oTable.ajax.reload();
    });
    $('#district,#status').on('change',function () {
            oTable.ajax.reload();
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
            html +='<td>' + utils.formatCurrency(row.released_amount) + '</td>';
            html +='<td>' + row.bank_details.title + '</td>';
            html +='<td>' + row.account_number + '</td>';
            html +='<td>' + row.transaction_date_format + '</td>';
            html +='<td>' + row.created_by.user_name + '</td>';
        html +='</tr>';
    });
    $('#fund_received_detail').html(html);
    $('#detailModal').modal('show');
    
}
getMfpProcurementReceivedCommission = (procurement_id) => {
    var url = conf.getMfpProcurementReceivedCommission.url(procurement_id);
    var method = conf.getMfpProcurementReceivedCommission.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillCommissionDetails(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fillCommissionDetails = (data) => {
    html ='';var sr_no=0;
    data.forEach(function(row){
        ++sr_no;
        html +='<tr>';
            html +='<td>' + sr_no + '</td>';
            html +='<td>' + row.proposal_id + '</td>';
            html +='<td>' + utils.formatCurrency(row.release_amount) + '</td>';
            html +='<td>' + utils.formatCurrency(row.commission_amount) + '</td>';
            html +='<td>' + row.commission_rate + '</td>';
            html +='<td>' + row.transaction_date + '</td>';
        html +='</tr>';
    });
    $('#commission_received_detail').html(html);
    $('#commissionModal').modal('show');
    
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