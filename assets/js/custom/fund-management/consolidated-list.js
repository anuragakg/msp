var auth = TRIFED.getLocalStorageItem();
console.log(auth);
var fund_management_generate_sanction_letter = TRIFED.checkPermissions("fund_management_generate_sanction_letter");
$(function () {
   
    fetchState();
    fetchDistrict();
    
});
$(document).ready(function () {
    if(auth.role == 3){ //If logged in user in ministry
        action_column_visible=true;
        role_name =' Ministry Share';
    }else if(auth.role == 4){//If logged in user in nodal
        action_column_visible=true;
        role_name = 'State Share';
    }else{
        action_column_visible=false;
        role_name = 'Share';
    }
    $(".share-header").html(role_name);
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
                title: 'MFP Procurement Generate Sanction List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6, 7,8],
                    format: {
                     body: function (data, row, column, node ) {
                            
                            if(column === 4 || column === 5|| column === 6)
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
            "url": conf.getApprovedConsolidatedProposals.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.state=$('#state').val();
                d.district=$('#district').val();
                d.status=$('#status').val();
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
                    return row.state_name;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.year_name;
                }
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.approved_amount);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.sanctioned_amount);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.balance_amount);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return row.assignedToUser;    
                    
                    
                }
            },
            {
                "render": function (data, type, row) {
                    if(row.is_sanctioned !=1 && fund_management_generate_sanction_letter)
                    {
						if(row.balance_amount == 0 ){
								return 'Generated';
							}
                        if(row.is_state_share ==1){
                            return '<a href="../fund-management/generate-sanction-state.php?id='+row.id+'" class="btn btn-primary">Generate Sanction</a>';    
                        }else{
							
                            return '<a href="../fund-management/generate-sanction.php?id='+row.id+'" class="btn btn-primary">Generate Sanction</a>';        
                        }
                        
                    }else{
                        return 'Generated';    
                    }
                    
                }
            },
            
            
            {
                "render": function (data, type, row) {
                    
                    return '<a href="javascript:void(0)" onclick="getUserSanctionedList('+row.consolidated_id+','+row.assigned_to+')"><i class="fa fa-"></i>View</a>';    
                    
                    
                }
            },
            
        
        ]

    }).column(8).visible(action_column_visible);
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
        if(auth.role == 4 ){
            html += '<option value="'+state.id+'" selected>'+state.title+'</option>';
        }else{
            html += '<option value="'+state.id+'">'+state.title+'</option>';
        }
        
    });
    $('#state').html(html);
    if(auth.role == 4 ){
        $('#state').attr('readonly','readonly');
    }
    
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
getUserSanctionedList=(consolidated_id,assigned_to)=>{
    var url = conf.getSanctionedListAmountLog.url;
    var method = conf.getSanctionedListAmountLog.method;
    var data = {
        assigned_to:assigned_to,
        consolidated_id:consolidated_id,

    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            var html='';
            //fillDistrict(response.data);
            var data=response.data;
            var i = 0;
            console.log(data.length);
            if(data.length){
                data.forEach(function(row){
                    ++i;
                    html +='<tr>';
                        html +='<td>'+i+'</td>';
                        html +='<td>'+row.file_number+'</td>';
                        html +='<td class="text-right">'+utils.formatCurrency(row.sanctioned_amount)+'</td>';
                        html +='<td>'+row.transaction_id+'</td>';
                        html +='<td>'+row.transaction_date_format+'</td>';
                        html +='<td>'+row.sanctioned_by.user_name+'</td>';
                    html +='</tr>';
                })
            } else {
                html += '<tr>';
                html += '<td colspan="6" style="text-align:center">No records available</td>';
                html += '</tr>';

            }
           
         
            $('#sanctione_history_table').html(html);
            $('#sanctione_history').modal('show');
        }
    });
}