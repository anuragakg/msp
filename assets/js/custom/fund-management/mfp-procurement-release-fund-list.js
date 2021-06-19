var auth = TRIFED.getLocalStorageItem();
var fund_management_release_fund = TRIFED.checkPermissions("fund_management_release_fund");
$(function () {
   
    fetchState();
    fetchDistrict();
    
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
                title: 'MFP Procurement release fund list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6],
                    format: {
                     body: function (data, row, column, node ) {
                            
                            if(column === 3 || column === 4|| column === 5|| column === 6)
                            {
                                return strToNumber(data);
                            }else{
                                return removeTags(data)   
                            }
                            
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getMfpProcurementReleaseList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.status=$('#status').val();
                d.file_number=$('#file_number').val(); 
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
               
                    return '<a href="../project-proposal/view-consolidated-proposal.php?id='+row.consolidated_id+'">'+row.reference_number+'</a>';
                }
            },
            {
                "render": function (data, type, row) {
                    return row.file_number;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.approved_amount);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.sanctioned_amount);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.released_amount);
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
                    return utils.formatAmount(row.balance_amount);
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='';
                    if(parseFloat(row.balance_amount)>0)
                    {
                        if(fund_management_release_fund)
                        {
                            html += '<a href="../fund-management/mfp_procurement_release_fund-form.php?id='+row.id+'" class="btn btn-primary">Release Fund</a>';
                        }
                    }
                    html += '<a href="../fund-management/mfp_procurement_release_fund_details.php?id='+row.id+'" class="btn btn-primary">View Details</a>';
                    return html;
                }
            },
            
            
        
        ]

    });
    $('#status').on('change', function (ev) {
        oTable.ajax.reload();
    });
    $('#status,#file_number').on('change',function () {
            oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

});



fetchState = () => {
    var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillStates(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states) => {
    html = '<option value="">Select State</option>';
    $.each(states, function(i, state) {
        html += '<option value="'+state.id+'">'+state.title+'</option>';
    });
    $('#state').html(html);
    
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