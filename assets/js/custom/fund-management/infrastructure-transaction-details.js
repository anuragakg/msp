var auth = TRIFED.getLocalStorageItem();
var fund_management_received_fund = TRIFED.checkPermissions("fund_management_infrastructure_received_fund");

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
                title: 'Infrastructure Transaction Details',
                exportOptions: {
                    columns: [1,2,3]
                }
            },
        ],

        "ajax": {
            "url": conf.getInfrastructureTransactionList.url,
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
                "orderable": false,
                "render": function(data, type, row) {                   
                        return '<label class="pos-rel"><input type="checkbox" value="'+row.id+'" class="proposals" name="proposals[]" data-id="'+row.proposal_id+'"/><span class="lbl"> </span></label>';      
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
                    return 'transaction-'+row.id;
                }
            },
           /* { 
                "orderable": false,
                "render": function(data, type, row) {
                    return row.status_text+'<br><span ><i class="fa fa-line-chart" onclick="getTransactionStatusLogs('+row.id+')")"></i></span>';
                                               
                }
            },*/
           
            {  "orderable": false,
                "render": function (data, type, row) {
                     haat_amount=0;
                    $.each(row.actual_haat, function (key, haat) {
                        $.each(haat.fund, function (key, fundHaatAmount) {
                            if (!isNaN(fundHaatAmount.actual_required_funds)) {
                                haat_amount += parseInt(fundHaatAmount.actual_required_funds);
                            }                          
                        });  
                    });  

                     ware_amount=0;
                    $.each(row.actual_warehouse, function (key, ware) {
                        $.each(ware.fund, function (key, fundAmount) {
                            if (!isNaN(fundAmount.actual_required_funds)) {
                                ware_amount += parseInt(fundAmount.actual_required_funds);
                            }                          
                        });  
                    });  
                    return  parseInt(haat_amount)+parseInt(ware_amount);
                }
            },
             {
                "orderable": false,
                "render": function (data, type, row) {
                    html='';
                    html += '<a href="../actual-details/view_actual_details_infrastructure_progress.php?id='+row.id+'&&ref_id='+row.ref_id+'" >View</a> /';
                    html += '<a href="../actual-details/edit_actual_details_infrastructure_progress.php?id='+row.id+'&&ref_id='+row.ref_id+'" >Edit</a> ';
                    return html;
                }
            },
            
            
        
        ]

    });
    $('#state').on('change', function (ev) {
        const v = $(this).val();
        
        fetchDistrict(v);
      //  oTable.ajax.reload();
    });
    $('#district,#status').on('change',function () {
            oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

});

$(document).ready(function () {
$('.tab2').on('click',function(){  
    $('#Submittedlist').DataTable().clear().destroy();
    var oTable = $('#Submittedlist').DataTable({
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
                    columns: [1,2,3],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 2 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getConsolidatedTransactionList.url,
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
                    return 'transaction-'+row.id;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.proposal_id;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.consolidated_id;
                }
            },
           
            {  "orderable": false,
                "render": function (data, type, row) {
                     haat_amount=0;
                    $.each(row.actual_haat, function (key, haat) {
                        $.each(haat.fund, function (key, fundHaatAmount) {
                            if (!isNaN(fundHaatAmount.actual_required_funds)) {
                                haat_amount += parseInt(fundHaatAmount.actual_required_funds);
                            }                          
                        });  
                    });  

                     ware_amount=0;
                    $.each(row.actual_warehouse, function (key, ware) {
                        $.each(ware.fund, function (key, fundAmount) {
                            if (!isNaN(fundAmount.actual_required_funds)) {
                                ware_amount += parseInt(fundAmount.actual_required_funds);
                            }                          
                        });  
                    });  
                    return  parseInt(haat_amount)+parseInt(ware_amount);
                }
            }, 
            { 
                "orderable": false,
                "render": function(data, type, row) {
                    return row.status_text;
                                               
                }
            },
        ]
    });
 });
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
                    setTimeout(() => {
                            document.location = "infrastructure_transaction_details.php";
                        }, 1000);           
                }else{
                    TRIFED.showError('error', response.message);
                }
            }); 
        }
    }else{
        alert('Please select proposals');
    }
    
});