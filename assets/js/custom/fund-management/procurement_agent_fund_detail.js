var auth = TRIFED.getLocalStorageItem();
var fund_management_release_fund = TRIFED.checkPermissions("fund_management_release_fund");
$(function () {
   
    fetchProcurementAgent();
    
    
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
                title: 'MFP Procurement procurement agent received fund list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.fundReceivedProcurementAgent.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.procurement_agent=$('#procurement_agent').val();
                d.mfp_id=$('#mfp_id').val();
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
                "render": function (data, type, row) {
                    return row.procurement_agent_details.user_name;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.total_mfp;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.total_quantity;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.total_value;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.total_released_to_procurement_agent;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='';
                    html += '<a href="../fund-management/mfp_procurement_fund_details_procurementagent_wise.php?id='+row.ref_id+'" class="btn btn-primary">View </a>';
                    return html;
                }
            },
            
            
        
        ]

    });
    $('#procurement_agent').on('change', function (ev) {
        const v = $(this).val();
        getMfpList(v);
        oTable.ajax.reload();
    });
    $('#mfp_id').on('change', function (ev) {
        const v = $(this).val();
        oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

});





fetchProcurementAgent = () => {
    var url = conf.getProcurementAgentList.url;
    var method = conf.getProcurementAgentList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fill_agent_list(response.data);
            console.log(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fill_agent_list = (data) => {
    agent_options='';
    if(auth.role!=7){
        agent_options+='<option value="">Select Procurement Agent</option>';
        readonly = '';
    }
    if(auth.role == 7){
        $("#procurement_agent").attr("readonly", "readonly");
    }
    data.forEach(function(row){
        agent_options +='<option value="'+row.id+'">'+row.user_name+'</option>';
    });
    $('#procurement_agent').html(agent_options);
    
}
getMfpList=(v)=>{
    var url = conf.getProcurementAgentMfpList.url(v);
    var method = conf.getProcurementAgentMfpList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fill_mfp_list(response.data);
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fill_mfp_list = (data) => {
    html='';
    agent_options='<option value="">Select MFP</option>';
    data.forEach(function(row){
        
        agent_options +='<option value="'+row.id+'">'+row.mfp_name+'</option>';
    });
    $('#mfp_id').html(agent_options);
    
}