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
                    columns: [0, 1, 2, 3, 4,5]
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
                d.haat = $("#corresponding_haats").val();
                d.warehouse = $("#warehouse").val();
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
                    return row.mfp_name;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.warehouse_name;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) { 
                     haat_name='';
                    $.each(row.haat_data, function (key, haat) { 
                                haat_name += haat.haat_name+', ';
                    });  
                    return haat_name;
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return row.qty;
         
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value);
                
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    var html='&nbsp';
                    if(row.is_uploaded)
                    {
						if(row.receipt_path){
							html +='<a target="_blank" href="'+row.receipt_path+'">View Receipt</a>';
						}else{
							html +='-';
						}
                        
                    }
                    return html;
                }
            },


        ]

    });

    $('#mfp,#warehouse,#corresponding_haats').on('change',function () {
            oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });
    $(".dataTables_filter").hide();

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
        html += '<option value="'+warehouse.id+'" warehouse="'+warehouse.warehouse_id+'">'+warehouse.warehouse_name+'</option>';
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