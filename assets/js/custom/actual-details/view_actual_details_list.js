var auth = TRIFED.getLocalStorageItem();
var fund_management_received_fund = TRIFED.checkPermissions("fund_management_infrastructure_received_fund");
const ref_id= TRIFED.getUrlParameters().id;
const proposal_id= TRIFED.getUrlParameters().pid;
$(document).ready(function () {
     $('#proposal_id').html(proposal_id); 
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
                title: 'Infrastructure Transaction Details',
                exportOptions: {
                    columns: [0,1,2,3,4],             
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getActualProposalList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                 if(ref_id!=undefined)
                {
                    d.ref_id=ref_id;
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
                "orderable": false,
                "render": function(data, type, row) {
                        html='';
                    if(row.is_assigned_next_level==1)     
                    {
                        // html+='<label class="pos-rel"><input type="checkbox" value="'+row.id+'" disabled/><span class="lbl"> </span></label>';
                    }else
                    {
                        html+='<label class="pos-rel"><input type="checkbox" value="'+row.id+'" class="proposals" name="proposals[]"/><span class="lbl"> </span></label>';
                    }              
                        return html;      
                 }          
            }, 
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
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.release_acutal_fund);
                    
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
                    html='<span>'+ row.date+'</span><br>'; 
                     return html;
                }
            }, 
             {
                "orderable": false,
                "render": function (data, type, row) {
                    html='';  
                    html += '<a href="../actual-details/view_actual_details_infrastructure_progress.php?id='+row.id+'&&ref_id='+row.ref_id+'" >View</a>  '; 
                    if(row.is_assigned_next_level!=1)     
                    {
                    html += '/ <a href="../actual-details/edit_actual_details_infrastructure_progress.php?id='+row.id+'&&ref_id='+row.ref_id+'" >Edit</a> ';
                    }
                   return html;
                }
            }       
            
        
        ]

    }); 


check_uncheck_checkbox=(isChecked) =>{
    if(isChecked) {
        $('input[name="proposals[]"]').each(function() { 
            this.checked = true; 
        });
    } else {
        $('input[name="proposals[]"]').each(function() {
            this.checked = false;
        });
    }
}


$('#consolidate_submit_btn').on('click',function(){
    
    var checked_proposals=[];
    $('.proposals').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_proposals.push($(this).val());   

        }
    }); 
    if(checked_proposals.length)
    {   
        if(confirm("Do you really want to consolidated & submit?"))
        {        
            var url = conf.consolidateInfrastructureTransaction.url;
            var method = conf.consolidateInfrastructureTransaction.method;
            var data = $('.proposals:checked').serialize();
            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully consolidated & submitted');     
                    setTimeout(() => {history.back();  }, 1000);           
                }else{
                    TRIFED.showError('error', response.message);
                }
            }); 
        }
    }else{
        alert('Please select proposals');
    }
    
});

});

 