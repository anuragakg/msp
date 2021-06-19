var auth = TRIFED.getLocalStorageItem();
//var auction_view_committe = TRIFED.checkPermissions("auction_view_committe");
//var auction_create_committe = TRIFED.checkPermissions("auction_create_committe");
$(document).ready(function () {
    fetchMfpMaster();    
    getUserHaatBazaar();
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
                title: 'Market Price list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5]
                }
            },
        ],

        "ajax": {
            "url": conf.getApprovedMspMarketPriceList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.haat_master_id=$('#haat_master_id').val()
                d.mfp_id=$('#mfp_id').val()
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
                "orderable": false,
                "render": function (data, type, row) {
                    return row.haat_master_name;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.mfp_name;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.msp_price;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.market_price;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.status_text;
                }
            },
            
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='&nbsp;';
            
            
                    //html += '<a href="../msp_market_price/add_msp_market_price.php?id='+row.id+'" class="data-edit"><i class="fa fa-edit" title="Edit"></i></a>';       
            
                    
                    
                    
                    return html;
                }
            },
            
            
        
        ]

    });
   $('#mfp_id,#haat_master_id').on('change',function(){
        oTable.ajax.reload();
   });
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });

});


fetchMfpMaster = () => {
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;
            fillMfpMaster(mfpmaster_data,mfp_id)
        }
    });
}
fillMfpMaster = (mfps, item_id = 0) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
    });
    $(item_id).html(html);
}


getUserHaatBazaar = () => {
    var url = conf.getCurrentUserHaatInfo.url;
    var method = conf.getCurrentUserHaatInfo.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            haatdata = response.data;
            fillHaatMaster(haatdata,'#haat_master_id')
        }
    });
}
fillHaatMaster = (haats, item_id = 0) => {
    html = '<option value="">Select haat</option>';
    $.each(haats, function (i, haat) {
        html += '<option value="' + haat.id + '">' + haat.haat_bazaar_name + '</option>';
    });
    $(item_id).html(html);
}