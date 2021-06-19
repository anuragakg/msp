var auth = TRIFED.getLocalStorageItem();
var fund_management_received_fund = TRIFED.checkPermissions("fund_management_infrastructure_received_fund");
var visible='';
if(auth.role !=6)
{
    visible=false;
}
else
{
    visible=true;
}
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
                title: 'Infrastructure Received Consolidation Proposal',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11],             
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getReceivedConsolidatedProposal.url,
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
                "render": function (data, type, row) {
                    return row.logs.reference_id;
                }
            },
           
            {
                "render": function (data, type, row) {
                     ware_amount=0;
                    $.each(row.actual_warehouse, function (key, ware) {
                        $.each(ware.fund, function (key, fundAmount) {
                            if (!isNaN(fundAmount.actual_required_funds)) {
                                ware_amount += parseInt(fundAmount.actual_required_funds);
                            }                          
                        });  
                    });  
                    return utils.formatAmount(ware_amount);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                     haat_amount=0;
                    $.each(row.actual_haat, function (key, haat) {
                        $.each(haat.fund, function (key, fundHaatAmount) {
                            if (!isNaN(fundHaatAmount.actual_required_funds)) {
                                haat_amount += parseInt(fundHaatAmount.actual_required_funds);
                            }                          
                        });  
                    });  
                    return utils.formatAmount(haat_amount);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return '--';
                }
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.fund_received);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                     
                    return  utils.formatAmount(row.release_acutal_fund); 
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) { 
                    balance= parseInt(row.fund_received)-parseInt(row.release_acutal_fund);
                    return utils.formatAmount(balance);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return row.created_at;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.status_text;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.district;
                }
            },
            {
                "render": function (data, type, row) {
                    html='';
                    html += '<a href="../actual-details/view_actual_details_infrastructure_progress.php?id='+row.id+'&&ref_id='+row.ref_id+'">View</a>';
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
 $('.dataTables_filter input').attr("placeholder", "Serach by Proposal Id");
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


if (auth.role != undefined && auth.role != '') {

if(auth.role ==6)
{
    $("#actionTh").show();
}else{
    $("#actionTh").hide();
}
}