var auth = TRIFED.getLocalStorageItem();

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
                title: 'MFP Procurement Sanctioned Letter List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6, 7,8]
                }
            },
        ],

        "ajax": {
            "url": conf.getSanctionedList.url,
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
               
                    return row.file_number;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.transaction_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.reference_number;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.state_name;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.year_name;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.sanctioned_amount;
                },
                className:'text-right'
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.created_by;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.created_at;
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