var auth = TRIFED.getLocalStorageItem();

var url_var = getUrlVars();
proposal_id='';
if (url_var['proposal_id'] != undefined) {
    proposal_id = url_var['proposal_id'];
    
}
$(document).ready(function () {
    fetchWarehouseMaster();      
    fetchHaatList();    
    fetchMfpMaster();  
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
                title: 'Warehouse Transaction List',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4,5,6]
                }
            },
        ],

        "ajax": {
            "url": conf.getWarehouseTransactionlist.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.mfp = $("#mfp").val();
                d.warehouse = $("#warehouse").val();
                d.status = $("#status").val();
                d.from_date = $("#from_date").val();
                d.to_date = $("#to_date").val();
               d.proposal_id = proposal_id;
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
                    return PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.proposal_id;
                }
            },
          
            {
                "render": function (data, type, row) {
                    return row.mfp_name;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.warehouse_name;
                }
            },
           /* {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.haat_name;
                }
            },*/
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.qty;
         
                },
                className:"text-right",
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.value;
                
                },
                className:"text-right",
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    if(row.is_uploaded == 0){
                        return '<label class="label label-warning">Pending</label> ';
                    }else{
                        return '<label class="label label-success">Uploaded</label> ';
                    }
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    if(row.is_uploaded == 0){
                        return '<label class="custom-file-upload disabled"><input id="file-upload" type="file" name="receipt"  class="upload_letter" style="display:none" actual_storage_other_id="'+row.mfp_storage_other_id+'"/> <i class="fa fa-cloud-upload"></i> Upload </label> ';
                    }else{
                        return '<a target="_blank" href="'+row.receipt_path+'">View Receipt</a>'
                    }
                    // return '<button class="btn btn-primary" id="upload" "upload_id='+row.mfp_storage_other_id+'">Upload</button>';
                
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    if(row.uploaded_on!= null){
                        return row.uploaded_on;
                    }
                }
            },


        ]

    });

    $('#mfp,#warehouse,#status,#from_date,#to_date').on('change',function () {
            oTable.ajax.reload();
    });

    if(auth.role!=9){
            $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });
    }else{
            $('#reset_filter').on('click',function(){
            $('.warehouse_user').val('');
            oTable.ajax.reload();   
            });
    }

    
    $(".dataTables_filter").hide();


    $(document).on('change', '.upload_letter', function () {
        var file_data = $(this).prop('files')[0];  
        var actual_storage_other_id = $(this).attr('actual_storage_other_id');  
        var res = fileValidation(file_data ,actual_storage_other_id);
        if(res){
            var data = new FormData(); 
            $(this).closest("label.custom-file-upload").find("i").toggleClass("fa fa-cloud-upload fa fa-spinner fa-spin");
            data.append('receipt', file_data);
            data.append('actual_storage_other_id', actual_storage_other_id);
            console.log(data);
            var url = conf.uploadWarehouseReceipt.url;
            var method = conf.uploadWarehouseReceipt.method;
            TRIFED.fileAjaxHit(url, method, data, function (response, cb) {
                if (response.status == 1) {
                    TRIFED.showMessage('success', 'Successfully uploaded');
                    oTable.ajax.reload();
                }else{
                    TRIFED.showError('error', response.message);
                }
            });
           
        }

       
    });

    function fileValidation(file_data) { 
        var fileInput = file_data; 
        var filePath = fileInput.value; 
        console.log(fileInput);
        // Allowing file type 
        var allowedExtensions =  /(\.pdf)$/i; 
          
        if (!allowedExtensions.exec(fileInput.name)) { 
            alert('Please upload only pdf'); 
            fileInput.value = ''; 
            return false; 
        }  
        return true;
    } 


});
fetchHaatList = () => {
    var url = conf.getHaatMasterList.url;
    var method = conf.getHaatMasterList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            haatmaster_data=response.data;
            fillHaatList(haatmaster_data);
        }
    });
}

fillHaatList= (Haats) => {
    html = '<option value="">Select Haat</option>';
    $.each(Haats, function(i, Haat) {
        html += '<option value="'+Haat.id+'">'+Haat.haat_bazaar_name+'</option>';
    });
    $("#corresponding_haats").html(html);
}

fetchWarehouseMaster=()=>{
    var url = conf.getWarehouse.url;
    var method = conf.getWarehouse.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            warehousemaster_data=response.data; 
            fillWarehouseMaster(warehousemaster_data);
        }
    });
}
fillWarehouseMaster = (warehouseMaster) => {  
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouseMaster, function(i, warehouse) { 
        if(auth.role == 9 && auth.warehouse == warehouse.warehouse_id){
            html += '<option value="'+warehouse.id+'" warehouse="'+warehouse.warehouse_id+'" selected>'+warehouse.warehouse_name+'</option>';
            $("#warehouse").attr("readonly",true);
        }else{
            html += '<option value="'+warehouse.id+'" warehouse="'+warehouse.warehouse_id+'">'+warehouse.warehouse_name+'</option>';
        }
       
    });
    $("#warehouse").html(html);
      
    
}

fetchMfpMaster = () => {
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;
            fillMfp(mfpmaster_data);
        }
    });
}

function fillMfp(mfp_result) {
    mfp_options = '<option value="">Select MFP</option>';
  
    mfp_result.forEach(function (row) {
        mfp_options += '<option value="' + row.id + '">' + row.mfp_name + '</option>';
    });
    $("#mfp").html(mfp_options);
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

$('#from_date').datepicker({
    todayBtn: "linked",
    format: 'dd/mm/yyyy',
    endDate: new Date()
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('#to_date').datepicker('setStartDate', minDate);
});

$('#to_date').datepicker({
    todayBtn: "linked",
    format: 'dd/mm/yyyy',
    endDate: new Date()
});