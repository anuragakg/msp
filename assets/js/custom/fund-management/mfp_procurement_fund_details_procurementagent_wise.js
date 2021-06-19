var auth = TRIFED.getLocalStorageItem();

var url_var = getUrlVars();

var id='';
if (url_var['id'] != undefined) {
        id=url_var['id'];
}
$(function () {
   
   // fetchProcurementAgent();
    
    
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
                    columns: [0,1, 2, 3, 4, 5, 6,7],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.fundReceivedProcurementAgentDetail.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.ref_id=id;
                //d.procurement_agent=$('#procurement_agent').val();
                //d.district=$('#district').val();
            },
            "dataSrc": function (json) {
                json.draw = json.data.result.draw;
                json.recordsTotal = json.data.result.recordsTotal;
                json.recordsFiltered = json.data.result.recordsFiltered;
                $('#procurement_agent').html(json.data.procurement_agent_name);
                return json.data.result.data;

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
                    return '<a href="javascript:void(0)" onclick="getMfpDetails('+row.id+')" title=""view mfp details>'+row.total_mfp+'</a>';
                },
                className:"text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.total_quantity;
                },
                className:"text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.total_value);
                },
                className:"text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return '<a href="javascript:void(0)" onclick="getBankDetails('+row.id+')" title=""view mfp details>'+utils.formatAmount(row.total_released_to_procurement_agent)+'</a>';
                },
                className:"text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.created_at;
                }
            },
            
            
        
        ]

    });
    $('#procurement_agent').on('change', function (ev) {
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
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fill_agent_list = (data) => {
    html='';
    agent_options='<option value="">Select Procurement Agent</option>';
    data.forEach(function(row){
        
        agent_options +='<option value="'+row.id+'">'+row.user_name+'</option>';
    });
    $('#procurement_agent').html(agent_options);
    
}
function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
getMfpDetails=(id)=>{
    var url = conf.getMfpProcurementAgentReleasedetail.url(id);
    var method = conf.getMfpProcurementAgentReleasedetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fill_Mfp_list(response.data.commodity_details);
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
getBankDetails=(id)=>{
    var url = conf.getMfpProcurementAgentReleasedetail.url(id);
    var method = conf.getMfpProcurementAgentReleasedetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fill_Bank_list(response.data.bank_details);
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}
fill_Mfp_list=(data)=>{
    var html='';
    var sr_no=0;
    data.forEach(function(row){
        ++sr_no;
        html +='<tr>';
            html +='<td>'+sr_no+'</td>';
            html +='<td>'+row.mfp_name+'</td>';
            html +='<td class="text-right">'+row.qty+'</td>';
            html +='<td class="text-right">'+utils.formatAmount(row.value)+'</td>';
        html +='</tr>';
    });
    $('#commodity_details').html(html);
    $('#commodityModal').modal('show');
}
fill_Bank_list=(data)=>{
    var html='';
    var sr_no=0;
    data.forEach(function(row){
        ++sr_no;
        html +='<tr>';
            html +='<td>'+sr_no+'</td>';
            html +='<td>'+row.BankDetail.title+'</td>';
            html +='<td>'+row.account_no+'</td>';
            html +='<td>'+row.transaction_date+'</td>';
            html +='<td class="text-right">'+utils.formatAmount(row.release_amount)+'</td>';
        html +='</tr>';
    });
    $('#bank_details').html(html);
    $('#BankModal').modal('show');
}